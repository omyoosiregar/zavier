<?php

namespace App\Http\Controllers;

use App\Models\BankKepribadian;
use App\Models\SoalKepribadian;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use ZipArchive;
use DOMDocument;
use DOMXPath;
use DOMNode;

class KepribadianBankController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR BANK
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $banks = BankKepribadian::withCount('soal')
            ->orderBy('id')
            ->get();

        return view(
            'admin.kepribadian-bank.index',
            compact('banks')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE BANK
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.kepribadian-bank.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE BANK
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bank' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
            ],
        ]);

        $validated['status'] =
            $request->boolean('status');

        BankKepribadian::create(
            $validated
        );

        return redirect()
            ->route(
                'admin.kepribadian-bank.index'
            )
            ->with(
                'success',
                'Bank soal kepribadian berhasil dibuat.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT BANK
    |--------------------------------------------------------------------------
    */

    public function edit(
        BankKepribadian $bank
    ) {
        $bank->load([
            'soal' => function ($query) {
                $query->orderBy('nomor_soal');
            }
        ]);

        return view(
            'admin.kepribadian-bank.edit',
            compact('bank')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE BANK
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        BankKepribadian $bank
    ) {
        $validated = $request->validate([
            'nama_bank' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
            ],
        ]);

        $validated['status'] =
            $request->boolean('status');

        $bank->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.kepribadian-bank.edit',
                $bank
            )
            ->with(
                'success',
                'Informasi bank berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPLOAD WORD
    |--------------------------------------------------------------------------
    |
    | Sistem membaca:
    |
    | 1. Pertanyaan
    | 2. Pilihan A-E
    | 3. Warna font pilihan
    |
    | Pilihan yang mempunyai warna selain hitam
    | dianggap sebagai KUNCI JAWABAN.
    |
    */

    public function uploadWord(
        Request $request,
        BankKepribadian $bank
    ) {
        $request->validate(
            [
                'word' => [
                    'required',
                    'file',
                    'max:10240',
                ],
            ],
            [
                'word.required' =>
                    'Silakan pilih file Word terlebih dahulu.',

                'word.file' =>
                    'File yang dikirim tidak valid.',

                'word.max' =>
                    'Ukuran file maksimal 10 MB.',
            ]
        );

        $file = $request->file('word');

        if (
            !$file ||
            !$file->isValid()
        ) {
            return back()->with(
                'error',
                'File Word tidak dapat dibaca.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK EXTENSION
        |--------------------------------------------------------------------------
        */

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        if ($extension !== 'docx') {
            return back()->with(
                'error',
                'File harus berformat .docx.'
            );
        }


        $path = $file->getRealPath();

        if (
            !$path ||
            !file_exists($path)
        ) {
            return back()->with(
                'error',
                'File Word tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BUKA DOCX
        |--------------------------------------------------------------------------
        */

        $zip = new ZipArchive();

        if (
            $zip->open($path) !== true
        ) {
            return back()->with(
                'error',
                'File Word tidak dapat dibuka.'
            );
        }

        $documentXml =
            $zip->getFromName(
                'word/document.xml'
            );

        $zip->close();

        if (
            $documentXml === false
        ) {
            return back()->with(
                'error',
                'Struktur Word tidak valid.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD XML
        |--------------------------------------------------------------------------
        */

        libxml_use_internal_errors(true);

        $dom = new DOMDocument();

        $loaded = $dom->loadXML(
            $documentXml,
            LIBXML_NOBLANKS |
            LIBXML_NOERROR |
            LIBXML_NOWARNING
        );

        if (!$loaded) {

            libxml_clear_errors();

            return back()->with(
                'error',
                'Isi file Word tidak dapat dibaca.'
            );
        }

        libxml_clear_errors();


        $xpath = new DOMXPath($dom);

        $xpath->registerNamespace(
            'w',
            'http://schemas.openxmlformats.org/wordprocessingml/2006/main'
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PARAGRAPH
        |--------------------------------------------------------------------------
        */

        $paragraphs =
            $xpath->query(
                '//w:body/w:p'
            );

        if (
            !$paragraphs ||
            $paragraphs->length === 0
        ) {
            return back()->with(
                'error',
                'Tidak ditemukan isi soal di dalam Word.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BACA PARAGRAPH
        |--------------------------------------------------------------------------
        */

        $items = [];

        foreach ($paragraphs as $paragraph) {

            $item =
                $this->readParagraph(
                    $xpath,
                    $paragraph
                );

            if (
                trim($item['text']) !== ''
            ) {
                $items[] = $item;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | EXTRACT SOAL
        |--------------------------------------------------------------------------
        */

        $questions =
            $this->extractQuestionsFromWordList(
                $items
            );

        if (
            count($questions) === 0
        ) {
            return back()->with(
                'error',
                'Soal tidak berhasil dikenali. Pastikan format Word memiliki pertanyaan dan lima pilihan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | NOMOR SOAL BERIKUTNYA
        |--------------------------------------------------------------------------
        */

        $maxNumber =
            SoalKepribadian::where(
                'bank_kepribadian_id',
                $bank->id
            )->max('nomor_soal');

        $nextNumber =
            ((int) $maxNumber) + 1;


        $successCount = 0;
        $withoutKey = 0;
        $multipleKey = 0;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            foreach (
                $questions as $question
            ) {

                if (
                    !$this->isCompleteQuestion(
                        $question
                    )
                ) {
                    continue;
                }


                $kunci =
                    $question['kunci'] ?? null;


                if ($kunci === null) {
                    $withoutKey++;
                }


                if (
                    !empty(
                        $question['multiple_key']
                    )
                ) {
                    $multipleKey++;
                }


                SoalKepribadian::create([
                    'bank_kepribadian_id' =>
                        $bank->id,

                    'nomor_soal' =>
                        $nextNumber,

                    'pertanyaan' =>
                        trim(
                            $question['pertanyaan']
                        ),

                    'pilihan_a' =>
                        trim(
                            $question['pilihan']['A']
                        ),

                    'pilihan_b' =>
                        trim(
                            $question['pilihan']['B']
                        ),

                    'pilihan_c' =>
                        trim(
                            $question['pilihan']['C']
                        ),

                    'pilihan_d' =>
                        trim(
                            $question['pilihan']['D']
                        ),

                    'pilihan_e' =>
                        trim(
                            $question['pilihan']['E']
                        ),

                    /*
                    |--------------------------------------------------------------------------
                    | KUNCI JAWABAN
                    |--------------------------------------------------------------------------
                    |
                    | Contoh:
                    | A
                    | B
                    | C
                    | D
                    | E
                    |
                    */

                    'kunci_jawaban' =>
                        $kunci,

                    /*
                    |--------------------------------------------------------------------------
                    | NILAI MAKSIMAL
                    |--------------------------------------------------------------------------
                    */

                    'nilai' => 5,

                    'status' => true,
                ]);


                $successCount++;

                $nextNumber++;
            }


            DB::commit();

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error(
                'Gagal import soal kepribadian.',
                [
                    'message' =>
                        $e->getMessage(),

                    'file' =>
                        $file->getClientOriginalName(),

                    'bank_id' =>
                        $bank->id,

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );

            return back()->with(
                'error',
                'Gagal menyimpan soal: ' .
                $e->getMessage()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK HASIL
        |--------------------------------------------------------------------------
        */

        if (
            $successCount === 0
        ) {
            return back()->with(
                'error',
                'File berhasil dibaca tetapi tidak ada soal lengkap.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PESAN
        |--------------------------------------------------------------------------
        */

        $message =
            '✓ ' .
            $successCount .
            ' soal berhasil diimpor dari Word.';


        if (
            $withoutKey > 0
        ) {

            $message .=
                ' ' .
                $withoutKey .
                ' soal belum memiliki kunci berwarna.';
        }


        if (
            $multipleKey > 0
        ) {

            $message .=
                ' ' .
                $multipleKey .
                ' soal memiliki lebih dari satu pilihan berwarna.';
        }


        return back()->with(
            'success',
            $message
        );
    }


    /*
    |--------------------------------------------------------------------------
    | READ PARAGRAPH
    |--------------------------------------------------------------------------
    */

    private function readParagraph(
        DOMXPath $xpath,
        DOMNode $paragraph
    ): array {

        /*
        |--------------------------------------------------------------------------
        | NUM ID
        |--------------------------------------------------------------------------
        */

        $numId = null;

        $numIdNode =
            $xpath->query(
                './w:pPr/w:numPr/w:numId',
                $paragraph
            );

        if (
            $numIdNode &&
            $numIdNode->length > 0
        ) {

            $node =
                $numIdNode->item(0);

            $numId =
                $node->getAttributeNS(
                    'http://schemas.openxmlformats.org/wordprocessingml/2006/main',
                    'val'
                );


            if (
                $numId === ''
            ) {

                $numId =
                    $node->getAttribute(
                        'w:val'
                    );
            }


            if (
                $numId === ''
            ) {

                $numId = null;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | TEXT
        |--------------------------------------------------------------------------
        */

        $text = '';

        $colored = false;


        $runs =
            $xpath->query(
                './w:r',
                $paragraph
            );


        if (
            $runs &&
            $runs->length > 0
        ) {

            foreach (
                $runs as $run
            ) {

                /*
                |--------------------------------------------------------------------------
                | CEK WARNA
                |--------------------------------------------------------------------------
                */

                if (
                    $this->runHasColor(
                        $xpath,
                        $run
                    )
                ) {
                    $colored = true;
                }


                /*
                |--------------------------------------------------------------------------
                | TEXT
                |--------------------------------------------------------------------------
                */

                $textNodes =
                    $xpath->query(
                        './/w:t',
                        $run
                    );


                if ($textNodes) {

                    foreach (
                        $textNodes as $textNode
                    ) {

                        $text .=
                            $textNode->textContent;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | TAB
                |--------------------------------------------------------------------------
                */

                $tabNodes =
                    $xpath->query(
                        './/w:tab',
                        $run
                    );


                if ($tabNodes) {

                    foreach (
                        $tabNodes as $tab
                    ) {

                        $text .= ' ';
                    }
                }
            }

        } else {

            $text =
                $paragraph->textContent ?? '';
        }


        /*
        |--------------------------------------------------------------------------
        | CLEAN
        |--------------------------------------------------------------------------
        */

        $text =
            str_replace(
                "\xC2\xA0",
                ' ',
                $text
            );


        $text =
            preg_replace(
                '/\s+/u',
                ' ',
                $text
            );


        $text =
            trim($text);


        return [
            'text' =>
                $text,

            'numId' =>
                $numId,

            'colored' =>
                $colored,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | CEK WARNA FONT
    |--------------------------------------------------------------------------
    |
    | Hitam:
    |
    | 000000
    | 00000000
    | AUTO
    | AUTOMATIC
    |
    | Selain itu dianggap berwarna.
    |--------------------------------------------------------------------------
    */

    private function runHasColor(
        DOMXPath $xpath,
        DOMNode $run
    ): bool {

        $colors =
            $xpath->query(
                './w:rPr/w:color',
                $run
            );


        if (
            !$colors ||
            $colors->length === 0
        ) {
            return false;
        }


        foreach (
            $colors as $color
        ) {

            $value =
                $color->getAttributeNS(
                    'http://schemas.openxmlformats.org/wordprocessingml/2006/main',
                    'val'
                );


            if (
                $value === ''
            ) {

                $value =
                    $color->getAttribute(
                        'w:val'
                    );
            }


            if (
                $value === ''
            ) {
                continue;
            }


            $value =
                strtoupper(
                    trim($value)
                );


            $value =
                ltrim(
                    $value,
                    '#'
                );


            $black = [
                '000000',
                '00000000',
                'AUTO',
                'AUTOMATIC',
            ];


            if (
                !in_array(
                    $value,
                    $black,
                    true
                )
            ) {

                return true;
            }
        }


        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | EXTRACT SOAL DARI NUMBERING WORD
    |--------------------------------------------------------------------------
    |
    | Word menggunakan:
    |
    | numId 1 = pertanyaan
    |
    | numId berbeda = pilihan
    |
    | Urutan:
    |
    | pertama = A
    | kedua   = B
    | ketiga  = C
    | keempat = D
    | kelima  = E
    |
    |--------------------------------------------------------------------------
    */

    private function extractQuestionsFromWordList(
        array $items
    ): array {

        $questions = [];

        $currentQuestion = null;


        foreach (
            $items as $item
        ) {

            $text =
                trim(
                    $item['text']
                );


            $numId =
                $item['numId'];


            $colored =
                !empty(
                    $item['colored']
                );


            /*
            |--------------------------------------------------------------------------
            | PERTANYAAN
            |--------------------------------------------------------------------------
            */

            if (
                (string) $numId === '1'
            ) {

                if (
                    $currentQuestion !== null
                ) {

                    if (
                        $this->isCompleteQuestion(
                            $currentQuestion
                        )
                    ) {

                        $questions[] =
                            $currentQuestion;
                    }
                }


                $currentQuestion = [

                    'pertanyaan' =>
                        $text,

                    'pilihan' => [

                        'A' => '',
                        'B' => '',
                        'C' => '',
                        'D' => '',
                        'E' => '',

                    ],

                    'kunci' =>
                        null,

                    'multiple_key' =>
                        false,

                    'option_index' =>
                        0,
                ];


                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | BELUM ADA PERTANYAAN
            |--------------------------------------------------------------------------
            */

            if (
                $currentQuestion === null
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | PILIHAN
            |--------------------------------------------------------------------------
            */

            if (
                $numId !== null &&
                (string) $numId !== '1'
            ) {

                $index =
                    $currentQuestion[
                        'option_index'
                    ];


                if (
                    $index >= 0 &&
                    $index <= 4
                ) {

                    $letters = [
                        'A',
                        'B',
                        'C',
                        'D',
                        'E',
                    ];


                    $letter =
                        $letters[$index];


                    /*
                    |--------------------------------------------------------------------------
                    | SIMPAN TEKS PILIHAN
                    |--------------------------------------------------------------------------
                    */

                    $currentQuestion[
                        'pilihan'
                    ][$letter] =
                        $text;


                    /*
                    |--------------------------------------------------------------------------
                    | WARNA = KUNCI
                    |--------------------------------------------------------------------------
                    */

                    if ($colored) {

                        if (
                            $currentQuestion[
                                'kunci'
                            ] === null
                        ) {

                            $currentQuestion[
                                'kunci'
                            ] =
                                $letter;

                        } else {

                            $currentQuestion[
                                'multiple_key'
                            ] = true;
                        }
                    }


                    $currentQuestion[
                        'option_index'
                    ]++;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SOAL TERAKHIR
        |--------------------------------------------------------------------------
        */

        if (
            $currentQuestion !== null
        ) {

            if (
                $this->isCompleteQuestion(
                    $currentQuestion
                )
            ) {

                $questions[] =
                    $currentQuestion;
            }
        }


        return $questions;
    }


    /*
    |--------------------------------------------------------------------------
    | CEK SOAL LENGKAP
    |--------------------------------------------------------------------------
    */

    private function isCompleteQuestion(
        array $question
    ): bool {

        if (
            !isset(
                $question['pertanyaan']
            ) ||
            trim(
                $question['pertanyaan']
            ) === ''
        ) {

            return false;
        }


        foreach (
            [
                'A',
                'B',
                'C',
                'D',
                'E',
            ] as $letter
        ) {

            if (
                !isset(
                    $question['pilihan'][$letter]
                )
            ) {

                return false;
            }


            if (
                trim(
                    $question['pilihan'][$letter]
                ) === ''
            ) {

                return false;
            }
        }


        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE SOAL
    |--------------------------------------------------------------------------
    */

    public function updateQuestion(
        Request $request,
        SoalKepribadian $soal
    ) {

        $validated =
            $request->validate([

                'pertanyaan' => [
                    'required',
                    'string',
                ],

                'pilihan_a' => [
                    'required',
                    'string',
                ],

                'pilihan_b' => [
                    'required',
                    'string',
                ],

                'pilihan_c' => [
                    'required',
                    'string',
                ],

                'pilihan_d' => [
                    'required',
                    'string',
                ],

                'pilihan_e' => [
                    'required',
                    'string',
                ],

                'kunci_jawaban' => [
                    'nullable',
                    'in:A,B,C,D,E',
                ],

                'status' => [
                    'nullable',
                ],
            ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE SOAL
        |--------------------------------------------------------------------------
        |
        | Sekarang kunci jawaban bisa diedit dari halaman admin.
        |
        */

        $soal->update([

            'pertanyaan' =>
                $validated['pertanyaan'],

            'pilihan_a' =>
                $validated['pilihan_a'],

            'pilihan_b' =>
                $validated['pilihan_b'],

            'pilihan_c' =>
                $validated['pilihan_c'],

            'pilihan_d' =>
                $validated['pilihan_d'],

            'pilihan_e' =>
                $validated['pilihan_e'],

            'kunci_jawaban' =>
                $validated['kunci_jawaban'] ?? null,

            'status' =>
                $request->boolean('status'),

            'nilai' =>
                5,
        ]);


        return back()
            ->with(
                'success',
                'Soal berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE SOAL
    |--------------------------------------------------------------------------
    */

    public function destroyQuestion(
        SoalKepribadian $soal
    ) {

        $soal->delete();


        return back()
            ->with(
                'success',
                'Soal berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE BANK
    |--------------------------------------------------------------------------
    */

    public function destroy(
        BankKepribadian $bank
    ) {

        DB::transaction(
            function () use ($bank) {

                SoalKepribadian::where(
                    'bank_kepribadian_id',
                    $bank->id
                )->delete();


                $bank->delete();
            }
        );


        return redirect()
            ->route(
                'admin.kepribadian-bank.index'
            )
            ->with(
                'success',
                'Bank soal dan seluruh soalnya berhasil dihapus.'
            );
    }
}
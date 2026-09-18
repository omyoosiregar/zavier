<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    /**
     * ============================================================
     * DAFTAR SOAL KECERMATAN
     * ============================================================
     */
    public function index()
    {
        $soals = Soal::latest()->get();

        return view(
            'admin.soal.index',
            compact('soals')
        );
    }


    /**
     * ============================================================
     * SIMPAN SOAL MANUAL
     * ============================================================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => [
                'required',
                'string',
                'max:255',
            ],

            'pertanyaan' => [
                'required',
                'string',
            ],

            'pilihan_a' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_b' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_c' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_d' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_e' => [
                'required',
                'string',
                'max:255',
            ],

            'jawaban_benar' => [
                'required',
                'in:A,B,C,D,E',
            ],

            'tingkat' => [
                'required',
                'in:Mudah,Sedang,Sulit',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        Soal::create($validated);

        return redirect()
            ->route('admin.soal.index')
            ->with(
                'success',
                'Soal berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * FORM EDIT SOAL
     * ============================================================
     */
    public function edit(Soal $soal)
    {
        return view(
            'admin.soal.edit',
            compact('soal')
        );
    }


    /**
     * ============================================================
     * UPDATE SOAL
     * ============================================================
     */
    public function update(
        Request $request,
        Soal $soal
    ) {
        $validated = $request->validate([
            'kategori' => [
                'required',
                'string',
                'max:255',
            ],

            'pertanyaan' => [
                'required',
                'string',
            ],

            'pilihan_a' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_b' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_c' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_d' => [
                'required',
                'string',
                'max:255',
            ],

            'pilihan_e' => [
                'required',
                'string',
                'max:255',
            ],

            'jawaban_benar' => [
                'required',
                'in:A,B,C,D,E',
            ],

            'tingkat' => [
                'required',
                'in:Mudah,Sedang,Sulit',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $soal->update($validated);

        return redirect()
            ->route('admin.soal.index')
            ->with(
                'success',
                'Soal berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * HAPUS SOAL
     * ============================================================
     */
    public function destroy(Soal $soal)
    {
        $soal->delete();

        return redirect()
            ->route('admin.soal.index')
            ->with(
                'success',
                'Soal berhasil dihapus.'
            );
    }


    /**
     * ============================================================
     * GENERATE SOAL OTOMATIS
     * ============================================================
     *
     * Kategori:
     *
     * Huruf
     * Angka
     * Simbol
     * Gabungan
     *
     * Konsep Kecermatan tetap dipertahankan.
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'kategori' => [
                'required',
                'in:Huruf,Angka,Simbol,Gabungan',
            ],

            'jumlah' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            'tingkat' => [
                'required',
                'in:Mudah,Sedang,Sulit',
            ],
        ]);

        $kategori = $validated['kategori'];
        $jumlah = (int) $validated['jumlah'];
        $tingkat = $validated['tingkat'];


        /*
        |--------------------------------------------------------------------------
        | LOOP GENERATE
        |--------------------------------------------------------------------------
        */

        for ($i = 0; $i < $jumlah; $i++) {

            /*
            |--------------------------------------------------------------------------
            | HURUF
            |--------------------------------------------------------------------------
            */

            if ($kategori === 'Huruf') {

                $start = rand(1, 20);

                $huruf = [];

                for ($j = 0; $j < 5; $j++) {
                    $huruf[] = chr(
                        65 + $start + $j
                    );
                }

                /*
                |--------------------------------------------------------------
                | Pola:
                | A B C D ?
                | Jawaban = E
                |--------------------------------------------------------------
                */

                $jawaban = $huruf[4];

                $pertanyaan =
                    $huruf[0] . ' ' .
                    $huruf[1] . ' ' .
                    $huruf[2] . ' ' .
                    $huruf[3] . ' ?';


                /*
                |--------------------------------------------------------------
                | Pilihan jawaban
                |--------------------------------------------------------------
                */

                $pilihan = [
                    $jawaban,

                    chr(
                        min(
                            90,
                            ord($jawaban) + 1
                        )
                    ),

                    chr(
                        max(
                            65,
                            ord($jawaban) - 1
                        )
                    ),

                    chr(
                        min(
                            90,
                            ord($jawaban) + 2
                        )
                    ),

                    chr(
                        max(
                            65,
                            ord($jawaban) - 2
                        )
                    ),
                ];

                $pilihan = array_values(
                    array_unique($pilihan)
                );


                /*
                |--------------------------------------------------------------
                | Pastikan 5 pilihan
                |--------------------------------------------------------------
                */

                while (count($pilihan) < 5) {

                    $tambahan = chr(
                        rand(65, 90)
                    );

                    if (
                        !in_array(
                            $tambahan,
                            $pilihan,
                            true
                        )
                    ) {
                        $pilihan[] = $tambahan;
                    }
                }

                shuffle($pilihan);
            }


            /*
            |--------------------------------------------------------------------------
            | ANGKA
            |--------------------------------------------------------------------------
            */

            elseif ($kategori === 'Angka') {

                $start = rand(1, 20);

                $selisih = rand(1, 5);

                $angka = [];

                for ($j = 0; $j < 5; $j++) {

                    $angka[] =
                        $start +
                        ($j * $selisih);
                }


                /*
                |--------------------------------------------------------------
                | Pola angka
                |--------------------------------------------------------------
                */

                $jawaban = $angka[4];

                $pertanyaan =
                    $angka[0] . ' ' .
                    $angka[1] . ' ' .
                    $angka[2] . ' ' .
                    $angka[3] . ' ?';


                /*
                |--------------------------------------------------------------
                | Pilihan
                |--------------------------------------------------------------
                */

                $pilihan = [
                    $jawaban,

                    $jawaban + $selisih,

                    $jawaban + 1,

                    max(
                        0,
                        $jawaban - $selisih
                    ),

                    $jawaban + 2,
                ];

                $pilihan = array_values(
                    array_unique($pilihan)
                );


                /*
                |--------------------------------------------------------------
                | Pastikan 5 pilihan
                |--------------------------------------------------------------
                */

                while (count($pilihan) < 5) {

                    $tambahan =
                        $jawaban +
                        rand(-5, 10);

                    if (
                        !in_array(
                            $tambahan,
                            $pilihan,
                            true
                        )
                    ) {
                        $pilihan[] = $tambahan;
                    }
                }

                shuffle($pilihan);
            }


            /*
            |--------------------------------------------------------------------------
            | SIMBOL
            |--------------------------------------------------------------------------
            */

            elseif ($kategori === 'Simbol') {

                $simbol = [
                    '★',
                    '●',
                    '▲',
                    '■',
                    '◆',
                    '♥',
                    '♦',
                    '♣',
                ];


                /*
                |--------------------------------------------------------------
                | Ambil simbol
                |--------------------------------------------------------------
                */

                $a = $simbol[
                    array_rand($simbol)
                ];

                $b = $simbol[
                    array_rand($simbol)
                ];

                $c = $simbol[
                    array_rand($simbol)
                ];


                /*
                |--------------------------------------------------------------
                | Pola:
                |
                | A B C A B ?
                |
                | Jawaban = C
                |--------------------------------------------------------------
                */

                $pertanyaan =
                    $a . ' ' .
                    $b . ' ' .
                    $c . ' ' .
                    $a . ' ' .
                    $b . ' ?';

                $jawaban = $c;


                /*
                |--------------------------------------------------------------
                | Pilihan
                |--------------------------------------------------------------
                */

                $pilihan = [
                    $jawaban,
                    $a,
                    $b,
                    '■',
                    '◆',
                ];

                $pilihan = array_values(
                    array_unique($pilihan)
                );


                /*
                |--------------------------------------------------------------
                | Pastikan 5 pilihan unik
                |--------------------------------------------------------------
                */

                while (count($pilihan) < 5) {

                    $tambahan = $simbol[
                        array_rand($simbol)
                    ];

                    if (
                        !in_array(
                            $tambahan,
                            $pilihan,
                            true
                        )
                    ) {
                        $pilihan[] = $tambahan;
                    }
                }

                shuffle($pilihan);
            }


            /*
            |--------------------------------------------------------------------------
            | GABUNGAN
            |--------------------------------------------------------------------------
            */

            else {

                /*
                |--------------------------------------------------------------
                | Huruf
                |--------------------------------------------------------------
                */

                $huruf1 = chr(
                    rand(65, 75)
                );

                $huruf2 = chr(
                    rand(76, 90)
                );


                /*
                |--------------------------------------------------------------
                | Angka
                |--------------------------------------------------------------
                */

                $angka1 = rand(1, 9);

                $angka2 = rand(1, 9);


                /*
                |--------------------------------------------------------------
                | Simbol
                |--------------------------------------------------------------
                */

                $simbol = [
                    '★',
                    '●',
                    '▲',
                    '■',
                    '◆',
                ];

                $simbol1 = $simbol[
                    array_rand($simbol)
                ];

                $simbol2 = $simbol[
                    array_rand($simbol)
                ];


                /*
                |--------------------------------------------------------------
                | Pola gabungan
                |--------------------------------------------------------------
                */

                $pertanyaan =
                    $huruf1 . ' ' .
                    $angka1 . ' ' .
                    $simbol1 . ' ' .
                    $huruf2 . ' ' .
                    $angka2 . ' ' .
                    $simbol2 . ' ?';


                /*
                |--------------------------------------------------------------
                | Jawaban
                |--------------------------------------------------------------
                */

                $jawaban = $huruf1;


                /*
                |--------------------------------------------------------------
                | Pilihan jawaban
                |--------------------------------------------------------------
                */

                $pilihan = [
                    $huruf1,
                    $huruf2,
                    chr(rand(65, 90)),
                    chr(rand(65, 90)),
                    chr(rand(65, 90)),
                ];

                $pilihan = array_values(
                    array_unique($pilihan)
                );


                /*
                |--------------------------------------------------------------
                | Pastikan 5 pilihan unik
                |--------------------------------------------------------------
                */

                while (count($pilihan) < 5) {

                    $tambahan = chr(
                        rand(65, 90)
                    );

                    if (
                        !in_array(
                            $tambahan,
                            $pilihan,
                            true
                        )
                    ) {
                        $pilihan[] = $tambahan;
                    }
                }

                shuffle($pilihan);
            }


            /*
            |--------------------------------------------------------------------------
            | TENTUKAN POSISI JAWABAN BENAR
            |--------------------------------------------------------------------------
            */

            $posisiJawaban = array_search(
                $jawaban,
                $pilihan,
                true
            );


            /*
            |--------------------------------------------------------------------------
            | PENGAMAN
            |--------------------------------------------------------------------------
            */

            if ($posisiJawaban === false) {

                /*
                | Jika jawaban tidak ditemukan,
                | kita paksa masuk ke pilihan pertama.
                */

                $pilihan[0] = $jawaban;

                $posisiJawaban = 0;
            }


            /*
            |--------------------------------------------------------------------------
            | UBAH POSISI MENJADI A-E
            |--------------------------------------------------------------------------
            */

            $jawabanBenar = chr(
                65 + $posisiJawaban
            );


            /*
            |--------------------------------------------------------------------------
            | SIMPAN SOAL
            |--------------------------------------------------------------------------
            */

            Soal::create([
                'kategori' => $kategori,

                'pertanyaan' => $pertanyaan,

                'pilihan_a' => (string) $pilihan[0],

                'pilihan_b' => (string) $pilihan[1],

                'pilihan_c' => (string) $pilihan[2],

                'pilihan_d' => (string) $pilihan[3],

                'pilihan_e' => (string) $pilihan[4],

                'jawaban_benar' => $jawabanBenar,

                'tingkat' => $tingkat,

                'status' => true,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE BANK SOAL KECERMATAN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.soal.index')
            ->with(
                'success',
                $jumlah .
                ' soal ' .
                $kategori .
                ' berhasil dibuat otomatis.'
            );
    }
}
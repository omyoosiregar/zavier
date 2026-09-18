<?php

namespace App\Http\Controllers;

use App\Models\PaketSoal;
use App\Models\KolomUjian;
use App\Models\SoalKecermatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketSoalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PAKET SOAL KECERMATAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pakets = PaketSoal::query()
            ->where('jenis_tes', 'Kecermatan')
            ->withCount('kolomUjians')
            ->with([
                'kolomUjians' => function ($query) {
                    $query->withCount('soalKecermatan');
                }
            ])
            ->latest()
            ->get();

        return view(
            'admin.paket-soal.index',
            compact('pakets')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE PAKET SOAL
    |--------------------------------------------------------------------------
    |
    | Setiap paket:
    |
    | - 10 kolom
    | | 1 kolom = 60 detik
    | - jumlah soal per kolom sesuai input
    | - total = 10 × jumlah soal
    |
    */

    public function generate(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'nama_paket' => [
                'required',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'jumlah_soal' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            'tingkat' => [
                'required',
                'in:Mudah,Sedang,Sulit',
            ],

            'tipe_soal' => [
                'required',
                'in:Angka,Huruf,Simbol,Campuran,Emoji,Gambar',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | KONFIGURASI
        |--------------------------------------------------------------------------
        */

        $jumlahKolom = 10;

        $jumlahSoalPerKolom =
            (int) $validated['jumlah_soal'];

        $tipeSoal =
            $validated['tipe_soal'];

        $totalSoal =
            $jumlahKolom *
            $jumlahSoalPerKolom;


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI DATABASE
        |--------------------------------------------------------------------------
        */

        $paketSoal = DB::transaction(function () use (
            $validated,
            $jumlahKolom,
            $jumlahSoalPerKolom,
            $tipeSoal
        ) {

            /*
            |--------------------------------------------------------------------------
            | BUAT PAKET
            |--------------------------------------------------------------------------
            */

            $paket = PaketSoal::create([
                'nama_paket' =>
                    $validated['nama_paket'],

                'jenis_tes' =>
                    'Kecermatan',

                'tipe_soal' =>
                    $tipeSoal,

                'keterangan' =>
                    $validated['keterangan'] ?? null,

                'jumlah_soal' =>
                    $jumlahSoalPerKolom,

                'durasi' =>
                    $jumlahKolom,

                'tingkat' =>
                    $validated['tingkat'],

                'status' =>
                    true,
            ]);


            /*
            |--------------------------------------------------------------------------
            | BUAT 10 KOLOM
            |--------------------------------------------------------------------------
            */

            for (
                $nomorKolom = 1;
                $nomorKolom <= $jumlahKolom;
                $nomorKolom++
            ) {

                /*
                |--------------------------------------------------------------------------
                | BUAT KUNCI A-E
                |--------------------------------------------------------------------------
                */

                $kunci =
                    $this->buatKunci(
                        $tipeSoal
                    );


                /*
                |--------------------------------------------------------------------------
                | SIMPAN KOLOM
                |--------------------------------------------------------------------------
                */

                $kolom = KolomUjian::create([
                    'paket_soal_id' =>
                        $paket->id,

                    'nomor_kolom' =>
                        $nomorKolom,

                    'waktu_detik' =>
                        60,

                    'kunci' =>
                        $kunci,
                ]);


                /*
                |--------------------------------------------------------------------------
                | BUAT SOAL DALAM KOLOM
                |--------------------------------------------------------------------------
                */

                for (
                    $nomorSoal = 1;
                    $nomorSoal <= $jumlahSoalPerKolom;
                    $nomorSoal++
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | ARRAY KUNCI
                    |--------------------------------------------------------------------------
                    */

                    $pilihan = array_values(
                        $kunci
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | PILIH KARAKTER YANG DIHILANGKAN
                    |--------------------------------------------------------------------------
                    */

                    $posisiHilang =
                        random_int(0, 4);


                    /*
                    |--------------------------------------------------------------------------
                    | JAWABAN BENAR
                    |--------------------------------------------------------------------------
                    */

                    $jawabanBenar =
                        chr(
                            65 + $posisiHilang
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | BUAT PERTANYAAN
                    |--------------------------------------------------------------------------
                    */

                    $pertanyaan =
                        $this->buatPertanyaan(
                            $pilihan,
                            $posisiHilang
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | SIMPAN SOAL
                    |--------------------------------------------------------------------------
                    */

                    SoalKecermatan::create([
                        'kolom_ujian_id' =>
                            $kolom->id,

                        'nomor_soal' =>
                            $nomorSoal,

                        'pertanyaan' =>
                            $pertanyaan,

                        'jawaban_benar' =>
                            $jawabanBenar,

                        'status' =>
                            true,
                    ]);
                }
            }


            return $paket;
        });


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HALAMAN GENERATOR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.paket-soal')
            ->with(
                'success',
                'Paket "'
                . $paketSoal->nama_paket
                . '" berhasil dibuat. '
                . $totalSoal
                . ' soal dalam '
                . $jumlahKolom
                . ' kolom.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | MEMBUAT KUNCI A-E
    |--------------------------------------------------------------------------
    */

    private function buatKunci(string $tipeSoal): array
    {
        /*
        |--------------------------------------------------------------------------
        | ANGKA
        |--------------------------------------------------------------------------
        */

        if ($tipeSoal === 'Angka') {

            $karakter =
                range(
                    '0',
                    '9'
                );

            shuffle($karakter);

            $pilihan =
                array_slice(
                    $karakter,
                    0,
                    5
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HURUF
        |--------------------------------------------------------------------------
        */

        elseif ($tipeSoal === 'Huruf') {

            $karakter =
                range(
                    'A',
                    'Z'
                );

            shuffle($karakter);

            $pilihan =
                array_slice(
                    $karakter,
                    0,
                    5
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMBOL
        |--------------------------------------------------------------------------
        */

        elseif ($tipeSoal === 'Simbol') {

            $karakter = [
                '!',
                '@',
                '#',
                '$',
                '%',
                '&',
                '*',
                '+',
                '-',
                '=',
                '?',
                '/',
                '^',
                '~',
            ];

            shuffle($karakter);

            $pilihan =
                array_slice(
                    $karakter,
                    0,
                    5
                );
        }


        /*
        |--------------------------------------------------------------------------
        | EMOJI
        |--------------------------------------------------------------------------
        */

        elseif ($tipeSoal === 'Emoji') {

            $karakter = [
                '😀',
                '😃',
                '😄',
                '😁',
                '😆',
                '😅',
                '😂',
                '🤣',
                '😊',
                '😇',
                '🙂',
                '🙃',
                '😉',
                '😌',
                '😍',
                '🥰',
                '😘',
                '😎',
                '🤓',
                '🧐',
                '🤨',
                '🤔',
                '🤭',
                '🤫',
                '🤗',
                '😐',
                '😑',
                '😶',
                '🙄',
                '😏',
                '😣',
                '😥',
                '😮',
                '🤐',
                '😯',
                '😪',
                '😫',
                '😴',
                '😛',
                '😜',
                '🤪',
                '😝',
                '🤑',
                '🤠',
                '😡',
                '😠',
                '🤬',
                '😈',
                '👿',
                '💀',
                '☠️',
                '👻',
                '👽',
                '🤖',
                '🎃',
                '😱',
                '😨',
                '😰',
                '😢',
                '😭',
                '😤',
                '😳',
                '🥳',
                '🤩',
                '🥺',
                '🤯',
                '😵',
            ];

            shuffle($karakter);

            $pilihan =
                array_slice(
                    $karakter,
                    0,
                    5
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GAMBAR
        |--------------------------------------------------------------------------
        |
        | Untuk struktur database sekarang, pertanyaan disimpan sebagai text.
        | Maka tipe Gambar menggunakan simbol visual/emoji sebagai placeholder.
        | Jika nanti ingin gambar file asli, database/view soal perlu diperluas.
        |
        */

        elseif ($tipeSoal === 'Gambar') {

            $karakter = [
                '🏔️',
                '🛑',
                '🚦',
                '🚗',
                '🏍️',
                '🚲',
                '🌳',
                '🏠',
                '🚧',
                '☀️',
                '🌙',
                '⭐',
                '☁️',
                '🌊',
                '✈️',
                '🚢',
                '🏫',
                '🏥',
                '🚑',
                '🚒',
            ];

            shuffle($karakter);

            $pilihan =
                array_slice(
                    $karakter,
                    0,
                    5
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CAMPURAN
        |--------------------------------------------------------------------------
        */

        else {

            $huruf =
                range(
                    'A',
                    'Z'
                );

            $angka =
                range(
                    '0',
                    '9'
                );

            $simbol = [
                '!',
                '@',
                '#',
                '$',
                '%',
                '&',
                '*',
                '+',
                '-',
                '=',
                '?',
            ];


            shuffle($huruf);
            shuffle($angka);
            shuffle($simbol);


            /*
            | Minimal:
            | 1 huruf
            | 1 angka
            | 1 simbol
            */

            $pilihan = [
                $huruf[0],
                $angka[0],
                $simbol[0],
            ];


            /*
            | Tambahkan 2 karakter lainnya
            */

            $tambahan =
                array_merge(
                    array_slice($huruf, 1),
                    array_slice($angka, 1),
                    array_slice($simbol, 1)
                );

            shuffle($tambahan);


            foreach ($tambahan as $karakter) {

                if (
                    !in_array(
                        $karakter,
                        $pilihan,
                        true
                    )
                ) {

                    $pilihan[] =
                        $karakter;
                }


                if (
                    count($pilihan) >= 5
                ) {
                    break;
                }
            }

            shuffle($pilihan);
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN 5 KARAKTER
        |--------------------------------------------------------------------------
        */

        $pilihan =
            array_values(
                array_slice(
                    $pilihan,
                    0,
                    5
                )
            );


        /*
        |--------------------------------------------------------------------------
        | KEMBALIKAN A-E
        |--------------------------------------------------------------------------
        */

        return [
            'A' => $pilihan[0],
            'B' => $pilihan[1],
            'C' => $pilihan[2],
            'D' => $pilihan[3],
            'E' => $pilihan[4],
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | MEMBUAT PERTANYAAN
    |--------------------------------------------------------------------------
    */

    private function buatPertanyaan(
        array $pilihan,
        int $posisiHilang
    ): string {

        /*
        | Hapus karakter yang menjadi jawaban.
        */

        unset(
            $pilihan[$posisiHilang]
        );


        /*
        | Acak posisi karakter.
        */

        shuffle(
            $pilihan
        );


        /*
        | Gabungkan menjadi pertanyaan.
        */

        return implode(
            ' ',
            $pilihan
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PAKET
    |--------------------------------------------------------------------------
    */

    public function edit(PaketSoal $paketSoal)
    {
        abort_unless(
            $paketSoal->jenis_tes === 'Kecermatan',
            404
        );

        return view(
            'admin.paket-soal.edit',
            compact('paketSoal')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PAKET
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        PaketSoal $paketSoal
    ) {

        abort_unless(
            $paketSoal->jenis_tes === 'Kecermatan',
            404
        );


        $validated = $request->validate([
            'nama_paket' => [
                'required',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'jumlah_soal' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            'tingkat' => [
                'required',
                'in:Mudah,Sedang,Sulit',
            ],

            'tipe_soal' => [
                'required',
                'in:Angka,Huruf,Simbol,Campuran,Emoji,Gambar',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);


        $paketSoal->update([
            'nama_paket' =>
                $validated['nama_paket'],

            'jenis_tes' =>
                'Kecermatan',

            'tipe_soal' =>
                $validated['tipe_soal'],

            'keterangan' =>
                $validated['keterangan'] ?? null,

            'jumlah_soal' =>
                (int) $validated['jumlah_soal'],

            'durasi' =>
                10,

            'tingkat' =>
                $validated['tingkat'],

            'status' =>
                (bool) $validated['status'],
        ]);


        return redirect()
            ->route('admin.paket-soal')
            ->with(
                'success',
                'Paket soal berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS PAKET
    |--------------------------------------------------------------------------
    */

    public function destroy(
        PaketSoal $paketSoal
    ) {

        abort_unless(
            $paketSoal->jenis_tes === 'Kecermatan',
            404
        );


        $paketSoal->delete();


        return redirect()
            ->route('admin.paket-soal')
            ->with(
                'success',
                'Paket soal berhasil dihapus.'
            );
    }
}
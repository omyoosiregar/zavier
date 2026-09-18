<?php

namespace App\Http\Controllers;

use App\Models\PaketSoal;
use App\Models\BankKepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketKepribadianController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PAKET KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pakets = PaketSoal::where(
            'jenis_tes',
            'Kepribadian'
        )
        ->latest()
        ->get();

        return view(
            'admin.paket-kepribadian.index',
            compact('pakets')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM BUAT PAKET
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $banks = BankKepribadian::where(
            'status',
            true
        )
        ->withCount([
            'soal' => function ($query) {
                $query->where(
                    'status',
                    true
                );
            }
        ])
        ->latest()
        ->get();

        return view(
            'admin.paket-kepribadian.create',
            compact('banks')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PAKET
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request
    ) {
        $data = $request->validate([
            'nama_paket' => [
                'required',
                'string',
                'max:255'
            ],

            'keterangan' => [
                'nullable',
                'string'
            ],

            'bank_id' => [
                'required',
                'exists:bank_kepribadian,id'
            ],

            'jumlah_soal' => [
                'required',
                'integer',
                'min:1'
            ],

            'durasi' => [
                'required',
                'integer',
                'min:1'
            ],

            'tingkat' => [
                'required',
                'in:Mudah,Sedang,Sulit'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil bank soal
        |--------------------------------------------------------------------------
        */

        $bank = BankKepribadian::with([
            'soal' => function ($query) {

                $query->where(
                    'status',
                    true
                )
                ->orderBy(
                    'nomor_soal'
                );
            }
        ])
        ->findOrFail(
            $data['bank_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Acak soal
        |--------------------------------------------------------------------------
        */

        $soal = $bank->soal
            ->shuffle()
            ->take(
                $data['jumlah_soal']
            );


        /*
        |--------------------------------------------------------------------------
        | Cek jumlah soal
        |--------------------------------------------------------------------------
        */

        if (
            $soal->count() <
            $data['jumlah_soal']
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah soal aktif di bank belum mencukupi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PAKET + SOAL
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $data,
                $soal
            ) {

                $paket = PaketSoal::create([
                    'nama_paket' =>
                        $data['nama_paket'],

                    'jenis_tes' =>
                        'Kepribadian',

                    'tipe_soal' =>
                        'Pilihan Ganda',

                    'keterangan' =>
                        $data['keterangan'] ?? null,

                    'jumlah_soal' =>
                        $soal->count(),

                    'durasi' =>
                        $data['durasi'],

                    'tingkat' =>
                        $data['tingkat'],

                    'status' =>
                        true,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Masukkan soal ke pivot
                |--------------------------------------------------------------------------
                */

                foreach (
                    $soal->values()
                    as $index => $item
                ) {

                    DB::table(
                        'paket_kepribadian_soal'
                    )->insert([
                        'paket_soal_id' =>
                            $paket->id,

                        'soal_kepribadian_id' =>
                            $item->id,

                        'nomor_urut' =>
                            $index + 1,

                        'created_at' =>
                            now(),

                        'updated_at' =>
                            now(),
                    ]);
                }
            }
        );


        return redirect()
            ->route(
                'admin.paket-kepribadian.index'
            )
            ->with(
                'success',
                'Paket soal kepribadian berhasil dibuat.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT PAKET
    |--------------------------------------------------------------------------
    */

    public function edit(
        PaketSoal $paket
    ) {
        abort_unless(
            $paket->jenis_tes === 'Kepribadian',
            404
        );


        $banks = BankKepribadian::where(
            'status',
            true
        )
        ->withCount([
            'soal' => function ($query) {
                $query->where(
                    'status',
                    true
                );
            }
        ])
        ->latest()
        ->get();


        $items = DB::table(
            'paket_kepribadian_soal'
        )
        ->join(
            'soal_kepribadian',
            'soal_kepribadian.id',
            '=',
            'paket_kepribadian_soal.soal_kepribadian_id'
        )
        ->where(
            'paket_soal_id',
            $paket->id
        )
        ->orderBy(
            'nomor_urut'
        )
        ->select(
            'soal_kepribadian.*',
            'paket_kepribadian_soal.nomor_urut'
        )
        ->get();


        return view(
            'admin.paket-kepribadian.edit',
            compact(
                'paket',
                'banks',
                'items'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PAKET
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        PaketSoal $paket
    ) {
        abort_unless(
            $paket->jenis_tes === 'Kepribadian',
            404
        );


        $data = $request->validate([
            'nama_paket' => [
                'required',
                'string',
                'max:255'
            ],

            'keterangan' => [
                'nullable',
                'string'
            ],

            'durasi' => [
                'required',
                'integer',
                'min:1'
            ],

            'tingkat' => [
                'required',
                'in:Mudah,Sedang,Sulit'
            ],

            'status' => [
                'nullable'
            ],
        ]);


        $data['status'] =
            $request->boolean('status');


        $paket->update([
            'nama_paket' =>
                $data['nama_paket'],

            'keterangan' =>
                $data['keterangan'] ?? null,

            'durasi' =>
                $data['durasi'],

            'tingkat' =>
                $data['tingkat'],

            'status' =>
                $data['status'],
        ]);


        return back()
            ->with(
                'success',
                'Paket berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS PAKET
    |--------------------------------------------------------------------------
    */

    public function destroy(
        PaketSoal $paket
    ) {
        abort_unless(
            $paket->jenis_tes === 'Kepribadian',
            404
        );


        DB::transaction(
            function () use ($paket) {

                DB::table(
                    'paket_kepribadian_soal'
                )
                ->where(
                    'paket_soal_id',
                    $paket->id
                )
                ->delete();


                $paket->delete();
            }
        );


        return back()
            ->with(
                'success',
                'Paket berhasil dihapus.'
            );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaketSoal;
use App\Models\BankKepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $jumlahMentor = User::where('role', 'mentor')->count();

        $jumlahMurid = User::where('role', 'murid')->count();

        $jumlahPaket = PaketSoal::count();
        $jumlahBankKepribadian = BankKepribadian::count();
        $jumlahPaketKepribadian = PaketSoal::where('jenis_tes', 'Kepribadian')->count();

        return view('admin.dashboard', compact(
            'jumlahMentor', 'jumlahMurid', 'jumlahPaket',
            'jumlahBankKepribadian', 'jumlahPaketKepribadian'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | DATA MURID
    |--------------------------------------------------------------------------
    */

    public function murid()
    {
        $murids = User::where('role', 'murid')
            ->latest()
            ->get();

        return view('admin.murid.index', compact('murids'));
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH MURID
    |--------------------------------------------------------------------------
    */

    public function storeMurid(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => 'required|min:6',
        ]);


        User::create([
            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

            'role' => 'murid',
        ]);


        return redirect()
            ->route('admin.murid')
            ->with(
                'success',
                'Murid berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT MURID
    |--------------------------------------------------------------------------
    */

    public function editMurid(User $user)
    {
        if ($user->role !== 'murid') {

            return redirect()
                ->route('admin.murid')
                ->with(
                    'error',
                    'Data yang dipilih bukan murid.'
                );
        }

        return view(
            'admin.murid.edit',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE MURID
    |--------------------------------------------------------------------------
    */

    public function updateMurid(
        Request $request,
        User $user
    ) {
        if ($user->role !== 'murid') {

            return redirect()
                ->route('admin.murid')
                ->with(
                    'error',
                    'Data yang dipilih bukan murid.'
                );
        }


        $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'password' => 'nullable|min:6',
        ]);


        $user->name = $request->name;

        $user->email = $request->email;


        if ($request->filled('password')) {

            $user->password = Hash::make(
                $request->password
            );
        }


        $user->save();


        return redirect()
            ->route('admin.murid')
            ->with(
                'success',
                'Data murid berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS MURID
    |--------------------------------------------------------------------------
    */

    public function destroyMurid(User $user)
    {
        if ($user->role !== 'murid') {

            return redirect()
                ->route('admin.murid')
                ->with(
                    'error',
                    'Data yang dipilih bukan murid.'
                );
        }


        $user->delete();


        return redirect()
            ->route('admin.murid')
            ->with(
                'success',
                'Murid berhasil dihapus.'
            );
    }
}
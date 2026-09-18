<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ==========================================
    // MENTOR - TAMPILKAN
    // ==========================================
    public function mentor()
    {
        $mentors = User::where('role', 'mentor')
            ->latest()
            ->get();

        return view('admin.mentor.index', compact('mentors'));
    }


    // ==========================================
    // MENTOR - TAMBAH
    // ==========================================
    public function storeMentor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mentor',
        ]);

        return redirect()
            ->route('admin.mentor')
            ->with('success', 'Mentor berhasil ditambahkan.');
    }


    // ==========================================
    // MENTOR - EDIT
    // ==========================================
    public function editMentor(User $user)
    {
        if ($user->role !== 'mentor') {
            abort(404);
        }

        return view('admin.mentor.edit', compact('user'));
    }


    // ==========================================
    // MENTOR - UPDATE
    // ==========================================
    public function updateMentor(Request $request, User $user)
    {
        if ($user->role !== 'mentor') {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.mentor')
            ->with('success', 'Data mentor berhasil diperbarui.');
    }


    // ==========================================
    // MURID - TAMPILKAN
    // ==========================================
    public function murid()
    {
        $murids = User::where('role', 'murid')
            ->latest()
            ->get();

        return view('admin.murid.index', compact('murids'));
    }


    // ==========================================
    // MURID - TAMBAH
    // ==========================================
    public function storeMurid(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'murid',
        ]);

        return redirect()
            ->route('admin.murid')
            ->with('success', 'Murid berhasil ditambahkan.');
    }

    // ==========================================
// MURID - EDIT
// ==========================================
public function editMurid(User $user)
{
    if ($user->role !== 'murid') {
        abort(404);
    }

    return view('admin.murid.edit', compact('user'));
}


// ==========================================
// MURID - UPDATE
// ==========================================
public function updateMurid(Request $request, User $user)
{
    if ($user->role !== 'murid') {
        abort(404);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()
        ->route('admin.murid')
        ->with('success', 'Data murid berhasil diperbarui.');
}


// ==========================================
// MURID - HAPUS
// ==========================================
public function destroyMurid(User $user)
{
    if ($user->role !== 'murid') {
        return back()->with(
            'error',
            'Yang dapat dihapus hanya akun Murid.'
        );
    }

    $user->delete();

    return redirect()
        ->route('admin.murid')
        ->with('success', 'Murid berhasil dihapus.');
}

    // ==========================================
    // HAPUS USER
    // ==========================================
    public function destroy(User $user)
    {
        if ($user->role === 'super_admin') {
            return back()->with(
                'error',
                'Super Admin tidak dapat dihapus.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'Data berhasil dihapus.'
        );
    }
}
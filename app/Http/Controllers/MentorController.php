<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = User::where('role', 'mentor')
            ->latest()
            ->get();

        return view('admin.mentor.index', compact('mentors'));
    }

    public function create()
    {
        return view('admin.mentor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mentor',
        ]);

        return redirect()
            ->route('admin.mentor.index')
            ->with('success', 'Mentor berhasil ditambahkan.');
    }

    public function edit(User $mentor)
    {
        if ($mentor->role !== 'mentor') {
            abort(404);
        }

        return view('admin.mentor.edit', compact('mentor'));
    }

    public function update(Request $request, User $mentor)
    {
        if ($mentor->role !== 'mentor') {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mentor->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:6|confirmed',
            ]);

            $data['password'] = Hash::make($request->password);
        }

        $mentor->update($data);

        return redirect()
            ->route('admin.mentor.index')
            ->with('success', 'Data mentor berhasil diperbarui.');
    }

    public function destroy(User $mentor)
    {
        if ($mentor->role !== 'mentor') {
            abort(404);
        }

        $mentor->delete();

        return redirect()
            ->route('admin.mentor.index')
            ->with('success', 'Mentor berhasil dihapus.');
    }
}
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Mentor - POLRI CERMAT</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<div style="padding:40px;max-width:700px;margin:auto">

    <h1>Edit Mentor</h1>

    <p>Perbarui data mentor.</p>

    @if($errors->any())

        <div style="
            background:#fee2e2;
            padding:15px;
            margin-bottom:20px;
        ">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        method="POST"
        action="{{ route('admin.mentor.update', $user) }}"
    >

        @csrf

        @method('PUT')


        <p>

            <label>Nama</label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                style="width:100%;padding:10px"
            >

        </p>


        <p>

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                style="width:100%;padding:10px"
            >

        </p>


        <p>

            <label>No. HP</label>

            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp', $user->no_hp) }}"
                style="width:100%;padding:10px"
            >

        </p>


        <p>

            <label>Password Baru</label>

            <input
                type="password"
                name="password"
                style="width:100%;padding:10px"
            >

            <small>
                Kosongkan jika tidak ingin mengganti password.
            </small>

        </p>


        <p>

            <label>Konfirmasi Password Baru</label>

            <input
                type="password"
                name="password_confirmation"
                style="width:100%;padding:10px"
            >

        </p>


        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.mentor') }}">
            Kembali
        </a>

    </form>

</div>

</body>

</html>
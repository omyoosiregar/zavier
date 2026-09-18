<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Murid - POLRI CERMAT</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<div style="padding:40px">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:30px;
    ">

        <div>

            <h1>Data Murid</h1>

            <p>
                Kelola seluruh murid POLRI CERMAT.
            </p>

        </div>

        <a href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>

    </div>


    @if(session('success'))

        <div style="
            background:#d1fae5;
            padding:15px;
            margin-bottom:20px;
        ">

            {{ session('success') }}

        </div>

    @endif


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


    <button onclick="document.getElementById('formTambah').style.display='block'">
        + Tambah Murid
    </button>


    <div id="formTambah"
         style="
            display:none;
            border:1px solid #ddd;
            padding:25px;
            margin:30px 0;
         ">

        <h3>Tambah Murid</h3>

        <form method="POST"
              action="{{ route('admin.murid.store') }}">

            @csrf

            <p>
                <label>Nama</label><br>

                <input
                    type="text"
                    name="name"
                    required
                    style="width:100%;padding:10px"
                >
            </p>

            <p>
                <label>Email</label><br>

                <input
                    type="email"
                    name="email"
                    required
                    style="width:100%;padding:10px"
                >
            </p>

            <p>
                <label>No. HP</label><br>

                <input
                    type="text"
                    name="no_hp"
                    style="width:100%;padding:10px"
                >
            </p>

            <p>
                <label>Password</label><br>

                <input
                    type="password"
                    name="password"
                    required
                    style="width:100%;padding:10px"
                >
            </p>

            <p>
                <label>Konfirmasi Password</label><br>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    style="width:100%;padding:10px"
                >
            </p>

            <button type="submit">
                Simpan Murid
            </button>

        </form>

    </div>


    <table width="100%"
           border="1"
           cellpadding="12"
           cellspacing="0">

        <thead>

            <tr>

                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($murids as $murid)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $murid->name }}
                    </td>

                    <td>
                        {{ $murid->email }}
                    </td>

                    <td>
                        {{ $murid->no_hp ?? '-' }}
                    </td>

                    <td>

                        @if($murid->status)

                            <span style="color:green">
                                Aktif
                            </span>

                        @else

                            <span style="color:red">
                                Nonaktif
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('admin.murid.edit', $murid) }}">
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.murid.toggle', $murid) }}"
                            style="display:inline"
                        >

                            @csrf
                            @method('PATCH')

                            <button type="submit">

                                {{ $murid->status
                                    ? 'Nonaktifkan'
                                    : 'Aktifkan'
                                }}

                            </button>

                        </form>

                        <form
                            method="POST"
                            action="{{ route('admin.murid.destroy', $murid) }}"
                            style="display:inline"
                            onsubmit="return confirm('Yakin ingin menghapus murid ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" align="center">
                        Belum ada data murid.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <div style="margin-top:20px">

        {{ $murids->links() }}

    </div>

</div>

</body>

</html>
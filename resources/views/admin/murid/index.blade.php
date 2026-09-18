<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Murid - Polri Cermat</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1f2937;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* HEADER */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .title h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .title p {
            color: #6b7280;
            font-size: 14px;
        }

        /* BUTTON */

        .btn {
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-back {
            background: white;
            color: #374151;
            border: 1px solid #e5e7eb;
            margin-right: 8px;
        }

        .btn-back:hover {
            background: #f8fafc;
        }

        /* CARD */

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        /* TABLE */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            padding: 16px;
            text-align: left;
            font-size: 13px;
            color: #64748b;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        .number {
            width: 60px;
            color: #64748b;
        }

        /* ROLE */

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #dbeafe;
            color: #2563eb;
            font-size: 12px;
            font-weight: 600;
        }

        /* AKSI */

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }

        .btn-edit:hover {
            background: #2563eb;
            color: white;
        }

        .btn-delete {
            background: #fff1f2;
            color: #dc2626;
            border: 1px solid #fecdd3;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
        }

        /* EMPTY */

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty h3 {
            margin-bottom: 8px;
            color: #64748b;
        }

        /* ALERT */

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* MODAL TAMBAH */

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.55);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            width: 420px;
            max-width: 90%;
            background: white;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        .modal-header {
            margin-bottom: 22px;
        }

        .modal-header h2 {
            margin-bottom: 5px;
        }

        .modal-header p {
            color: #6b7280;
            font-size: 13px;
        }

        /* FORM */

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dbe1ea;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #2563eb;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 22px;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        /* MOBILE */

        @media (max-width: 700px) {

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .card {
                overflow-x: auto;
            }

            table {
                min-width: 850px;
            }

        }

    </style>

</head>


<body>

<div class="container">


    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}

    <div class="header">

        <div class="title">

            <h1>
                👨‍🎓 Data Murid
            </h1>

            <p>
                Kelola data peserta latihan soal kecermatan POLRI
            </p>

        </div>


        <div>

            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-back">

                ← Dashboard

            </a>


            <button
                class="btn btn-primary"
                onclick="openModal()">

                + Tambah Murid

            </button>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- PESAN BERHASIL --}}
    {{-- ========================= --}}

    @if(session('success'))

        <div class="alert alert-success">

            ✅ {{ session('success') }}

        </div>

    @endif


    {{-- ========================= --}}
    {{-- PESAN ERROR --}}
    {{-- ========================= --}}

    @if(session('error'))

        <div class="alert alert-error">

            ❌ {{ session('error') }}

        </div>

    @endif


    {{-- ========================= --}}
    {{-- ERROR VALIDASI --}}
    {{-- ========================= --}}

    @if($errors->any())

        <div class="alert alert-error">

            <strong>
                Terjadi kesalahan:
            </strong>

            <ul style="margin-top: 8px; padding-left: 20px;">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================= --}}
    {{-- TABEL MURID --}}
    {{-- ========================= --}}

    <div class="card">

        @if($murids->count() > 0)

            <table>

                <thead>

                    <tr>

                        <th class="number">
                            No
                        </th>

                        <th>
                            Nama Murid
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Terdaftar
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($murids as $index => $murid)

                        <tr>

                            {{-- NO --}}

                            <td>
                                {{ $index + 1 }}
                            </td>


                            {{-- NAMA --}}

                            <td>

                                <strong>
                                    {{ $murid->name }}
                                </strong>

                            </td>


                            {{-- EMAIL --}}

                            <td>

                                {{ $murid->email }}

                            </td>


                            {{-- ROLE --}}

                            <td>

                                <span class="badge">

                                    MURID

                                </span>

                            </td>


                            {{-- TANGGAL --}}

                            <td>

                                {{ $murid->created_at->format('d M Y') }}

                            </td>


                            {{-- AKSI --}}

                            <td>

                                <div class="action-buttons">


                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route('admin.murid.edit', $murid->id) }}"
                                        class="btn btn-edit">

                                        ✏️ Edit

                                    </a>


                                    {{-- HAPUS --}}

                                    <form
                                        action="{{ route('admin.murid.destroy', $murid->id) }}"
                                        method="POST"
                                        style="display:inline;"

                                        onsubmit="return confirm(
                                            'Apakah Anda yakin ingin menghapus murid {{ $murid->name }}? Data yang sudah dihapus tidak dapat dikembalikan.'
                                        );"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="btn btn-delete">

                                            🗑️ Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                <h3>
                    Belum ada murid
                </h3>

                <p>
                    Silakan tambahkan murid pertama.
                </p>

            </div>

        @endif

    </div>

</div>



{{-- ================================================= --}}
{{-- MODAL TAMBAH MURID --}}
{{-- ================================================= --}}

<div
    class="modal"
    id="modalMurid"
>


    <div class="modal-content">


        <div class="modal-header">

            <h2>
                Tambah Murid
            </h2>

            <p>
                Masukkan data akun murid baru.
            </p>

        </div>


        <form
            action="{{ route('admin.murid.store') }}"
            method="POST"
        >

            @csrf


            {{-- NAMA --}}

            <div class="form-group">

                <label>
                    Nama Murid
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="Contoh: Ahmad Fauzan"
                    required
                >

            </div>


            {{-- EMAIL --}}

            <div class="form-group">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="murid@email.com"
                    required
                >

            </div>


            {{-- PASSWORD --}}

            <div class="form-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Minimal 6 karakter"
                    required
                >

            </div>


            {{-- BUTTON --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-cancel"
                    onclick="closeModal()"
                >

                    Batal

                </button>


                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    Simpan Murid

                </button>

            </div>

        </form>

    </div>

</div>



<script>

    // =========================
    // BUKA MODAL
    // =========================

    function openModal() {

        document
            .getElementById('modalMurid')
            .style.display = 'flex';

    }


    // =========================
    // TUTUP MODAL
    // =========================

    function closeModal() {

        document
            .getElementById('modalMurid')
            .style.display = 'none';

    }


    // =========================
    // KLIK DI LUAR MODAL
    // =========================

    window.onclick = function(event) {

        const modal =
            document.getElementById('modalMurid');

        if (event.target === modal) {

            closeModal();

        }

    }

</script>


</body>

</html>
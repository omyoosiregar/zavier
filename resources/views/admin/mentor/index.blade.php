<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Mentor - POLRI CERMAT</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f7fb;
            color: #1e293b;
        }

        .container {
            padding: 35px;
            max-width: 1300px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
        }

        .header p {
            color: #64748b;
            margin-top: 7px;
        }

        .btn {
            border: 0;
            padding: 11px 18px;
            border-radius: 9px;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-edit {
            background: #eff6ff;
            color: #2563eb;
        }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .card {
            background: white;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            padding: 25px;
        }

        .success {
            background: #ecfdf5;
            color: #047857;
            padding: 13px 17px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .error {
            background: #fef2f2;
            color: #b91c1c;
            padding: 13px 17px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            text-align: left;
            padding: 14px;
            font-size: 12px;
            color: #64748b;
        }

        td {
            padding: 15px 14px;
            border-top: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            background: #dcfce7;
            color: #166534;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .55);
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .modal-box {
            background: white;
            width: 430px;
            max-width: 90%;
            padding: 25px;
            border-radius: 15px;
        }

        .modal-box h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 20px;
        }

        @media(max-width:700px) {
            .container {
                padding: 15px;
            }

            table {
                min-width: 700px;
            }

            .card {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h1>👨‍🏫 Data Mentor</h1>
            <p>Kelola akun mentor POLRI CERMAT</p>
        </div>

        <div>
            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-edit">
                ← Dashboard
            </a>

            <button
                onclick="openModal()"
                class="btn btn-primary">
                + Tambah Mentor
            </button>
        </div>

    </div>


    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif


    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif


    @if($errors->any())
        <div class="error">

            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>
    @endif


    <div class="card">

        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($mentors as $mentor)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        <strong>
                            {{ $mentor->name }}
                        </strong>
                    </td>

                    <td>
                        {{ $mentor->email }}
                    </td>

                    <td>
                        <span class="badge">
                            Mentor
                        </span>
                    </td>

                    <td>
                        {{ $mentor->created_at->format('d/m/Y') }}
                    </td>

                    <td>

                        <div class="actions">

                            <a
                                href="{{ route('admin.mentor.edit', $mentor->id) }}"
                                class="btn btn-edit">
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.mentor.destroy', $mentor->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus mentor ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-delete"
                                    type="submit">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" style="text-align:center;padding:40px;color:#64748b">

                        👨‍🏫 Belum ada data mentor.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- MODAL TAMBAH MENTOR -->

<div class="modal" id="modal">

    <div class="modal-box">

        <h2>Tambah Mentor</h2>

        <form
            action="{{ route('admin.mentor.store') }}"
            method="POST">

            @csrf

            <div class="form-group">

                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama mentor"
                    required>

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="mentor@email.com"
                    required>

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Minimal 6 karakter"
                    required>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    onclick="closeModal()"
                    class="btn btn-delete">

                    Batal

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Simpan Mentor

                </button>

            </div>

        </form>

    </div>

</div>


<script>

function openModal() {
    document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

</script>

</body>

</html>
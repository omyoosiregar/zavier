<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Mentor - POLRI CERMAT</title>

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
            max-width: 700px;
            margin: auto;
            padding: 40px 20px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
        }

        .header p {
            color: #64748b;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 5px 20px rgba(15,23,42,.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #2563eb;
        }

        .help {
            color: #64748b;
            font-size: 11px;
            margin-top: 6px;
        }

        .error {
            background: #fef2f2;
            color: #b91c1c;
            padding: 14px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 18px;
            border: 0;
            border-radius: 9px;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-back {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-save {
            background: #2563eb;
            color: white;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <h1>✏️ Edit Mentor</h1>

        <p>
            Perbarui informasi akun mentor
        </p>

    </div>


    @if($errors->any())

        <div class="error">

            @foreach($errors->all() as $error)

                <div>
                    • {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    <div class="card">

        <form
            action="{{ route('admin.mentor.update', $user->id) }}"
            method="POST">

            @csrf

            @method('PUT')


            <div class="form-group">

                <label>
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required>

            </div>


            <div class="form-group">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required>

            </div>


            <div class="form-group">

                <label>
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Kosongkan jika tidak ingin mengubah password">

                <div class="help">
                    Minimal 6 karakter. Kosongkan jika password tetap.
                </div>

            </div>


            <div class="buttons">

                <a
                    href="{{ route('admin.mentor') }}"
                    class="btn btn-back">

                    ← Kembali

                </a>


                <button
                    type="submit"
                    class="btn btn-save">

                    💾 Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>
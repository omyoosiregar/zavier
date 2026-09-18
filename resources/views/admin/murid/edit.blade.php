<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Murid - POLRI Cermat</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">
                        Edit Data Murid
                    </h4>

                </div>


                <div class="card-body">

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('admin.murid.update', $user->id) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        {{-- NAMA --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Murid
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}"
                                required
                            >

                        </div>


                        {{-- EMAIL --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required
                            >

                        </div>


                        {{-- PASSWORD --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengubah password"
                            >

                            <small class="text-muted">
                                Minimal 6 karakter.
                            </small>

                        </div>


                        {{-- BUTTON --}}

                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('admin.murid') }}"
                                class="btn btn-secondary"
                            >
                                ← Kembali
                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                💾 Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
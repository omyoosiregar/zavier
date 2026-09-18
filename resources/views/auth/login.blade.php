<x-guest-layout>

    <div class="zavier-page">


        <!-- ============================
             BAGIAN KIRI
             BRANDING ZAVIER
        ============================= -->

        <section class="zavier-branding">

            <div class="circle-one"></div>

            <div class="circle-two"></div>


            <div class="branding-content">


                <!-- LOGO -->

                <div class="brand-logo-box">

                    <img
                        src="{{ asset('images/zavier-logo.png') }}"
                        alt="Logo ZAVIER">

                </div>


                <!-- NAMA -->

                <h1 class="brand-name">

                    ZAVIER

                </h1>


                <p class="brand-subtitle">

                    LEARNING CENTER

                </p>


                <!-- TAGLINE -->

                <h2 class="tagline">

                    Awal Baru yang Cemerlang
                    <br>
                    Menuju Kesuksesan

                </h2>


                <p class="tagline-desc">

                    Tempat belajar untuk tumbuh,
                    berkembang, dan mempersiapkan
                    masa depan dengan lebih percaya diri.

                </p>


                <!-- ARTI ZAVIER -->

                <div class="meaning-card">

                    <div class="meaning-title">

                        Z.A.V.I.E.R

                    </div>


                    <p>

                        Zeal, Aspiration, Victory,
                        Integrity, Excellence,
                        and Resilience

                    </p>


                    <p class="meaning-indonesia">

                        Semangat, Cita-cita, Kemenangan,
                        Integritas, Keunggulan,
                        dan Ketangguhan.

                    </p>

                </div>


            </div>

        </section>



        <!-- ============================
             BAGIAN KANAN
             LOGIN
        ============================= -->

        <section class="zavier-login">


            <div class="login-wrapper">


                <!-- HEADER -->

                <div class="login-header">


                    <div class="small-logo">

                        <img
                            src="{{ asset('images/zavier-logo.png') }}"
                            alt="ZAVIER">

                    </div>


                    <h1>

                        Selamat Datang! 👋

                    </h1>


                    <p>

                        Masuk ke akun ZAVIER Anda
                        dan lanjutkan perjalanan
                        menuju prestasi terbaik.

                    </p>


                </div>



                <!-- SESSION STATUS -->

                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')" />



                <!-- LOGIN CARD -->

                <div class="login-card">


                    <form
                        method="POST"
                        action="{{ route('login') }}">

                        @csrf



                        <!-- EMAIL -->

                        <div class="form-group">

                            <label for="email">

                                Email

                            </label>


                            <input

                                id="email"

                                type="email"

                                name="email"

                                value="{{ old('email') }}"

                                placeholder="Masukkan email Anda"

                                required

                                autofocus

                                autocomplete="username">

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-2" />

                        </div>



                        <!-- PASSWORD -->

                        <div class="form-group">

                            <label for="password">

                                Password

                            </label>


                            <input

                                id="password"

                                type="password"

                                name="password"

                                placeholder="Masukkan password Anda"

                                required

                                autocomplete="current-password">

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2" />

                        </div>



                        <!-- OPTIONS -->

                        <div class="form-options">


                            <label
                                for="remember_me"
                                class="remember">

                                <input

                                    id="remember_me"

                                    type="checkbox"

                                    name="remember">

                                <span>

                                    Ingat saya

                                </span>

                            </label>



                            @if (Route::has('password.request'))

                                <a

                                    href="{{ route('password.request') }}"

                                    class="forgot-password">

                                    Lupa password?

                                </a>

                            @endif


                        </div>



                        <!-- BUTTON -->

                        <button
                            type="submit"
                            class="login-button">

                            MASUK KE ZAVIER

                        </button>


                    </form>


                </div>



                <!-- FOOTER -->

                <div class="login-footer">

                    <p>

                        <strong>Belajar hari ini</strong>
                        untuk masa depan yang lebih cemerlang.

                    </p>


                    <p>

                        © {{ date('Y') }}
                        ZAVIER Learning Center

                    </p>

                </div>


            </div>


        </section>


    </div>

</x-guest-layout>
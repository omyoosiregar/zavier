<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ZAVIER | Learning Center</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1e293b;
        }

        .zavier-page {
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }


        /* ===============================
           BAGIAN BRANDING
        =============================== */

        .zavier-branding {

            width: 52%;

            min-height: 100vh;

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 60px;

            overflow: hidden;

            background:
                radial-gradient(
                    circle at top left,
                    rgba(37, 99, 235, 0.45),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #06142e,
                    #082a5a,
                    #0b3d80
                );

        }


        /* Pattern */

        .zavier-branding::before {

            content: "";

            position: absolute;

            inset: 0;

            opacity: 0.15;

            background-image:

                linear-gradient(
                    45deg,
                    rgba(255,255,255,.15) 1px,
                    transparent 1px
                ),

                linear-gradient(
                    -45deg,
                    rgba(255,255,255,.1) 1px,
                    transparent 1px
                );

            background-size: 55px 55px;

        }


        /* Decorative circles */

        .circle-one {

            position: absolute;

            width: 450px;

            height: 450px;

            border-radius: 50%;

            border: 1px solid rgba(96,165,250,.2);

            top: -180px;

            right: -180px;

        }


        .circle-two {

            position: absolute;

            width: 350px;

            height: 350px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,.1);

            bottom: -150px;

            left: -120px;

        }


        .branding-content {

            position: relative;

            z-index: 2;

            max-width: 620px;

            text-align: center;

            color: white;

        }


        /* Logo */

        .brand-logo-box {

            width: 155px;

            height: 155px;

            margin: auto;

            margin-bottom: 30px;

            background: rgba(255,255,255,.96);

            border-radius: 30px;

            padding: 18px;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow:

                0 25px 60px rgba(0,0,0,.3),

                inset 0 0 0 1px rgba(255,255,255,.5);

        }


        .brand-logo-box img {

            width: 100%;

            height: 100%;

            object-fit: contain;

        }


        /* Brand Name */

        .brand-name {

            font-size: 52px;

            font-weight: 800;

            letter-spacing: 12px;

            margin-bottom: 12px;

        }


        .brand-subtitle {

            font-size: 18px;

            letter-spacing: 4px;

            color: #bfdbfe;

            margin-bottom: 35px;

        }


        .tagline {

            font-size: 28px;

            font-weight: 700;

            line-height: 1.4;

            margin-bottom: 15px;

        }


        .tagline-desc {

            color: #dbeafe;

            font-size: 16px;

            line-height: 1.8;

            max-width: 550px;

            margin: auto;

        }


        /* Meaning card */

        .meaning-card {

            margin-top: 35px;

            padding: 25px;

            border-radius: 22px;

            background: rgba(255,255,255,.08);

            border: 1px solid rgba(255,255,255,.15);

            backdrop-filter: blur(10px);

        }


        .meaning-title {

            color: #93c5fd;

            font-size: 14px;

            font-weight: bold;

            letter-spacing: 2px;

            margin-bottom: 12px;

        }


        .meaning-card p {

            color: #e2e8f0;

            font-size: 14px;

            line-height: 1.8;

        }


        .meaning-indonesia {

            margin-top: 10px;

            color: #94a3b8 !important;

        }


        /* ===============================
           BAGIAN LOGIN
        =============================== */

        .zavier-login {

            width: 48%;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 40px;

            position: relative;

            background:

                radial-gradient(
                    circle at top right,
                    #e0ecff,
                    transparent 35%
                ),

                #f8fafc;

        }


        .login-wrapper {

            width: 100%;

            max-width: 470px;

        }


        /* Welcome */

        .login-header {

            text-align: center;

            margin-bottom: 28px;

        }


        .small-logo {

            width: 70px;

            height: 70px;

            margin: auto;

            margin-bottom: 18px;

            border-radius: 20px;

            background: white;

            padding: 10px;

            box-shadow: 0 10px 30px rgba(15,23,42,.08);

        }


        .small-logo img {

            width: 100%;

            height: 100%;

            object-fit: contain;

        }


        .login-header h1 {

            font-size: 30px;

            font-weight: 750;

            color: #0f172a;

            margin-bottom: 10px;

        }


        .login-header p {

            color: #64748b;

            line-height: 1.7;

            font-size: 15px;

        }


        /* Login Card */

        .login-card {

            background: white;

            padding: 38px;

            border-radius: 28px;

            border: 1px solid #e5e7eb;

            box-shadow:

                0 25px 60px rgba(15,23,42,.10);

        }


        /* Form */

        .form-group {

            margin-bottom: 22px;

        }


        .form-group label {

            display: block;

            font-size: 14px;

            font-weight: 650;

            color: #334155;

            margin-bottom: 9px;

        }


        .form-group input {

            width: 100%;

            height: 52px;

            padding: 0 16px;

            border-radius: 13px;

            border: 1px solid #dbe2ea;

            background: #f8fafc;

            outline: none;

            font-size: 15px;

            transition: .25s;

        }


        .form-group input:focus {

            background: white;

            border-color: #2563eb;

            box-shadow:

                0 0 0 4px rgba(37,99,235,.10);

        }


        .form-options {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-top: 5px;

            gap: 15px;

        }


        .remember {

            display: flex;

            align-items: center;

            gap: 8px;

            color: #64748b;

            font-size: 14px;

            cursor: pointer;

        }


        .remember input {

            width: 17px;

            height: 17px;

            accent-color: #2563eb;

        }


        .forgot-password {

            color: #2563eb;

            font-size: 14px;

            text-decoration: none;

            font-weight: 600;

        }


        .forgot-password:hover {

            text-decoration: underline;

        }


        /* Button */

        .login-button {

            width: 100%;

            height: 55px;

            border: none;

            border-radius: 14px;

            margin-top: 28px;

            cursor: pointer;

            color: white;

            font-size: 15px;

            font-weight: bold;

            letter-spacing: 1px;

            background:

                linear-gradient(
                    135deg,
                    #123a78,
                    #2563eb
                );

            box-shadow:

                0 15px 30px rgba(37,99,235,.25);

            transition: .25s;

        }


        .login-button:hover {

            transform: translateY(-2px);

            box-shadow:

                0 20px 35px rgba(37,99,235,.35);

        }


        /* Footer */

        .login-footer {

            margin-top: 25px;

            text-align: center;

            color: #94a3b8;

            font-size: 13px;

            line-height: 1.8;

        }


        .login-footer strong {

            color: #2563eb;

        }


        /* ===============================
           RESPONSIVE
        =============================== */

        @media (max-width: 950px) {

            .zavier-branding {

                display: none;

            }


            .zavier-login {

                width: 100%;

            }

        }


        @media (max-width: 520px) {

            .zavier-login {

                padding: 25px 18px;

            }


            .login-card {

                padding: 28px 22px;

                border-radius: 22px;

            }


            .form-options {

                flex-direction: column;

                align-items: flex-start;

            }

        }

    </style>

</head>


<body>

    {{ $slot }}

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smart E-Learning | Forgot Password</title>

    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">

    @vite('resources/css/app.css')

    <style>
        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            overflow-x: hidden;
        }

        @media (max-width: 767px) {
            html,
            body {
                height: auto;
                min-height: 100%;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            #app {
                min-height: 100vh;
                min-height: 100dvh;
                height: auto;
            }
        }
    </style>
</head>

<body class="w-full min-h-[100dvh] font-sans">

    @include('Global.Loading_Screen', [
        'logo' => asset('images/Components/Logo.png')
    ])

    <div id="app" class="w-full min-h-[100dvh]">
        <forgot-password
            logo="{{ asset('images/Components/Logo.png') }}"
        ></forgot-password>
    </div>

    @vite(['resources/js/app.js'])

</body>
</html>
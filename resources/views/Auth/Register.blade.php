<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up | Smart E-Learning</title>

    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">

    @vite('resources/css/app.css')

    <style>
        html, body, #app {
            min-height: 100%;
        }

        html, body {
            margin: 0;
        }

        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    @include('Global.Loading_Screen', ['logo' => asset('images/Components/Logo.png')])

    <div id="app">
        <register
            log-in="{{ route('login') }}"
            logo="{{ asset('images/Components/Logo.png') }}"
        ></register>
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>
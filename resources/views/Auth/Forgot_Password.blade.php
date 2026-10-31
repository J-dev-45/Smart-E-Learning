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
            background: linear-gradient(135deg, #090014 0%, #1A0B2E 50%, #4C1D95 100%);
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

    @include('Global.Loading_Screen', ['logo' => asset('images/Components/Logo.png') ])

    <div id="app" class="w-full min-h-[100dvh] md:h-screen flex flex-col md:flex-row">

        {{-- Left panel (hidden below md) --}}
        <div class="hidden md:flex w-1/2 h-full flex-col items-center justify-center text-white px-8 gap-3">
            <img src="{{ asset('images/Components/Logo.png') }}" alt="Logo"
                class="object-contain drop-shadow-2xl"
                style="width:clamp(100px,13vw,190px); height:clamp(90px,11vw,170px)">

            <div class="text-center">
                <h1 class="font-bold m-0 leading-none tracking-wide"
                    style="font-size:clamp(1.5rem,4vw,3rem)">Smart E-Learning</h1>
            </div>

            <div class="bg-[#CECBF6] rounded-full"
                style="width:clamp(60px,7vw,110px); height:4px"></div>

            <div class="text-center">
                <h5 class="font-semibold m-0 leading-none text-[#CECBF6]/65"
                    style="font-size:clamp(0.8rem,1.4vw,1.15rem)">Review Smarter, Quiz Better.</h5>
                <h6 class="font-medium m-0 mt-2 leading-none text-gray-400"
                    style="font-size:clamp(0.65rem,0.9vw,0.8rem)">Information Technology & Computer Related Course</h6>
            </div>
        </div>

        {{-- Right / Form panel (single instance for both mobile and desktop) --}}
        <div class="w-full md:w-1/2 min-h-[100dvh] md:min-h-0 md:h-full flex items-center justify-center md:justify-start p-5 md:py-0 md:px-8 lg:px-16 overflow-y-auto">
            <desktop-forgot-password></desktop-forgot-password>
        </div>

    </div>

    @vite(['resources/js/app.js'])
</body>
</html>


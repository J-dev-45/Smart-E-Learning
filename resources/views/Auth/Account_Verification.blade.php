<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Account Verification | Smart E-Learning</title>

    <link
        rel="shortcut icon"
        href="{{ asset('images/Components/Favicon.png') }}"
        type="image/x-icon"
    >

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

    <div id="app" class="w-full min-h-[100dvh] md:h-screen">

        <div class="flex flex-col md:flex-row w-full min-h-[100dvh] md:h-screen">

            <!-- DESKTOP BRANDING -->
            <div class="hidden md:flex md:w-1/2 md:h-full flex-col items-center justify-center sharedTXT px-8 gap-3">

                <img
                    src="{{ asset('images/Components/Logo.png') }}"
                    alt="Smart E-Learning Logo"
                    class="object-contain drop-shadow-2xl"
                    style="width:clamp(100px,13vw,190px);height:clamp(90px,11vw,170px)"
                >

                <div class="text-center">
                    <h1 class="font-bold m-0 leading-none tracking-wide"
                        style="font-size:clamp(1.5rem,4vw,3rem)">
                        Smart E-Learning
                    </h1>
                </div>

                <div class="sharedBGAccent rounded-full"
                    style="width:clamp(60px,7vw,110px);height:4px">
                </div>

                <div class="text-center">
                    <h5 class="font-semibold m-0 leading-none sharedTXTMuted"
                        style="font-size:clamp(0.8rem,1.4vw,1.15rem)">
                        Review Smarter, Quiz Better.
                    </h5>

                    <h6 class="font-medium m-0 mt-2 leading-none sharedTXTMuted"
                        style="font-size:clamp(0.65rem,0.9vw,0.8rem)">
                        Nueva Vizcaya State University
                    </h6>
                </div>

            </div>

            <!-- SINGLE VERIFICATION FORM -->
            <div class="w-full md:w-1/2 min-h-[100dvh] md:h-full flex items-center justify-center px-5 md:px-8 lg:px-16 py-5 md:py-8 overflow-y-auto">

                <div class="w-full max-w-[400px] md:max-w-[460px]">
                    <verify-account
                        email="{{ $email }}"
                        logo="{{ asset('images/Components/Logo.png') }}"
                    ></verify-account>
                </div>

            </div>

        </div>
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart E-Learning | Log in</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        input[type="password"]::-webkit-credentials-auto-fill-button,
        input[type="password"]::-webkit-textfield-decoration-container {
            display: none !important;
        }

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

    @include('Global.Loading_Screen', ['logo' => asset('images/Components/Logo.png') ])

    <div id="app" class="w-full min-h-[100dvh]">

        {{-- ══════════════════════════════════════ --}}
        {{-- MOBILE / TABLET  (hidden on md+)       --}}
        {{-- ══════════════════════════════════════ --}}

        <div class="flex md:hidden w-full min-h-[100dvh] items-center justify-center p-5 overflow-y-auto"
             style="min-height: 100vh; min-height: 100dvh;">

            <div class="w-full max-w-[400px] flex flex-col rounded-3xl overflow-hidden shadow-2xl
                        border-[1.5px] border-white/40 shrink-0">

                <mobile-login
                    sign-up="{{ route('register') }}"
                    logo="{{ asset('images/Components/Logo.png') }}"
                ></mobile-login>

            </div>
        </div>

        {{-- ══════════════════════════════════════ --}}
        {{-- DESKTOP  (hidden below md)             --}}
        {{-- ══════════════════════════════════════ --}}

        <div class="hidden md:flex w-full h-screen">

            {{-- Left panel --}}
            <div class="w-1/2 h-full flex flex-col items-center justify-center text-white px-8 gap-3">
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

            {{-- Right panel --}}
            <div class="w-1/2 h-full flex items-center justify-start px-8 lg:px-16">

                {{-- DESKTOP FORM --}}
                <desktop-login
                    logo="{{ asset('images/Components/Logo.png') }}"
                    url="{{ route('register') }}"
                ></desktop-login>

            </div>
        </div>
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>

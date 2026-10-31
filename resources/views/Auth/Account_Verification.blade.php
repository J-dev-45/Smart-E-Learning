<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account Verification | Smart E-Learning</title>
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

        .otp-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: clamp(0.3rem, 2%, 0.75rem);
            width: 100%;
        }
        .otp-input {
            aspect-ratio: 4/5;
            width: 100%;
            min-width: 0;
            border: 1.5px solid #e5e7eb;
            border-radius: 0.75rem;
            background: #f9fafb;
            text-align: center;
            font-weight: 700;
            color: #090014;
            outline: none;
            font-size: clamp(1rem, 4cqi, 1.6rem);
            transition: border-color .15s, background .15s;
        }
        .otp-input:focus {
            border-color: rgba(59, 7, 100, 0.5);
            background: #ffffff;
        }
        .container-type-inline { container-type: inline-size; }

        @supports not (font-size: 1cqi) {
            .otp-input { font-size: clamp(1rem, 5vw, 1.6rem); }
        }
    </style>
</head>
<body class="w-full min-h-[100dvh] font-sans">

    @include('Global.Loading_Screen', ['logo' => asset('images/Components/Logo.png') ])

    <div id="app" class="w-full min-h-[100dvh]">

        {{-- MOBILE / TABLET (hidden on md+) --}}
        <div class="flex md:hidden w-full min-h-[100dvh] items-center justify-center p-5 overflow-y-auto"
             style="min-height: 100vh; min-height: 100dvh;">

            <div class="w-full max-w-[400px] flex flex-col rounded-3xl overflow-hidden shadow-2xl
                        border-[1.5px] border-white/40 shrink-0">

                <mobile-verify
                    email="{{ $email }}"
                    logo="{{ asset('images/Components/Logo.png') }}"
                ></mobile-verify>

            </div>
        </div>

        {{-- DESKTOP (hidden below md) --}}
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
                        style="font-size:clamp(0.65rem,0.9vw,0.8rem)">Nueva Vizcaya State University</h6>
                </div>
            </div>

            {{-- Right panel --}}
            <div class="w-1/2 h-full flex items-center justify-start px-8 lg:px-16 overflow-y-auto py-8">

                <desktop-verify email="{{ $email }}"></desktop-verify>

            </div>
        </div>
    </div>

    @vite(['resources/js/app.js', 'resources/js/Auth.js'])
</body>
</html>
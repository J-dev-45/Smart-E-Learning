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

        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(76, 29, 149, 0.35) transparent;
        }
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(76, 29, 149, 0.3);
            border-radius: 999px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background-color: rgba(76, 29, 149, 0.5);
        }
    </style>

</head>
<body class="w-screen h-screen overflow-hidden font-sans">
    @vite(['resources/js/app.js'])

    @include('Global.Loading_Screen', ['logo' => asset('images/Components/Logo.png') ])

    <div id="app" class="w-screen h-screen">

        {{-- ══════════════════════════════════════ --}}
        {{-- MOBILE / TABLET (hidden on md+)       --}}
        {{-- ══════════════════════════════════════ --}}
        <div class="custom-scroll md:hidden w-full h-full overflow-y-auto">
            <div class="min-h-full flex items-center justify-center p-5">

                <div class="w-full max-w-[400px] flex flex-col rounded-3xl overflow-hidden shadow-2xl
                            border-[1.5px] border-white/40">

                    {{-- MOBILE FORM (logo + app name live inside the form card) --}}
                    <mobile-register
                        log-in="{{ route('login') }}"
                        logo="{{ asset('images/Components/Logo.png') }}"
                    ></mobile-register>

                </div>
            </div>
        </div>


        {{-- ══════════════════════════════════════ --}}
        {{-- DESKTOP (hidden below md)             --}}
        {{-- ══════════════════════════════════════ --}}
        <div class="hidden md:flex w-full h-full">

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
            <div class="custom-scroll w-1/2 h-full flex items-center justify-start px-8 lg:px-16 overflow-y-auto py-8">

                <desktop-register
                    log-in="{{route('login')}}"
                >
                </desktop-register>
            </div>
        </div>
    </div>

</body>
</html>
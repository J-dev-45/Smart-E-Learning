<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smart E-Learning | Forgot Password</title>

    <link
        rel="shortcut icon"
        href="{{ asset('images/Components/Favicon.png') }}"
        type="image/x-icon"
    >

    @vite('resources/css/app.css')

    <style>
        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
        }

        body {
            overflow-x: hidden;
            background: #12081F;
        }

        @media (min-width: 768px) {
            html,
            body {
                height: 100%;
                overflow: hidden;
            }
        }

        @media (max-width: 767px) {
            html,
            body {
                min-height: 100%;
                height: auto;
                overflow-x: hidden;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>

<body class="w-full min-h-[100dvh] bg-[#12081F] font-sans antialiased">

    @include('Global.Loading_Screen', [
        'logo' => asset('images/Components/Logo.png')
    ])

    <div
        id="app"
        class="relative flex min-h-[100dvh] w-full flex-col overflow-hidden
               bg-gradient-to-br from-[#12081F] via-[#1D1034] to-[#3b0764]
               md:h-screen md:flex-row"
    >
        <div
            class="hidden h-full w-1/2 flex-col items-center justify-center
                   gap-3 px-8 text-white md:flex"
        >
            <img
                src="{{ asset('images/Components/Logo.png') }}"
                alt="Smart E-Learning Logo"
                class="object-contain drop-shadow-2xl"
                style="
                    width: clamp(100px, 13vw, 190px);
                    height: clamp(90px, 11vw, 170px);
                "
            >

            <div class="text-center">
                <h1
                    class="m-0 font-bold leading-none tracking-wide"
                    style="font-size: clamp(1.5rem, 4vw, 3rem)"
                >
                    Smart E-Learning
                </h1>
            </div>

            <div
                class="rounded-full bg-[#CECBF6]"
                style="
                    width: clamp(60px, 7vw, 110px);
                    height: 4px;
                "
            ></div>

            <div class="text-center">
                <h5
                    class="m-0 font-semibold leading-none text-[#CECBF6]/80"
                    style="font-size: clamp(0.8rem, 1.4vw, 1.15rem)"
                >
                    Review Smarter, Quiz Better.
                </h5>

                <h6
                    class="mt-2 m-0 font-medium leading-relaxed text-gray-400"
                    style="font-size: clamp(0.65rem, 0.9vw, 0.8rem)"
                >
                    Information Technology &amp; Computer Related Course
                </h6>
            </div>
        </div>

        <div
            class="flex min-h-[100dvh] w-full items-center justify-center
                   px-4 py-8 sm:px-6
                   md:h-full md:min-h-0 md:w-1/2 md:px-8 md:py-6
                   lg:px-12"
        >
            <forgot-password></forgot-password>
        </div>
    </div>

    @vite(['resources/js/app.js'])

</body>
</html>
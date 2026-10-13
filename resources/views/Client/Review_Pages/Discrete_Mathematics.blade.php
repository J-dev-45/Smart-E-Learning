<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discrete Mathematics</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])

</head>
<body class="w-screen h-screen overflow-hidden bg-[#12081F]">
    <div id="app" class="flex flex-col h-screen w-screen overflow-hidden">


        <main class="main-bg w-full h-screen flex flex-col overflow-y-auto overflow-x-hidden scrollbar-thin">

            {{-- HEADER (stays visible while scrolling) --}}
            <div class="sticky top-0 z-20 shrink-0 bg-[#12081F]">
                <learn-header
                    profile-color="{{ auth()->user()->profile_color }}"
                    home-url="{{ route('home') }}"
                ></learn-header>
            </div>


            <section
                class="shrink-0 w-full text-white p-5 flex flex-col"
            >

                @switch($module->module_name)

                    @case('Introduction to Discrete Mathematics')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.Main')
                        @break

                    @case('Functions')
                        @break
                    @default
                        
                @endswitch
            </section>

        </main>
    </div>

    @vite(['resources/js/app.js'])

    <script>
        const module = @json($module);
        console.log("Module ID: " ,module.id)
        console.log("Module Name: " ,module.module_name)
    </script>
</body>
</html>
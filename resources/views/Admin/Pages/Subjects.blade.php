<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Subjects | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="h-dvh w-full overflow-hidden">

    @vite(['resources/js/app.js'])
    <div id="app" class="h-full">

        <left-navigation
            active-page="Subjects"
            :id-number="{{ auth()->user()->id_number }}"
            user-name="{{ auth()->user()->name }}"
            user-email="{{ auth()->user()->email }}"
            logo="{{ asset('images/Components/Logo.png') }}"
            profile-color="{{auth()->user()->profile_color}}"
        ></left-navigation>

        {{-- MOBILE --}}
        <bottom-navigation
        active-page="Subjects"
        ></bottom-navigation>

        <main class="w-full h-full md:w-[calc(100%-280px)] md:ml-[280px] ml-0 flex flex-col overflow-hidden">

            <admin-header
                user-name="{{ auth()->user()->name }}"
                user-email="{{ auth()->user()->email }}"
                profile-color="{{auth()->user()->profile_color}}"
            ></admin-header>

            <div class="flex-1 min-h-0 overflow-y-auto scrollbar-thin scroll-smooth grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] xl:grid-cols-3 content-start gap-4 sm:gap-6 p-4 sm:p-5 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">

                <subjects-cards-admin
                    :subjects-data='@json($subjects)'
                    :modules-data='@json($modules)'
                ></subjects-cards-admin>

                <div class="col-span-full h-16 shrink-0 md:hidden"></div>

            </div>

        </main>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Subjects | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="h-screen w-screen bg-gray-50 overflow-hidden">

    @vite([ 'resources/js/app.js'])
    <div id="app" class="h-full">


        <left-navigation
            active-page="Subjects"
            :id-number="{{ auth()->user()->id_number }}"
            user-name="{{ auth()->user()->name }}"
            user-email="{{ auth()->user()->email }}"
        ></left-navigation>

        <main
            class="w-full h-full main-bg md:w-[calc(100%-280px)] grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] xl:grid-cols-3 content-start gap-6 md:ml-[280px] ml-0 p-5 overflow-y-auto scrollbar-thin scroll-smooth"
        >

            <subjects-cards-admin
                :subjects-data='@json($subjects)'
                :modules-data='@json($modules)'
            >

            </subjects-cards-admin>

        </main>

    </div>

</body>
</html>
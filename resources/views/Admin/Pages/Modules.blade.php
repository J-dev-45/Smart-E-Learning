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
<body class="h-dvh w-full overflow-hidden">
    @vite(['resources/js/app.js'])
    <div id="app" class="h-full">

        <left-navigation
            active-page="Subjects"
            :id-number="{{ auth()->user()->id_number }}"
            user-name="{{ auth()->user()->name }}"
            user-email="{{ auth()->user()->email }}"
            logo="{{ asset('images/Components/Logo.png') }}"
        ></left-navigation>

        <main class="w-full h-full md:w-[calc(100%-280px)] md:ml-[280px] ml-0 flex flex-col overflow-hidden">

            <modules
                subject-id="{{ $subject_id }}"
                subject-name="{{ $subject_name }}"
                :modules='@json($modules)'
                :topics='@json($topics)'
                :questions='@json($questions)'
            ></modules>

        </main>

    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lesson Management | Smart E-Learning</title>

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
            profile-color="{{ auth()->user()->profile_color }}"
        ></left-navigation>

        <main class="w-full h-full md:w-[calc(100%-280px)] md:ml-[280px] ml-0 flex flex-col overflow-hidden">

            <lesson-management
                subject-name="{{ $subject_name }}"
                subject-id="{{ $subject_id }}"

                topic-name="{{ $topic_name }}"
                topic-id="{{ $topic_id }}"

                user-name="{{ auth()->user()->name }}"
                user-email="{{ auth()->user()->email }}"
                profile-color="{{ auth()->user()->profile_color }}"
                profile-picture="{{ auth()->user()->profile_picture }}"
                profile-avatar="{{ auth()->user()->profile_avatar }}"
            ></lesson-management>

        </main>

    </div>
</body>
</html>
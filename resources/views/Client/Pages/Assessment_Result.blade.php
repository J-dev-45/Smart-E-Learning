<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="w-screen overflow-x-hidden">
    @vite(['resources/js/app.js'])
    
    <div id="app" class="w-screen h-screen flex flex-col overflow-hidden">

        {{-- Scrolls on short screens; the card centers itself with m-auto --}}
        <main class="w-full h-full flex overflow-y-auto px-3 py-4 sm:px-4">

            <assessment-result
                subject-name="{{ $subject_name }}"
                module-name="{{ $module_name }}"
                subject-id="{{ $subject_id }}"
                module-id="{{ $module_id }}"
                :score-percent="{{ $score_percent }}"
                message="{{ $message }}"
                status="{{ $status }}"
                assessment-type="{{ $type_of_assessment }}"
                home-url="{{ route('home') }}"
                :section-score="{{ $section_score }}"
                :assessment-points="{{ $assessment_points ?? 0 }}"
                :bonus-points="{{ $bonus_points ?? 0 }}"
                :total-points="{{ $total_points ?? 'null' }}"
            ></assessment-result>

        </main>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart E-Learning</title>
    @vite(['resources/css/app.css'])
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
</head>
<body class="w-screen bg-gray-50 overflow-x-hidden">
    @vite(['resources/js/app.js'])
    <div id="app" class="w-screen h-screen flex flex-col overflow-hidden">
        <taking-pretest-header
            subject-name="{{$subject_name}}"
            module-name="{{$module_name}}"
            assessment-type="{{$type_of_assessment}}"
        ></taking-pretest-header>

        <main class="w-full h-[calc(100%-56px)] flex items-start justify-center pt-[30px] px-4 overflow-y-auto scrollbar-thin">
            <assessment-form 
                :questions-data='@json($questions)'
                :choices-data='@json($choices)'
                subject-id="{{ $subject_id }}"
                module-id="{{ $module_id }}"
                :answered-count="{{ $answered_count }}"
                :answered-questions='@json($answered_questions_data)'
                subject-name="{{$subject_name}}"
                module-name="{{$module_name}}"
                :score="{{$score}}"
                :remaining-seconds="{{ $remaining_seconds }}"
                :total-seconds="{{ $total_seconds }}"
                assessment-type="{{$type_of_assessment}}"
            ></assessment-form>
        </main>
    </div>

    
</body>
</html>
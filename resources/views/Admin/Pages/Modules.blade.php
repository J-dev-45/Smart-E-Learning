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
<body class="h-screen w-screen overflow-hidden">
    @vite([ 'resources/js/app.js'])
    <div id="app" class="h-full">


        <left-navigation
            active-page="Subjects"
            :id-number="{{ auth()->user()->id_number }}"
            user-name="{{ auth()->user()->name }}"
            user-email="{{ auth()->user()->email }}"
        ></left-navigation>

        <main
            class="w-full h-full md:w-[calc(100%-280px)] flex flex-col md:ml-[280px] ml-0 overflow-y-auto overflow-hidden scrollbar-thin scroll-smooth"
        >
            {{-- <subjects-navigation
                :subjects="subjects"
                @subject-added="handleSubjectAdded"
            ></subjects-navigation> --}}

            <modules
                subject-id="{{$subject_id}}"
                subject-name="{{$subject_name}}"
                :modules='@json($modules)'
                :topics='@json($topics)'
                :questions='@json($questions)'
            ></modules>
        </main>

    </div>

    

</body>
</html>
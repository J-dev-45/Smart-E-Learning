<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Questions | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>

<body class="h-screen w-screen overflow-hidden">

    <div id="app" class="h-full">

        <left-navigation
            active-page="Subjects"
            :id-number="{{ auth()->user()->id_number }}"
            user-name="{{ auth()->user()->name }}"
            user-email="{{ auth()->user()->email }}"
        ></left-navigation>

        <questions-main
            module-id="{{ $moduleId }}"
            :subject-id='@json($subject_id)'
            :subject-name='@json($subject_name)'
            :module-name='@json($module_name)'
            :modules='@json($modules)'
            :questions='@json($questions)'
            :choices='@json($choices)'
        />

    </div>

    @vite(['resources/js/app.js'])

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction to Computing</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])

</head>
<body class="w-full h-screen overflow-hidden sharedBG">
    @vite(['resources/js/app.js'])
    
    <div id="app" class="flex flex-col h-screen w-screen overflow-hidden">


        <main class="main-bg w-full h-screen flex flex-col overflow-y-auto overflow-x-hidden scrollbar-thin">

            {{-- HEADER (stays visible while scrolling) --}}
            <div class="sticky top-0 z-20 shrink-0 sharedBG">
                <learn-header
                    :user-id="{{ auth()->id() }}"
                    user-name="{{ auth()->user()->name }}"
                    user-email="{{ auth()->user()->email }}"
                    profile-color="{{ auth()->user()->profile_color ?? '' }}"
                    profile-picture="{{ auth()->user()->profile_picture && str_starts_with(auth()->user()->profile_picture, 'profiles/') ? rtrim(config('services.supabase.url'), '/') . '/storage/v1/object/public/' . config('services.supabase.avatar_bucket', 'pictures') . '/' . auth()->user()->profile_picture : (auth()->user()->profile_picture ?? '') }}"
                    profile-avatar="{{ auth()->user()->profile_avatar ? asset(ltrim(auth()->user()->profile_avatar, '/')) : '' }}"
                    :module='@json($module)'
                    :topic-count="{{ count($topics) }}"
                    :answered-count="0"
                    :initial-progress="{{ (float) ($module_progress->progress ?? 0) }}"
                    :subject-id='@json((string) $subject->id)'
                    :subject-name='@json($subject->subject_name)'
                ></learn-header>
            </div>


            <section
                class="shrink-0 w-full sharedTXT p-5 flex flex-col"
            >

                @switch($module->module_name)
                    @case('Overview of IT')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M1_Overview of IT.Main')
                        @break
                    @case('Computer Hardware')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M2_Computer_Hardware.Main')
                        @break
                        @case('Computer Software')
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M3_Computer_Software.Main')
                    @break
                    @case('Computer Networking')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M4_Computer_Networking.Main')
                        @break
                    @case('The Internet')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M5_The_Internet.Main')
                        @break
                    @case('Computer Security')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M6_Computer_Security.Main')
                        @break
                    @case('Flowchart and Algorithm')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M7_Flowchart_And_Algorithm.Main')
                        @break
                    @case('HTML and CSS')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M8_HTML_And_CSS.Main')
                        @break
                @endswitch
            </section>

        </main>
    </div>

    

   
</body>
</html>
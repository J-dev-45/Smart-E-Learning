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
<body class="w-screen h-screen overflow-hidden bg-[#12081F]">
    <div id="app" class="flex flex-col h-screen w-screen overflow-hidden">


        <main class="main-bg w-full h-screen flex flex-col overflow-y-auto overflow-x-hidden scrollbar-thin">

            {{-- HEADER (stays visible while scrolling) --}}
            <div class="sticky top-0 z-20 shrink-0 bg-[#12081F]">
                <learn-header
                    :profile-color='@json(auth()->user()->profile_color)'
                    :module='@json($module)'
                    :topic-count="{{ count($topics) }}"
                    :answered-count="0"
                    :initial-progress="{{ (float) ($module_progress->progress ?? 0) }}"
                    :subject-id='@json((string) $subject->id)'
                    :subject-name='@json((string) $subject->subject_name)'
                ></learn-header>
            </div>


            <section
                class="shrink-0 w-full text-white p-5 flex flex-col"
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

    @vite(['resources/js/app.js'])

   
</body>
</html>
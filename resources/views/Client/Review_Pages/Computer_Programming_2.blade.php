<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Programming 2</title>
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
                    :subject-name='@json($subject->subject_name)'
                ></learn-header>
            </div>


            <section
                class="shrink-0 w-full text-white p-5 flex flex-col"
            >

                @switch($module->module_name)

                    @case('Introduction to Computer Programming 2')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M1_Introduction_To_Programming_2.Main')
                        @break

                    @case('Arrays')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M2_Arrays.Main')
                        @break

                    @case('Searching Algorithms')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M3_Searching_Algorithms.Main')
                        @break

                    @case('Sorting Algorithms')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M4_Sorting_Algorithms.Main')
                        @break

                    @case('Algorithm Analysis')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M5_Algorithm_Analysis.Main')
                        @break

                    @case('Introduction to Object-Oriented Programming')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M6_Introduction_To_OOP.Main')
                        @break

                    @case('Constructors and Methods')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M7_Constructors_And_Methods.Main')
                        @break

                    @case('Encapsulation')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M8_Encapsulation.Main')
                        @break

                    @case('Inheritance')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M9_Inheritance.Main')
                        @break

                    @case('Polymorphism')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M10_Polymorphism.Main')
                        @break

                    @case('Abstraction')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M11_Abstraction.Main')
                        @break

                    @case('Integrating Arrays, Algorithms, and OOP')
                        @include('Client.Review_Pages.Modules.ITECC3_CP2.M12_Integrating_Arrays_Algorithms_And_OOP.Main')
                        @break

                @endswitch

            </section>

        </main>
    </div>

    @vite(['resources/js/app.js'])

</body>
</html>

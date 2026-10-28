<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Programming 1</title>
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

                    @case('Introduction to Computer Programming')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M1_Introduction_To_Programming.Main')
                        @break

                    @case('Introduction to Java')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M2_Introduction_To_Java.Main')
                        @break

                    @case('Primitive Types and Variables')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M3_Primitive_Types_And_Variables.Main')
                        @break

                    @case('Operators and Expressions')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M4_Operators_And_Expressions.Main')
                        @break

                    @case('Console Input and Output')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M5_Console_Input_And_Output.Main')
                        @break

                    @case('Conditional Statements')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M6_Conditional_Statements.Main')
                        @break

                    @case('Looping Statements')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M7_Looping_Statements.Main')
                        @break

                    @case('String')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M8_String.Main')
                        @break

                    @case('Arrays')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M9_Arrays.Main')
                        @break

                    @case('Methods')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M10_Methods.Main')
                        @break

                    @case('Recursion')
                        @include('Client.Review_Pages.Modules.ITEC2_CP.M11_Recursion.Main')
                        @break

                @endswitch

            </section>

        </main>
    </div>

    @vite(['resources/js/app.js'])

</body>
</html>

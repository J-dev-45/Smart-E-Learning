<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discrete Mathematics</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])

</head>
<body class="w-full h-[100dvh] overflow-hidden bg-[#12081F]">
    <div id="app" class="flex flex-col h-[100dvh] w-full overflow-hidden">


        <main class="main-bg w-full h-[100dvh] flex flex-col overflow-y-auto overflow-x-hidden scrollbar-thin">

            {{-- HEADER (stays visible while scrolling) --}}
            <div class="sticky top-0 z-20 shrink-0 bg-[#12081F]">
                <learn-header
                    :profile-color='@json(auth()->user()->profile_color)'
                    :module='@json($module)'
                    :topic-count="{{ count($topics) }}"
                    :answered-count="0"
                    :initial-progress="{{ (float) ($module_progress->progress ?? 0) }}"
                    :subject-id='@json((string) $subject->id)'
                ></learn-header>
            </div>


            <section
                class="shrink-0 w-full text-white p-3 sm:p-5 flex flex-col"
            >

                @switch($module->module_name)

                    @case('Introduction to Discrete Mathematics')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.M1_Introduction.Main')
                        @break

                    @case('Functions')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.M2_Functions.Main')
                        @break

                    @case('Relation')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Main')
                        @break

                    @case('Recursion')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.M4_Recursion.Main')
                        @break

                    @case('Propositional Logic')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Main')
                        @break
                    
                    @case('Probability')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.M6_Probability.Main')
                        @break
                    
                    @case('Graphs and Trees')
                        @include('Client.Review_Pages.Modules.ITPC1_DM.M7_Graphs_And_Trees.Main')
                        @break


                    @default
                        
                @endswitch
            </section>

        </main>
    </div>

    @vite(['resources/js/app.js'])

   
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Structures and Algorithms</title>
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

                    @case('Data Structures and Algorithms')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M1_Data_Structures_And_Algorithms.Main')
                        @break
                    @case('Queues')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M2_Queues.Main')
                        @break
                    @case('Linked Lists and Arrays')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M3_Linked_Lists_And_Arrays.Main')
                        @break
                    @case('Big O Notation and Searching Algorithms')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M4_Big_O_Searching_Algorithms.Main')
                        @break
                    @case('Sorting Algorithms')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M5_Sorting_Algorithms.Main')
                        @break
                    @case('Recursion and Advanced Sorting Algorithms')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M6_Recursion_Advanced_Sorting.Main')
                        @break
                    @case('Hash Tables and Graphs')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M7_Hash_Tables_Graphs.Main')
                        @break
                    @case('Graphs II')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M8_Graphs_Traversal.Main')
                        @break
                    @case('Tree Data Structures and Performance Analysis')
                        @include('Client.Review_Pages.Modules.ITPC4_DSA.M9_Tree_Data_Structures.Main')
                        @break


                    @default
                        
                @endswitch
            </section>

        </main>
    </div>

    @vite(['resources/js/app.js'])

   
</body>
</html>
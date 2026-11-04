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
<body class="w-full h-screen overflow-hidden sharedBG">
    
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

                    @case('Introduction to Computer Programming')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M1_Introduction_To_Programming.Main')
                        @break

                    @case('Introduction to Java')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M2_Introduction_To_Java.Main')
                        @break

                    @case('Primitive Types and Variables')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M3_Primitive_Types_And_Variables.Main')
                        @break

                    @case('Operators and Expressions')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M4_Operators_And_Expressions.Main')
                        @break

                    @case('Console Input and Output')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M5_Console_Input_And_Output.Main')
                        @break

                    @case('Conditional Statements')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M6_Conditional_Statements.Main')
                        @break

                    @case('Looping Statements')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M7_Looping_Statements.Main')
                        @break

                    @case('String')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M8_String.Main')
                        @break

                    @case('Arrays')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M9_Arrays.Main')
                        @break

                    @case('Methods')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M10_Methods.Main')
                        @break

                    @case('Recursion')
                        @include('Client.Review_Pages.Modules.ITECC2_CP.M11_Recursion.Main')
                        @break

                                            {{-- Fallback for modules without a lesson page: show the module's coding questions --}}
                    @default
                        @php
                            $codingQuestions = \App\Models\Questions::where('module_id', $module->id)
                                ->where('question_type', 'coding')
                                ->orderBy('created_at')
                                ->get();
                        @endphp

                        <div class="flex flex-col justify-center items-center w-full gap-5 text-gray-800">
                            @forelse ($codingQuestions as $codingQuestion)
                                <div class="flex flex-col bg-white rounded-2xl border border-gray-200 w-[50%] h-[90%] shadow-sm overflow-hidden">
                                    <div class="flex items-start gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-violet-50/70 to-white">
                                        <span class="shrink-0 flex items-center justify-center w-6 h-6 rounded-full bg-[#8B5CF6]/10 text-[#8B5CF6] text-xs font-bold">
                                            {{ $loop->iteration }}
                                        </span>
                                        <div class="flex flex-col gap-0.5">
                                            <span class="text-xs font-semibold uppercase tracking-wider text-[#8B5CF6]">Coding</span>
                                            <span class="text-sm font-medium text-gray-800 leading-relaxed whitespace-pre-line">{{ $codingQuestion->question }}</span>
                                        </div>
                                    </div>

                                    <div class="px-6 py-5">
                                        <code-playground question-id="{{ $codingQuestion->id }}"></code-playground>
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center gap-2 py-10 rounded-2xl bg-white border border-dashed border-gray-300">
                                    <span class="text-sm text-gray-400">No questions in this module yet.</span>
                                </div>
                            @endforelse
                        </div>


                @endswitch

            </section>

        </main>
    </div>

    @vite(['resources/js/app.js'])

</body>
</html>

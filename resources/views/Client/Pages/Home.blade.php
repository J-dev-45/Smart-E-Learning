<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="w-screen min-h-screen overflow-x-hidden">
    @vite(['resources/js/app.js'])
    @include('Global.Skeleton_Loading.Client_Navigation')
    <div id="app" class="w-screen flex flex-col overflow-x-hidden min-h-screen relative">

        <div class="fixed inset-0 -z-10 bg-gradient-to-b from-[#090014] via-[#1A0B2E] to-[#0D0620]"></div>
        <div class="fixed top-[-10%] right-[-10%] -z-10 w-[600px] h-[600px] rounded-full bg-[#4C1D95]/25 blur-[120px]"></div>
        <div class="fixed bottom-[-10%] left-[-10%] -z-10 w-[500px] h-[500px] rounded-full bg-[#CECBF6]/10 blur-[120px]"></div>

        
        <client-navigation
        :user-id="{{auth()->user()->id}}"
        user-name="{{auth()->user()->name}}"
        user-email="{{auth()->user()->email}}"
        profile-color="{{auth()->user()->profile_color}}"
        ></client-navigation>

        <main class="w-full text-white pt-[80px] md:pt-[120px] pb-16 px-4 flex flex-col">

            <feedback-form></feedback-form>
            {{-- HERO SECTION --}}
            <section id="hero" class="w-full flex items-center justify-center flex-col gap-8 scroll-mt-24">
                {{-- <div class="flex flex-col items-center justify-center w-full sm:w-[85%] md:w-[70%] lg:w-[55%] gap-4">
                    <h1 class="text-[28px] sm:text-[34px] md:text-[44px] font-bold text-center leading-[1.15] tracking-tight">
                        Review smarter, quiz better.
                    </h1>
                    <p class="text-[15px] md:text-[16px] text-center leading-relaxed text-white/60 max-w-[560px]">
                        Review lessons and take quizzes across a wide range of modules — 
                        all in one place, designed for IT, Computer Science, and related courses.
                    </p>
                </div> --}}

                <div class="flex flex-col items-center justify-center gap-4">
                    @if (auth()->user()->profile_picture === null)
                        <div class="w-40 h-40 rounded-full flex items-center justify-center {{auth()->user()->profile_color}} ring-4 ring-white/10 shadow-xl shadow-black/30">
                            <span class="text-5xl font-semibold text-white tracking-wide">
                                {{ Str(auth()->user()->name)->initials()}}
                            </span>
                        </div>
                    @endif
                    <div class="flex flex-col items-center justify-center gap-2">
                        <span class="text-2xl font-semibold tracking-tight">{{auth()->user()->name}}</span>
                        <span class="text-xs font-semibold text-white/50 uppercase tracking-wider px-3 py-1 rounded-full border border-white/10 bg-white/[0.04]">Student</span>
                    </div>
                </div>

                {{-- PERFORMANCE SUMMARY --}}
                <div class="w-full flex flex-col items-center gap-5 pt-2">
                    <p class="text-sm font-medium text-white/45">Performance summary</p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-5 w-full lg:w-[62%] sm:w-[85%]">

                        {{-- TOTAL SCORE --}}
                        <div class="group flex items-center gap-4 p-5 rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#CECBF6]/30 hover:bg-white/[0.05]">
                            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl bg-[#8B5CF6]/15 ring-1 ring-[#8B5CF6]/20 transition-colors duration-200 group-hover:bg-[#8B5CF6]/25">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-[#B9A6F0]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold leading-tight tabular-nums">{{$total_score}}</span>
                                <p class="text-xs font-medium text-white/45">Total score</p>
                            </div>
                        </div>

                        {{-- ACCURACY --}}
                        <div class="group flex items-center gap-4 p-5 rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#CECBF6]/30 hover:bg-white/[0.05]">
                            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl bg-[#22D3EE]/15 ring-1 ring-[#22D3EE]/20 transition-colors duration-200 group-hover:bg-[#22D3EE]/25">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-[#7EE3F5]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.99 14.993 6-6m6 3.001c0 1.268-.63 2.39-1.593 3.069a3.746 3.746 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043 3.745 3.745 0 0 1-3.068 1.593c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 0 1-3.296-1.043 3.746 3.746 0 0 1-1.043-3.297 3.746 3.746 0 0 1-1.593-3.068c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 0 1 1.043-3.297 3.745 3.745 0 0 1 3.296-1.042 3.745 3.745 0 0 1 3.068-1.594c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.297 3.746 3.746 0 0 1 1.593 3.068ZM9.74 9.743h.008v.007H9.74v-.007Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold leading-tight tabular-nums">{{$accuracy}}%</span>
                                <p class="text-xs font-medium text-white/45">Accuracy</p>
                            </div>
                        </div>

                        {{-- COMPLETED --}}
                        <div class="group flex items-center gap-4 p-5 rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#CECBF6]/30 hover:bg-white/[0.05]">
                            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl bg-[#6366F1]/15 ring-1 ring-[#6366F1]/20 transition-colors duration-200 group-hover:bg-[#6366F1]/25">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-[#A5A9F5]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold leading-tight tabular-nums">0</span>
                                <p class="text-xs font-medium text-white/45">Completed</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- SEPARATOR --}}
            <div class="w-full flex items-center justify-center pt-14">
                <div class="w-[60%] h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
            </div>

            {{-- SUBJECTS --}}
            <section id="subjects" class="w-full pt-14 flex flex-col items-center justify-center gap-1 scroll-mt-24">

                <div class="flex flex-col items-center gap-1.5 pb-8 text-center">
                    <h2 class="font-bold text-2xl md:text-3xl tracking-tight">Subjects</h2>
                    <p class="text-sm text-white/45">Pick up where you left off</p>
                </div>

                <div class="md:w-[90%] w-full gap-5 md:p-5 p-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

                    <subjects-card
                        :subjects-data='@json($subjects)'
                        :modules-data='@json($modules)'
                        :pretest-data='@json($module_pretests)'
                        :subjects-started='@json($subjects_started)'
                    ></subjects-card>

                </div>

            </section>

             {{-- SEPARATOR --}}
            <div class="w-full flex items-center justify-center pt-14">
                <div class="w-[60%] h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
            </div>

            {{-- CODE PLAYGROUND --}}
            <section id="code-playground" class="w-full pt-14 flex flex-col items-center justify-center gap-1 scroll-mt-24">

                <div class="flex flex-col items-center gap-1.5 pb-8 text-center">
                    <h2 class="font-bold text-2xl md:text-3xl tracking-tight">Code Playground</h2>
                    <p class="text-sm text-white/45">Write and run code right in your browser</p>
                </div>

                <code-playground></code-playground>

            </section>

            {{-- SEPARATOR --}}
            <div class="w-full flex items-center justify-center pt-14">
                <div class="w-[60%] h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
            </div>

            {{-- LEADERBOARD  --}}
            <section id="leaderboard" class="w-full pt-14 flex flex-col items-center justify-center gap-1 scroll-mt-24">

                <div class="flex flex-col items-center gap-1.5 pb-10 text-center">
                    <h2 class="font-bold text-2xl md:text-3xl tracking-tight">Leaderboard</h2>
                    <p class="text-sm text-white/45">Top performers this term</p>
                </div>

                <leaderboard
                :users='@json($users)'
                :leaderboard='@json($leaderboard)'
                :my-id="{{auth()->id()}}"
                ></leaderboard>

            </section>

        </main>
    </div>

    

</body>
</html>
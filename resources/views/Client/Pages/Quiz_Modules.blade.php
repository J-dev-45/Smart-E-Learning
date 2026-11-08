<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Module to Learn — Discrete Mathematics</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="w-full h-screen sharedBG overflow-hidden sharedTXT">
    

    <div id="app" class="w-screen h-screen relative sharedTXT">

        {{-- Header --}}
        <choose-module-header 
        subject-name="{{$subject->subject_name}}"
        user-name="{{auth()->user()->name}}"
        profile-color="{{ auth()->user()->profile_color ?? '' }}"
        profile-picture="{{ auth()->user()->profile_picture && str_starts_with(auth()->user()->profile_picture, 'profiles/') ? rtrim(config('services.supabase.url'), '/') . '/storage/v1/object/public/' . config('services.supabase.avatar_bucket', 'pictures') . '/' . auth()->user()->profile_picture : (auth()->user()->profile_picture ?? '') }}"
        profile-avatar="{{ auth()->user()->profile_avatar ? asset(ltrim(auth()->user()->profile_avatar, '/')) : '' }}"
        >
        </choose-module-header>

        <div id="page-scroll" class="absolute inset-x-0 top-[60px] bottom-0 overflow-y-auto overflow-x-hidden scroll-smooth scrollbar-thin">

            <main class="w-full pt-6 md:pt-10 pb-10 px-4 flex flex-col items-center">

                {{-- PROGRESS STATS --}}
                <section class="w-full max-w-3xl flex items-center justify-center flex-col gap-4 sm:gap-5 pt-6 sm:pt-8">
                    <p class="pt-2 text-sm font-medium sharedTXTMuted">Your progress in this subject</p>

                    <div class="grid grid-cols-3 gap-2 sm:gap-4 md:gap-5 pb-3 pt-1 w-full">

                        {{-- PASSED --}}
                        <div class="group flex flex-col items-center justify-center p-3 sm:p-4 gap-1.5 sm:gap-2 rounded-2xl text-center sharedSurface shadow-lg sharedShadow transition-all duration-200">
                            <div class="flex items-center justify-center shrink-0 size-9 sm:size-11 rounded-xl sharedTile">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 sharedTXTAccent">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <span class="text-xl sm:text-2xl font-bold leading-tight tabular-nums">{{ $modules_passed_count }}</span>
                            <p class="text-[10px] sm:text-xs font-medium tracking-wide sharedTXTMuted">Passed</p>
                        </div>

                        {{-- AVG SCORE --}}
                        <div class="group flex flex-col items-center justify-center p-3 sm:p-4 gap-1.5 sm:gap-2 rounded-2xl text-center sharedSurface shadow-lg sharedShadow transition-all duration-200">
                            <div class="flex items-center justify-center shrink-0 size-9 sm:size-11 rounded-xl sharedTile">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 sharedTXTAccent">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.99 14.993 6-6m6 3.001c0 1.268-.63 2.39-1.593 3.069a3.746 3.746 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043 3.745 3.745 0 0 1-3.068 1.593c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 0 1-3.296-1.043 3.746 3.746 0 0 1-1.043-3.297 3.746 3.746 0 0 1-1.593-3.068c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 0 1 1.043-3.297 3.745 3.745 0 0 1 3.296-1.042 3.745 3.745 0 0 1 3.068-1.594c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.297 3.746 3.746 0 0 1 1.593 3.068ZM9.74 9.743h.008v.007H9.74v-.007Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                            <span class="text-xl sm:text-2xl font-bold leading-tight tabular-nums">{{ $average_score }}%</span>
                            <p class="text-[10px] sm:text-xs font-medium tracking-wide sharedTXTMuted">Avg score</p>
                        </div>

                        {{-- REMAINING MODULES --}}
                        <div class="group flex flex-col items-center justify-center p-3 sm:p-4 gap-1.5 sm:gap-2 rounded-2xl text-center sharedSurface shadow-lg sharedShadow transition-all duration-200">
                            <div class="flex items-center justify-center shrink-0 size-9 sm:size-11 rounded-xl sharedTile">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 sharedTXTAccent">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <span class="text-xl sm:text-2xl font-bold leading-tight tabular-nums">{{ $remaining_modules }}</span>
                            <p class="text-[10px] sm:text-xs font-medium tracking-wide sharedTXTMuted">Remaining modules</p>
                        </div>

                    </div>
                </section>

                {{-- SEPARATOR --}}
                <div class="w-full h-[1px] flex items-center justify-center pt-[30px]">
                    <div class="sharedLine w-full max-w-3xl h-[1px]"></div>
                </div>

                {{-- MODULES --}}
                <quiz-modules
                :user-modules='@json($user_modules)'
                :modules='@json($modules)'
                :topics='@json($topics)'
                :questions='@json($questions)'
                subject-id="{{$subject_id}}"
                subject-name="{{$subject->subject_name}}"
                :exam-open='@json($exam_open)'
                :modules-started='@json($modules_started)'
                :exam-started='@json($exam_started)'
                :exam-passed='@json($exam_passed)'
                ></quiz-modules>

            </main>
        </div>
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>
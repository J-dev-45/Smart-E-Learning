<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discrete Mathematics</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
    <script>
        window.MathJax = {
            tex: {
                inlineMath: [['\\(', '\\)'], ['$', '$']],
                displayMath: [['\\[', '\\]'], ['$$', '$$']],
                processEscapes: true
            },
            options: {
                skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code']
            },
            startup: {
                typeset: true
            }
        };
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml.js"></script>

</head>
<body class="w-screen h-screen overflow-hidden sharedBG">
    @vite(['resources/js/app.js'])
    
    <div id="app" class="flex flex-col h-screen w-screen overflow-hidden">

        {{-- HEADER (full width, sits above the scroll area) --}}
        <div class="relative z-20 shrink-0 w-full sharedBG">
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

        <main id="page-scroll" class="main-bg w-full flex-1 min-h-0 flex flex-col overflow-y-auto overflow-x-hidden scrollbar-thin">

            <section class="shrink-0 w-full sharedTXT p-5 flex flex-col">
                        
                <div class="w-full max-w-5xl mx-auto">
                    <div class="w-full">
                        <h4 class="text-xl font-bold pt-5">
                            {{ $module->module_name }}
                        </h4>

                        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
                            {!! nl2br(e(str_replace(['\\r\\n', '\\n', '\\r'], "\n", $module->description))) !!}
                        </p>
                    </div>
                </div>

                <lesson-content
                    :topics='@json($topics)'
                ></lesson-content>


                <div class="w-full max-w-5xl mx-auto">
                        <module-activity 
                        :questions='@json($activity_questions)'
                        :module-progress='@json($module_progress)'
                        :module='@json($module)'
                        :failed='@json($failed)'
                        :answered-module-questions='@json($answered_module_questions)'
                        :answered-questions='@json($answered_questions)'
                        :score='@json($score)'

                        user-id="{{auth()->id()}}"
                        user-name="{{auth()->user()->name}}"
                        user-email="{{auth()->user()->email}}"
                    ></module-activity>

                        {{-- Warning --}}
                    <div class="flex items-start gap-3 mt-10 p-4 rounded-xl border sharedBorderWarningSoft border-l-4 sharedBorderLWarning sharedBGWarningTint">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5 shrink-0 sharedTXTWarning mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-bold sharedTXTWarning">Pass the activity to continue</span>
                            <p class="text-sm sharedTXTMuted leading-relaxed">
                                You must pass the activity above to unlock the 
                                <span class="sharedTXT">Quiz</span> 
                                @if($module->has_coding)
                                and 
                                <span class="sharedTXT">Coding</span> 
                                @endif
                                assessments.
                            </p>
                        </div>
                    </div>


                    <module-quiz-buttons
                        :subject='@json($subject)'
                        :module='@json($module)'
                        :module-progress='@json($module_progress)'
                        :module-quiz='@json($module_quiz)'
                        :next-module='@json($next_module)'
                    >
                    </module-quiz-buttons>
                </div>
                
            </section>

        </main>
    </div>

    
    <script>
        (() => {
            let queued = false;
            const app = document.getElementById('app') || document.body;
            const observer = new MutationObserver(() => queueTypeset());
            const observe = () => observer.observe(app, {
                childList: true,
                subtree: true,
                characterData: true
            });
            const typeset = () => {
                queued = false;
                observer.disconnect();
                if (window.MathJax && window.MathJax.typesetPromise) {
                    window.MathJax.typesetPromise().catch(() => {}).finally(observe);
                } else {
                    observe();
                }
            };
            const queueTypeset = () => {
                if (queued) return;
                queued = true;
                window.setTimeout(typeset, 100);
            };
            document.addEventListener('DOMContentLoaded', queueTypeset);
            observe();
            window.typesetLearningMath = queueTypeset;
        })();
    </script>

   
</body>
</html>
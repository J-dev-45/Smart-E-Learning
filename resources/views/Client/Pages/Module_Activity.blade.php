<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Activity</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])

    <script>
        window.MathJax = {
            tex: {
                inlineMath: [['\\(', '\\)'], ['$','$']],
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

                    <div class="mb-5">
                        <a
                            href="{{ url('/learning/' . urlencode($subject->subject_name) . '/' . $subject->id . '/' . urlencode($module->module_name) . '/' . $module->id) }}"
                            class="group inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-[#6D28D9] bg-white border border-[#8B5CF6]/40 shadow-sm hover:bg-[#8B5CF6] hover:text-white hover:border-[#8B5CF6] active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-[#8B5CF6]/25 transition-all duration-200"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-200 group-hover:-translate-x-0.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            Back to Learning Module
                        </a>

                        <h4 class="text-2xl font-bold pt-5">
                            {{ $module->module_name }} — Activity
                        </h4>

                        <p class="text-md sharedTXTMuted mt-2 leading-relaxed">
                            Complete the activity below to unlock the module assessments.
                        </p>
                    </div>

                    <module-activity
                        :questions='@json($activity_questions)'
                        :module-progress='@json($module_progress)'
                        :module='@json($module)'
                        :failed='@json($failed)'
                        :answered-module-questions='@json($answered_module_questions)'
                        :answered-questions='@json($answered_questions)'
                        :score='@json($score)'
                        user-id="{{ auth()->id() }}"
                        user-name="{{ auth()->user()->name }}"
                        user-email="{{ auth()->user()->email }}"
                    ></module-activity>

                    <module-quiz-buttons
                        :subject='@json($subject)'
                        :module='@json($module)'
                        :module-progress='@json($module_progress)'
                        :module-quiz='@json($module_quiz)'
                        :next-module='@json($next_module)'
                        :exam-open='@json($exam_open)'
                        :exam-passed='@json($exam_passed)'
                    ></module-quiz-buttons>

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
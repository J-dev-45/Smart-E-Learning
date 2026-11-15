
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
                            class="text-sm sharedTXTMuted hover:underline"
                        >
                            ← Back to Learning Module
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

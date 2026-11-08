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


        <main class="main-bg w-full h-screen flex flex-col overflow-y-auto overflow-x-hidden scrollbar-thin">

            {{-- HEADER (stays visible while scrolling) --}}
            <div class="sticky top-0 z-20 shrink-0 sharedBG">
                
            </div>


            <section
                class="shrink-0 w-full sharedTXT p-5 flex flex-col"
            >
                @switch($module->module_name)
                    @case('Introduction to Discrete Mathematics')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M1_Overview of IT.Main')
                        @break
                    @case('Functions')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M2_Computer_Hardware.Main')
                        @break
                        @case('Relation')
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M3_Computer_Software.Main')
                    @break
                    @case('Computer Networking')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M4_Computer_Networking.Main')
                        @break
                    @case('The Internet')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M5_The_Internet.Main')
                        @break
                    @case('Computer Security')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M6_Computer_Security.Main')
                        @break
                    @case('Flowchart and Algorithm')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M7_Flowchart_And_Algorithm.Main')
                        @break
                    @case('HTML and CSS')
                        @include('Client.Review_Pages.Modules.ITECC1_ITC.M8_HTML_And_CSS.Main')
                        @break
                @endswitch
                
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
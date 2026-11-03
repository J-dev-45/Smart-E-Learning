{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            Programs are everywhere, from the apps on your phone to the systems that run banks and hospitals. Behind each one is a programmer who analyzed a problem, designed a solution, and wrote it in a programming language.
        </p>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            In this module, we will study the basic components of a computer, what programming languages are and how they are categorized, the Program Development Life Cycle, and how to draw program flowcharts.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('ITECC2-topic-introduction-and-basic-components-of-a-computer')
                    {{-- INTRODUCTION AND BASIC COMPONENTS OF A COMPUTER --}}
                    @include('Client.Review_Pages.Modules.ITECC2_CP.M1_Introduction_To_Programming.Introduction_And_Basic_Components')
                    @break

                @case('ITECC2-topic-programming-languages-and-their-categories')
                    {{-- PROGRAMMING LANGUAGES AND THEIR CATEGORIES --}}
                    @include('Client.Review_Pages.Modules.ITECC2_CP.M1_Introduction_To_Programming.Programming_Languages_And_Categories')
                    @break

                @case('ITECC2-topic-the-program-development-life-cycle')
                    {{-- THE PROGRAM DEVELOPMENT LIFE CYCLE --}}
                    @include('Client.Review_Pages.Modules.ITECC2_CP.M1_Introduction_To_Programming.Program_Development_Life_Cycle')
                    @break

                @case('ITECC2-topic-program-flowchart')
                    {{-- PROGRAM FLOWCHART --}}
                    @include('Client.Review_Pages.Modules.ITECC2_CP.M1_Introduction_To_Programming.Program_Flowchart')
                    @break

            @endswitch
        </div>
    @endforeach

    {{-- SUMMARY --}}
    <div class="sharedSurfaceBG border sharedBorder rounded-xl p-6 mt-10">

        <h2 class="text-xl font-bold">
            {{$module->module_name}} Summary
        </h2>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            In this module, we learned what programming is and how a computer runs a program. We compared machine, assembly, and high-level languages, and we followed the steps of the Program Development Life Cycle from analysis to maintenance.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            We also learned to design a solution with a flowchart before writing any code.
        </p>

        <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="sharedTXTMuted mt-3 space-y-2 list-disc list-inside">

                <li>
                    A program is a set of instructions that tells the computer what to do.
                </li>

                <li>
                    The CPU runs programs that are loaded into RAM.
                </li>

                <li>
                    Languages are categorized by level, generation, and paradigm.
                </li>

                <li>
                    Compilers translate the whole program, while interpreters translate line by line.
                </li>

                <li>
                    The PDLC has six phases: analysis, design, coding, testing, implementation, and maintenance.
                </li>

                <li>
                    Flowcharts use standard symbols to show sequence, selection, and iteration.
                </li>

            </ul>

        </div>

    </div>

    <module-activity 
        :questions='@json($activity_questions)'
        :module-progress='@json($module_progress)'
        :module='@json($module)'
        :failed='@json($failed)'
        :answered-module-questions='@json($answered_module_questions)'
        :answered-questions='@json($answered_questions)'
        :score='@json($score)'
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

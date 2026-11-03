{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            A computer accepts data, processes it, stores the results, and presents useful information. Computers are now part of nearly every field, from education and health care to business and entertainment.
        </p>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            In this module, we will study the history and generations of computers, their functions, characteristics, and types, and the roles of hardware, software, and peopleware.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('ITECC1-topic-overview-of-information-technology-and-history-of-computers')
                    {{-- OVERVIEW OF INFORMATION TECHNOLOGY AND HISTORY OF COMPUTERS --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M1_Overview of IT.Overview_of_IT_History_of_Computers')
                    @break

                @case('ITECC1-topic-generations-of-computers')
                    {{-- GENERATIONS OF COMPUTERS --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M1_Overview of IT.Generation_of_Computers')
                    @break

                @case('ITECC1-topic-functions-characteristics-and-types-of-computers')
                    {{-- FUNCTIONS, CHARACTERISTICS, AND TYPES OF COMPUTERS --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M1_Overview of IT.Function_of_Computer')
                    @break

                @case('ITECC1-topic-hardware-software-and-peopleware')
                    {{-- HARDWARE, SOFTWARE, AND PEOPLEWARE --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M1_Overview of IT.HardwareSoftwarePeopleware')
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
            In this chapter, we studied how computers evolved from early calculating devices to the machines we use today, and how each generation of computers brought faster and smaller technology.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            We also learned the functions and characteristics of computers, and how hardware, software, and peopleware work together as one computer system.
        </p>

        <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="sharedTXTMuted mt-3 space-y-2 list-disc list-inside">

                <li>
                    IT uses computers and networks to create, process, store, secure, and exchange data.
                </li>

                <li>
                    Computers are grouped into five generations based on their core technology.
                </li>

                <li>
                    A computer accepts input, processes data, stores it, and produces output.
                </li>

                <li>
                    Hardware is physical, software is a set of programs, and peopleware is the people.
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

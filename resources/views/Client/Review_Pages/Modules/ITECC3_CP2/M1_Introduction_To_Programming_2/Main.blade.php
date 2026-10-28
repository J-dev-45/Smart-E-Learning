{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Computer Programming 2 builds on the fundamentals you learned before. You will move from writing simple programs to organizing data in arrays, processing it with algorithms, and designing programs with objects.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will review the basics of programming, practice programming problem-solving, compare procedural programming with other paradigms, and get an overview of object-oriented programming.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-review-of-programming-1-variables-conditions-loops-and-methods')
                    {{-- REVIEW OF PROGRAMMING 1: VARIABLES, CONDITIONS, LOOPS, AND METHODS --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M1_Introduction_To_Programming_2.Review_Of_Programming_1')
                    @break

                @case('topic-programming-problem-solving')
                    {{-- PROGRAMMING PROBLEM-SOLVING --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M1_Introduction_To_Programming_2.Programming_Problem_Solving')
                    @break

                @case('topic-procedural-programming-and-programming-paradigms')
                    {{-- PROCEDURAL PROGRAMMING AND PROGRAMMING PARADIGMS --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M1_Introduction_To_Programming_2.Procedural_Programming_And_Paradigms')
                    @break

                @case('topic-object-oriented-programming-overview')
                    {{-- OBJECT-ORIENTED PROGRAMMING OVERVIEW --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M1_Introduction_To_Programming_2.Object_Oriented_Programming_Overview')
                    @break

            @endswitch
        </div>
    @endforeach

    {{-- SUMMARY --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-6 mt-10">

        <h2 class="text-xl font-bold">
            {{$module->module_name}} Summary
        </h2>

        <p class="text-gray-400 mt-3 leading-relaxed">
            In this module, we reviewed variables, conditions, loops, and methods, and learned a step-by-step approach to solving programming problems.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We also compared procedural programming with object-oriented programming and saw why larger programs need better organization.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    Variables, conditions, loops, and methods are the foundation of every program.
                </li>

                <li>
                    Good problem-solving uses input-process-output analysis, planning, testing, and decomposition.
                </li>

                <li>
                    Procedural programming separates data from procedures, which becomes hard to manage in large programs.
                </li>

                <li>
                    OOP groups data and behavior into objects.
                </li>

                <li>
                    The four pillars of OOP are encapsulation, inheritance, polymorphism, and abstraction.
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
    <div class="flex items-start gap-3 mt-10 p-4 rounded-xl border border-amber-400/30 border-l-4 border-l-amber-400 bg-amber-400/5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5 shrink-0 text-amber-400 mt-0.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <div class="flex flex-col gap-0.5">
            <span class="text-sm font-bold text-amber-300">Pass the activity to continue</span>
            <p class="text-sm text-gray-400 leading-relaxed">
                You must pass the activity above to unlock the
                <span class="text-white">Quiz</span>
                @if($module->has_coding)
                and
                <span class="text-white">Coding</span>
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
    >
    </module-quiz-buttons>

</div>

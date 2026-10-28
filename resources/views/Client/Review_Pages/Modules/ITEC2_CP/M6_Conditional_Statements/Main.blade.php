{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Programs must be able to make decisions. A conditional statement checks a condition and chooses which instructions to run.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will study comparison operators and Boolean expressions, the if and else statements, and the switch-case statement.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-comparison-operators-and-boolean-expressions')
                    {{-- COMPARISON OPERATORS AND BOOLEAN EXPRESSIONS --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M6_Conditional_Statements.Comparison_Operators_And_Boolean_Expressions')
                    @break

                @case('topic-conditional-statements-if-and-else')
                    {{-- CONDITIONAL STATEMENTS: IF AND ELSE --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M6_Conditional_Statements.If_And_Else_Statements')
                    @break

                @case('topic-conditional-statement-switch-case')
                    {{-- CONDITIONAL STATEMENT: SWITCH-CASE --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M6_Conditional_Statements.Switch_Case_Statement')
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
            In this module, we learned how Boolean expressions give true or false and how conditional statements use them to control the flow of a program.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We compared if, if-else, else-if ladders, nested if, and the switch statement, and learned when to use each.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    A Boolean expression always gives true or false.
                </li>

                <li>
                    Use == for comparing values and equals() for comparing Strings.
                </li>

                <li>
                    if-else-if checks conditions from top to bottom and runs the first true block.
                </li>

                <li>
                    Use braces with every if statement.
                </li>

                <li>
                    switch compares one value against several constants and needs break to avoid fall-through.
                </li>

                <li>
                    Use switch for exact values and if-else for ranges.
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

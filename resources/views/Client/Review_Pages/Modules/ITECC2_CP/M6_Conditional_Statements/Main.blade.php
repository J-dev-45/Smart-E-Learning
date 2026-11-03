{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            Programs must be able to make decisions. A conditional statement checks a condition and chooses which instructions to run.
        </p>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            In this module, we will study comparison operators and Boolean expressions, the if and else statements, and the switch-case statement.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('ITECC2-topic-comparison-operators-and-boolean-expressions')
                    {{-- COMPARISON OPERATORS AND BOOLEAN EXPRESSIONS --}}
                    @include('Client.Review_Pages.Modules.ITECC2_CP.M6_Conditional_Statements.Comparison_Operators_And_Boolean_Expressions')
                    @break

                @case('ITECC2-topic-conditional-statements-if-and-else')
                    {{-- CONDITIONAL STATEMENTS: IF AND ELSE --}}
                    @include('Client.Review_Pages.Modules.ITECC2_CP.M6_Conditional_Statements.If_And_Else_Statements')
                    @break

                @case('ITECC2-topic-conditional-statement-switch-case')
                    {{-- CONDITIONAL STATEMENT: SWITCH-CASE --}}
                    @include('Client.Review_Pages.Modules.ITECC2_CP.M6_Conditional_Statements.Switch_Case_Statement')
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
            In this module, we learned how Boolean expressions give true or false and how conditional statements use them to control the flow of a program.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            We compared if, if-else, else-if ladders, nested if, and the switch statement, and learned when to use each.
        </p>

        <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="sharedTXTMuted mt-3 space-y-2 list-disc list-inside">

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

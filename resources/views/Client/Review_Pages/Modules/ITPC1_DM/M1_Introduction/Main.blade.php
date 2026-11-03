{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            Discrete Mathematics is the study of mathematical structures that
            are distinct and countable. It focuses on objects such as sets,
            logic, relations, functions, graphs, and mathematical proofs.
        </p>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            Discrete Mathematics is an important foundation of computer science.
            It is used in algorithms, programming, databases, cybersecurity,
            artificial intelligence, and many other areas of computing.
        </p>
    </div>
    


    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('ITPC1-topic-logic')
                    {{-- LOGIC --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M1_Introduction.Logic')
                    @break

                @case('ITPC1-topic-sets-and-set-operations')
                    {{-- SETS AND SET OPERATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M1_Introduction.Sets_And_Set_Operation')
                    @break

                @case('ITPC1-topic-properties-of-set')
                    {{-- PROPERTIES OF SET --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M1_Introduction.Properties_Of_Set')
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
            In this module, we introduced the fundamental concepts of
            Discrete Mathematics and explored how mathematical reasoning
            can be applied to problems in mathematics and information
            technology.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            We first discussed <span class="sharedTXT">Logic</span>,
            including propositions, logical connectives, compound
            propositions, truth tables, tautologies, contradictions,
            propositional equivalence, and rules of inference. These
            concepts provide a foundation for expressing and evaluating
            logical statements.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            We then studied <span class="sharedTXT">Sets and Set
            Operations</span>. A set is a well-defined collection of
            distinct objects. We explored different types of sets,
            membership, subsets, and operations such as union,
            intersection, difference, and complement.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            Finally, we examined the <span class="sharedTXT">Properties
            of Sets</span>, including the commutative, associative,
            distributive, identity, complement, idempotent, domination,
            double complement, absorption, and De Morgan's properties.
            These rules allow set expressions to be simplified,
            transformed, and compared without changing their meaning.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            Understanding logic, sets, set operations, and their
            properties provides an important foundation for later topics
            in Discrete Mathematics and their applications in information
            technology, including databases, programming, data
            organization, and problem solving.
        </p>

        <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="sharedTXTMuted mt-3 space-y-2 list-disc list-inside">

                <li>
                    Logic provides methods for representing and evaluating
                    mathematical statements.
                </li>

                <li>
                    Propositions can be combined using logical
                    connectives and evaluated using truth tables.
                </li>

                <li>
                    Sets represent well-defined collections of distinct
                    objects.
                </li>

                <li>
                    Set operations include union, intersection,
                    difference, and complement.
                </li>

                <li>
                    Set properties provide rules for simplifying and
                    transforming set expressions.
                </li>

                <li>
                    These concepts form a foundation for problem solving
                    and applications in information technology.
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
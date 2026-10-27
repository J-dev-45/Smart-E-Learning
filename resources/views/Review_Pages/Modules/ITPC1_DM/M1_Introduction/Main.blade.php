{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto min-w-0">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-lg sm:text-xl font-bold pt-3 sm:pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
            Discrete Mathematics is the study of mathematical structures that
            are distinct and countable. It focuses on objects such as sets,
            logic, relations, functions, graphs, and mathematical proofs.
        </p>

        <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
            Discrete Mathematics is an important foundation of computer science.
            It is used in algorithms, programming, databases, cybersecurity,
            artificial intelligence, and many other areas of computing.
        </p>
    </div>
    


    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-6 sm:mt-10 mb-10 sm:mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-4 sm:p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-logic')
                    {{-- LOGIC --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M1_Introduction.Logic')
                    @break

                @case('topic-sets-and-set-operations')
                    {{-- SETS AND SET OPERATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M1_Introduction.Sets_And_Set_Operation')
                    @break

                @case('topic-properties-of-set')
                    {{-- PROPERTIES OF SET --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M1_Introduction.Properties_Of_Set')
                    @break

            @endswitch
        </div>
    @endforeach

    {{-- SUMMARY --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-4 sm:p-6 mt-6 sm:mt-10">

        <h2 class="text-lg sm:text-xl font-bold">
            {{$module->module_name}} Summary
        </h2>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            In this module, we introduced the fundamental concepts of
            Discrete Mathematics and explored how mathematical reasoning
            can be applied to problems in mathematics and information
            technology.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            We first discussed <span class="text-white">Logic</span>,
            including propositions, logical connectives, compound
            propositions, truth tables, tautologies, contradictions,
            propositional equivalence, and rules of inference. These
            concepts provide a foundation for expressing and evaluating
            logical statements.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            We then studied <span class="text-white">Sets and Set
            Operations</span>. A set is a well-defined collection of
            distinct objects. We explored different types of sets,
            membership, subsets, and operations such as union,
            intersection, difference, and complement.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            Finally, we examined the <span class="text-white">Properties
            of Sets</span>, including the commutative, associative,
            distributive, identity, complement, idempotent, domination,
            double complement, absorption, and De Morgan's properties.
            These rules allow set expressions to be simplified,
            transformed, and compared without changing their meaning.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            Understanding logic, sets, set operations, and their
            properties provides an important foundation for later topics
            in Discrete Mathematics and their applications in information
            technology, including databases, programming, data
            organization, and problem solving.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-5">

            <h3 class="text-base sm:text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside break-words">

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
    <div class="flex items-start gap-3 mt-6 sm:mt-10 p-4 rounded-xl border border-amber-400/30 border-l-4 border-l-amber-400 bg-amber-400/5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5 shrink-0 text-amber-400 mt-0.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <div class="flex flex-col gap-0.5">
            <span class="text-sm font-bold text-amber-300">Pass the activity to continue</span>
            <p class="text-sm text-gray-400 leading-relaxed break-words">
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
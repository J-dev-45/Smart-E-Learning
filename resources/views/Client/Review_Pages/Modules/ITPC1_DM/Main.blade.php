{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Discrete Mathematics is the study of mathematical structures that
            are distinct and countable. It focuses on objects such as sets,
            logic, relations, functions, graphs, and mathematical proofs.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Discrete Mathematics is an important foundation of computer science.
            It is used in algorithms, programming, databases, cybersecurity,
            artificial intelligence, and many other areas of computing.
        </p>
    </div>
    


    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-logic')
                    {{-- LOGIC --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.Logic')
                    @break

                @case('topic-sets-and-set-operations')
                    {{-- SETS AND SET OPERATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.Sets_And_Set_Operation')
                    @break

                @case('topic-properties-of-set')
                    {{-- PROPERTIES OF SET --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.Properties_Of_Set')
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
            In this module, we introduced the fundamental concepts of
            Discrete Mathematics and explored how mathematical reasoning
            can be applied to problems in mathematics and information
            technology.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We first discussed <span class="text-white">Logic</span>,
            including propositions, logical connectives, compound
            propositions, truth tables, tautologies, contradictions,
            propositional equivalence, and rules of inference. These
            concepts provide a foundation for expressing and evaluating
            logical statements.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We then studied <span class="text-white">Sets and Set
            Operations</span>. A set is a well-defined collection of
            distinct objects. We explored different types of sets,
            membership, subsets, and operations such as union,
            intersection, difference, and complement.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            Finally, we examined the <span class="text-white">Properties
            of Sets</span>, including the commutative, associative,
            distributive, identity, complement, idempotent, domination,
            double complement, absorption, and De Morgan's properties.
            These rules allow set expressions to be simplified,
            transformed, and compared without changing their meaning.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            Understanding logic, sets, set operations, and their
            properties provides an important foundation for later topics
            in Discrete Mathematics and their applications in information
            technology, including databases, programming, data
            organization, and problem solving.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

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

    
</div>
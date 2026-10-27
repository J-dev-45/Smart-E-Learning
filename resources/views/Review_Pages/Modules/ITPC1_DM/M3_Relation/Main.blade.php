
{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto min-w-0">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-lg sm:text-xl font-bold pt-3 sm:pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
            A relation is a mathematical connection between elements of sets.
            Relations are represented using ordered pairs and are important
            in Discrete Mathematics, databases, networks, and computer science.
        </p>

        <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
            In this module, we will study the definitions and properties of
            relations, binary relations, equality of relations, operations
            on binary relations, types of relations, matrix representations,
            and digraph representations of binary relations.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-6 sm:mt-10 mb-10 sm:mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-4 sm:p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-definitions-and-properties-of-relation')
                    {{-- DEFINITIONS AND PROPERTIES OF RELATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Definitions_And_Properties_Of_Relation')
                    @break

                @case('topic-binary-relation')
                    {{-- BINARY RELATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Binary_Relation')
                    @break

                @case('topic-equality-of-relations')
                    {{-- EQUALITY OF RELATIONS --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Equality_Of_Relations')
                    @break

                @case('topic-properties-and-operations-of-binary-relation')
                    {{-- PROPERTIES AND OPERATIONS OF BINARY RELATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Properties_And_Operations_Of_Binary_Relation')
                    @break

                @case('topic-types-of-relation')
                    {{-- TYPES OF RELATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Types_Of_Relation')
                    @break

                @case('topic-matrices-representing-relation')
                    {{-- MATRICES REPRESENTING RELATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Matrices_Representing_Relation')
                    @break

                @case('topic-digraph-representation-of-binary-relation')
                    {{-- DIGRAPH REPRESENTATION OF BINARY RELATION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M3_Relation.Digraph_Representation_Of_Binary_Relation')
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
            In this module, we studied relations as sets of ordered pairs
            that describe connections between elements. We explored binary
            relations and how relations can be compared and combined using
            set operations.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            We also studied the properties of relations, including
            <span class="text-white">reflexivity</span>,
            <span class="text-white">symmetry</span>,
            <span class="text-white">antisymmetry</span>, and
            <span class="text-white">transitivity</span>. These properties
            help classify relations, including equivalence relations and
            partial order relations.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            Finally, we learned how to represent binary relations using
            matrices and directed graphs. These representations provide
            different ways to understand and analyze relationships between
            elements in mathematical and computing applications.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-5">

            <h3 class="text-base sm:text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside break-words">

                <li>
                    A relation is a set of ordered pairs.
                </li>

                <li>
                    A binary relation connects elements from two sets.
                </li>

                <li>
                    Equal relations contain exactly the same ordered pairs.
                </li>

                <li>
                    Relations can be combined using union, intersection,
                    difference, and inverse operations.
                </li>

                <li>
                    Relations can be reflexive, symmetric, antisymmetric,
                    or transitive.
                </li>

                <li>
                    Equivalence relations are reflexive, symmetric, and transitive.
                </li>

                <li>
                    Partial order relations are reflexive, antisymmetric,
                    and transitive.
                </li>

                <li>
                    Matrices and digraphs provide visual and structured
                    representations of relations.
                </li>

            </ul>

        </div>

    </div>

    


</div>

<div class="mt-6 sm:mt-10 mb-10 sm:mb-20 rounded-2xl">

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

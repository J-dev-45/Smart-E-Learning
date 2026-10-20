<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Propositional Logic studies declarative statements called propositions and how their truth values
            behave when statements are combined or modified using logical connectives.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            This module covers the definition and elements of propositional logic, five logical connectives,
            truth tables, logical operations, tautologies, propositional equivalence, and rules of inference.
        </p>
    </div>

    @php
        $module_topics = $topics->where('module_id', $module->id);
    @endphp

    {{-- ================= TOPICS ================= --}}
    @foreach($module_topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

            @case('topic-definition-of-propositional-logic')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Propositional_Logic_Definition')
                @break

            @case('topic-elements-of-propositional-logic')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Elements_Of_Propositional_Logic')
                @break

            @case('topic-five-logical-connectives')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Five_Logical_Connectives')
                @break

            @case('topic-truth-tables')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Truth_Tables')
                @break

            @case('topic-logical-operations')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Logical_Operations')
                @break

            @case('topic-tautologies')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Tautologies')
                @break

            @case('topic-propositional-equivalence')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Propositional_Equivalence')
                @break

            @case('topic-rules-of-inference')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M5_Propositional_Logic.Rules_Of_Inference')
                @break

            @endswitch
        </div>
    @endforeach

    {{-- SUMMARY --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-6 mt-10">
        <h2 class="text-xl font-bold">
            Module 5 Summary
        </h2>

        <p class="text-gray-400 mt-3 leading-relaxed">
            In this module, we studied propositions, truth values, logical connectives, truth tables, compound
            logical operations, tautologies, logical equivalences, and rules of inference used to draw valid
            conclusions from premises.
        </p>
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

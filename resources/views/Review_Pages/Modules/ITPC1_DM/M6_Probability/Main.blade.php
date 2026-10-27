<div class="w-full max-w-5xl mx-auto min-w-0">

    <div class="w-full">
        <h4 class="text-lg sm:text-xl font-bold pt-3 sm:pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
            Probability measures uncertainty and describes how likely an event is to occur. It provides a mathematical way to reason about random experiments and their possible outcomes.
        </p>

        <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
            This module covers basic probability concepts, sample spaces and events, probability properties, and conditional probability.
        </p>
    </div>

    @php
        $module_topics = $topics->where('module_id', $module->id);
    @endphp

    @foreach($module_topics as $topic)
        <div class="mt-6 sm:mt-10 mb-10 sm:mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-4 sm:p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)
            @case('topic-basic-concepts-of-probability')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M6_Probability.Basic_Concepts_Of_Probability')
                @break
            @case('topic-conditional-probability')
                @include('Client.Review_Pages.Modules.ITPC1_DM.M6_Probability.Conditional_Probability')
                @break
            @endswitch
        </div>
    @endforeach

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-4 sm:p-6 mt-6 sm:mt-10">
        <h2 class="text-lg sm:text-xl font-bold">Module 6 Summary</h2>
        <p class="text-gray-400 mt-3 leading-relaxed break-words">In this module, we studied probability as a measure of uncertainty, the sample space and events, classical probability, and basic probability properties. Conditional probability uses known information to calculate the chance of an event, while independence describes events whose occurrence does not change one another's probabilities.</p>
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

    <div class="flex items-start gap-3 mt-6 sm:mt-10 p-4 rounded-xl border border-amber-400/30 border-l-4 border-l-amber-400 bg-amber-400/5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5 shrink-0 text-amber-400 mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
        <div class="flex flex-col gap-0.5"><span class="text-sm font-bold text-amber-300">Pass the activity to continue</span><p class="text-sm text-gray-400 leading-relaxed break-words">You must pass the activity above to unlock the <span class="text-white">Quiz</span> @if($module->has_coding) and <span class="text-white">Coding</span> @endif assessments.</p></div>
    </div>

    <module-quiz-buttons :subject='@json($subject)' :module='@json($module)' :module-progress='@json($module_progress)' :module-quiz='@json($module_quiz)'></module-quiz-buttons>
</div>

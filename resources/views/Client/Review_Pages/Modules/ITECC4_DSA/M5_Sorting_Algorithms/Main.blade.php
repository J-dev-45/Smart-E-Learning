<div class="w-full max-w-5xl mx-auto">
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">{$module->module_name}</h4>
        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">This module introduces sorting algorithms through concepts, examples, and Java-oriented applications. The lessons follow the topics specified in the Data Structures and Algorithms course syllabus.</p>
        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">Focus on choosing an appropriate structure or algorithm, tracing its behavior, and explaining its time and space costs where relevant.</p>
    </div>
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)
                @case('ITECC4-topic-bubble-sort')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M5_Sorting_Algorithms.Bubble_Sort')
                    @break

                @case('ITECC4-topic-selection-sort')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M5_Sorting_Algorithms.Selection_Sort')
                    @break

                @case('ITECC4-topic-insertion-sort')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M5_Sorting_Algorithms.Insertion_Sort')
                    @break

            @endswitch
        </div>
    @endforeach
    <div class="sharedSurfaceBG border sharedBorder rounded-xl p-6 mt-10">
        <h2 class="text-xl font-bold">{{$module->module_name}} Summary</h2>
        <p class="sharedTXTMuted mt-3 leading-relaxed">Bubble, Selection, and Insertion Sort are simple comparison sorts. Trace comparisons and swaps or shifts to understand how the sorted region grows.</p>
        <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-5">
            <h3 class="text-lg font-bold">Key Takeaways</h3>
            <ul class="sharedTXTMuted mt-3 space-y-2 list-disc list-inside"><li>These sorts use O(1) extra space.</li><li>Their average/worst time is O(n²).</li><li>Insertion Sort can be O(n) on already sorted input.</li></ul>
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
    <div class="flex items-start gap-3 mt-10 p-4 rounded-xl border sharedBorderWarningSoft border-l-4 sharedBorderLWarning sharedBGWarningTint">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5 shrink-0 sharedTXTWarning mt-0.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378a2.25 2.25 0 0 0-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <div class="flex flex-col gap-0.5">
            <span class="text-sm font-bold sharedTXTWarning">Pass the activity to continue</span>
            <p class="text-sm sharedTXTMuted leading-relaxed">You must pass the activity above to unlock the <span class="sharedTXT">Quiz</span> @if($module->has_coding) and <span class="sharedTXT">Coding</span> @endif assessments.</p>
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

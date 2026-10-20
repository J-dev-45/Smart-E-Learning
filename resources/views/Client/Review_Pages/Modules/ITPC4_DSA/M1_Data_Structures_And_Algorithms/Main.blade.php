<div class="w-full max-w-5xl mx-auto">
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">{{$module->module_name}}</h4>
        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">This module introduces data structures and algorithms through concepts, examples, and Java-oriented applications. The lessons follow the topics specified in the Data Structures and Algorithms course syllabus.</p>
        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">Focus on choosing an appropriate structure or algorithm, tracing its behavior, and explaining its time and space costs where relevant.</p>
    </div>
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)
                @case('topic-what-are-data-structures-and-algorithms')
                    @include('Client.Review_Pages.Modules.ITPC4_DSA.M1_Data_Structures_And_Algorithms.What_Are_Data_Structures_and_Algorithms')
                    @break

                @case('topic-java-basics-review')
                    @include('Client.Review_Pages.Modules.ITPC4_DSA.M1_Data_Structures_And_Algorithms.Java_Basics_Review')
                    @break

                @case('topic-stacks')
                    @include('Client.Review_Pages.Modules.ITPC4_DSA.M1_Data_Structures_And_Algorithms.Stacks')
                    @break

            @endswitch
        </div>
    @endforeach
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-6 mt-10">
        <h2 class="text-xl font-bold">{{$module->module_name}} Summary</h2>
        <p class="text-gray-400 mt-3 leading-relaxed">Choose a structure that fits the operations a program performs. Java arrays and loops support basic algorithms; a stack follows last-in, first-out order.</p>
        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">
            <h3 class="text-lg font-bold">Key Takeaways</h3>
            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside"><li>Data structures organize data; algorithms process it.</li><li>Java arrays use zero-based indexing.</li><li>A stack supports push, pop, and peek in constant time.</li></ul>
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
    <div class="flex items-start gap-3 mt-10 p-4 rounded-xl border border-amber-400/30 border-l-4 border-l-amber-400 bg-amber-400/5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5 shrink-0 text-amber-400 mt-0.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378a2.25 2.25 0 0 0-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <div class="flex flex-col gap-0.5">
            <span class="text-sm font-bold text-amber-300">Pass the activity to continue</span>
            <p class="text-sm text-gray-400 leading-relaxed">You must pass the activity above to unlock the <span class="text-white">Quiz</span> @if($module->has_coding) and <span class="text-white">Coding</span> @endif assessments.</p>
        </div>
    </div>
    <module-quiz-buttons :subject='@json($subject)' :module='@json($module)' :module-progress='@json($module_progress)' :module-quiz='@json($module_quiz)'></module-quiz-buttons>
</div>

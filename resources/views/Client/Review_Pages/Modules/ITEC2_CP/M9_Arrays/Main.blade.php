{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            When a program must handle many values of the same kind, such as the scores of a whole class, it needs a better tool than separate variables. An array stores many values under one name.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will study what arrays are, how to declare and allocate them, how to access, read, and print their elements, and how to iterate through them, including two-dimensional arrays.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-what-is-an-array-declaration-and-memory-allocation')
                    {{-- WHAT IS AN ARRAY, DECLARATION, AND MEMORY ALLOCATION --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M9_Arrays.Arrays_Declaration_And_Memory')
                    @break

                @case('topic-accessing-reading-and-printing-array-elements')
                    {{-- ACCESSING, READING, AND PRINTING ARRAY ELEMENTS --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M9_Arrays.Array_Access_Reading_And_Printing')
                    @break

                @case('topic-iteration-through-array-elements-and-two-dimensional-arrays')
                    {{-- ITERATION THROUGH ARRAY ELEMENTS AND TWO-DIMENSIONAL ARRAYS --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M9_Arrays.Array_Iteration_And_Two_Dimensional')
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
            In this module, we learned that an array is a fixed-size collection of elements of the same type that are accessed by index.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We also learned how to fill, print, and process arrays with loops, and how two-dimensional arrays work like tables.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    Array indexes start at 0 and the last index is length - 1.
                </li>

                <li>
                    The size of an array is fixed when it is created.
                </li>

                <li>
                    Use new to allocate an array, or braces to give initial values.
                </li>

                <li>
                    Arrays are objects, so array variables hold references.
                </li>

                <li>
                    Use a loop with i &lt; array.length to visit every element.
                </li>

                <li>
                    A two-dimensional array is accessed with a row index and a column index.
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

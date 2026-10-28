{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Text is one of the most common kinds of data in programs. Names, messages, and addresses are all strings, and Java provides many methods to work with them.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will study strings and the methods Length, ToUpper, ToLower, Concat, Replace, Remove, Trim, TrimStart, TrimEnd, and Substring, together with their Java equivalents.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-strings-length-toupper-and-tolower')
                    {{-- STRINGS, LENGTH(), TOUPPER, AND TOLOWER --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M8_String.String_Basics_Case_And_Length')
                    @break

                @case('topic-concat-replace-and-remove')
                    {{-- CONCAT(), REPLACE(), AND REMOVE() --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M8_String.Concat_Replace_And_Remove')
                    @break

                @case('topic-trim-trimstart-trimend-and-substring')
                    {{-- TRIM(), TRIMSTART(), TRIMEND(), AND SUBSTRING --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M8_String.Trim_And_Substring')
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
            In this module, we learned that strings are immutable objects and that their methods return new strings.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We studied the common string operations, and compared the C# style names in the outline with the Java methods that do the same work.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    A String is an immutable object, so its methods return a new string.
                </li>

                <li>
                    Indexes start at 0 and length() gives the number of characters.
                </li>

                <li>
                    toUpperCase() and toLowerCase() change letter case.
                </li>

                <li>
                    Java has no remove(). Use replace(), substring(), or StringBuilder.
                </li>

                <li>
                    trim() and strip() remove whitespace, and stripLeading() and stripTrailing() act on one side.
                </li>

                <li>
                    substring(start, end) excludes the end index.
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

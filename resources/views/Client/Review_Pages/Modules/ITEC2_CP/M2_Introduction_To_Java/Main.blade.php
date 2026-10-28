{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Java is one of the most widely used programming languages in the world. It powers Android apps, enterprise systems, and web servers, and its rules of syntax and structure are a strong foundation for learning other languages.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will study the basic syntax of Java, the structure of a Java program, comments, member variables and functions, how to create objects, identifiers and keywords, and how to compile and run a program.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-basic-syntax-and-java-program-structure')
                    {{-- BASIC SYNTAX AND JAVA PROGRAM STRUCTURE --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M2_Introduction_To_Java.Basic_Syntax_And_Program_Structure')
                    @break

                @case('topic-comments-member-variables-and-member-functions')
                    {{-- COMMENTS, MEMBER VARIABLES, AND MEMBER FUNCTIONS --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M2_Introduction_To_Java.Comments_Member_Variables_And_Member_Functions')
                    @break

                @case('topic-instantiating-a-class-identifiers-and-java-keywords')
                    {{-- INSTANTIATING A CLASS, IDENTIFIERS, AND JAVA KEYWORDS --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M2_Introduction_To_Java.Instantiating_A_Class_Identifiers_And_Keywords')
                    @break

                @case('topic-compiling-and-executing-a-java-program')
                    {{-- COMPILING AND EXECUTING A JAVA PROGRAM --}}
                    @include('Client.Review_Pages.Modules.ITEC2_CP.M2_Introduction_To_Java.Compiling_And_Executing_A_Program')
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
            In this module, we wrote our first Java program and learned the basic syntax rules. We studied how a class contains member variables and member functions, and how objects are created from a class.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We also learned how to name things properly and how to compile and run a program using javac and java.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    Every Java program is written inside a class, and execution starts in the main method.
                </li>

                <li>
                    Java is case-sensitive and every statement ends with a semicolon.
                </li>

                <li>
                    Comments are ignored by the compiler and make code easier to understand.
                </li>

                <li>
                    Objects are created from classes with the new keyword.
                </li>

                <li>
                    Identifiers follow naming rules and must not be keywords.
                </li>

                <li>
                    javac compiles source code into bytecode, and the JVM runs the bytecode.
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

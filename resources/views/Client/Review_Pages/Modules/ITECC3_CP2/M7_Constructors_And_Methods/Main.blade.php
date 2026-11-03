{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            Constructors set up new objects correctly, and methods define what objects can do. Together they make classes practical and safe to use.
        </p>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            In this module, we will study constructors, instance and static methods, parameters and return values, and method overloading, and apply them in a Student Information System.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('ITECC3-topic-constructors')
                    {{-- CONSTRUCTORS --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M7_Constructors_And_Methods.Constructors')
                    @break

                @case('ITECC3-topic-instance-methods-static-methods-parameters-and-return-values')
                    {{-- INSTANCE METHODS, STATIC METHODS, PARAMETERS, AND RETURN VALUES --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M7_Constructors_And_Methods.Instance_Methods_Static_Methods_Parameters_And_Return_Values')
                    @break

                @case('ITECC3-topic-method-overloading-and-the-student-information-system')
                    {{-- METHOD OVERLOADING AND THE STUDENT INFORMATION SYSTEM --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M7_Constructors_And_Methods.Method_Overloading_And_Student_Information_System')
                    @break

            @endswitch
        </div>
    @endforeach

    {{-- SUMMARY --}}
    <div class="sharedSurfaceBG border sharedBorder rounded-xl p-6 mt-10">

        <h2 class="text-xl font-bold">
            {{$module->module_name}} Summary
        </h2>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            In this module, we learned how constructors initialize objects and how methods use parameters and return values.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            We also learned the difference between instance and static members and applied them in a simple Student Information System.
        </p>

        <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="sharedTXTMuted mt-3 space-y-2 list-disc list-inside">

                <li>
                    A constructor has the same name as the class and no return type.
                </li>

                <li>
                    Writing a constructor removes the default constructor.
                </li>

                <li>
                    Static members belong to the class, while instance members belong to objects.
                </li>

                <li>
                    A method may return a value of its declared type, or nothing if it is void.
                </li>

                <li>
                    Overloaded methods share a name but have different parameter lists.
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
    <div class="flex items-start gap-3 mt-10 p-4 rounded-xl border sharedBorderWarningSoft border-l-4 sharedBorderLWarning sharedBGWarningTint">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5 shrink-0 sharedTXTWarning mt-0.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <div class="flex flex-col gap-0.5">
            <span class="text-sm font-bold sharedTXTWarning">Pass the activity to continue</span>
            <p class="text-sm sharedTXTMuted leading-relaxed">
                You must pass the activity above to unlock the
                <span class="sharedTXT">Quiz</span>
                @if($module->has_coding)
                and
                <span class="sharedTXT">Coding</span>
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
        :next-module='@json($next_module)'
    >
    </module-quiz-buttons>

</div>

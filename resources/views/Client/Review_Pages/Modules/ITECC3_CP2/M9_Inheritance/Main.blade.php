{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Inheritance lets a new class reuse the attributes and methods of an existing class. It reduces repetition and organizes related classes in a hierarchy.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will study inheritance, the extends keyword, method overriding, the super keyword, and a School Management System.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-meaning-of-inheritance-superclass-and-subclass')
                    {{-- MEANING OF INHERITANCE, SUPERCLASS, AND SUBCLASS --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M9_Inheritance.Meaning_Of_Inheritance_And_Extends')
                    @break

                @case('topic-method-inheritance-method-overriding-and-the-super-keyword')
                    {{-- METHOD INHERITANCE, METHOD OVERRIDING, AND THE SUPER KEYWORD --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M9_Inheritance.Method_Inheritance_Overriding_And_Super')
                    @break

                @case('topic-laboratory-school-management-system')
                    {{-- LABORATORY: SCHOOL MANAGEMENT SYSTEM --}}
                    @include('Client.Review_Pages.Modules.ITECC3_CP2.M9_Inheritance.School_Management_System')
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
            In this module, we learned that a subclass inherits the accessible members of its superclass and can add or override them.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We used super to call parent methods and constructors, and built a School Management System with a Person hierarchy.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    Inheritance models an is-a relationship.
                </li>

                <li>
                    Java uses the extends keyword and allows only single inheritance for classes.
                </li>

                <li>
                    A subclass can override inherited methods, and &#64;Override helps catch mistakes.
                </li>

                <li>
                    super calls a superclass method or constructor.
                </li>

                <li>
                    The superclass constructor runs before the subclass constructor.
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

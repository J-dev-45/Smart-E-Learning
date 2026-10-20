{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Software is the set of instructions that makes computer hardware useful. Without software, a computer is only a collection of electronic parts.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will study system software and operating systems, utility software, and the main categories of application software.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-system-software-and-operating-systems')
                    {{-- SYSTEM SOFTWARE AND OPERATING SYSTEMS --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M3_Computer_Software.System_Software_And_Operating_Systems')
                    @break

                @case('topic-utility-software-and-application-software')
                    {{-- UTILITY SOFTWARE AND APPLICATION SOFTWARE --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M3_Computer_Software.Utilities_And_Application_Software')
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
            In this module, we studied how system software, especially the operating system, manages the hardware and gives users a way to use the computer.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We also learned about utility software that maintains the computer and the application software categories that help users complete specific tasks.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    System software manages the computer; application software helps users do tasks.
                </li>

                <li>
                    The operating system manages processes, memory, files, devices, and security.
                </li>

                <li>
                    Operating systems can be grouped as desktop, server, mobile, and embedded.
                </li>

                <li>
                    Utility software maintains and protects the computer.
                </li>

                <li>
                    The right application software depends on the needs of the user or organization.
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

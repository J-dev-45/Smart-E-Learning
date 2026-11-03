{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            A function is a mathematical relationship that assigns exactly
            one output to each input from a given set. Functions are used
            to describe relationships between values and are important in
            Discrete Mathematics, programming, algorithms, and data processing.
        </p>

        <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
            In this module, we will study the definition of a function and
            three important types of functions: injective, surjective, and
            bijective functions. These concepts help us understand how inputs
            and outputs are related and how elements of two sets correspond.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('ITPC1-topic-definition-of-function')
                    {{-- DEFINITION OF FUNCTION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M2_Functions.Definition_Of_Function')
                    @break

                @case('ITPC1-topic-types-of-function')
                    {{-- TYPES OF FUNCTION --}}
                    @include('Client.Review_Pages.Modules.ITPC1_DM.M2_Functions.Types_Of_Function')
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
            In this module, we studied functions as mathematical
            relationships that assign exactly one output to every input
            in the domain. We also explored how functions map elements
            from one set to another.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            An <span class="sharedTXT">injective function</span> assigns
            different outputs to different inputs. A
            <span class="sharedTXT">surjective function</span> maps every
            element in the codomain to at least one input from the domain.
        </p>

        <p class="sharedTXTMuted mt-3 leading-relaxed">
            A <span class="sharedTXT">bijective function</span> is both
            injective and surjective. Every element in the codomain is
            matched with exactly one element in the domain, allowing a
            one-to-one correspondence between the two sets.
        </p>

        <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="sharedTXTMuted mt-3 space-y-2 list-disc list-inside">

                <li>
                    A function assigns exactly one output to each input.
                </li>

                <li>
                    The domain contains the possible inputs.
                </li>

                <li>
                    The codomain contains the designated possible outputs.
                </li>

                <li>
                    Injective functions do not assign the same output
                    to two different inputs.
                </li>

                <li>
                    Surjective functions cover every element of the codomain.
                </li>

                <li>
                    Bijective functions are both injective and surjective.
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

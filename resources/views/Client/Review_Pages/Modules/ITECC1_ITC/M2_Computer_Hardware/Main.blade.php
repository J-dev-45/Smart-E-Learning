{{-- MODULE --}}
<div class="w-full max-w-5xl mx-auto">

    {{-- INTRODUCTION --}}
    <div class="w-full">
        <h4 class="text-xl font-bold pt-5">
            {{$module->module_name}}
        </h4>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            Computers are built from hardware components that work together, and they represent all information using only the digits 0 and 1.
        </p>

        <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
            In this module, we will study the hardware revolution, the sub-systems and peripherals of a computer, bits and bytes, and the number systems used in computing.
        </p>
    </div>

    {{-- ================= TOPICS ================= --}}
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border border-[#3A2560] border-l-4 border-l-[#8B5CF6] bg-[#150A24] p-6 shadow-lg shadow-black/30 [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)

                @case('topic-computer-hardware-revolution')
                    {{-- COMPUTER HARDWARE REVOLUTION --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M2_Computer_Hardware.Computer_Hardware_Revolution')
                    @break

                @case('topic-computer-sub-systems-and-peripherals')
                    {{-- COMPUTER SUB-SYSTEMS AND PERIPHERALS --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M2_Computer_Hardware.Computer_Hardware_SubSystemandPeripherals')
                    @break

                @case('topic-bits-bytes-data-and-information')
                    {{-- BITS, BYTES, DATA, AND INFORMATION --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M2_Computer_Hardware.Bits_Bytes_Data_and_Information')
                    @break

                @case('topic-the-computer-number-system')
                    {{-- THE COMPUTER NUMBER SYSTEM --}}
                    @include('Client.Review_Pages.Modules.ITECC1_ITC.M2_Computer_Hardware.Computer_Number_System')
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
            In this chapter, we studied the sub-systems and peripherals that make up computer hardware, and how computers store all information as bits and bytes.
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            We also learned the decimal, binary, octal, and hexadecimal number systems and how to convert numbers between them.
        </p>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-5">

            <h3 class="text-lg font-bold">
                Key Takeaways
            </h3>

            <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">

                <li>
                    The CPU, memory, storage, and peripherals work together as the sub-systems of a computer.
                </li>

                <li>
                    A bit is a 0 or 1 and a byte is 8 bits.
                </li>

                <li>
                    Data are raw facts, while information is processed and meaningful data.
                </li>

                <li>
                    Binary is the language of the computer; octal and hexadecimal are shorthand forms of binary.
                </li>

                <li>
                    Numbers can be converted between systems using positional values, division, and bit grouping.
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

{{-- TOPIC 1.1: INTRODUCTION AND BASIC COMPONENTS OF A COMPUTER --}}
<div class="mt-10" id="topic-introduction-and-basic-components-of-a-computer">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.1 Introduction and Basic Components of a Computer
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Computer programming is the process of writing instructions that tell a computer exactly what to do. A set of such instructions is called a program, and the person who writes it is a programmer. Every app on your phone, every website you visit, and every game you play started as a program written by someone. Learning to program is really learning to solve problems step by step and to express the solution in a language the computer can follow.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Why Learn Programming?
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Problem Solving
            </h4>

            <p class="text-gray-400 mt-2">
                Programming trains you to break a large problem into small, logical steps. This skill is useful in every field, not only in IT.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Automation
            </h4>

            <p class="text-gray-400 mt-2">
                Programs can do repetitive work, such as computing grades or processing records, quickly and without mistakes.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Career Opportunities
            </h4>

            <p class="text-gray-400 mt-2">
                Software developers, web developers, data analysts, and many other careers depend on programming skills.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Creativity
            </h4>

            <p class="text-gray-400 mt-2">
                You can build your own tools, games, and websites. If you can imagine it and describe it clearly, you can program it.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        A Short History of Programming
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            1843: Ada Lovelace writes the first algorithm intended for a machine, the Analytical Engine.
        </li>

        <li>
            1940s: The first electronic computers are programmed in machine language using switches and cables.
        </li>

        <li>
            1950s: FORTRAN (1957) and COBOL (1959) are among the first high-level languages.
        </li>

        <li>
            1972: Dennis Ritchie creates C, which influences many later languages.
        </li>

        <li>
            1991 to 1995: Python, Java, and JavaScript appear and become widely used.
        </li>

        <li>
            Today: Hundreds of languages exist, and new ones are designed for the web, mobile apps, data science, and artificial intelligence.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Basic Components of a Computer
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A program cannot run without a computer, so a programmer should understand the main parts of one. A computer system has hardware, which you can touch, and software, which is the set of programs. The hardware follows the input, process, output, and storage cycle.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Input Devices
            </h4>

            <p class="text-gray-400 mt-2">
                Send data to the computer, such as the keyboard, mouse, and microphone. A program reads from these when it asks for user input.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                CPU (Central Processing Unit)
            </h4>

            <p class="text-gray-400 mt-2">
                The brain of the computer. It reads instructions from memory and carries them out, one after another, billions of times per second.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Memory (RAM)
            </h4>

            <p class="text-gray-400 mt-2">
                Temporary and fast storage for programs and data that are currently running. Variables in your program live here while it runs.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Storage Devices
            </h4>

            <p class="text-gray-400 mt-2">
                Permanent storage such as SSDs and hard drives. Your source code files are saved here.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Output Devices
            </h4>

            <p class="text-gray-400 mt-2">
                Show results to the user, such as the monitor, speakers, and printer.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Software
            </h4>

            <p class="text-gray-400 mt-2">
                System software such as the operating system, and application software such as the programs you will write.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        How a Program Runs
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            You write the program as text, called source code, and save it in a file on the drive.
        </li>

        <li>
            A translator, such as a compiler or an interpreter, converts the code into instructions the computer can run.
        </li>

        <li>
            When you run it, the program is loaded from storage into RAM.
        </li>

        <li>
            The CPU fetches each instruction from memory, decodes it, and executes it. This is called the fetch-decode-execute cycle.
        </li>

        <li>
            The results are shown on the screen or stored in a file.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Qualities of a Good Programmer
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Good programmers think logically, pay attention to details, and are patient when something does not work. They read error messages carefully, test their work, and practice regularly. Remember that errors are a normal part of programming, and finding and fixing them is how you learn.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What do we call the instructions written by a programmer?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Source code, which together form a program.
        </p>

        <p class="text-white mt-4">
            Where are the variables and running programs kept while the computer is working?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> In RAM, the computer's main memory.
        </p>

        <p class="text-white mt-4">
            What are the steps of the fetch-decode-execute cycle?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The CPU fetches an instruction from memory, decodes what it means, and executes it.
        </p>

    </div>

</div>

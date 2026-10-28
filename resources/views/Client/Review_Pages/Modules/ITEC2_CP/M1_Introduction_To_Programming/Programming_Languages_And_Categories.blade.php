{{-- TOPIC 1.2: PROGRAMMING LANGUAGES AND THEIR CATEGORIES --}}
<div class="mt-10" id="topic-programming-languages-and-their-categories">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.2 Programming Languages and Their Categories
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A programming language is a formal language with its own vocabulary and rules that is used to write instructions for a computer. Just like a spoken language has grammar, a programming language has syntax, which is the set of rules for how code must be written, and semantics, which is the meaning of that code. A computer will not understand an instruction that breaks the syntax rules.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Categories by Level
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Machine Language (Low-Level)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The only language the CPU understands directly. It is made of binary numbers (0s and 1s). It is very fast but extremely hard for humans to read or write, and it is different for each type of processor.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Assembly Language (Low-Level)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Uses short names, called mnemonics, such as ADD or MOV, instead of binary. An assembler translates it into machine code. It is easier than machine language but still tied to a specific processor.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                High-Level Languages
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Use English-like words and math-like expressions, so they are much easier to read, write, and maintain. They are not tied to a single processor. Examples include Java, Python, C, C++, C#, JavaScript, and PHP. A compiler or interpreter translates them into machine code.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Same Task in Different Levels
        </h4>

        <p class="text-white mt-3">
            Machine language: 10110000 01100001
        </p>

        <p class="text-gray-400 mt-2">
            Assembly language: MOV AL, 61h
        </p>

        <p class="text-gray-400 mt-2">
            High-level (Java): int x = 97;
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Language Translators
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Assembler
            </h4>

            <p class="text-gray-400 mt-2">
                Translates assembly language into machine code.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Compiler
            </h4>

            <p class="text-gray-400 mt-2">
                Translates the whole program at once into machine code or an intermediate form, and reports all syntax errors before running. Example: C and C++.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Interpreter
            </h4>

            <p class="text-gray-400 mt-2">
                Translates and runs the program one line at a time. It is easy to test but usually slower. Example: Python and JavaScript.
            </p>
        </div>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Where Does Java Fit?
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Java uses both. The Java compiler translates source code into bytecode, and the Java Virtual Machine (JVM) interprets or compiles that bytecode on any computer. This is why Java programs can run on Windows, macOS, and Linux without changes.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Categories by Generation
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            First generation (1GL): machine language
        </li>

        <li>
            Second generation (2GL): assembly language
        </li>

        <li>
            Third generation (3GL): high-level languages such as Java, C, and Python
        </li>

        <li>
            Fourth generation (4GL): languages closer to human requests for data, such as SQL
        </li>

        <li>
            Fifth generation (5GL): languages used for artificial intelligence and constraint solving, such as Prolog
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Categories by Programming Paradigm
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A paradigm is a style or approach to organizing code. Procedural languages, such as C, organize code into procedures or functions that run step by step. Object-oriented languages, such as Java, C#, and Python, organize code into objects that combine data and behavior. Functional languages, such as Haskell, build programs from functions without changing data. Scripting languages, such as JavaScript and PHP, are commonly used to automate tasks and build web pages. Many modern languages support more than one paradigm. Java is mainly object-oriented, which is why even a simple Java program is written inside a class.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Popular Languages and Their Uses
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Java
            </h4>

            <p class="text-gray-400 mt-2">
                Android apps, enterprise systems, and large back-end software. The language of this course.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Python
            </h4>

            <p class="text-gray-400 mt-2">
                Data science, automation, artificial intelligence, and teaching.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                JavaScript
            </h4>

            <p class="text-gray-400 mt-2">
                Interactive web pages and web servers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                C and C++
            </h4>

            <p class="text-gray-400 mt-2">
                Operating systems, games, and software that needs speed and control over hardware.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                C#
            </h4>

            <p class="text-gray-400 mt-2">
                Windows applications and the Unity game engine.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                SQL
            </h4>

            <p class="text-gray-400 mt-2">
                Querying and managing data in databases.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between a compiler and an interpreter?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A compiler translates the whole program before it runs, while an interpreter translates and runs it line by line.
        </p>

        <p class="text-white mt-4">
            Why are high-level languages preferred by most programmers?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> They are easier to read, write, and maintain, and they are not tied to one type of processor.
        </p>

        <p class="text-white mt-4">
            What programming paradigm is Java mainly based on?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Object-oriented programming.
        </p>

    </div>

</div>

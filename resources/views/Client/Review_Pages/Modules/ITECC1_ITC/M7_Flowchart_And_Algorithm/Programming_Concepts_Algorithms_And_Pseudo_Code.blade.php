{{-- TOPIC 7.1: PROGRAMMING CONCEPTS, ALGORITHMS, AND PSEUDO CODE --}}
<div class="mt-10" id="topic-programming-concepts-algorithms-and-pseudo-code">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.1 Programming Concepts, Algorithms, and Pseudo Code
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Before writing a program, a programmer must plan how to solve the problem. Algorithms, pseudo code, and flowcharts are tools used to plan the solution step by step.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Writing a program without a plan is like building a house without a drawing. Programmers first work out the logic on paper using algorithms, pseudo code, and flowcharts, and only then write the code in a programming language.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Programming Concepts
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A program is a set of instructions that a computer follows to perform a task. Programs are written in programming languages. High-level languages, such as Python and Java, are close to human language, while low-level languages, such as assembly, are closer to machine code. A compiler or an interpreter translates the program so the computer can run it.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Algorithms
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An algorithm is a finite, step-by-step procedure for solving a problem or completing a task. A good algorithm has these characteristics.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Input
            </h4>

            <p class="text-gray-400 mt-2">
                Zero or more values are given to the algorithm.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Output
            </h4>

            <p class="text-gray-400 mt-2">
                At least one result is produced.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Definiteness
            </h4>

            <p class="text-gray-400 mt-2">
                Every step is clear and unambiguous.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Finiteness
            </h4>

            <p class="text-gray-400 mt-2">
                It must end after a limited number of steps.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Effectiveness
            </h4>

            <p class="text-gray-400 mt-2">
                Each step is simple enough to be carried out.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Algorithm for Finding the Average of Two Numbers
        </h4>

        <p class="text-white mt-3">
            Step 1: Start.
        </p>

        <p class="text-gray-400 mt-2">
            Step 2: Read the first number and the second number.
        </p>

        <p class="text-gray-400 mt-2">
            Step 3: Add the two numbers.
        </p>

        <p class="text-gray-400 mt-2">
            Step 4: Divide the sum by 2.
        </p>

        <p class="text-gray-400 mt-2">
            Step 5: Display the result.
        </p>

        <p class="text-gray-400 mt-2">
            Step 6: Stop.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Pseudo Code
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Pseudo code describes an algorithm using plain English mixed with programming-style statements. It is not tied to a specific language, so it is easy to read and later convert into real code.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>START
  INPUT num1, num2
  IF num1 &gt; num2 THEN
    DISPLAY num1 + " is larger"
  ELSE
    DISPLAY num2 + " is larger"
  END IF
END</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Control Structures
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Sequence
            </h4>

            <p class="text-gray-400 mt-2">
                Steps run one after another from top to bottom.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Selection
            </h4>

            <p class="text-gray-400 mt-2">
                The program chooses a path based on a condition, using IF, IF-ELSE, or CASE.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Iteration
            </h4>

            <p class="text-gray-400 mt-2">
                A set of steps repeats while a condition is true, using WHILE, FOR, or REPEAT.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Iteration (Sum of 1 to 5)
        </h4>

        <p class="text-white mt-3">
            SET sum = 0
        </p>

        <p class="text-gray-400 mt-2">
            FOR i = 1 TO 5: sum = sum + i
        </p>

        <p class="text-gray-400 mt-2">
            DISPLAY sum
        </p>

        <p class="text-gray-400 mt-2">
            The result is 15.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Problem-Solving Steps
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Understand the problem and what the program must produce.
        </li>

        <li>
            Identify the inputs, the outputs, and the processing in between.
        </li>

        <li>
            Design the solution as an algorithm, pseudo code, or flowchart.
        </li>

        <li>
            Write the code in a programming language.
        </li>

        <li>
            Test the program with different inputs, including unusual ones.
        </li>

        <li>
            Fix errors, which are called debugging, and improve the program.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Programming Languages and Translators
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Machine language is made of binary instructions that the CPU runs directly. Assembly language uses short words that stand for those instructions. High-level languages, such as Python, Java, JavaScript, and C, use English-like words and are easier to read and write. Since the CPU only understands machine code, a compiler translates the entire program before it runs, while an interpreter translates and runs it line by line.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Good Algorithm Characteristics Explained
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Definiteness
            </h4>

            <p class="text-gray-400 mt-2">
                Every step must be exact. "Add some sugar" is not definite, while "add 2 teaspoons of sugar" is.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Finiteness
            </h4>

            <p class="text-gray-400 mt-2">
                The algorithm must finish. A loop that never ends breaks this rule.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Input and Output
            </h4>

            <p class="text-gray-400 mt-2">
                It may take values in, and it must give at least one result.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Effectiveness
            </h4>

            <p class="text-gray-400 mt-2">
                Every step must be simple enough that a person could do it with pencil and paper.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Worked Example: Largest of Three Numbers
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Algorithm
        </h4>

        <p class="text-white mt-3">
            1. Start.
        </p>

        <p class="text-gray-400 mt-2">
            2. Read A, B, and C.
        </p>

        <p class="text-gray-400 mt-2">
            3. Set Largest equal to A.
        </p>

        <p class="text-gray-400 mt-2">
            4. If B is greater than Largest, set Largest equal to B.
        </p>

        <p class="text-gray-400 mt-2">
            5. If C is greater than Largest, set Largest equal to C.
        </p>

        <p class="text-gray-400 mt-2">
            6. Display Largest.
        </p>

        <p class="text-gray-400 mt-2">
            7. Stop.
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>START
  INPUT A, B, C
  Largest = A
  IF B &gt; Largest THEN
    Largest = B
  END IF
  IF C &gt; Largest THEN
    Largest = C
  END IF
  DISPLAY Largest
END</code></pre>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If A is 4, B is 9, and C is 7, then Largest starts as 4, becomes 9 after comparing with B, stays 9 after comparing with C, and the display shows 9.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Pseudo Code Conventions
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Pseudo code has no strict rules, but it is good to keep it consistent. Write one action per line, use capital letters for keywords such as IF, ELSE, WHILE, and FOR, indent the steps inside a decision or a loop, and use meaningful variable names such as total or average. It should be understandable to someone who does not know any programming language.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Variables, Input, and Output
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A variable is a named storage location whose value can change while the program runs. Programs read values from the user with input statements, process them using assignments and calculations, and show results with output statements. For example, in total = total + score, the program adds the new score to the value already stored in total.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Three Control Structures in More Detail
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Sequence
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Instructions run one after the other, in the order written. Reading two numbers, adding them, and displaying the result is a sequence.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Selection
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The program chooses between paths based on a condition. IF age is at least 18 THEN display "Adult" ELSE display "Minor" is a selection.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Iteration
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A group of steps repeats. A WHILE loop repeats as long as a condition is true, a FOR loop repeats a set number of times, and a REPEAT loop repeats until a condition becomes true.
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
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A compiler translates the whole program before running it, while an interpreter translates and runs it line by line.
        </p>

        <p class="text-white mt-4">
            Why must an algorithm be finite?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because it must end after a limited number of steps, otherwise it would never produce a result.
        </p>

        <p class="text-white mt-4">
            Which control structure does an IF-ELSE statement represent?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Selection.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            An algorithm is a clear, finite list of steps. Pseudo code writes it in readable text, and every algorithm is built from sequence, selection, and iteration.
        </p>

    </div>

</div>

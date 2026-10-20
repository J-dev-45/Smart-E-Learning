{{-- TOPIC 7.2: FLOWCHARTS, ELEMENTS, STRUCTURES, AND NOTATIONS --}}
<div class="mt-10" id="topic-flowcharts-elements-structures-and-notations">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.2 Flowcharts, Elements, Structures, and Notations
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A flowchart is a diagram that shows the steps of an algorithm using symbols connected by arrows. It helps programmers and users see the flow of a process at a glance.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A flowchart lets you see the logic of a program before writing any code. Because it is a picture, it is easy to share, easy to check for mistakes, and easy to discuss with people who do not program.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Flowchart Symbols
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Terminator (Oval)
            </h4>

            <p class="text-gray-400 mt-2">
                Marks the Start and End of the flowchart.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Process (Rectangle)
            </h4>

            <p class="text-gray-400 mt-2">
                Shows a calculation or an action.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Decision (Diamond)
            </h4>

            <p class="text-gray-400 mt-2">
                Shows a yes or no question that splits the flow into two paths.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Input / Output (Parallelogram)
            </h4>

            <p class="text-gray-400 mt-2">
                Shows data being read or displayed.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Connector (Circle)
            </h4>

            <p class="text-gray-400 mt-2">
                Joins parts of a flowchart, such as across pages.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Flowline (Arrow)
            </h4>

            <p class="text-gray-400 mt-2">
                Shows the direction of the flow.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Flowchart Structures
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Sequence
            </h4>

            <p class="text-gray-400 mt-2">
                Process symbols connected one after another.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Selection
            </h4>

            <p class="text-gray-400 mt-2">
                A decision diamond with a path for yes and a path for no.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Loop
            </h4>

            <p class="text-gray-400 mt-2">
                A flowline goes back to an earlier step until a condition is met.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Even or Odd
        </h4>

        <p class="text-white mt-3">
            Start
        </p>

        <p class="text-gray-400 mt-2">
            Input number
        </p>

        <p class="text-gray-400 mt-2">
            Decision: is number MOD 2 = 0?
        </p>

        <p class="text-gray-400 mt-2">
            Yes: display "Even". No: display "Odd".
        </p>

        <p class="text-gray-400 mt-2">
            End
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Operators and Notations Used in Flowcharting
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arithmetic Operators
            </h4>

            <p class="text-gray-400 mt-2">
                + (add), - (subtract), * (multiply), / (divide), MOD (remainder), ^ (power).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Relational Operators
            </h4>

            <p class="text-gray-400 mt-2">
                &gt; (greater than), &lt; (less than), &gt;= , &lt;= , = (equal), and != (not equal).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Logical Operators
            </h4>

            <p class="text-gray-400 mt-2">
                AND (both are true), OR (at least one is true), NOT (reverses the result).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Assignment
            </h4>

            <p class="text-gray-400 mt-2">
                An arrow or equal sign stores a value in a variable. Example: total = total + 5.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Tips for Good Flowcharts
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Use only one Start and, normally, one End
        </li>

        <li>
            Keep the flow from top to bottom and left to right
        </li>

        <li>
            Label the yes and no paths of every decision
        </li>

        <li>
            Use clear and short text inside each symbol
        </li>

        <li>
            Make sure every path eventually reaches the End
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        The Symbols and How to Use Them
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Terminator (Oval)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Marks where the flowchart starts and ends. A flowchart has one Start and at least one End.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Input/Output (Parallelogram)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Used when the program reads data, such as "Input number", or displays data, such as "Display result".
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Process (Rectangle)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Used for calculations and assignments, such as "Total = A + B".
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Decision (Diamond)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Holds a yes-or-no question or a true-or-false condition. It has two exits labeled Yes and No (or True and False).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Flowlines (Arrows)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Show the order of steps. They should not cross if possible.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Connector (Small Circle)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Joins separate parts of a large flowchart, for example when it continues on another page.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Building a Flowchart Step by Step
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        First write the algorithm in plain steps. Then replace each step with the correct symbol: reading and showing data use parallelograms, calculations use rectangles, and questions use diamonds. Connect them with arrows from top to bottom, starting with a Start oval and ending with an End oval. Finally, trace the chart with a sample input to check that every path leads to the end.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Pass or Fail
        </h4>

        <p class="text-white mt-3">
            Start
        </p>

        <p class="text-gray-400 mt-2">
            Input grade
        </p>

        <p class="text-gray-400 mt-2">
            Decision: Is grade &gt;= 75?
        </p>

        <p class="text-gray-400 mt-2">
            Yes: Display "Passed"
        </p>

        <p class="text-gray-400 mt-2">
            No: Display "Failed"
        </p>

        <p class="text-gray-400 mt-2">
            End
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Loops in a Flowchart
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A loop is drawn by sending a flowline back to an earlier step. The decision diamond is the exit test: one path continues the loop and the other leaves it. To total the numbers 1 to 5, set Total to 0 and Counter to 1, then ask "Is Counter greater than 5?". If No, add Counter to Total, add 1 to Counter, and return to the question. If Yes, display Total and end.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Trace of the Loop
        </h4>

        <p class="text-white mt-3">
            Start: Total = 0, Counter = 1
        </p>

        <p class="text-gray-400 mt-2">
            After pass 1: Total = 1, Counter = 2
        </p>

        <p class="text-gray-400 mt-2">
            After pass 2: Total = 3, Counter = 3
        </p>

        <p class="text-gray-400 mt-2">
            After pass 3: Total = 6, Counter = 4
        </p>

        <p class="text-gray-400 mt-2">
            After pass 4: Total = 10, Counter = 5
        </p>

        <p class="text-gray-400 mt-2">
            After pass 5: Total = 15, Counter = 6
        </p>

        <p class="text-gray-400 mt-2">
            Counter is greater than 5, so display 15
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Operators Used in Conditions and Calculations
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arithmetic
            </h4>

            <p class="text-gray-400 mt-2">
                +, -, *, / and MOD (remainder after division). Example: 10 MOD 3 is 1.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Relational
            </h4>

            <p class="text-gray-400 mt-2">
                &gt;, &lt;, &gt;=, &lt;=, =, and != (not equal). They compare two values and give True or False.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Logical
            </h4>

            <p class="text-gray-400 mt-2">
                AND is true only if both conditions are true, OR is true if at least one is true, and NOT reverses the result.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Assignment
            </h4>

            <p class="text-gray-400 mt-2">
                Stores a value in a variable. In total = total + 5, the right side is computed first and then stored in total.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Combining Conditions
        </h4>

        <p class="text-white mt-3">
            Condition: (age &gt;= 18) AND (hasID = True)
        </p>

        <p class="text-gray-400 mt-2">
            If age is 20 and hasID is True, the result is True.
        </p>

        <p class="text-gray-400 mt-2">
            If age is 20 and hasID is False, the result is False.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Checklist for a Good Flowchart
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            One Start and clear End symbols
        </li>

        <li>
            Flow goes from top to bottom and from left to right
        </li>

        <li>
            Every decision has labeled exits
        </li>

        <li>
            Text inside symbols is short and clear
        </li>

        <li>
            No path ends without reaching an End, and there are no loops that never stop
        </li>

        <li>
            Tested with sample values, including the lowest, the highest, and the edge cases
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Which symbol is used for a decision?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The diamond.
        </p>

        <p class="text-white mt-4">
            What does 17 MOD 5 equal?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 2, because 17 divided by 5 leaves a remainder of 2.
        </p>

        <p class="text-white mt-4">
            How is a loop shown in a flowchart?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> By a flowline that returns to an earlier step, controlled by a decision symbol.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            A flowchart turns an algorithm into a picture. Standard symbols, clear flow direction, and correct operators make it easy for anyone to follow.
        </p>

    </div>

</div>

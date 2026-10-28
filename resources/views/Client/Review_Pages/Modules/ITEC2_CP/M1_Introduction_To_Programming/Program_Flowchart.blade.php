{{-- TOPIC 1.4: PROGRAM FLOWCHART --}}
<div class="mt-10" id="topic-program-flowchart">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.4 Program Flowchart
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A flowchart is a diagram that shows the steps of a solution using standard symbols connected by arrows. It is part of the design phase of the PDLC. By drawing the logic first, you can find mistakes before writing any code, and you can explain your solution to others who may not know Java.
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
                Marks the Start and End of the program.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Input/Output (Parallelogram)
            </h4>

            <p class="text-gray-400 mt-2">
                Used for reading data and displaying results.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Process (Rectangle)
            </h4>

            <p class="text-gray-400 mt-2">
                Used for calculations and assigning values to variables.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Decision (Diamond)
            </h4>

            <p class="text-gray-400 mt-2">
                Holds a yes or no question. It has two exits, one for Yes and one for No.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Flowline (Arrow)
            </h4>

            <p class="text-gray-400 mt-2">
                Shows the direction in which the steps are carried out.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Connector (Circle)
            </h4>

            <p class="text-gray-400 mt-2">
                Joins parts of a flowchart, for example when it continues on another page.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Guidelines for Drawing Flowcharts
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Use one Start and one End symbol.
        </li>

        <li>
            Draw the flow from top to bottom and from left to right.
        </li>

        <li>
            Label the Yes and No paths of every decision.
        </li>

        <li>
            Keep the text inside symbols short and clear.
        </li>

        <li>
            Make sure every path leads to the End and that loops can stop.
        </li>

        <li>
            Test the flowchart with sample data before coding.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Example 1: Sequence (Sum of Two Numbers)
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Steps in the Flowchart
        </h4>

        <p class="text-white mt-3">
            Start
        </p>

        <p class="text-gray-400 mt-2">
            Input number1, number2
        </p>

        <p class="text-gray-400 mt-2">
            Process: sum = number1 + number2
        </p>

        <p class="text-gray-400 mt-2">
            Output: sum
        </p>

        <p class="text-gray-400 mt-2">
            End
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int number1 = 8;
int number2 = 5;
int sum = number1 + number2;
System.out.println(sum);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>13</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Example 2: Selection (Pass or Fail)
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Steps in the Flowchart
        </h4>

        <p class="text-white mt-3">
            Start
        </p>

        <p class="text-gray-400 mt-2">
            Input grade
        </p>

        <p class="text-gray-400 mt-2">
            Decision: grade &gt;= 75?
        </p>

        <p class="text-gray-400 mt-2">
            Yes: Output "Passed"
        </p>

        <p class="text-gray-400 mt-2">
            No: Output "Failed"
        </p>

        <p class="text-gray-400 mt-2">
            End
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int grade = 82;
if (grade &gt;= 75) &#123;
    System.out.println("Passed");
} else &#123;
    System.out.println("Failed");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Passed</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Example 3: Iteration (Print 1 to 5)
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Steps in the Flowchart
        </h4>

        <p class="text-white mt-3">
            Start
        </p>

        <p class="text-gray-400 mt-2">
            Process: count = 1
        </p>

        <p class="text-gray-400 mt-2">
            Decision: count &lt;= 5?
        </p>

        <p class="text-gray-400 mt-2">
            Yes: Output count, then count = count + 1, then go back to the decision
        </p>

        <p class="text-gray-400 mt-2">
            No: End
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int count = 1; count &lt;= 5; count++) &#123;
    System.out.println(count);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1
2
3
4
5</code></pre>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            From Flowchart to Code
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            The three basic shapes of logic in a flowchart, which are sequence, selection (decision), and iteration (loop), are exactly the same structures you will write in Java using statements, if-else, and loops.
        </p>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Which symbol represents a decision?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The diamond.
        </p>

        <p class="text-white mt-4">
            Which phase of the PDLC uses flowcharts?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The design phase.
        </p>

        <p class="text-white mt-4">
            What flowchart structure matches a for loop in Java?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Iteration, where a flowline returns to an earlier step until a condition becomes false.
        </p>

    </div>

</div>

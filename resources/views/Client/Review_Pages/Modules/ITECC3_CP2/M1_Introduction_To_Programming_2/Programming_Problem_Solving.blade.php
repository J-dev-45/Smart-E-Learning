{{-- TOPIC 1.2: PROGRAMMING PROBLEM-SOLVING --}}
<div class="mt-10" id="topic-programming-problem-solving">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.2 Programming Problem-Solving
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Programming is not only about typing code. A good programmer first understands the problem, plans a solution, and only then writes the program. Programming problem-solving is the habit of breaking a problem into smaller parts and solving each part with a clear, logical sequence of steps.
    </p>

    <h3 class="text-xl font-bold mt-6">
        A Step-by-Step Problem-Solving Approach
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1. Understand the Problem
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Read the problem carefully. What is being asked? What data is given? What result is expected? Restate the problem in your own words.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                2. Identify Input, Process, and Output
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                List the inputs the program needs, the processing to be done, and the outputs it must show. This simple IPO table prevents many mistakes.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                3. Plan the Solution
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Write an algorithm in plain steps, as pseudocode, or draw a flowchart. Decide which variables, arrays, or classes you will need.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                4. Write the Code
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Translate the plan into Java, one small part at a time, and test each part as you go.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                5. Test with Different Data
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Try normal values, the smallest and largest values, and wrong input. Compare the output with the answer you expect.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                6. Improve and Document
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Fix errors, simplify the code, choose clear names, and add comments where they help.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: IPO Table
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Problem: Compute the average of three exam scores
        </h4>

        <p class="text-white mt-3">
            Input: score1, score2, score3
        </p>

        <p class="text-gray-400 mt-2">
            Process: add the three scores, then divide the sum by 3
        </p>

        <p class="text-gray-400 mt-2">
            Output: the average score
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int score1 = 85, score2 = 90, score3 = 78;
double average = (score1 + score2 + score3) / 3.0;
System.out.println("Average = " + average);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Average = 84.33333333333333</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Notice that the sum is divided by 3.0 and not by 3. This avoids integer division, which would throw away the decimal part. Thinking about the process before coding helps you notice details like this.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Breaking a Big Problem into Small Ones
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A large problem becomes manageable when you divide it into smaller tasks. This is called decomposition. For example, a program that analyzes student grades can be divided into: reading the grades, computing the average, finding the highest grade, and displaying the report. Each task can be written as its own method and tested separately.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static double average(int[] a) &#123;
    int sum = 0;
    for (int x : a) sum += x;
    return (double) sum / a.length;
}
static int highest(int[] a) &#123;
    int max = a[0];
    for (int x : a) if (x &gt; max) max = x;
    return max;
}

int[] grades = &#123;88, 92, 79, 95, 84};
System.out.println("Average: " + average(grades));
System.out.println("Highest: " + highest(grades));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Average: 87.6
Highest: 95</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tracing Your Code
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To check a solution without running it, trace it by hand using a trace table. Write the variables as columns and update their values after every step. Tracing helps you find logic errors, which give wrong answers without any error message.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Trace of: sum = 0; for i = 1 to 4: sum = sum + i
        </h4>

        <p class="text-white mt-3">
            i = 1, sum = 1
        </p>

        <p class="text-gray-400 mt-2">
            i = 2, sum = 3
        </p>

        <p class="text-gray-400 mt-2">
            i = 3, sum = 6
        </p>

        <p class="text-gray-400 mt-2">
            i = 4, sum = 10
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Choosing the Right Technique
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        As problems grow, simple variables and loops are no longer enough. Knowing when to use an advanced technique is part of problem-solving.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Use an Array When
            </h4>

            <p class="text-gray-400 mt-2">
                You have many values of the same kind, such as the grades of a whole class, and you want to process them with a loop.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Use Searching When
            </h4>

            <p class="text-gray-400 mt-2">
                You must find whether an item exists or where it is stored in a collection.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Use Sorting When
            </h4>

            <p class="text-gray-400 mt-2">
                Data must be arranged in order, such as a ranking from highest to lowest, or when you want faster searching.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Use a Class When
            </h4>

            <p class="text-gray-400 mt-2">
                Several pieces of data belong to one thing, such as a student with a name, ID, and grade, and that thing has its own actions.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Problem-Solving Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Starting to code before understanding the problem
        </li>

        <li>
            Skipping the plan and fixing one error after another
        </li>

        <li>
            Testing with only one easy example
        </li>

        <li>
            Writing one very long method instead of small ones
        </li>

        <li>
            Using unclear names such as x, y, and temp2 everywhere
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does IPO stand for?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Input, Process, and Output.
        </p>

        <p class="text-white mt-4">
            Why is decomposition useful?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It divides a large problem into smaller tasks that are easier to solve, test, and reuse.
        </p>

        <p class="text-white mt-4">
            Why divide by 3.0 instead of 3 when computing an average of ints?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> To avoid integer division, so that the decimal part of the average is kept.
        </p>

    </div>

</div>

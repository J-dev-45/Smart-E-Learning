{{-- TOPIC 5.1: ALGORITHM ANALYSIS, EFFICIENCY, AND TIME AND SPACE COMPLEXITY --}}
<div class="mt-10" id="topic-algorithm-analysis-efficiency-and-time-and-space-complexity">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        5.1 Algorithm Analysis, Efficiency, and Time and Space Complexity
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Often there is more than one way to solve a problem. Searching can be done with linear or binary search, and sorting with bubble sort or merge sort. All of them give the correct answer, so how do we choose? Algorithm analysis is the study of how much time and memory an algorithm needs, so that we can compare algorithms fairly and choose the best one for a given problem.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Algorithm Analysis?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Algorithm analysis predicts the resources an algorithm uses as the size of its input grows. The two main resources are time, meaning how many steps the algorithm performs, and space, meaning how much extra memory it needs. Instead of measuring seconds on a particular computer, which depends on the machine, the language, and what else is running, we count basic operations and see how that count grows with the input size n.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Algorithm Efficiency
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An algorithm is efficient if it solves the problem using a small amount of time and memory, especially when the input becomes very large. For small inputs, almost every algorithm seems fast. The differences appear when n is large. An algorithm that is fine for 100 records may be impossibly slow for 1,000,000 records.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Counting Operations
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To see how the work grows, count the basic operations. The two programs below both compute the sum of the numbers 1 to n. The first uses a loop, and the second uses a formula.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int n = 1000;

int steps1 = 0, sum1 = 0;
for (int i = 1; i &lt;= n; i++) &#123;
    sum1 += i;
    steps1++;
}

int sum2 = n * (n + 1) / 2;
int steps2 = 1;

System.out.println("Loop:    sum = " + sum1 + ", steps = " + steps1);
System.out.println("Formula: sum = " + sum2 + ", steps = " + steps2);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Loop:    sum = 500500, steps = 1000
Formula: sum = 500500, steps = 1</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Both give the same answer, but the loop does n steps and the formula always does one. When n doubles, the loop takes twice as long, while the formula takes the same time.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Time Complexity
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Time complexity describes how the number of steps grows as the input size n grows. It is written as a function of n, such as n, n squared, or log n. A single loop that visits every element has a time complexity proportional to n. Two nested loops over the same data have a complexity proportional to n x n.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int n = 6;

int single = 0;
for (int i = 0; i &lt; n; i++) single++;

int nested = 0;
for (int i = 0; i &lt; n; i++)
    for (int j = 0; j &lt; n; j++) nested++;

System.out.println("Single loop steps: " + single);
System.out.println("Nested loop steps: " + nested);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Single loop steps: 6
Nested loop steps: 36</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Space Complexity
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Space complexity describes the extra memory an algorithm needs, apart from the input itself. An algorithm that uses only a few variables has constant extra space. An algorithm that creates a new array as large as the input needs extra space proportional to n.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                In-Place Algorithms
            </h4>

            <p class="text-gray-400 mt-2">
                Bubble, selection, insertion sort, and linear and binary search use only a few extra variables.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Algorithms with Extra Memory
            </h4>

            <p class="text-gray-400 mt-2">
                Merge sort needs temporary arrays that hold up to n elements. Recursive algorithms also use stack memory for each call.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Time-Space Trade-Off
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Often you can make an algorithm faster by using more memory, or save memory by accepting more time. For example, merge sort is faster than insertion sort on large data but needs extra space. Choosing an algorithm means balancing both resources according to the needs of the program.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Why Not Just Measure the Running Time?
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            The result depends on the computer, the operating system, and other running programs.
        </li>

        <li>
            It depends on the programming language and the compiler.
        </li>

        <li>
            It depends on the particular input chosen for the test.
        </li>

        <li>
            Counting operations gives a result that is the same on every computer.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What are the two main resources measured in algorithm analysis?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Time and space (memory).
        </p>

        <p class="text-white mt-4">
            Why do we count operations instead of measuring seconds?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because seconds depend on the machine, while the number of operations describes how the algorithm itself grows with the input.
        </p>

        <p class="text-white mt-4">
            What is the space complexity of an algorithm that creates a new array the same size as the input?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It needs extra space proportional to n.
        </p>

    </div>

</div>

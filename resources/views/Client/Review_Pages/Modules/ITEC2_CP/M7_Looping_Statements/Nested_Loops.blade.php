{{-- TOPIC 7.3: NESTED LOOPS --}}
<div class="mt-10" id="topic-nested-loops">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.3 Nested Loops
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A nested loop is a loop placed inside another loop. For each single repetition of the outer loop, the inner loop runs completely from start to finish. Nested loops are used to work with tables, grids, patterns, and two-dimensional arrays.
    </p>

    <h3 class="text-xl font-bold mt-6">
        How Nested Loops Work
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int row = 1; row &lt;= 3; row++) &#123;
    for (int col = 1; col &lt;= 4; col++) &#123;
        System.out.print("* ");
    }
    System.out.println();
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>* * * * 
* * * * 
* * * * </code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The outer loop runs 3 times, once for each row. For each row, the inner loop runs 4 times to print four stars, and then println moves to the next row. In total, the inner statement runs 3 x 4 = 12 times.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Counting Repetitions
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            If the outer loop runs m times and the inner loop runs n times for each, the inner body runs m x n times in total.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Pattern 1: Right Triangle
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int i = 1; i &lt;= 5; i++) &#123;
    for (int j = 1; j &lt;= i; j++) &#123;
        System.out.print("* ");
    }
    System.out.println();
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>* 
* * 
* * * 
* * * * 
* * * * * </code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Here the inner loop depends on the outer loop variable: when i is 3, the inner loop runs 3 times.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Pattern 2: Number Triangle
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int i = 1; i &lt;= 4; i++) &#123;
    for (int j = 1; j &lt;= i; j++) &#123;
        System.out.print(j + " ");
    }
    System.out.println();
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1 
1 2 
1 2 3 
1 2 3 4 </code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Pattern 3: Inverted Triangle
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int i = 4; i &gt;= 1; i--) &#123;
    for (int j = 1; j &lt;= i; j++) &#123;
        System.out.print("* ");
    }
    System.out.println();
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>* * * * 
* * * 
* * 
* </code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: Multiplication Table
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int i = 1; i &lt;= 3; i++) &#123;
    for (int j = 1; j &lt;= 5; j++) &#123;
        System.out.printf("%4d", i * j);
    }
    System.out.println();
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>   1   2   3   4   5
   2   4   6   8  10
   3   6   9  12  15</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        break and continue in Nested Loops
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A break or continue affects only the loop in which it is written, which is the innermost one. To leave an outer loop from the inside, you can use a label.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>outer:
for (int i = 1; i &lt;= 3; i++) &#123;
    for (int j = 1; j &lt;= 3; j++) &#123;
        if (i * j == 4) break outer;
        System.out.println(i + " x " + j + " = " + (i * j));
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1 x 1 = 1
1 x 2 = 2
1 x 3 = 3
2 x 1 = 2</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tips
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Use different variable names for each loop, such as i and j, or row and col.
        </li>

        <li>
            Trace small examples by hand before running the program.
        </li>

        <li>
            Remember that deeper nesting makes the program run more slowly. Three nested loops of 1,000 each would run a billion times.
        </li>

        <li>
            Use println() after the inner loop to start a new row.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            How many times does the inner statement run if the outer loop runs 4 times and the inner loop runs 6 times?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 24 times (4 x 6).
        </p>

        <p class="text-white mt-4">
            What does a plain break do inside a nested loop?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It ends only the innermost loop in which it is written.
        </p>

        <p class="text-white mt-4">
            What controls the number of stars in each row of a right-triangle pattern?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The inner loop's condition depends on the outer loop variable, such as j &lt;= i.
        </p>

    </div>

</div>

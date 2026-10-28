{{-- TOPIC 7.1: WHAT IS A LOOP AND WHILE LOOPS --}}
<div class="mt-10" id="topic-what-is-a-loop-and-while-loops">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.1 What Is a Loop and While Loops
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A loop is a control structure that repeats a block of code as long as a condition is true. Without loops, if you wanted to print the numbers from 1 to 1000, you would have to write a thousand statements. With a loop, a few lines are enough. Loops are used for processing lists of data, repeating menus, validating input, and many other tasks.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Parts of Every Loop
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Initialization
            </h4>

            <p class="text-gray-400 mt-2">
                Sets the starting value of the loop variable.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Condition
            </h4>

            <p class="text-gray-400 mt-2">
                A Boolean expression checked before each repetition. The loop continues while it is true.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Update
            </h4>

            <p class="text-gray-400 mt-2">
                Changes the loop variable so the loop eventually ends.
            </p>
        </div>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Beware of Infinite Loops
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            If the condition never becomes false, the loop never ends. This usually happens when you forget the update statement. Press Ctrl+C in the console to stop a runaway program.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The while Loop
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The while loop checks its condition before every repetition. If the condition is false at the start, the body never runs. It is best used when you do not know in advance how many times the loop must repeat.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>while (condition) &#123;
    // statements
    // update
}</code></pre>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int count = 1;                  // initialization
while (count &lt;= 5) &#123;            // condition
    System.out.println("Count: " + count);
    count++;                    // update
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Count: 1
Count: 2
Count: 3
Count: 4
Count: 5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tracing the Loop
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Step-by-Step Trace
        </h4>

        <p class="text-white mt-3">
            count = 1: 1 &lt;= 5 is true, print 1, count becomes 2
        </p>

        <p class="text-gray-400 mt-2">
            count = 2: true, print 2, count becomes 3
        </p>

        <p class="text-gray-400 mt-2">
            count = 5: true, print 5, count becomes 6
        </p>

        <p class="text-gray-400 mt-2">
            count = 6: 6 &lt;= 5 is false, the loop ends
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: Sum of Numbers
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int i = 1, sum = 0;
while (i &lt;= 10) &#123;
    sum += i;
    i++;
}
System.out.println("Sum = " + sum);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Sum = 55</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Counter-Controlled and Sentinel-Controlled Loops
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A counter-controlled loop repeats a known number of times, like the examples above. A sentinel-controlled loop repeats until the user enters a special value, called a sentinel, to stop.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>Scanner input = new Scanner(System.in);
int total = 0;
System.out.print("Enter a number (0 to stop): ");
int n = input.nextInt();
while (n != 0) &#123;
    total += n;
    System.out.print("Enter a number (0 to stop): ");
    n = input.nextInt();
}
System.out.println("Total = " + total);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Enter a number (0 to stop): 5
Enter a number (0 to stop): 10
Enter a number (0 to stop): 0
Total = 15</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Input Validation with while
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int age;
System.out.print("Enter your age (1 to 120): ");
age = input.nextInt();
while (age &lt; 1 || age &gt; 120) &#123;
    System.out.print("Invalid. Try again: ");
    age = input.nextInt();
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        break and continue
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                break
            </h4>

            <p class="text-gray-400 mt-2">
                Ends the loop immediately and continues with the statement after the loop.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                continue
            </h4>

            <p class="text-gray-400 mt-2">
                Skips the rest of the current repetition and goes to the next check of the condition.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int i = 0;
while (i &lt; 10) &#123;
    i++;
    if (i == 3) continue;   // skip 3
    if (i == 6) break;      // stop at 6
    System.out.println(i);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1
2
4
5</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            When is the condition of a while loop checked?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Before every repetition, including the first one.
        </p>

        <p class="text-white mt-4">
            What causes an infinite loop?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A condition that never becomes false, often because the update statement is missing.
        </p>

        <p class="text-white mt-4">
            What is the difference between break and continue?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> break ends the loop completely, while continue skips to the next repetition.
        </p>

    </div>

</div>

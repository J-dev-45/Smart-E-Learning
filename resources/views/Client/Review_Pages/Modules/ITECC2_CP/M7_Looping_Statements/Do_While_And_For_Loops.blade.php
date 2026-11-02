{{-- TOPIC 7.2: DO-WHILE LOOPS AND FOR LOOPS --}}
<div class="mt-10" id="topic-do-while-loops-and-for-loops">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.2 Do-While Loops and For Loops
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        The do-while Loop
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The do-while loop checks its condition after the body runs, so the body always executes at least once. It is useful for menus and for asking the user for input that must be entered at least one time. Notice that a do-while statement ends with a semicolon.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>do &#123;
    // statements
} while (condition);</code></pre>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int number = 10;
do &#123;
    System.out.println("This runs once. number = " + number);
    number++;
} while (number &lt; 5);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>This runs once. number = 10</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A while loop with the same condition would never run, because 10 &lt; 5 is false at the start.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>Scanner input = new Scanner(System.in);
int choice;
do &#123;
    System.out.println("1. Play  2. Settings  3. Exit");
    System.out.print("Choose: ");
    choice = input.nextInt();
} while (choice != 3);
System.out.println("Goodbye!");</code></pre>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                while
            </h4>

            <p class="text-gray-400 mt-2">
                Checks first. The body may run zero times.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                do-while
            </h4>

            <p class="text-gray-400 mt-2">
                Checks last. The body always runs at least once.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The for Loop
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The for loop puts the initialization, the condition, and the update in one line, which makes it ideal when you know how many times to repeat. It is the most common loop for counting.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (initialization; condition; update) &#123;
    // statements
}</code></pre>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int i = 1; i &lt;= 5; i++) &#123;
    System.out.println("i = " + i);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>i = 1
i = 2
i = 3
i = 4
i = 5</code></pre>
    </div>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Initialization
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Runs once before the loop starts: int i = 1
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Condition
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Checked before each repetition: i &lt;= 5
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Update
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Runs after each repetition: i++
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Scope
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A variable declared in the for header exists only inside the loop.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Variations of the for Loop
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>for (int i = 10; i &gt;= 1; i--) &#123;         // counting down
    System.out.print(i + " ");
}
System.out.println();

for (int i = 0; i &lt;= 20; i += 5) &#123;      // counting by 5
    System.out.print(i + " ");
}
System.out.println();

for (char c = 'A'; c &lt;= 'E'; c++) &#123;     // characters
    System.out.print(c + " ");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>10 9 8 7 6 5 4 3 2 1 
0 5 10 15 20 
A B C D E </code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Loop Patterns
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// Sum of numbers 1 to 100
int sum = 0;
for (int i = 1; i &lt;= 100; i++) &#123;
    sum += i;
}
System.out.println(sum);

// Factorial of 5
int fact = 1;
for (int i = 1; i &lt;= 5; i++) &#123;
    fact *= i;
}
System.out.println(fact);

// Count even numbers from 1 to 20
int evens = 0;
for (int i = 1; i &lt;= 20; i++) &#123;
    if (i % 2 == 0) evens++;
}
System.out.println(evens);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>5050
120
10</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Which Loop Should I Use?
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                for
            </h4>

            <p class="text-gray-400 mt-2">
                You know the number of repetitions, such as counting from 1 to n.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                while
            </h4>

            <p class="text-gray-400 mt-2">
                You repeat until some condition changes and may not need to run at all.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                do-while
            </h4>

            <p class="text-gray-400 mt-2">
                The body must run at least once, such as menus and input checks.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Off-by-one errors: using &lt; instead of &lt;=, which gives one repetition less than you wanted.
        </li>

        <li>
            Putting a semicolon right after the for header, which makes an empty loop.
        </li>

        <li>
            Changing the loop variable inside the body and causing unexpected results.
        </li>

        <li>
            Forgetting the semicolon at the end of a do-while.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the main difference between while and do-while?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A while loop checks the condition first and may never run, while a do-while loop runs the body at least once before checking.
        </p>

        <p class="text-white mt-4">
            What are the three parts of a for loop header?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Initialization, condition, and update.
        </p>

        <p class="text-white mt-4">
            How many times does for (int i = 0; i &lt; 5; i++) repeat?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 5 times, with i taking the values 0, 1, 2, 3, and 4.
        </p>

    </div>

</div>

{{-- TOPIC 11.2: CONVERTING ITERATION TO RECURSION --}}
<div class="mt-10" id="topic-converting-iteration-to-recursion">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        11.2 Converting Iteration to Recursion
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Any loop can be rewritten as recursion, and any recursion can be rewritten as a loop. Practicing the conversion is the best way to understand how recursion works. The idea is to turn the loop's parts into the parts of a recursive method.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Conversion Recipe
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1. Find the Stopping Condition
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The condition that ends the loop becomes the base case of the recursion. If the loop runs while i &lt;= n, the base case is when i &gt; n.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                2. Turn Loop Variables into Parameters
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Variables that change in the loop, such as the counter and the running total, become parameters of the method.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                3. Replace the Loop Body and Update with a Recursive Call
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Do the work of one repetition, then call the method with the updated values, for example i + 1.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example 1: Sum of 1 to n
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// Iterative version
static int sumIterative(int n) &#123;
    int sum = 0;
    for (int i = 1; i &lt;= n; i++) &#123;
        sum += i;
    }
    return sum;
}

// Recursive version
static int sumRecursive(int n) &#123;
    if (n == 1) &#123;                       // base case
        return 1;
    }
    return n + sumRecursive(n - 1);     // recursive case
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>sumIterative(5) = 15
sumRecursive(5) = 15</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Tracing sumRecursive(3)
        </h4>

        <p class="text-white mt-3">
            sumRecursive(3) = 3 + sumRecursive(2)
        </p>

        <p class="text-gray-400 mt-2">
            sumRecursive(2) = 2 + sumRecursive(1)
        </p>

        <p class="text-gray-400 mt-2">
            sumRecursive(1) = 1
        </p>

        <p class="text-gray-400 mt-2">
            Back up: 2 + 1 = 3, then 3 + 3 = 6
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example 2: Factorial
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// Iterative
static long factorialIter(int n) &#123;
    long result = 1;
    for (int i = 2; i &lt;= n; i++) &#123;
        result *= i;
    }
    return result;
}

// Recursive
static long factorialRec(int n) &#123;
    if (n &lt;= 1) return 1;
    return n * factorialRec(n - 1);
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Example 3: Printing 1 to n
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// Iterative
for (int i = 1; i &lt;= 5; i++) &#123;
    System.out.print(i + " ");
}

// Recursive (counter becomes a parameter)
static void printUp(int i, int n) &#123;
    if (i &gt; n) return;                // base case
    System.out.print(i + " ");
    printUp(i + 1, n);                // update becomes the argument
}
// printUp(1, 5)</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1 2 3 4 5</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Notice how the loop variable i became a parameter and i++ became the argument i + 1.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Example 4: Power of a Number
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int powerRec(int base, int exp) &#123;
    if (exp == 0) return 1;                  // base case
    return base * powerRec(base, exp - 1);   // base^exp = base * base^(exp-1)
}
// powerRec(2, 5) = 32</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>32</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Example 5: Fibonacci Numbers
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The Fibonacci sequence starts with 0 and 1, and each following number is the sum of the previous two: 0, 1, 1, 2, 3, 5, 8, 13, and so on.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// Iterative
static int fibIter(int n) &#123;
    int a = 0, b = 1;
    for (int i = 0; i &lt; n; i++) &#123;
        int next = a + b;
        a = b;
        b = next;
    }
    return a;
}

// Recursive
static int fibRec(int n) &#123;
    if (n &lt;= 1) return n;                    // base cases: 0 and 1
    return fibRec(n - 1) + fibRec(n - 2);    // two recursive calls
}
// fibRec(7) = 13</code></pre>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Warning About Fibonacci
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            The recursive Fibonacci repeats the same calculations many times, so it becomes extremely slow for large n. The iterative version is much faster. This is an example where a loop is the better choice.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example 6: Recursive Method on a String
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static String reverse(String s) &#123;
    if (s.length() &lt;= 1) return s;                         // base case
    return reverse(s.substring(1)) + s.charAt(0);          // reverse the rest, then add the first
}
// reverse("java") returns "avaj"</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>avaj</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Converting Recursion Back to Iteration
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The reverse conversion is also useful. Replace the base case with the loop condition, turn the parameters into local variables that are updated each time, and put the work of one call in the loop body. Recursion that only calls itself once at the very end of the method, called tail recursion, is the easiest to convert.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Choosing Between the Two
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Prefer Iteration When
            </h4>

            <p class="text-gray-400 mt-2">
                The task is simple repetition, performance matters, or the number of repetitions is large.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Prefer Recursion When
            </h4>

            <p class="text-gray-400 mt-2">
                The problem is naturally recursive, such as trees, folders, puzzles, and divide-and-conquer algorithms, and the depth is small.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What part of a loop becomes the base case in recursion?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The condition that stops the loop.
        </p>

        <p class="text-white mt-4">
            What happens to a loop counter such as i when converting to recursion?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It becomes a parameter of the recursive method, and i++ becomes the argument i + 1 in the recursive call.
        </p>

        <p class="text-white mt-4">
            Why is the recursive Fibonacci method slow for large numbers?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because it recalculates the same values many times through two recursive calls.
        </p>

    </div>

</div>

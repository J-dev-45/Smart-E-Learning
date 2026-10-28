{{-- TOPIC 5.2: BEST, AVERAGE, AND WORST CASE, AND BIG O NOTATION --}}
<div class="mt-10" id="topic-best-average-and-worst-case-and-big-o-notation">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        5.2 Best, Average, and Worst Case, and Big O Notation
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The number of steps an algorithm takes often depends not only on the size of the input but also on how the input is arranged. Linear search finds the key at once if it is first, but must check everything if it is last. To describe this, we study the best case, the average case, and the worst case, and we express the growth of the work using Big O notation.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Best, Average, and Worst Case
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Best Case
            </h4>

            <p class="text-gray-400 mt-2">
                The input that makes the algorithm do the least work. For linear search, the key is the first element.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Average Case
            </h4>

            <p class="text-gray-400 mt-2">
                The expected work over typical inputs. For linear search, about half of the elements are checked.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Worst Case
            </h4>

            <p class="text-gray-400 mt-2">
                The input that makes the algorithm do the most work. For linear search, the key is the last element or is not present.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The worst case is the one used most often, because it gives a guarantee: the algorithm will never take more steps than that.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int comparisons(int[] a, int key) &#123;
    int count = 0;
    for (int x : a) &#123;
        count++;
        if (x == key) break;
    }
    return count;
}

int[] a = &#123;10, 20, 30, 40, 50, 60, 70, 80, 90, 100};
System.out.println("Best case  (key 10):  " + comparisons(a, 10));
System.out.println("Average    (key 50):  " + comparisons(a, 50));
System.out.println("Worst case (key 100): " + comparisons(a, 100));
System.out.println("Worst case (missing): " + comparisons(a, 5));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Best case  (key 10):  1
Average    (key 50):  5
Worst case (key 100): 10
Worst case (missing): 10</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        What Is Big O Notation?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Big O notation describes how the running time of an algorithm grows when the input size n becomes large. It keeps only the part of the formula that grows fastest and ignores constants, because for large n the fastest-growing term dominates. We write O(n), read as "order n", for an algorithm whose work grows in proportion to n.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Simplification Rules
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Drop Constant Factors
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                An algorithm that takes 3n steps is O(n), not O(3n). Doubling n doubles the work either way.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Keep the Dominant Term
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                An algorithm that takes n squared + 5n + 20 steps is O(n squared), because for large n the n squared term overwhelms the others.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Add Sequential Steps, Multiply Nested Steps
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Two loops one after another cost O(n) + O(n) = O(n). Loops inside loops multiply: O(n) x O(n) = O(n squared).
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Time Complexities
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                O(1): Constant
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The work does not depend on n. Example: reading a[5], or swapping two elements.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                O(log n): Logarithmic
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The work grows very slowly because the problem is cut in half each step. Example: binary search.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                O(n): Linear
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The work grows in direct proportion to n. Example: linear search, finding the maximum.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                O(n log n): Linearithmic
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Slightly more than linear. Example: merge sort and, on average, quick sort.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                O(n squared): Quadratic
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The work grows with the square of n because of nested loops. Example: bubble, selection, and insertion sort.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        How Fast Do They Grow?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The table below is computed by a program. Look at how quickly n squared grows compared with n log n and log n.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.printf("%8s %10s %12s %14s%n", "n", "log n", "n log n", "n squared");
int[] sizes = &#123;10, 100, 1000, 10000};
for (int n : sizes) &#123;
    double log = Math.log(n) / Math.log(2);
    System.out.printf("%8d %10.1f %12.0f %14d%n", n, log, n * log, (long) n * n);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>       n      log n      n log n      n squared
      10        3.3           33            100
     100        6.6          664          10000
    1000       10.0         9966        1000000
   10000       13.3       132877      100000000</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        For n = 10,000, an O(n squared) algorithm needs about 100,000,000 steps, while an O(n log n) algorithm needs only about 133,000. This is why choosing the right algorithm matters far more than buying a faster computer.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Reading the Complexity of Code
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Examples
        </h4>

        <p class="text-white mt-3">
            One loop from 0 to n: O(n)
        </p>

        <p class="text-gray-400 mt-2">
            Two nested loops, each to n: O(n squared)
        </p>

        <p class="text-gray-400 mt-2">
            A loop that halves its counter each time (i = i / 2): O(log n)
        </p>

        <p class="text-gray-400 mt-2">
            A statement with no loop: O(1)
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int n = 1024;
int halvings = 0;
for (int i = n; i &gt; 1; i = i / 2) &#123;
    halvings++;
}
System.out.println("n = " + n + ", halvings = " + halvings);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>n = 1024, halvings = 10</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the worst case of linear search?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The key is the last element or is not in the array, so all n elements are compared.
        </p>

        <p class="text-white mt-4">
            What is the Big O of 3n squared + 10n + 7?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> O(n squared), after dropping the constants and keeping the dominant term.
        </p>

        <p class="text-white mt-4">
            Which grows faster for large n: n log n or n squared?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> n squared grows faster.
        </p>

    </div>

</div>

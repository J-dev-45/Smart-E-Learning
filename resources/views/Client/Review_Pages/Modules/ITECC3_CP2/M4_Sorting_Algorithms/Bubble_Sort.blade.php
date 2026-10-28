{{-- TOPIC 4.2: BUBBLE SORT --}}
<div class="mt-10" id="topic-bubble-sort">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.2 Bubble Sort
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Bubble sort is the simplest sorting algorithm to understand. It repeatedly walks through the array, compares adjacent elements, and swaps them if they are in the wrong order. After each pass, the largest remaining element moves, like a bubble rising, to its final position at the end of the array.
    </p>

    <h3 class="text-xl font-bold mt-6">
        How Bubble Sort Works
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Compare the first two elements. If the first is larger, swap them.
        </li>

        <li>
            Move one position and compare the next pair, and continue to the end of the unsorted part.
        </li>

        <li>
            After one pass, the largest element is at the end.
        </li>

        <li>
            Repeat the passes, each time ignoring the elements that are already in place.
        </li>

        <li>
            Stop when all passes are done or when a pass makes no swaps.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Comparing Adjacent Elements, Swapping, and Multiple Passes
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;5, 3, 8, 1, 4};
int n = a.length;
for (int pass = 0; pass &lt; n - 1; pass++) &#123;
    for (int i = 0; i &lt; n - 1 - pass; i++) &#123;
        if (a[i] &gt; a[i + 1]) &#123;
            int temp = a[i];
            a[i] = a[i + 1];
            a[i + 1] = temp;
        }
    }
}
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[1, 3, 4, 5, 8]</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The inner loop stops at n - 1 - pass because the last pass elements are already in their final positions.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Tracing Each Pass
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;5, 3, 8, 1, 4};
int n = a.length;
System.out.println("Start:  " + java.util.Arrays.toString(a));
for (int pass = 0; pass &lt; n - 1; pass++) &#123;
    for (int i = 0; i &lt; n - 1 - pass; i++) &#123;
        if (a[i] &gt; a[i + 1]) &#123;
            int temp = a[i]; a[i] = a[i + 1]; a[i + 1] = temp;
        }
    }
    System.out.println("Pass " + (pass + 1) + ": " + java.util.Arrays.toString(a));
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Start:  [5, 3, 8, 1, 4]
Pass 1: [3, 5, 1, 4, 8]
Pass 2: [3, 1, 4, 5, 8]
Pass 3: [1, 3, 4, 5, 8]
Pass 4: [1, 3, 4, 5, 8]</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        After pass 1, the largest value, 8, is at the end. After pass 2, the second largest, 5, is in place, and so on.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Optimization Using a Swap Flag
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If a complete pass makes no swaps, the array is already sorted and the algorithm can stop early. A boolean flag records whether any swap happened in the current pass. This makes bubble sort much faster on data that is already nearly sorted.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;1, 2, 3, 5, 4};
int n = a.length;
int passes = 0;
boolean swapped;
do &#123;
    swapped = false;
    passes++;
    for (int i = 0; i &lt; n - 1; i++) &#123;
        if (a[i] &gt; a[i + 1]) &#123;
            int temp = a[i]; a[i] = a[i + 1]; a[i + 1] = temp;
            swapped = true;
        }
    }
} while (swapped);
System.out.println(java.util.Arrays.toString(a) + " sorted in " + passes + " passes");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[1, 2, 3, 4, 5] sorted in 2 passes</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Sorting in Descending Order
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To sort from largest to smallest, change the comparison from a[i] &gt; a[i + 1] to a[i] &lt; a[i + 1].
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;5, 3, 8, 1, 4};
for (int pass = 0; pass &lt; a.length - 1; pass++) &#123;
    for (int i = 0; i &lt; a.length - 1 - pass; i++) &#123;
        if (a[i] &lt; a[i + 1]) &#123;
            int temp = a[i]; a[i] = a[i + 1]; a[i + 1] = temp;
        }
    }
}
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[8, 5, 4, 3, 1]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Characteristics of Bubble Sort
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Strengths
            </h4>

            <p class="text-gray-400 mt-2">
                Easy to understand and write. Stable. In-place. With the swap flag it detects an already sorted array quickly.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Weaknesses
            </h4>

            <p class="text-gray-400 mt-2">
                Slow for large arrays. It makes about n x n comparisons, so the work grows rapidly as n increases. Rarely used in real systems.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is guaranteed to be in its final position after the first pass of bubble sort?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The largest element, at the end of the array.
        </p>

        <p class="text-white mt-4">
            What is the purpose of the swap flag?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> To stop early when a pass makes no swaps, which means the array is already sorted.
        </p>

        <p class="text-white mt-4">
            Why does the inner loop run to n - 1 - pass?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because the last pass elements are already in their final positions and need not be compared again.
        </p>

    </div>

</div>

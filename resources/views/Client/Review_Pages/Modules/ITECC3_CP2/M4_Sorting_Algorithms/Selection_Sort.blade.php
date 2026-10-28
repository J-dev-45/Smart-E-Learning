{{-- TOPIC 4.3: SELECTION SORT --}}
<div class="mt-10" id="topic-selection-sort">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.3 Selection Sort
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Selection sort works like arranging playing cards by repeatedly picking the smallest card from the ones left and placing it at the front. The array is divided into a sorted part on the left and an unsorted part on the right. At each step the algorithm selects the smallest element of the unsorted part and swaps it into the next position.
    </p>

    <h3 class="text-xl font-bold mt-6">
        How Selection Sort Works
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Start with position 0 as the current position.
        </li>

        <li>
            Search the unsorted part for the smallest element (finding the minimum).
        </li>

        <li>
            Swap that smallest element with the element at the current position (selecting the correct position).
        </li>

        <li>
            Move the current position one step to the right.
        </li>

        <li>
            Repeat until only one element remains.
        </li>

    </ul>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;64, 25, 12, 22, 11};
for (int i = 0; i &lt; a.length - 1; i++) &#123;
    int minIndex = i;
    for (int j = i + 1; j &lt; a.length; j++) &#123;
        if (a[j] &lt; a[minIndex]) &#123;
            minIndex = j;
        }
    }
    int temp = a[minIndex];
    a[minIndex] = a[i];
    a[i] = temp;
}
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[11, 12, 22, 25, 64]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tracing Each Step
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;64, 25, 12, 22, 11};
System.out.println("Start:  " + java.util.Arrays.toString(a));
for (int i = 0; i &lt; a.length - 1; i++) &#123;
    int minIndex = i;
    for (int j = i + 1; j &lt; a.length; j++) &#123;
        if (a[j] &lt; a[minIndex]) minIndex = j;
    }
    int temp = a[minIndex]; a[minIndex] = a[i]; a[i] = temp;
    System.out.println("Step " + (i + 1) + ": " + java.util.Arrays.toString(a)
            + "  (minimum " + a[i] + " placed at index " + i + ")");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Start:  [64, 25, 12, 22, 11]
Step 1: [11, 25, 12, 22, 64]  (minimum 11 placed at index 0)
Step 2: [11, 12, 25, 22, 64]  (minimum 12 placed at index 1)
Step 3: [11, 12, 22, 25, 64]  (minimum 22 placed at index 2)
Step 4: [11, 12, 22, 25, 64]  (minimum 25 placed at index 3)</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Finding the Maximum Instead
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The same idea can place the largest element at the end, or can sort in descending order by selecting the maximum instead of the minimum.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;64, 25, 12, 22, 11};
for (int i = 0; i &lt; a.length - 1; i++) &#123;
    int maxIndex = i;
    for (int j = i + 1; j &lt; a.length; j++) &#123;
        if (a[j] &gt; a[maxIndex]) maxIndex = j;
    }
    int temp = a[maxIndex]; a[maxIndex] = a[i]; a[i] = temp;
}
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[64, 25, 22, 12, 11]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Characteristics of Selection Sort
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Strengths
            </h4>

            <p class="text-gray-400 mt-2">
                Simple. Makes at most n - 1 swaps, which is useful when writing to memory is costly. In-place.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Weaknesses
            </h4>

            <p class="text-gray-400 mt-2">
                Always makes about n x n / 2 comparisons, even if the array is already sorted. It is usually not stable, because a swap can move an element past an equal one.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Why Selection Sort Is Not Stable
        </h4>

        <p class="text-white mt-3">
            Array: (5a), (5b), 2
        </p>

        <p class="text-gray-400 mt-2">
            The minimum, 2, is swapped with the first element, so the array becomes 2, (5b), (5a)
        </p>

        <p class="text-gray-400 mt-2">
            The two 5s have changed their relative order
        </p>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does selection sort select at each step?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The smallest (or largest) element of the unsorted part.
        </p>

        <p class="text-white mt-4">
            How many swaps does selection sort make at most for n elements?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> At most n - 1 swaps.
        </p>

        <p class="text-white mt-4">
            Does selection sort run faster if the array is already sorted?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No, it still makes the same number of comparisons.
        </p>

    </div>

</div>

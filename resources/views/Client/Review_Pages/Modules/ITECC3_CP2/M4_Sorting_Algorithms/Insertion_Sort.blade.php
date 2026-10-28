{{-- TOPIC 4.4: INSERTION SORT --}}
<div class="mt-10" id="topic-insertion-sort">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.4 Insertion Sort
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Insertion sort is how many people sort cards in their hand. You pick up one card at a time and insert it into its proper place among the cards you already hold. The array is divided into a sorted portion on the left and an unsorted portion on the right, and each element of the unsorted portion is inserted into its proper position in the sorted portion.
    </p>

    <h3 class="text-xl font-bold mt-6">
        How Insertion Sort Works
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Treat the first element as a sorted portion of size one.
        </li>

        <li>
            Take the next element from the unsorted portion and call it the key.
        </li>

        <li>
            Compare the key with the elements of the sorted portion, moving from right to left.
        </li>

        <li>
            Shift each larger element one position to the right (shifting elements).
        </li>

        <li>
            Place the key in the gap, which is its proper position.
        </li>

        <li>
            Repeat until all elements have been inserted.
        </li>

    </ul>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;7, 3, 5, 1, 9, 2};
for (int i = 1; i &lt; a.length; i++) &#123;
    int key = a[i];
    int j = i - 1;
    while (j &gt;= 0 &amp;&amp; a[j] &gt; key) &#123;
        a[j + 1] = a[j];       // shift right
        j--;
    }
    a[j + 1] = key;            // insert in the gap
}
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[1, 2, 3, 5, 7, 9]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tracing Each Insertion
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;7, 3, 5, 1, 9, 2};
System.out.println("Start:         " + java.util.Arrays.toString(a));
for (int i = 1; i &lt; a.length; i++) &#123;
    int key = a[i];
    int j = i - 1;
    while (j &gt;= 0 &amp;&amp; a[j] &gt; key) &#123;
        a[j + 1] = a[j];
        j--;
    }
    a[j + 1] = key;
    System.out.println("Insert " + key + ":      " + java.util.Arrays.toString(a));
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Start:         [7, 3, 5, 1, 9, 2]
Insert 3:      [3, 7, 5, 1, 9, 2]
Insert 5:      [3, 5, 7, 1, 9, 2]
Insert 1:      [1, 3, 5, 7, 9, 2]
Insert 9:      [1, 3, 5, 7, 9, 2]
Insert 2:      [1, 2, 3, 5, 7, 9]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Shifting, Not Swapping
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Insertion sort moves elements by shifting them, which needs one assignment for each moved element instead of the three assignments of a swap. The key is held in a variable while the elements shift, so no value is lost.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Best Case on Nearly Sorted Data
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If the array is already sorted, the while loop never runs, and the algorithm only makes one comparison for each element. This makes insertion sort excellent for small arrays and for data that is almost sorted, such as adding a few new items to a list that is already sorted.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] sortedAlready = &#123;1, 2, 3, 4, 5};
int shifts = 0;
for (int i = 1; i &lt; sortedAlready.length; i++) &#123;
    int key = sortedAlready[i];
    int j = i - 1;
    while (j &gt;= 0 &amp;&amp; sortedAlready[j] &gt; key) &#123;
        sortedAlready[j + 1] = sortedAlready[j];
        j--;
        shifts++;
    }
    sortedAlready[j + 1] = key;
}
System.out.println("Shifts needed: " + shifts);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Shifts needed: 0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Characteristics of Insertion Sort
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Strengths
            </h4>

            <p class="text-gray-400 mt-2">
                Simple. Stable. In-place. Very fast on small or nearly sorted data. Can sort data as it arrives.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Weaknesses
            </h4>

            <p class="text-gray-400 mt-2">
                Slow for large, randomly ordered arrays, because each element may be shifted many positions. In the worst case, a reverse-sorted array, the work grows with n x n.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            How does insertion sort move elements to make room for the key?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It shifts the larger elements one position to the right.
        </p>

        <p class="text-white mt-4">
            When is insertion sort at its best?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> When the array is already sorted or nearly sorted.
        </p>

        <p class="text-white mt-4">
            Is insertion sort stable?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Yes, because it does not move an element past an equal one.
        </p>

    </div>

</div>

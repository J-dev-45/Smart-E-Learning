{{-- TOPIC 4.5: MERGE SORT --}}
<div class="mt-10" id="topic-merge-sort">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.5 Merge Sort
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Merge sort is a divide-and-conquer algorithm. It divides the array into halves, sorts each half separately, and then merges the two sorted halves into one sorted array. Merging two sorted lists is easy and fast, and that is the key to the algorithm's efficiency. Unlike the earlier algorithms, merge sort is naturally recursive.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Divide-and-Conquer Strategy
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Divide
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Split the array into a left half and a right half at the middle.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Conquer
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Recursively sort each half. A half with one element (or none) is already sorted, and this is the base case.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Combine
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Merge the two sorted halves into a single sorted array.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Splitting Arrays
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Splitting {38, 27, 43, 3, 9, 82, 10}
        </h4>

        <p class="text-white mt-3">
            {38, 27, 43, 3, 9, 82, 10}
        </p>

        <p class="text-gray-400 mt-2">
            {38, 27, 43}  and  {3, 9, 82, 10}
        </p>

        <p class="text-gray-400 mt-2">
            {38}  {27, 43}  and  {3, 9}  {82, 10}
        </p>

        <p class="text-gray-400 mt-2">
            {38}  {27}  {43}  {3}  {9}  {82}  {10}
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Merging Sorted Arrays
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To merge two sorted arrays, keep a pointer at the start of each. Compare the two elements the pointers refer to, copy the smaller one to the result, and move that pointer forward. When one array is finished, copy the remaining elements of the other.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] left = &#123;3, 27, 38};
int[] right = &#123;9, 10, 43, 82};
int[] merged = new int[left.length + right.length];
int i = 0, j = 0, k = 0;
while (i &lt; left.length &amp;&amp; j &lt; right.length) &#123;
    if (left[i] &lt;= right[j]) merged[k++] = left[i++];
    else merged[k++] = right[j++];
}
while (i &lt; left.length) merged[k++] = left[i++];
while (j &lt; right.length) merged[k++] = right[j++];
System.out.println(java.util.Arrays.toString(merged));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[3, 9, 10, 27, 38, 43, 82]</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Using &lt;= when the two elements are equal takes the element from the left half first, which keeps merge sort stable.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Recursive Implementation
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void mergeSort(int[] a, int low, int high) &#123;
    if (low &gt;= high) return;                 // base case: 0 or 1 element
    int mid = low + (high - low) / 2;
    mergeSort(a, low, mid);                  // sort left half
    mergeSort(a, mid + 1, high);             // sort right half
    merge(a, low, mid, high);                // combine
}

static void merge(int[] a, int low, int mid, int high) &#123;
    int[] temp = new int[high - low + 1];
    int i = low, j = mid + 1, k = 0;
    while (i &lt;= mid &amp;&amp; j &lt;= high) &#123;
        if (a[i] &lt;= a[j]) temp[k++] = a[i++];
        else temp[k++] = a[j++];
    }
    while (i &lt;= mid) temp[k++] = a[i++];
    while (j &lt;= high) temp[k++] = a[j++];
    for (int x = 0; x &lt; temp.length; x++) a[low + x] = temp[x];
}

int[] a = &#123;38, 27, 43, 3, 9, 82, 10};
mergeSort(a, 0, a.length - 1);
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[3, 9, 10, 27, 38, 43, 82]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tracing the Recursion
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void mergeSort(int[] a, int low, int high) &#123;
    if (low &gt;= high) return;
    int mid = low + (high - low) / 2;
    mergeSort(a, low, mid);
    mergeSort(a, mid + 1, high);
    merge(a, low, mid, high);
    System.out.println("Merged [" + low + ".." + high + "] -&gt; "
            + java.util.Arrays.toString(java.util.Arrays.copyOfRange(a, low, high + 1)));
}

static void merge(int[] a, int low, int mid, int high) &#123;
    int[] temp = new int[high - low + 1];
    int i = low, j = mid + 1, k = 0;
    while (i &lt;= mid &amp;&amp; j &lt;= high) &#123;
        if (a[i] &lt;= a[j]) temp[k++] = a[i++]; else temp[k++] = a[j++];
    }
    while (i &lt;= mid) temp[k++] = a[i++];
    while (j &lt;= high) temp[k++] = a[j++];
    for (int x = 0; x &lt; temp.length; x++) a[low + x] = temp[x];
}

int[] a = &#123;38, 27, 43, 3};
mergeSort(a, 0, a.length - 1);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Merged [0..1] -&gt; [27, 38]
Merged [2..3] -&gt; [3, 43]
Merged [0..3] -&gt; [3, 27, 38, 43]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Characteristics of Merge Sort
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Strengths
            </h4>

            <p class="text-gray-400 mt-2">
                Fast and predictable: about n x log n steps in every case. Stable. Good for large data and for external sorting.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Weaknesses
            </h4>

            <p class="text-gray-400 mt-2">
                Needs extra memory for the temporary arrays, so it is not in-place. More complex than the simple sorts, and slower on very small arrays.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The array is halved about log n times, and each level of merging looks at all n elements, which is where n log n comes from. This is explained further in the algorithm analysis module.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the base case of merge sort?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> An array (or part) with zero or one element, which is already sorted.
        </p>

        <p class="text-white mt-4">
            Why is merge sort not in-place?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It uses temporary arrays to hold the merged result.
        </p>

        <p class="text-white mt-4">
            What are the three steps of merge sort?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Divide the array, sort each half recursively, and merge the sorted halves.
        </p>

    </div>

</div>

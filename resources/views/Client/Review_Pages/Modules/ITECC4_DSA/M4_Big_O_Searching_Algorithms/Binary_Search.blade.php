<div class="mt-0" id="topic-binary">
    <h2 class="text-2xl font-bold text-white">Binary Search</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain why input must be sorted.</li><li>Trace low, high, and mid values.</li><li>Implement iterative binary search.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Binary search finds a target in sorted data by checking the middle element and discarding the half that cannot contain the target. Because each comparison approximately halves the remaining search range, it scales better than linear search for large sorted arrays.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Step-by-step trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Search for 23 in [3, 8, 12, 17, 23, 31, 42]. Initially low=0, high=6, mid=3, value=17. Since 23 is larger, set low=4. Now mid=(4+6)/2=5, value=31. Since 23 is smaller, set high=4. Now mid=4 and value=23: found at index 4.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Correct range</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Use the inclusive range low through high. Continue while low <= high. If value[mid] is too small, move low to mid+1; if too large, move high to mid-1.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>static int binarySearch(int[] a, int target) {\n    int low = 0, high = a.length - 1;\n    while (low &lt;= high) {\n        int mid = low + (high - low) / 2;\n        if (a[mid] == target) return mid;\n        if (a[mid] &lt; target) low = mid + 1;\n        else high = mid - 1;\n    }\n    return -1;\n}\nSystem.out.println(binarySearch(new int[]{3,8,12,17,23,31,42}, 23));</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>4</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Worst-case time O(log n), best case O(1), and iterative extra space O(1). Sorting first may cost O(n log n), so binary search is most valuable when data is already sorted or searched repeatedly.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Dictionary lookups, sorted catalogs, and searching ordered numeric or textual collections.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Binary search on unsorted data is not reliable. Update bounds past mid to avoid an infinite loop.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Binary search finds a target in sorted data by checking the middle element and discarding the half that cannot contain the target. Because each comparison approximately halves the remaining search range, it scales better than linear search for large sorted arrays.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
<div class="mt-0" id="topic-bubble">
    <h2 class="text-2xl font-bold text-white">Bubble Sort</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain adjacent comparisons and swaps.</li><li>Trace a pass through an array.</li><li>State Bubble Sort's complexity and limitation.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Bubble Sort repeatedly compares neighboring elements and swaps them if they are out of order. After each pass, the largest remaining unsorted value has moved to the end of the unsorted region.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace one pass</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For [5, 1, 4, 2], compare 5 and 1 → [1, 5, 4, 2]; compare 5 and 4 → [1, 4, 5, 2]; compare 5 and 2 → [1, 4, 2, 5]. The largest value, 5, is now at the end.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Optimization</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>After each pass, the final sorted portion grows. If a full pass makes no swaps, the array is already sorted and the algorithm can stop early.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>static void bubbleSort(int[] a) {\n    for (int end = a.length - 1; end &gt; 0; end--) {\n        boolean swapped = false;\n        for (int i = 0; i &lt; end; i++) {\n            if (a[i] &gt; a[i + 1]) {\n                int temp = a[i]; a[i] = a[i + 1]; a[i + 1] = temp;\n                swapped = true;\n            }\n        }\n        if (!swapped) break;\n    }\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>Sorting [5, 1, 4, 2] produces [1, 2, 4, 5].</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Worst and average time O(n²); best case O(n) with the no-swap optimization. Extra space O(1). It is stable when equal elements are not swapped.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Teaching sorting fundamentals and sorting very small lists where simplicity matters more than speed.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Compare adjacent values, not arbitrary distant values. Stop the inner loop at end so i+1 remains a valid index.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Bubble Sort repeatedly compares neighboring elements and swaps them if they are out of order. After each pass, the largest remaining unsorted value has moved to the end of the unsorted region.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
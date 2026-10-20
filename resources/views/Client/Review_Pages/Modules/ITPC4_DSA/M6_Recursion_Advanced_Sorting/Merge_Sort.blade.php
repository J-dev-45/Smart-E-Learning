<div class="mt-0" id="topic-merge">
    <h2 class="text-2xl font-bold text-white">Merge Sort</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain divide, conquer, and merge.</li><li>Trace a small merge operation.</li><li>Compare merge sort with quadratic sorts.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Merge Sort splits an array into halves, recursively sorts each half, then merges the sorted halves. The merge step repeatedly selects the smaller front item from the two halves.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Walkthrough</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Split [8, 3, 6, 2] into [8, 3] and [6, 2]. Sort these as [3, 8] and [2, 6]. Merge by comparing fronts: take 2, then 3, then 6, then 8 → [2, 3, 6, 8].</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Why it scales</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Each recursion level processes a total of n elements, and there are about log₂ n levels. This leads to O(n log n) time regardless of input order.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>static void merge(int[] a, int[] left, int[] right) {\n    int i = 0, j = 0, k = 0;\n    while (i &lt; left.length &amp;&amp; j &lt; right.length)\n        a[k++] = left[i] &lt;= right[j] ? left[i++] : right[j++];\n    while (i &lt; left.length) a[k++] = left[i++];\n    while (j &lt; right.length) a[k++] = right[j++];\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>Merging sorted halves [3, 8] and [2, 6] produces [2, 3, 6, 8].</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Time O(n log n) in best, average, and worst cases. Typical array implementation needs O(n) auxiliary space, plus O(log n) recursion depth.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Reliable sorting of large data, stable sorting, and external sorting techniques.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Both halves must already be sorted before merging. Copy all remaining values from whichever half is not exhausted.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Merge Sort splits an array into halves, recursively sorts each half, then merges the sorted halves. The merge step repeatedly selects the smaller front item from the two halves.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
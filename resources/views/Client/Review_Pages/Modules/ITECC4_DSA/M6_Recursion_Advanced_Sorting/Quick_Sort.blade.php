<div class="mt-0" id="topic-quick">
    <h2 class="text-2xl font-bold text-white">Quick Sort</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain pivot-based partitioning.</li><li>Trace partitioning at a high level.</li><li>Compare average and worst-case complexity.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Quick Sort chooses a pivot, partitions values into groups on either side of the pivot according to a rule, then recursively sorts the partitions. The pivot's final position separates smaller and larger values, depending on the partition scheme.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Example</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For [6, 3, 8, 2, 5] with pivot 5, a partition can place [3, 2] to the left and [6, 8] to the right, with the pivot between them. Recursively sort each side to obtain [2, 3, 5, 6, 8]. Exact intermediate order depends on the partition implementation.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Pivot choice</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>A balanced partition gives about log n recursion levels. Repeatedly poor partitions can create a chain of size n, especially with already ordered input and a naive pivot rule.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>static int partition(int[] a, int low, int high) {\n    int pivot = a[high], i = low;\n    for (int j = low; j &lt; high; j++) {\n        if (a[j] &lt;= pivot) {\n            int t = a[i]; a[i] = a[j]; a[j] = t;\n            i++;\n        }\n    }\n    int t = a[i]; a[i] = a[high]; a[high] = t;\n    return i;\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>The partition method places the chosen pivot in its final partition index and returns that index.</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Average time O(n log n); worst-case O(n²). In-place partitioning uses O(log n) average recursion space and O(n) worst-case stack space.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Fast general-purpose in-memory sorting; many standard sorting implementations use related partitioning ideas.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Recursive calls must exclude the pivot's final index. Duplicate values and pivot selection can affect partition balance.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Quick Sort chooses a pivot, partitions values into groups on either side of the pivot according to a rule, then recursively sorts the partitions. The pivot's final position separates smaller and larger values, depending on the partition scheme.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
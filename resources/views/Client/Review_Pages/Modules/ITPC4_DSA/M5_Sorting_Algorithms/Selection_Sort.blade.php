<div class="mt-0" id="topic-selection">
    <h2 class="text-2xl font-bold text-white">Selection Sort</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Describe selecting the minimum from the unsorted region.</li><li>Trace minimum-index updates.</li><li>Compare its swaps and runtime with other simple sorts.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Selection Sort divides the array into a sorted prefix and an unsorted suffix. Each pass finds the smallest value in the suffix and swaps it into the first unsorted position.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For [29, 10, 14, 37], the minimum is 10, so swap it with 29 → [10, 29, 14, 37]. In the remaining suffix [29, 14, 37], the minimum is 14 → [10, 14, 29, 37]. Continue until the suffix has one element.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Key property</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Selection Sort performs O(n²) comparisons even when input is already sorted, but it uses at most about n swaps. It is in-place but normally not stable.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>static void selectionSort(int[] a) {\n    for (int i = 0; i &lt; a.length - 1; i++) {\n        int min = i;\n        for (int j = i + 1; j &lt; a.length; j++) {\n            if (a[j] &lt; a[min]) min = j;\n        }\n        int temp = a[i]; a[i] = a[min]; a[min] = temp;\n    }\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>Sorting [29, 10, 14, 37] produces [10, 14, 29, 37].</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Best, average, and worst time O(n²); extra space O(1).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Small arrays or situations where minimizing writes is useful, though efficient library sorting is usually preferred.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Track the index of the minimum, not just its value. Swap only after the inner scan is complete.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Selection Sort divides the array into a sorted prefix and an unsorted suffix. Each pass finds the smallest value in the suffix and swaps it into the first unsorted position.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
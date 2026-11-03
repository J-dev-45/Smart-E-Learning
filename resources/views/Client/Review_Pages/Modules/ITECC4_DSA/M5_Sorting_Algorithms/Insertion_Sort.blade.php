<div class="mt-0" id="topic-insertion">
    <h2 class="text-2xl font-bold sharedTXT">Insertion Sort</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Explain the sorted-prefix idea.</li><li>Trace how a key is inserted into its proper place.</li><li>Identify when insertion sort is useful.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Insertion Sort grows a sorted prefix one item at a time. It takes the next key, shifts larger values one position right, then inserts the key into the gap.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Trace</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Start [5, 2, 4, 6]. Insert 2 before 5 → [2, 5, 4, 6]. Next insert 4: shift 5 right, place 4 after 2 → [2, 4, 5, 6]. The 6 is already in order.</div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Why it can be efficient</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>For nearly sorted arrays, only a few shifts are needed. Insertion Sort is stable when it shifts only values strictly greater than the key.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>static void insertionSort(int[] a) {\n    for (int i = 1; i &lt; a.length; i++) {\n        int key = a[i], j = i - 1;\n        while (j &gt;= 0 &amp;&amp; a[j] &gt; key) {\n            a[j + 1] = a[j];\n            j--;\n        }\n        a[j + 1] = key;\n    }\n}</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>Sorting [5, 2, 4, 6] produces [2, 4, 5, 6].</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Worst and average O(n²); best O(n) on already sorted data. Extra space O(1).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Small or nearly sorted arrays, and as a component inside more advanced sorting algorithms.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Save the key before shifting values. The insertion position is j+1 after the while loop ends.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Insertion Sort grows a sorted prefix one item at a time. It takes the next key, shifts larger values one position right, then inserts the key into the gap.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
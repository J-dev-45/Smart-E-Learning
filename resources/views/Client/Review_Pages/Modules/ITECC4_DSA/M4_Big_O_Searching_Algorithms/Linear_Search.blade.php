<div class="mt-0" id="topic-linear">
    <h2 class="text-2xl font-bold sharedTXT">Linear Search</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Implement a search that works on unsorted arrays.</li><li>Trace comparisons and identify not-found behavior.</li><li>State best- and worst-case complexity.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Linear search checks elements in order until the target is found or the collection ends. It works on sorted and unsorted data and is often the simplest correct choice for small collections.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Worked trace</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Search for 7 in [4, 2, 7, 9]. Compare 7 with 4 (not equal), then 2 (not equal), then 7 (match). The index returned is 2, after three comparisons.</div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Algorithm design</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Return the index when a match is found. If the loop finishes without a match, return -1 so the caller can distinguish not found from index 0.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>static int linearSearch(int[] values, int target) {\n    for (int i = 0; i &lt; values.length; i++) {\n        if (values[i] == target) return i;\n    }\n    return -1;\n}\n\nSystem.out.println(linearSearch(new int[]{4, 2, 7, 9}, 7));</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>2</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Best case O(1) when the first item matches; worst case O(n) comparisons. Iterative implementation uses O(1) extra space.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Searching small or unsorted lists, checking whether a value exists, and simple lookup tasks.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Do not return 0 when the target is missing. Ensure an empty array returns -1 without attempting an invalid index.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Linear search checks elements in order until the target is found or the collection ends. It works on sorted and unsorted data and is often the simplest correct choice for small collections.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
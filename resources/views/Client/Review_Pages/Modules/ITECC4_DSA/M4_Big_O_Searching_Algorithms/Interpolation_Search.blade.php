<div class="mt-0" id="topic-interpolation">
    <h2 class="text-2xl font-bold sharedTXT">Interpolation Search</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Explain the assumptions behind interpolation search.</li><li>Compare its probe estimate with binary search.</li><li>Recognize when it performs poorly.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Interpolation search estimates where a target should be inside a sorted numeric array based on the target's value relative to the low and high values. It resembles looking up a word in a dictionary: values near one end are expected near that end of the range.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Probe estimate</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>For low and high indexes, estimate pos = low + ((target - a[low]) × (high - low)) / (a[high] - a[low]). This estimate is meaningful only when values are sorted and the denominator is nonzero. After checking a[pos], narrow the range according to whether the value is too small or too large.</div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Performance</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>With sorted, approximately uniform values, average performance can approach O(log log n). For highly uneven distributions, worst-case time is O(n). Guard against empty ranges and equal endpoint values to avoid division by zero.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>int[] a = {10, 20, 30, 40, 50};\nint low = 0, high = a.length - 1, target = 40;\nint pos = low + (target - a[low]) * (high - low) / (a[high] - a[low]);\nSystem.out.println(pos);</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>3</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Average O(log log n) under a uniform distribution assumption; worst case O(n). Iterative extra space O(1).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Numeric data that is sorted and distributed relatively uniformly, such as certain indexed measurement ranges.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Do not use it for unsorted data or arbitrary nonnumeric keys. Handle target values outside the current range and equal endpoints safely.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Interpolation search estimates where a target should be inside a sorted numeric array based on the target's value relative to the low and high values. It resembles looking up a word in a dictionary: values near one end are expected near that end of the range.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
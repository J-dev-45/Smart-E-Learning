<div class="mt-0" id="topic-interpolation">
    <h2 class="text-2xl font-bold text-white">Interpolation Search</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain the assumptions behind interpolation search.</li><li>Compare its probe estimate with binary search.</li><li>Recognize when it performs poorly.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Interpolation search estimates where a target should be inside a sorted numeric array based on the target's value relative to the low and high values. It resembles looking up a word in a dictionary: values near one end are expected near that end of the range.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Probe estimate</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For low and high indexes, estimate pos = low + ((target - a[low]) × (high - low)) / (a[high] - a[low]). This estimate is meaningful only when values are sorted and the denominator is nonzero. After checking a[pos], narrow the range according to whether the value is too small or too large.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Performance</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>With sorted, approximately uniform values, average performance can approach O(log log n). For highly uneven distributions, worst-case time is O(n). Guard against empty ranges and equal endpoint values to avoid division by zero.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>int[] a = {10, 20, 30, 40, 50};\nint low = 0, high = a.length - 1, target = 40;\nint pos = low + (target - a[low]) * (high - low) / (a[high] - a[low]);\nSystem.out.println(pos);</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>3</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Average O(log log n) under a uniform distribution assumption; worst case O(n). Iterative extra space O(1).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Numeric data that is sorted and distributed relatively uniformly, such as certain indexed measurement ranges.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Do not use it for unsorted data or arbitrary nonnumeric keys. Handle target values outside the current range and equal endpoints safely.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Interpolation search estimates where a target should be inside a sorted numeric array based on the target's value relative to the low and high values. It resembles looking up a word in a dictionary: values near one end are expected near that end of the range.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
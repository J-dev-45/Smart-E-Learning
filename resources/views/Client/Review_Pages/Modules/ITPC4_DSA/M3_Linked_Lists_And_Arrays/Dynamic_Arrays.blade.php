<div class="mt-0" id="topic-dynamic">
    <h2 class="text-2xl font-bold text-white">Dynamic Arrays</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain how a dynamic array grows beyond its current capacity.</li><li>Distinguish size from capacity.</li><li>Describe amortized append cost.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A dynamic array offers array-like indexed access while managing capacity automatically. In Java, <code>ArrayList</code> is a common dynamic-array implementation. Its logical size is the number of stored elements; capacity is the allocated space available before growth is needed.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Growth and access</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Index access is O(1). Appending is usually O(1), but occasionally the backing array must grow and copy existing elements, making that append O(n). Across many appends, the average (amortized) append cost is O(1).</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Example</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>An ArrayList with values [2, 4] has size 2. Adding 6 changes the contents to [2, 4, 6]. The programmer uses <code>add</code> without manually allocating a larger array.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>import java.util.ArrayList;
ArrayList&lt;Integer&gt; values = new ArrayList&lt;&gt;();
values.add(2);
values.add(4);
values.add(6);
System.out.println(values.get(1));
System.out.println(values.size());</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>4
3</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">get(index) is O(1); append is O(1) amortized and O(n) when a resize/copy occurs; inserting/removing in the middle is O(n). Space is O(n).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Lists of changing length, search results, rosters, and collections where index access is useful.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Do not confuse <code>size()</code> with backing capacity. Valid indexes range from 0 through size - 1.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A dynamic array offers array-like indexed access while managing capacity automatically. In Java, <code>ArrayList</code> is a common dynamic-array implementation. Its logical size is the number of stored elements; capacity is the allocated space available before growth is needed.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
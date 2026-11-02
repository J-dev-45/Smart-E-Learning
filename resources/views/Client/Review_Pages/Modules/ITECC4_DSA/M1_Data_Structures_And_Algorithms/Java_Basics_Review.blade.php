<div class="mt-0" id="topic-java">
    <h2 class="text-2xl font-bold text-white">Java Basics Review</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Read variables, conditions, loops, arrays, and methods used in DSA.</li><li>Trace a short Java program and predict its output.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Java is object-oriented and statically typed: each variable has a declared type, and the compiler checks many errors before the program runs. DSA examples commonly use primitive types, arrays, loops, methods, classes, and objects.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Essential syntax</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'><ul class='list-disc pl-6 space-y-2'><li><code>int</code> stores whole numbers; <code>boolean</code> stores <code>true</code> or <code>false</code>.</li><li>An array has a fixed length and uses zero-based indexes.</li><li>An <code>if</code> statement chooses a branch; a loop repeats a block.</li><li>A method packages reusable logic and may return a value.</li></ul></div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace the loop</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For <code>int[] values = {3, 5, 7}</code>, the loop index is 0, then 1, then 2. When the index reaches 3, the condition <code>i &lt; values.length</code> is false, so the loop stops.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>int[] values = {3, 5, 7};
int total = 0;
for (int i = 0; i &lt; values.length; i++) {
    total += values[i];
}
System.out.println(total);</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>15</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The loop visits each array element once, so it takes O(n) time. The two integer variables use O(1) extra space.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">These language features form the basis of implementing stacks, queues, searches, sorts, and graph traversals.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Use <code>==</code> for primitive equality, not <code>=</code> (assignment). Remember that the final valid array index is <code>length - 1</code>.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Java is object-oriented and statically typed: each variable has a declared type, and the compiler checks many errors before the program runs. DSA examples commonly use primitive types, arrays, loops, methods, classes, and objects.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
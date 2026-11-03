<div class="mt-0" id="topic-bigo">
    <h2 class="text-2xl font-bold sharedTXT">Big O Notation</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Describe growth rates as input size increases.</li><li>Compare constant, logarithmic, linear, linearithmic, and quadratic time.</li><li>Identify common loop complexity.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Big O notation describes an upper-bound growth rate for an algorithm as input size n grows. It helps compare scalability without relying on a particular computer or exact runtime.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Common growth rates</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'><ul class='list-disc pl-6 space-y-2'><li><b>O(1):</b> constant work, such as reading an array element by index.</li><li><b>O(log n):</b> repeatedly reduce the problem by a constant factor, as in binary search.</li><li><b>O(n):</b> inspect each item once.</li><li><b>O(n log n):</b> common for efficient comparison sorts such as merge sort.</li><li><b>O(n²):</b> compare each item with many others, often via nested loops.</li></ul></div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Count work</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>A loop that visits n items once is O(n). Two nested loops each running n times perform about n² iterations, so the total is O(n²). Constants and lower-order terms are omitted: 3n + 10 is O(n).</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>for (int i = 0; i &lt; n; i++) {\n    System.out.println(i);\n}\n\nfor (int i = 0; i &lt; n; i++) {\n    for (int j = 0; j &lt; n; j++) {\n        \n    }\n}</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>The first loop runs n times: O(n). The nested loops run n × n times: O(n²).</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Big O is the complexity description itself. State whether the analysis is for time or extra space, and whether it is best, average, or worst case when that distinction matters.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Estimating whether an approach remains practical for larger inputs and comparing alternative algorithms.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Big O is not an exact runtime or a guarantee about small inputs. Drop constants only when describing asymptotic growth; do not ignore input assumptions.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Big O notation describes an upper-bound growth rate for an algorithm as input size n grows. It helps compare scalability without relying on a particular computer or exact runtime.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
<div class="mt-0" id="topic-what">
    <h2 class="text-2xl font-bold sharedTXT">What Are Data Structures and Algorithms</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Distinguish a data structure from an algorithm.</li><li>Explain how choosing a suitable structure affects a solution.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A data structure organizes data so a program can store, access, update, and remove it. An algorithm is a finite sequence of precise steps used to solve a problem. They work together: the structure determines how information is represented, while the algorithm determines what the program does with it.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Core terms</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'><ul class='list-disc pl-6 space-y-2'><li><b>Data:</b> values a program works with, such as student IDs or scores.</li><li><b>Data structure:</b> an organization of data, such as an array, linked list, stack, queue, tree, or hash table.</li><li><b>Algorithm:</b> a defined procedure, such as searching a list or sorting scores.</li><li><b>Complexity:</b> a way to describe how running time or memory grows as input size grows.</li></ul></div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Worked example</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Suppose a program must find a student ID in 1,000 IDs. A linear-search algorithm checks items one by one. If the IDs are sorted, binary search can repeatedly discard half of the remaining range. The best choice depends on whether the list is sorted and how often it changes.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>int[] ids = {104, 205, 317, 422};
int target = 317;
int foundAt = -1;
for (int i = 0; i &lt; ids.length; i++) {
    if (ids[i] == target) {
        foundAt = i;
        break;
    }
}
System.out.println(foundAt);</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>2</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Linear search takes O(n) time in the worst case because it may inspect every element. The loop uses O(1) extra space.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Student records, inventory systems, route planning, search tools, and scheduling.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Do not treat data structures and algorithms as the same thing. An algorithm must also handle empty input and values that are not found.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A data structure organizes data so a program can store, access, update, and remove it. An algorithm is a finite sequence of precise steps used to solve a problem. They work together: the structure determines how information is represented, while the algorithm determines what the program does with it.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
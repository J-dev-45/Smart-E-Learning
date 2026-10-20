<div class="mt-0" id="topic-priority">
    <h2 class="text-2xl font-bold text-white">Priority Queues</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain how priority affects removal order.</li><li>Distinguish priority queues from FIFO queues.</li><li>Use Java PriorityQueue and understand its default ordering.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A priority queue removes an item according to its priority rather than simply its arrival time. In Java, <code>PriorityQueue</code> is a heap-backed queue whose default head is the smallest element according to natural ordering.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>How it behaves</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>A priority queue repeatedly exposes the highest-priority item as defined by its ordering rule. For numbers in Java's default order, the smallest number comes out first. For a task system, define a comparator if a different priority rule is required.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Insert 5, 1, and 3. The removal sequence is 1, then 3, then 5. The internal heap is not necessarily stored as a fully sorted array; only the priority ordering at the head is guaranteed.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>import java.util.PriorityQueue;
PriorityQueue&lt;Integer&gt; pq = new PriorityQueue&lt;&gt;();
pq.offer(5);
pq.offer(1);
pq.offer(3);
while (!pq.isEmpty()) {
    System.out.print(pq.poll() + " ");
}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>1 3 5 </code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Peek is O(1); offer and poll are O(log n) for a heap; storage is O(n).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">CPU/job scheduling, shortest-path algorithms, event simulation, and selecting the next most urgent task.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Do not assume insertion order is preserved. Clarify whether a smaller or larger value means higher priority and encode that rule in a comparator.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A priority queue removes an item according to its priority rather than simply its arrival time. In Java, <code>PriorityQueue</code> is a heap-backed queue whose default head is the smallest element according to natural ordering.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
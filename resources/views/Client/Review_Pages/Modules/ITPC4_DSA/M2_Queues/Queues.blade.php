<div class="mt-0" id="topic-queues">
    <h2 class="text-2xl font-bold text-white">Queues</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain first-in, first-out (FIFO).</li><li>Identify enqueue, dequeue, front/peek, and empty checks.</li><li>Choose a queue for order-sensitive tasks.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A queue processes items in arrival order. The first item inserted is the first item removed, which is called first-in, first-out (FIFO). Items join at the rear and leave from the front.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Operations</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'><ul class='list-disc pl-6 space-y-2'><li><b>enqueue / offer:</b> add an item at the rear.</li><li><b>dequeue / poll:</b> remove the front item.</li><li><b>peek:</b> inspect the front item without removing it.</li></ul></div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Enqueue A, B, and C: the queue is [A, B, C], front A. Dequeue returns A; the remaining queue is [B, C]. The order of arrival is preserved.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>import java.util.ArrayDeque;
import java.util.Queue;

Queue&lt;String&gt; line = new ArrayDeque&lt;&gt;();
line.offer("Ana");
line.offer("Ben");
line.offer("Carlo");
System.out.println(line.poll());
System.out.println(line.peek());</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>Ana
Ben</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">ArrayDeque offers O(1) typical insertion/removal at the ends. Space is O(n) for n waiting items.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Print queues, customer service lines, task scheduling, and breadth-first search.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Do not remove from the rear when FIFO is required. Java's <code>poll()</code> returns null for an empty queue, unlike <code>remove()</code>, which throws an exception.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A queue processes items in arrival order. The first item inserted is the first item removed, which is called first-in, first-out (FIFO). Items join at the rear and leave from the front.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
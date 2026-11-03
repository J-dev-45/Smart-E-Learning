<div class="mt-0" id="topic-stacks">
    <h2 class="text-2xl font-bold sharedTXT">Stacks</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Describe the last-in, first-out (LIFO) rule.</li><li>Trace push, pop, and peek operations.</li><li>Implement a basic stack using Java's Deque interface.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A stack is a collection where the most recently added item is the first one removed. This is called last-in, first-out (LIFO). Think of a pile of plates: you normally take the top plate first.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Operations</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'><ul class='list-disc pl-6 space-y-2'><li><b>push(x):</b> add x to the top.</li><li><b>pop():</b> remove and return the top item.</li><li><b>peek():</b> read the top item without removing it.</li><li><b>isEmpty():</b> check whether the stack contains no items.</li></ul></div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Trace</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Start empty. <code>push(10)</code> gives [10]. <code>push(20)</code> gives [10, 20] with 20 on top. <code>pop()</code> returns 20, leaving [10].</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>import java.util.ArrayDeque;
import java.util.Deque;

Deque&lt;Integer&gt; stack = new ArrayDeque&lt;&gt;();
stack.push(10);
stack.push(20);
System.out.println(stack.peek());
System.out.println(stack.pop());
System.out.println(stack.pop());</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>20
20
10</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Push, pop, and peek are O(1) amortized/typical operations with ArrayDeque. Storage is O(n) for n items.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Undo history, browser backtracking, expression evaluation, function-call management, and depth-first search.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Popping an empty stack is invalid; check <code>isEmpty()</code> first. Do not confuse LIFO with a queue's FIFO order.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A stack is a collection where the most recently added item is the first one removed. This is called last-in, first-out (LIFO). Think of a pile of plates: you normally take the top plate first.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
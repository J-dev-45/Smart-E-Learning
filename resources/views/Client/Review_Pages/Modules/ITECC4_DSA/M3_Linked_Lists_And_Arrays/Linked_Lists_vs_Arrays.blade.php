<div class="mt-0" id="topic-compare">
    <h2 class="text-2xl font-bold text-white">Linked Lists vs ArrayLists</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Compare access, insertion, memory, and locality.</li><li>Choose a structure based on operation patterns.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">ArrayList stores elements in a resizable array; a linked list stores separate nodes connected by references. Neither is always faster. The best choice depends on how the program accesses and changes its data.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Comparison</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'><div class='overflow-x-auto'><table class='w-full text-left border-collapse'><thead><tr class='border-b border-[#3A2560]'><th class='p-2'>Operation</th><th class='p-2'>ArrayList</th><th class='p-2'>Linked list</th></tr></thead><tbody><tr class='border-b border-[#3A2560]'><td class='p-2'>Get by index</td><td class='p-2'>O(1)</td><td class='p-2'>O(n)</td></tr><tr class='border-b border-[#3A2560]'><td class='p-2'>Append</td><td class='p-2'>O(1) amortized</td><td class='p-2'>O(1) if tail is maintained</td></tr><tr class='border-b border-[#3A2560]'><td class='p-2'>Insert after known position/node</td><td class='p-2'>O(n) shifting</td><td class='p-2'>O(1) pointer updates</td></tr><tr><td class='p-2'>Memory/locality</td><td class='p-2'>Compact, cache-friendly</td><td class='p-2'>Extra references per node</td></tr></tbody></table></div></div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Decision example</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For a list where you frequently read element 900, an ArrayList is usually a better fit. For repeated insertion/removal at the head, a linked list can avoid shifting the remaining elements.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>import java.util.ArrayList;
import java.util.LinkedList;
import java.util.List;

List&lt;String&gt; indexed = new ArrayList&lt;&gt;();
List&lt;String&gt; linked = new LinkedList&lt;&gt;();
indexed.add("red");
linked.add("red");
System.out.println(indexed.get(0).equals(linked.get(0)));</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>true</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Both store n elements in O(n) space. ArrayList gives O(1) index access; linked-list index access is O(n).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Use ArrayList for frequent indexed reads; consider a linked list when operations at its ends or known nodes dominate.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A linked list does not make every insertion O(1): locating the insertion position can still take O(n).</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">ArrayList stores elements in a resizable array; a linked list stores separate nodes connected by references. Neither is always faster. The best choice depends on how the program accesses and changes its data.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
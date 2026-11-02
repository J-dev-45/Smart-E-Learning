<div class="mt-0" id="topic-hash">
    <h2 class="text-2xl font-bold text-white">Hash Tables</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain keys, hash functions, buckets, and collisions.</li><li>Describe common collision-handling strategies.</li><li>Recognize expected versus worst-case lookup cost.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A hash table stores key-value pairs by using a hash function to map a key to an array index or bucket. It aims to make insertion, lookup, and deletion fast on average.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Collision handling</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>A collision occurs when two different keys map to the same bucket. Separate chaining stores multiple entries in a bucket; open addressing searches for another available slot. A good hash function spreads keys across buckets.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Java example</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>HashMap maps each key to a value. Keys should obey the equals/hashCode contract: equal keys must have equal hash codes. A map does not promise insertion-order iteration.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>import java.util.HashMap;\nMap&lt;String, Integer&gt; scores = new HashMap&lt;&gt;();\nscores.put("Ana", 90);\nscores.put("Ben", 85);\nSystem.out.println(scores.get("Ana"));\nSystem.out.println(scores.containsKey("Mia"));</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>90\nfalse</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">HashMap get/put/remove are expected O(1) under good hash distribution; worst-case behavior can degrade. Space is O(n).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Caches, indexes, counting frequencies, dictionaries, and fast membership checks.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Do not assume every operation is guaranteed O(1). Avoid mutable keys whose hash/equality changes after insertion.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A hash table stores key-value pairs by using a hash function to map a key to an array index or bucket. It aims to make insertion, lookup, and deletion fast on average.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
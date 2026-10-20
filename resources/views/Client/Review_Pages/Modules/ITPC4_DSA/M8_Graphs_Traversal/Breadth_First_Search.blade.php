<div class="mt-0" id="topic-bfs">
    <h2 class="text-2xl font-bold text-white">Breadth First Search</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain level-by-level exploration.</li><li>Use a queue to implement BFS.</li><li>Explain why BFS finds shortest paths in unweighted graphs.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Breadth First Search (BFS) visits all immediate neighbors before moving to the next distance level. A queue preserves the order in which vertices are discovered.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Starting at A with neighbors B and C, enqueue B and C. Remove B and discover D, then remove C, then process D. One possible order is A, B, C, D. The order among peers depends on adjacency-list order.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Shortest path</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>In an unweighted graph, BFS discovers vertices in nondecreasing number of edges from the start. Record a parent or distance when first discovering a vertex to reconstruct a shortest path.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>static void bfs(String start, Map&lt;String, List&lt;String&gt;&gt; g) {\n    Queue&lt;String&gt; q = new ArrayDeque&lt;&gt;();\n    Set&lt;String&gt; seen = new HashSet&lt;&gt;();\n    q.offer(start); seen.add(start);\n    while (!q.isEmpty()) {\n        String v = q.poll();\n        System.out.println(v);\n        for (String next : g.getOrDefault(v, List.of())) {\n            if (seen.add(next)) q.offer(next);\n        }\n    }\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>Each reachable vertex is printed once in breadth-first order from start.</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">With an adjacency list, time is O(V + E). Queue and visited set use O(V) space.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Shortest paths in unweighted graphs, social-network degrees of separation, and level-order traversal.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Mark a vertex visited when enqueuing it, not only when removing it, to avoid enqueuing it repeatedly.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Breadth First Search (BFS) visits all immediate neighbors before moving to the next distance level. A queue preserves the order in which vertices are discovered.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
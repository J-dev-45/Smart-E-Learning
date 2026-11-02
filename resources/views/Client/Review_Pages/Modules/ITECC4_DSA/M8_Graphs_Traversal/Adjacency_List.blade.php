<div class="mt-0" id="topic-list">
    <h2 class="text-2xl font-bold text-white">Adjacency List</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Represent each vertex with its neighboring vertices.</li><li>Compare adjacency lists with matrices.</li><li>Estimate storage and neighbor-iteration cost.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">An adjacency list stores, for each vertex, a collection of its neighbors. It is usually more space-efficient than a matrix for sparse graphs, where the number of edges is much smaller than V².</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Example</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For A—B and A—C, A's list contains B and C; B's list contains A; C's list contains A. For an undirected graph, each edge appears in both endpoint lists.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Trade-off</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>An adjacency list stores O(V + E) data. Iterating through a vertex's neighbors costs O(degree of that vertex). Checking whether a specific edge exists may require scanning the list.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>Map&lt;String, List&lt;String&gt;&gt; graph = new HashMap&lt;&gt;();\ngraph.put("A", List.of("B", "C"));\ngraph.put("B", List.of("A"));\ngraph.put("C", List.of("A"));\nfor (String neighbor : graph.get("A")) {\n    System.out.println(neighbor);\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>B\nC</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Space O(V + E) for a typical adjacency-list representation. Neighbor iteration is O(degree(v)).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Sparse networks, social graphs, graph traversal, and most general graph-algorithm implementations.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">For undirected graphs, remember to add each edge to both endpoint lists. A missing key may return null, so initialize each vertex's list or handle absent vertices.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">An adjacency list stores, for each vertex, a collection of its neighbors. It is usually more space-efficient than a matrix for sparse graphs, where the number of edges is much smaller than V².</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
<div class="mt-0" id="topic-list">
    <h2 class="text-2xl font-bold sharedTXT">Adjacency List</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Represent each vertex with its neighboring vertices.</li><li>Compare adjacency lists with matrices.</li><li>Estimate storage and neighbor-iteration cost.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">An adjacency list stores, for each vertex, a collection of its neighbors. It is usually more space-efficient than a matrix for sparse graphs, where the number of edges is much smaller than V².</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Example</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>For A—B and A—C, A's list contains B and C; B's list contains A; C's list contains A. For an undirected graph, each edge appears in both endpoint lists.</div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Trade-off</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>An adjacency list stores O(V + E) data. Iterating through a vertex's neighbors costs O(degree of that vertex). Checking whether a specific edge exists may require scanning the list.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>Map&lt;String, List&lt;String&gt;&gt; graph = new HashMap&lt;&gt;();\ngraph.put("A", List.of("B", "C"));\ngraph.put("B", List.of("A"));\ngraph.put("C", List.of("A"));\nfor (String neighbor : graph.get("A")) {\n    System.out.println(neighbor);\n}</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>B\nC</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Space O(V + E) for a typical adjacency-list representation. Neighbor iteration is O(degree(v)).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Sparse networks, social graphs, graph traversal, and most general graph-algorithm implementations.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">For undirected graphs, remember to add each edge to both endpoint lists. A missing key may return null, so initialize each vertex's list or handle absent vertices.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">An adjacency list stores, for each vertex, a collection of its neighbors. It is usually more space-efficient than a matrix for sparse graphs, where the number of edges is much smaller than V².</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
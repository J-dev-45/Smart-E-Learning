<div class="mt-0" id="topic-matrix">
    <h2 class="text-2xl font-bold sharedTXT">Adjacency Matrix</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Represent a graph using a two-dimensional array.</li><li>Read edges from matrix entries.</li><li>Compare matrix space with adjacency lists.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">An adjacency matrix is a V × V table where entry matrix[i][j] indicates whether an edge exists from vertex i to vertex j. For weighted graphs, the entry may store a weight instead of a boolean-like 0 or 1.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Example</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>For an undirected graph with A—B and A—C, the matrix is symmetric: A connects to B and C, B connects to A, and C connects to A. The diagonal is normally zero when there are no self-loops.</div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Trade-off</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Checking whether a particular edge exists takes O(1), but the matrix always reserves O(V²) space even when the graph has few edges.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>int[][] matrix = {\n    {0, 1, 1},\n    {1, 0, 0},\n    {1, 0, 0}\n};\nSystem.out.println(matrix[0][2]);</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>1</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Space O(V²). Checking an edge is O(1); listing all neighbors of one vertex takes O(V).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Dense graphs, small graphs, and situations requiring frequent edge-existence checks.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">For a directed graph, matrix[i][j] need not equal matrix[j][i]. Agree on how absent edges and weights are represented.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">An adjacency matrix is a V × V table where entry matrix[i][j] indicates whether an edge exists from vertex i to vertex j. For weighted graphs, the entry may store a weight instead of a boolean-like 0 or 1.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
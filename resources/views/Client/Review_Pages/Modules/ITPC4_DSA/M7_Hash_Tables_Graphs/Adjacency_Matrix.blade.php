<div class="mt-0" id="topic-matrix">
    <h2 class="text-2xl font-bold text-white">Adjacency Matrix</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Represent a graph using a two-dimensional array.</li><li>Read edges from matrix entries.</li><li>Compare matrix space with adjacency lists.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">An adjacency matrix is a V × V table where entry matrix[i][j] indicates whether an edge exists from vertex i to vertex j. For weighted graphs, the entry may store a weight instead of a boolean-like 0 or 1.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Example</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For an undirected graph with A—B and A—C, the matrix is symmetric: A connects to B and C, B connects to A, and C connects to A. The diagonal is normally zero when there are no self-loops.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Trade-off</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Checking whether a particular edge exists takes O(1), but the matrix always reserves O(V²) space even when the graph has few edges.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>int[][] matrix = {\n    {0, 1, 1},\n    {1, 0, 0},\n    {1, 0, 0}\n};\nSystem.out.println(matrix[0][2]);</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>1</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Space O(V²). Checking an edge is O(1); listing all neighbors of one vertex takes O(V).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Dense graphs, small graphs, and situations requiring frequent edge-existence checks.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">For a directed graph, matrix[i][j] need not equal matrix[j][i]. Agree on how absent edges and weights are represented.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">An adjacency matrix is a V × V table where entry matrix[i][j] indicates whether an edge exists from vertex i to vertex j. For weighted graphs, the entry may store a weight instead of a boolean-like 0 or 1.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
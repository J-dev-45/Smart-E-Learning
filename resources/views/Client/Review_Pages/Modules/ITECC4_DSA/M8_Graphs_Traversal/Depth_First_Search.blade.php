<div class="mt-0" id="topic-dfs">
    <h2 class="text-2xl font-bold text-white">Depth First Search</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain depth-first exploration and backtracking.</li><li>Trace a DFS using a visited set.</li><li>Identify its time and space costs.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Depth First Search (DFS) explores one path as far as possible before backtracking. It can be implemented recursively or with an explicit stack. A visited set prevents revisiting vertices in graphs with cycles.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For A connected to B and C, and B connected to D, starting at A and visiting neighbors in listed order can produce A, B, D, C. Traversal order depends on neighbor order; the important rule is to explore deeply before returning.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Why visited matters</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>In a cyclic graph A—B—C—A, DFS could otherwise follow the cycle indefinitely. Mark each vertex visited before recursively exploring its neighbors.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>static void dfs(String v, Map&lt;String, List&lt;String&gt;&gt; g, Set&lt;String&gt; seen) {\n    if (!seen.add(v)) return;\n    System.out.println(v);\n    for (String next : g.getOrDefault(v, List.of())) {\n        dfs(next, g, seen);\n    }\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>Output depends on the starting vertex and each adjacency list's order; each reachable vertex is visited once.</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">With an adjacency list, time is O(V + E). Visited storage is O(V), plus recursion stack up to O(V).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Maze exploration, cycle detection, connected components, topological ordering foundations, and path exploration.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Mark vertices visited to avoid cycles. DFS does not guarantee the shortest path in an unweighted graph.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Depth First Search (DFS) explores one path as far as possible before backtracking. It can be implemented recursively or with an explicit stack. A visited set prevents revisiting vertices in graphs with cycles.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
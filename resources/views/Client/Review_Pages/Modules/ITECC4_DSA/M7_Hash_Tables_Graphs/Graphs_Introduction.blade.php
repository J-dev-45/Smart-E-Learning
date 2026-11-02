<div class="mt-0" id="topic-graphintro">
    <h2 class="text-2xl font-bold text-white">Graphs Introduction</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Identify vertices and edges.</li><li>Distinguish directed/undirected and weighted/unweighted graphs.</li><li>Model a practical relationship as a graph.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A graph consists of vertices (also called nodes) and edges connecting pairs of vertices. Graphs model relationships that are not necessarily hierarchical, such as friendships, road networks, and computer networks.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Graph types</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>An undirected edge can be traversed both ways; a directed edge has a direction. A weighted edge carries a cost such as distance. A graph may contain cycles, unlike a tree.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Example</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>If vertices A, B, C represent cities and edges A—B, A—C represent roads, the graph shows which cities are directly connected. A route from B to C may pass through A even if no direct B—C edge exists.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>Map&lt;String, List&lt;String&gt;&gt; graph = new HashMap&lt;&gt;();\ngraph.put("A", List.of("B", "C"));\ngraph.put("B", List.of("A"));\ngraph.put("C", List.of("A"));\nSystem.out.println(graph.get("A"));</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>[B, C]</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Graph algorithms are commonly described using V = number of vertices and E = number of edges. Exact complexity depends on representation and algorithm.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Social networks, maps, dependency systems, communication networks, and recommendation systems.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Clarify whether edges are directed and whether weights matter. Do not assume every pair of vertices is connected.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A graph consists of vertices (also called nodes) and edges connecting pairs of vertices. Graphs model relationships that are not necessarily hierarchical, such as friendships, road networks, and computer networks.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
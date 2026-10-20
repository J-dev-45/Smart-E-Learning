<div class="mt-10" id="topic-introduction-to-trees">

    <h2 class="text-2xl font-bold">
        2. Introduction to Trees
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        A tree is a connected, undirected graph with no cycles. Trees represent hierarchical relationships and are widely used in file systems, organizational charts, decision processes, and data structures. In a tree, there is exactly one simple path between any two vertices.
    </p>

    <h3 class="text-xl font-bold mt-6">Tree Terminology</h3>
    <div class="overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead><tr class="border-b border-[#3A2560] text-white"><th class="p-3">Term</th><th class="p-3">Meaning</th></tr></thead>
            <tbody>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Root</td><td class="p-3">The designated top node in a rooted tree.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Parent and child</td><td class="p-3">A parent is directly above its child in the hierarchy.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Leaf</td><td class="p-3">A node with no children.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Level</td><td class="p-3">The position of a node relative to the root.</td></tr>
                <tr><td class="p-3 text-white">Subtree</td><td class="p-3">A node together with its descendants and connecting edges.</td></tr>
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-bold mt-6">Important Properties of Trees</h3>
    <ul class="list-disc pl-6 space-y-2 mt-3 text-gray-400">
        <li>A tree is connected and contains no cycles.</li>
        <li>There is a unique simple path between any two vertices.</li>
        <li>A tree with n vertices has exactly n − 1 edges.</li>
        <li>Removing any edge disconnects a tree, while adding an edge between existing vertices creates a cycle.</li>
    </ul>

    <h3 class="text-xl font-bold mt-6">Graphs Compared with Trees</h3>
    <div class="overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead><tr class="border-b border-[#3A2560] text-white"><th class="p-3">Feature</th><th class="p-3">General Graph</th><th class="p-3">Tree</th></tr></thead>
            <tbody>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Cycles</td><td class="p-3">May contain cycles.</td><td class="p-3">Contains no cycles.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Connectivity</td><td class="p-3">May be disconnected.</td><td class="p-3">Must be connected.</td></tr>
                <tr><td class="p-3 text-white">Edges</td><td class="p-3">Can have varying numbers of edges.</td><td class="p-3">For n vertices, has n − 1 edges.</td></tr>
            </tbody>
        </table>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4"><h4 class="font-bold text-lg">IT Application</h4><p class="text-gray-400 mt-2">A folder hierarchy is naturally modeled as a tree: the main directory is the root, folders are internal nodes, and files or folders without children can appear as leaves.</p></div>
</div>

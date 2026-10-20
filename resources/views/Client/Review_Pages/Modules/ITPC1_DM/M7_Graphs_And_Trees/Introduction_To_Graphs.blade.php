<div class="mt-10" id="topic-introduction-to-graphs">

    <h2 class="text-2xl font-bold">
        1. Introduction to Graphs
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        A graph is a discrete structure used to represent relationships between objects. It consists of a set of vertices (or nodes) and a set of edges that connect pairs of vertices. Graphs are useful for modeling computer networks, roads, social connections, and links between web pages.
    </p>

    <h3 class="text-xl font-bold mt-6">Basic Graph Terminology</h3>
    <div class="overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead><tr class="border-b border-[#3A2560] text-white"><th class="p-3">Term</th><th class="p-3">Definition</th><th class="p-3">Example</th></tr></thead>
            <tbody>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Vertex</td><td class="p-3">An object or point in a graph.</td><td class="p-3">A computer in a network.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Edge</td><td class="p-3">A connection between vertices.</td><td class="p-3">A communication link.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-3 text-white">Degree</td><td class="p-3">The number of edges incident to a vertex in an undirected graph.</td><td class="p-3">A node connected to three edges has degree 3.</td></tr>
                <tr><td class="p-3 text-white">Path</td><td class="p-3">A sequence of vertices connected by edges.</td><td class="p-3">A route from one network node to another.</td></tr>
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-bold mt-6">Types of Graphs</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5"><h4 class="font-bold text-lg">Undirected Graph</h4><p class="text-gray-400 mt-2">Edges have no direction. A connection between A and B can be traversed in either direction.</p><p class="text-white mt-3">Example: A friendship network.</p></div>
        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5"><h4 class="font-bold text-lg">Directed Graph</h4><p class="text-gray-400 mt-2">Each edge has a direction, often shown with an arrow from one vertex to another.</p><p class="text-white mt-3">Example: A one-way link between web pages.</p></div>
        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5"><h4 class="font-bold text-lg">Connected Graph</h4><p class="text-gray-400 mt-2">Every pair of vertices can be joined by a path.</p></div>
        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5"><h4 class="font-bold text-lg">Cycle</h4><p class="text-gray-400 mt-2">A path that starts and ends at the same vertex, with no repeated edges in a simple cycle.</p></div>
    </div>

    <h3 class="text-xl font-bold mt-6">Why Graphs Matter in IT</h3>
    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">Graph models help represent routing problems, social networks, dependency relationships, and data connections. Choosing an appropriate graph representation makes it easier to analyze reachability, connectivity, and possible routes.</p>
</div>

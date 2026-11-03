<div class="mt-0" id="topic-treeintro">
    <h2 class="text-2xl font-bold sharedTXT">Tree Data Structure Introduction</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Define root, parent, child, leaf, depth, and height.</li><li>Distinguish a tree from a general graph.</li><li>Explain why trees are useful for hierarchical data.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A tree is a hierarchical structure of nodes connected by edges. In a rooted tree, one node is the root; each other node has exactly one parent. A node with no children is a leaf. Unlike a general graph, a tree is connected and has no cycles.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Terminology</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'><ul class='list-disc pl-6 space-y-2'><li><b>Root:</b> topmost node.</li><li><b>Parent/child:</b> direct relationship between connected nodes.</li><li><b>Leaf:</b> node with no children.</li><li><b>Depth:</b> number of edges from root to a node.</li><li><b>Height:</b> longest downward path from a node to a leaf.</li></ul></div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Example</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>A folder can contain subfolders and files. The top folder is the root; a folder inside it is a child. A file with no children behaves like a leaf in this hierarchy.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>class TreeNode {\n    String value;\n    TreeNode left, right;\n    TreeNode(String value) { this.value = value; }\n}\nTreeNode root = new TreeNode("A");\nroot.left = new TreeNode("B");\nroot.right = new TreeNode("C");</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>The tree has root A with children B and C; B and C are leaves.</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A tree with n nodes uses O(n) space. Operation costs depend on tree shape and the algorithm being used.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">File systems, organization charts, syntax trees, search indexes, and hierarchical menus.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Do not confuse depth with height. A binary tree allows at most two children per node; it is not automatically a binary search tree.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A tree is a hierarchical structure of nodes connected by edges. In a rooted tree, one node is the root; each other node has exactly one parent. A node with no children is a leaf. Unlike a general graph, a tree is connected and has no cycles.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
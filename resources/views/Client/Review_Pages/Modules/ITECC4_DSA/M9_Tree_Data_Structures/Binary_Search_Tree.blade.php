<div class="mt-0" id="topic-bst">
    <h2 class="text-2xl font-bold text-white">Binary Search Tree</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Explain the BST ordering property.</li><li>Trace search, insertion, and lookup.</li><li>Explain how tree shape affects performance.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A Binary Search Tree (BST) is a binary tree where values in the left subtree are smaller than the node's value and values in the right subtree are larger, under the chosen duplicate policy. This property supports search by choosing one subtree at each step.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Search trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For root 8, left child 3, and right child 12, search for 12: compare with 8; because 12 is larger, go right; compare with 12 and succeed. Searching for 2 goes left from 8, then left from 3, where the missing child indicates not found.</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Balanced versus skewed</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>A balanced BST has height around log₂ n, so search/insert can be O(log n). If values are inserted in sorted order into a plain unbalanced BST, it may become a chain and operations can degrade to O(n).</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>class Node {\n    int value; Node left, right;\n    Node(int value) { this.value = value; }\n}\nstatic boolean contains(Node node, int target) {\n    while (node != null) {\n        if (target == node.value) return true;\n        node = target &lt; node.value ? node.left : node.right;\n    }\n    return false;\n}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>contains(root, 12) returns true when the example tree has 12 in its right subtree.</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Search and insert are O(h), where h is tree height: O(log n) when balanced, O(n) in the worst case. Iterative search uses O(1) extra space.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Ordered sets/maps, range queries, and maintaining values for ordered retrieval; balanced tree implementations improve worst-case guarantees.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Preserve the ordering property after every insertion or deletion. State how duplicates are handled, and do not assume every BST is balanced.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A Binary Search Tree (BST) is a binary tree where values in the left subtree are smaller than the node's value and values in the right subtree are larger, under the chosen duplicate policy. This property supports search by choosing one subtree at each step.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
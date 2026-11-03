<div class="mt-0" id="topic-traversal">
    <h2 class="text-2xl font-bold sharedTXT">Tree Traversal</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Distinguish preorder, inorder, postorder, and level-order traversal.</li><li>Trace traversal orders on a small tree.</li><li>Connect inorder traversal to BST sorted order.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Tree traversal visits every node in a systematic order. Depth-first traversals use the relationship between visiting the current node and its subtrees; level-order traversal uses a queue.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Orders</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>For a root A with left child B and right child C: preorder (root-left-right) is A, B, C; inorder (left-root-right) is B, A, C; postorder (left-right-root) is B, C, A; level-order is A, B, C.</div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>BST connection</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Inorder traversal of a BST visits values in sorted order when the BST ordering rule is followed.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>static void inorder(Node node) {\n    if (node == null) return;\n    inorder(node.left);\n    System.out.print(node.value + " ");\n    inorder(node.right);\n}</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>For a BST containing 2 as left child, 1 as its left child, and 3 as its right child, inorder traversal prints values in ascending order: 1 2 3.</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Every traversal visits each node once: O(n) time. Recursive depth is O(h), where h is tree height; worst case O(n), balanced tree O(log n).</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Printing hierarchical data, evaluating expression trees, copying trees, and retrieving BST values in sorted order.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Place the visit statement in the correct location for the desired order. Always handle a null node as the base case.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Tree traversal visits every node in a systematic order. Depth-first traversals use the relationship between visiting the current node and its subtrees; level-order traversal uses a queue.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
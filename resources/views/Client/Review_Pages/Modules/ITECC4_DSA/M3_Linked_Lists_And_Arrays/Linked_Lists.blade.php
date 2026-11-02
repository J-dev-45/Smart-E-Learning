<div class="mt-0" id="topic-linked">
    <h2 class="text-2xl font-bold text-white">Linked Lists</h2>
    <div class="h-px bg-[#3A2560] my-4"></div>
    <section>
        <h3 class="text-lg font-bold text-white">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 text-gray-300"><li>Describe nodes and references between nodes.</li><li>Compare linked-list insertion with array indexing.</li><li>Trace a singly linked list.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Introduction</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A linked list is made of nodes. Each node stores a value and a reference to another node. In a singly linked list, each node points to the next node; a head reference identifies the first node.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold text-white'>Structure and operations</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>Unlike an array, a linked list does not require elements to occupy consecutive memory locations. Inserting after a known node can be O(1), but finding a node by index requires walking from the head and takes O(n).</div></section><section class='mt-5'><h3 class='text-lg font-bold text-white'>Trace</h3><div class='text-gray-300 mt-2 leading-relaxed space-y-2'>For 4 → 8 → 12 → null, the head points to 4. To insert 6 after 4, make 6 point to 8, then make 4 point to 6. The result is 4 → 6 → 8 → 12 → null.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Java Example</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border border-[#3A2560] bg-[#0B0612] p-4 text-sm text-cyan-100"><code>class Node {
    int value;
    Node next;
    Node(int value) { this.value = value; }
}

Node head = new Node(4);
head.next = new Node(8);
head.next.next = new Node(12);
for (Node current = head; current != null; current = current.next) {
    System.out.print(current.value + " ");
}</code></pre>
        <h4 class="font-bold text-white mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg bg-[#1B0D2D] p-3 text-sm text-gray-200"><code>4 8 12 </code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Complexity</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Searching/index access is O(n). Inserting or removing at the head is O(1). Storage is O(n), plus one reference per node.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Practical Applications</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Implementing queues, adjacency lists, playlists, and structures with frequent insertions/removals near known nodes.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold text-white">Common Mistakes</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">Update references in the correct order or nodes can become disconnected. A missing null check can cause a NullPointerException.</p>
    </section>
    <section class="mt-5 rounded-xl border border-[#3A2560] bg-[#1B0D2D] p-4">
        <h3 class="text-lg font-bold text-white">Lesson Summary</h3>
        <p class="text-gray-300 mt-2 leading-relaxed">A linked list is made of nodes. Each node stores a value and a reference to another node. In a singly linked list, each node points to the next node; a head reference identifies the first node.</p>
        <p class="text-gray-300 mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
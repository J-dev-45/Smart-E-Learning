
<div class="w-full">
    <h2 class="text-lg sm:text-xl font-bold text-white mb-3">7. Digraph Representation of Binary Relation</h2>

    <p class="text-gray-300 leading-relaxed break-words">
        A directed graph, or digraph, is a visual representation of a binary
        relation. Each element of a set is represented by a vertex, and each
        ordered pair in the relation is represented by a directed edge or arrow.
        Digraphs make it easier to visualize how elements are connected.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">1. Basic Components of a Digraph</h3>

        <h4 class="text-white font-semibold mt-4 mb-2">Vertices</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            Vertices represent the elements of a set. If A = {1, 2, 3}, the
            digraph contains three vertices labeled 1, 2, and 3.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Directed Edges</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            A directed edge represents an ordered pair. If (1, 2) belongs to
            relation R, an arrow is drawn from vertex 1 to vertex 2.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Loops</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            A loop is an arrow that starts and ends at the same vertex. A loop
            at vertex 1 represents the ordered pair (1, 1).
        </p    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">2. Example: Drawing a Digraph</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Let A = {1, 2, 3} and define the relation:
        </p>
        <p class="text-white mt-3">
            R = {(1, 2), (2, 3), (3, 1)}
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            The digraph contains three vertices and three directed edges:
        </p>
        <ul class="list-disc list-inside text-gray-300 space-y-2 mt-3">
            <li>An arrow from 1 to 2.</li>
            <li>An arrow from 2 to 3.</li>
            <li>An arrow from 3 to 1.</li>
        </ul>

        <div class="mt-5 flex justify-center">
            <svg viewBox="0 0 320 240" class="w-full max-w-sm" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <marker id="relationArrowOne" markerWidth="8" markerHeight="8" refX="6" refY="3" orient="auto">
                        <path d="M0,0 L6,3 L0,6 Z" fill="#A78BFA" />
                    </marker>
                </defs>
                <path d="M160 48 L237 164" stroke="#A78BFA" stroke-width="2.5" fill="none" marker-end="url(#relationArrowOne)" />
                <path d="M220 183 L100 183" stroke="#A78BFA" stroke-width="2.5" fill="none" marker-end="url(#relationArrowOne)" />
                <path d="M83 160 L145 51" stroke="#A78BFA" stroke-width="2.5" fill="none" marker-end="url(#relationArrowOne)" />
                <circle cx="160" cy="35" r="24" fill="#321A4D" stroke="#A78BFA" stroke-width="2.5" />
                <circle cx="250" cy="185" r="24" fill="#321A4D" stroke="#A78BFA" stroke-width="2.5" />
                <circle cx="70" cy="185" r="24" fill="#321A4D" stroke="#A78BFA" stroke-width="2.5" />
                <text x="160" y="41" text-anchor="middle" fill="#FFFFFF" font-size="16" font-weight="600">1</text>
                <text x="250" y="191" text-anchor="middle" fill="#FFFFFF" font-size="16" font-weight="600">2</text>
                <text x="70" y="191" text-anchor="middle" fill="#FFFFFF" font-size="16" font-weight="600">3</text>
            </svg>
        </div>

        <p class="text-gray-400 leading-relaxed mt-3 break-words">
            The arrows follow the ordered pairs in R. Because the relation
            contains (1, 2), (2, 3), and (3, 1), the arrows form a directed cycle.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">3. Example with a Loop</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Let A = {1, 2} and R = {(1, 1), (1, 2), (2, 2)}.
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            The digraph contains a loop at vertex 1, an arrow from 1 to 2,
            and a loop at vertex 2.
        </p>

        <div class="mt-5 flex justify-center">
            <svg viewBox="0 0 320 170" class="w-full max-w-sm" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <marker id="relationArrowTwo" markerWidth="8" markerHeight="8" refX="6" refY="3" orient="auto">
                        <path d="M0,0 L6,3 L0,6 Z" fill="#A78BFA" />
                    </marker>
                </defs>
                <path d="M100 72 C45 15 25 85 68 91" stroke="#A78BFA" stroke-width="2.5" fill="none" marker-end="url(#relationArrowTwo)" />
                <path d="M220 72 C275 15 295 85 252 91" stroke="#A78BFA" stroke-width="2.5" fill="none" marker-end="url(#relationArrowTwo)" />
                <path d="M124 85 L196 85" stroke="#A78BFA" stroke-width="2.5" fill="none" marker-end="url(#relationArrowTwo)" />
                <circle cx="100" cy="85" r="24" fill="#321A4D" stroke="#A78BFA" stroke-width="2.5" />
                <circle cx="220" cy="85" r="24" fill="#321A4D" stroke="#A78BFA" stroke-width="2.5" />
                <text x="100" y="91" text-anchor="middle" fill="#FFFFFF" font-size="16" font-weight="600">1</text>
                <text x="220" y="91" text-anchor="middle" fill="#FFFFFF" font-size="16" font-weight="600">2</text>
            </svg>
        </div>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">4. Identifying Relation Properties Using Digraphs</h3>

        <h4 class="text-white font-semibold mt-4 mb-2">Reflexive</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation on a set is reflexive when every vertex has a loop.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Irreflexive</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation is irreflexive when no vertex has a loop.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Symmetric</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation is symmetric when every arrow from one distinct vertex
            to another has a corresponding arrow in the opposite direction.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Antisymmetric</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation is antisymmetric when two distinct vertices cannot have
            arrows in both directions between them.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Transitive</h4>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation is transitive when an arrow from a to b and another from
            b to c require an arrow from a to c.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">5. Digraphs and Relation Matrices</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A digraph and a relation matrix represent the same relation in
            different ways. A directed edge from a to b corresponds to a matrix
            entry of 1 in the row for a and the column for b. If the arrow is
            absent, that entry is 0.
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            Digraphs emphasize the visual connections, while matrices provide
            a structured representation that is useful for calculations and
            computer processing.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">Applications in Information Technology</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Digraphs are useful for modeling directed network connections,
            website links, workflow dependencies, one-way routes, and
            relationships between entities in software systems.
        </p>
    </div>

    <div class="mt-6">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-3">Key Takeaways</h3>
        <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>Vertices represent elements of a set.</li>
            <li>Directed edges represent ordered pairs in a relation.</li>
            <li>A loop represents a pair of the form (a, a).</li>
            <li>Digraphs can help identify relation properties visually.</li>
            <li>Digraphs and relation matrices are two representations of the same relation.</li>
        </ul>
    </div>
</div>

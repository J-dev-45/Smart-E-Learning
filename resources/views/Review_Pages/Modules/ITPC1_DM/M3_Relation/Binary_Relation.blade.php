
{{-- BINARY RELATION --}}
<div class="w-full">

    <h2 class="text-xl font-bold">
        2. Binary Relation
    </h2>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A binary relation describes a connection between elements of
        two sets. It is called binary because each ordered pair contains
        two elements. Binary relations are used to represent connections
        between objects in mathematics and computer science.
    </p>

    {{-- DEFINITION --}}
    <h3 class="text-lg font-semibold mt-6">
        Definition of a Binary Relation
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Given two sets A and B, a binary relation R from A to B is
        any subset of the Cartesian product A × B. Each ordered pair
        (a, b) in R indicates that a is related to b.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold">
            Example
        </h4>

        <p class="text-gray-300 mt-3">
            Let A = {1, 2, 3} and B = {a, b}.
        </p>

        <p class="text-gray-300 mt-2">
            R = {(1, a), (2, b), (3, a)}
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            R is a binary relation from A to B because each ordered
            pair has its first element in A and its second element in B.
        </p>
    </div>

    {{-- RELATION ON A SET --}}
    <h3 class="text-lg font-semibold mt-6">
        Binary Relation on a Set
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A binary relation on a set A is a subset of A × A. Both
        elements of every ordered pair belong to the same set.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold">
            Example
        </h4>

        <p class="text-gray-300 mt-3">
            Let A = {1, 2, 3}.
        </p>

        <p class="text-gray-300 mt-2">
            R = {(1, 2), (2, 3), (1, 3)}
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            This is a relation on A because all elements in the ordered
            pairs belong to A.
        </p>
    </div>

    {{-- ORDERED PAIRS --}}
    <h3 class="text-lg font-semibold mt-6">
        Understanding Ordered Pairs
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Each ordered pair (a, b) represents a directed relationship
        from a to b. The order of the elements matters because reversing
        the pair can describe a different relationship.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold">
            Example
        </h4>

        <p class="text-gray-300 mt-3">
            R = {(1, 2)}
        </p>

        <p class="text-gray-400 mt-2 leading-relaxed">
            The relation contains (1, 2), but it does not automatically
            contain (2, 1). The reverse pair must be included separately
            if the relation requires it.
        </p>
    </div>

    {{-- DOMAIN AND RANGE --}}
    <h3 class="text-lg font-semibold mt-6">
        Domain and Range of a Binary Relation
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The domain is the set of first elements that appear in the
        relation. The range is the set of second elements that appear
        in the relation.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold">
            Example
        </h4>

        <p class="text-gray-300 mt-3">
            R = {(1, a), (2, b), (3, a)}
        </p>

        <p class="text-gray-300 mt-2">
            Domain = {1, 2, 3}
        </p>

        <p class="text-gray-300 mt-2">
            Range = {a, b}
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed">
            The domain contains the first elements, while the range
            contains the distinct second elements appearing in R.
        </p>
    </div>

    {{-- REPRESENTATIONS --}}
    <h3 class="text-lg font-semibold mt-6">
        Representations of Binary Relations
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Binary relations can be represented in several ways. Each
        representation provides a different way to understand the
        relationship between elements.
    </p>

    <div class="space-y-4 mt-4">

        <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold">
                1. Ordered-Pair Representation
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                This representation lists the ordered pairs belonging
                to the relation.
            </p>

            <p class="text-gray-300 mt-2">
                Example: R = {(1, 2), (2, 3)}
            </p>
        </div>

        <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold">
                2. Matrix Representation
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A matrix uses zeros and ones to indicate whether
                ordered pairs belong to the relation.
            </p>

            <p class="text-gray-300 mt-2">
                A value of 1 indicates that a pair belongs to R,
                while 0 indicates that it does not.
            </p>
        </div>

        <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold">
                3. Digraph Representation
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A directed graph uses vertices to represent elements
                and arrows to represent ordered pairs.
            </p>

            <p class="text-gray-300 mt-2">
                An arrow from a to b represents the pair (a, b).
            </p>
        </div>

    </div>

    {{-- APPLICATIONS --}}
    <h3 class="text-lg font-semibold mt-6">
        Applications in Information Technology
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Binary relations are useful in database systems, computer
        networks, and software applications. For example, a relation
        can connect students to the courses they are enrolled in,
        or users to the resources they are permitted to access.
    </p>

    {{-- KEY TAKEAWAYS --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-6">
        <h3 class="text-lg font-bold">
            Key Takeaways
        </h3>

        <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside">
            <li>
                A binary relation from A to B is a subset of A × B.
            </li>

            <li>
                Each ordered pair contains two elements.
            </li>

            <li>
                A relation on A is a subset of A × A.
            </li>

            <li>
                The order of elements in an ordered pair matters.
            </li>

            <li>
                The domain contains first elements appearing in the relation.
            </li>

            <li>
                The range contains second elements appearing in the relation.
            </li>

            <li>
                Binary relations can be represented using ordered pairs,
                matrices, and digraphs.
            </li>
        </ul>
    </div>

</div>

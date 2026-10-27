
{{-- DEFINITIONS AND PROPERTIES OF RELATION --}}
<div class="w-full">

    <h2 class="text-lg sm:text-xl font-bold">
        1. Definitions and Properties of Relation
    </h2>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        A relation is a mathematical concept used to describe a connection
        between elements of sets. In Discrete Mathematics, relations help
        represent relationships between objects, numbers, people, and
        other elements.
    </p>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        A relation from set A to set B is any subset of the Cartesian
        product A × B. Each element of a relation is an ordered pair
        (a, b), where a belongs to A and b belongs to B.
    </p>

    {{-- DEFINITION --}}
    <h3 class="text-base sm:text-lg font-semibold mt-6">
        Definition of a Relation
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        If A and B are sets, a relation R from A to B is a subset
        of A × B. The Cartesian product A × B contains all possible
        ordered pairs whose first element comes from A and whose second
        element comes from B.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold">
            Example
        </h4>

        <p class="text-gray-300 mt-3">
            Let A = {1, 2} and B = {a, b}.
        </p>

        <p class="text-gray-300 mt-2">
            A × B = {(1, a), (1, b), (2, a), (2, b)}
        </p>

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            A possible relation from A to B is
            R = {(1, a), (2, b)}. It is a relation because all its
            ordered pairs belong to A × B.
        </p>
    </div>

    {{-- ORDERED PAIRS --}}
    <h3 class="text-base sm:text-lg font-semibold mt-6">
        Ordered Pairs
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        An ordered pair consists of two elements written as (a, b).
        The order of the elements matters because the first and second
        positions have different meanings.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold">
            Example
        </h4>

        <p class="text-gray-300 mt-3">
            (1, 2) ≠ (2, 1)
        </p>

        <p class="text-gray-400 mt-2 leading-relaxed break-words">
            These ordered pairs are different because their elements
            appear in different positions.
        </p>
    </div>

    {{-- DOMAIN AND RANGE --}}
    <h3 class="text-base sm:text-lg font-semibold mt-6">
        Domain and Range of a Relation
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        The domain of a relation consists of the first elements of
        its ordered pairs. The range consists of the second elements
        that appear in those ordered pairs.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
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

        <p class="text-gray-400 mt-3 leading-relaxed break-words">
            The value a appears twice as a second element, but it is
            listed only once in the range because a set contains
            distinct elements.
        </p>
    </div>

    {{-- PROPERTIES --}}
    <h3 class="text-base sm:text-lg font-semibold mt-6">
        Properties of Relations
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        Relations can have different properties depending on which
        ordered pairs they contain. Four important properties are
        reflexivity, symmetry, antisymmetry, and transitivity.
    </p>

    {{-- REFLEXIVE --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold">
            1. Reflexive Relation
        </h4>

        <p class="text-gray-400 mt-2 leading-relaxed break-words">
            A relation R on a set A is reflexive if every element
            of A is related to itself.
        </p>

        <p class="text-gray-300 mt-3">
            For every a ∈ A, (a, a) ∈ R.
        </p>

        <p class="text-gray-300 mt-2">
            Example: If A = {1, 2}, then
            R = {(1, 1), (2, 2)} is reflexive.
        </p>
    </div>

    {{-- SYMMETRIC --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold">
            2. Symmetric Relation
        </h4>

        <p class="text-gray-400 mt-2 leading-relaxed break-words">
            A relation R is symmetric if whenever a is related to b,
            b is also related to a.
        </p>

        <p class="text-gray-300 mt-3">
            If (a, b) ∈ R, then (b, a) ∈ R.
        </p>

        <p class="text-gray-300 mt-2">
            Example: R = {(1, 2), (2, 1)} is symmetric.
        </p>
    </div>

    {{-- ANTISYMMETRIC --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold">
            3. Antisymmetric Relation
        </h4>

        <p class="text-gray-400 mt-2 leading-relaxed break-words">
            A relation R is antisymmetric if whenever (a, b) and
            (b, a) both belong to R, the elements a and b must be equal.
        </p>

        <p class="text-gray-300 mt-3">
            If (a, b) ∈ R and (b, a) ∈ R, then a = b.
        </p>

        <p class="text-gray-300 mt-2">
            Example: The less-than-or-equal-to relation (≤) on integers
            is antisymmetric.
        </p>
    </div>

    {{-- TRANSITIVE --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold">
            4. Transitive Relation
        </h4>

        <p class="text-gray-400 mt-2 leading-relaxed break-words">
            A relation R is transitive if whenever a is related to b
            and b is related to c, a must also be related to c.
        </p>

        <p class="text-gray-300 mt-3">
            If (a, b) ∈ R and (b, c) ∈ R, then (a, c) ∈ R.
        </p>

        <p class="text-gray-300 mt-2">
            Example: If (1, 2) and (2, 3) belong to R, transitivity
            requires (1, 3) to belong to R as well.
        </p>
    </div>

    {{-- APPLICATIONS --}}
    <h3 class="text-base sm:text-lg font-semibold mt-6">
        Applications in Information Technology
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        Relations are used in databases to represent connections
        between records, in computer networks to represent connections
        between devices, and in access-control systems to describe
        relationships between users and resources.
    </p>

    {{-- KEY TAKEAWAYS --}}
    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-6">
        <h3 class="text-base sm:text-lg font-bold">
            Key Takeaways
        </h3>

        <ul class="text-gray-400 mt-3 space-y-2 list-disc list-inside break-words">
            <li>
                A relation from A to B is a subset of A × B.
            </li>

            <li>
                Relations consist of ordered pairs.
            </li>

            <li>
                The domain contains first elements, while the range
                contains second elements appearing in the relation.
            </li>

            <li>
                A reflexive relation contains every required pair (a, a).
            </li>

            <li>
                A symmetric relation includes the reverse of every pair.
            </li>

            <li>
                An antisymmetric relation does not allow reverse pairs
                between distinct elements.
            </li>

            <li>
                A transitive relation connects a to c whenever a relates
                to b and b relates to c.
            </li>
        </ul>
    </div>

</div>


<div class="w-full">
    <h2 class="text-lg sm:text-xl font-bold text-white mb-3">5. Types of Relations</h2>

    <p class="text-gray-300 leading-relaxed break-words">
        Relations describe how elements of one set are connected to elements
        of another set or to elements within the same set. Different types of
        relations are classified according to the ordered pairs they contain
        and the properties they satisfy.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">1. Empty Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            An empty relation contains no ordered pairs. No element in the set
            is related to any other element.
        </p>
        <p class="text-white mt-3">R = ∅</p>
        <p class="text-gray-400 mt-2 break-words">
            Example: If A = {1, 2, 3}, an empty relation on A is R = ∅.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">2. Universal Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A universal relation on a set A contains every possible ordered
            pair in A × A.
        </p>
        <p class="text-white mt-3">R = A × A</p>
        <p class="text-gray-400 mt-2 break-words">
            Example: If A = {1, 2}, then
            R = {(1, 1), (1, 2), (2, 1), (2, 2)}.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">3. Identity Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            An identity relation on a set A contains only ordered pairs in
            which both elements are the same.
        </p>
        <p class="text-white mt-3">
            I = {(a, a) | a ∈ A}
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: If A = {1, 2, 3}, then
            I = {(1, 1), (2, 2), (3, 3)}.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">4. Reflexive Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation R on A is reflexive if every element is related to
            itself.
        </p>
        <p class="text-white mt-3">
            For every a ∈ A, (a, a) ∈ R.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: R = {(1, 1), (2, 2), (1, 2)} on A = {1, 2} is reflexive
            because both (1, 1) and (2, 2) are present.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">5. Irreflexive Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation R on A is irreflexive if no element is related to itself.
        </p>
        <p class="text-white mt-3">
            For every a ∈ A, (a, a) ∉ R.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: R = {(1, 2), (2, 1)} on A = {1, 2} is irreflexive because
            neither (1, 1) nor (2, 2) is present.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">6. Symmetric Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation R is symmetric if whenever (a, b) belongs to R,
            (b, a) also belongs to R.
        </p>
        <p class="text-white mt-3">
            If (a, b) ∈ R, then (b, a) ∈ R.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: R = {(1, 2), (2, 1)} is symmetric.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">7. Antisymmetric Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation R is antisymmetric if whenever (a, b) and (b, a)
            both belong to R, the elements must be equal.
        </p>
        <p class="text-white mt-3">
            If (a, b) ∈ R and (b, a) ∈ R, then a = b.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: R = {(1, 1), (1, 2), (2, 2)} is antisymmetric because
            there are no pairs (1, 2) and (2, 1) together.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">8. Asymmetric Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation R is asymmetric if whenever a is related to b, b cannot
            be related to a. An asymmetric relation is also irreflexive.
        </p>
        <p class="text-white mt-3">
            If (a, b) ∈ R, then (b, a) ∉ R.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: R = {(1, 2), (2, 3)} is asymmetric.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">9. Transitive Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A relation R is transitive if whenever (a, b) and (b, c) belong
            to R, (a, c) must also belong to R.
        </p>
        <p class="text-white mt-3">
            If (a, b) ∈ R and (b, c) ∈ R, then (a, c) ∈ R.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: R = {(1, 2), (2, 3), (1, 3)} satisfies the transitivity
            requirement for the chain 1 → 2 → 3.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">10. Equivalence Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            An equivalence relation is a relation that is reflexive, symmetric,
            and transitive.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: On a set of integers, the relation “has the same
            remainder when divided by 2” is an equivalence relation.
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            It groups elements into equivalence classes whose members are
            related according to the same rule.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">11. Partial Order Relation</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            A partial order is a relation that is reflexive, antisymmetric,
            and transitive.
        </p>
        <p class="text-gray-400 mt-2 break-words">
            Example: The subset relation ⊆ on a collection of sets is a
            partial order.
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            Partial orders are useful when elements can be arranged according
            to an ordering rule, even when not every pair of elements can be
            compared.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">Applications in Information Technology</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Different relation types are used to represent connections in
            databases, model dependency and precedence rules, organize
            hierarchical data, and group objects with shared characteristics.
        </p>
    </div>

    <div class="mt-6">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-3">Key Takeaways</h3>
        <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>An empty relation contains no ordered pairs.</li>
            <li>A universal relation contains every possible pair in A × A.</li>
            <li>An identity relation contains pairs of the form (a, a).</li>
            <li>Reflexive, irreflexive, symmetric, antisymmetric, asymmetric, and transitive relations have distinct defining properties.</li>
            <li>An equivalence relation is reflexive, symmetric, and transitive.</li>
            <li>A partial order is reflexive, antisymmetric, and transitive.</li>
        </ul>
    </div>
</div>

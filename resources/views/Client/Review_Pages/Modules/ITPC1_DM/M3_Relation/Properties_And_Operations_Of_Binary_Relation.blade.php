
<div class="w-full">
    <h2 class="text-xl font-bold sharedTXT mb-3">4. Properties and Operations of Binary Relations</h2>

    <p class="sharedTXTBody leading-relaxed">
        Binary relations can have different properties depending on how their
        elements are connected. Operations on relations allow us to combine,
        compare, or reverse these connections.
    </p>

    <div class="sharedSurfaceBG border sharedBorder rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold sharedTXT mb-2">1. Properties of Binary Relations</h3>
        <p class="sharedTXTBody leading-relaxed">
            Let R be a binary relation on a set A. The following properties
            describe how elements of A relate to one another.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Reflexive</h4>
        <p class="sharedTXTBody leading-relaxed">
            A relation R is reflexive if every element is related to itself.
        </p>
        <p class="sharedTXT mt-2">For every a ∈ A, (a, a) ∈ R.</p>
        <p class="sharedTXTMuted mt-2">
            Example: If A = {1, 2}, then R = {(1, 1), (2, 2)} is reflexive.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Symmetric</h4>
        <p class="sharedTXTBody leading-relaxed">
            A relation R is symmetric if whenever a is related to b, b is also
            related to a.
        </p>
        <p class="sharedTXT mt-2">
            If (a, b) ∈ R, then (b, a) ∈ R.
        </p>
        <p class="sharedTXTMuted mt-2">
            Example: R = {(1, 2), (2, 1)} is symmetric.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Antisymmetric</h4>
        <p class="sharedTXTBody leading-relaxed">
            A relation R is antisymmetric if a relation from a to b and from b
            to a can only occur when a = b.
        </p>
        <p class="sharedTXT mt-2">
            If (a, b) ∈ R and (b, a) ∈ R, then a = b.
        </p>
        <p class="sharedTXTMuted mt-2">
            Example: The relation {(1, 1), (1, 2), (2, 2)} is antisymmetric.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Transitive</h4>
        <p class="sharedTXTBody leading-relaxed">
            A relation R is transitive if whenever a is related to b and b is
            related to c, a is also related to c.
        </p>
        <p class="sharedTXT mt-2">
            If (a, b) ∈ R and (b, c) ∈ R, then (a, c) ∈ R.
        </p>
        <p class="sharedTXTMuted mt-2">
            Example: R = {(1, 2), (2, 3), (1, 3)} satisfies transitivity for
            the chain 1 → 2 → 3.
        </p>
    </div>

    <div class="sharedSurfaceBG border sharedBorder rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold sharedTXT mb-2">2. Operations on Binary Relations</h3>
        <p class="sharedTXTBody leading-relaxed">
            Relations are sets of ordered pairs, so common set operations can
            be used to create new relations.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Union</h4>
        <p class="sharedTXTBody leading-relaxed">
            The union of two relations contains every ordered pair that belongs
            to either relation or both.
        </p>
        <p class="sharedTXT mt-2">R ∪ S</p>
        <p class="sharedTXTMuted mt-2">
            Example: R = {(1, 2)} and S = {(2, 3)}.
            Therefore, R ∪ S = {(1, 2), (2, 3)}.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Intersection</h4>
        <p class="sharedTXTBody leading-relaxed">
            The intersection of two relations contains only the ordered pairs
            common to both relations.
        </p>
        <p class="sharedTXT mt-2">R ∩ S</p>
        <p class="sharedTXTMuted mt-2">
            Example: R = {(1, 2), (2, 3)} and S = {(2, 3), (3, 4)}.
            Therefore, R ∩ S = {(2, 3)}.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Difference</h4>
        <p class="sharedTXTBody leading-relaxed">
            The difference R − S contains ordered pairs that belong to R but
            do not belong to S.
        </p>
        <p class="sharedTXTMuted mt-2">
            Example: R = {(1, 2), (2, 3)} and S = {(2, 3)}.
            Therefore, R − S = {(1, 2)}.
        </p>

        <h4 class="sharedTXT font-semibold mt-4 mb-2">Inverse Relation</h4>
        <p class="sharedTXTBody leading-relaxed">
            The inverse of a relation is formed by reversing the elements in
            every ordered pair.
        </p>
        <p class="sharedTXT mt-2">
            R⁻¹ = {(b, a) | (a, b) ∈ R}
        </p>
        <p class="sharedTXTMuted mt-2">
            Example: If R = {(1, 2), (2, 3)}, then
            R⁻¹ = {(2, 1), (3, 2)}.
        </p>
    </div>

    <div class="sharedSurfaceBG border sharedBorder rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold sharedTXT mb-2">3. Composition of Relations</h3>
        <p class="sharedTXTBody leading-relaxed">
            Composition connects two relations through a shared intermediate
            element. If a is related to b through R and b is related to c
            through S, then a can be related to c through the composition.
        </p>
        <p class="sharedTXT mt-3">
            S ∘ R = {(a, c) | there exists b such that (a, b) ∈ R and (b, c) ∈ S}
        </p>

        <p class="sharedTXTBody leading-relaxed mt-3">
            Example:
        </p>
        <p class="sharedTXT mt-2">R = {(1, 2)}</p>
        <p class="sharedTXT">S = {(2, 3)}</p>
        <p class="sharedTXTMuted mt-2">
            Since 1 is related to 2 through R and 2 is related to 3 through S,
            the composition contains (1, 3).
        </p>
        <p class="sharedTXTSuccess font-semibold mt-2">
            S ∘ R = {(1, 3)}
        </p>
    </div>

    <div class="sharedSurfaceBG border sharedBorder rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold sharedTXT mb-2">Applications in Information Technology</h3>
        <p class="sharedTXTBody leading-relaxed">
            Binary relation properties and operations are useful for analyzing
            database relationships, representing connections in networks,
            checking dependency rules, and combining or reversing relationships
            between system entities.
        </p>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold sharedTXT mb-3">Key Takeaways</h3>
        <ul class="list-disc list-inside sharedTXTBody space-y-2">
            <li>Reflexive, symmetric, antisymmetric, and transitive describe different relation properties.</li>
            <li>Union combines the ordered pairs from two relations.</li>
            <li>Intersection keeps only the ordered pairs shared by both relations.</li>
            <li>Difference keeps pairs in one relation but not the other.</li>
            <li>The inverse reverses each ordered pair.</li>
            <li>Composition connects relations through an intermediate element.</li>
        </ul>
    </div>
</div>


<div class="w-full">
    <h2 class="text-xl font-bold text-white mb-3">6. Matrices Representing Relations</h2>

    <p class="text-gray-300 leading-relaxed">
        A relation between two finite sets can be represented using a matrix.
        Each entry in the matrix indicates whether a particular ordered pair
        belongs to the relation. Matrix representation makes relations easier
        to analyze and is useful in computer science and discrete mathematics.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold text-white mb-2">1. Definition of a Relation Matrix</h3>
        <p class="text-gray-300 leading-relaxed">
            Let A = {a₁, a₂, ..., aₘ} and B = {b₁, b₂, ..., bₙ} be finite sets,
            and let R be a relation from A to B. The matrix representing R is
            an m × n matrix M_R, where:
        </p>
        <p class="text-white text-center mt-3">
            mᵢⱼ = 1 if (aᵢ, bⱼ) ∈ R
        </p>
        <p class="text-white text-center mt-2">
            mᵢⱼ = 0 if (aᵢ, bⱼ) ∉ R
        </p>
        <p class="text-gray-300 leading-relaxed mt-3">
            Rows represent elements of set A, while columns represent elements
            of set B. A value of 1 indicates that the pair belongs to the
            relation, and 0 indicates that it does not.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold text-white mb-2">2. Example: Constructing a Relation Matrix</h3>
        <p class="text-gray-300 leading-relaxed">
            Let A = {1, 2, 3}, B = {a, b}, and define the relation:
        </p>
        <p class="text-white mt-3">
            R = {(1, a), (2, b), (3, a)}
        </p>
        <p class="text-gray-300 leading-relaxed mt-3">
            The rows correspond to 1, 2, and 3, and the columns correspond to
            a and b.
        </p>

        <div class="overflow-x-auto mt-4">
            <table class="w-full border-collapse text-center text-white">
                <thead>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">A \ B</th>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">a</th>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">b</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">1</th>
                        <td class="border border-[#5B3B80] p-3">1</td>
                        <td class="border border-[#5B3B80] p-3">0</td>
                    </tr>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">2</th>
                        <td class="border border-[#5B3B80] p-3">0</td>
                        <td class="border border-[#5B3B80] p-3">1</td>
                    </tr>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">3</th>
                        <td class="border border-[#5B3B80] p-3">1</td>
                        <td class="border border-[#5B3B80] p-3">0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="text-gray-300 leading-relaxed mt-3">
            The resulting matrix is:
        </p>
        <p class="text-white text-center mt-2">
            M_R = [1 0; 0 1; 1 0]
        </p>
        <p class="text-gray-400 leading-relaxed mt-2">
            The pair (1, a) is included, so its entry is 1. The pair (1, b)
            is not included, so its entry is 0. The same rule applies to every
            row and column.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold text-white mb-2">3. Matrix Representation of a Relation on One Set</h3>
        <p class="text-gray-300 leading-relaxed">
            When a relation is defined on a single set A, its matrix is square
            because the rows and columns represent the same set.
        </p>
        <p class="text-white mt-3">
            Let A = {1, 2, 3}
        </p>
        <p class="text-white mt-2">
            R = {(1, 1), (1, 2), (2, 3), (3, 1)}
        </p>

        <div class="overflow-x-auto mt-4">
            <table class="w-full border-collapse text-center text-white">
                <thead>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">R</th>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">1</th>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">2</th>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">1</th>
                        <td class="border border-[#5B3B80] p-3">1</td>
                        <td class="border border-[#5B3B80] p-3">1</td>
                        <td class="border border-[#5B3B80] p-3">0</td>
                    </tr>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">2</th>
                        <td class="border border-[#5B3B80] p-3">0</td>
                        <td class="border border-[#5B3B80] p-3">0</td>
                        <td class="border border-[#5B3B80] p-3">1</td>
                    </tr>
                    <tr>
                        <th class="border border-[#5B3B80] p-3 bg-[#321A4D]">3</th>
                        <td class="border border-[#5B3B80] p-3">1</td>
                        <td class="border border-[#5B3B80] p-3">0</td>
                        <td class="border border-[#5B3B80] p-3">0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="text-gray-300 leading-relaxed mt-3">
            The diagonal entries correspond to (1, 1), (2, 2), and (3, 3).
            Since only (1, 1) belongs to R among these pairs, only the first
            diagonal entry is 1.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold text-white mb-2">4. Using Matrices to Identify Relation Properties</h3>

        <h4 class="text-white font-semibold mt-4 mb-2">Reflexive Relation</h4>
        <p class="text-gray-300 leading-relaxed">
            A relation on a set is reflexive when every diagonal entry in its
            matrix is 1.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Irreflexive Relation</h4>
        <p class="text-gray-300 leading-relaxed">
            A relation on a set is irreflexive when every diagonal entry is 0.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Symmetric Relation</h4>
        <p class="text-gray-300 leading-relaxed">
            A relation on a set is symmetric when its matrix is equal to its
            transpose. Corresponding entries across the main diagonal must match.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Antisymmetric Relation</h4>
        <p class="text-gray-300 leading-relaxed">
            For distinct elements, entries at mirrored positions cannot both
            be 1. In other words, if an off-diagonal entry is 1, its mirrored
            entry must be 0.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold text-white mb-2">5. Operations on Relation Matrices</h3>
        <p class="text-gray-300 leading-relaxed">
            Relation operations can be represented using the entries of their
            matrices, provided the relations have compatible sets and dimensions.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Union</h4>
        <p class="text-gray-300 leading-relaxed">
            The union matrix has an entry of 1 wherever either relation matrix
            has an entry of 1.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Intersection</h4>
        <p class="text-gray-300 leading-relaxed">
            The intersection matrix has an entry of 1 only where both relation
            matrices have an entry of 1.
        </p>

        <h4 class="text-white font-semibold mt-4 mb-2">Inverse</h4>
        <p class="text-gray-300 leading-relaxed">
            The inverse relation matrix is obtained by transposing the original
            matrix, exchanging its rows and columns.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h3 class="text-lg font-semibold text-white mb-2">Applications in Information Technology</h3>
        <p class="text-gray-300 leading-relaxed">
            Relation matrices are useful for representing network connections,
            modeling database relationships, analyzing graph structures, and
            storing relationships in a structured form that computers can process.
        </p>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold text-white mb-3">Key Takeaways</h3>
        <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>A relation matrix uses 1 for an included ordered pair and 0 for a pair that is not included.</li>
            <li>A relation from A to B has a matrix with rows for A and columns for B.</li>
            <li>A relation on one set has a square matrix.</li>
            <li>Diagonal entries help identify reflexive and irreflexive relations.</li>
            <li>A symmetric relation has a matrix equal to its transpose.</li>
            <li>The transpose of a relation matrix represents the inverse relation.</li>
        </ul>
    </div>
</div>

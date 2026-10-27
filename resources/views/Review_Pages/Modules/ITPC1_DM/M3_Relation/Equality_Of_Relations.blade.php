
<div class="w-full">
    <h2 class="text-lg sm:text-xl font-bold text-white mb-3">3. Equality of Relations</h2>

    <p class="text-gray-300 leading-relaxed break-words">
        Two relations are equal when they contain exactly the same ordered pairs.
        For two relations to be equal, they must have the same elements and no
        additional or missing ordered pairs.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">Definition</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Let R and S be two relations. The relations R and S are equal if and
            only if R = S, meaning every ordered pair in R is also in S and every
            ordered pair in S is also in R.
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            In set notation:
        </p>
        <p class="text-white font-semibold text-center mt-2">
            R = S if and only if R ⊆ S and S ⊆ R
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">Example 1: Equal Relations</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Given the relations:
        </p>
        <p class="text-white mt-3">
            R = {(1, 2), (2, 3), (3, 4)}
        </p>
        <p class="text-white">
            S = {(3, 4), (1, 2), (2, 3)}
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            The relations are equal because they contain exactly the same ordered
            pairs. The order in which the pairs are written does not affect
            equality.
        </p>
        <p class="text-green-300 font-semibold mt-3">
            Therefore, R = S.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">Example 2: Unequal Relations</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Consider the following relations:
        </p>
        <p class="text-white mt-3">
            R = {(1, 2), (2, 3), (3, 4)}
        </p>
        <p class="text-white">
            T = {(1, 2), (2, 3)}
        </p>
        <p class="text-gray-300 leading-relaxed mt-3 break-words">
            The relations are not equal because the ordered pair (3, 4) is
            present in R but missing from T.
        </p>
        <p class="text-red-300 font-semibold mt-3">
            Therefore, R ≠ T.
        </p>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">How to Determine Whether Two Relations Are Equal</h3>
        <ol class="list-decimal list-inside text-gray-300 space-y-2">
            <li>Write down the ordered pairs in the first relation.</li>
            <li>Compare each ordered pair with the second relation.</li>
            <li>Check that no ordered pair is missing or added.</li>
            <li>If both relations contain exactly the same ordered pairs, they are equal.</li>
        </ol>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">Important Reminders</h3>
        <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>The order of the ordered pairs within a relation does not matter.</li>
            <li>The order of elements inside an ordered pair matters. For example, (1, 2) is different from (2, 1).</li>
            <li>Relations with different ordered pairs are not equal.</li>
            <li>Two relations can be equal even when their ordered pairs are written in different sequences.</li>
        </ul>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-2">Applications in Information Technology</h3>
        <p class="text-gray-300 leading-relaxed break-words">
            Equality of relations is useful when comparing data represented as
            pairs, checking whether two database relationship sets contain the
            same connections, and verifying whether two systems describe the
            same associations between elements.
        </p>
    </div>

    <div class="mt-6">
        <h3 class="text-base sm:text-lg font-semibold text-white mb-3">Key Takeaways</h3>
        <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>Two relations are equal if they contain exactly the same ordered pairs.</li>
            <li>Changing the sequence in which ordered pairs are written does not change a relation.</li>
            <li>One missing or additional ordered pair makes two relations unequal.</li>
            <li>Equality can be verified by checking that each relation is a subset of the other.</li>
        </ul>
    </div>
</div>

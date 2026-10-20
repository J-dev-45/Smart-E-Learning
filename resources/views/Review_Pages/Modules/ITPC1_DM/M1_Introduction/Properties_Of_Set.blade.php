<div class="mt-10" id="topic-properties-of-set">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        3. Properties of Set
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        Properties of sets are mathematical rules that describe how
        sets behave when different set operations are performed.
        These properties help simplify set expressions and make it
        easier to solve problems involving union, intersection,
        complements, and other set operations.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Why Set Properties Are Important
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Set properties provide rules that can be used to rewrite and
        simplify set expressions without changing their meaning.
        They are useful when solving mathematical problems, proving
        relationships between sets, and working with collections of
        data in computer science and information technology.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Commutative Property
            </h4>

            <p class="text-gray-400 mt-2">
                The order of the sets does not affect the result of
                union or intersection.
            </p>

            <p class="text-white mt-3">
                A ∪ B = B ∪ A
            </p>

            <p class="text-white mt-1">
                A ∩ B = B ∩ A
            </p>

            <div class="mt-4 border-t border-[#3A2560] pt-3">

                <p class="text-gray-400">
                    Example:
                </p>

                <p class="text-white mt-2">
                    A = {1, 2, 3}
                </p>

                <p class="text-white mt-1">
                    B = {3, 4, 5}
                </p>

                <p class="text-gray-400 mt-2">
                    A ∪ B = {1, 2, 3, 4, 5}
                </p>

                <p class="text-gray-400 mt-1">
                    B ∪ A = {1, 2, 3, 4, 5}
                </p>

            </div>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Associative Property
            </h4>

            <p class="text-gray-400 mt-2">
                The grouping of sets does not affect the result of
                union or intersection.
            </p>

            <p class="text-white mt-3">
                (A ∪ B) ∪ C = A ∪ (B ∪ C)
            </p>

            <p class="text-white mt-1">
                (A ∩ B) ∩ C = A ∩ (B ∩ C)
            </p>

            <div class="mt-4 border-t border-[#3A2560] pt-3">

                <p class="text-gray-400">
                    Example:
                </p>

                <p class="text-white mt-2">
                    A = {1, 2}
                </p>

                <p class="text-white mt-1">
                    B = {2, 3}
                </p>

                <p class="text-white mt-1">
                    C = {3, 4}
                </p>

                <p class="text-gray-400 mt-2">
                    (A ∪ B) ∪ C = {1, 2, 3, 4}
                </p>

                <p class="text-gray-400 mt-1">
                    A ∪ (B ∪ C) = {1, 2, 3, 4}
                </p>

            </div>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Distributive Property
            </h4>

            <p class="text-gray-400 mt-2">
                Union and intersection can be distributed over each
                other.
            </p>

            <p class="text-white mt-3">
                A ∪ (B ∩ C) = (A ∪ B) ∩ (A ∪ C)
            </p>

            <p class="text-white mt-1">
                A ∩ (B ∪ C) = (A ∩ B) ∪ (A ∩ C)
            </p>

            <div class="mt-4 border-t border-[#3A2560] pt-3">

                <p class="text-gray-400">
                    Example:
                </p>

                <p class="text-white mt-2">
                    A = {1, 2}
                </p>

                <p class="text-white mt-1">
                    B = {2, 3}
                </p>

                <p class="text-white mt-1">
                    C = {2, 4}
                </p>

                <p class="text-gray-400 mt-2">
                    B ∩ C = {2}
                </p>

                <p class="text-gray-400 mt-1">
                    A ∪ (B ∩ C) = {1, 2}
                </p>

            </div>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Identity Property
            </h4>

            <p class="text-gray-400 mt-2">
                Combining a set with the empty set or universal set
                follows specific rules.
            </p>

            <p class="text-white mt-3">
                A ∪ ∅ = A
            </p>

            <p class="text-white mt-1">
                A ∩ U = A
            </p>

            <div class="mt-4 border-t border-[#3A2560] pt-3">

                <p class="text-gray-400">
                    Example:
                </p>

                <p class="text-white mt-2">
                    A = {1, 2, 3}
                </p>

                <p class="text-gray-400 mt-2">
                    A ∪ ∅ = {1, 2, 3}
                </p>

                <p class="text-gray-400 mt-1">
                    A ∩ U = {1, 2, 3}
                </p>

                <p class="text-gray-500 text-sm mt-2">
                    The identity property leaves the original set
                    unchanged.
                </p>

            </div>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Complement Property
            </h4>

            <p class="text-gray-400 mt-2">
                A set and its complement have no elements in common,
                and together they contain all elements of the
                universal set.
            </p>

            <p class="text-white mt-3">
                A ∩ A′ = ∅
            </p>

            <p class="text-white mt-1">
                A ∪ A′ = U
            </p>

            <div class="mt-4 border-t border-[#3A2560] pt-3">

                <p class="text-gray-400">
                    Example:
                </p>

                <p class="text-white mt-2">
                    U = {1, 2, 3, 4, 5}
                </p>

                <p class="text-white mt-1">
                    A = {1, 2, 3}
                </p>

                <p class="text-white mt-1">
                    A′ = {4, 5}
                </p>

                <p class="text-gray-400 mt-2">
                    A ∩ A′ = ∅
                </p>

                <p class="text-gray-400 mt-1">
                    A ∪ A′ = {1, 2, 3, 4, 5} = U
                </p>

            </div>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Idempotent Property
            </h4>

            <p class="text-gray-400 mt-2">
                Combining a set with itself produces the same set.
            </p>

            <p class="text-white mt-3">
                A ∪ A = A
            </p>

            <p class="text-white mt-1">
                A ∩ A = A
            </p>

            <div class="mt-4 border-t border-[#3A2560] pt-3">

                <p class="text-gray-400">
                    Example:
                </p>

                <p class="text-white mt-2">
                    A = {1, 2, 3}
                </p>

                <p class="text-gray-400 mt-2">
                    A ∪ A = {1, 2, 3}
                </p>

                <p class="text-gray-400 mt-1">
                    A ∩ A = {1, 2, 3}
                </p>

            </div>

        </div>

    </div>


    <h3 class="text-xl font-bold mt-8">
        Additional Set Properties
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In addition to the properties above, several other rules are
        commonly used when simplifying set expressions.
    </p>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Domination Property
            </h4>

            <p class="text-gray-400 mt-2">
                The universal set dominates union, while the empty
                set dominates intersection.
            </p>

            <p class="text-white mt-3">
                A ∪ U = U
            </p>

            <p class="text-white mt-1">
                A ∩ ∅ = ∅
            </p>

            <p class="text-gray-400 mt-3">
                Example:
                A = {1, 2, 3}, U = {1, 2, 3, 4, 5}
            </p>

            <p class="text-gray-400 mt-1">
                A ∪ U = U
            </p>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Double Complement Property
            </h4>

            <p class="text-gray-400 mt-2">
                Taking the complement of a set twice returns the
                original set.
            </p>

            <p class="text-white mt-3">
                (A′)′ = A
            </p>

            <p class="text-gray-400 mt-3">
                Example:
                U = {1, 2, 3, 4, 5}
            </p>

            <p class="text-gray-400 mt-1">
                A = {1, 2}
            </p>

            <p class="text-gray-400 mt-1">
                A′ = {3, 4, 5}
            </p>

            <p class="text-gray-400 mt-1">
                (A′)′ = {1, 2} = A
            </p>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Absorption Property
            </h4>

            <p class="text-gray-400 mt-2">
                A set combined with another set that already contains
                it produces the original set.
            </p>

            <p class="text-white mt-3">
                A ∪ (A ∩ B) = A
            </p>

            <p class="text-white mt-1">
                A ∩ (A ∪ B) = A
            </p>

            <p class="text-gray-400 mt-3">
                These identities are useful when simplifying
                complicated set expressions.
            </p>

        </div>


        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                De Morgan's Laws
            </h4>

            <p class="text-gray-400 mt-2">
                De Morgan's Laws describe how complements interact
                with union and intersection.
            </p>

            <p class="text-white mt-3">
                (A ∪ B)′ = A′ ∩ B′
            </p>

            <p class="text-white mt-1">
                (A ∩ B)′ = A′ ∪ B′
            </p>

            <p class="text-gray-400 mt-3">
                These laws are also important in logic and computer
                science because they allow expressions to be
                transformed into equivalent forms.
            </p>

        </div>

    </div>


    <h3 class="text-xl font-bold mt-8">
        Example of Simplifying a Set Expression
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Set properties can be used to simplify expressions step by
        step while preserving their meaning.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white text-lg">
            A ∪ (A ∩ B)
        </p>

        <div class="mt-4 space-y-2">

            <p class="text-gray-400">
                Using the Absorption Property:
            </p>

            <p class="text-white">
                A ∪ (A ∩ B) = A
            </p>

            <p class="text-gray-400 mt-3">
                Therefore, the simplified expression is:
            </p>

            <p class="text-white text-lg">
                A
            </p>

        </div>

    </div>


    <h3 class="text-xl font-bold mt-8">
        Summary of Set Properties
    </h3>

    <div class="overflow-x-auto mt-4">

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-[#24123B]">

                    <th class="border border-[#3A2560] p-3 text-left">
                        Property
                    </th>

                    <th class="border border-[#3A2560] p-3 text-left">
                        Union
                    </th>

                    <th class="border border-[#3A2560] p-3 text-left">
                        Intersection
                    </th>

                </tr>

            </thead>

            <tbody class="text-gray-400">

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Commutative
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ B = B ∪ A
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∩ B = B ∩ A
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Associative
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        (A ∪ B) ∪ C = A ∪ (B ∪ C)
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        (A ∩ B) ∩ C = A ∩ (B ∩ C)
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Identity
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ ∅ = A
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∩ U = A
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Idempotent
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ A = A
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∩ A = A
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Distributive
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ (B ∩ C) = (A ∪ B) ∩ (A ∪ C)
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∩ (B ∪ C) = (A ∩ B) ∪ (A ∩ C)
                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    <h3 class="text-xl font-bold mt-8">
        Applications of Set Properties in Information Technology
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Set properties are useful in information technology because
        computers frequently work with collections of data. Sets can
        represent users, files, permissions, database records,
        search results, or other groups of information.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: User Permissions
        </h4>

        <p class="text-gray-400 mt-2">
            Suppose A represents users who can access a system and B
            represents users who can edit files.
        </p>

        <p class="text-white mt-3">
            A ∩ B
        </p>

        <p class="text-gray-400 mt-1">
            represents users who can both access the system and edit
            files.
        </p>

        <p class="text-white mt-4">
            A ∪ B
        </p>

        <p class="text-gray-400 mt-1">
            represents users who belong to either group or both groups.
        </p>

    </div>


    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-5">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Set properties provide a collection of rules that allow
            sets and set expressions to be rearranged, simplified,
            compared, and analyzed without changing their meaning.
            Understanding these properties is important for solving
            problems involving sets and for understanding concepts
            used later in discrete mathematics, logic, databases,
            and computer science.
        </p>

    </div>

    

</div>
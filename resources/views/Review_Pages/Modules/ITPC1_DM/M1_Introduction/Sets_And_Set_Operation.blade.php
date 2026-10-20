<div class="mt-10" id="topic-sets-and-set-operations">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2. Sets and Set Operations
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        A set is a well-defined collection of distinct objects. The
        objects contained in a set are called elements or members.
        Sets are one of the fundamental concepts in Discrete Mathematics
        and are used to organize, classify, and describe collections of
        objects.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Sets are commonly used in Information Technology to represent
        collections of data, users, files, database records, programming
        objects, and other related information. Understanding sets also
        provides a foundation for studying functions, relations, databases,
        and other discrete structures.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Example of a Set
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white text-lg">
            A = {1, 2, 3, 4, 5}
        </p>

        <p class="text-gray-400 mt-3">
            The set A contains five elements: 1, 2, 3, 4, and 5.
            Each element appears only once because the elements of a
            set are distinct.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Ways to Describe a Set
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A set can be described in different ways. Two common methods are
        the roster method and the set-builder notation.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Roster Method
            </h4>

            <p class="text-gray-400 mt-2">
                The elements of a set are listed inside braces and
                separated by commas.
            </p>

            <p class="text-white mt-3">
                A = {2, 4, 6, 8, 10}
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Set-Builder Notation
            </h4>

            <p class="text-gray-400 mt-2">
                A set is described using a rule or condition that its
                elements satisfy.
            </p>

            <p class="text-white mt-3">
                A = {x | x is an even number from 2 to 10}
            </p>

        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Membership of an Element
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The symbol <span class="text-white">∈</span> means "is an element
        of" or "belongs to." The symbol <span class="text-white">∉</span>
        means "is not an element of."
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A = {1, 2, 3, 4, 5}
        </p>

        <p class="text-gray-400 mt-3">
            <span class="text-white">3 ∈ A</span>
            because 3 is an element of A.
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">7 ∉ A</span>
            because 7 is not an element of A.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Types of Sets
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Empty Set
            </h4>

            <p class="text-gray-400 mt-2">
                A set containing no elements.
            </p>

            <p class="text-white mt-2">
                ∅
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Singleton Set
            </h4>

            <p class="text-gray-400 mt-2">
                A set containing exactly one element.
            </p>

            <p class="text-white mt-2">
                A = {5}
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Finite Set
            </h4>

            <p class="text-gray-400 mt-2">
                A set containing a limited number of elements.
            </p>

            <p class="text-white mt-2">
                A = {1, 2, 3}
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Infinite Set
            </h4>

            <p class="text-gray-400 mt-2">
                A set containing an unlimited number of elements.
            </p>

            <p class="text-white mt-2">
                N = {1, 2, 3, 4, ...}
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Universal Set
            </h4>

            <p class="text-gray-400 mt-2">
                The set containing all elements being considered in
                a particular problem.
            </p>

            <p class="text-white mt-2">
                U = {1, 2, 3, 4, 5, 6}
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Equal Sets
            </h4>

            <p class="text-gray-400 mt-2">
                Two sets are equal when they contain exactly the same
                elements.
            </p>

            <p class="text-white mt-2">
                A = {1, 2, 3}
            </p>

            <p class="text-white mt-1">
                B = {3, 2, 1}
            </p>

        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Subsets
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A set A is a subset of a set B if every element of A is also
        an element of B. The symbol <span class="text-white">⊆</span>
        is used to represent a subset.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A = {1, 2}
        </p>

        <p class="text-white mt-2">
            B = {1, 2, 3, 4}
        </p>

        <p class="text-gray-400 mt-3">
            Since every element of A is also contained in B:
        </p>

        <p class="text-white mt-2">
            A ⊆ B
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Set Operations
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Set operations are used to combine, compare, and manipulate
        different sets. The main operations include union, intersection,
        difference, and complement.
    </p>

    <div class="overflow-x-auto mt-4">

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-[#24123B]">

                    <th class="border border-[#3A2560] p-3 text-left">
                        Operation
                    </th>

                    <th class="border border-[#3A2560] p-3 text-left">
                        Symbol
                    </th>

                    <th class="border border-[#3A2560] p-3 text-left">
                        Description
                    </th>

                </tr>

            </thead>

            <tbody class="text-gray-400">

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Union
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ B
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        Contains all elements that belong to A or B,
                        without repeating elements.
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Intersection
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∩ B
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        Contains elements common to both sets.
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Difference
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A − B
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        Contains elements in A that are not in B.
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Complement
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A′
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        Contains elements in the universal set that
                        are not included in A.
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Union of Sets
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The union of two sets A and B contains every element that belongs
        to A, B, or both. The symbol <span class="text-white">∪</span>
        represents union.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A = {1, 2, 3}
        </p>

        <p class="text-white mt-2">
            B = {3, 4, 5}
        </p>

        <p class="text-gray-400 mt-3">
            Therefore:
        </p>

        <p class="text-white mt-2">
            A ∪ B = {1, 2, 3, 4, 5}
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Intersection of Sets
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The intersection of two sets contains only the elements that
        are common to both sets. The symbol <span class="text-white">∩</span>
        represents intersection.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A = {1, 2, 3, 4}
        </p>

        <p class="text-white mt-2">
            B = {3, 4, 5, 6}
        </p>

        <p class="text-gray-400 mt-3">
            Therefore:
        </p>

        <p class="text-white mt-2">
            A ∩ B = {3, 4}
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Difference of Sets
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The difference A − B contains the elements that belong to A
        but do not belong to B. The order of the sets matters, so
        A − B and B − A may produce different results.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A = {1, 2, 3, 4}
        </p>

        <p class="text-white mt-2">
            B = {3, 4, 5, 6}
        </p>

        <p class="text-gray-400 mt-3">
            Therefore:
        </p>

        <p class="text-white mt-2">
            A − B = {1, 2}
        </p>

        <p class="text-white mt-2">
            B − A = {5, 6}
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Complement of a Set
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The complement of a set A contains all elements in the universal
        set that are not elements of A. It is represented by
        <span class="text-white">A′</span> or sometimes
        <span class="text-white">Aᶜ</span>.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            U = {1, 2, 3, 4, 5, 6}
        </p>

        <p class="text-white mt-2">
            A = {1, 2, 3}
        </p>

        <p class="text-gray-400 mt-3">
            Therefore:
        </p>

        <p class="text-white mt-2">
            A′ = {4, 5, 6}
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Set Difference and Complement Relationship
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The difference between sets can also be expressed using
        intersection and complement. For a universal set U,
        the difference A − B can be written as the intersection of
        A and the complement of B.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A − B = A ∩ B′
        </p>

        <p class="text-gray-400 mt-3">
            This means that the elements in A − B are the elements
            that belong to A and do not belong to B.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Properties of Sets
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Set operations follow several important properties. These
        properties help simplify expressions and solve problems
        involving multiple sets.
    </p>

    <div class="overflow-x-auto mt-4">

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-[#24123B]">

                    <th class="border border-[#3A2560] p-3 text-left">
                        Property
                    </th>

                    <th class="border border-[#3A2560] p-3 text-left">
                        Formula
                    </th>

                </tr>

            </thead>

            <tbody class="text-gray-400">

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Commutative Law
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ B = B ∪ A
                        <br>
                        A ∩ B = B ∩ A
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Associative Law
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        (A ∪ B) ∪ C = A ∪ (B ∪ C)
                        <br>
                        (A ∩ B) ∩ C = A ∩ (B ∩ C)
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Identity Law
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ ∅ = A
                        <br>
                        A ∩ U = A
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Complement Law
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ A′ = U
                        <br>
                        A ∩ A′ = ∅
                    </td>

                </tr>

                <tr>

                    <td class="border border-[#3A2560] p-3">
                        Idempotent Law
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        A ∪ A = A
                        <br>
                        A ∩ A = A
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Distributive Laws
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The distributive laws describe how union and intersection
        interact with each other. These laws are useful when simplifying
        set expressions and solving problems involving several sets.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Union over Intersection
            </h4>

            <p class="text-white mt-3">
                A ∪ (B ∩ C) = (A ∪ B) ∩ (A ∪ C)
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Intersection over Union
            </h4>

            <p class="text-white mt-3">
                A ∩ (B ∪ C) = (A ∩ B) ∪ (A ∩ C)
            </p>

        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: Multiple Set Operations
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A = {1, 2, 3, 4}
        </p>

        <p class="text-white mt-2">
            B = {3, 4, 5, 6}
        </p>

        <p class="text-white mt-2">
            C = {4, 5, 6, 7}
        </p>

        <div class="mt-4 space-y-2 text-gray-400">

            <p>
                <span class="text-white">A ∪ B</span> =
                {1, 2, 3, 4, 5, 6}
            </p>

            <p>
                <span class="text-white">A ∩ B</span> =
                {3, 4}
            </p>

            <p>
                <span class="text-white">B ∩ C</span> =
                {4, 5, 6}
            </p>

            <p>
                <span class="text-white">A − B</span> =
                {1, 2}
            </p>

            <p>
                <span class="text-white">B − A</span> =
                {5, 6}
            </p>

        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Real-World Application of Sets
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Sets can be used to organize and analyze groups of objects in
        real-world situations. In Information Technology, sets can
        represent groups of users, students, files, products, courses,
        or records in a database.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example
        </h4>

        <p class="text-gray-400 mt-3">
            Suppose a class has students who are enrolled in Programming
            and students who are enrolled in Mathematics.
        </p>

        <p class="text-white mt-3">
            P = {Ana, Ben, Carlo, Dana}
        </p>

        <p class="text-white mt-2">
            M = {Carlo, Dana, Eva, Frank}
        </p>

        <div class="mt-4 space-y-2 text-gray-400">

            <p>
                Students taking either subject:
                <span class="text-white">
                    P ∪ M = {Ana, Ben, Carlo, Dana, Eva, Frank}
                </span>
            </p>

            <p>
                Students taking both subjects:
                <span class="text-white">
                    P ∩ M = {Carlo, Dana}
                </span>
            </p>

            <p>
                Students taking Programming but not Mathematics:
                <span class="text-white">
                    P − M = {Ana, Ben}
                </span>
            </p>

        </div>

    </div>

</div>
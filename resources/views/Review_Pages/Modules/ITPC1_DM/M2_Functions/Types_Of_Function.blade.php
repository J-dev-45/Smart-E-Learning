<div class="mt-6 sm:mt-10" id="topic-types-of-function">

    {{-- TOPIC --}}
    <h2 class="text-xl sm:text-2xl font-bold">
        2. Types of Function
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-4 leading-relaxed break-words">
        Functions can be classified according to how their inputs
        correspond to their outputs. Three important types are injective,
        surjective, and bijective functions.
    </p>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Injective Function (One-to-One)
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        An injective function is a function in which different inputs
        always produce different outputs. No two distinct elements
        of the domain are mapped to the same element of the codomain.
    </p>

    <p class="text-white mt-4">
        If f(a) = f(b), then a = b.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">

        <h4 class="font-bold text-base sm:text-lg">
            Example of an Injective Function
        </h4>

        <p class="text-white mt-3">
            A = {1, 2, 3}
        </p>

        <p class="text-white mt-2">
            B = {a, b, c, d}
        </p>

        <div class="mt-4 space-y-2 text-gray-400 break-words">
            <p>
                f(1) = a
            </p>

            <p>
                f(2) = b
            </p>

            <p>
                f(3) = c
            </p>
        </div>

        <p class="text-gray-400 mt-4 break-words">
            Each input maps to a different output. The element d is
            unused, but the function is still injective.
        </p>

    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Surjective Function (Onto)
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        A surjective function is a function in which every element
        of the codomain is the output of at least one element from
        the domain. In other words, the range is equal to the codomain.
    </p>

    <p class="text-white mt-4">
        Range = Codomain
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">

        <h4 class="font-bold text-base sm:text-lg">
            Example of a Surjective Function
        </h4>

        <p class="text-white mt-3">
            A = {1, 2, 3, 4}
        </p>

        <p class="text-white mt-2">
            B = {a, b, c}
        </p>

        <div class="mt-4 space-y-2 text-gray-400 break-words">
            <p>
                f(1) = a
            </p>

            <p>
                f(2) = b
            </p>

            <p>
                f(3) = c
            </p>

            <p>
                f(4) = c
            </p>
        </div>

        <p class="text-gray-400 mt-4 break-words">
            Every element of B is reached by at least one input.
            Therefore, the function is surjective.
        </p>

    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Bijective Function (One-to-One and Onto)
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        A bijective function is both injective and surjective.
        Every input maps to a different output, and every element
        of the codomain is reached. Therefore, each element of the
        codomain corresponds to exactly one element of the domain.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">

        <h4 class="font-bold text-base sm:text-lg">
            Example of a Bijective Function
        </h4>

        <p class="text-white mt-3">
            A = {1, 2, 3}
        </p>

        <p class="text-white mt-2">
            B = {a, b, c}
        </p>

        <div class="mt-4 space-y-2 text-gray-400 break-words">
            <p>
                f(1) = a
            </p>

            <p>
                f(2) = b
            </p>

            <p>
                f(3) = c
            </p>
        </div>

        <p class="text-gray-400 mt-4 break-words">
            All outputs are different, and every element of B is
            reached. Therefore, the function is both injective
            and surjective, making it bijective.
        </p>

    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Comparison of Function Types
    </h3>

    <div class="overflow-x-auto mt-4">

        <table class="w-full border-collapse text-sm sm:text-base">

            <thead>
                <tr class="bg-[#24123B]">
                    <th class="border border-[#3A2560] p-2 sm:p-3 text-left">
                        Type
                    </th>

                    <th class="border border-[#3A2560] p-2 sm:p-3 text-left">
                        Main Property
                    </th>

                    <th class="border border-[#3A2560] p-2 sm:p-3 text-left">
                        Can Outputs Repeat?
                    </th>

                    <th class="border border-[#3A2560] p-2 sm:p-3 text-left">
                        Must Every Codomain Element Be Used?
                    </th>
                </tr>
            </thead>

            <tbody class="text-gray-400 break-words">

                <tr>
                    <td class="border border-[#3A2560] p-2 sm:p-3 text-white">
                        Injective
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        Different inputs have different outputs.
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        No
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        No
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-2 sm:p-3 text-white">
                        Surjective
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        Every codomain element is reached.
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        Yes
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        Yes
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-2 sm:p-3 text-white">
                        Bijective
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        Both injective and surjective.
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        No
                    </td>

                    <td class="border border-[#3A2560] p-2 sm:p-3">
                        Yes
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Functions in Information Technology
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        Different types of functions help describe how data is mapped
        between sets. Injective functions can represent unique identifiers,
        surjective functions can represent mappings that cover all
        designated output categories, and bijective functions can represent
        exact one-to-one correspondences between two sets.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">

        <h4 class="font-bold text-base sm:text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed break-words">
            Remember the main difference: injective means no repeated
            outputs for different inputs, surjective means every
            codomain element is reached, and bijective means both
            conditions are satisfied.
        </p>

    </div>

</div>

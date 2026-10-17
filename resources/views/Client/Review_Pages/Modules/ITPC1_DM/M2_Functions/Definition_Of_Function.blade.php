<div class="mt-10" id="topic-definition-of-function">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1. Definition of Function
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        A function is a relation between two sets that assigns exactly
        one output to every input in the first set. A function is commonly
        represented using the notation f(x), where x represents an input
        and f(x) represents its corresponding output.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Functions are important in Discrete Mathematics because they
        describe relationships between elements of sets. In Information
        Technology, functions are used in programming, data processing,
        algorithms, and mathematical modeling.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Domain, Codomain, and Range
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Every function has a domain, a codomain, and a range. These
        concepts describe the inputs and outputs of a function.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Domain
            </h4>

            <p class="text-gray-400 mt-2">
                The set of all allowed input values of a function.
            </p>

            <p class="text-white mt-3">
                A = {1, 2, 3}
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Codomain
            </h4>

            <p class="text-gray-400 mt-2">
                The designated set containing the possible output values.
            </p>

            <p class="text-white mt-3">
                B = {2, 4, 6, 8}
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Range
            </h4>

            <p class="text-gray-400 mt-2">
                The set of output values actually produced by the function.
            </p>

            <p class="text-white mt-3">
                {2, 4, 6}
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Function Notation
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Function notation describes the relationship between an input
        and its output. For example, f(x) = 2x means that the function
        multiplies every input by 2.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example
        </h4>

        <p class="text-white text-lg mt-3">
            f(x) = 2x
        </p>

        <p class="text-gray-400 mt-3">
            If the input is x = 1:
        </p>

        <p class="text-white mt-2">
            f(1) = 2(1) = 2
        </p>

        <p class="text-gray-400 mt-3">
            If the input is x = 3:
        </p>

        <p class="text-white mt-2">
            f(3) = 2(3) = 6
        </p>

        <p class="text-gray-400 mt-3">
            Each input produces exactly one output.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example of a Function
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <p class="text-white">
            A = {1, 2, 3}
        </p>

        <p class="text-white mt-2">
            B = {a, b, c}
        </p>

        <div class="mt-4 space-y-3 text-gray-400">
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

        <p class="text-gray-400 mt-4">
            This is a function because every element in A has exactly
            one assigned output in B.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        What Makes a Relation a Function?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A relation is a function only if every input in the domain is
        assigned exactly one output. Different inputs may share the same
        output, but one input cannot be assigned two different outputs.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Valid Function
            </h4>

            <p class="text-white mt-3">
                1 → a
            </p>

            <p class="text-white mt-2">
                2 → b
            </p>

            <p class="text-white mt-2">
                3 → b
            </p>

            <p class="text-gray-400 mt-3">
                Every input has exactly one output. Two inputs may
                share the same output.
            </p>

        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">

            <h4 class="font-bold text-lg">
                Not a Function
            </h4>

            <p class="text-white mt-3">
                1 → a
            </p>

            <p class="text-white mt-2">
                1 → b
            </p>

            <p class="text-gray-400 mt-3">
                Input 1 has two different outputs, so this relation
                is not a function.
            </p>

        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Functions in Information Technology
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Functions are widely used in programming and computing.
        A program function receives input values, performs an operation,
        and may return an output. Mathematical functions also help
        describe data transformations and relationships in algorithms.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            A function assigns exactly one output to each input.
            Understanding the domain, codomain, and range provides
            the foundation for studying injective, surjective, and
            bijective functions.
        </p>

    </div>

</div>

<div class="mt-10" id="topic-recursive-definition-of-function">

    <h2 class="text-2xl font-bold">
        3. Recursive Definition of Function
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        A recursive definition of a function specifies the value of the
        function for one or more initial inputs and then defines later values
        in terms of previously determined values. This method is especially
        useful for functions whose values follow a repeated pattern.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A recursive function definition needs a base case and a recursive
        rule. The base case gives a known value, and the recursive rule uses
        that value or earlier function values to determine new ones.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Example: A Simple Recursive Function
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Consider a function f defined for nonnegative integers. Let its
        initial value be 4, and let each next value be 2 more than the
        previous value.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">
            Definition
        </h4>

        <p class="text-white mt-3">
            f(0) = 4
        </p>

        <p class="text-white mt-2">
            f(n) = f(n − 1) + 2, for n ≥ 1
        </p>

        <div class="mt-4 border-t border-[#3A2560] pt-3 space-y-2 text-gray-400">
            <p><span class="text-white">f(0)</span> = 4</p>
            <p><span class="text-white">f(1)</span> = f(0) + 2 = 6</p>
            <p><span class="text-white">f(2)</span> = f(1) + 2 = 8</p>
            <p><span class="text-white">f(3)</span> = f(2) + 2 = 10</p>
        </div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Factorial Function
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The factorial of a nonnegative integer n, written n!, is the product
        of all positive integers from 1 through n. It can be defined
        recursively because n! can be expressed using the factorial of n − 1.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">
            Recursive Definition
        </h4>

        <p class="text-white mt-3">
            0! = 1
        </p>

        <p class="text-white mt-2">
            n! = n × (n − 1)!, for n ≥ 1
        </p>

        <div class="mt-4 border-t border-[#3A2560] pt-3 space-y-2 text-gray-400">
            <p><span class="text-white">1!</span> = 1 × 0! = 1</p>
            <p><span class="text-white">2!</span> = 2 × 1! = 2</p>
            <p><span class="text-white">3!</span> = 3 × 2! = 6</p>
            <p><span class="text-white">4!</span> = 4 × 3! = 24</p>
        </div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Fibonacci Sequence
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The Fibonacci sequence is defined by two starting values. Every
        subsequent term is the sum of the two terms immediately before it.
        This is an example of a recursive definition that uses more than one
        previous value.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">
        <p class="text-white">
            F₀ = 0, F₁ = 1
        </p>
        <p class="text-white mt-2">
            Fₙ = Fₙ₋₁ + Fₙ₋₂, for n ≥ 2
        </p>

        <div class="mt-4 border-t border-[#3A2560] pt-3 space-y-2 text-gray-400">
            <p>F₂ = 1 + 0 = 1</p>
            <p>F₃ = 1 + 1 = 2</p>
            <p>F₄ = 2 + 1 = 3</p>
            <p>F₅ = 3 + 2 = 5</p>
            <p class="text-white">Sequence: 0, 1, 1, 2, 3, 5, 8, ...</p>
        </div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Recursive Function and Iterative Function
    </h3>

    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#24123B]">
                    <th class="border border-[#3A2560] p-3 text-left">Recursive approach</th>
                    <th class="border border-[#3A2560] p-3 text-left">Iterative approach</th>
                </tr>
            </thead>
            <tbody class="text-gray-400">
                <tr>
                    <td class="border border-[#3A2560] p-3">Defines a result using one or more smaller instances of the same function.</td>
                    <td class="border border-[#3A2560] p-3">Repeats instructions using loops or iteration.</td>
                </tr>
                <tr>
                    <td class="border border-[#3A2560] p-3">Requires a base case to stop recursive calls.</td>
                    <td class="border border-[#3A2560] p-3">Usually stops when a loop condition becomes false.</td>
                </tr>
                <tr>
                    <td class="border border-[#3A2560] p-3">Can closely match mathematical recursive definitions.</td>
                    <td class="border border-[#3A2560] p-3">Can avoid the overhead of repeated function calls.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Errors in Recursive Functions
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Missing Base Case
            </h4>
            <p class="text-gray-400 mt-2">
                Without a base case, recursive calls may continue until the
                program runs out of resources.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Incorrect Progress
            </h4>
            <p class="text-gray-400 mt-2">
                Each recursive call should move toward a base case. If the
                input does not get closer to the stopping condition, the
                function may not terminate.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Applications in Information Technology
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Recursive functions are used in tree traversal, searching nested
        structures, divide-and-conquer algorithms, and processing hierarchical
        data. They provide a natural way to express a solution when the
        problem can be reduced to smaller instances of itself.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">
            Example: Processing Nested Folders
        </h4>
        <p class="text-gray-400 mt-3">
            A function that searches for a file can inspect the current folder
            and then call itself for each subfolder. It stops searching a
            branch when there are no more subfolders to inspect or when the
            target file has been found.
        </p>
    </div>

</div>

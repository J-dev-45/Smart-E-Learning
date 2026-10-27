<div class="mt-6 sm:mt-10" id="topic-recursive-definition">

    <h2 class="text-xl sm:text-2xl font-bold">
        1. Recursive Definition
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-4 leading-relaxed break-words">
        A recursive definition describes a mathematical object by defining
        one or more initial cases and then explaining how to construct new
        cases from objects that have already been defined. Instead of listing
        every element individually, recursion provides a rule that can be
        applied repeatedly.
    </p>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        A complete recursive definition normally contains a base case and a
        recursive rule. The base case identifies the starting object, while
        the recursive rule explains how to obtain additional objects.
    </p>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Parts of a Recursive Definition
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5">
            <h4 class="font-bold text-base sm:text-lg">
                Base Case
            </h4>
            <p class="text-gray-400 mt-2 break-words">
                The initial value or object that is included without needing
                to apply the recursive rule.
            </p>
            <p class="text-white mt-3">
                Example:  a₁ = 2
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5">
            <h4 class="font-bold text-base sm:text-lg">
                Recursive Rule
            </h4>
            <p class="text-gray-400 mt-2 break-words">
                A rule that defines new values or objects in terms of
                previously defined ones.
            </p>
            <p class="text-white mt-3">
                Example:  aₙ = aₙ₋₁ + 3
            </p>
        </div>

    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Example: Defining a Sequence Recursively
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        Consider a sequence that starts at 2 and increases by 3 each time.
        The sequence can be defined recursively by giving its first term and
        a rule for obtaining every term after the first.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold text-base sm:text-lg">
            Recursive Definition
        </h4>

        <p class="text-white mt-3">
            a₁ = 2
        </p>

        <p class="text-white mt-2">
            aₙ = aₙ₋₁ + 3, for n ≥ 2
        </p>

        <div class="mt-4 border-t border-[#3A2560] pt-3 space-y-2 text-gray-400 break-words">
            <p><span class="text-white">First term:</span> a₁ = 2</p>
            <p><span class="text-white">Second term:</span> a₂ = 2 + 3 = 5</p>
            <p><span class="text-white">Third term:</span> a₃ = 5 + 3 = 8</p>
            <p><span class="text-white">Fourth term:</span> a₄ = 8 + 3 = 11</p>
            <p><span class="text-white">Sequence:</span> 2, 5, 8, 11, 14, ...</p>
        </div>
    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Recursive Definition of the Natural Numbers
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        The natural numbers can be described using a starting value and a
        successor rule. Starting with 0, each next natural number is obtained
        by adding 1 to the previous number.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <p class="text-white">
            Base case: 0 is a natural number.
        </p>
        <p class="text-white mt-2">
            Recursive rule: If n is a natural number, then n + 1 is a natural number.
        </p>
        <p class="text-gray-400 mt-3 break-words">
            Repeatedly applying the rule gives 0, 1, 2, 3, 4, 5, and so on.
        </p>
    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Recursive Definitions in Computer Science
    </h3>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">
        Recursive thinking appears in algorithms that solve a problem by
        solving smaller versions of the same problem. Examples include
        traversing tree structures, processing nested folders, and calculating
        values defined by recurrence relations.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <h4 class="font-bold text-base sm:text-lg">
            Example: Folder Structure
        </h4>
        <p class="text-gray-400 mt-3 break-words">
            A folder can contain files and other folders. To list every file
            inside a folder, a program can list the files in the current
            folder and then repeat the same process for each subfolder.
        </p>
        <p class="text-gray-400 mt-3 break-words">
            The stopping condition is reached when a folder has no additional
            subfolders to explore. This is the practical role of a base case.
        </p>
    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">
        Important Characteristics
    </h3>

    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse text-sm sm:text-base">
            <thead>
                <tr class="bg-[#24123B]">
                    <th class="border border-[#3A2560] p-2 sm:p-3 text-left">Part</th>
                    <th class="border border-[#3A2560] p-2 sm:p-3 text-left">Purpose</th>
                </tr>
            </thead>
            <tbody class="text-gray-400 break-words">
                <tr>
                    <td class="border border-[#3A2560] p-2 sm:p-3 text-white">Base case</td>
                    <td class="border border-[#3A2560] p-2 sm:p-3">Provides the initial object or value.</td>
                </tr>
                <tr>
                    <td class="border border-[#3A2560] p-2 sm:p-3 text-white">Recursive rule</td>
                    <td class="border border-[#3A2560] p-2 sm:p-3">Explains how new objects are formed from earlier ones.</td>
                </tr>
                <tr>
                    <td class="border border-[#3A2560] p-2 sm:p-3 text-white">Stopping condition</td>
                    <td class="border border-[#3A2560] p-2 sm:p-3">Prevents a recursive process from continuing indefinitely.</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

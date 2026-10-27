<div class="mt-6 sm:mt-10" id="topic-basic-concepts-of-probability">

    <h2 class="text-xl sm:text-2xl font-bold">
        1. Basic Concepts of Probability
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-0 sm:px-3 mt-4 leading-relaxed break-words">
        Probability is a measure of how likely an event is to occur. Its value ranges from 0 to 1, where 0 represents an impossible event and 1 represents a certain event. Probability helps analyze uncertainty in situations such as games, surveys, software testing, and data analysis.
    </p>

    <h3 class="text-lg sm:text-xl font-bold mt-6">Important Terms</h3>
    <div class="overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse text-sm sm:text-base">
            <thead><tr class="border-b border-[#3A2560] text-white"><th class="p-2 sm:p-3">Term</th><th class="p-2 sm:p-3">Meaning</th><th class="p-2 sm:p-3">Example</th></tr></thead>
            <tbody>
                <tr class="border-b border-[#3A2560]"><td class="p-2 sm:p-3 text-white">Experiment</td><td class="p-2 sm:p-3">A process that produces an outcome.</td><td class="p-2 sm:p-3">Rolling a die.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-2 sm:p-3 text-white">Sample space</td><td class="p-2 sm:p-3">The set of all possible outcomes.</td><td class="p-2 sm:p-3">S = {1, 2, 3, 4, 5, 6}.</td></tr>
                <tr class="border-b border-[#3A2560]"><td class="p-2 sm:p-3 text-white">Event</td><td class="p-2 sm:p-3">A subset of the sample space.</td><td class="p-2 sm:p-3">Rolling an even number: {2, 4, 6}.</td></tr>
                <tr><td class="p-2 sm:p-3 text-white">Outcome</td><td class="p-2 sm:p-3">One possible result of an experiment.</td><td class="p-2 sm:p-3">Rolling a 4.</td></tr>
            </tbody>
        </table>
    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">Classical Probability</h3>
    <p class="text-md text-gray-400 px-0 sm:px-3 mt-3 leading-relaxed break-words">When all outcomes are equally likely, the probability of an event E is the number of favorable outcomes divided by the total number of outcomes in the sample space.</p>
    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-3 sm:p-5 mt-4">
        <p class="text-white font-semibold">Formula</p>
        <p class="text-white mt-3">P(E) = number of outcomes in E / number of outcomes in S</p>
        <p class="text-gray-400 mt-3 break-words">Example: A fair six-sided die is rolled. The probability of rolling an even number is 3/6 = 1/2, because the favorable outcomes are 2, 4, and 6.</p>
    </div>

    <h3 class="text-lg sm:text-xl font-bold mt-6">Basic Probability Properties</h3>
    <ul class="list-disc pl-4 sm:pl-6 space-y-2 mt-3 text-gray-400 break-words">
        <li>For every event E, 0 ≤ P(E) ≤ 1.</li>
        <li>The probability of the sample space is P(S) = 1.</li>
        <li>The probability of an impossible event is 0.</li>
        <li>The probability of the complement of E is P(Eᶜ) = 1 − P(E).</li>
    </ul>
</div>

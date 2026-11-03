<div class="mt-10" id="topic-basic-concepts-of-probability">

    <h2 class="text-2xl font-bold">
        1. Basic Concepts of Probability
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="sharedLine w-full h-[1px]"></div>
    </div>

    <p class="text-md sharedTXTMuted px-3 mt-4 leading-relaxed">
        Probability is a measure of how likely an event is to occur. Its value ranges from 0 to 1, where 0 represents an impossible event and 1 represents a certain event. Probability helps analyze uncertainty in situations such as games, surveys, software testing, and data analysis.
    </p>

    <h3 class="text-xl font-bold mt-6">Important Terms</h3>
    <div class="overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead><tr class="border-b sharedBorder sharedTXT"><th class="p-3">Term</th><th class="p-3">Meaning</th><th class="p-3">Example</th></tr></thead>
            <tbody>
                <tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Experiment</td><td class="p-3">A process that produces an outcome.</td><td class="p-3">Rolling a die.</td></tr>
                <tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Sample space</td><td class="p-3">The set of all possible outcomes.</td><td class="p-3">S = {1, 2, 3, 4, 5, 6}.</td></tr>
                <tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Event</td><td class="p-3">A subset of the sample space.</td><td class="p-3">Rolling an even number: {2, 4, 6}.</td></tr>
                <tr><td class="p-3 sharedTXT">Outcome</td><td class="p-3">One possible result of an experiment.</td><td class="p-3">Rolling a 4.</td></tr>
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-bold mt-6">Classical Probability</h3>
    <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">When all outcomes are equally likely, the probability of an event E is the number of favorable outcomes divided by the total number of outcomes in the sample space.</p>
    <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-4">
        <p class="sharedTXT font-semibold">Formula</p>
        <p class="sharedTXT mt-3">P(E) = number of outcomes in E / number of outcomes in S</p>
        <p class="sharedTXTMuted mt-3">Example: A fair six-sided die is rolled. The probability of rolling an even number is 3/6 = 1/2, because the favorable outcomes are 2, 4, and 6.</p>
    </div>

    <h3 class="text-xl font-bold mt-6">Basic Probability Properties</h3>
    <ul class="list-disc pl-6 space-y-2 mt-3 sharedTXTMuted">
        <li>For every event E, 0 ≤ P(E) ≤ 1.</li>
        <li>The probability of the sample space is P(S) = 1.</li>
        <li>The probability of an impossible event is 0.</li>
        <li>The probability of the complement of E is P(Eᶜ) = 1 − P(E).</li>
    </ul>
</div>

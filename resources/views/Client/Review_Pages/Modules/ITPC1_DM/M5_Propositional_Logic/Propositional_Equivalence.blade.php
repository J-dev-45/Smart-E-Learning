<div class="mt-10" id="topic-propositional-equivalence">

    <h2 class="text-2xl font-bold">
        7. Propositional Equivalence
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="sharedLine w-full h-[1px]"></div>
    </div>

    <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">Two propositions are <strong class="sharedTXT">logically equivalent</strong> when they have the same truth value for every possible assignment of truth values. Logical equivalence is written as \(p \equiv q\), or shown by proving that \(p \leftrightarrow q\) is a tautology.</p>
<h3 class="text-xl font-bold mt-6">Common Logical Equivalences</h3><div class="overflow-x-auto mt-4"><table class="w-full border-collapse"><thead><tr class="border-b sharedBorder sharedTXT"><th class="p-3">Law</th><th class="p-3">Equivalence</th></tr></thead><tbody><tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Double negation</td><td class="p-3">\(¬(¬ p) \equiv p\)</td></tr><tr class="border-b sharedBorder"><td class="p-3 sharedTXT">De Morgan's law</td><td class="p-3">\(¬(p \land q) \equiv ¬ p \lor ¬ q\)</td></tr><tr class="border-b sharedBorder"><td class="p-3 sharedTXT">De Morgan's law</td><td class="p-3">\(¬(p \lor q) \equiv ¬ p \land ¬ q\)</td></tr><tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Implication</td><td class="p-3">\(p → q \equiv ¬ p \lor q\)</td></tr><tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Commutative</td><td class="p-3">\(p \land q \equiv q \land p\)</td></tr><tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Commutative</td><td class="p-3">\(p \lor q \equiv q \lor p\)</td></tr><tr class="border-b sharedBorder"><td class="p-3 sharedTXT">Distributive</td><td class="p-3">\(p \land (q \lor r) \equiv (p \land q) \lor (p \land r)\)</td></tr><tr><td class="p-3 sharedTXT">Biconditional</td><td class="p-3">\(p \leftrightarrow q \equiv (p → q) \land (q → p)\)</td></tr></tbody></table></div>
<h3 class="text-xl font-bold mt-6">How to Check Equivalence</h3><ol class="list-decimal pl-6 space-y-2"><li>Construct truth tables for both propositions.</li><li>Compare their final columns row by row.</li><li>If the columns match in every row, the propositions are logically equivalent.</li></ol><div class="sharedSurfaceDeepBG border sharedBorder rounded-lg p-5"><p class="sharedTXT font-semibold mb-2">Example</p><p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">For every truth-value assignment, \(p → q\) has the same truth value as \(¬ p \lor q\).</p><p class="mt-2">Therefore, \(p → q \equiv ¬ p \lor q\).</p></div>
</div>

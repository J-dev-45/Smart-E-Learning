<div class="mt-10" id="topic-truth-tables">

    <h2 class="text-2xl font-bold">
        4. Truth Tables
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">A <strong class="text-white">truth table</strong> lists every possible combination of truth values for component propositions and shows the resulting value of a compound proposition. For \(n\) distinct propositions, there are \(2^n\) possible combinations.</p>
<h3 class="text-xl font-bold mt-6">Negation</h3><div class="overflow-x-auto mt-4"><table class="w-full text-center border-collapse"><thead><tr class="border-b border-[#3A2560] text-white"><th class="p-3">\(p\)</th><th class="p-3">\(¬ p\)</th></tr></thead><tbody><tr class="border-b border-[#3A2560]"><td class="p-3">T</td><td class="p-3">F</td></tr><tr><td class="p-3">F</td><td class="p-3">T</td></tr></tbody></table></div>
<h3 class="text-xl font-bold mt-6">Binary Connectives</h3><div class="overflow-x-auto mt-4"><table class="w-full text-center border-collapse"><thead><tr class="border-b border-[#3A2560] text-white"><th class="p-3">\(p\)</th><th class="p-3">\(q\)</th><th class="p-3">\(p \land q\)</th><th class="p-3">\(p \lor q\)</th><th class="p-3">\(p → q\)</th><th class="p-3">\(p \leftrightarrow q\)</th></tr></thead><tbody><tr class="border-b border-[#3A2560]"><td class="p-3">T</td><td class="p-3">T</td><td class="p-3">T</td><td class="p-3">T</td><td class="p-3">T</td><td class="p-3">T</td></tr><tr class="border-b border-[#3A2560]"><td class="p-3">T</td><td class="p-3">F</td><td class="p-3">F</td><td class="p-3">T</td><td class="p-3">F</td><td class="p-3">F</td></tr><tr class="border-b border-[#3A2560]"><td class="p-3">F</td><td class="p-3">T</td><td class="p-3">F</td><td class="p-3">T</td><td class="p-3">T</td><td class="p-3">F</td></tr><tr><td class="p-3">F</td><td class="p-3">F</td><td class="p-3">F</td><td class="p-3">F</td><td class="p-3">T</td><td class="p-3">T</td></tr></tbody></table></div>
<div class="bg-[#1B0D2D] border border-[#3A2560] rounded-lg p-5"><h3 class="text-xl font-bold mt-6 mb-2">How to Build a Truth Table</h3><ol class="list-decimal pl-6 space-y-2"><li>Identify the distinct propositions in the expression.</li><li>List all \(2^n\) combinations of T and F.</li><li>Evaluate negations and expressions inside parentheses first.</li><li>Apply the remaining connectives to find the final column.</li></ol></div>
</div>

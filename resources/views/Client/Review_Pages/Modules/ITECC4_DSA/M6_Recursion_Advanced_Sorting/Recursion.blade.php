<div class="mt-0" id="topic-recursion">
    <h2 class="text-2xl font-bold sharedTXT">Recursion</h2>
    <div class="h-px sharedLine my-4"></div>
    <section>
        <h3 class="text-lg font-bold sharedTXT">Learning Objectives</h3>
        <ul class="list-disc pl-6 mt-2 space-y-2 sharedTXTBody"><li>Identify a base case and recursive case.</li><li>Trace a recursive method's calls and returns.</li><li>Explain the risk of unbounded recursion.</li></ul>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Introduction</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Recursion occurs when a method solves a problem by calling itself on a smaller subproblem. Every correct recursive solution needs a base case that stops further calls and a recursive step that moves toward that base case.</p>
    </section>
    <section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Trace factorial</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>factorial(3) calls 3 × factorial(2), which calls 2 × factorial(1). factorial(1) returns 1. The pending calls then return 2 × 1 = 2 and 3 × 2 = 6.</div></section><section class='mt-5'><h3 class='text-lg font-bold sharedTXT'>Call stack</h3><div class='sharedTXTBody mt-2 leading-relaxed space-y-2'>Each active call stores its parameters and where to resume. Deep recursion consumes stack space and may cause StackOverflowError if it does not terminate or becomes too deep.</div></section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Java Example</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">The following is a focused example of the central operation. Add any imports shown and place statements inside a method or class when running a complete Java program.</p>
        <pre class="mt-3 overflow-x-auto rounded-xl border sharedBorder sharedCodeBG p-4 text-sm sharedTXTCode"><code>static int factorial(int n) {\n    if (n &lt;= 1) return 1;\n    return n * factorial(n - 1);\n}\nSystem.out.println(factorial(4));</code></pre>
        <h4 class="font-bold sharedTXT mt-4">Expected Result / Trace</h4>
        <pre class="mt-2 overflow-x-auto rounded-lg sharedSurfaceDeepBG p-3 text-sm sharedTXTBody"><code>24</code></pre>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Complexity</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">This factorial method uses O(n) time and O(n) call-stack space for n recursive calls. This implementation assumes n is nonnegative and small enough for int.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Practical Applications</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Tree traversal, divide-and-conquer algorithms, recursive definitions, and backtracking.</p>
    </section>
    <section class="mt-5">
        <h3 class="text-lg font-bold sharedTXT">Common Mistakes</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">A missing or unreachable base case can cause infinite recursion. Ensure each recursive call moves closer to the base case.</p>
    </section>
    <section class="mt-5 rounded-xl border sharedBorder sharedSurfaceDeepBG p-4">
        <h3 class="text-lg font-bold sharedTXT">Lesson Summary</h3>
        <p class="sharedTXTBody mt-2 leading-relaxed">Recursion occurs when a method solves a problem by calling itself on a smaller subproblem. Every correct recursive solution needs a base case that stops further calls and a recursive step that moves toward that base case.</p>
        <p class="sharedTXTBody mt-2 leading-relaxed">Review the worked example, explain why each step is correct, and practice tracing the algorithm with a different input before attempting the module activity.</p>
    </section>
</div>
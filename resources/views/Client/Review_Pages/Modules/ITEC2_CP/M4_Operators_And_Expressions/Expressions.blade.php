{{-- TOPIC 4.2: EXPRESSIONS --}}
<div class="mt-10" id="topic-expressions">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.2 Expressions
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An expression is a combination of values, variables, operators, and method calls that produces a single value. Every time the computer evaluates an expression, it works out the result. Expressions are the building blocks of statements, so understanding how they are evaluated helps you avoid wrong answers.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Kinds of Expressions
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arithmetic Expression
            </h4>

            <p class="text-gray-400 mt-2">
                Gives a number. Example: (a + b) * 2
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Relational Expression
            </h4>

            <p class="text-gray-400 mt-2">
                Gives true or false. Example: score &gt;= 75
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Logical Expression
            </h4>

            <p class="text-gray-400 mt-2">
                Combines conditions. Example: age &gt;= 18 &amp;&amp; hasId
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                String Expression
            </h4>

            <p class="text-gray-400 mt-2">
                Joins text. Example: "Hello, " + name
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Operator Precedence
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When an expression has more than one operator, Java follows an order of precedence, just like the rules of arithmetic. Operators with higher precedence are evaluated first. Operators with equal precedence are evaluated from left to right, which is called associativity. You can use parentheses to change the order or to make the meaning clear.
    </p>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1. Parentheses
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                ( ) are evaluated first.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                2. Unary Operators
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Increment and decrement (++, --), logical NOT (!), and negative sign.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                3. Multiplicative
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                *, /, % from left to right.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                4. Additive
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                + and - from left to right.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                5. Relational
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                &lt;, &gt;, &lt;=, &gt;= then ==, !=.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                6. Logical
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                &amp;&amp; is evaluated before ||.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                7. Assignment
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                =, +=, -=, and so on, from right to left, are evaluated last.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Evaluating 2 + 3 * 4
        </h4>

        <p class="text-white mt-3">
            Multiplication first: 3 * 4 = 12
        </p>

        <p class="text-gray-400 mt-2">
            Then addition: 2 + 12 = 14
        </p>

        <p class="text-gray-400 mt-2">
            With parentheses, (2 + 3) * 4 = 20
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int a = 2 + 3 * 4;          // 14
int b = (2 + 3) * 4;        // 20
int c = 10 - 4 - 2;         // 4 (left to right)
int d = 20 / 4 * 2;         // 10 (left to right)
boolean e = 5 &gt; 3 &amp;&amp; 2 &gt; 4 || true;   // true</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Mixed-Type Expressions and Type Promotion
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When an expression has operands of different types, Java promotes the smaller type to the larger one before calculating. An int combined with a double becomes a double. The result type of a / b is int only if both a and b are int.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int a = 7, b = 2;
System.out.println(a / b);          // 3
System.out.println((double) a / b); // 3.5
System.out.println(a / 2.0);        // 3.5</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>3
3.5
3.5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        String Concatenation
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The + operator joins strings. If one operand is a String, the other operand is converted to text and joined. Because expressions are evaluated from left to right, the order matters.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.println("Total: " + 5 + 3);     // Total: 53
System.out.println("Total: " + (5 + 3));   // Total: 8
System.out.println(5 + 3 + " items");      // 8 items</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Total: 53
Total: 8
8 items</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Useful Math Expressions
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>Math.sqrt(16)        // 4.0
Math.pow(2, 3)       // 8.0
Math.abs(-7)         // 7
Math.max(4, 9)       // 9
Math.min(4, 9)       // 4
Math.round(3.6)      // 4</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Writing Math Formulas in Java
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java does not use implied multiplication or a fraction bar. You must write every operator and use parentheses to group parts of the formula.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Average of three scores
        </h4>

        <p class="text-white mt-3">
            Math: average = (a + b + c) / 3
        </p>

        <p class="text-gray-400 mt-2">
            Java: double average = (a + b + c) / 3.0;
        </p>

        <p class="text-gray-400 mt-2">
            Without the parentheses, only c would be divided by 3, which gives a wrong result.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Tips to Avoid Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Use parentheses whenever you are not sure of the order of evaluation.
        </li>

        <li>
            Watch out for integer division when you want a decimal result.
        </li>

        <li>
            Do not compare decimal values with == because of small rounding differences.
        </li>

        <li>
            Trace the expression step by step with sample numbers.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the value of 8 + 4 / 2 * 3?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 14. Division and multiplication go first from left to right: 4 / 2 = 2, then 2 * 3 = 6, then 8 + 6 = 14.
        </p>

        <p class="text-white mt-4">
            What does "Total: " + 5 + 3 produce?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Total: 53, because the numbers are joined as text from left to right.
        </p>

        <p class="text-white mt-4">
            Why is 7 / 2 equal to 3 in Java?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because both are integers, so the decimal part is discarded.
        </p>

    </div>

</div>

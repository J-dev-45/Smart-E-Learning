{{-- TOPIC 4.1: DECLARING VARIABLES, BASIC SYNTAX, AND OPERATORS --}}
<div class="mt-10" id="topic-declaring-variables-basic-syntax-and-operators">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.1 Declaring Variables, Basic Syntax, and Operators
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Operators are special symbols that tell the computer to perform an operation on values, which are called operands. For example, in 5 + 3, the plus sign is the operator and 5 and 3 are the operands. Java has several groups of operators, and you will use them in almost every program you write.
    </p>

    <h3 class="text-xl font-bold mt-6">
        A Quick Review of Declaration Syntax
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Every variable is declared with a type and a name, may be initialized with a value, and every statement ends with a semicolon. Operators are then used to compute with these variables.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int a = 10;
int b = 3;
int result = a + b;   // an expression with the + operator</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Arithmetic Operators
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                + Addition
            </h4>

            <p class="text-gray-400 mt-2">
                a + b gives 13
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                - Subtraction
            </h4>

            <p class="text-gray-400 mt-2">
                a - b gives 7
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                * Multiplication
            </h4>

            <p class="text-gray-400 mt-2">
                a * b gives 30
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                / Division
            </h4>

            <p class="text-gray-400 mt-2">
                a / b gives 3 (integer division drops the decimal part)
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                % Modulus
            </h4>

            <p class="text-gray-400 mt-2">
                a % b gives 1 (the remainder)
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int a = 10, b = 3;
System.out.println(a + b);
System.out.println(a - b);
System.out.println(a * b);
System.out.println(a / b);
System.out.println(a % b);
System.out.println(10.0 / 3);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>13
7
30
3
1
3.3333333333333335</code></pre>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Integer Division
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            When both operands are integers, the result of / is also an integer and the decimal part is discarded. So 10 / 3 is 3, not 3.33. To get a decimal result, make at least one operand a double, such as 10.0 / 3.
        </p>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The modulus operator is very useful. For example, n % 2 == 0 checks whether n is even, and n % 10 gives the last digit of a number.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Assignment Operators
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The basic assignment operator = stores the value on the right in the variable on the left. Compound assignment operators combine an operation with assignment as a shortcut.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                x += 5
            </h4>

            <p class="text-gray-400 mt-2">
                Same as x = x + 5
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                x -= 5
            </h4>

            <p class="text-gray-400 mt-2">
                Same as x = x - 5
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                x *= 2
            </h4>

            <p class="text-gray-400 mt-2">
                Same as x = x * 2
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                x /= 2
            </h4>

            <p class="text-gray-400 mt-2">
                Same as x = x / 2
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                x %= 3
            </h4>

            <p class="text-gray-400 mt-2">
                Same as x = x % 3
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Increment and Decrement Operators
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The ++ operator adds 1 and the -- operator subtracts 1. When written before the variable (prefix), the change happens first. When written after (postfix), the current value is used first and the change happens afterward.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int x = 5;
System.out.println(x++);   // prints 5, then x becomes 6
System.out.println(x);     // prints 6
System.out.println(++x);   // x becomes 7, then prints 7</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>5
6
7</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Relational (Comparison) Operators
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        These operators compare two values and always give a boolean result, true or false.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                ==
            </h4>

            <p class="text-gray-400 mt-2">
                Equal to
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                !=
            </h4>

            <p class="text-gray-400 mt-2">
                Not equal to
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &gt;
            </h4>

            <p class="text-gray-400 mt-2">
                Greater than
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;
            </h4>

            <p class="text-gray-400 mt-2">
                Less than
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &gt;=
            </h4>

            <p class="text-gray-400 mt-2">
                Greater than or equal to
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;=
            </h4>

            <p class="text-gray-400 mt-2">
                Less than or equal to
            </p>
        </div>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Common Mistake
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Use == to compare, not =. The single equals sign assigns a value, while the double equals sign compares values.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Logical Operators
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &amp;&amp; (AND)
            </h4>

            <p class="text-gray-400 mt-2">
                True only when both conditions are true.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                || (OR)
            </h4>

            <p class="text-gray-400 mt-2">
                True when at least one condition is true.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                ! (NOT)
            </h4>

            <p class="text-gray-400 mt-2">
                Reverses the result: true becomes false and false becomes true.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int age = 20;
boolean hasId = true;
System.out.println(age &gt;= 18 &amp;&amp; hasId);   // true
System.out.println(age &lt; 18 || hasId);    // true
System.out.println(!hasId);               // false</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>true
true
false</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java uses short-circuit evaluation. In a &amp;&amp; b, if a is false, Java does not check b because the result must be false. In a || b, if a is true, b is not checked.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Ternary (Conditional) Operator
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The ternary operator is a short form of if-else that gives a value. Its form is condition ? valueIfTrue : valueIfFalse.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int score = 82;
String result = (score &gt;= 75) ? "Passed" : "Failed";
System.out.println(result);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Passed</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the value of 17 % 5?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 2, because 17 divided by 5 leaves a remainder of 2.
        </p>

        <p class="text-white mt-4">
            What is the difference between = and ==?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> = assigns a value to a variable, while == compares two values and gives true or false.
        </p>

        <p class="text-white mt-4">
            What does x += 4 mean?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It adds 4 to x and stores the result in x, the same as x = x + 4.
        </p>

    </div>

</div>

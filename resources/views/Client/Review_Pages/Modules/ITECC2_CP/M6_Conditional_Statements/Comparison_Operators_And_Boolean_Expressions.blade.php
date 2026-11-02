{{-- TOPIC 6.1: COMPARISON OPERATORS AND BOOLEAN EXPRESSIONS --}}
<div class="mt-10" id="topic-comparison-operators-and-boolean-expressions">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        6.1 Comparison Operators and Boolean Expressions
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Programs become powerful when they can make decisions. A decision always starts with a question that has only two possible answers: yes or no, true or false. In Java, these questions are written as Boolean expressions, and they are built using comparison operators and logical operators.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The boolean Type
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The boolean data type can store only the values true or false. A Boolean expression is any expression whose result is a boolean.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>boolean isRaining = true;
boolean isAdult = 20 &gt;= 18;     // the expression gives true
System.out.println(isAdult);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>true</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Comparison (Relational) Operators
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                ==
            </h4>

            <p class="text-gray-400 mt-2">
                Equal to. 5 == 5 is true.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                !=
            </h4>

            <p class="text-gray-400 mt-2">
                Not equal to. 5 != 3 is true.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &gt;
            </h4>

            <p class="text-gray-400 mt-2">
                Greater than. 7 &gt; 3 is true.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;
            </h4>

            <p class="text-gray-400 mt-2">
                Less than. 2 &lt; 1 is false.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &gt;=
            </h4>

            <p class="text-gray-400 mt-2">
                Greater than or equal to. 5 &gt;= 5 is true.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;=
            </h4>

            <p class="text-gray-400 mt-2">
                Less than or equal to. 4 &lt;= 3 is false.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int a = 8, b = 5;
System.out.println(a &gt; b);
System.out.println(a == b);
System.out.println(a != b);
System.out.println(a &lt;= b);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>true
false
true
false</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Comparing Strings and Characters
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Never use == to compare the contents of Strings. The == operator checks whether two variables refer to the same object, not whether the text is the same. Use the equals() method, or equalsIgnoreCase() to ignore capital letters. For char values, == works correctly.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String a = "yes";
String b = new String("yes");
System.out.println(a == b);              // false (different objects)
System.out.println(a.equals(b));         // true
System.out.println("YES".equalsIgnoreCase(a));  // true

char grade = 'A';
System.out.println(grade == 'A');        // true</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>false
true
true
true</code></pre>
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
                Both sides must be true. (age &gt;= 18 &amp;&amp; age &lt;= 60)
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                || (OR)
            </h4>

            <p class="text-gray-400 mt-2">
                At least one side must be true. (day == 6 || day == 7)
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                ! (NOT)
            </h4>

            <p class="text-gray-400 mt-2">
                Reverses a boolean. !(x &gt; 5) is the same as x &lt;= 5.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The following truth table shows the results for every combination of values.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Truth Table
        </h4>

        <p class="text-white mt-3">
            true &amp;&amp; true = true; true &amp;&amp; false = false; false &amp;&amp; false = false
        </p>

        <p class="text-gray-400 mt-2">
            true || false = true; false || false = false
        </p>

        <p class="text-gray-400 mt-2">
            !true = false; !false = true
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Combining Conditions
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int age = 25;
double gpa = 1.8;
boolean eligible = (age &gt;= 18) &amp;&amp; (gpa &lt;= 3.0);
boolean rangeCheck = (age &gt;= 20) &amp;&amp; (age &lt;= 30);
boolean notAdult = !(age &gt;= 18);
System.out.println(eligible);
System.out.println(rangeCheck);
System.out.println(notAdult);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>true
true
false</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Writing 18 &lt;= age &lt;= 60. Java does not allow chained comparisons. Write age &gt;= 18 &amp;&amp; age &lt;= 60.
        </li>

        <li>
            Using = instead of ==. The single equals assigns a value.
        </li>

        <li>
            Using == to compare Strings instead of equals().
        </li>

        <li>
            Comparing decimal values with == because of rounding. Compare using a small tolerance instead.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does the expression 5 &gt; 3 &amp;&amp; 2 &gt; 4 evaluate to?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> false, because AND needs both sides to be true and 2 &gt; 4 is false.
        </p>

        <p class="text-white mt-4">
            How should you compare the contents of two Strings in Java?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Use the equals() method, not the == operator.
        </p>

        <p class="text-white mt-4">
            How do you write the condition "age is from 18 to 60" in Java?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> age &gt;= 18 &amp;&amp; age &lt;= 60
        </p>

    </div>

</div>

{{-- TOPIC 5.3: TYPES OF CONVERSION --}}
<div class="mt-10" id="topic-types-of-conversion">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        5.3 Types of Conversion
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Input from the console often comes as text, but programs need numbers to calculate. Conversion means changing a value from one data type to another. Java has two main kinds of conversion for primitive types, and also methods to convert between text and numbers.
    </p>

    <h3 class="text-xl font-bold mt-6">
        1. Implicit Conversion (Widening)
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java automatically converts a smaller type to a larger type when there is no risk of losing information. This is called widening or automatic conversion.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int whole = 25;
double decimal = whole;      // int to double: 25.0
long big = whole;            // int to long
System.out.println(decimal);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>25.0</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The widening order is: byte, then short, then int, then long, then float, then double. A char can also be widened to int.
    </p>

    <h3 class="text-xl font-bold mt-6">
        2. Explicit Conversion (Narrowing or Casting)
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When you convert a larger type to a smaller type, information might be lost, so Java requires you to ask for it explicitly with a cast, which is the target type in parentheses.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>double price = 99.99;
int rounded = (int) price;     // decimal part is cut off, not rounded
System.out.println(rounded);

int total = 17, count = 4;
double average = (double) total / count;
System.out.println(average);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>99
4.25</code></pre>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Cast Before Dividing
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            In (double) total / count, the cast applies to total first, so the division is done with decimals. Writing (double)(total / count) would divide integers first and give 4.0 instead.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        3. Converting Between Text and Numbers
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To convert a String to a number, use the parse methods of the wrapper classes. To convert a number to a String, use String.valueOf() or add an empty string.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int n = Integer.parseInt("123");
double d = Double.parseDouble("45.75");
boolean b = Boolean.parseBoolean("true");

String s1 = String.valueOf(789);
String s2 = 3.5 + "";
System.out.println(n + 1);
System.out.println(d + 1);
System.out.println(s1 + s2);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>124
46.75
7893.5</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If the text is not a valid number, such as Integer.parseInt("abc"), Java throws a NumberFormatException. Always make sure the input is valid before converting.
    </p>

    <h3 class="text-xl font-bold mt-6">
        4. Converting Between char and int
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>char letter = 'A';
int code = letter;            // 65
char next = (char) (letter + 1);   // 'B'
int digit = '7' - '0';        // 7
System.out.println(code);
System.out.println(next);
System.out.println(digit);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>65
B
7</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Summary of Conversion Types
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Implicit (Widening)
            </h4>

            <p class="text-gray-400 mt-2">
                Automatic, safe, small type to large type. No special syntax.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Explicit (Narrowing)
            </h4>

            <p class="text-gray-400 mt-2">
                Manual with a cast, may lose data, large type to small type.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                String to Number
            </h4>

            <p class="text-gray-400 mt-2">
                Integer.parseInt, Double.parseDouble.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Number to String
            </h4>

            <p class="text-gray-400 mt-2">
                String.valueOf or concatenation with a String.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the result of (int) 7.9?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 7. A cast to int cuts off the decimal part without rounding.
        </p>

        <p class="text-white mt-4">
            Which method converts the string "42" into an int?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Integer.parseInt("42").
        </p>

        <p class="text-white mt-4">
            Why is a cast needed when converting double to int?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because information (the decimal part) might be lost, so Java requires you to confirm it explicitly.
        </p>

    </div>

</div>

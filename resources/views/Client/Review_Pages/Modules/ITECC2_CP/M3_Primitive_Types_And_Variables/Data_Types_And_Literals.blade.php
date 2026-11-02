{{-- TOPIC 3.2: DATA TYPES AND LITERALS --}}
<div class="mt-10" id="topic-data-types-and-literals">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        3.2 Data Types and Literals
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A data type tells Java what kind of value a variable can hold, how much memory it needs, and which operations can be done with it. Java has two groups of data types. Primitive types hold simple values directly, and there are eight of them. Reference types, such as String, arrays, and objects, hold a reference to data stored elsewhere in memory.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Eight Primitive Types
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                byte
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                8 bits. Whole numbers from -128 to 127. Used to save memory in large arrays.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                short
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                16 bits. Whole numbers from -32,768 to 32,767.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                int
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                32 bits. Whole numbers from about -2.1 billion to 2.1 billion (-2,147,483,648 to 2,147,483,647). The default choice for whole numbers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                long
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                64 bits. Very large whole numbers. Literals end with L.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                float
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                32 bits. Decimal numbers with about 7 digits of precision. Literals end with f.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                double
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                64 bits. Decimal numbers with about 15 digits of precision. The default choice for decimal numbers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                char
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                16 bits. A single character in single quotes, such as 'A'. It uses Unicode.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                boolean
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Holds only true or false. Used for conditions.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>byte level = 100;
short year = 2026;
int population = 1250000;
long distance = 9460730472580800L;
float temperature = 36.6f;
double pi = 3.141592653589793;
char grade = 'A';
boolean passed = true;</code></pre>

    <h3 class="text-xl font-bold mt-6">
        The String Type
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        String is not a primitive type. It is a class that holds a sequence of characters written in double quotes. Because it is used so often, Java lets you create it without the new keyword. Strings are studied in more detail in a later chapter.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String message = "Welcome to Java";</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Choosing the Right Type
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Use int for counting and ordinary whole numbers.
        </li>

        <li>
            Use long when the number may exceed about 2 billion, such as a phone number stored as a number or a population of the world.
        </li>

        <li>
            Use double for measurements and prices, but remember it is approximate.
        </li>

        <li>
            Use char for a single character and String for words and sentences.
        </li>

        <li>
            Use boolean for yes or no, on or off.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        What Are Literals?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A literal is a fixed value written directly in the source code. For example, in int age = 18; the 18 is an integer literal, and in String name = "Ana"; the "Ana" is a string literal.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Integer Literals
            </h4>

            <p class="text-gray-400 mt-2">
                42 (decimal), 0b101010 (binary), 052 (octal), 0x2A (hexadecimal). Underscores can improve readability: 1_000_000. Add L for long: 5000000000L.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Floating-Point Literals
            </h4>

            <p class="text-gray-400 mt-2">
                3.14 (double), 2.5f (float), 1.5e3 (scientific notation, which is 1500.0).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Character Literals
            </h4>

            <p class="text-gray-400 mt-2">
                'A', '7', '$', and Unicode such as '\u0041' (which is A).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Boolean Literals
            </h4>

            <p class="text-gray-400 mt-2">
                true and false, always in lowercase.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                String Literals
            </h4>

            <p class="text-gray-400 mt-2">
                "Hello", "" (an empty string), "Line 1\nLine 2".
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                The null Literal
            </h4>

            <p class="text-gray-400 mt-2">
                Means that a reference variable does not refer to any object.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Escape Sequences
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                \n
            </h4>

            <p class="text-gray-400 mt-2">
                New line
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                \t
            </h4>

            <p class="text-gray-400 mt-2">
                Tab
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                \\
            </h4>

            <p class="text-gray-400 mt-2">
                A backslash
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                \"
            </h4>

            <p class="text-gray-400 mt-2">
                A double quote
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                \'
            </h4>

            <p class="text-gray-400 mt-2">
                A single quote
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.println("Name:\tAna");
System.out.println("She said \"Hello\"");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Name:    Ana
She said "Hello"</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Things to Watch Out For
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Overflow
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                When a value is too big for its type, it wraps around instead of showing an error. For example, Integer.MAX_VALUE + 1 becomes a large negative number. Use long if the value might be large.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Precision of double
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Decimal numbers are stored approximately. 0.1 + 0.2 gives 0.30000000000000004, not exactly 0.3. For money in real systems, use the BigDecimal class.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                char vs String
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                'A' (single quotes) is a char, while "A" (double quotes) is a String.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Which data type is the default for decimal numbers in Java?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> double.
        </p>

        <p class="text-white mt-4">
            What is the difference between 'A' and "A"?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 'A' is a char literal with single quotes, and "A" is a String literal with double quotes.
        </p>

        <p class="text-white mt-4">
            Why do we write 5000000000L with an L?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because the value is too large for int, so the L marks it as a long literal.
        </p>

    </div>

</div>

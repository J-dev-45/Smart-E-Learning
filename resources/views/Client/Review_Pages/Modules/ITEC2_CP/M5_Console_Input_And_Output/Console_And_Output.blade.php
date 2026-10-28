{{-- TOPIC 5.1: WHAT IS A CONSOLE AND CONSOLE OUTPUT --}}
<div class="mt-10" id="topic-what-is-a-console-and-console-output">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        5.1 What Is a Console and Console Output
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A console is a text-based window where a program shows its output and receives typed input. It is also called a terminal or command prompt. Before graphical interfaces existed, all programs used a console, and it is still the simplest way to learn programming because you can focus on logic instead of design. In Java, the console is accessed through the System class.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The System Class: In, Out, and Err
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                System.out
            </h4>

            <p class="text-gray-400 mt-2">
                The standard output stream. Used to display normal results.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                System.in
            </h4>

            <p class="text-gray-400 mt-2">
                The standard input stream. Used to read what the user types.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                System.err
            </h4>

            <p class="text-gray-400 mt-2">
                The standard error stream. Used to display error messages.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        print, println, and printf
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.print("Hello ");
System.out.print("World");
System.out.println("!");          // moves to a new line afterward
System.out.println("Next line");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Hello World!
Next line</code></pre>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                print()
            </h4>

            <p class="text-gray-400 mt-2">
                Displays the value and stays on the same line.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                println()
            </h4>

            <p class="text-gray-400 mt-2">
                Displays the value and then moves to the next line.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                printf()
            </h4>

            <p class="text-gray-400 mt-2">
                Displays formatted text using format specifiers.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Joining Text and Values
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String name = "Ana";
int age = 19;
System.out.println("Name: " + name + ", Age: " + age);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Name: Ana, Age: 19</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Formatted Output with printf
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The printf method uses a format string with placeholders, called format specifiers, that start with a percent sign. It gives you control over decimal places, spacing, and alignment.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                %d
            </h4>

            <p class="text-gray-400 mt-2">
                Whole numbers (int, long)
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                %f
            </h4>

            <p class="text-gray-400 mt-2">
                Decimal numbers. %.2f shows 2 decimal places.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                %s
            </h4>

            <p class="text-gray-400 mt-2">
                Strings
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                %c
            </h4>

            <p class="text-gray-400 mt-2">
                A single character
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                %b
            </h4>

            <p class="text-gray-400 mt-2">
                Boolean
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                %n
            </h4>

            <p class="text-gray-400 mt-2">
                New line (platform independent)
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String item = "Notebook";
int qty = 3;
double price = 25.5;
System.out.printf("Item: %s%n", item);
System.out.printf("Quantity: %d%n", qty);
System.out.printf("Total: %.2f%n", qty * price);
System.out.printf("|%5d|%-8s|%n", 42, "Java");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Item: Notebook
Quantity: 3
Total: 76.50
|   42|Java    |</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In %5d, the 5 sets a minimum width of 5 characters and right-aligns the number. In %-8s, the minus sign left-aligns the text within 8 characters.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Escape Sequences in Output
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.println("Name:\tAna");
System.out.println("Line 1\nLine 2");
System.out.println("She said \"Hi\"");
System.out.println("C:\\Users\\Ana");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Name:    Ana
Line 1
Line 2
She said "Hi"
C:\Users\Ana</code></pre>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Good Output Design
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Always tell the user what the program expects and what the results mean. A prompt such as "Enter your age: " is much clearer than a blank cursor.
        </p>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between print and println?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> print stays on the same line after displaying, while println moves to the next line.
        </p>

        <p class="text-white mt-4">
            Which format specifier displays a decimal number with two decimal places?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> %.2f
        </p>

        <p class="text-white mt-4">
            What does \t do in a string?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It inserts a tab space.
        </p>

    </div>

</div>

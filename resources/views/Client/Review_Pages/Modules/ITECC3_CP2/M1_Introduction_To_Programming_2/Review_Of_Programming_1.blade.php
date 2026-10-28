{{-- TOPIC 1.1: REVIEW OF PROGRAMMING 1: VARIABLES, CONDITIONS, LOOPS, AND METHODS --}}
<div class="mt-10" id="topic-review-of-programming-1-variables-conditions-loops-and-methods">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.1 Review of Programming 1: Variables, Conditions, Loops, and Methods
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Computer Programming 2 builds directly on what you learned in Programming 1. Before moving on to arrays, algorithms, and object-oriented programming, it is important to refresh the fundamentals, because every advanced technique in this course is built from variables, decisions, loops, and methods. This review shows how these four ideas work together.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Variables and Data Types
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A variable is a named location in memory that stores a value, and its data type tells Java what kind of value it can hold. Java checks types when the program is compiled, so a variable declared as int can never hold text.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                int, long, short, byte
            </h4>

            <p class="text-gray-400 mt-2">
                Whole numbers of different sizes. int is the usual choice.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                double, float
            </h4>

            <p class="text-gray-400 mt-2">
                Decimal numbers. double is the default for decimals.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                char
            </h4>

            <p class="text-gray-400 mt-2">
                A single character in single quotes, such as 'A'.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                boolean
            </h4>

            <p class="text-gray-400 mt-2">
                true or false, used for conditions.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                String
            </h4>

            <p class="text-gray-400 mt-2">
                A sequence of characters in double quotes. It is a class, not a primitive type.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int age = 19;
double gpa = 1.75;
char section = 'A';
boolean enrolled = true;
String name = "Ana";
System.out.println(name + " is " + age + " years old, section " + section);
System.out.println("GPA: " + gpa + ", enrolled: " + enrolled);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana is 19 years old, section A
GPA: 1.75, enrolled: true</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Conditional Statements
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Conditional statements let a program choose a path. The if statement runs a block when its condition is true, else handles the other case, and else-if chains several conditions. A switch statement is useful when one value is compared against many exact choices.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int score = 82;
if (score &gt;= 90) &#123;
    System.out.println("Excellent");
} else if (score &gt;= 75) &#123;
    System.out.println("Passed");
} else &#123;
    System.out.println("Failed");
}

int day = 3;
switch (day) &#123;
    case 1: System.out.println("Monday"); break;
    case 2: System.out.println("Tuesday"); break;
    case 3: System.out.println("Wednesday"); break;
    default: System.out.println("Another day");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Passed
Wednesday</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Loops
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A loop repeats a block of code. Use for when you know how many times to repeat, while when you repeat until a condition changes, and do-while when the body must run at least once. Every loop needs an initialization, a condition, and an update.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int total = 0;
for (int i = 1; i &lt;= 5; i++) &#123;
    total += i;
}
System.out.println("Sum 1 to 5 = " + total);

int n = 1;
while (n &lt;= 20) &#123;
    n *= 2;
}
System.out.println("First power of 2 above 20: " + n);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Sum 1 to 5 = 15
First power of 2 above 20: 32</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A method is a named block of code that does one job and can be reused. It has a return type, a name, parameters, and a body. Breaking a program into methods makes it easier to read, test, and fix, and this habit becomes even more important when we write algorithms and classes.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int square(int x) &#123; return x * x; }
static boolean isEven(int n) &#123; return n % 2 == 0; }
static void printLine(int length) &#123;
    for (int i = 0; i &lt; length; i++) System.out.print("-");
    System.out.println();
}

int result = square(7);
System.out.println("7 squared = " + result);
System.out.println("Is 10 even? " + isEven(10));
printLine(20);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>7 squared = 49
Is 10 even? true
--------------------</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Putting Everything Together
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The following program uses a variable, a loop, a condition, and a method together. It counts how many numbers from 1 to 20 are multiples of 3.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static boolean isMultipleOfThree(int n) &#123;
    return n % 3 == 0;
}

int count = 0;
for (int i = 1; i &lt;= 20; i++) &#123;
    if (isMultipleOfThree(i)) &#123;
        count++;
    }
}
System.out.println("Multiples of 3 from 1 to 20: " + count);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Multiples of 3 from 1 to 20: 6</code></pre>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Why a Review?
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Most errors in advanced programs come from small mistakes in the basics: a wrong loop condition, an integer division, or a misspelled variable. Strong fundamentals make arrays, algorithms, and classes much easier to learn.
        </p>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between while and do-while?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A while loop checks its condition before each repetition, so it may not run at all. A do-while runs the body at least once before checking.
        </p>

        <p class="text-white mt-4">
            Why does a method have a return type?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It tells Java what kind of value the method sends back, or void if it returns nothing.
        </p>

        <p class="text-white mt-4">
            Which data type should you use for a decimal number?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> double, which is the default type for decimal values.
        </p>

    </div>

</div>

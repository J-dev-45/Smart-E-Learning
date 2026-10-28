{{-- TOPIC 3.1: WHAT IS A VARIABLE AND DECLARING VARIABLES --}}
<div class="mt-10" id="topic-what-is-a-variable-and-declaring-variables">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        3.1 What Is a Variable and Declaring Variables
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A variable is a named location in the computer's memory that holds a value which can change while the program runs. You can think of it as a labeled box: the label is the variable's name, the size and kind of box is its data type, and the thing inside is its value. Programs use variables to remember user input, keep track of scores, store the results of calculations, and much more.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Declaring a Variable
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Before you can use a variable in Java, you must declare it by stating its data type and its name. Java is a statically typed language, which means that the type of every variable must be known when the program is compiled and cannot change afterward.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>dataType variableName;
dataType variableName = value;   // declare and initialize</code></pre>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int age;                  // declaration
age = 18;                 // assignment
double price = 49.50;     // declaration and initialization
String name = "Ana";
boolean isEnrolled = true;</code></pre>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Declaration
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Creates the variable and reserves memory for it, for example int age;
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Initialization
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Gives the variable its first value, for example int age = 18;
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Assignment
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Stores a new value in an existing variable, for example age = 19; Notice that the type is not written again.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Declaring Several Variables
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int x = 1, y = 2, z = 3;   // same type, one statement
int a, b;                  // declared, not yet assigned</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Using Variables
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int quantity = 3;
double unitPrice = 25.5;
double total = quantity * unitPrice;
System.out.println("Total: " + total);

quantity = 5;              // the value can change
total = quantity * unitPrice;
System.out.println("New total: " + total);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Total: 76.5
New total: 127.5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Rules for Variables
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            A local variable must be given a value before it is used, or the compiler reports an error.
        </li>

        <li>
            A variable name can be declared only once in the same scope.
        </li>

        <li>
            Use meaningful camelCase names, such as studentAge or totalScore.
        </li>

        <li>
            The type of a variable cannot be changed after it is declared, but its value can.
        </li>

        <li>
            A variable exists only inside the block of code { } where it is declared. This is called its scope.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Constants with final
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If a value must never change, declare it with the final keyword. Trying to change it later causes a compile error. By convention, constants are written in uppercase.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>final double PI = 3.14159;
final int MAX_STUDENTS = 40;
// PI = 3.14;   // error: cannot assign a value to a final variable</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Swapping Two Values
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A common exercise is to swap the contents of two variables. You need a third variable to hold one value temporarily, otherwise the first value would be overwritten.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int a = 10, b = 20;
int temp = a;
a = b;
b = temp;
System.out.println("a = " + a + ", b = " + b);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>a = 20, b = 10</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is a variable?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A named location in memory that stores a value that can change while the program runs.
        </p>

        <p class="text-white mt-4">
            What is the difference between declaring and initializing a variable?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Declaring creates the variable with a type and a name, while initializing gives it its first value.
        </p>

        <p class="text-white mt-4">
            How do you make a value that cannot be changed?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Declare it with the final keyword.
        </p>

    </div>

</div>

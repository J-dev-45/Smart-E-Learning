{{-- TOPIC 9.1: WHAT IS AN ARRAY, DECLARATION, AND MEMORY ALLOCATION --}}
<div class="mt-10" id="topic-what-is-an-array-declaration-and-memory-allocation">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        9.1 What Is an Array, Declaration, and Memory Allocation
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Imagine you need to store the grades of 50 students. Creating 50 separate variables would be slow and clumsy. An array solves this problem. An array is a collection of a fixed number of values of the same type, stored one after another in memory under a single name. Each value is called an element, and each element is reached by its position number, called an index.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Key Facts About Arrays
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            All elements have the same data type.
        </li>

        <li>
            The size is fixed when the array is created and cannot change afterward.
        </li>

        <li>
            The index starts at 0, so the last element is at index length - 1.
        </li>

        <li>
            Arrays are objects in Java, and their elements are stored next to each other in memory.
        </li>

        <li>
            The length field tells how many elements the array has. It has no parentheses.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            An Array of 5 Scores
        </h4>

        <p class="text-white mt-3">
            Index:   0    1    2    3    4
        </p>

        <p class="text-gray-400 mt-2">
            Value:  85   90   78   92   88
        </p>

        <p class="text-gray-400 mt-2">
            scores[0] is 85 and scores[4] is 88. The length is 5.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Declaring an Array
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Declaring an array tells Java the type of the elements and the name of the array. At this point no memory has been set aside for the elements yet.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores;          // preferred style
String[] names;
double prices[];       // also valid, but less common</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Allocating Memory with new
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To create the array and reserve memory for its elements, use the new keyword and give the size. Java fills the array with default values: 0 for numbers, false for boolean, '\u0000' for char, and null for objects such as String.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores = new int[5];          // 5 integers, all 0
String[] names = new String[3];     // 3 Strings, all null
boolean[] flags = new boolean[4];   // 4 booleans, all false

System.out.println(scores[0]);
System.out.println(names[0]);
System.out.println(flags[0]);
System.out.println(scores.length);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>0
null
false
5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Declaration, Allocation, and Initialization Together
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// Step by step
int[] a;
a = new int[3];
a[0] = 10;
a[1] = 20;
a[2] = 30;

// One line
int[] b = new int[3];

// With initial values (the size is set automatically)
int[] c = &#123;85, 90, 78, 92, 88};
String[] days = &#123;"Mon", "Tue", "Wed"};
double[] prices = new double[]&#123;9.99, 14.5, 3.0};</code></pre>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Declaration
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                int[] scores; creates a reference variable that does not point to an array yet.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Allocation
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                scores = new int[5]; creates the array in memory and makes the variable refer to it.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Initialization
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Giving the elements values, either one by one or using braces { } at declaration.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        How Arrays Are Stored in Memory
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The array variable does not hold the elements themselves. It holds a reference, which is the address of where the array is stored in memory. This is why two array variables can refer to the same array, and a change through one is seen through the other.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] x = &#123;1, 2, 3};
int[] y = x;           // y refers to the SAME array
y[0] = 99;
System.out.println(x[0]);

int[] z = x.clone();   // z is a separate copy
z[0] = 5;
System.out.println(x[0]);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>99
99</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Size Rules and Common Errors
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Negative or Missing Size
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                new int[-1] throws a NegativeArraySizeException. The size must be given when using new.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                ArrayIndexOutOfBoundsException
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Using an index below 0 or at length or above stops the program. In an array of 5, valid indexes are 0 to 4.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                NullPointerException
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Using an array variable that is still null, because new was never called.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the index of the last element in an array with 8 elements?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 7.
        </p>

        <p class="text-white mt-4">
            What are the default values of a new int array and a new String array?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 0 for int and null for String.
        </p>

        <p class="text-white mt-4">
            Why does changing y[0] also change x[0] after int[] y = x;?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because both variables refer to the same array object in memory.
        </p>

    </div>

</div>

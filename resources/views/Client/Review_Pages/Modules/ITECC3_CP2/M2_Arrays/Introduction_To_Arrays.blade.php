{{-- TOPIC 2.1: INTRODUCTION TO ARRAYS --}}
<div class="mt-10" id="topic-introduction-to-arrays">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.1 Introduction to Arrays
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Suppose you need to store the grades of 40 students. Declaring 40 separate variables would be slow, hard to read, and impossible to loop through. An array solves this problem by storing many values of the same type under one name. Arrays are one of the most important data structures, and almost every algorithm in this course works on them.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is an Array?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An array is a fixed-size, ordered collection of elements that all have the same data type. The elements are stored one after another in memory, and each element is reached by its position number, called an index. In Java, an array is an object, so an array variable holds a reference to the array.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            An Array of Five Grades
        </h4>

        <p class="text-white mt-3">
            Index:   0    1    2    3    4
        </p>

        <p class="text-gray-400 mt-2">
            Value:  85   90   78   92   88
        </p>

        <p class="text-gray-400 mt-2">
            grades[0] is 85, grades[4] is 88, and grades.length is 5
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Purpose of Arrays
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Store Many Values Together
            </h4>

            <p class="text-gray-400 mt-2">
                One name holds the whole group of related values.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Process with Loops
            </h4>

            <p class="text-gray-400 mt-2">
                A loop and the index let you visit every element with a few lines of code.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Support Algorithms
            </h4>

            <p class="text-gray-400 mt-2">
                Searching, sorting, and statistics all work on arrays.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Model Tables and Lists
            </h4>

            <p class="text-gray-400 mt-2">
                Lists of scores, temperatures, names, and rows of data can be stored naturally.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// Without an array: repetitive and not scalable
int g1 = 85, g2 = 90, g3 = 78;
System.out.println((g1 + g2 + g3) / 3.0);

// With an array: works for any number of grades
int[] grades = &#123;85, 90, 78};
int sum = 0;
for (int g : grades) sum += g;
System.out.println((double) sum / grades.length);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>84.33333333333333
84.33333333333333</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Advantages and Limitations
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Advantages
            </h4>

            <p class="text-gray-400 mt-2">
                Fast access to any element by its index. Simple and memory efficient. Easy to traverse with loops. Elements are stored next to each other in memory.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Limitations
            </h4>

            <p class="text-gray-400 mt-2">
                The size is fixed once created. All elements must be of the same type. Inserting or removing in the middle requires shifting elements. Using an invalid index causes an error.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Array Indexing
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Index numbers start at 0, not at 1. The first element is at index 0 and the last element is at index length - 1. This is called zero-based indexing. The reason is that the index tells how far an element is from the start of the array, and the first element is zero steps away.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Array Declaration and Initialization
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Declaring an array tells Java the element type and the name. Creating it with new reserves memory for a given number of elements, and Java fills it with default values: 0 for numbers, false for boolean, and null for objects. You can also give the values directly with an initializer list.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores = new int[5];            // five ints, all 0
String[] names = new String[3];       // three Strings, all null
double[] temps = &#123;30.5, 31.2, 29.8};  // initializer list
char[] vowels = &#123;'a', 'e', 'i', 'o', 'u'};

System.out.println(scores[0] + " " + names[0]);
System.out.println(temps.length + " temperatures");
System.out.println(vowels[2]);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>0 null
3 temperatures
i</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Accessing Array Elements
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Use the array name and the index in square brackets to read or change an element. The length field gives the number of elements. It has no parentheses, unlike the length() method of a String.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] grades = &#123;85, 90, 78, 92, 88};
System.out.println("First: " + grades[0]);
System.out.println("Last: " + grades[grades.length - 1]);

grades[2] = 80;                        // update
System.out.println("Updated: " + grades[2]);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>First: 85
Last: 88
Updated: 80</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Index Out of Bounds
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java checks every array access while the program runs. If the index is negative, or equal to or larger than the length, Java throws an ArrayIndexOutOfBoundsException and the program stops unless the error is handled.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;10, 20, 30};
try &#123;
    System.out.println(a[3]);
} catch (ArrayIndexOutOfBoundsException e) &#123;
    System.out.println("Error: " + e.getMessage());
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Error: Index 3 out of bounds for length 3</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the index of the last element of an array with 10 elements?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 9, because the index starts at 0 and the last index is length - 1.
        </p>

        <p class="text-white mt-4">
            What are the default values of a new int array and a new String array?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 0 for int and null for String.
        </p>

        <p class="text-white mt-4">
            Why can an array not grow after it is created?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Its size is fixed when memory is reserved. To store more, you must create a new, larger array.
        </p>

    </div>

</div>

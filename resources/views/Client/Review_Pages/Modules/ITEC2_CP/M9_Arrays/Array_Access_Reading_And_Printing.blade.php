{{-- TOPIC 9.2: ACCESSING, READING, AND PRINTING ARRAY ELEMENTS --}}
<div class="mt-10" id="topic-accessing-reading-and-printing-array-elements">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        9.2 Accessing, Reading, and Printing Array Elements
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Once an array exists, you need to be able to store values in it, read them back, ask the user to fill it, and display its contents. Each of these tasks uses the index of the element, and most of them also use a loop.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Accessing an Element
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Use the array name followed by the index in square brackets. You can use this both to read a value and to change it.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores = &#123;85, 90, 78, 92, 88};

System.out.println(scores[0]);     // read: 85
scores[2] = 80;                    // write: change 78 to 80
scores[4] = scores[4] + 5;         // use in an expression
System.out.println(scores[2]);
System.out.println(scores[4]);

int last = scores[scores.length - 1];
System.out.println(last);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>85
80
93
93</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The index may be any expression that gives an int, such as a variable (scores[i]) or a calculation (scores[i + 1]).
    </p>

    <h3 class="text-xl font-bold mt-6">
        Reading an Array from the Console
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To read values from the user, combine a for loop with Scanner. The loop variable becomes the index.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>import java.util.Scanner;

public class ReadArray &#123;
    public static void main(String[] args) &#123;
        Scanner input = new Scanner(System.in);

        System.out.print("How many scores? ");
        int n = input.nextInt();
        int[] scores = new int[n];

        for (int i = 0; i &lt; scores.length; i++) &#123;
            System.out.print("Enter score " + (i + 1) + ": ");
            scores[i] = input.nextInt();
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>How many scores? 3
Enter score 1: 85
Enter score 2: 90
Enter score 3: 78</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Notice that the prompt uses i + 1 so that the user sees "score 1" while the array index is 0. Because the size is read from the user, the array is created after reading n.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Printing an Array to the Console
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        You cannot print an array directly with println, because it would show a strange memory reference like [I&#64;1b6d3586. Use a loop, or the helper methods of the Arrays class from java.util.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores = &#123;85, 90, 78};

// 1. Using a for loop
for (int i = 0; i &lt; scores.length; i++) &#123;
    System.out.println("scores[" + i + "] = " + scores[i]);
}

// 2. Using the enhanced for loop
for (int s : scores) &#123;
    System.out.print(s + " ");
}
System.out.println();

// 3. Using Arrays.toString
System.out.println(java.util.Arrays.toString(scores));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>scores[0] = 85
scores[1] = 90
scores[2] = 78
85 90 78 
[85, 90, 78]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Useful Operations
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;5, 2, 9, 1};
java.util.Arrays.sort(a);
System.out.println(java.util.Arrays.toString(a));

int[] copy = java.util.Arrays.copyOf(a, a.length);
java.util.Arrays.fill(copy, 0);
System.out.println(java.util.Arrays.toString(copy));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[1, 2, 5, 9]
[0, 0, 0, 0]</code></pre>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arrays.toString(a)
            </h4>

            <p class="text-gray-400 mt-2">
                Returns the contents as text.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arrays.sort(a)
            </h4>

            <p class="text-gray-400 mt-2">
                Sorts the array in ascending order.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arrays.fill(a, v)
            </h4>

            <p class="text-gray-400 mt-2">
                Sets every element to v.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arrays.copyOf(a, n)
            </h4>

            <p class="text-gray-400 mt-2">
                Makes a copy with n elements.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            How do you change the third element of an array named data to 50?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> data[2] = 50;
        </p>

        <p class="text-white mt-4">
            Why print scores directly using System.out.println(scores) not recommended?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It prints the memory reference of the array, not its contents.
        </p>

        <p class="text-white mt-4">
            Why do we use (i + 1) in the prompt when reading scores?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because the index starts at 0, but users expect to count starting from 1.
        </p>

    </div>

</div>

{{-- TOPIC 4.1: INTRODUCTION TO SORTING --}}
<div class="mt-10" id="topic-introduction-to-sorting">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.1 Introduction to Sorting
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Sorting means arranging data in a specific order. Sorted data is easier to read, to search, and to analyze. When you view a list of students by grade, a contact list by name, or an online shop by price, a sorting algorithm has arranged the data for you.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Definition and Importance
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A sorting algorithm rearranges the elements of a collection into a defined order, usually numerical or alphabetical. Sorting is important for several reasons. It makes data easier to display and understand, such as rankings. It allows fast searching with binary search. It makes it easy to find the smallest, largest, or middle values, and to detect duplicates, since equal values end up next to each other.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Ascending and Descending Order
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Ascending Order
            </h4>

            <p class="text-gray-400 mt-2">
                From smallest to largest, or A to Z. Example: 2, 5, 9, 14.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Descending Order
            </h4>

            <p class="text-gray-400 mt-2">
                From largest to smallest, or Z to A. Example: 14, 9, 5, 2.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Most algorithms can sort in either direction by changing a single comparison, from greater than to less than.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Stable and Unstable Sorting
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A sorting algorithm is stable if it keeps records with equal keys in their original relative order. Suppose two students have the same grade. After a stable sort by grade, the student who came first in the original list still comes first. Stability matters when you sort records by more than one field, for example by grade and then by name.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Stability Example
        </h4>

        <p class="text-white mt-3">
            Original: (Ana, 90), (Ben, 85), (Cara, 90)
        </p>

        <p class="text-gray-400 mt-2">
            Stable sort by grade, descending: (Ana, 90), (Cara, 90), (Ben, 85)
        </p>

        <p class="text-gray-400 mt-2">
            An unstable sort might return (Cara, 90) before (Ana, 90)
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        In-Place Sorting
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An in-place algorithm sorts the array using only a small, fixed amount of extra memory, usually just a few variables, by rearranging elements within the same array. Bubble, selection, insertion, and quick sort are in-place. Merge sort usually needs extra arrays to hold the merged result.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Internal and External Sorting
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Internal Sorting
            </h4>

            <p class="text-gray-400 mt-2">
                All the data fits in main memory (RAM). The sorts in this course are internal sorts.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                External Sorting
            </h4>

            <p class="text-gray-400 mt-2">
                The data is too large for memory and is kept in files on disk. It is sorted in pieces that are then merged, the idea behind merge sort.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Overview of the Algorithms in This Module
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Bubble Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Repeatedly swaps adjacent elements that are out of order. Stable and in-place.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Selection Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Repeatedly selects the smallest remaining element and moves it to its place. In-place, usually not stable.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Insertion Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Inserts each element into the sorted part on its left. Stable and in-place.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Merge Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Splits the array, sorts each half, and merges them. Stable, needs extra memory.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Quick Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Partitions around a pivot and sorts each part. In-place, usually not stable.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Swap Operation
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Many sorting algorithms rely on swapping two elements. Because a variable can hold only one value, a temporary variable is needed to avoid losing a value.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;5, 9};
System.out.println("Before: " + java.util.Arrays.toString(a));
int temp = a[0];
a[0] = a[1];
a[1] = temp;
System.out.println("After:  " + java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Before: [5, 9]
After:  [9, 5]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Built-in Sorting
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;42, 7, 19, 3, 25};
java.util.Arrays.sort(a);
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[3, 7, 19, 25, 42]</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java's Arrays.sort() is already well optimized, so in real programs you will normally use it. Writing the algorithms yourself in this course helps you understand how sorting works and how to compare algorithms.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between ascending and descending order?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Ascending goes from smallest to largest, while descending goes from largest to smallest.
        </p>

        <p class="text-white mt-4">
            What does it mean for a sort to be stable?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Records with equal keys stay in their original relative order after sorting.
        </p>

        <p class="text-white mt-4">
            What is an in-place sorting algorithm?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> One that sorts within the same array using only a small, fixed amount of extra memory.
        </p>

    </div>

</div>

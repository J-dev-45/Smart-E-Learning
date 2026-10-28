{{-- TOPIC 3.1: SEARCHING CONCEPTS --}}
<div class="mt-10" id="topic-searching-concepts">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        3.1 Searching Concepts
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Searching is one of the most common tasks in computing. Every time you look for a contact in your phone, find a word in a document, or check whether a username is already taken, a search is performed. A searching algorithm is a step-by-step method for finding a target value, called the key, in a collection of data.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Searching?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Searching means checking a collection of data to find out whether a particular item is present and, usually, where it is located. A search normally gives one of two results: the position of the item (its index in an array) or a sign that the item was not found. By convention, a search method returns the index when the item is found and -1 when it is not, because -1 can never be a valid array index.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Importance of Searching
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Everyday Use
            </h4>

            <p class="text-gray-400 mt-2">
                Finding records, products, files, and messages quickly.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Foundation for Other Tasks
            </h4>

            <p class="text-gray-400 mt-2">
                Updating, deleting, and checking duplicates all begin by finding the item first.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Efficiency
            </h4>

            <p class="text-gray-400 mt-2">
                The method you choose decides how long a program takes on large data. A good search saves time and resources.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Basis for Algorithm Study
            </h4>

            <p class="text-gray-400 mt-2">
                Linear and binary search show clearly how the structure of data affects speed.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Searching Unsorted Data
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When the data is in no particular order, the only reliable way to find an item is to check the elements one by one from the start until the item is found or the end is reached. Nothing about one element tells you anything about the others. This is the idea of linear search.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Searching Sorted Data
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When the data is sorted, a comparison with one element tells you which half of the data can contain the key. If the middle element is smaller than the key, everything to its left is also smaller and can be ignored. This allows a much faster method called binary search, which discards half of the remaining elements at every step.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Measuring the Work of a Search
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The speed of a search is described by the number of comparisons it makes. The following program counts the comparisons that a simple search needs for different keys in the same array.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int comparisons(int[] a, int key) &#123;
    int count = 0;
    for (int i = 0; i &lt; a.length; i++) &#123;
        count++;
        if (a[i] == key) break;
    }
    return count;
}

int[] data = &#123;12, 45, 7, 33, 90, 21, 64};
System.out.println("Key 12: " + comparisons(data, 12) + " comparison(s)");
System.out.println("Key 90: " + comparisons(data, 90) + " comparison(s)");
System.out.println("Key 64: " + comparisons(data, 64) + " comparison(s)");
System.out.println("Key 99: " + comparisons(data, 99) + " comparison(s), not found");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Key 12: 1 comparison(s)
Key 90: 5 comparison(s)
Key 64: 7 comparison(s)
Key 99: 7 comparison(s), not found</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Notice that a key near the front is found quickly, while a key at the end, or one that is missing, needs a comparison with every element. This difference between best case and worst case is studied in the module on algorithm analysis.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Choosing a Search Method
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Two Situations
        </h4>

        <p class="text-white mt-3">
            Unsorted list of 500 names: use linear search, because there is no order to exploit.
        </p>

        <p class="text-gray-400 mt-2">
            Sorted list of one million student IDs: use binary search, because it needs only about 20 comparisons.
        </p>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does a search method usually return when the item is not found?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> -1, which can never be a valid array index.
        </p>

        <p class="text-white mt-4">
            Why can sorted data be searched faster?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because comparing with one element shows which half cannot contain the key, so half of the data can be discarded at each step.
        </p>

        <p class="text-white mt-4">
            What do we count to measure the work of a search?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The number of comparisons made.
        </p>

    </div>

</div>

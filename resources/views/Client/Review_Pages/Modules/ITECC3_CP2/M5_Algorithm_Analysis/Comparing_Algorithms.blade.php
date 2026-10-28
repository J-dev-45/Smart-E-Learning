{{-- TOPIC 5.3: COMPARING ALGORITHMS AND THEIR COMPLEXITIES --}}
<div class="mt-10" id="topic-comparing-algorithms-and-their-complexities">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        5.3 Comparing Algorithms and Their Complexities
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Now that you can describe the efficiency of an algorithm with Big O notation, you can compare the searching and sorting algorithms you have studied. The goal is not to memorize a table, but to understand why each algorithm has its complexity and how to use that knowledge to choose the right one.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Searching Algorithms
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Linear Search
            </h4>

            <p class="text-gray-400 mt-2">
                Best case O(1), worst and average O(n). It checks elements one by one and works on any data. Extra space: O(1).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Binary Search
            </h4>

            <p class="text-gray-400 mt-2">
                Best case O(1), worst and average O(log n). It halves the range each step but needs sorted data. Extra space: O(1) iterative.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        For one million elements, linear search may need up to 1,000,000 comparisons, while binary search needs at most about 20. However, if the data is not sorted, you must sort it first, which costs more than a single linear search. Binary search pays off when you search many times.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Sorting Algorithms
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Bubble Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Best O(n) with the swap flag, average and worst O(n squared). Stable. In-place.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Selection Sort
            </h4>

            <p class="text-gray-400 mt-2">
                O(n squared) in the best, average, and worst case. Usually not stable. In-place.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Insertion Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Best O(n), average and worst O(n squared). Stable. In-place.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Merge Sort
            </h4>

            <p class="text-gray-400 mt-2">
                O(n log n) in all cases. Stable. Needs O(n) extra space.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Quick Sort
            </h4>

            <p class="text-gray-400 mt-2">
                Best and average O(n log n), worst O(n squared). Usually not stable. In-place, with small stack use.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Why Are the Simple Sorts Quadratic?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Bubble, selection, and insertion sort each use two nested loops over the data. The outer loop makes about n passes, and the inner loop looks at up to n elements in each pass, giving about n x n steps.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Why Are Merge Sort and Quick Sort Faster?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Merge sort splits the array in half again and again, so there are only about log n levels. At every level, the merging touches all n elements once. That gives n x log n steps. Quick sort does the same on average, because a good pivot splits the array into two parts of similar size.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Comparing the Algorithms Experimentally
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The program below sorts the same 200 random numbers with each algorithm and counts the comparisons. A fixed seed is used so that the data is the same each time.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>import java.util.Random;

public class Main &#123;
    static long count;

    public static void main(String[] args) &#123;
        Random r = new Random(42);
        int[] data = new int[200];
        for (int i = 0; i &lt; data.length; i++) data[i] = r.nextInt(1000);

        count = 0; bubble(data.clone());    System.out.println("Bubble sort:    " + count);
        count = 0; selection(data.clone()); System.out.println("Selection sort: " + count);
        count = 0; insertion(data.clone()); System.out.println("Insertion sort: " + count);
        count = 0; mergeSort(data.clone(), 0, data.length - 1); System.out.println("Merge sort:     " + count);
        count = 0; quickSort(data.clone(), 0, data.length - 1); System.out.println("Quick sort:     " + count);
    }

    static void bubble(int[] a) &#123;
        for (int p = 0; p &lt; a.length - 1; p++)
            for (int i = 0; i &lt; a.length - 1 - p; i++) &#123;
                count++;
                if (a[i] &gt; a[i + 1]) &#123; int t = a[i]; a[i] = a[i + 1]; a[i + 1] = t; }
            }
    }

    static void selection(int[] a) &#123;
        for (int i = 0; i &lt; a.length - 1; i++) &#123;
            int m = i;
            for (int j = i + 1; j &lt; a.length; j++) &#123; count++; if (a[j] &lt; a[m]) m = j; }
            int t = a[m]; a[m] = a[i]; a[i] = t;
        }
    }

    static void insertion(int[] a) &#123;
        for (int i = 1; i &lt; a.length; i++) &#123;
            int key = a[i], j = i - 1;
            while (j &gt;= 0) &#123;
                count++;
                if (a[j] &gt; key) &#123; a[j + 1] = a[j]; j--; } else break;
            }
            a[j + 1] = key;
        }
    }

    static void mergeSort(int[] a, int lo, int hi) &#123;
        if (lo &gt;= hi) return;
        int mid = (lo + hi) / 2;
        mergeSort(a, lo, mid); mergeSort(a, mid + 1, hi);
        int[] tmp = new int[hi - lo + 1];
        int i = lo, j = mid + 1, k = 0;
        while (i &lt;= mid &amp;&amp; j &lt;= hi) &#123; count++; if (a[i] &lt;= a[j]) tmp[k++] = a[i++]; else tmp[k++] = a[j++]; }
        while (i &lt;= mid) tmp[k++] = a[i++];
        while (j &lt;= hi) tmp[k++] = a[j++];
        for (int x = 0; x &lt; tmp.length; x++) a[lo + x] = tmp[x];
    }

    static void quickSort(int[] a, int lo, int hi) &#123;
        if (lo &gt;= hi) return;
        int pivot = a[hi], i = lo - 1;
        for (int j = lo; j &lt; hi; j++) &#123;
            count++;
            if (a[j] &lt; pivot) &#123; i++; int t = a[i]; a[i] = a[j]; a[j] = t; }
        }
        int t = a[i + 1]; a[i + 1] = a[hi]; a[hi] = t;
        quickSort(a, lo, i); quickSort(a, i + 2, hi);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Bubble sort:    19900
Selection sort: 19900
Insertion sort: 9777
Merge sort:     1274
Quick sort:     1584</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        For the same 200 numbers, bubble sort and selection sort each make 19,900 comparisons (about n x n / 2), insertion sort makes about 9,800, while merge sort makes only about 1,300 and quick sort about 1,600. The gap grows much larger as the data grows. Note that this bubble sort has no swap flag, so it always makes the full number of comparisons.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Best and Worst Case for Insertion Sort
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int shifts(int[] input) &#123;
    int[] a = input.clone();
    int count = 0;
    for (int i = 1; i &lt; a.length; i++) &#123;
        int key = a[i], j = i - 1;
        while (j &gt;= 0 &amp;&amp; a[j] &gt; key) &#123; a[j + 1] = a[j]; j--; count++; }
        a[j + 1] = key;
    }
    return count;
}

int[] sorted = &#123;1, 2, 3, 4, 5, 6, 7, 8};
int[] reversed = &#123;8, 7, 6, 5, 4, 3, 2, 1};
System.out.println("Already sorted: " + shifts(sorted) + " shifts");
System.out.println("Reverse sorted: " + shifts(reversed) + " shifts");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Already sorted: 0 shifts
Reverse sorted: 28 shifts</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Choosing an Algorithm
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Is the data sorted? How big is it?
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Unsorted and small: linear search. Sorted and large, or searched many times: binary search.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Is the data small or nearly sorted?
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Insertion sort is simple and fast.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Do you need guaranteed speed and stability?
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Merge sort, if the extra memory is acceptable.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Is memory limited and average speed most important?
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Quick sort.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Is simplicity more important than speed?
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                For a few elements, bubble or selection sort are easy to write and understand.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why is binary search faster than linear search for large sorted data?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It halves the search range at each step, so it needs about log n comparisons instead of up to n.
        </p>

        <p class="text-white mt-4">
            Why do merge sort and quick sort run in about n log n time?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> They split the data in half about log n times, and each level of work touches about n elements.
        </p>

        <p class="text-white mt-4">
            Which sorting algorithm needs extra memory proportional to n?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Merge sort.
        </p>

    </div>

</div>

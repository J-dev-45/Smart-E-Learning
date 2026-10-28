{{-- TOPIC 3.3: BINARY SEARCH --}}
<div class="mt-10" id="topic-binary-search">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        3.3 Binary Search
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Binary search is a much faster way to find an item, but it has an important requirement: the array must already be sorted. Instead of checking elements one by one, binary search looks at the middle element and decides which half of the array could contain the key. It discards the other half and repeats, so the search range is cut in half at every step.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Requirements for Binary Search
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            The array must be sorted in ascending (or descending) order.
        </li>

        <li>
            You must be able to access any element directly by its index, which arrays allow.
        </li>

        <li>
            The elements must be comparable, so you can tell whether the key is smaller or larger.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        The Divide-and-Conquer Idea
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Divide and conquer solves a problem by dividing it into smaller parts and solving a part. In binary search, each comparison divides the remaining range into two halves, and only one half is kept. After one step, half of the data remains; after two steps, a quarter; and so on. An array of 1,000,000 elements needs at most about 20 comparisons.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Low, High, and Middle Indexes
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Binary search uses three variables. low is the first index of the range still being searched, high is the last index, and mid is the middle index, calculated as (low + high) / 2. Comparing the key with a[mid] gives three possibilities.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                a[mid] equals the key
            </h4>

            <p class="text-gray-400 mt-2">
                The key is found. Return mid.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                a[mid] is less than the key
            </h4>

            <p class="text-gray-400 mt-2">
                The key must be on the right. Set low = mid + 1.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                a[mid] is greater than the key
            </h4>

            <p class="text-gray-400 mt-2">
                The key must be on the left. Set high = mid - 1.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The search ends when the key is found or when low becomes greater than high, which means the range is empty and the key is not in the array.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Iterative Binary Search
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int binarySearch(int[] a, int key) &#123;
    int low = 0, high = a.length - 1;
    while (low &lt;= high) &#123;
        int mid = low + (high - low) / 2;
        if (a[mid] == key) &#123;
            return mid;
        } else if (a[mid] &lt; key) &#123;
            low = mid + 1;
        } else &#123;
            high = mid - 1;
        }
    }
    return -1;
}

int[] a = &#123;3, 8, 15, 21, 34, 47, 59, 72, 88};
System.out.println("Index of 47: " + binarySearch(a, 47));
System.out.println("Index of 10: " + binarySearch(a, 10));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Index of 47: 5
Index of 10: -1</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The middle is computed as low + (high - low) / 2 instead of (low + high) / 2. Both give the same result, but the first form avoids integer overflow when low and high are very large.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Tracing the Search
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The following version prints what happens at every step so that you can follow the low, high, and mid values.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;3, 8, 15, 21, 34, 47, 59, 72, 88};
int key = 59;
int low = 0, high = a.length - 1, step = 1;

while (low &lt;= high) &#123;
    int mid = low + (high - low) / 2;
    System.out.println("Step " + step++ + ": low=" + low + " high=" + high
            + " mid=" + mid + " a[mid]=" + a[mid]);
    if (a[mid] == key) &#123;
        System.out.println("Found " + key + " at index " + mid);
        break;
    } else if (a[mid] &lt; key) &#123;
        low = mid + 1;
    } else &#123;
        high = mid - 1;
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Step 1: low=0 high=8 mid=4 a[mid]=34
Step 2: low=5 high=8 mid=6 a[mid]=59
Found 59 at index 6</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Recursive Binary Search
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Binary search can also be written with recursion. The method calls itself with a smaller range. The base cases are an empty range (low &gt; high), which returns -1, and a match, which returns mid.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int search(int[] a, int key, int low, int high) &#123;
    if (low &gt; high) return -1;                      // base case: not found
    int mid = low + (high - low) / 2;
    if (a[mid] == key) return mid;                  // base case: found
    if (a[mid] &lt; key) return search(a, key, mid + 1, high);
    return search(a, key, low, mid - 1);
}

int[] a = &#123;3, 8, 15, 21, 34, 47, 59, 72, 88};
System.out.println(search(a, 72, 0, a.length - 1));
System.out.println(search(a, 5, 0, a.length - 1));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>7
-1</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Using the Built-in Method
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java provides Arrays.binarySearch() for sorted arrays. It returns the index if found, and a negative number if not found.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;3, 8, 15, 21, 34};
System.out.println(java.util.Arrays.binarySearch(a, 21));
System.out.println(java.util.Arrays.binarySearch(a, 10) &lt; 0);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>3
true</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Linear Search and Binary Search Compared
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Linear Search
            </h4>

            <p class="text-gray-400 mt-2">
                Data requirement: any array. Basic idea: checks elements sequentially. Simple but slow for large data.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Binary Search
            </h4>

            <p class="text-gray-400 mt-2">
                Data requirement: sorted array. Basic idea: repeatedly divides the search range. Very fast for large data.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Using binary search on an unsorted array, which gives wrong results
        </li>

        <li>
            Setting low = mid or high = mid instead of mid + 1 and mid - 1, which can cause an infinite loop
        </li>

        <li>
            Using while (low &lt; high), which can skip the last remaining element
        </li>

        <li>
            Forgetting that the array must be sorted again after elements are added
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the main requirement of binary search?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The array must be sorted.
        </p>

        <p class="text-white mt-4">
            What happens to the search range after each comparison?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It is cut in half, because the half that cannot contain the key is discarded.
        </p>

        <p class="text-white mt-4">
            When does binary search conclude that the key is not present?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> When low becomes greater than high, meaning the search range is empty.
        </p>

    </div>

</div>

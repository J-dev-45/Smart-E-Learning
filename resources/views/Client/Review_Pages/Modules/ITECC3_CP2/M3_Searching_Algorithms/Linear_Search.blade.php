{{-- TOPIC 3.2: LINEAR SEARCH --}}
<div class="mt-10" id="topic-linear-search">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        3.2 Linear Search
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Linear search, also called sequential search, is the simplest searching algorithm. It starts at the first element and checks each element in order until it finds the key or reaches the end of the array. It works on any array, sorted or not, and that makes it the first choice for small or unsorted data.
    </p>

    <h3 class="text-xl font-bold mt-6">
        How Linear Search Works
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Start at index 0.
        </li>

        <li>
            Compare the element at the current index with the key.
        </li>

        <li>
            If they are equal, the key is found. Return the index.
        </li>

        <li>
            If not, move to the next index.
        </li>

        <li>
            If the end of the array is reached without a match, the key is not in the array. Return -1.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Returning the Position of an Element
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int linearSearch(int[] a, int key) &#123;
    for (int i = 0; i &lt; a.length; i++) &#123;
        if (a[i] == key) &#123;
            return i;                  // found: return the position
        }
    }
    return -1;                         // not found
}

int[] ids = &#123;1023, 1045, 1011, 1067, 1032};
int position = linearSearch(ids, 1067);
if (position != -1) &#123;
    System.out.println("Found at index " + position);
} else &#123;
    System.out.println("Not found");
}
System.out.println("Search 9999: " + linearSearch(ids, 9999));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Found at index 3
Search 9999: -1</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tracing the Search
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key 1067 in {1023, 1045, 1011, 1067, 1032}
        </h4>

        <p class="text-white mt-3">
            Index 0: 1023 is not 1067
        </p>

        <p class="text-gray-400 mt-2">
            Index 1: 1045 is not 1067
        </p>

        <p class="text-gray-400 mt-2">
            Index 2: 1011 is not 1067
        </p>

        <p class="text-gray-400 mt-2">
            Index 3: 1067 matches, so return 3
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Identifying Matching Elements and Counting Occurrences
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If the array may contain the key more than once, do not stop at the first match. Keep going to the end and either count the matches or collect all the positions.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores = &#123;80, 95, 80, 70, 80, 90};
int key = 80;
int count = 0;
for (int i = 0; i &lt; scores.length; i++) &#123;
    if (scores[i] == key) &#123;
        count++;
        System.out.println(key + " found at index " + i);
    }
}
System.out.println(key + " occurs " + count + " time(s)");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>80 found at index 0
80 found at index 2
80 found at index 4
80 occurs 3 time(s)</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Searching Strings and Objects
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When the array holds Strings, compare with the equals() method and not with ==, because == compares references.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int find(String[] a, String key) &#123;
    for (int i = 0; i &lt; a.length; i++) &#123;
        if (a[i].equals(key)) return i;
    }
    return -1;
}

String[] names = &#123;"Ana", "Ben", "Cara", "Dino"};
System.out.println(find(names, "Cara"));
System.out.println(find(names, "Zed"));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>2
-1</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Laboratory 3: Array Search System
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Main &#123;
    public static void main(String[] args) &#123;
        String[] products = &#123;"Rice", "Sugar", "Salt", "Oil", "Flour"};
        double[] prices = &#123;55.5, 62.0, 18.25, 90.0, 48.75};

        String[] requests = &#123;"Salt", "Milk", "Flour"};
        for (String item : requests) &#123;
            int index = search(products, item);
            if (index &gt;= 0) &#123;
                System.out.println(item + " is at position " + index + ", price: " + prices[index]);
            } else &#123;
                System.out.println(item + " is not available");
            }
        }
    }

    static int search(String[] list, String key) &#123;
        for (int i = 0; i &lt; list.length; i++) &#123;
            if (list[i].equalsIgnoreCase(key)) return i;
        }
        return -1;
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Salt is at position 2, price: 18.25
Milk is not available
Flour is at position 4, price: 48.75</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Advantages and Disadvantages
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Advantages
            </h4>

            <p class="text-gray-400 mt-2">
                Very simple. Works on unsorted and sorted data. Needs no extra memory. Works on any type that can be compared.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Disadvantages
            </h4>

            <p class="text-gray-400 mt-2">
                Slow for large arrays, because in the worst case every element is checked. The number of comparisons grows in direct proportion to the size of the array.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In the best case, the key is the first element and only one comparison is needed. In the worst case, the key is the last element or is missing, and n comparisons are needed, where n is the size of the array.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Does linear search require sorted data?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No, it works on any array.
        </p>

        <p class="text-white mt-4">
            How many comparisons does linear search make in the worst case for an array of 1,000 elements?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 1,000, when the key is last or not found.
        </p>

        <p class="text-white mt-4">
            How do you count the occurrences of a key?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Loop through the whole array without stopping and increase a counter at every match.
        </p>

    </div>

</div>

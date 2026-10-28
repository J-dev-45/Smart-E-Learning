{{-- TOPIC 2.2: ONE-DIMENSIONAL ARRAYS --}}
<div class="mt-10" id="topic-one-dimensional-arrays">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.2 One-Dimensional Arrays
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A one-dimensional array is a single row of elements, like a list. Most array tasks you will meet follow the same pattern: use a loop to visit each element and do something with it. In this topic you will practice the standard operations on one-dimensional arrays: creating, traversing, updating, searching, computing totals and averages, finding extremes, counting, and reversing.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Creating and Filling an Array
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] squares = new int[6];
for (int i = 0; i &lt; squares.length; i++) &#123;
    squares[i] = i * i;
}
System.out.println(java.util.Arrays.toString(squares));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[0, 1, 4, 9, 16, 25]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Traversing an Array
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Traversing means visiting every element once. Use a regular for loop when you need the index, and the enhanced for loop when you only need the values.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String[] fruits = &#123;"Apple", "Banana", "Mango"};

for (int i = 0; i &lt; fruits.length; i++) &#123;
    System.out.println(i + ": " + fruits[i]);
}

for (String f : fruits) &#123;
    System.out.print(f + " ");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>0: Apple
1: Banana
2: Mango
Apple Banana Mango </code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Updating Array Elements
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] prices = &#123;100, 200, 300};
for (int i = 0; i &lt; prices.length; i++) &#123;
    prices[i] = prices[i] + 10;          // add 10 to every price
}
System.out.println(java.util.Arrays.toString(prices));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[110, 210, 310]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Searching an Array
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To search, compare each element with the target and stop when it is found. Return the index, or -1 when the value is not in the array.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int indexOf(int[] a, int target) &#123;
    for (int i = 0; i &lt; a.length; i++) &#123;
        if (a[i] == target) return i;
    }
    return -1;
}

int[] data = &#123;42, 17, 85, 3, 60};
System.out.println("Index of 85: " + indexOf(data, 85));
System.out.println("Index of 99: " + indexOf(data, 99));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Index of 85: 2
Index of 99: -1</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Computing the Sum and Average
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] grades = &#123;85, 90, 78, 92, 88};
int sum = 0;
for (int g : grades) &#123;
    sum += g;
}
double average = (double) sum / grades.length;
System.out.println("Sum = " + sum);
System.out.println("Average = " + average);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Sum = 433
Average = 86.6</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Finding the Minimum and Maximum
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Assume the first element is the smallest or largest, then compare it with all the others. Start with the first element, not with 0, because the values may be negative.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] temps = &#123;31, 28, 35, 30, 27};
int min = temps[0], max = temps[0];
for (int i = 1; i &lt; temps.length; i++) &#123;
    if (temps[i] &lt; min) min = temps[i];
    if (temps[i] &gt; max) max = temps[i];
}
System.out.println("Min = " + min + ", Max = " + max);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Min = 27, Max = 35</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Counting Elements
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores = &#123;88, 65, 92, 74, 79, 55, 81};
int passed = 0;
for (int s : scores) &#123;
    if (s &gt;= 75) passed++;
}
System.out.println(passed + " of " + scores.length + " passed");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>4 of 7 passed</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Reversing an Array
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To reverse an array in place, swap the first and last elements, then the second and the second to last, and continue toward the middle. Stop at the middle, otherwise the array would be reversed twice and return to the original order.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;1, 2, 3, 4, 5};
for (int i = 0; i &lt; a.length / 2; i++) &#123;
    int temp = a[i];
    a[i] = a[a.length - 1 - i];
    a[a.length - 1 - i] = temp;
}
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[5, 4, 3, 2, 1]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Laboratory 1: Student Grade Analyzer
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        This program combines several operations. It reads the grades of a class, then reports the average, highest, lowest, and number of students who passed. The grades are stored in the program for the demonstration.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Main &#123;
    public static void main(String[] args) &#123;
        int[] grades = &#123;88, 92, 79, 65, 95, 84, 71};
        int sum = 0, max = grades[0], min = grades[0], passed = 0;

        for (int g : grades) &#123;
            sum += g;
            if (g &gt; max) max = g;
            if (g &lt; min) min = g;
            if (g &gt;= 75) passed++;
        }

        System.out.println("Students: " + grades.length);
        System.out.println("Average:  " + (double) sum / grades.length);
        System.out.println("Highest:  " + max);
        System.out.println("Lowest:   " + min);
        System.out.println("Passed:   " + passed);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Students: 7
Average:  82.0
Highest:  95
Lowest:   65
Passed:   5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Laboratory 2: Temperature Analyzer
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Main &#123;
    public static void main(String[] args) &#123;
        double[] temps = &#123;29.5, 31.0, 33.2, 30.8, 28.4, 32.6, 34.1};
        double total = 0, hottest = temps[0], coolest = temps[0];
        int hotDays = 0;

        for (int i = 0; i &lt; temps.length; i++) &#123;
            total += temps[i];
            if (temps[i] &gt; hottest) hottest = temps[i];
            if (temps[i] &lt; coolest) coolest = temps[i];
            if (temps[i] &gt;= 32) hotDays++;
        }

        System.out.printf("Average: %.2f%n", total / temps.length);
        System.out.println("Hottest: " + hottest);
        System.out.println("Coolest: " + coolest);
        System.out.println("Days at or above 32: " + hotDays);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Average: 31.37
Hottest: 34.1
Coolest: 28.4
Days at or above 32: 3</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why start the minimum search with the first element instead of 0?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because 0 might be smaller than every value in the array, which would give a wrong minimum.
        </p>

        <p class="text-white mt-4">
            Why does the reversing loop stop at length / 2?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Each swap fixes two elements. Continuing past the middle would swap them back.
        </p>

        <p class="text-white mt-4">
            What does indexOf return when the value is not found?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> -1.
        </p>

    </div>

</div>

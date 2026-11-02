{{-- TOPIC 9.3: ITERATION THROUGH ARRAY ELEMENTS AND TWO-DIMENSIONAL ARRAYS --}}
<div class="mt-10" id="topic-iteration-through-array-elements-and-two-dimensional-arrays">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        9.3 Iteration Through Array Elements and Two-Dimensional Arrays
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The real power of arrays appears when they are combined with loops. A loop can visit every element and compute totals, find the largest value, search for an item, or change each element. This is called iteration through the array.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The for Loop with Index
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] scores = &#123;85, 90, 78, 92, 88};
int sum = 0;
for (int i = 0; i &lt; scores.length; i++) &#123;
    sum += scores[i];
}
double average = (double) sum / scores.length;
System.out.println("Sum = " + sum);
System.out.println("Average = " + average);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Sum = 433
Average = 86.6</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Always use i &lt; scores.length as the condition. Using &lt;= would try to read an element that does not exist and cause an ArrayIndexOutOfBoundsException.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Enhanced for Loop (for-each)
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When you only need to read each element and do not need its index, the for-each loop is shorter and safer. It cannot be used to change the elements of a primitive array, because the loop variable is only a copy.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String[] fruits = &#123;"Apple", "Banana", "Mango"};
for (String fruit : fruits) &#123;
    System.out.println(fruit);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Apple
Banana
Mango</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Array Algorithms
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] nums = &#123;42, 17, 85, 3, 60};

// Largest value
int max = nums[0];
for (int i = 1; i &lt; nums.length; i++) &#123;
    if (nums[i] &gt; max) max = nums[i];
}
System.out.println("Max = " + max);

// Smallest value
int min = nums[0];
for (int n : nums) &#123;
    if (n &lt; min) min = n;
}
System.out.println("Min = " + min);

// Linear search
int target = 85, position = -1;
for (int i = 0; i &lt; nums.length; i++) &#123;
    if (nums[i] == target) &#123;
        position = i;
        break;
    }
}
System.out.println("Found at index " + position);

// Reverse printing
for (int i = nums.length - 1; i &gt;= 0; i--) &#123;
    System.out.print(nums[i] + " ");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Max = 85
Min = 3
Found at index 2
60 3 85 17 42 </code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Two-Dimensional Arrays
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A two-dimensional array is an array of arrays, which is like a table with rows and columns. Each element is reached with two indexes: the row first and then the column. It is useful for grids, tables, game boards, and matrices.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            A 3 x 4 Table
        </h4>

        <p class="text-white mt-3">
            Row 0:  1   2   3   4
        </p>

        <p class="text-gray-400 mt-2">
            Row 1:  5   6   7   8
        </p>

        <p class="text-gray-400 mt-2">
            Row 2:  9  10  11  12
        </p>

        <p class="text-gray-400 mt-2">
            table[1][2] is 7. table.length is 3 (rows), table[0].length is 4 (columns).
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] table = new int[3][4];          // 3 rows, 4 columns

int[][] grid = &#123;
    &#123;1, 2, 3, 4},
    &#123;5, 6, 7, 8},
    &#123;9, 10, 11, 12}
};

System.out.println(grid[1][2]);         // 7
grid[0][0] = 100;
System.out.println(grid.length);        // 3 rows
System.out.println(grid[0].length);     // 4 columns</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>7
3
4</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Iterating Through a 2D Array
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Use nested loops: the outer loop goes through the rows and the inner loop goes through the columns of each row.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] grid = &#123;
    &#123;1, 2, 3},
    &#123;4, 5, 6}
};

int total = 0;
for (int row = 0; row &lt; grid.length; row++) &#123;
    for (int col = 0; col &lt; grid[row].length; col++) &#123;
        System.out.print(grid[row][col] + "\t");
        total += grid[row][col];
    }
    System.out.println();
}
System.out.println("Total = " + total);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1	2	3	
4	5	6	
Total = 21</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java also allows jagged arrays, in which each row has a different length, such as int[][] jag = new int[3][]; followed by jag[0] = new int[2];.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Using &lt;= with length, which goes one position past the end.
        </li>

        <li>
            Mixing up rows and columns. The first index is the row.
        </li>

        <li>
            Forgetting that the array size cannot change after creation. Use ArrayList if you need a growing list.
        </li>

        <li>
            Comparing arrays with ==. It compares references. Use Arrays.equals(a, b).
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Which loop condition is correct for visiting every element of an array named data?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> i &lt; data.length
        </p>

        <p class="text-white mt-4">
            How do you get the number of columns of the first row of a 2D array named grid?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> grid[0].length
        </p>

        <p class="text-white mt-4">
            What is the output of the largest-value algorithm if the array is {4, 9, 2}?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 9.
        </p>

    </div>

</div>

{{-- TOPIC 2.3: ARRAY MANIPULATION --}}
<div class="mt-10" id="topic-array-manipulation">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.3 Array Manipulation
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Because an array has a fixed size, operations such as inserting and removing an element are not as simple as they are with a list. They require shifting elements and sometimes creating a new array. Understanding these operations helps you see what is really happening inside the data structures that are provided by Java's libraries.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Inserting an Element
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To insert a value at a position, first move all elements from that position to the end one place to the right, starting from the last element so that nothing is overwritten. Then place the new value in the gap. The array must have free space, so we keep a separate variable, size, that tells how many elements are actually used.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = new int[8];
int size = 5;
a[0] = 10; a[1] = 20; a[2] = 40; a[3] = 50; a[4] = 60;

int pos = 2, value = 30;
for (int i = size; i &gt; pos; i--) &#123;
    a[i] = a[i - 1];                       // shift right
}
a[pos] = value;
size++;

System.out.println(java.util.Arrays.toString(java.util.Arrays.copyOf(a, size)));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[10, 20, 30, 40, 50, 60]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Removing an Element
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To remove an element, move every element after it one place to the left, which overwrites the removed value, and decrease the size.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;10, 20, 30, 40, 50};
int size = 5;
int pos = 1;                               // remove 20

for (int i = pos; i &lt; size - 1; i++) &#123;
    a[i] = a[i + 1];                       // shift left
}
size--;

System.out.println(java.util.Arrays.toString(java.util.Arrays.copyOf(a, size)));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[10, 30, 40, 50]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Updating an Element
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String[] names = &#123;"Ana", "Ben", "Cara"};
names[1] = "Benjamin";
System.out.println(java.util.Arrays.toString(names));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[Ana, Benjamin, Cara]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Copying Arrays
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Writing int[] b = a; does not copy the array. It copies the reference, so both variables point to the same array, and a change through one is seen through the other. To make a real copy, use a loop, clone(), Arrays.copyOf(), or System.arraycopy().
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;1, 2, 3};

int[] alias = a;                           // same array, not a copy
alias[0] = 99;
System.out.println("a[0] after alias change: " + a[0]);

int[] copy1 = a.clone();
int[] copy2 = java.util.Arrays.copyOf(a, a.length);
int[] copy3 = new int[a.length];
System.arraycopy(a, 0, copy3, 0, a.length);

copy1[1] = 55;
System.out.println(java.util.Arrays.toString(a));
System.out.println(java.util.Arrays.toString(copy1));
System.out.println(java.util.Arrays.toString(copy2));
System.out.println(java.util.Arrays.toString(copy3));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>a[0] after alias change: 99
[99, 2, 3]
[99, 55, 3]
[99, 2, 3]
[99, 2, 3]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Combining Arrays
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To combine two arrays, create a new array whose length is the sum of both lengths, then copy the elements of the first array followed by those of the second.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] a = &#123;1, 2, 3};
int[] b = &#123;4, 5};
int[] merged = new int[a.length + b.length];

for (int i = 0; i &lt; a.length; i++) merged[i] = a[i];
for (int j = 0; j &lt; b.length; j++) merged[a.length + j] = b[j];

System.out.println(java.util.Arrays.toString(merged));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[1, 2, 3, 4, 5]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Comparing Arrays
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The == operator compares references, not contents. To check whether two arrays have the same elements in the same order, compare the lengths first, then each element, or use Arrays.equals().
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static boolean sameContent(int[] a, int[] b) &#123;
    if (a.length != b.length) return false;
    for (int i = 0; i &lt; a.length; i++) &#123;
        if (a[i] != b[i]) return false;
    }
    return true;
}

int[] x = &#123;1, 2, 3};
int[] y = &#123;1, 2, 3};

System.out.println(x == y);                          // different objects
System.out.println(java.util.Arrays.equals(x, y));   // same contents
System.out.println(sameContent(x, y));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>false
true
true</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Finding Duplicates
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A simple way to find duplicates is to compare each element with all the elements that come after it, using nested loops. If two are equal, a duplicate has been found.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[] data = &#123;4, 7, 2, 7, 9, 4, 7};
for (int i = 0; i &lt; data.length; i++) &#123;
    for (int j = i + 1; j &lt; data.length; j++) &#123;
        if (data[i] == data[j]) &#123;
            System.out.println("Duplicate: " + data[i] + " at index " + i + " and " + j);
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Duplicate: 4 at index 0 and 5
Duplicate: 7 at index 1 and 3
Duplicate: 7 at index 1 and 6
Duplicate: 7 at index 3 and 6</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        This approach checks about n x n / 2 pairs, so it becomes slower as the array grows. Later, in the algorithm analysis module, you will learn how to describe this cost using Big O notation.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Summary of Manipulation Techniques
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Insert
            </h4>

            <p class="text-gray-400 mt-2">
                Shift elements right from the end, then place the new value.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Remove
            </h4>

            <p class="text-gray-400 mt-2">
                Shift elements left over the removed position.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Copy
            </h4>

            <p class="text-gray-400 mt-2">
                Use clone, Arrays.copyOf, or System.arraycopy. Do not use =.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Compare
            </h4>

            <p class="text-gray-400 mt-2">
                Use Arrays.equals or compare element by element, not ==.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why does insertion shift elements starting from the last one?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> To avoid overwriting elements that have not been moved yet.
        </p>

        <p class="text-white mt-4">
            What does int[] b = a; do?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It makes b refer to the same array as a. It does not create a copy.
        </p>

        <p class="text-white mt-4">
            How can you tell whether two arrays have the same contents?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Use Arrays.equals() or compare lengths and elements one by one. The == operator compares references only.
        </p>

    </div>

</div>

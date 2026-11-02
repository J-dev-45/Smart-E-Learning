{{-- TOPIC 10.2: PASS BY VALUE AND PASS BY REFERENCE --}}
<div class="mt-10" id="topic-pass-by-value-and-pass-by-reference">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        10.2 Pass by Value and Pass by Reference
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When you call a method and give it an argument, what exactly is passed to the method? Is it the variable itself or a copy of the value? The answer decides whether the method can change the original data. Understanding this prevents a lot of confusing bugs.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Java Is Always Pass by Value
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In Java, every argument is passed by value, which means the method receives a copy of the argument. For primitive types such as int and double, the copy is of the actual value, so the method cannot change the original variable. For objects and arrays, the copy is of the reference (the address), so both the original variable and the parameter point to the same object. This behaves like pass by reference for the contents of the object, but Java itself always copies what is passed.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Primitive Types: The Original Does Not Change
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void addTen(int number) &#123;
    number = number + 10;
    System.out.println("Inside method: " + number);
}

public static void main(String[] args) &#123;
    int x = 5;
    addTen(x);
    System.out.println("After call: " + x);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Inside method: 15
After call: 5</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The parameter number is a separate copy of x. Changing the copy does not touch the original.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            What Happens in Memory
        </h4>

        <p class="text-white mt-3">
            x holds 5
        </p>

        <p class="text-gray-400 mt-2">
            The call copies 5 into number
        </p>

        <p class="text-gray-400 mt-2">
            number becomes 15, but x is still 5
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Arrays and Objects: The Contents Can Change
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void doubleAll(int[] data) &#123;
    for (int i = 0; i &lt; data.length; i++) &#123;
        data[i] = data[i] * 2;
    }
}

public static void main(String[] args) &#123;
    int[] nums = &#123;1, 2, 3};
    doubleAll(nums);
    System.out.println(java.util.Arrays.toString(nums));
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[2, 4, 6]</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The parameter data holds a copy of the reference, which points to the same array as nums. Because both refer to the same array, changes to the elements made inside the method are visible outside.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Reassigning the Reference Does Not Change the Original
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void replaceArray(int[] data) &#123;
    data = new int[]&#123;9, 9, 9};     // only the local copy now points to a new array
}

public static void main(String[] args) &#123;
    int[] nums = &#123;1, 2, 3};
    replaceArray(nums);
    System.out.println(java.util.Arrays.toString(nums));
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[1, 2, 3]</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        This shows that Java passes the reference by value. The method can modify the object it points to, but it cannot make the caller's variable point to a different object.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Strings Are Safe
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Since String objects are immutable, a method cannot change the contents of the caller's string. Operations create a new string instead.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void shout(String text) &#123;
    text = text.toUpperCase();
}

public static void main(String[] args) &#123;
    String word = "hello";
    shout(word);
    System.out.println(word);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>hello</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        How to Get a Changed Value Back
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Return the Result
            </h4>

            <p class="text-gray-400 mt-2">
                Return the new value and store it: x = addTen(x);
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Pass an Array or Object
            </h4>

            <p class="text-gray-400 mt-2">
                Let the method change its contents, such as an array of results.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int addTen(int number) &#123;
    return number + 10;
}

public static void main(String[] args) &#123;
    int x = 5;
    x = addTen(x);
    System.out.println(x);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>15</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Comparison
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Pass by Value (primitives)
            </h4>

            <p class="text-gray-400 mt-2">
                The method gets a copy of the value. The original variable is never changed by the method.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Pass by Value of a Reference (objects, arrays)
            </h4>

            <p class="text-gray-400 mt-2">
                The method gets a copy of the address. It can change the object's contents, but cannot change which object the caller's variable refers to.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Pass by Reference (in languages such as C++)
            </h4>

            <p class="text-gray-400 mt-2">
                The method gets the variable itself. Java does not have this, which is why it cannot swap two int variables using a method.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Can a method change the value of an int variable passed to it?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No. The method receives a copy, so the original variable stays the same.
        </p>

        <p class="text-white mt-4">
            Why can a method change the elements of an array that is passed to it?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because the method receives a copy of the reference, so it points to the same array in memory.
        </p>

        <p class="text-white mt-4">
            How can a method give back a changed primitive value?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> By returning it with return and storing the result in the caller.
        </p>

    </div>

</div>

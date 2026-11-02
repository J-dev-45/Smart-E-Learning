{{-- TOPIC 8.1: STRINGS, LENGTH(), TOUPPER, AND TOLOWER --}}
<div class="mt-10" id="topic-strings-length-toupper-and-tolower">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.1 Strings, Length(), ToUpper, and ToLower
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A string is a sequence of characters, such as a word, a sentence, or even an empty piece of text. Strings are used everywhere in programs: names, messages, passwords, file paths, and web addresses. In Java, String is a class, not a primitive type, so a String is an object and has many built-in methods you can call with the dot operator.
    </p>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            A Note About Method Names
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            The course outline lists the string operations with names such as Replace(), Remove(), Trim(), ToUpper, and Length(). These are the names used in C#. In Java the same operations exist, but the names start with a lowercase letter, and a few have different names. This chapter teaches the Java version of every method and shows the matching C# name.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Creating Strings
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String s1 = "Hello";                  // string literal
String s2 = new String("Hello");      // using new
String empty = "";                    // empty string
String name = "Ana";
System.out.println(s1 + ", " + name);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Hello, Ana</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Strings Are Immutable
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Once a String object is created, its contents cannot be changed. Methods such as toUpperCase or replace do not change the original string. They return a new string with the result, and you must store it if you want to keep it. This is one of the most important facts about strings.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String text = "java";
text.toUpperCase();                  // result is thrown away
System.out.println(text);            // still java

text = text.toUpperCase();           // keep the result
System.out.println(text);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>java
JAVA</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        length()
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The length() method returns the number of characters in the string, including spaces and punctuation. Note that for strings, length is a method and needs parentheses, while for arrays, length is a field without parentheses. In C# this is the Length property.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String word = "Programming";
System.out.println(word.length());
System.out.println("Hi there".length());
System.out.println("".length());</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>11
8
0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Character Positions (Index)
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Each character in a string has a position called an index. The first character is at index 0 and the last is at length() - 1. The charAt(index) method returns the character at a given position.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Indexes of "JAVA"
        </h4>

        <p class="text-white mt-3">
            J is at index 0
        </p>

        <p class="text-gray-400 mt-2">
            A is at index 1
        </p>

        <p class="text-gray-400 mt-2">
            V is at index 2
        </p>

        <p class="text-gray-400 mt-2">
            A is at index 3, and length() is 4
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String s = "JAVA";
System.out.println(s.charAt(0));
System.out.println(s.charAt(s.length() - 1));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>J
A</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Using an index that is not inside the string, such as s.charAt(10), causes a StringIndexOutOfBoundsException.
    </p>

    <h3 class="text-xl font-bold mt-6">
        toUpperCase() and toLowerCase()
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        These methods return a new string with all letters converted to uppercase or lowercase. In C# they are ToUpper() and ToLower(). They are very useful for comparing text without worrying about capital letters, or for formatting names.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String name = "Maria Santos";
System.out.println(name.toUpperCase());
System.out.println(name.toLowerCase());

String answer = "YES";
if (answer.toLowerCase().equals("yes")) &#123;
    System.out.println("Accepted");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>MARIA SANTOS
maria santos
Accepted</code></pre>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                C# Name
            </h4>

            <p class="text-gray-400 mt-2">
                Length, ToUpper(), ToLower()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Java Name
            </h4>

            <p class="text-gray-400 mt-2">
                length(), toUpperCase(), toLowerCase()
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Other Handy Methods
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                isEmpty()
            </h4>

            <p class="text-gray-400 mt-2">
                true if the length is 0.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                equals() and equalsIgnoreCase()
            </h4>

            <p class="text-gray-400 mt-2">
                Compare contents, with or without matching case.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                contains("abc")
            </h4>

            <p class="text-gray-400 mt-2">
                true if the text includes the given piece.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                indexOf("x")
            </h4>

            <p class="text-gray-400 mt-2">
                Position of the first match, or -1 if not found.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                startsWith() and endsWith()
            </h4>

            <p class="text-gray-400 mt-2">
                Check how a string begins or ends.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                compareTo()
            </h4>

            <p class="text-gray-400 mt-2">
                Compares two strings alphabetically.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why does text.toUpperCase(); alone not change the variable text?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because strings are immutable. The method returns a new string, which must be stored in a variable.
        </p>

        <p class="text-white mt-4">
            What is the index of the first character in a string?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 0.
        </p>

        <p class="text-white mt-4">
            What is the Java equivalent of C#'s Length and ToUpper()?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> length() and toUpperCase().
        </p>

    </div>

</div>

{{-- TOPIC 8.3: TRIM(), TRIMSTART(), TRIMEND(), AND SUBSTRING --}}
<div class="mt-10" id="topic-trim-trimstart-trimend-and-substring">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.3 Trim(), TrimStart(), TrimEnd(), and Substring
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        User input and data from files often contain extra spaces at the beginning or end, and programs often need only a part of a string, such as the first name from a full name or the year from a date. This lesson covers the methods for removing whitespace and for extracting pieces of text.
    </p>

    <h3 class="text-xl font-bold mt-6">
        trim()
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The trim() method removes whitespace (spaces, tabs, and new lines) from both the start and the end of a string. It does not remove spaces between words. In C# the method is Trim().
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String input = "   Ana Reyes   ";
System.out.println("[" + input + "]");
System.out.println("[" + input.trim() + "]");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[   Ana Reyes   ]
[Ana Reyes]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        TrimStart() and TrimEnd
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        C# provides TrimStart() to remove whitespace only from the beginning and TrimEnd() to remove it only from the end. Java 11 added the equivalent methods stripLeading() and stripTrailing(), along with strip(), which works like trim() but handles all Unicode whitespace.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String s = "   Java   ";
System.out.println("[" + s.stripLeading() + "]");   // like TrimStart
System.out.println("[" + s.stripTrailing() + "]");  // like TrimEnd
System.out.println("[" + s.strip() + "]");          // like Trim</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[Java   ]
[   Java]
[Java]</code></pre>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                C# Name
            </h4>

            <p class="text-gray-400 mt-2">
                Trim(), TrimStart(), TrimEnd()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Java Name
            </h4>

            <p class="text-gray-400 mt-2">
                trim() or strip(), stripLeading(), stripTrailing()
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        substring()
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The substring() method returns a part of a string. It has two forms. substring(start) returns everything from the start index to the end. substring(start, end) returns the characters from start up to, but not including, end. In C# the method is Substring(start, length), where the second value is the number of characters, not an end index.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Indexes of "Programming"
        </h4>

        <p class="text-white mt-3">
            P r o g r a m m i n g
        </p>

        <p class="text-gray-400 mt-2">
            0 1 2 3 4 5 6 7 8 9 10
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String word = "Programming";
System.out.println(word.substring(3));        // gramming
System.out.println(word.substring(0, 3));     // Pro
System.out.println(word.substring(3, 7));     // gram
System.out.println(word.substring(word.length() - 3));   // ing</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>gramming
Pro
gram
ing</code></pre>
    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Java vs C# Difference
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Java: substring(startIndex, endIndex), where endIndex is excluded. C#: Substring(startIndex, length). For example, "Programming".substring(3, 7) in Java is the same as "Programming".Substring(3, 4) in C#.
        </p>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Using an index that is out of range throws a StringIndexOutOfBoundsException. Always make sure that start is at least 0 and end is not larger than length().
    </p>

    <h3 class="text-xl font-bold mt-6">
        Combining Methods
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String fullName = "  Maria Clara Santos ";
fullName = fullName.trim();

int space = fullName.indexOf(" ");
String firstName = fullName.substring(0, space);
String lastName = fullName.substring(fullName.lastIndexOf(" ") + 1);

System.out.println("First: " + firstName);
System.out.println("Last: " + lastName);

String date = "2026-10-20";
String year = date.substring(0, 4);
String month = date.substring(5, 7);
System.out.println(year + " / " + month);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>First: Maria
Last: Santos
2026 / 10</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: Making the First Letter Uppercase
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String word = "java";
String capitalized = word.substring(0, 1).toUpperCase() + word.substring(1);
System.out.println(capitalized);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Java</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: Counting a Character in a String
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String text = "banana";
int count = 0;
for (int i = 0; i &lt; text.length(); i++) &#123;
    if (text.charAt(i) == 'a') &#123;
        count++;
    }
}
System.out.println("a appears " + count + " times");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>a appears 3 times</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Summary of the String Methods in This Chapter
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Length
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                C# Length, Java length()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Uppercase and Lowercase
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                C# ToUpper() and ToLower(), Java toUpperCase() and toLowerCase()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Join
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                C# Concat(), Java concat() or +
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Replace
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                C# Replace(), Java replace()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Remove
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                C# Remove(), Java substring() with +, replace(), or StringBuilder.delete()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Trim
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                C# Trim(), TrimStart(), TrimEnd(), Java trim() or strip(), stripLeading(), stripTrailing()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Substring
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                C# Substring(start, length), Java substring(start, end)
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does "Programming".substring(0, 3) return?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> "Pro", the characters at index 0, 1, and 2.
        </p>

        <p class="text-white mt-4">
            Which Java method works like C#'s TrimEnd()?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> stripTrailing().
        </p>

        <p class="text-white mt-4">
            What is the difference between Java's substring(3, 7) and C#'s Substring(3, 7)?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> In Java the second value is the end index (excluded), while in C# it is the number of characters to take.
        </p>

    </div>

</div>

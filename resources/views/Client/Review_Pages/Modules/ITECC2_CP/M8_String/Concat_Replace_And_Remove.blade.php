{{-- TOPIC 8.2: CONCAT(), REPLACE(), AND REMOVE() --}}
<div class="mt-10" id="topic-concat-replace-and-remove">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.2 Concat(), Replace(), and Remove()
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Joining, changing, and deleting parts of text are among the most common string operations. For example, a program may combine a first and a last name, correct a spelling, or remove unwanted characters from user input.
    </p>

    <h3 class="text-xl font-bold mt-6">
        concat() and the + Operator
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The concat() method joins one string to the end of another and returns a new string. Most programmers prefer the + operator because it is shorter and works with other types too. In C# the method is Concat().
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String first = "Juan";
String last = "Dela Cruz";

String full1 = first.concat(" ").concat(last);
String full2 = first + " " + last;

System.out.println(full1);
System.out.println(full2);
System.out.println("Age: " + 20);     // + converts the number to text</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Juan Dela Cruz
Juan Dela Cruz
Age: 20</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The concat() method accepts only a String argument, but + can join a String with numbers, characters, and other values. Joining many strings inside a loop with + creates many temporary objects, so for large amounts of text, use the StringBuilder class.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>StringBuilder sb = new StringBuilder();
for (int i = 1; i &lt;= 5; i++) &#123;
    sb.append(i).append(" ");
}
System.out.println(sb.toString());</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1 2 3 4 5 </code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        replace()
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The replace() method returns a new string in which every occurrence of a character or piece of text is replaced with another. In C# it is Replace().
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String text = "I like Java. Java is fun.";
System.out.println(text.replace("Java", "Python"));
System.out.println("banana".replace('a', 'o'));
System.out.println("a-b-c".replace("-", ""));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>I like Python. Python is fun.
bonono
abc</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Remember that the original string does not change. Also, replace() is case-sensitive, so "java" would not match "Java". There are also replaceFirst() and replaceAll(), which use patterns called regular expressions.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String phone = "0917-123-4567";
String digitsOnly = phone.replaceAll("[^0-9]", "");
System.out.println(digitsOnly);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>09171234567</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Remove: What Is the Java Equivalent?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        C# has a Remove() method that deletes characters starting from a position. Java's String class has no remove() method, but you can get the same result in several ways.
    </p>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Using replace()
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                To delete all occurrences of a character or word, replace it with an empty string: "hello".replace("l", "") gives "heo".
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Using substring()
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                To delete a range, join the part before and the part after: s.substring(0, start) + s.substring(end).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Using StringBuilder
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                StringBuilder has delete(start, end) and deleteCharAt(index), which change the text in place.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String s = "Hello, World!";

// remove the first 7 characters (like C# s.Remove(0, 7))
String a = s.substring(7);
System.out.println(a);

// remove 5 characters starting at index 7 (like C# s.Remove(7, 5))
String b = s.substring(0, 7) + s.substring(12);
System.out.println(b);

// remove all spaces
String c = "a b c d".replace(" ", "");
System.out.println(c);

// StringBuilder
StringBuilder sb = new StringBuilder("Hello, World!");
sb.delete(5, 7);                   // removes ", "
System.out.println(sb);
sb.deleteCharAt(0);
System.out.println(sb);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>World!
Hello, !
abcd
HelloWorld!
elloWorld!</code></pre>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                C# Name
            </h4>

            <p class="text-gray-400 mt-2">
                Concat(), Replace(), Remove(start, count)
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Java Name
            </h4>

            <p class="text-gray-400 mt-2">
                concat() or +, replace(), substring() or StringBuilder.delete()
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Practice: Cleaning User Input
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String raw = "  juan   DELA cruz ";
String cleaned = raw.trim().replaceAll("\\s+", " ").toLowerCase();
System.out.println("[" + cleaned + "]");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[juan dela cruz]</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does "banana".replace('a', 'o') return?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> "bonono".
        </p>

        <p class="text-white mt-4">
            Does Java have a remove() method for strings?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No. You use replace() with an empty string, substring(), or StringBuilder's delete methods.
        </p>

        <p class="text-white mt-4">
            Why can concat() be less convenient than +?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> concat() accepts only strings, while + can join a string with numbers and other values.
        </p>

    </div>

</div>

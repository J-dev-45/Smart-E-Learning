{{-- TOPIC 1.3: PROCEDURAL PROGRAMMING AND PROGRAMMING PARADIGMS --}}
<div class="mt-10" id="topic-procedural-programming-and-programming-paradigms">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.3 Procedural Programming and Programming Paradigms
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A programming paradigm is a style or way of organizing a program. Different paradigms suggest different ways of thinking about a problem and structuring the code. You will study procedural programming first, because you already use it, and then compare it with other paradigms, especially object-oriented programming.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Procedural Programming?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Procedural programming organizes a program as a sequence of steps and groups the steps into procedures, also called functions or methods. The data and the procedures that work on the data are kept separate. The program runs from top to bottom, calling procedures when needed. Languages such as C, Pascal, and early BASIC were designed this way, and you can write in this style in Java as well.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void printResult(String name, int grade) &#123;
    String status = grade &gt;= 75 ? "Passed" : "Failed";
    System.out.println(name + ": " + grade + " - " + status);
}

String[] names = &#123;"Ana", "Ben", "Cara"};
int[] grades = &#123;90, 72, 85};

for (int i = 0; i &lt; names.length; i++) &#123;
    printResult(names[i], grades[i]);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana: 90 - Passed
Ben: 72 - Failed
Cara: 85 - Passed</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In this example the names and the grades are stored in two separate arrays, called parallel arrays, and the procedure receives the pieces of data it needs. This works well for small programs.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Strengths and Limitations of the Procedural Style
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Strengths
            </h4>

            <p class="text-gray-400 mt-2">
                Simple and easy to learn. Code follows a clear order. Good for small programs and quick scripts. Procedures can be reused.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Limitations
            </h4>

            <p class="text-gray-400 mt-2">
                Data and actions are separate, so many parallel arrays are needed as programs grow. Any procedure can change the data, so mistakes spread easily. Large programs become hard to maintain.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Other Programming Paradigms
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Procedural
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A program is a series of procedures that operate on data. Example: C.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Object-Oriented
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A program is a collection of objects that combine data and behavior and communicate with each other. Examples: Java, C#, Python.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Functional
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A program is built from functions that avoid changing data. Examples: Haskell and parts of modern JavaScript and Java.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Event-Driven
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A program responds to events such as clicks and key presses. Used in graphical applications and web pages.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Declarative
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                You describe what result you want rather than the steps to get it. Example: SQL and HTML.
            </p>
        </div>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            One Language, Many Paradigms
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Most modern languages, including Java, support more than one paradigm. Java is built around objects, but you can still use procedural ideas inside the methods you write. A good programmer picks the style that suits the problem.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Why Move Beyond Procedural Code?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Imagine a school with thousands of students, each having a name, ID, course, year level, and grades. With procedural code you would manage many arrays that must always be kept in the same order. Deleting one student means shifting every array. The data for a student is scattered, and any procedure could accidentally change it. Object-oriented programming solves this by grouping the data of one student, and the actions on it, into one unit.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What are parallel arrays?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Separate arrays whose elements at the same index belong to the same item, such as names[i] and grades[i].
        </p>

        <p class="text-white mt-4">
            Name two programming paradigms.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Procedural and object-oriented. Functional and event-driven are also paradigms.
        </p>

        <p class="text-white mt-4">
            What is one limitation of procedural programming in large programs?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Data and procedures are separate, so related data is scattered and can be changed accidentally by any procedure.
        </p>

    </div>

</div>

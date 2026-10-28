{{-- TOPIC 2.2: COMMENTS, MEMBER VARIABLES, AND MEMBER FUNCTIONS --}}
<div class="mt-10" id="topic-comments-member-variables-and-member-functions">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.2 Comments, Member Variables, and Member Functions
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Comments in Java
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Comments are notes written for humans. The compiler ignores them completely. Good comments explain why the code does something or describe what a section is for, which makes programs easier to understand, fix, and update later.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>// This is a single-line comment

/* This is a
   multi-line comment */

/**
 * This is a Javadoc comment.
 * It is used to document classes and methods.
 */</code></pre>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Single-Line //
            </h4>

            <p class="text-gray-400 mt-2">
                Everything from the two slashes to the end of the line is ignored.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Multi-Line /* */
            </h4>

            <p class="text-gray-400 mt-2">
                Everything between the markers is ignored, even across many lines.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Javadoc /** */
            </h4>

            <p class="text-gray-400 mt-2">
                Special comments that tools can turn into documentation pages.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Do not comment every obvious line, such as "add 1 to x" above x++. Write comments that add information, and keep them updated when the code changes. You can also comment out a line of code temporarily to test your program without it.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Classes, Member Variables, and Member Functions
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A class is a blueprint that describes a kind of object. It contains members. Member variables, also called fields or attributes, store the data of an object, such as a student's name and grade. Member functions, called methods in Java, are the actions an object can perform, such as displaying its information. Together they combine data and behavior in one unit, which is the main idea of object-oriented programming.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Student &#123;
    // Member variables (fields)
    String name;
    int grade;

    // Member functions (methods)
    void displayInfo() &#123;
        System.out.println("Name: " + name);
        System.out.println("Grade: " + grade);
    }

    boolean hasPassed() &#123;
        return grade &gt;= 75;
    }
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Member Variables in More Detail
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Declared inside the class but outside any method.
        </li>

        <li>
            Each object gets its own copy of instance variables, so two students can have different names.
        </li>

        <li>
            If you do not assign a value, Java gives fields default values: 0 for numbers, false for boolean, and null for objects.
        </li>

        <li>
            A variable declared with the static keyword belongs to the class and is shared by all objects.
        </li>

        <li>
            Access modifiers such as public and private control who can use them. It is good practice to make fields private and access them through methods.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Member Functions in More Detail
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A method declaration has a return type, a name, a parameter list, and a body. The return type says what kind of value the method gives back, or void if it returns nothing. Parameters are inputs the method receives. The return statement sends a value back to the caller.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>returnType methodName(parameterList) &#123;
    // statements
    return value;   // omitted when the return type is void
}</code></pre>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: A Method with Parameters
        </h4>

        <p class="text-white mt-3">
            int add(int a, int b) { return a + b; }
        </p>

        <p class="text-gray-400 mt-2">
            Calling add(3, 4) gives 7.
        </p>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between a member variable and a member function?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A member variable stores data of an object, while a member function defines an action the object can perform.
        </p>

        <p class="text-white mt-4">
            Does the compiler read comments?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No, comments are ignored by the compiler and are only for human readers.
        </p>

        <p class="text-white mt-4">
            What default value does an int field have if it is not assigned?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 0.
        </p>

    </div>

</div>

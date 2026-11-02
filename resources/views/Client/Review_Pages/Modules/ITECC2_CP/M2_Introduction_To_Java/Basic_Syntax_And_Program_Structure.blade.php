{{-- TOPIC 2.1: BASIC SYNTAX AND JAVA PROGRAM STRUCTURE --}}
<div class="mt-10" id="topic-basic-syntax-and-java-program-structure">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.1 Basic Syntax and Java Program Structure
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java is a popular, general-purpose, object-oriented programming language. It was created by James Gosling and his team at Sun Microsystems and released in 1995, and it is now owned by Oracle. Its famous slogan is "Write Once, Run Anywhere", which means a Java program written on one computer can run on any computer that has a Java Virtual Machine. Java is used for Android apps, banking and business systems, web servers, and many large applications.
    </p>

    <h3 class="text-xl font-bold mt-6">
        JDK, JRE, and JVM
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                JVM (Java Virtual Machine)
            </h4>

            <p class="text-gray-400 mt-2">
                The program that runs Java bytecode. Each operating system has its own JVM, which makes Java portable.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                JRE (Java Runtime Environment)
            </h4>

            <p class="text-gray-400 mt-2">
                The JVM plus the standard libraries needed to run Java programs.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                JDK (Java Development Kit)
            </h4>

            <p class="text-gray-400 mt-2">
                The JRE plus tools for developers, such as the compiler (javac). You need the JDK to write and compile Java programs.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Your First Java Program
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class HelloWorld &#123;
    public static void main(String[] args) &#123;
        System.out.println("Hello, World!");
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Hello, World!</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Understanding Each Line
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                public class HelloWorld
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Declares a class named HelloWorld. In Java all code must be inside a class. The word public means it can be accessed from anywhere.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                public static void main(String[] args)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The main method is the entry point. The JVM starts running the program here. Public makes it accessible to the JVM, static means it can run without creating an object, void means it returns nothing, and String[] args holds any command-line arguments.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                System.out.println("Hello, World!");
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Prints the text to the console and moves to a new line. System is a class, out is the standard output, and println is the method that prints.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Curly braces { }
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Mark the start and end of a block of code, such as the body of a class or a method.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Semicolon ;
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Ends a statement, just like a period ends a sentence.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Basic Syntax Rules
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Java is case-sensitive. Main, main, and MAIN are three different names.
        </li>

        <li>
            The class name must match the file name. A class named HelloWorld must be saved as HelloWorld.java.
        </li>

        <li>
            Every statement ends with a semicolon.
        </li>

        <li>
            Every opening brace must have a closing brace, and indentation makes code easier to read.
        </li>

        <li>
            The program starts running in the main method.
        </li>

        <li>
            Extra spaces and blank lines are ignored by the compiler, but they help human readers.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        General Structure of a Java File
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>package school;                 // 1. optional package declaration

import java.util.Scanner;       // 2. import statements

public class Demo &#123;             // 3. class declaration
    public static void main(String[] args) &#123;   // 4. main method
        // 5. statements go here
    }
}</code></pre>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Import statements allow your program to use classes from Java's libraries, such as Scanner for keyboard input. Classes in java.lang, like String and System, are imported automatically.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why must the file name match the public class name?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because the Java compiler requires a public class to be stored in a file with the same name, with the .java extension.
        </p>

        <p class="text-white mt-4">
            Which method is the starting point of a Java program?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The main method.
        </p>

        <p class="text-white mt-4">
            Is Java case-sensitive?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Yes. For example, System and system are different.
        </p>

    </div>

</div>

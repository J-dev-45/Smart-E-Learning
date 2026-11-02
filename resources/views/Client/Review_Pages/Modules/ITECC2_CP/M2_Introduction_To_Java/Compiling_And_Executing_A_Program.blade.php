{{-- TOPIC 2.4: COMPILING AND EXECUTING A JAVA PROGRAM --}}
<div class="mt-10" id="topic-compiling-and-executing-a-java-program">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.4 Compiling and Executing a Java Program
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Writing code is only the first step. A Java program must be compiled and then executed. Understanding this process helps you understand error messages and why Java programs can run on different computers.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Compile and Run Process
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1. Write the Source Code
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Type the program in a text editor or IDE and save it with the .java extension, for example HelloWorld.java.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                2. Compile with javac
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The Java compiler checks the syntax and translates the source code into bytecode. If there are errors, they are listed and no bytecode is produced. A successful compile creates HelloWorld.class.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                3. Execute with java
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The java command starts the Java Virtual Machine, which loads the bytecode and runs it, starting at the main method.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>javac HelloWorld.java
java HelloWorld</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Hello, World!</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Notice that you compile with the file name including .java, but you run using the class name without .class.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Why Bytecode?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Bytecode is an intermediate form that is not specific to any processor. Each operating system has its own JVM that understands the same bytecode, so the same HelloWorld.class file can run on Windows, macOS, or Linux. This is how Java achieves "Write Once, Run Anywhere".
    </p>

    <h3 class="text-xl font-bold mt-6">
        Setting Up Java
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Install a JDK, for example the one from Oracle or the open-source OpenJDK.
        </li>

        <li>
            Check that it is installed by typing java -version and javac -version in the terminal.
        </li>

        <li>
            Use a text editor and the terminal, or an IDE such as IntelliJ IDEA, Eclipse, NetBeans, or Visual Studio Code with the Java extensions.
        </li>

        <li>
            An IDE highlights syntax errors, completes code for you, and runs the program with one click.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Common Errors and What They Mean
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                error: ";" expected
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A semicolon is missing at the end of a statement. Check the line shown and the one before it.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                error: cannot find symbol
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                You used a name that has not been declared or misspelled one, for example Sytem instead of System, or a variable that does not exist.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                error: class X is public, should be declared in a file named X.java
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The file name does not match the public class name.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Error: Could not find or load main class
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                You are running the wrong name, or you are in the wrong folder, or the class has not been compiled.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Exception in thread "main" ...
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A runtime error. Read the exception name and the line number to find the cause.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Compile-Time Versus Runtime
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Compile-time errors, such as syntax mistakes, are found by the compiler before the program runs. Runtime errors, such as dividing by zero, appear while the program is running. Logic errors are not detected by either, so you must test the program with different inputs.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does the javac command do?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It compiles the Java source code (.java) into bytecode (.class).
        </p>

        <p class="text-white mt-4">
            Which file does the JVM run?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The .class file that contains the bytecode.
        </p>

        <p class="text-white mt-4">
            What does "cannot find symbol" usually mean?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A variable, method, or class name is misspelled or was not declared.
        </p>

    </div>

</div>

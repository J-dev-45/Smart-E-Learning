{{-- TOPIC 1.3: THE PROGRAM DEVELOPMENT LIFE CYCLE --}}
<div class="mt-10" id="topic-the-program-development-life-cycle">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.3 The Program Development Life Cycle
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Good programs are not written by typing code right away. Professional programmers follow a series of steps called the Program Development Life Cycle (PDLC). Following the steps saves time, reduces errors, and produces programs that actually solve the user's problem.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Phases of the PDLC
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1. Problem Analysis
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Understand the problem completely. Ask what the program must do, what data goes in (input), what results come out (output), and what rules or limits apply. A program built on a misunderstood problem will fail no matter how well it is coded.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                2. Design
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Plan the solution before coding. Programmers write an algorithm, pseudocode, or a flowchart that shows the steps and the logic, and decide on the variables and structure to use.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                3. Coding
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Translate the design into a programming language, such as Java, following the language's syntax and good style.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                4. Testing and Debugging
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Run the program with different test data, including normal, unusual, and wrong inputs, to find errors. Debugging is the process of finding and fixing them.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                5. Implementation (Deployment)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Install and deliver the program to its users, and train them if needed.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                6. Maintenance and Documentation
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Fix problems found by users, add new features, and keep written documentation so others can understand the program later.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Worked Example: Area of a Rectangle
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Applying the Phases
        </h4>

        <p class="text-white mt-3">
            Analysis: Input is the length and width. Output is the area. Rule: area = length x width.
        </p>

        <p class="text-gray-400 mt-2">
            Design: Start, read length, read width, compute area, display area, end.
        </p>

        <p class="text-gray-400 mt-2">
            Coding: write the Java statements.
        </p>

        <p class="text-gray-400 mt-2">
            Testing: length 5 and width 4 should give 20.
        </p>

        <p class="text-gray-400 mt-2">
            Maintenance: later add a check so that negative numbers are rejected.
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>import java.util.Scanner;

public class RectangleArea &#123;
    public static void main(String[] args) &#123;
        Scanner input = new Scanner(System.in);
        System.out.print("Enter length: ");
        double length = input.nextDouble();
        System.out.print("Enter width: ");
        double width = input.nextDouble();
        double area = length * width;
        System.out.println("Area = " + area);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Enter length: 5
Enter width: 4
Area = 20.0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Types of Programming Errors
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Syntax Errors
            </h4>

            <p class="text-gray-400 mt-2">
                Break the rules of the language, such as a missing semicolon or a misspelled keyword. The compiler finds them and the program will not run until they are fixed.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Runtime Errors
            </h4>

            <p class="text-gray-400 mt-2">
                Happen while the program is running, such as dividing by zero or reading a file that does not exist. The program stops with an exception.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Logic Errors
            </h4>

            <p class="text-gray-400 mt-2">
                The program runs but gives wrong results because the logic is wrong, such as using + instead of *. They are the hardest to find because there is no error message.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Debugging Techniques
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Read the error message carefully. It usually names the file, the line number, and the problem.
        </li>

        <li>
            Trace the program by hand with sample values, like a computer would.
        </li>

        <li>
            Print the values of variables at different points to see where they go wrong.
        </li>

        <li>
            Use the debugger in your IDE to run the program one line at a time.
        </li>

        <li>
            Explain the code out loud, line by line, to a friend or even an object. Many bugs are found this way.
        </li>

        <li>
            Change one thing at a time and test again.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why is the analysis phase the first step?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because the programmer must fully understand the problem, inputs, and outputs before designing a solution.
        </p>

        <p class="text-white mt-4">
            Which type of error produces no error message but gives wrong results?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A logic error.
        </p>

        <p class="text-white mt-4">
            What is the purpose of the maintenance phase?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> To fix problems, add new features, and keep the program working and documented after delivery.
        </p>

    </div>

</div>

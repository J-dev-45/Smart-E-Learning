{{-- TOPIC 5.2: CONSOLE INPUT --}}
<div class="mt-10" id="topic-console-input">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        5.2 Console Input
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Most useful programs need data from the user. In Java, the easiest way to read input from the console is the Scanner class, which is part of the java.util package. A Scanner reads the characters typed by the user from System.in and converts them into the type you need.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Steps to Read Input
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Import the Scanner class with import java.util.Scanner;
        </li>

        <li>
            Create a Scanner object connected to System.in.
        </li>

        <li>
            Display a prompt so the user knows what to type.
        </li>

        <li>
            Call the right method to read the value and store it in a variable.
        </li>

        <li>
            Close the Scanner when you are finished.
        </li>

    </ul>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>import java.util.Scanner;

public class Greeting &#123;
    public static void main(String[] args) &#123;
        Scanner input = new Scanner(System.in);

        System.out.print("Enter your name: ");
        String name = input.nextLine();

        System.out.print("Enter your age: ");
        int age = input.nextInt();

        System.out.println("Hello, " + name + "! You are " + age + ".");
        input.close();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Enter your name: Ana
Enter your age: 19
Hello, Ana! You are 19.</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Scanner Methods
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                nextInt()
            </h4>

            <p class="text-gray-400 mt-2">
                Reads a whole number (int).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                nextDouble()
            </h4>

            <p class="text-gray-400 mt-2">
                Reads a decimal number (double).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                nextBoolean()
            </h4>

            <p class="text-gray-400 mt-2">
                Reads true or false.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                next()
            </h4>

            <p class="text-gray-400 mt-2">
                Reads one word, up to the next space.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                nextLine()
            </h4>

            <p class="text-gray-400 mt-2">
                Reads a whole line of text, including spaces.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                next().charAt(0)
            </h4>

            <p class="text-gray-400 mt-2">
                Reads a single character, since there is no nextChar method.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The nextLine() Problem
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A very common mistake happens when nextInt() or nextDouble() is followed by nextLine(). The number methods read only the number and leave the Enter key (the new line character) in the input. The next nextLine() then reads that leftover and returns an empty string without waiting for you to type.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int age = input.nextInt();
input.nextLine();                 // consume the leftover new line
String name = input.nextLine();   // now works correctly</code></pre>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Rule of Thumb
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            After reading a number with nextInt or nextDouble, add an extra input.nextLine() before reading a line of text. Or read everything with nextLine() and convert it yourself.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Reading a Single Character
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.print("Enter a letter: ");
char letter = input.next().charAt(0);
System.out.println("You typed: " + letter);</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Reading Several Values
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.print("Enter two numbers: ");
double x = input.nextDouble();
double y = input.nextDouble();
System.out.println("Sum = " + (x + y));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Enter two numbers: 4.5 3
Sum = 7.5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        What If the User Types the Wrong Thing?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If the program expects a number and the user types letters, Scanner throws an InputMismatchException and the program stops. You can check first with hasNextInt(), which returns true only if the next input is a valid int, or you can handle the problem using try and catch. Later chapters will cover these in more detail.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.print("Enter a number: ");
if (input.hasNextInt()) &#123;
    int n = input.nextInt();
    System.out.println("You entered " + n);
} else &#123;
    System.out.println("That is not a whole number.");
}</code></pre>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Which package contains the Scanner class?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> java.util.
        </p>

        <p class="text-white mt-4">
            Which method reads a whole line including spaces?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> nextLine().
        </p>

        <p class="text-white mt-4">
            Why does nextLine() sometimes seem to be skipped?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because a previous nextInt() or nextDouble() leaves the new line character in the input, which nextLine() then reads as an empty line.
        </p>

    </div>

</div>

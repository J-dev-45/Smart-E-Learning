{{-- TOPIC 6.3: CONDITIONAL STATEMENT: SWITCH-CASE --}}
<div class="mt-10" id="topic-conditional-statement-switch-case">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        6.3 Conditional Statement: switch-case
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The switch statement selects one of many blocks of code to run, based on the value of a single variable or expression. It is often cleaner than a long if-else-if ladder when you are comparing one value against several fixed choices, such as menu options, days of the week, or letter grades.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Syntax
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>switch (expression) &#123;
    case value1:
        // statements
        break;
    case value2:
        // statements
        break;
    default:
        // statements when no case matches
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        How It Works
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            The expression is evaluated once.
        </li>

        <li>
            Its value is compared with each case label in order.
        </li>

        <li>
            When a match is found, the statements after that label run.
        </li>

        <li>
            The break statement ends the switch and jumps to the code after it.
        </li>

        <li>
            If no case matches, the default block runs. The default is optional and usually placed last.
        </li>

    </ul>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int day = 3;
switch (day) &#123;
    case 1:
        System.out.println("Monday");
        break;
    case 2:
        System.out.println("Tuesday");
        break;
    case 3:
        System.out.println("Wednesday");
        break;
    default:
        System.out.println("Another day");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Wednesday</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Fall-Through
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If you forget the break, the program continues running the next case blocks even though they do not match. This is called fall-through. It is usually a bug, but it can be used on purpose to let several cases share the same code.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>char grade = 'B';
switch (grade) &#123;
    case 'A':
    case 'B':
    case 'C':
        System.out.println("Passed");
        break;
    case 'D':
    case 'F':
        System.out.println("Failed");
        break;
    default:
        System.out.println("Invalid grade");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Passed</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        What Types Can a switch Use?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A switch can use byte, short, int, char, their wrapper classes, enums, and String (since Java 7). It cannot use long, float, double, or boolean. The case values must be constants, such as literals, and they must be unique.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>String command = "stop";
switch (command) &#123;
    case "start":
        System.out.println("Starting");
        break;
    case "stop":
        System.out.println("Stopping");
        break;
    default:
        System.out.println("Unknown command");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Stopping</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        A Simple Menu Example
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>import java.util.Scanner;

public class Calculator &#123;
    public static void main(String[] args) &#123;
        Scanner input = new Scanner(System.in);
        System.out.print("Enter two numbers: ");
        double a = input.nextDouble();
        double b = input.nextDouble();
        System.out.print("Choose operation (+, -, *, /): ");
        char op = input.next().charAt(0);

        switch (op) &#123;
            case '+': System.out.println(a + b); break;
            case '-': System.out.println(a - b); break;
            case '*': System.out.println(a * b); break;
            case '/':
                if (b != 0) System.out.println(a / b);
                else System.out.println("Cannot divide by zero");
                break;
            default: System.out.println("Invalid operation");
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Enter two numbers: 12 4
Choose operation (+, -, *, /): /
3.0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        The Modern switch (Java 14 and Later)
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Newer versions of Java offer an arrow form that has no fall-through and can return a value, so there is no need for break.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int day = 6;
String type = switch (day) &#123;
    case 6, 7 -&gt; "Weekend";
    default -&gt; "Weekday";
};
System.out.println(type);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Weekend</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        When to Use switch or if-else
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Use switch
            </h4>

            <p class="text-gray-400 mt-2">
                When you compare one variable against several exact values, such as menu choices or days.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Use if-else
            </h4>

            <p class="text-gray-400 mt-2">
                When you need ranges (score &gt;= 90), complex conditions, or comparisons between two variables.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does the break statement do inside a switch?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It ends the switch and jumps to the code after it, preventing fall-through.
        </p>

        <p class="text-white mt-4">
            When does the default block run?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> When none of the case values match the expression.
        </p>

        <p class="text-white mt-4">
            Which data types can NOT be used in a switch?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> long, float, double, and boolean.
        </p>

    </div>

</div>

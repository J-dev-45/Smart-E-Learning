{{-- TOPIC 6.2: CONDITIONAL STATEMENTS: IF AND ELSE --}}
<div class="mt-10" id="topic-conditional-statements-if-and-else">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        6.2 Conditional Statements: if and else
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A conditional statement lets the program choose which instructions to run depending on a Boolean condition. Without conditions, a program would do exactly the same thing every time. With them, it can respond differently to different input.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The if Statement
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The if statement runs a block of code only when its condition is true. If the condition is false, the block is skipped.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>if (condition) &#123;
    // runs only when the condition is true
}</code></pre>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int temperature = 35;
if (temperature &gt; 30) &#123;
    System.out.println("It is hot today.");
}
System.out.println("Done.");</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>It is hot today.
Done.</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        The if-else Statement
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An if-else statement chooses between two paths. The else block runs when the condition is false.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int score = 68;
if (score &gt;= 75) &#123;
    System.out.println("Passed");
} else &#123;
    System.out.println("Failed");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Failed</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        The if-else-if Ladder
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When there are more than two choices, you can chain conditions. Java checks them from top to bottom and runs only the first block whose condition is true. The final else is optional and handles everything else.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int score = 87;
char grade;
if (score &gt;= 90) &#123;
    grade = 'A';
} else if (score &gt;= 80) &#123;
    grade = 'B';
} else if (score &gt;= 70) &#123;
    grade = 'C';
} else if (score &gt;= 60) &#123;
    grade = 'D';
} else &#123;
    grade = 'F';
}
System.out.println("Grade: " + grade);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Grade: B</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Order matters. If the condition score &gt;= 60 were first, every score from 60 up would be graded D, because Java stops at the first true condition.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Nested if Statements
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An if statement can be placed inside another if. Use it when a second decision depends on the first one being true.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int age = 20;
boolean hasId = true;
if (age &gt;= 18) &#123;
    if (hasId) &#123;
        System.out.println("Entry allowed");
    } else &#123;
        System.out.println("Please show your ID");
    }
} else &#123;
    System.out.println("Too young");
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Entry allowed</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Too many levels of nesting make code hard to read. Often, you can combine the conditions with &amp;&amp; instead: if (age &gt;= 18 &amp;&amp; hasId).
    </p>

    <h3 class="text-xl font-bold mt-6">
        Worked Example: Even or Odd
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>import java.util.Scanner;

public class EvenOdd &#123;
    public static void main(String[] args) &#123;
        Scanner input = new Scanner(System.in);
        System.out.print("Enter a number: ");
        int n = input.nextInt();
        if (n % 2 == 0) &#123;
            System.out.println(n + " is even");
        } else &#123;
            System.out.println(n + " is odd");
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Enter a number: 7
7 is odd</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Semicolon After the Condition
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Writing if (x &gt; 5); makes an empty statement, so the following block always runs. Do not put a semicolon after the condition.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Missing Braces
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Without braces, only the next single statement belongs to the if. Always use braces, even for one statement.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Using = Instead of ==
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                if (x = 5) is a compile error in Java because it assigns instead of comparing.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Wrong Order of Conditions
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                In an else-if ladder, put the most specific conditions first.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Dangling else
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An else always belongs to the nearest if that does not already have an else. Braces make your intended meaning clear and prevent mistakes.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What happens if the condition of an if statement is false and there is no else?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The block is skipped and the program continues with the next statement.
        </p>

        <p class="text-white mt-4">
            In an if-else-if ladder, how many blocks are executed?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Only the first block whose condition is true, or the else block if none are true.
        </p>

        <p class="text-white mt-4">
            Why should you always use braces with if statements?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> To make clear which statements belong to the if, and to avoid errors when more statements are added later.
        </p>

    </div>

</div>

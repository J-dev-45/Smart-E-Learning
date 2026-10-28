{{-- TOPIC 11.1: ITERATION VS. RECURSION --}}
<div class="mt-10" id="topic-iteration-vs-recursion">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        11.1 Iteration vs. Recursion
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        There are two main ways to make a computer repeat work. Iteration uses loops such as for and while. Recursion is a technique in which a method calls itself to solve a smaller version of the same problem. Both can solve the same problems, but each fits some problems better.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Recursion?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A recursive method solves a problem by breaking it into a smaller problem of the same kind. It keeps calling itself with a smaller input until it reaches a case that is simple enough to answer directly. Think of looking up a word in a dictionary where the definition uses another word, so you look that one up too, until you reach a word you already know.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Two Required Parts
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Base Case
            </h4>

            <p class="text-gray-400 mt-2">
                The simplest situation, which can be answered directly without calling the method again. It stops the recursion. Without a base case, the method calls itself forever.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Recursive Case
            </h4>

            <p class="text-gray-400 mt-2">
                The part where the method calls itself with a smaller or simpler input, moving closer to the base case.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: Factorial
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The factorial of n, written n!, is n x (n - 1) x ... x 1. It has a natural recursive definition: n! = n x (n - 1)!, and 0! = 1.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int factorial(int n) &#123;
    if (n == 0) &#123;            // base case
        return 1;
    }
    return n * factorial(n - 1);   // recursive case
}

public static void main(String[] args) &#123;
    System.out.println(factorial(5));
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>120</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            How factorial(4) Is Evaluated
        </h4>

        <p class="text-white mt-3">
            factorial(4) = 4 * factorial(3)
        </p>

        <p class="text-gray-400 mt-2">
            factorial(3) = 3 * factorial(2)
        </p>

        <p class="text-gray-400 mt-2">
            factorial(2) = 2 * factorial(1)
        </p>

        <p class="text-gray-400 mt-2">
            factorial(1) = 1 * factorial(0)
        </p>

        <p class="text-gray-400 mt-2">
            factorial(0) = 1 (base case)
        </p>

        <p class="text-gray-400 mt-2">
            Then the answers come back: 1, then 1, then 2, then 6, then 24
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Call Stack
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Each time a method is called, Java stores its parameters and local variables in a block of memory called a stack frame, and places it on the call stack. In recursion, many frames are stacked up. When the base case returns, the frames are removed one by one and the results are combined. If the recursion is too deep or has no base case, the stack becomes full and Java throws a StackOverflowError.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Example: Countdown
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void countdown(int n) &#123;
    if (n == 0) &#123;
        System.out.println("Go!");
        return;
    }
    System.out.println(n);
    countdown(n - 1);
}
// countdown(3)</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>3
2
1
Go!</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Example: Sum of the Digits
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int sumDigits(int n) &#123;
    if (n &lt; 10) return n;                // base case
    return (n % 10) + sumDigits(n / 10); // last digit + the rest
}
// sumDigits(1234) = 4 + sumDigits(123) = ... = 10</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>10</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Iteration Versus Recursion
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Iteration
            </h4>

            <p class="text-gray-400 mt-2">
                Uses loops. Usually faster and uses less memory. Easy to follow for simple repetition. Risk: an infinite loop.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Recursion
            </h4>

            <p class="text-gray-400 mt-2">
                Uses method calls. Code can be shorter and clearer for naturally recursive problems like trees and puzzles. Uses more memory for the call stack. Risk: infinite recursion and StackOverflowError.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Use iteration for simple counting and processing, and recursion when the problem is naturally defined in terms of smaller copies of itself, such as factorial, Fibonacci numbers, searching folders, and tower of Hanoi.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Forgetting the base case, causing infinite recursion.
        </li>

        <li>
            A recursive call that does not move toward the base case, such as calling factorial(n) instead of factorial(n - 1).
        </li>

        <li>
            Starting with a negative number for a method that expects a non-negative one.
        </li>

        <li>
            Using recursion where a simple loop is clearer and faster.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What are the two essential parts of a recursive method?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A base case that stops the recursion, and a recursive case that calls the method with a smaller input.
        </p>

        <p class="text-white mt-4">
            What error occurs when recursion has no base case?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A StackOverflowError.
        </p>

        <p class="text-white mt-4">
            What is the value of factorial(3)?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 6 (3 x 2 x 1).
        </p>

    </div>

</div>

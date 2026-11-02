{{-- TOPIC 10.1: METHODS AND TYPES OF METHODS --}}
<div class="mt-10" id="topic-methods-and-types-of-methods">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        10.1 Methods and Types of Methods
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A method is a named block of code that performs a specific task and can be used again and again. In other languages, methods are called functions. Instead of copying the same lines in many places, you write them once inside a method and call the method whenever you need it. You have already used methods such as System.out.println(), Math.sqrt(), and nextInt().
    </p>

    <h3 class="text-xl font-bold mt-6">
        Why Use Methods?
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Reusability
            </h4>

            <p class="text-gray-400 mt-2">
                Write the code once and use it many times.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Organization
            </h4>

            <p class="text-gray-400 mt-2">
                A long program is divided into small, understandable pieces.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Easier Testing and Fixing
            </h4>

            <p class="text-gray-400 mt-2">
                You can test one method at a time, and fix a mistake in one place.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Teamwork
            </h4>

            <p class="text-gray-400 mt-2">
                Different programmers can work on different methods.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Declaring a Method
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>accessModifier static returnType methodName(parameterList) &#123;
    // body
    return value;      // not needed if returnType is void
}</code></pre>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Return Type
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The type of value the method sends back, such as int or String. Use void when nothing is returned.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Method Name
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written in camelCase and should be a verb that describes the task, such as computeAverage or printReport.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Parameters
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Variables listed in parentheses that receive the input values. A method may have none.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Body
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The statements inside { } that do the work.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                return
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Sends a value back to the caller and ends the method.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Calling a Method
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Demo &#123;
    // a method with no parameters and no return value
    static void greet() &#123;
        System.out.println("Welcome!");
    }

    // a method with parameters and a return value
    static int add(int a, int b) &#123;
        return a + b;
    }

    public static void main(String[] args) &#123;
        greet();
        int result = add(5, 7);
        System.out.println("5 + 7 = " + result);
        System.out.println(add(10, 20));
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Welcome!
5 + 7 = 12
30</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The values you pass when calling a method are called arguments, and the variables that receive them in the method declaration are called parameters. The arguments must match the parameters in number, order, and type.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Four Common Types of Methods
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                No Parameters, No Return
            </h4>

            <p class="text-gray-400 mt-2">
                static void showMenu() prints something and returns nothing.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                With Parameters, No Return
            </h4>

            <p class="text-gray-400 mt-2">
                static void greet(String name) uses an input to print a message.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                No Parameters, With Return
            </h4>

            <p class="text-gray-400 mt-2">
                static int getRandom() takes no input but returns a value.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                With Parameters and Return
            </h4>

            <p class="text-gray-400 mt-2">
                static double area(double w, double h) takes inputs and gives back a result.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void showMenu() &#123;
    System.out.println("1. Start");
    System.out.println("2. Exit");
}

static void greet(String name) &#123;
    System.out.println("Hello, " + name + "!");
}

static int getTen() &#123;
    return 10;
}

static double area(double w, double h) &#123;
    return w * h;
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Other Kinds of Methods
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Static Methods
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Belong to the class and are called without creating an object, such as Math.sqrt(). Methods called directly from main must be static unless called through an object.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Instance Methods
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Belong to an object and are called with an object, such as student.displayInfo().
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Built-in (Library) Methods
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Already written for you, such as Math.max() and String methods.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                User-defined Methods
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written by the programmer for the needs of the program.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Method Overloading
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java allows several methods with the same name as long as their parameter lists are different in number or type. This is called overloading. Java chooses the correct one based on the arguments.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int add(int a, int b)           &#123; return a + b; }
static double add(double a, double b)  &#123; return a + b; }
static int add(int a, int b, int c)    &#123; return a + b + c; }

// add(2, 3) -&gt; 5     add(2.5, 1.5) -&gt; 4.0     add(1, 2, 3) -&gt; 6</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Variable Scope in Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A variable declared inside a method, including its parameters, is local to that method. It exists only while the method runs and cannot be used outside of it. Two different methods can use the same variable name without any conflict.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Worked Example: Methods Working Together
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static boolean isEven(int n) &#123;
    return n % 2 == 0;
}

static int sumOfEvens(int[] nums) &#123;
    int sum = 0;
    for (int n : nums) &#123;
        if (isEven(n)) sum += n;
    }
    return sum;
}

public static void main(String[] args) &#123;
    int[] data = &#123;1, 2, 3, 4, 5, 6};
    System.out.println("Sum of evens: " + sumOfEvens(data));
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Sum of evens: 12</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does void mean in a method declaration?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The method does not return any value.
        </p>

        <p class="text-white mt-4">
            What is the difference between a parameter and an argument?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A parameter is the variable in the method declaration, while an argument is the actual value passed when the method is called.
        </p>

        <p class="text-white mt-4">
            What is method overloading?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Having several methods with the same name but different parameter lists in the same class.
        </p>

    </div>

</div>

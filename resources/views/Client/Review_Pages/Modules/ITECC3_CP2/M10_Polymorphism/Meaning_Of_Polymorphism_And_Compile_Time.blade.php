{{-- TOPIC 10.1: MEANING OF POLYMORPHISM AND COMPILE-TIME POLYMORPHISM --}}
<div class="mt-10" id="topic-meaning-of-polymorphism-and-compile-time-polymorphism">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        10.1 Meaning of Polymorphism and Compile-Time Polymorphism
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The word polymorphism comes from Greek and means "many forms". In programming, it means that the same name or the same call can behave differently depending on the situation. A person can be a student at school, a child at home, and a customer in a store, yet remains one person. Similarly, one method name can have many forms. Polymorphism is the third pillar of OOP.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Polymorphism?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Polymorphism is the ability of one interface, such as a method name, to be used for different kinds of actions. It lets you write code that works with general ideas, such as "make a sound" or "calculate the area", while the exact behavior is decided by the specific object or the arguments.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Two Kinds of Polymorphism
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Compile-Time Polymorphism
            </h4>

            <p class="text-gray-400 mt-2">
                Decided by the compiler, before the program runs. Achieved by method overloading. Also called static binding or early binding.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Runtime Polymorphism
            </h4>

            <p class="text-gray-400 mt-2">
                Decided while the program runs, according to the actual object. Achieved by method overriding. Also called dynamic binding or late binding.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        This topic covers compile-time polymorphism. Runtime polymorphism is covered in the next topic.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Method Overloading
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In overloading, several methods in the same class share a name but have different parameter lists. When a method is called, the compiler examines the arguments and chooses the matching version. Because this choice is made before the program runs, it is compile-time polymorphism.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Printer &#123;
    void print(int n)            &#123; System.out.println("int: " + n); }
    void print(double d)         &#123; System.out.println("double: " + d); }
    void print(String s)         &#123; System.out.println("String: " + s); }
    void print(char c)           &#123; System.out.println("char: " + c); }
    void print(int a, int b)     &#123; System.out.println("two ints: " + a + " and " + b); }
    void print(boolean b)        &#123; System.out.println("boolean: " + b); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Printer p = new Printer();
        p.print(42);
        p.print(3.14);
        p.print("Hello");
        p.print('A');
        p.print(10, 20);
        p.print(true);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>int: 42
double: 3.14
String: Hello
char: A
two ints: 10 and 20
boolean: true</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        How Java Chooses an Overloaded Method
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Java first looks for an exact match of the argument types. If there is none, it uses the closest match by widening a primitive type, for example from int to double. If more than one method could apply and none is clearly better, the compiler reports an ambiguity error.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Show &#123;
    void display(int x)    &#123; System.out.println("int version: " + x); }
    void display(long x)   &#123; System.out.println("long version: " + x); }
    void display(double x) &#123; System.out.println("double version: " + x); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Show s = new Show();
        s.display(5);          // exact match: int
        s.display(5L);         // long
        s.display(5.5f);       // float widened to double
        byte b = 7;
        s.display(b);          // byte widened to int
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>int version: 5
long version: 5
double version: 5.5
int version: 7</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        A Practical Example: Area Calculator
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class AreaCalculator &#123;
    int area(int side)                         &#123; return side * side; }
    int area(int length, int width)            &#123; return length * width; }
    double area(double radius)                 &#123; return Math.PI * radius * radius; }
    double area(double base, double height, boolean triangle) &#123; return 0.5 * base * height; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        AreaCalculator calc = new AreaCalculator();
        System.out.println("Square:    " + calc.area(5));
        System.out.println("Rectangle: " + calc.area(4, 6));
        System.out.println("Circle:    " + calc.area(3.0));
        System.out.println("Triangle:  " + calc.area(4.0, 5.0, true));
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Square:    25
Rectangle: 24
Circle:    28.274333882308138
Triangle:  10.0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Constructor Overloading and Operators
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Constructors can be overloaded too, which gives several ways to create an object. Java also uses a form of compile-time polymorphism in the + operator: it adds numbers but joins strings.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>System.out.println(5 + 3);
System.out.println("5" + "3");
System.out.println("Total: " + 5 + 3);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>8
53
Total: 53</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Benefits and Limits
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Benefits
            </h4>

            <p class="text-gray-400 mt-2">
                Readable code, because related actions share one name. Flexibility in how methods are called. Less need to invent many names, such as addInt and addDouble.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Limits
            </h4>

            <p class="text-gray-400 mt-2">
                Only the parameter list can make methods different. The choice is fixed at compile time and does not depend on the actual object.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does polymorphism mean?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Many forms: the same method name or call can behave differently depending on the situation.
        </p>

        <p class="text-white mt-4">
            Which technique achieves compile-time polymorphism?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Method overloading.
        </p>

        <p class="text-white mt-4">
            When is the overloaded method chosen?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> At compile time, by the compiler, based on the arguments in the call.
        </p>

    </div>

</div>

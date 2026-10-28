{{-- TOPIC 11.1: MEANING OF ABSTRACTION, ABSTRACT CLASSES, AND ABSTRACT METHODS --}}
<div class="mt-10" id="topic-meaning-of-abstraction-abstract-classes-and-abstract-methods">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        11.1 Meaning of Abstraction, Abstract Classes, and Abstract Methods
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When you drive a car, you use the steering wheel, pedals, and gear stick. You do not need to know how the engine burns fuel. When you withdraw money from an ATM, you choose an amount without knowing how the bank's computers work. This is abstraction: showing only the essential features of something and hiding the complicated details.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Abstraction?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Abstraction is the OOP principle of focusing on what an object does rather than how it does it. It reduces complexity, because a user of a class needs to know only its public interface. In Java, abstraction is achieved with abstract classes and interfaces.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Abstraction and Encapsulation
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Abstraction
            </h4>

            <p class="text-gray-400 mt-2">
                Works at the design level. It decides what to show and which details to leave out. Example: a Shape must have an area.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Encapsulation
            </h4>

            <p class="text-gray-400 mt-2">
                Works at the implementation level. It hides data and protects it using private access. Example: the radius is private.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Abstract Classes and Abstract Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An abstract class is a class declared with the keyword abstract. It is a general idea that is too incomplete to be used by itself, such as Shape or Employee. An abstract method is a method with no body, only a signature, that ends with a semicolon. It says what must be done, and each subclass must say how.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>abstract class Shape &#123;
    abstract double area();               // no body: subclasses must supply it

    void describe() &#123;                     // a normal method, inherited as is
        System.out.printf("%s with area %.2f%n", getClass().getSimpleName(), area());
    }
}

class Circle extends Shape &#123;
    private double radius;
    Circle(double radius) &#123; this.radius = radius; }

    &#64;Override
    double area() &#123; return Math.PI * radius * radius; }
}

class Rectangle extends Shape &#123;
    private double width, height;
    Rectangle(double width, double height) &#123; this.width = width; this.height = height; }

    &#64;Override
    double area() &#123; return width * height; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Shape c = new Circle(5);
        Shape r = new Rectangle(4, 6);

        c.describe();
        r.describe();

        // Shape s = new Shape();     // error: Shape is abstract
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Circle with area 78.54
Rectangle with area 24.00</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Rules for Abstract Classes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            An abstract class cannot be instantiated: new Shape() causes a compile error.
        </li>

        <li>
            It may contain abstract methods and normal methods with bodies.
        </li>

        <li>
            A class with at least one abstract method must itself be declared abstract.
        </li>

        <li>
            A concrete subclass must override all inherited abstract methods, or it must be abstract too.
        </li>

        <li>
            An abstract class can have attributes and constructors. The constructor runs when a subclass object is created, through super(...).
        </li>

        <li>
            Abstract methods cannot be private, static, or final.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Why Use Abstract Classes?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Abstract classes let you define a common structure and shared code for related classes, and force every subclass to supply the specific parts. The Shape class guarantees that every shape has an area, so any code that uses a Shape can safely call area() without knowing the kind of shape.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Abstract Class With Shared Code
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>abstract class Employee &#123;
    protected String name;

    Employee(String name) &#123; this.name = name; }

    abstract double computePay();         // each type computes pay differently

    void printPaySlip() &#123;                 // shared by all employees
        System.out.println(name + " - pay: " + computePay());
    }
}

class FullTime extends Employee &#123;
    private double monthlySalary;
    FullTime(String name, double monthlySalary) &#123;
        super(name);
        this.monthlySalary = monthlySalary;
    }
    &#64;Override double computePay() &#123; return monthlySalary; }
}

class PartTime extends Employee &#123;
    private int hours;
    private double rate;
    PartTime(String name, int hours, double rate) &#123;
        super(name);
        this.hours = hours;
        this.rate = rate;
    }
    &#64;Override double computePay() &#123; return hours * rate; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Employee[] staff = &#123; new FullTime("Ana", 30000), new PartTime("Ben", 120, 150) };
        for (Employee e : staff) &#123;
            e.printPaySlip();
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana - pay: 30000.0
Ben - pay: 18000.0</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is abstraction?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Showing only the essential features of an object and hiding the unnecessary details.
        </p>

        <p class="text-white mt-4">
            Can you create an object of an abstract class?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No, an abstract class cannot be instantiated.
        </p>

        <p class="text-white mt-4">
            What must a concrete subclass do with inherited abstract methods?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It must override and implement all of them.
        </p>

    </div>

</div>

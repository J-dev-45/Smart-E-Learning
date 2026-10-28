{{-- TOPIC 11.2: INTERFACES, HIDING IMPLEMENTATION DETAILS, AND DESIGNING GENERALIZED SYSTEMS --}}
<div class="mt-10" id="topic-interfaces-hiding-implementation-details-and-designing-generalized-systems">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        11.2 Interfaces, Hiding Implementation Details, and Designing Generalized Systems
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An abstract class can mix shared code with abstract methods. Sometimes you want something even purer: a contract that says what a class can do without saying anything about how or where it is in a hierarchy. In Java, this contract is called an interface. Interfaces are the main tool for hiding implementation details and for designing systems that are general and easy to extend.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is an Interface?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An interface is a collection of abstract methods (and constants) that a class promises to provide. A class that signs the contract uses the implements keyword and must supply a body for every method of the interface. Interface methods are public by default.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>interface Payable &#123;
    void pay(double amount);
}

class Cash implements Payable &#123;
    public void pay(double amount) &#123;
        System.out.println("Paid " + amount + " in cash");
    }
}

class CreditCard implements Payable &#123;
    private String last4;
    CreditCard(String last4) &#123; this.last4 = last4; }
    public void pay(double amount) &#123;
        System.out.println("Charged " + amount + " to card ending " + last4);
    }
}

class GCash implements Payable &#123;
    private String number;
    GCash(String number) &#123; this.number = number; }
    public void pay(double amount) &#123;
        System.out.println("Sent " + amount + " through GCash " + number);
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Payable[] methods = &#123; new Cash(), new CreditCard("1234"), new GCash("0917") };
        for (Payable p : methods) &#123;
            p.pay(1500);
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Paid 1500.0 in cash
Charged 1500.0 to card ending 1234
Sent 1500.0 through GCash 0917</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The code that uses Payable only knows that pay() exists. It does not know how each payment method works, and that is exactly the hiding of implementation details. If a new payment method is added later, the loop does not need to change.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Multiple Interfaces
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A class can extend only one class but can implement many interfaces. This is how Java supports a form of multiple inheritance of behavior.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>interface Walkable &#123; void walk(); }
interface Speakable &#123; void speak(); }
interface Chargeable &#123; void charge(); }

class Robot implements Walkable, Speakable, Chargeable &#123;
    private String name;
    Robot(String name) &#123; this.name = name; }
    public void walk()   &#123; System.out.println(name + " is walking"); }
    public void speak()  &#123; System.out.println(name + " says: Beep boop"); }
    public void charge() &#123; System.out.println(name + " is charging"); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Robot r = new Robot("R2");
        r.walk();
        r.speak();
        r.charge();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>R2 is walking
R2 says: Beep boop
R2 is charging</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Default Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Since Java 8, an interface can contain default methods that have a body. Implementing classes receive them automatically and may override them.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>interface Vehicle &#123;
    void drive();
    default void start() &#123;
        System.out.println("Starting the vehicle...");
        drive();
    }
}

class Car implements Vehicle &#123;
    public void drive() &#123; System.out.println("Car is driving"); }
}

class Bike implements Vehicle &#123;
    public void drive() &#123; System.out.println("Bike is pedaling"); }
    &#64;Override
    public void start() &#123; System.out.println("Bike starts with a push"); drive(); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        new Car().start();
        new Bike().start();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Starting the vehicle...
Car is driving
Bike starts with a push
Bike is pedaling</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Abstract Class or Interface?
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Abstract Class
            </h4>

            <p class="text-gray-400 mt-2">
                Can have attributes, constructors, and normal methods. A class extends only one. Use it for closely related classes that share code and state (an is-a relationship).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Interface
            </h4>

            <p class="text-gray-400 mt-2">
                Defines only a contract (plus default methods and constants). A class can implement many. Use it for abilities shared by unrelated classes (a can-do relationship).
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Designing Generalized Systems
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A generalized system depends on abstractions, not on specific classes. You write the main code against an abstract class or an interface, and you plug in specific implementations. When a new requirement appears, you add a new class instead of changing the existing, tested code. This is one of the main goals of object-oriented design.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Design Steps
        </h4>

        <p class="text-white mt-3">
            1. Identify what changes (payment methods, shapes, employee types).
        </p>

        <p class="text-gray-400 mt-2">
            2. Define an abstract class or interface for what stays the same (pay, area, computePay).
        </p>

        <p class="text-gray-400 mt-2">
            3. Write the main logic using only the abstract type.
        </p>

        <p class="text-gray-400 mt-2">
            4. Create a concrete class for each variation.
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>interface Shape &#123;
    double area();
}

class Circle implements Shape &#123;
    private double r;
    Circle(double r) &#123; this.r = r; }
    public double area() &#123; return Math.PI * r * r; }
}

class Square implements Shape &#123;
    private double side;
    Square(double side) &#123; this.side = side; }
    public double area() &#123; return side * side; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Shape[] shapes = &#123; new Circle(1), new Square(2), new Circle(0.5) };
        System.out.printf("Total area: %.2f%n", totalArea(shapes));
    }

    static double totalArea(Shape[] list) &#123;
        double total = 0;
        for (Shape s : list) total += s.area();   // works for any shape
        return total;
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Total area: 7.93</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What keyword does a class use to follow an interface?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> implements.
        </p>

        <p class="text-white mt-4">
            Why can an interface help hide implementation details?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Code that uses the interface knows only what the methods do, not how each class does it.
        </p>

        <p class="text-white mt-4">
            What is one difference between an abstract class and an interface?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A class can extend only one abstract class, but it can implement many interfaces. Abstract classes can also hold state and constructors.
        </p>

    </div>

</div>

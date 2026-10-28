{{-- TOPIC 6.1: WHAT IS OBJECT-ORIENTED PROGRAMMING? --}}
<div class="mt-10" id="topic-what-is-object-oriented-programming">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        6.1 What Is Object-Oriented Programming?
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Object-oriented programming (OOP) is a way of designing programs around objects instead of around a list of steps. The idea is to model the things the program deals with, such as students, accounts, products, or shapes, as objects that hold their own data and know how to do their own tasks. Most large programs today, including mobile apps and enterprise systems, are built this way.
    </p>

    <h3 class="text-xl font-bold mt-6">
        A Brief History
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            1960s: Simula, a language for simulations, introduces classes and objects.
        </li>

        <li>
            1970s: Smalltalk develops the full idea of objects sending messages to each other.
        </li>

        <li>
            1980s: C++ adds classes to C and brings OOP to many programmers.
        </li>

        <li>
            1995: Java is released as an object-oriented language that runs on many platforms.
        </li>

        <li>
            Today: C#, Python, Kotlin, Swift, and many more languages support OOP.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Purpose of OOP
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        As programs grew larger, procedural programs became hard to manage. Thousands of lines of code shared data that anyone could change, so one small change could break something in a completely different place. OOP was designed to manage this complexity by dividing the program into independent, self-contained units, each responsible for its own data and behavior.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Procedural and Object-Oriented Programming Compared
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Procedural
            </h4>

            <p class="text-gray-400 mt-2">
                Focus: the steps and procedures. Data and procedures are separate. Data is often shared and can be changed from anywhere. Best for small and simple programs.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Object-Oriented
            </h4>

            <p class="text-gray-400 mt-2">
                Focus: the objects. Data and behavior are bundled together. Data can be protected inside the object. Best for large, growing programs.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Real-World Modeling
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        OOP asks you to describe the world in terms of objects. Think of a car. It has attributes such as brand, color, and speed, and it has behaviors such as accelerate, brake, and honk. In a program, a Car class would have the same attributes (variables) and behaviors (methods).
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Car &#123;
    String brand;
    String color;
    int speed;

    Car(String brand, String color) &#123;
        this.brand = brand;
        this.color = color;
        this.speed = 0;
    }

    void accelerate(int amount) &#123; speed += amount; }
    void brake(int amount) &#123; speed = Math.max(0, speed - amount); }
    void showStatus() &#123;
        System.out.println(color + " " + brand + " is going " + speed + " km/h");
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Car myCar = new Car("Toyota", "Red");
        myCar.accelerate(30);
        myCar.accelerate(25);
        myCar.brake(15);
        myCar.showStatus();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Red Toyota is going 40 km/h</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Advantages of OOP
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Modularity
            </h4>

            <p class="text-gray-400 mt-2">
                The program is built from separate classes that can be developed and tested on their own.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Reusability
            </h4>

            <p class="text-gray-400 mt-2">
                A class written once can be used in many programs, and inheritance lets new classes build on old ones.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Maintainability
            </h4>

            <p class="text-gray-400 mt-2">
                A change inside a class does not affect other parts of the program as long as its public methods stay the same.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Security of Data
            </h4>

            <p class="text-gray-400 mt-2">
                Private data can be changed only through controlled methods.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Natural Design
            </h4>

            <p class="text-gray-400 mt-2">
                Classes match the real-world things in the problem, so programs are easier to understand.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Four Pillars
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Encapsulation
            </h4>

            <p class="text-gray-400 mt-2">
                Bundling data with its methods and hiding the internal details.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Inheritance
            </h4>

            <p class="text-gray-400 mt-2">
                Creating a new class from an existing one to reuse its members.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Polymorphism
            </h4>

            <p class="text-gray-400 mt-2">
                Using one interface for different forms of behavior.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Abstraction
            </h4>

            <p class="text-gray-400 mt-2">
                Exposing only the essential features and hiding complexity.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the main idea of OOP?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> To organize a program as a collection of objects that combine data and behavior.
        </p>

        <p class="text-white mt-4">
            Which language first introduced classes and objects?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Simula, in the 1960s.
        </p>

        <p class="text-white mt-4">
            Give two advantages of OOP.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Reusability and maintainability. Modularity and data protection are also advantages.
        </p>

    </div>

</div>

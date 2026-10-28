{{-- TOPIC 9.1: MEANING OF INHERITANCE, SUPERCLASS, AND SUBCLASS --}}
<div class="mt-10" id="topic-meaning-of-inheritance-superclass-and-subclass">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        9.1 Meaning of Inheritance, Superclass, and Subclass
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In the real world, children inherit traits from their parents. In OOP, inheritance works in a similar way: a new class can be built from an existing class and automatically receive its attributes and methods. This lets you reuse code, avoid repetition, and organize related classes into a hierarchy.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Inheritance?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Inheritance is the mechanism by which one class acquires the members (attributes and methods) of another class. The class that is inherited from is called the superclass, parent class, or base class. The class that inherits is called the subclass, child class, or derived class. The subclass can use everything that is accessible in the superclass and can also add new members of its own.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The "is-a" Relationship
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Inheritance models an is-a relationship. A Student is a Person. A Dog is an Animal. If you can say "B is a kind of A", then B can be a subclass of A. If the relationship is "has-a", for example a Car has an Engine, use an attribute instead of inheritance.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Class Hierarchy
        </h4>

        <p class="text-white mt-3">
            Person (name, age)
        </p>

        <p class="text-gray-400 mt-2">
            Student extends Person (adds course, yearLevel)
        </p>

        <p class="text-gray-400 mt-2">
            Teacher extends Person (adds department, salary)
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The extends Keyword
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In Java, the extends keyword creates a subclass. The subclass gets the accessible members of the superclass without rewriting them.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Person &#123;
    String name;
    int age;

    void greet() &#123;
        System.out.println("Hello, my name is " + name + " and I am " + age + ".");
    }
}

class Student extends Person &#123;
    String course;

    void study() &#123;
        System.out.println(name + " is studying " + course + ".");
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student();
        s.name = "Ana Reyes";           // inherited attribute
        s.age = 19;                     // inherited attribute
        s.course = "BSIT";              // its own attribute

        s.greet();                      // inherited method
        s.study();                      // its own method
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Hello, my name is Ana Reyes and I am 19.
Ana Reyes is studying BSIT.</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The Student class never declares name, age, or greet(), yet it can use them because it extends Person.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Inherited?
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Inherited
            </h4>

            <p class="text-gray-400 mt-2">
                Non-private attributes and methods, including those with public, protected, or package access in the same package.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Not Inherited
            </h4>

            <p class="text-gray-400 mt-2">
                Private members (they exist in the object but are not directly accessible in the subclass) and constructors. A subclass has to define its own constructors.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The protected Modifier
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A protected member is accessible in the class itself, in classes of the same package, and in subclasses. It is a middle choice between private and public, so that a superclass can share data with its subclasses without exposing it to everyone.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Rules of Inheritance in Java
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            A class can extend only one other class. Java has single inheritance for classes.
        </li>

        <li>
            A class can be extended in many levels, so a Graduate can extend Student, which extends Person (multilevel inheritance).
        </li>

        <li>
            Many classes can extend the same superclass (hierarchical inheritance).
        </li>

        <li>
            Every class extends the class Object if no other superclass is given, so every object has methods such as toString() and equals().
        </li>

        <li>
            A class declared as final cannot be extended.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Checking the Type with instanceof
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Person &#123; }
class Student extends Person &#123; }

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student();
        System.out.println(s instanceof Student);
        System.out.println(s instanceof Person);
        Person p = new Person();
        System.out.println(p instanceof Student);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>true
true
false</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Why Use Inheritance?
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Reusability
            </h4>

            <p class="text-gray-400 mt-2">
                Common code is written once in the superclass.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Organization
            </h4>

            <p class="text-gray-400 mt-2">
                Classes are arranged in a clear hierarchy that reflects the real world.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Easier Maintenance
            </h4>

            <p class="text-gray-400 mt-2">
                A fix in the superclass automatically applies to all subclasses.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Extensibility
            </h4>

            <p class="text-gray-400 mt-2">
                New subclasses can be added without changing existing code.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between a superclass and a subclass?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The superclass is the class being inherited from, and the subclass is the class that inherits its members.
        </p>

        <p class="text-white mt-4">
            What keyword makes a class inherit from another class in Java?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> extends.
        </p>

        <p class="text-white mt-4">
            Can a Java class extend more than one class?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No. Java allows single inheritance for classes.
        </p>

    </div>

</div>

{{-- TOPIC 9.2: METHOD INHERITANCE, METHOD OVERRIDING, AND THE SUPER KEYWORD --}}
<div class="mt-10" id="topic-method-inheritance-method-overriding-and-the-super-keyword">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        9.2 Method Inheritance, Method Overriding, and the super Keyword
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A subclass automatically inherits the methods of its superclass, but sometimes the inherited behavior is not quite right for the subclass. Method overriding lets the subclass provide its own version of an inherited method. The super keyword lets the subclass refer back to the parent class, to reuse its methods and constructors.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Inheriting Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A subclass object can call any accessible method of its superclass as if it had been defined in the subclass itself.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Method Overriding
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Overriding means that a subclass defines a method with the same name, the same parameters, and a compatible return type as a method in its superclass. When the method is called on a subclass object, the subclass version runs. The &#64;Override annotation tells the compiler to check that you are really overriding a method, which catches spelling mistakes.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Person &#123;
    protected String name;

    Person(String name) &#123; this.name = name; }

    void introduce() &#123;
        System.out.println("I am " + name + ".");
    }
}

class Student extends Person &#123;
    private String course;

    Student(String name, String course) &#123;
        super(name);
        this.course = course;
    }

    &#64;Override
    void introduce() &#123;
        System.out.println("I am " + name + ", a student of " + course + ".");
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Person p = new Person("Ana");
        Student s = new Student("Ben", "BSIT");
        p.introduce();
        s.introduce();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>I am Ana.
I am Ben, a student of BSIT.</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Rules for Overriding
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            The method name and the parameter list must be exactly the same as in the superclass.
        </li>

        <li>
            The return type must be the same (or a subtype of it).
        </li>

        <li>
            The access level cannot be more restrictive. A public method cannot be overridden as private.
        </li>

        <li>
            Methods marked final cannot be overridden, and static or private methods are not overridden.
        </li>

        <li>
            Use &#64;Override so that the compiler checks it for you.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        The super Keyword
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The super keyword refers to the superclass. It has two main uses: calling a superclass method that has been overridden, and calling a superclass constructor.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Employee &#123;
    protected String name;
    protected double salary;

    Employee(String name, double salary) &#123;
        this.name = name;
        this.salary = salary;
    }

    void showPay() &#123;
        System.out.println(name + " earns " + salary);
    }
}

class Manager extends Employee &#123;
    private double bonus;

    Manager(String name, double salary, double bonus) &#123;
        super(name, salary);                 // call the superclass constructor
        this.bonus = bonus;
    }

    &#64;Override
    void showPay() &#123;
        super.showPay();                     // reuse the superclass version
        System.out.println("  plus bonus " + bonus + ", total " + (salary + bonus));
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Employee e = new Manager("Cara", 30000, 5000);
        e.showPay();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Cara earns 30000.0
  plus bonus 5000.0, total 35000.0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Constructors in Inheritance
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Constructors are not inherited. When you create a subclass object, the superclass constructor always runs first, so the inherited part of the object is set up before the subclass part. If you do not call super(...) yourself, Java inserts a call to the superclass no-argument constructor automatically. If the superclass has no such constructor, you must call super(...) with arguments explicitly, as the first statement.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Person &#123;
    Person() &#123; System.out.println("Person constructor"); }
}

class Student extends Person &#123;
    Student() &#123;
        super();
        System.out.println("Student constructor");
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        System.out.println("Creating a Student:");
        new Student();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Creating a Student:
Person constructor
Student constructor</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Overriding toString()
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Every class inherits toString() from Object. By default it prints a class name and a code, which is not useful. Overriding it gives the object a readable description, and println uses it automatically.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    private String name;
    private int grade;

    Student(String name, int grade) &#123;
        this.name = name;
        this.grade = grade;
    }

    &#64;Override
    public String toString() &#123;
        return "Student[" + name + ", grade " + grade + "]";
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student("Ana", 88);
        System.out.println(s);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Student[Ana, grade 88]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Overriding and Overloading Are Different
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Overriding
            </h4>

            <p class="text-gray-400 mt-2">
                Same method name and same parameters, in a subclass. Replaces the inherited behavior. Decided at run time.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Overloading
            </h4>

            <p class="text-gray-400 mt-2">
                Same method name but different parameters, in the same class. Adds another version. Decided at compile time.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is method overriding?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A subclass provides its own version of a method that it inherits, with the same name and parameters.
        </p>

        <p class="text-white mt-4">
            What are the two uses of the super keyword?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Calling an overridden method of the superclass, and calling a superclass constructor.
        </p>

        <p class="text-white mt-4">
            Which constructor runs first when a subclass object is created?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The superclass constructor.
        </p>

    </div>

</div>

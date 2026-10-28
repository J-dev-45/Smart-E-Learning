{{-- TOPIC 7.1: CONSTRUCTORS --}}
<div class="mt-10" id="topic-constructors">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.1 Constructors
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In the previous module, you created a Student object and then set its attributes one line at a time. This is repetitive, and it is easy to forget to set a value. A constructor solves this problem by setting the starting values of an object at the moment it is created.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is a Constructor?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A constructor is a special method that is called automatically when an object is created with the new keyword. It has the same name as the class and has no return type, not even void. Its main job is to initialize the attributes of the new object.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Default Constructor
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If you do not write any constructor, Java automatically gives the class a default constructor that takes no parameters and leaves the attributes at their default values (0, false, or null). You can also write your own no-argument constructor to set sensible starting values.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int grade;

    Student() &#123;                       // no-argument constructor
        name = "Unknown";
        grade = 0;
    }

    void show() &#123; System.out.println(name + " - " + grade); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student();
        s.show();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Unknown - 0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Parameterized Constructor
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A parameterized constructor takes values as arguments, so the object is created with its data already set. The keyword this refers to the current object and separates the attribute from the parameter when they have the same name.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int grade;

    Student(String name, int grade) &#123;
        this.name = name;              // this.name is the attribute, name is the parameter
        this.grade = grade;
    }

    void show() &#123; System.out.println(name + " - " + grade); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s1 = new Student("Ana", 90);
        Student s2 = new Student("Ben", 85);
        s1.show();
        s2.show();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana - 90
Ben - 85</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Constructor Overloading
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A class can have several constructors as long as their parameter lists differ. This is called constructor overloading. It gives users different ways of creating an object.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int grade;

    Student() &#123;
        this("Unknown", 0);               // calls the other constructor
    }

    Student(String name) &#123;
        this(name, 0);
    }

    Student(String name, int grade) &#123;
        this.name = name;
        this.grade = grade;
    }

    void show() &#123; System.out.println(name + " - " + grade); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student a = new Student();
        Student b = new Student("Ben");
        Student c = new Student("Cara", 92);
        a.show(); b.show(); c.show();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Unknown - 0
Ben - 0
Cara - 92</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The call this(...) from one constructor to another is called constructor chaining. It avoids repeating the same code in several constructors. It must be the first statement in the constructor.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Rules and Common Mistakes
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            A constructor has the same name as the class and no return type.
        </li>

        <li>
            If you write any constructor, Java no longer provides the default one. Calling new Student() then causes an error unless you also write a no-argument constructor.
        </li>

        <li>
            Writing a return type, such as void Student(), turns it into an ordinary method, not a constructor.
        </li>

        <li>
            Inside a constructor, use this.attribute = parameter when the names are the same.
        </li>

        <li>
            A constructor runs only once for each object, when it is created.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            When is a constructor called?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Automatically, when an object is created with new.
        </p>

        <p class="text-white mt-4">
            What happens to the default constructor if you write a parameterized constructor?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Java no longer provides the default constructor, so you must write one if you still need it.
        </p>

        <p class="text-white mt-4">
            What does the keyword this refer to inside a constructor?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The object that is being created.
        </p>

    </div>

</div>

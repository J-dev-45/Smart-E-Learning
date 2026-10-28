{{-- TOPIC 7.2: INSTANCE METHODS, STATIC METHODS, PARAMETERS, AND RETURN VALUES --}}
<div class="mt-10" id="topic-instance-methods-static-methods-parameters-and-return-values">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.2 Instance Methods, Static Methods, Parameters, and Return Values
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Methods are the actions of a class. In this topic you will see the difference between methods that work on a particular object and methods that belong to the class as a whole, and you will practice passing information into methods and getting results back.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Instance Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An instance method belongs to an object. It is called through an object, and it can read and change that object's attributes. Different objects give different results because each has its own data.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Rectangle &#123;
    double width, height;

    Rectangle(double width, double height) &#123;
        this.width = width;
        this.height = height;
    }

    double area() &#123; return width * height; }

    void scale(double factor) &#123;
        width *= factor;
        height *= factor;
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Rectangle small = new Rectangle(3, 4);
        Rectangle large = new Rectangle(10, 6);
        System.out.println("Small area: " + small.area());
        System.out.println("Large area: " + large.area());
        large.scale(2);
        System.out.println("Large after scale: " + large.area());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Small area: 12.0
Large area: 60.0
Large after scale: 240.0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Static Methods and Static Variables
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A static member belongs to the class itself, not to any object. A static method is called with the class name and does not need an object. A static variable has a single copy that is shared by all objects of the class. Because a static method has no object, it cannot directly use instance attributes or this.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    private static int count = 0;          // shared by all students

    Student(String name) &#123;
        this.name = name;
        count++;
    }

    static int getCount() &#123; return count; }
}

class MathTool &#123;
    static int max(int a, int b) &#123; return a &gt; b ? a : b; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        new Student("Ana");
        new Student("Ben");
        new Student("Cara");
        System.out.println("Students created: " + Student.getCount());
        System.out.println("Max of 4 and 9: " + MathTool.max(4, 9));
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Students created: 3
Max of 4 and 9: 9</code></pre>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Instance Method
            </h4>

            <p class="text-gray-400 mt-2">
                Called on an object. Can use the object's attributes. Example: s.show()
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Static Method
            </h4>

            <p class="text-gray-400 mt-2">
                Called on the class. Cannot use instance attributes directly. Example: Math.sqrt(16), Student.getCount()
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Parameters
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Parameters let a method receive input. The values passed in the call are the arguments, and they must match the parameters in number, order, and type. Java passes arguments by value, so a primitive argument is copied, while an object argument passes a copy of the reference.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Account &#123;
    double balance;

    void deposit(double amount) &#123;
        balance += amount;
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Account acc = new Account();
        acc.deposit(500);
        acc.deposit(250.75);
        System.out.println("Balance: " + acc.balance);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Balance: 750.75</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Return Values
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A method can send a result back with the return statement. The type of the returned value must match the return type in the declaration. A method with return type void returns nothing. A method may also return an object.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int midterm, finals;

    Student(String name, int midterm, int finals) &#123;
        this.name = name;
        this.midterm = midterm;
        this.finals = finals;
    }

    double average() &#123; return (midterm + finals) / 2.0; }

    boolean hasPassed() &#123; return average() &gt;= 75; }

    String summary() &#123;
        return name + " (" + average() + ")";
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student("Ana", 88, 92);
        System.out.println("Average: " + s.average());
        System.out.println("Passed: " + s.hasPassed());
        System.out.println("Summary: " + s.summary());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Average: 90.0
Passed: true
Summary: Ana (90.0)</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Passing Objects to Methods
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int grade;
    Student(String name, int grade) &#123; this.name = name; this.grade = grade; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student("Ana", 70);
        System.out.println("Before: " + s.grade);
        addBonus(s, 5);
        System.out.println("After:  " + s.grade);
    }

    static void addBonus(Student student, int bonus) &#123;
        student.grade += bonus;          // changes the object itself
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Before: 70
After:  75</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the main difference between an instance method and a static method?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> An instance method is called on an object and can use its attributes, while a static method belongs to the class and is called without an object.
        </p>

        <p class="text-white mt-4">
            How many copies of a static variable exist?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> One copy, shared by all objects of the class.
        </p>

        <p class="text-white mt-4">
            Can a method with return type void use a return statement?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Yes, but only as a plain return; that ends the method without giving a value.
        </p>

    </div>

</div>

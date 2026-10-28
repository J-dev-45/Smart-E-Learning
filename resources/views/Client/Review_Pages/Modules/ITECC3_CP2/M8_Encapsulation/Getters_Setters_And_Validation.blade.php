{{-- TOPIC 8.2: GETTERS, SETTERS, AND VALIDATION --}}
<div class="mt-10" id="topic-getters-setters-and-validation">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.2 Getters, Setters, and Validation
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If attributes are private, how can other classes use them? The class provides public methods for this purpose. A method that reads a private attribute is called a getter (also called an accessor), and a method that changes it is called a setter (also called a mutator). The big advantage is that a setter can check the new value before accepting it.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Getters and Setters
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        By convention, a getter is named getAttribute and returns the value, and a setter is named setAttribute and takes a parameter. For a boolean attribute, the getter is usually named isAttribute.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>private String name;

public String getName() &#123;          // getter
    return name;
}

public void setName(String name) &#123; // setter
    this.name = name;
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Validation in Setters
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Validation means checking that data is acceptable before it is stored. A setter can reject empty names, negative amounts, or grades outside the range 0 to 100. This is the main reason to use setters instead of public attributes.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    private String name;
    private int grade;

    Student(String name, int grade) &#123;
        setName(name);
        setGrade(grade);
    }

    public String getName() &#123; return name; }

    public void setName(String name) &#123;
        if (name != null &amp;&amp; !name.trim().isEmpty()) &#123;
            this.name = name.trim();
        } else &#123;
            System.out.println("Invalid name ignored");
        }
    }

    public int getGrade() &#123; return grade; }

    public void setGrade(int grade) &#123;
        if (grade &gt;= 0 &amp;&amp; grade &lt;= 100) &#123;
            this.grade = grade;
        } else &#123;
            System.out.println("Invalid grade ignored: " + grade);
        }
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student("Ana", 88);
        System.out.println(s.getName() + ": " + s.getGrade());

        s.setGrade(95);
        System.out.println("After setGrade(95): " + s.getGrade());

        s.setGrade(150);                         // invalid
        System.out.println("After setGrade(150): " + s.getGrade());

        s.setGrade(-10);                         // invalid
        System.out.println("After setGrade(-10): " + s.getGrade());

        s.setName("   ");                        // invalid
        System.out.println("Name is still: " + s.getName());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana: 88
After setGrade(95): 95
Invalid grade ignored: 150
After setGrade(150): 95
Invalid grade ignored: -10
After setGrade(-10): 95
Invalid name ignored
Name is still: Ana</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Notice that the constructor also uses the setters, so the same rules apply when the object is created.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Read-Only and Computed Properties
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Not every private attribute needs a setter. An attribute with only a getter is read-only from outside. A getter can also compute a value from other attributes without storing it.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Rectangle &#123;
    private static int nextId = 1;
    private final int id;               // read-only: no setter
    private double width, height;

    Rectangle(double width, double height) &#123;
        this.id = nextId++;
        this.width = width;
        this.height = height;
    }

    public int getId() &#123; return id; }
    public void setWidth(double width) &#123; if (width &gt; 0) this.width = width; }
    public double getArea() &#123; return width * height; }   // computed
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Rectangle r = new Rectangle(4, 5);
        System.out.println("ID: " + r.getId());
        System.out.println("Area: " + r.getArea());
        r.setWidth(10);
        System.out.println("New area: " + r.getArea());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>ID: 1
Area: 20.0
New area: 50.0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Guidelines
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Make attributes private by default.
        </li>

        <li>
            Provide a getter only when other classes need to read the value.
        </li>

        <li>
            Provide a setter only when other classes should be allowed to change it, and validate the input.
        </li>

        <li>
            Keep getters and setters simple. Put real work in other methods with meaningful names, such as deposit().
        </li>

        <li>
            Be careful when returning arrays or objects from getters, because the caller receives a reference to the same object.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between a getter and a setter?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A getter returns the value of a private attribute, while a setter changes it, usually after validating the new value.
        </p>

        <p class="text-white mt-4">
            Why use a setter instead of a public attribute?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A setter can validate the new value, so the object never holds invalid data.
        </p>

        <p class="text-white mt-4">
            What makes an attribute read-only from outside the class?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Providing a getter but no setter.
        </p>

    </div>

</div>

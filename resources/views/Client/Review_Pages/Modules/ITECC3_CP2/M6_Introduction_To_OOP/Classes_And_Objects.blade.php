{{-- TOPIC 6.2: CLASSES AND OBJECTS --}}
<div class="mt-10" id="topic-classes-and-objects">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        6.2 Classes and Objects
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Classes and objects are the building blocks of OOP. A class describes what a kind of thing is and does, and an object is one particular thing of that kind. A cookie cutter and the cookies it makes are a good comparison: one cutter (the class) can make many cookies (the objects), and each cookie can be decorated differently.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Class and Object
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Class
            </h4>

            <p class="text-gray-400 mt-2">
                A blueprint or template. It defines the attributes (variables) and methods (actions) that its objects will have. It does not use memory for data until an object is created.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Object
            </h4>

            <p class="text-gray-400 mt-2">
                An instance of a class. It has its own copy of the attributes, with its own values, and it can perform the methods of its class.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Attributes and Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Attributes, also called fields or instance variables, store the state of an object. Methods define its behavior. For a Student class, the attributes might be studentName, studentID, course, and yearLevel, and the methods might be displayInformation() and calculateGrade().
    </p>

    <h3 class="text-xl font-bold mt-6">
        Creating a Class
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    // attributes
    String studentName;
    String studentID;
    String course;
    int yearLevel;

    // methods
    void displayInformation() &#123;
        System.out.println(studentID + " | " + studentName
                + " | " + course + " | Year " + yearLevel);
    }
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Creating Objects and Accessing Attributes
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Use the new keyword to create an object, and the dot operator to reach its attributes and methods. Each object has its own values.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String studentName;
    String studentID;
    String course;
    int yearLevel;

    void displayInformation() &#123;
        System.out.println(studentID + " | " + studentName
                + " | " + course + " | Year " + yearLevel);
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s1 = new Student();
        s1.studentName = "Ana Reyes";
        s1.studentID = "2026-001";
        s1.course = "BSIT";
        s1.yearLevel = 2;

        Student s2 = new Student();
        s2.studentName = "Ben Cruz";
        s2.studentID = "2026-002";
        s2.course = "BSCS";
        s2.yearLevel = 1;

        s1.displayInformation();
        s2.displayInformation();

        s2.yearLevel = 2;                       // change one attribute
        System.out.println(s2.studentName + " is now in year " + s2.yearLevel);
        System.out.println(s1.studentName + " is still in year " + s1.yearLevel);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>2026-001 | Ana Reyes | BSIT | Year 2
2026-002 | Ben Cruz | BSCS | Year 1
Ben Cruz is now in year 2
Ana Reyes is still in year 2</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Changing s2 does not affect s1, because each object has its own copy of the attributes.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Methods That Use the Object's Data
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String studentName;
    double prelim, midterm, finals;

    double calculateGrade() &#123;
        return (prelim + midterm + finals) / 3;
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s = new Student();
        s.studentName = "Cara Lim";
        s.prelim = 85;
        s.midterm = 90;
        s.finals = 88;
        System.out.println(s.studentName + " average: " + s.calculateGrade());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Cara Lim average: 87.66666666666667</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        References and null
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A variable of a class type does not hold the object itself, but a reference to it. Two variables can refer to the same object, and a variable can hold null, meaning it refers to no object. Calling a method through a null reference causes a NullPointerException.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student a = new Student();
        a.name = "Ana";
        Student b = a;                  // b refers to the same object
        b.name = "Ben";
        System.out.println(a.name);     // the object changed for both

        Student c = null;
        try &#123;
            System.out.println(c.name);
        } catch (NullPointerException e) &#123;
            System.out.println("c does not refer to any object");
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ben
c does not refer to any object</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        An Array of Objects
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Arrays can store objects. Creating the array does not create the objects: each element starts as null, and you must create each object yourself.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int grade;
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student[] list = new Student[3];
        String[] names = &#123;"Ana", "Ben", "Cara"};
        for (int i = 0; i &lt; list.length; i++) &#123;
            list[i] = new Student();
            list[i].name = names[i];
            list[i].grade = 80 + i * 5;
        }
        for (Student s : list) &#123;
            System.out.println(s.name + ": " + s.grade);
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana: 80
Ben: 85
Cara: 90</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between a class and an object?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A class is a blueprint that defines attributes and methods, while an object is a specific instance created from that class.
        </p>

        <p class="text-white mt-4">
            How do you access a method of an object?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Use the object name, the dot operator, and the method name, such as s1.displayInformation().
        </p>

        <p class="text-white mt-4">
            What happens when you create an array of objects with new Student[3]?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It creates three empty references (null). You must create each Student object separately.
        </p>

    </div>

</div>

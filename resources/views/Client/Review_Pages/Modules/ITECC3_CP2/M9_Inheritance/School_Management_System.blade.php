{{-- TOPIC 9.3: LABORATORY: SCHOOL MANAGEMENT SYSTEM --}}
<div class="mt-10" id="topic-laboratory-school-management-system">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        9.3 Laboratory: School Management System
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A school has different kinds of people: students, teachers, and administrators. They all have a name and an ID, but each has information and responsibilities of its own. This is a perfect case for inheritance: the shared parts go in a superclass called Person, and each kind of person is a subclass that adds its own data and overrides the display behavior.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Designing the Hierarchy
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Class Design
        </h4>

        <p class="text-white mt-3">
            Person: name, id, displayInfo()
        </p>

        <p class="text-gray-400 mt-2">
            Student extends Person: course, yearLevel, overrides displayInfo()
        </p>

        <p class="text-gray-400 mt-2">
            Teacher extends Person: department, overrides displayInfo()
        </p>

        <p class="text-gray-400 mt-2">
            Administrator extends Person: office, overrides displayInfo()
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Program
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Person &#123;
    protected String name;
    protected String id;

    Person(String name, String id) &#123;
        this.name = name;
        this.id = id;
    }

    void displayInfo() &#123;
        System.out.println("[" + id + "] " + name);
    }
}

class Student extends Person &#123;
    private String course;
    private int yearLevel;

    Student(String name, String id, String course, int yearLevel) &#123;
        super(name, id);
        this.course = course;
        this.yearLevel = yearLevel;
    }

    &#64;Override
    void displayInfo() &#123;
        super.displayInfo();
        System.out.println("    Student - " + course + ", Year " + yearLevel);
    }
}

class Teacher extends Person &#123;
    private String department;

    Teacher(String name, String id, String department) &#123;
        super(name, id);
        this.department = department;
    }

    &#64;Override
    void displayInfo() &#123;
        super.displayInfo();
        System.out.println("    Teacher - Department of " + department);
    }
}

class Administrator extends Person &#123;
    private String office;

    Administrator(String name, String id, String office) &#123;
        super(name, id);
        this.office = office;
    }

    &#64;Override
    void displayInfo() &#123;
        super.displayInfo();
        System.out.println("    Administrator - " + office + " Office");
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Person[] people = &#123;
            new Student("Ana Reyes", "S-001", "BSIT", 2),
            new Student("Ben Cruz", "S-002", "BSCS", 1),
            new Teacher("Mr. Santos", "T-101", "Information Technology"),
            new Administrator("Ms. Lim", "A-201", "Registrar")
        };

        System.out.println("=== School Directory ===");
        for (Person p : people) &#123;
            p.displayInfo();
        }

        int students = 0;
        for (Person p : people) &#123;
            if (p instanceof Student) students++;
        }
        System.out.println();
        System.out.println("Number of students: " + students);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>=== School Directory ===
[S-001] Ana Reyes
    Student - BSIT, Year 2
[S-002] Ben Cruz
    Student - BSCS, Year 1
[T-101] Mr. Santos
    Teacher - Department of Information Technology
[A-201] Ms. Lim
    Administrator - Registrar Office

Number of students: 2</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        What the Program Demonstrates
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Reuse
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                name, id, and the basic displayInfo() are written once in Person.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Extension
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Each subclass adds its own private attribute and a constructor that calls super(...).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Overriding
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Each subclass overrides displayInfo() and uses super.displayInfo() to include the shared part.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                A Preview of Polymorphism
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The array holds Person references, yet each element prints in its own way. The next module explains why this works.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Ideas for Extension
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Add a Graduate class that extends Student, to try multilevel inheritance.
        </li>

        <li>
            Add a salary attribute to Teacher and Administrator.
        </li>

        <li>
            Add a method to search the directory by ID using linear search.
        </li>

        <li>
            Add a method that counts how many people of each type are in the school.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why is name placed in the Person class and not in each subclass?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because all kinds of people share it, so it is written once and reused through inheritance.
        </p>

        <p class="text-white mt-4">
            What does super.displayInfo() do inside Student?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It runs the superclass version first, so the shared information is printed before the student-specific information.
        </p>

        <p class="text-white mt-4">
            Why can an array of Person hold Student and Teacher objects?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because a Student and a Teacher are both kinds of Person, so they can be stored in a Person reference.
        </p>

    </div>

</div>

{{-- TOPIC 7.3: METHOD OVERLOADING AND THE STUDENT INFORMATION SYSTEM --}}
<div class="mt-10" id="topic-method-overloading-and-the-student-information-system">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        7.3 Method Overloading and the Student Information System
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Method overloading lets a class have several methods with the same name, as long as their parameter lists are different. This keeps the interface simple, because one meaningful name can be used for related tasks, such as printing different kinds of information. After studying overloading, you will apply constructors and methods to build a small Student Information System.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Method Overloading
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Overloaded methods must differ in the number of parameters, the types of the parameters, or the order of the types. The return type alone is not enough to tell them apart. When you call the method, Java chooses the version that matches your arguments.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Calculator &#123;
    int add(int a, int b)              &#123; return a + b; }
    double add(double a, double b)     &#123; return a + b; }
    int add(int a, int b, int c)       &#123; return a + b + c; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Calculator c = new Calculator();
        System.out.println(c.add(2, 3));
        System.out.println(c.add(2.5, 3.5));
        System.out.println(c.add(1, 2, 3));
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>5
6.0
6</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Valid and Invalid Overloading
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Valid
            </h4>

            <p class="text-gray-400 mt-2">
                add(int, int) and add(double, double): different parameter types. add(int, int) and add(int, int, int): different number of parameters.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Invalid
            </h4>

            <p class="text-gray-400 mt-2">
                int add(int, int) and double add(int, int): only the return type is different. This causes a compile error.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Laboratory: Student Information System
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        This system stores the information of students and works with their grades. Each Student has an ID, a name, a course, a year level, and an array of grades. It uses a parameterized constructor, an overloaded display method, and methods that return values.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    private String id;
    private String name;
    private String course;
    private int yearLevel;
    private int[] grades;
    private static int total = 0;

    Student(String id, String name, String course, int yearLevel, int[] grades) &#123;
        this.id = id;
        this.name = name;
        this.course = course;
        this.yearLevel = yearLevel;
        this.grades = grades;
        total++;
    }

    double average() &#123;
        int sum = 0;
        for (int g : grades) sum += g;
        return (double) sum / grades.length;
    }

    String remarks() &#123;
        return average() &gt;= 75 ? "Passed" : "Failed";
    }

    void display() &#123;
        System.out.println(id + " | " + name + " | " + course + " | Year " + yearLevel
                + " | Avg " + String.format("%.2f", average()) + " | " + remarks());
    }

    void display(boolean detailed) &#123;
        display();
        if (detailed) &#123;
            System.out.println("Grades: " + java.util.Arrays.toString(grades));
        }
    }

    static int getTotal() &#123; return total; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student[] students = new Student[3];
        students[0] = new Student("2026-001", "Ana Reyes", "BSIT", 2, new int[]&#123;88, 92, 85});
        students[1] = new Student("2026-002", "Ben Cruz", "BSCS", 1, new int[]&#123;72, 70, 68});
        students[2] = new Student("2026-003", "Cara Lim", "BSIT", 3, new int[]&#123;95, 91, 97});

        System.out.println("=== Student Information System ===");
        for (Student s : students) &#123;
            s.display();
        }

        System.out.println();
        System.out.println("--- Detailed view ---");
        students[2].display(true);

        System.out.println();
        System.out.println("Total students: " + Student.getTotal());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>=== Student Information System ===
2026-001 | Ana Reyes | BSIT | Year 2 | Avg 88.33 | Passed
2026-002 | Ben Cruz | BSCS | Year 1 | Avg 70.00 | Failed
2026-003 | Cara Lim | BSIT | Year 3 | Avg 94.33 | Passed

--- Detailed view ---
2026-003 | Cara Lim | BSIT | Year 3 | Avg 94.33 | Passed
Grades: [95, 91, 97]

Total students: 3</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The two display methods are overloads of each other: one has no parameter and the other has a boolean. The attributes are marked private so they can be changed only through the class itself, an idea that is the topic of the next module on encapsulation.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Design Checklist
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Use constructors so that every object starts with valid data.
        </li>

        <li>
            Use methods that return values (average, remarks) for calculations, and methods that print for display.
        </li>

        <li>
            Use overloading when several methods do the same kind of task with different inputs.
        </li>

        <li>
            Use a static variable for information that belongs to the whole class, such as a count.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What must be different in overloaded methods?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The number, types, or order of the parameters. The return type alone is not enough.
        </p>

        <p class="text-white mt-4">
            Why is the total attribute static in the Student class?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because it counts all students and belongs to the class, not to a single student.
        </p>

        <p class="text-white mt-4">
            Which parts of the system return values?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Methods such as average() and remarks() return a double and a String.
        </p>

    </div>

</div>

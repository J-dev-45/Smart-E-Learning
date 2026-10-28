{{-- TOPIC 12.2: LABORATORY: STUDENT MANAGEMENT AND RANKING SYSTEM --}}
<div class="mt-10" id="topic-laboratory-student-management-and-ranking-system">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        12.2 Laboratory: Student Management and Ranking System
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        This laboratory combines everything in the course. The Student Management and Ranking System stores students in an array of objects, adds and displays records, searches for a student by ID, computes statistics, and ranks the students by their average grade using a sorting algorithm. The design uses encapsulation, inheritance, abstraction, and polymorphism.
    </p>

    <h3 class="text-xl font-bold mt-6">
        System Requirements
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Store a list of students in an array.
        </li>

        <li>
            Add a student record and avoid duplicate IDs.
        </li>

        <li>
            Display all records.
        </li>

        <li>
            Search for a student by ID (searching algorithm).
        </li>

        <li>
            Rank the students from the highest to the lowest average (sorting algorithm).
        </li>

        <li>
            Compute the class average and find the highest and lowest averages.
        </li>

        <li>
            Protect the data with private attributes and validation.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Class Design
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Classes and Their Roles
        </h4>

        <p class="text-white mt-3">
            Person (abstract): name, id, and an abstract method getRole().
        </p>

        <p class="text-gray-400 mt-2">
            Student extends Person: three grades, average(), remarks(), validation, and toString().
        </p>

        <p class="text-gray-400 mt-2">
            StudentManager: holds the Student array and the count, and has the add, find, rank, and report methods.
        </p>

        <p class="text-gray-400 mt-2">
            Main: creates the manager and runs the demonstration.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Complete Program
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>abstract class Person &#123;
    protected String id;
    protected String name;

    Person(String id, String name) &#123;
        this.id = id;
        this.name = name;
    }

    String getId() &#123; return id; }
    String getName() &#123; return name; }

    abstract String getRole();
}

class Student extends Person &#123;
    private double prelim, midterm, finals;

    Student(String id, String name, double prelim, double midterm, double finals) &#123;
        super(id, name);
        this.prelim = valid(prelim);
        this.midterm = valid(midterm);
        this.finals = valid(finals);
    }

    private double valid(double g) &#123;
        return (g &gt;= 0 &amp;&amp; g &lt;= 100) ? g : 0;     // reject invalid grades
    }

    double average() &#123; return (prelim + midterm + finals) / 3; }

    String remarks() &#123; return average() &gt;= 75 ? "Passed" : "Failed"; }

    &#64;Override
    String getRole() &#123; return "Student"; }

    &#64;Override
    public String toString() &#123;
        return String.format("%-6s %-12s %6.2f  %s", id, name, average(), remarks());
    }
}

class StudentManager &#123;
    private Student[] students;
    private int count;

    StudentManager(int capacity) &#123;
        students = new Student[capacity];
        count = 0;
    }

    void addStudent(Student s) &#123;
        if (count == students.length) &#123;
            System.out.println("List is full. Cannot add " + s.getName());
            return;
        }
        if (indexOf(s.getId()) != -1) &#123;                 // uses linear search
            System.out.println("Duplicate ID " + s.getId() + " rejected");
            return;
        }
        students[count++] = s;
        System.out.println("Added " + s.getName());
    }

    private int indexOf(String id) &#123;                    // linear search
        for (int i = 0; i &lt; count; i++) &#123;
            if (students[i].getId().equals(id)) return i;
        }
        return -1;
    }

    void search(String id) &#123;
        int pos = indexOf(id);
        if (pos == -1) System.out.println(id + ": not found");
        else System.out.println("Found at position " + pos + ": " + students[pos]);
    }

    void displayAll() &#123;
        for (int i = 0; i &lt; count; i++) &#123;
            System.out.println(students[i]);
        }
    }

    void rank() &#123;                                       // selection sort on a copy
        Student[] sorted = java.util.Arrays.copyOf(students, count);
        for (int i = 0; i &lt; sorted.length - 1; i++) &#123;
            int best = i;
            for (int j = i + 1; j &lt; sorted.length; j++) &#123;
                if (sorted[j].average() &gt; sorted[best].average()) best = j;
            }
            Student temp = sorted[best];
            sorted[best] = sorted[i];
            sorted[i] = temp;
        }
        for (int i = 0; i &lt; sorted.length; i++) &#123;
            System.out.println((i + 1) + ". " + sorted[i].getName()
                    + " - " + String.format("%.2f", sorted[i].average()));
        }
    }

    void report() &#123;
        double total = 0;
        Student top = students[0], low = students[0];
        int passed = 0;
        for (int i = 0; i &lt; count; i++) &#123;
            total += students[i].average();
            if (students[i].average() &gt; top.average()) top = students[i];
            if (students[i].average() &lt; low.average()) low = students[i];
            if (students[i].average() &gt;= 75) passed++;
        }
        System.out.println("Students:      " + count);
        System.out.println("Class average: " + String.format("%.2f", total / count));
        System.out.println("Highest:       " + top.getName() + " (" + String.format("%.2f", top.average()) + ")");
        System.out.println("Lowest:        " + low.getName() + " (" + String.format("%.2f", low.average()) + ")");
        System.out.println("Passed:        " + passed + " of " + count);
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        StudentManager manager = new StudentManager(10);

        manager.addStudent(new Student("S-101", "Ana Reyes", 88, 92, 85));
        manager.addStudent(new Student("S-102", "Ben Cruz", 72, 68, 75));
        manager.addStudent(new Student("S-103", "Cara Lim", 95, 91, 97));
        manager.addStudent(new Student("S-104", "Dino Tan", 80, 85, 78));
        manager.addStudent(new Student("S-102", "Duplicate", 70, 70, 70));   // rejected
        manager.addStudent(new Student("S-105", "Ella Go", 101, 90, 90));    // invalid grade fixed to 0

        System.out.println();
        System.out.println("=== All Students ===");
        manager.displayAll();

        System.out.println();
        System.out.println("=== Search ===");
        manager.search("S-103");
        manager.search("S-999");

        System.out.println();
        System.out.println("=== Ranking ===");
        manager.rank();

        System.out.println();
        System.out.println("=== Class Report ===");
        manager.report();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Added Ana Reyes
Added Ben Cruz
Added Cara Lim
Added Dino Tan
Duplicate ID S-102 rejected
Added Ella Go

=== All Students ===
S-101  Ana Reyes     88.33  Passed
S-102  Ben Cruz      71.67  Failed
S-103  Cara Lim      94.33  Passed
S-104  Dino Tan      81.00  Passed
S-105  Ella Go       60.00  Failed

=== Search ===
Found at position 2: S-103  Cara Lim      94.33  Passed
S-999: not found

=== Ranking ===
1. Cara Lim - 94.33
2. Ana Reyes - 88.33
3. Dino Tan - 81.00
4. Ben Cruz - 71.67
5. Ella Go - 60.00

=== Class Report ===
Students:      5
Class average: 79.07
Highest:       Cara Lim (94.33)
Lowest:        Ella Go (60.00)
Passed:        3 of 5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Where Each Concept Appears
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arrays
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The Student array in StudentManager, and the copy used for ranking.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Searching
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                indexOf() is a linear search, used by search() and to detect duplicates.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Sorting
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                rank() uses selection sort on the average grade. The original array order is kept because a copy is sorted.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Encapsulation
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The grades are private. The constructor validates them, so an invalid grade can never be stored.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Inheritance and Abstraction
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Student extends the abstract class Person and implements getRole(). Person holds the shared data.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Polymorphism
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                toString() and getRole() are overridden, and println() calls the right toString() automatically.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Algorithm Analysis of the System
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Search
            </h4>

            <p class="text-gray-400 mt-2">
                Linear search: O(n) per search. Fine for a class list. For thousands of records, sort by ID and use binary search.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Ranking
            </h4>

            <p class="text-gray-400 mt-2">
                Selection sort: O(n squared). For a very large school, replace it with merge sort or quick sort, O(n log n).
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Ideas to Improve the System
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Add a Teacher class and use an array of Person to hold both kinds, using polymorphism.
        </li>

        <li>
            Add a menu with a Scanner so the user can choose the actions.
        </li>

        <li>
            Sort by name using compareTo() on Strings.
        </li>

        <li>
            Replace the array with an ArrayList once you have studied collections.
        </li>

        <li>
            Add a method that removes a student, using the shifting technique from array manipulation.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why does rank() sort a copy of the array?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> So the original order of the records is not changed, while the ranking is displayed.
        </p>

        <p class="text-white mt-4">
            Which algorithms are used in this system?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Linear search for finding a student, and selection sort for ranking.
        </p>

        <p class="text-white mt-4">
            How does the system protect against invalid grades?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The grades are private, and the constructor validates each grade, replacing invalid values with 0.
        </p>

    </div>

</div>

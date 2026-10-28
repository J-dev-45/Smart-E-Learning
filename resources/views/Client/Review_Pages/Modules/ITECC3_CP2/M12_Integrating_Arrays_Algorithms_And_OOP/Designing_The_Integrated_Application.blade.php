{{-- TOPIC 12.1: INTEGRATING ARRAYS, ALGORITHMS, AND OOP --}}
<div class="mt-10" id="topic-integrating-arrays-algorithms-and-oop">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        12.1 Integrating Arrays, Algorithms, and OOP
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Throughout this course you learned separate tools: arrays store collections of data, searching and sorting algorithms process that data, algorithm analysis helps you choose the right algorithm, and object-oriented design organizes everything into classes. Real programs use all of them together. This final module shows how they fit and how to design a complete application.
    </p>

    <h3 class="text-xl font-bold mt-6">
        How the Pieces Fit Together
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Arrays
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Hold collections of data. In OOP programs, arrays often hold objects, such as an array of Student objects.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Searching Algorithms
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Find an object in the collection by a key, such as a student ID (linear search) or by a sorted key (binary search).
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Sorting Algorithms
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Arrange the objects by a field, such as sorting students by grade to produce a ranking.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Algorithm Analysis
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Guides your choice. A few dozen students can be sorted with insertion sort, while a million records call for merge sort or quick sort.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Classes and Objects
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Package the data and behavior of each real-world thing.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                OOP Principles
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Encapsulation protects the data, inheritance shares code between related classes, polymorphism and abstraction make the system general and easy to extend.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        An Array of Objects
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The central structure of an integrated program is an array of objects. Because the array has a fixed size, we keep a separate counter that tells how many positions are actually used. New objects are added at index count, and the algorithms work only up to count.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    private String id;
    private String name;
    private double grade;

    Student(String id, String name, double grade) &#123;
        this.id = id;
        this.name = name;
        this.grade = grade;
    }

    String getId() &#123; return id; }
    String getName() &#123; return name; }
    double getGrade() &#123; return grade; }

    &#64;Override
    public String toString() &#123; return id + " " + name + " " + grade; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student[] list = new Student[5];
        int count = 0;

        list[count++] = new Student("S-103", "Cara", 91);
        list[count++] = new Student("S-101", "Ana", 85);
        list[count++] = new Student("S-102", "Ben", 78);

        for (int i = 0; i &lt; count; i++) &#123;
            System.out.println(list[i]);
        }
        System.out.println("Used: " + count + " of " + list.length);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>S-103 Cara 91.0
S-101 Ana 85.0
S-102 Ben 78.0
Used: 3 of 5</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Searching Objects
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Searching an array of objects compares a field of each object with the key. Use equals() for Strings and == for numbers. Remember to stop at count, not at the array length, because the remaining positions are null.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    private String id, name;
    private double grade;
    Student(String id, String name, double grade) &#123; this.id = id; this.name = name; this.grade = grade; }
    String getId() &#123; return id; }
    String getName() &#123; return name; }
    double getGrade() &#123; return grade; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student[] list = &#123;
            new Student("S-103", "Cara", 91),
            new Student("S-101", "Ana", 85),
            new Student("S-102", "Ben", 78)
        };
        System.out.println("Search S-101: " + describe(findById(list, list.length, "S-101")));
        System.out.println("Search S-999: " + describe(findById(list, list.length, "S-999")));
    }

    static Student findById(Student[] list, int count, String id) &#123;
        for (int i = 0; i &lt; count; i++) &#123;
            if (list[i].getId().equals(id)) return list[i];
        }
        return null;
    }

    static String describe(Student s) &#123;
        return s == null ? "not found" : s.getName();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Search S-101: Ana
Search S-999: not found</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Sorting Objects
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To sort objects, compare a field but move the whole object. The following selection sort arranges students from the highest to the lowest grade.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    private String id, name;
    private double grade;
    Student(String id, String name, double grade) &#123; this.id = id; this.name = name; this.grade = grade; }
    String getId() &#123; return id; }
    String getName() &#123; return name; }
    double getGrade() &#123; return grade; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student[] list = &#123;
            new Student("S-103", "Cara", 91),
            new Student("S-101", "Ana", 85),
            new Student("S-102", "Ben", 78),
            new Student("S-104", "Dino", 96)
        };

        for (int i = 0; i &lt; list.length - 1; i++) &#123;
            int best = i;
            for (int j = i + 1; j &lt; list.length; j++) &#123;
                if (list[j].getGrade() &gt; list[best].getGrade()) best = j;
            }
            Student temp = list[best];
            list[best] = list[i];
            list[i] = temp;
        }

        for (int i = 0; i &lt; list.length; i++) &#123;
            System.out.println("Rank " + (i + 1) + ": " + list[i].getName() + " (" + list[i].getGrade() + ")");
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Rank 1: Dino (96.0)
Rank 2: Cara (91.0)
Rank 3: Ana (85.0)
Rank 4: Ben (78.0)</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes When Combining
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Looping to array.length instead of count, which reaches null elements and causes a NullPointerException
        </li>

        <li>
            Forgetting to create each object after creating the array
        </li>

        <li>
            Sorting only the grade values and leaving the names in their old order, which breaks the records
        </li>

        <li>
            Comparing Strings with == instead of equals()
        </li>

        <li>
            Using binary search without sorting by the same field first
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Design Checklist
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            What are the real-world things? Make each a class.
        </li>

        <li>
            Which data does each class hold? Make it private and add getters, and setters with validation where needed.
        </li>

        <li>
            Which collections are needed? Use arrays of objects.
        </li>

        <li>
            Which operations are needed? Add, display, search, sort, compute statistics. Write each as a method.
        </li>

        <li>
            Which algorithm is appropriate for the size and order of the data?
        </li>

        <li>
            Do some classes share data and behavior? Use inheritance, abstract classes, or interfaces.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why do we keep a count variable for an array of objects?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The array has a fixed size, so count tells how many positions are really used, and the algorithms must stop at count.
        </p>

        <p class="text-white mt-4">
            What must you do after creating Student[] list = new Student[5]; before using list[0]?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Create the object with new Student(...), because the elements are null until assigned.
        </p>

        <p class="text-white mt-4">
            When sorting objects, what is compared and what is moved?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A field of the object is compared, but the whole object (reference) is moved.
        </p>

    </div>

</div>

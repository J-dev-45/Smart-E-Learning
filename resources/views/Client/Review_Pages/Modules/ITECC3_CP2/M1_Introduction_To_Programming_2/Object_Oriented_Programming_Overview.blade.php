{{-- TOPIC 1.4: OBJECT-ORIENTED PROGRAMMING OVERVIEW --}}
<div class="mt-10" id="topic-object-oriented-programming-overview">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1.4 Object-Oriented Programming Overview
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Object-oriented programming, or OOP, is a paradigm that organizes a program as a collection of objects. An object represents something from the real world or from the problem, such as a student, a bank account, or a shape. It keeps its own data, called attributes, together with the actions that can be done with that data, called methods.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Procedural and Object-Oriented Side by Side
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The two programs below solve the same problem. The first keeps the data in arrays and uses a separate method. The second creates a Student object that holds its own data and knows how to display itself.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void show(String name, int grade) &#123;
    System.out.println(name + " - " + grade);
}

String[] names = &#123;"Ana", "Ben"};
int[] grades = &#123;90, 72};
for (int i = 0; i &lt; names.length; i++) &#123;
    show(names[i], grades[i]);
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana - 90
Ben - 72</code></pre>
    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int grade;

    Student(String name, int grade) &#123;
        this.name = name;
        this.grade = grade;
    }

    void show() &#123;
        System.out.println(name + " - " + grade);
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student s1 = new Student("Ana", 90);
        Student s2 = new Student("Ben", 72);
        s1.show();
        s2.show();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana - 90
Ben - 72</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        The Main Ideas of OOP
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Class
            </h4>

            <p class="text-gray-400 mt-2">
                A blueprint that describes the attributes and methods of a kind of object, such as Student.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Object
            </h4>

            <p class="text-gray-400 mt-2">
                A real instance created from a class, such as the student Ana.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Attribute
            </h4>

            <p class="text-gray-400 mt-2">
                Data stored in an object, such as name and grade.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Method
            </h4>

            <p class="text-gray-400 mt-2">
                An action an object can perform, such as show().
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Four Pillars of OOP
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Encapsulation
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Keeping data private inside a class and giving controlled access through methods. It protects the data from invalid changes.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Inheritance
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Letting a new class reuse the attributes and methods of an existing class. A Student can inherit from Person.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Polymorphism
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Letting the same method call behave differently depending on the object. makeSound() sounds different for a Dog and a Cat.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Abstraction
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Showing only what is necessary and hiding the details. A Shape promises an area, and each shape decides how to compute it.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        These four ideas are studied one by one in the later modules of this course, after you have learned arrays, searching, and sorting.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Advantages of OOP
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Code is organized into small, understandable units.
        </li>

        <li>
            Classes can be reused in many programs.
        </li>

        <li>
            Changes to one class do not break the rest of the program.
        </li>

        <li>
            Programs model real-world things naturally.
        </li>

        <li>
            Teams can work on different classes at the same time.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        When Is OOP Appropriate?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Object-oriented design is most useful when a program deals with several kinds of things that have both data and behavior, such as students, teachers, accounts, products, or shapes, and when the program is expected to grow or change. For a very small calculation, a few lines of procedural code may be enough. Part of becoming a better programmer is knowing which technique fits the situation.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Roadmap of This Course
    </h3>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            From Arrays to Objects
        </h4>

        <p class="text-white mt-3">
            Arrays store many values.
        </p>

        <p class="text-gray-400 mt-2">
            Searching and sorting algorithms process the data.
        </p>

        <p class="text-gray-400 mt-2">
            Algorithm analysis explains which algorithm is more efficient.
        </p>

        <p class="text-gray-400 mt-2">
            Classes and objects group data and behavior.
        </p>

        <p class="text-gray-400 mt-2">
            Encapsulation, inheritance, polymorphism, and abstraction make the design strong.
        </p>

        <p class="text-gray-400 mt-2">
            Finally, everything is combined in one integrated application.
        </p>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What are the four pillars of OOP?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Encapsulation, inheritance, polymorphism, and abstraction.
        </p>

        <p class="text-white mt-4">
            What is the difference between a class and an object?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A class is a blueprint, while an object is an actual instance created from that class.
        </p>

        <p class="text-white mt-4">
            Give one advantage of OOP over procedural programming.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Related data and actions are kept together, which makes large programs easier to organize, reuse, and maintain.
        </p>

    </div>

</div>

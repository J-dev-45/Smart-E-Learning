{{-- TOPIC 2.3: INSTANTIATING A CLASS, IDENTIFIERS, AND JAVA KEYWORDS --}}
<div class="mt-10" id="topic-instantiating-a-class-identifiers-and-java-keywords">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.3 Instantiating a Class, Identifiers, and Java Keywords
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Instantiating a Class
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A class is only a blueprint, like the plan of a house. To use it, you create an object, which is a real instance of the class, like an actual house built from the plan. This process is called instantiation, and it uses the new keyword. You can create many objects from one class, and each one has its own data.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Main &#123;
    public static void main(String[] args) &#123;
        Student s1 = new Student();   // create an object
        s1.name = "Ana";              // use the dot operator
        s1.grade = 90;

        Student s2 = new Student();
        s2.name = "Ben";
        s2.grade = 72;

        s1.displayInfo();
        s2.displayInfo();
        System.out.println(s2.hasPassed());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Name: Ana
Grade: 90
Name: Ben
Grade: 72
false</code></pre>
    </div>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Student s1
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Declares a reference variable named s1 that can refer to a Student object.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                new Student()
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Creates the object in memory and calls the class constructor.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                The Dot Operator
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Used to reach a member of an object, such as s1.name or s1.displayInfo().
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Constructors
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A constructor is a special method that runs when an object is created. It has the same name as the class and no return type. It is usually used to set the starting values of the object. If you do not write one, Java provides a default constructor with no parameters.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Student &#123;
    String name;
    int grade;

    Student(String name, int grade) &#123;   // constructor
        this.name = name;
        this.grade = grade;
    }
}
// Student s = new Student("Ana", 90);</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Identifiers
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An identifier is a name that you give to a class, variable, method, or other item in your program. Java has rules for valid identifiers.
    </p>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Can contain letters, digits, underscores (_), and the dollar sign ($).
        </li>

        <li>
            Must not start with a digit.
        </li>

        <li>
            Cannot contain spaces or special symbols such as - or &#64;.
        </li>

        <li>
            Cannot be a Java keyword.
        </li>

        <li>
            Are case-sensitive: score and Score are different.
        </li>

    </ul>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Valid
            </h4>

            <p class="text-gray-400 mt-2">
                studentName, _total, score2, $price, MAX_SIZE
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Invalid
            </h4>

            <p class="text-gray-400 mt-2">
                2ndScore (starts with a digit), my name (space), total-score (dash), class (keyword)
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Naming Conventions
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Classes
            </h4>

            <p class="text-gray-400 mt-2">
                Use PascalCase: StudentRecord, BankAccount.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Variables and Methods
            </h4>

            <p class="text-gray-400 mt-2">
                Use camelCase: totalScore, computeAverage().
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Constants
            </h4>

            <p class="text-gray-400 mt-2">
                Use UPPER_CASE with underscores: MAX_SCORE, PI.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Choose meaningful names. A name like studentAge is far clearer than x or a. Clear names make code easier to read without comments.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Java Keywords
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Keywords are reserved words that already have a special meaning in Java, so they cannot be used as identifiers. All keywords are written in lowercase.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Data Types
            </h4>

            <p class="text-gray-400 mt-2">
                byte, short, int, long, float, double, char, boolean, void
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Control Flow
            </h4>

            <p class="text-gray-400 mt-2">
                if, else, switch, case, default, for, while, do, break, continue, return
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Class and Object
            </h4>

            <p class="text-gray-400 mt-2">
                class, interface, extends, implements, new, this, super, abstract, final, static
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Access and Others
            </h4>

            <p class="text-gray-400 mt-2">
                public, private, protected, package, import, try, catch, finally, throw, throws
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The words true, false, and null look like keywords but are technically literals. They are also reserved and cannot be used as names.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What keyword is used to create an object?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The new keyword.
        </p>

        <p class="text-white mt-4">
            Is 2ndScore a valid identifier? Why or why not?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> No, because an identifier cannot start with a digit.
        </p>

        <p class="text-white mt-4">
            What naming style is used for Java classes?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> PascalCase, where each word starts with a capital letter, such as BankAccount.
        </p>

    </div>

</div>

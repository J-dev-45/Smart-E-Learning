{{-- TOPIC 8.1: DATA HIDING AND ACCESS MODIFIERS --}}
<div class="mt-10" id="topic-data-hiding-and-access-modifiers">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.1 Data Hiding and Access Modifiers
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Imagine a bank account where anyone could write account.balance = 1000000 from anywhere in the program. Mistakes and misuse would be easy. Encapsulation protects data by bundling it with the methods that work on it and by controlling who may access it from outside the class. It is one of the four pillars of OOP.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Is Encapsulation?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Encapsulation means wrapping the data (attributes) and the methods that operate on the data into one unit, the class, and restricting direct access to the data. The attributes are made private, and the class provides public methods through which other code can read or change them in a controlled way. Think of a capsule: the medicine is inside, and you use it through the outer shell.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Data Hiding
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Data hiding is the practice of keeping the internal data of a class private, so outside code cannot see or change it directly. The class decides what to expose. Because the data can only be changed through the class's own methods, the class can make sure the data stays valid.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Access Modifiers
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Access modifiers are keywords that set the visibility of classes and members.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                private
            </h4>

            <p class="text-gray-400 mt-2">
                Visible only inside the same class. Used for attributes that must be protected.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                default (no keyword)
            </h4>

            <p class="text-gray-400 mt-2">
                Visible to classes in the same package.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                protected
            </h4>

            <p class="text-gray-400 mt-2">
                Visible in the same package and in subclasses, which are classes that extend it.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                public
            </h4>

            <p class="text-gray-400 mt-2">
                Visible everywhere. Used for methods that form the class's interface.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Without and With Encapsulation
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class BadAccount &#123;
    double balance;                           // public access: unsafe
}

class GoodAccount &#123;
    private double balance;                   // hidden

    GoodAccount(double initial) &#123;
        if (initial &gt;= 0) balance = initial;
    }

    void withdraw(double amount) &#123;
        if (amount &gt; 0 &amp;&amp; amount &lt;= balance) &#123;
            balance -= amount;
        } else &#123;
            System.out.println("Withdrawal rejected");
        }
    }

    double getBalance() &#123; return balance; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        BadAccount bad = new BadAccount();
        bad.balance = -5000;                  // nothing stops this
        System.out.println("BadAccount balance: " + bad.balance);

        GoodAccount good = new GoodAccount(1000);
        good.withdraw(5000);                  // rejected by the method
        System.out.println("GoodAccount balance: " + good.getBalance());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>BadAccount balance: -5000.0
Withdrawal rejected
GoodAccount balance: 1000.0</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If other code tries to write good.balance directly, the compiler reports an error: balance has private access in GoodAccount. The only way to use the balance is through the methods, and the methods check the rules.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Why Hide Data?
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            To prevent invalid values from being stored.
        </li>

        <li>
            To protect important data from accidental or harmful changes.
        </li>

        <li>
            To allow the internal design of a class to change without breaking the code that uses it.
        </li>

        <li>
            To make a class easier to use, because users only need to know its public methods.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is encapsulation?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Bundling data and the methods that use it in one class and restricting direct access to the data.
        </p>

        <p class="text-white mt-4">
            Which access modifier makes an attribute visible only inside its own class?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> private.
        </p>

        <p class="text-white mt-4">
            What error does the compiler give when you access a private attribute from another class?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> An error that the attribute has private access in that class.
        </p>

    </div>

</div>

{{-- TOPIC 8.3: BENEFITS OF ENCAPSULATION AND THE BANK ACCOUNT SYSTEM --}}
<div class="mt-10" id="topic-benefits-of-encapsulation-and-the-bank-account-system">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.3 Benefits of Encapsulation and the Bank Account System
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        You have seen how data hiding, getters, setters, and validation work. In this topic you will review the benefits of encapsulation and then apply everything in a Bank Account System, a classic example of why data must be protected.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Benefits of Encapsulation
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Control Over Data
            </h4>

            <p class="text-gray-400 mt-2">
                The class decides how its data may be read or changed, so it can enforce rules.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Data Integrity
            </h4>

            <p class="text-gray-400 mt-2">
                Invalid values are rejected, so objects are always in a valid state.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Flexibility
            </h4>

            <p class="text-gray-400 mt-2">
                The internal representation can change without affecting the code that uses the class, as long as the public methods stay the same.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Maintainability
            </h4>

            <p class="text-gray-400 mt-2">
                A bug in how data is changed can be found in one place, the class itself.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Security
            </h4>

            <p class="text-gray-400 mt-2">
                Sensitive data such as balances and passwords is not exposed directly.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Easier Testing and Reuse
            </h4>

            <p class="text-gray-400 mt-2">
                A class with a clear public interface can be tested and reused independently.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Flexibility Example
        </h4>

        <p class="text-white mt-3">
            A Student class stores a birth date. Later, the designer changes the class to store the birth year instead.
        </p>

        <p class="text-gray-400 mt-2">
            Because the age is obtained through getAge(), the code that calls getAge() does not need to change.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Laboratory: Bank Account System
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A bank account must never allow a negative deposit, an overdraft, or a direct change to its balance. The BankAccount class below keeps the balance private and changes it only through deposit() and withdraw(), which both validate the amount. It also keeps a transaction count.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class BankAccount &#123;
    private final String accountNumber;
    private String owner;
    private double balance;
    private int transactions;

    BankAccount(String accountNumber, String owner, double openingBalance) &#123;
        this.accountNumber = accountNumber;
        this.owner = owner;
        this.balance = openingBalance &gt;= 0 ? openingBalance : 0;
    }

    void deposit(double amount) &#123;
        if (amount &lt;= 0) &#123;
            System.out.println("Deposit rejected: amount must be positive");
            return;
        }
        balance += amount;
        transactions++;
        System.out.println("Deposited " + amount);
    }

    void withdraw(double amount) &#123;
        if (amount &lt;= 0) &#123;
            System.out.println("Withdrawal rejected: amount must be positive");
        } else if (amount &gt; balance) &#123;
            System.out.println("Withdrawal rejected: insufficient funds");
        } else &#123;
            balance -= amount;
            transactions++;
            System.out.println("Withdrew " + amount);
        }
    }

    void checkBalance() &#123;
        System.out.println(owner + " (" + accountNumber + ") balance: " + balance);
    }

    int getTransactionCount() &#123; return transactions; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        BankAccount acc = new BankAccount("1001-2345", "Ana Reyes", 1000);
        acc.checkBalance();

        acc.deposit(500);
        acc.withdraw(200);
        acc.deposit(-50);                    // invalid
        acc.withdraw(5000);                  // insufficient funds
        acc.checkBalance();

        System.out.println("Transactions: " + acc.getTransactionCount());
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Ana Reyes (1001-2345) balance: 1000.0
Deposited 500.0
Withdrew 200.0
Deposit rejected: amount must be positive
Withdrawal rejected: insufficient funds
Ana Reyes (1001-2345) balance: 1300.0
Transactions: 2</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        What Makes This Design Good?
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            The balance is private. There is no setBalance method, so the only way to change it is through deposit and withdraw.
        </li>

        <li>
            Each method checks its input before changing anything.
        </li>

        <li>
            The account number is final, so it can never change after the account is created.
        </li>

        <li>
            Other classes only need to know the public methods, not how the balance is stored.
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Why does BankAccount have no setBalance method?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> So the balance can only change through deposit and withdraw, which enforce the rules.
        </p>

        <p class="text-white mt-4">
            Give two benefits of encapsulation.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Data integrity and maintainability. Control over data, flexibility, and security are also correct.
        </p>

        <p class="text-white mt-4">
            What does the final keyword do to the accountNumber attribute?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It prevents the value from being changed after it is assigned.
        </p>

    </div>

</div>

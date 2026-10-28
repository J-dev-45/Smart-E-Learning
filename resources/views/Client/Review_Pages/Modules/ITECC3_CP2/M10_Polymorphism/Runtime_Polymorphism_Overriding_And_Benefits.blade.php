{{-- TOPIC 10.2: RUNTIME POLYMORPHISM, METHOD OVERRIDING, AND BENEFITS --}}
<div class="mt-10" id="topic-runtime-polymorphism-method-overriding-and-benefits">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        10.2 Runtime Polymorphism, Method Overriding, and Benefits
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The most powerful form of polymorphism happens while the program is running. A variable of a superclass type can refer to an object of any of its subclasses, and when a method is called through it, Java runs the version that belongs to the actual object. This lets you write code that works with a general type but behaves correctly for every specific type.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Method Overriding and Dynamic Binding
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When a subclass overrides a method, the choice of which version to run is made at run time, according to the real type of the object and not the type of the variable. This is called dynamic method dispatch, or dynamic binding.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Animal &#123;
    void makeSound() &#123; System.out.println("Some generic animal sound"); }
}

class Dog extends Animal &#123;
    &#64;Override
    void makeSound() &#123; System.out.println("Woof!"); }
}

class Cat extends Animal &#123;
    &#64;Override
    void makeSound() &#123; System.out.println("Meow!"); }
}

class Cow extends Animal &#123;
    &#64;Override
    void makeSound() &#123; System.out.println("Moo!"); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Animal a1 = new Dog();
        Animal a2 = new Cat();
        Animal a3 = new Cow();
        Animal a4 = new Animal();

        a1.makeSound();
        a2.makeSound();
        a3.makeSound();
        a4.makeSound();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Woof!
Meow!
Moo!
Some generic animal sound</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        All four variables have the type Animal, but each call runs the method of the real object. The compiler cannot know which one will run, so the decision is made at run time.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Superclass Reference to a Subclass Object
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A superclass reference can refer to a subclass object, because a Dog is an Animal. This is called upcasting, and it happens automatically. Through the Animal variable, you can use only what Animal declares, but the overridden versions are the ones that run.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Polymorphism with Arrays and Methods
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The real benefit appears when many different objects are handled by the same code. The loop below does not know or care which animal it holds.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Animal &#123;
    void makeSound() &#123; System.out.println("..."); }
}
class Dog extends Animal &#123;
    &#64;Override void makeSound() &#123; System.out.println("Woof!"); }
}
class Cat extends Animal &#123;
    &#64;Override void makeSound() &#123; System.out.println("Meow!"); }
}
class Cow extends Animal &#123;
    &#64;Override void makeSound() &#123; System.out.println("Moo!"); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Animal[] farm = &#123; new Dog(), new Cat(), new Cow(), new Dog() };

        for (Animal a : farm) &#123;
            a.makeSound();
        }

        System.out.println();
        introduce(new Cat());
        introduce(new Cow());
    }

    static void introduce(Animal a) &#123;
        System.out.print("This animal says: ");
        a.makeSound();
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Woof!
Meow!
Moo!
Woof!

This animal says: Meow!
This animal says: Moo!</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The method introduce accepts any Animal. If a new class, such as Duck, is added later, introduce works with it without any change.
    </p>

    <h3 class="text-xl font-bold mt-6">
        A Second Example: Shapes
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Shape &#123;
    String name() &#123; return "Shape"; }
    double area() &#123; return 0; }
}
class Circle extends Shape &#123;
    private double r;
    Circle(double r) &#123; this.r = r; }
    &#64;Override String name() &#123; return "Circle"; }
    &#64;Override double area() &#123; return Math.PI * r * r; }
}
class Rectangle extends Shape &#123;
    private double w, h;
    Rectangle(double w, double h) &#123; this.w = w; this.h = h; }
    &#64;Override String name() &#123; return "Rectangle"; }
    &#64;Override double area() &#123; return w * h; }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Shape[] shapes = &#123; new Circle(2), new Rectangle(3, 4), new Circle(1.5) };
        double total = 0;
        for (Shape s : shapes) &#123;
            System.out.printf("%s area = %.2f%n", s.name(), s.area());
            total += s.area();
        }
        System.out.printf("Total area = %.2f%n", total);
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Circle area = 12.57
Rectangle area = 12.00
Circle area = 7.07
Total area = 31.63</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Using instanceof and Casting
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Through a superclass variable, you cannot call a method that exists only in the subclass. If you need one, check the real type with instanceof and cast the reference down to the subclass.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Animal &#123;
    void makeSound() &#123; System.out.println("..."); }
}
class Dog extends Animal &#123;
    &#64;Override void makeSound() &#123; System.out.println("Woof!"); }
    void fetch() &#123; System.out.println("The dog fetches the ball."); }
}
class Cat extends Animal &#123;
    &#64;Override void makeSound() &#123; System.out.println("Meow!"); }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Animal[] pets = &#123; new Dog(), new Cat() };
        for (Animal a : pets) &#123;
            a.makeSound();
            if (a instanceof Dog) &#123;
                Dog d = (Dog) a;
                d.fetch();
            }
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Woof!
The dog fetches the ball.
Meow!</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Benefits of Polymorphism
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Extensibility
            </h4>

            <p class="text-gray-400 mt-2">
                New subclasses can be added without changing the code that uses the superclass type.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Less Code
            </h4>

            <p class="text-gray-400 mt-2">
                One loop or method handles many kinds of objects, so there are no long if-else chains checking the type.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Maintainability
            </h4>

            <p class="text-gray-400 mt-2">
                Behavior for each type is kept in its own class.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Flexibility
            </h4>

            <p class="text-gray-400 mt-2">
                A program can decide which object to use while running, such as according to user input.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Overloading Versus Overriding
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Overloading (compile-time)
            </h4>

            <p class="text-gray-400 mt-2">
                Same class, same name, different parameters. The compiler chooses by the arguments.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Overriding (runtime)
            </h4>

            <p class="text-gray-400 mt-2">
                Subclass and superclass, same name and same parameters. The JVM chooses by the actual object.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What decides which overridden method runs: the variable type or the object type?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The actual object type, decided at run time.
        </p>

        <p class="text-white mt-4">
            What is upcasting?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Treating a subclass object as its superclass type, such as Animal a = new Dog();
        </p>

        <p class="text-white mt-4">
            Why is polymorphism useful when adding new classes?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Existing code that uses the superclass type works with the new subclass without being changed.
        </p>

    </div>

</div>

{{-- TOPIC 4.6: QUICK SORT --}}
<div class="mt-10" id="topic-quick-sort">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.6 Quick Sort
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Quick sort is one of the fastest and most widely used sorting algorithms. Like merge sort, it uses divide and conquer, but it does its work before the recursive calls rather than after. It chooses an element called the pivot and partitions the array so that smaller elements are on one side and larger elements are on the other. Then it sorts each side recursively.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Pivot Selection
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The pivot is the element around which the array is partitioned. Common choices are the first element, the last element, the middle element, or a random element. A poor choice, such as always picking the smallest element of an already sorted array, makes quick sort slow. In this module we use the last element for simplicity.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Partitioning
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Partitioning rearranges the array so that all elements smaller than the pivot are on its left, and all larger elements are on its right. The pivot is then in its final sorted position. The Lomuto scheme scans the array with an index j and keeps an index i that marks the end of the smaller elements.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static int partition(int[] a, int low, int high) &#123;
    int pivot = a[high];
    int i = low - 1;
    for (int j = low; j &lt; high; j++) &#123;
        if (a[j] &lt; pivot) &#123;
            i++;
            int temp = a[i]; a[i] = a[j]; a[j] = temp;
        }
    }
    int temp = a[i + 1]; a[i + 1] = a[high]; a[high] = temp;
    return i + 1;
}

int[] a = &#123;10, 80, 30, 90, 40, 50, 70};
int p = partition(a, 0, a.length - 1);
System.out.println("Pivot 70 now at index " + p);
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Pivot 70 now at index 4
[10, 30, 40, 50, 70, 90, 80]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Recursion and Divide-and-Conquer
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        After partitioning, the pivot is in its correct place. The elements on its left and right are sorted separately by calling quick sort recursively. A part with zero or one element is the base case.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void quickSort(int[] a, int low, int high) &#123;
    if (low &lt; high) &#123;
        int p = partition(a, low, high);
        quickSort(a, low, p - 1);       // left of the pivot
        quickSort(a, p + 1, high);      // right of the pivot
    }
}

static int partition(int[] a, int low, int high) &#123;
    int pivot = a[high];
    int i = low - 1;
    for (int j = low; j &lt; high; j++) &#123;
        if (a[j] &lt; pivot) &#123;
            i++;
            int temp = a[i]; a[i] = a[j]; a[j] = temp;
        }
    }
    int temp = a[i + 1]; a[i + 1] = a[high]; a[high] = temp;
    return i + 1;
}

int[] a = &#123;10, 80, 30, 90, 40, 50, 70};
quickSort(a, 0, a.length - 1);
System.out.println(java.util.Arrays.toString(a));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[10, 30, 40, 50, 70, 80, 90]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Tracing the Sort
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void quickSort(int[] a, int low, int high) &#123;
    if (low &lt; high) &#123;
        int p = partition(a, low, high);
        System.out.println("Pivot " + a[p] + " placed at " + p + ": " + java.util.Arrays.toString(a));
        quickSort(a, low, p - 1);
        quickSort(a, p + 1, high);
    }
}

static int partition(int[] a, int low, int high) &#123;
    int pivot = a[high];
    int i = low - 1;
    for (int j = low; j &lt; high; j++) &#123;
        if (a[j] &lt; pivot) &#123;
            i++;
            int temp = a[i]; a[i] = a[j]; a[j] = temp;
        }
    }
    int temp = a[i + 1]; a[i + 1] = a[high]; a[high] = temp;
    return i + 1;
}

int[] a = &#123;10, 80, 30, 90, 40, 50, 70};
quickSort(a, 0, a.length - 1);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>Pivot 70 placed at 4: [10, 30, 40, 50, 70, 90, 80]
Pivot 50 placed at 3: [10, 30, 40, 50, 70, 90, 80]
Pivot 40 placed at 2: [10, 30, 40, 50, 70, 90, 80]
Pivot 30 placed at 1: [10, 30, 40, 50, 70, 90, 80]
Pivot 80 placed at 5: [10, 30, 40, 50, 70, 80, 90]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Characteristics of Quick Sort
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Strengths
            </h4>

            <p class="text-gray-400 mt-2">
                Very fast in practice, about n x log n steps on average. In-place, so it needs very little extra memory.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Weaknesses
            </h4>

            <p class="text-gray-400 mt-2">
                Not stable. In the worst case, for example when the pivot is always the smallest or largest element, it takes about n x n steps. Recursion adds stack use.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Sorting Laboratory: Sorting Student Records
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Sorting records means sorting objects by one of their fields. The comparison uses the field, but the whole object is moved. This example sorts students from the highest to the lowest grade using insertion sort, which keeps equal grades in their original order.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>class Student &#123;
    String name;
    int grade;

    Student(String name, int grade) &#123;
        this.name = name;
        this.grade = grade;
    }
}

public class Main &#123;
    public static void main(String[] args) &#123;
        Student[] students = &#123;
            new Student("Ana", 88),
            new Student("Ben", 92),
            new Student("Cara", 75),
            new Student("Dino", 92),
            new Student("Ella", 81)
        };

        for (int i = 1; i &lt; students.length; i++) &#123;
            Student key = students[i];
            int j = i - 1;
            while (j &gt;= 0 &amp;&amp; students[j].grade &lt; key.grade) &#123;
                students[j + 1] = students[j];
                j--;
            }
            students[j + 1] = key;
        }

        for (int i = 0; i &lt; students.length; i++) &#123;
            System.out.println((i + 1) + ". " + students[i].name + " - " + students[i].grade);
        }
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1. Ben - 92
2. Dino - 92
3. Ana - 88
4. Ella - 81
5. Cara - 75</code></pre>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Ben and Dino both have 92. Because insertion sort is stable, Ben, who came first in the original list, is still ranked before Dino.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Choosing a Sorting Algorithm
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Small or nearly sorted data
            </h4>

            <p class="text-gray-400 mt-2">
                Insertion sort is simple and fast.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Large data with a guaranteed speed
            </h4>

            <p class="text-gray-400 mt-2">
                Merge sort, which is stable and predictable.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Large data in memory with little extra space
            </h4>

            <p class="text-gray-400 mt-2">
                Quick sort, which is usually the fastest.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Learning and small tasks
            </h4>

            <p class="text-gray-400 mt-2">
                Bubble and selection sort are easy to understand.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the pivot in quick sort?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The element around which the array is partitioned, so that smaller elements go to its left and larger ones to its right.
        </p>

        <p class="text-white mt-4">
            After partitioning, where is the pivot?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> In its final sorted position.
        </p>

        <p class="text-white mt-4">
            What is the worst case for quick sort?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> When the pivot is always the smallest or largest element, which makes the partitions very uneven.
        </p>

    </div>

</div>

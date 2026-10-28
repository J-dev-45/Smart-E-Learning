{{-- TOPIC 2.4: MULTIDIMENSIONAL ARRAYS --}}
<div class="mt-10" id="topic-multidimensional-arrays">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.4 Multidimensional Arrays
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Some data naturally forms a table: the scores of students across several exams, the pixels of an image, or the squares of a game board. A multidimensional array stores such data. The most common form is the two-dimensional array, which behaves like a table with rows and columns, and it is also the standard way to represent a matrix in programs.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Two-Dimensional Arrays, Rows, and Columns
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A two-dimensional array is an array whose elements are themselves arrays. The first index selects the row and the second selects the column. For an array named table, table.length is the number of rows and table[0].length is the number of columns.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            A 3 x 4 Table
        </h4>

        <p class="text-white mt-3">
            Row 0:  1   2   3   4
        </p>

        <p class="text-gray-400 mt-2">
            Row 1:  5   6   7   8
        </p>

        <p class="text-gray-400 mt-2">
            Row 2:  9  10  11  12
        </p>

        <p class="text-gray-400 mt-2">
            table[1][2] is 7, table.length is 3, and table[0].length is 4
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] table = &#123;
    &#123;1, 2, 3, 4},
    &#123;5, 6, 7, 8},
    &#123;9, 10, 11, 12}
};
int[][] empty = new int[2][3];             // 2 rows, 3 columns, all 0

System.out.println("table[1][2] = " + table[1][2]);
System.out.println("Rows: " + table.length);
System.out.println("Columns: " + table[0].length);
System.out.println("empty[1][2] = " + empty[1][2]);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>table[1][2] = 7
Rows: 3
Columns: 4
empty[1][2] = 0</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Nested Loops
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To visit every element, use nested loops. The outer loop goes through the rows, and the inner loop goes through the columns of the current row.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] table = &#123;
    &#123;1, 2, 3},
    &#123;4, 5, 6}
};
int total = 0;
for (int row = 0; row &lt; table.length; row++) &#123;
    for (int col = 0; col &lt; table[row].length; col++) &#123;
        System.out.print(table[row][col] + " ");
        total += table[row][col];
    }
    System.out.println();
}
System.out.println("Total = " + total);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>1 2 3 
4 5 6 
Total = 21</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Matrix Representation
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A matrix is a rectangular arrangement of numbers in rows and columns, and a matrix with m rows and n columns is called an m x n matrix. A 2D array stores it directly, with matrix[i][j] as the element in row i and column j. The following helper method prints a matrix neatly.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>static void print(int[][] m) &#123;
    for (int i = 0; i &lt; m.length; i++) &#123;
        for (int j = 0; j &lt; m[i].length; j++) &#123;
            System.out.printf("%4d", m[i][j]);
        }
        System.out.println();
    }
}

int[][] m = &#123;&#123;1, 2, 3}, &#123;4, 5, 6}};
print(m);</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>   1   2   3
   4   5   6</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Matrix Addition and Subtraction
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Two matrices can be added or subtracted only when they have the same number of rows and columns. The elements at the same position are added or subtracted: result[i][j] = a[i][j] + b[i][j].
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] a = &#123;&#123;1, 2}, &#123;3, 4}};
int[][] b = &#123;&#123;5, 6}, &#123;7, 8}};
int[][] sum = new int[2][2];
int[][] diff = new int[2][2];

for (int i = 0; i &lt; 2; i++) &#123;
    for (int j = 0; j &lt; 2; j++) &#123;
        sum[i][j] = a[i][j] + b[i][j];
        diff[i][j] = b[i][j] - a[i][j];
    }
}
System.out.println(java.util.Arrays.deepToString(sum));
System.out.println(java.util.Arrays.deepToString(diff));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[[6, 8], [10, 12]]
[[4, 4], [4, 4]]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Matrix Multiplication
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Matrix A can be multiplied by matrix B only when the number of columns of A equals the number of rows of B. If A is m x n and B is n x p, the result is m x p. Each element is the sum of products of a row of A and a column of B: result[i][j] = a[i][0] x b[0][j] + a[i][1] x b[1][j] + ...
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: 2 x 2 Multiplication
        </h4>

        <p class="text-white mt-3">
            A = &#123;&#123;1, 2}, {3, 4}} and B = &#123;&#123;5, 6}, {7, 8}}
        </p>

        <p class="text-gray-400 mt-2">
            result[0][0] = 1 x 5 + 2 x 7 = 19
        </p>

        <p class="text-gray-400 mt-2">
            result[0][1] = 1 x 6 + 2 x 8 = 22
        </p>

        <p class="text-gray-400 mt-2">
            result[1][0] = 3 x 5 + 4 x 7 = 43
        </p>

        <p class="text-gray-400 mt-2">
            result[1][1] = 3 x 6 + 4 x 8 = 50
        </p>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] a = &#123;&#123;1, 2}, &#123;3, 4}};
int[][] b = &#123;&#123;5, 6}, &#123;7, 8}};
int[][] product = new int[2][2];

for (int i = 0; i &lt; 2; i++) &#123;
    for (int j = 0; j &lt; 2; j++) &#123;
        for (int k = 0; k &lt; 2; k++) &#123;
            product[i][j] += a[i][k] * b[k][j];
        }
    }
}
System.out.println(java.util.Arrays.deepToString(product));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[[19, 22], [43, 50]]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Transpose of a Matrix
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The transpose of a matrix turns its rows into columns. An m x n matrix becomes an n x m matrix, and result[j][i] = original[i][j].
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] m = &#123;&#123;1, 2, 3}, &#123;4, 5, 6}};
int[][] t = new int[m[0].length][m.length];

for (int i = 0; i &lt; m.length; i++) &#123;
    for (int j = 0; j &lt; m[i].length; j++) &#123;
        t[j][i] = m[i][j];
    }
}
System.out.println(java.util.Arrays.deepToString(m));
System.out.println(java.util.Arrays.deepToString(t));</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[[1, 2, 3], [4, 5, 6]]
[[1, 4], [2, 5], [3, 6]]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Laboratory 5: Matrix Calculator
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The following program puts the operations into separate methods, which keeps the code organized and reusable.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>public class Main &#123;
    public static void main(String[] args) &#123;
        int[][] a = &#123;&#123;1, 2, 3}, &#123;4, 5, 6}};
        int[][] b = &#123;&#123;7, 8, 9}, &#123;1, 2, 3}};
        int[][] c = &#123;&#123;1, 2}, &#123;3, 4}, &#123;5, 6}};

        System.out.println("A + B = " + java.util.Arrays.deepToString(add(a, b)));
        System.out.println("B - A = " + java.util.Arrays.deepToString(subtract(b, a)));
        System.out.println("A x C = " + java.util.Arrays.deepToString(multiply(a, c)));
        System.out.println("Transpose of A = " + java.util.Arrays.deepToString(transpose(a)));
    }

    static int[][] add(int[][] a, int[][] b) &#123;
        int[][] r = new int[a.length][a[0].length];
        for (int i = 0; i &lt; a.length; i++)
            for (int j = 0; j &lt; a[0].length; j++)
                r[i][j] = a[i][j] + b[i][j];
        return r;
    }

    static int[][] subtract(int[][] a, int[][] b) &#123;
        int[][] r = new int[a.length][a[0].length];
        for (int i = 0; i &lt; a.length; i++)
            for (int j = 0; j &lt; a[0].length; j++)
                r[i][j] = a[i][j] - b[i][j];
        return r;
    }

    static int[][] multiply(int[][] a, int[][] b) &#123;
        int[][] r = new int[a.length][b[0].length];
        for (int i = 0; i &lt; a.length; i++)
            for (int j = 0; j &lt; b[0].length; j++)
                for (int k = 0; k &lt; b.length; k++)
                    r[i][j] += a[i][k] * b[k][j];
        return r;
    }

    static int[][] transpose(int[][] a) &#123;
        int[][] r = new int[a[0].length][a.length];
        for (int i = 0; i &lt; a.length; i++)
            for (int j = 0; j &lt; a[0].length; j++)
                r[j][i] = a[i][j];
        return r;
    }
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>A + B = [[8, 10, 12], [5, 7, 9]]
B - A = [[6, 6, 6], [-3, -3, -3]]
A x C = [[22, 28], [49, 64]]
Transpose of A = [[1, 4], [2, 5], [3, 6]]</code></pre>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Jagged Arrays
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In Java, each row of a 2D array is a separate array, so rows can have different lengths. Such an array is called a jagged array.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>int[][] jag = new int[3][];
jag[0] = new int[]&#123;1};
jag[1] = new int[]&#123;2, 3};
jag[2] = new int[]&#123;4, 5, 6};
for (int[] row : jag) &#123;
    System.out.println(java.util.Arrays.toString(row));
}</code></pre>

    <div class="bg-[#12081F] border border-[#3A2560] border-l-4 border-l-emerald-400 rounded-xl p-4 mt-2">
        <p class="text-xs font-bold text-emerald-300 uppercase tracking-wide">Output</p>
        <pre class="text-sm text-gray-200 mt-2 overflow-x-auto"><code>[1]
[2, 3]
[4, 5, 6]</code></pre>
    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            When can two matrices be added?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> When they have the same number of rows and the same number of columns.
        </p>

        <p class="text-white mt-4">
            When can matrix A be multiplied by matrix B?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> When the number of columns of A is equal to the number of rows of B.
        </p>

        <p class="text-white mt-4">
            What are the dimensions of the transpose of a 2 x 3 matrix?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 3 x 2.
        </p>

    </div>

</div>

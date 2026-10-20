{{-- TOPIC 2.4: THE COMPUTER NUMBER SYSTEM --}}
<div class="mt-10" id="topic-the-computer-number-system">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.4 The Computer Number System
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A number system is a way of writing numbers using a fixed set of symbols. Computers use the binary system internally, but people also use the decimal, octal, and hexadecimal systems to read and write numbers more easily. Each system has a base, which is the number of digits it uses.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        People count in decimal because we have ten fingers, but computers count in binary because they are built from two-state switches. Programmers need to understand both, and also octal and hexadecimal, which are compact ways of writing binary numbers.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Common Number Systems
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Decimal (Base 10)
            </h4>

            <p class="text-gray-400 mt-2">
                Uses digits 0 to 9. This is the system people use every day.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Binary (Base 2)
            </h4>

            <p class="text-gray-400 mt-2">
                Uses digits 0 and 1. This is the language of the computer.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Octal (Base 8)
            </h4>

            <p class="text-gray-400 mt-2">
                Uses digits 0 to 7. A shorter way to write binary, 3 bits at a time.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Hexadecimal (Base 16)
            </h4>

            <p class="text-gray-400 mt-2">
                Uses digits 0 to 9 and letters A to F (A = 10 up to F = 15). A shorter way to write binary, 4 bits at a time.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Positional Value
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In every number system, the value of a digit depends on its position. Each position is a power of the base, starting from the rightmost digit at position 0.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Decimal 345
        </h4>

        <p class="text-white mt-3">
            345 = (3 x 100) + (4 x 10) + (5 x 1)
        </p>

        <p class="text-gray-400 mt-2">
            The same idea applies to binary, where the positions are 1, 2, 4, 8, 16, and so on.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Binary to Decimal
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Multiply each binary digit by its positional value (a power of 2) and add the results.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: 1011 (binary) to decimal
        </h4>

        <p class="text-white mt-3">
            1011 = (1 x 8) + (0 x 4) + (1 x 2) + (1 x 1)
        </p>

        <p class="text-gray-400 mt-2">
            = 8 + 0 + 2 + 1
        </p>

        <p class="text-gray-400 mt-2">
            = 11 (decimal)
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Decimal to Binary
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Repeatedly divide the decimal number by 2 and record the remainders. Then read the remainders from the last one to the first one.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: 13 (decimal) to binary
        </h4>

        <p class="text-white mt-3">
            13 / 2 = 6 remainder 1
        </p>

        <p class="text-gray-400 mt-2">
            6 / 2 = 3 remainder 0
        </p>

        <p class="text-gray-400 mt-2">
            3 / 2 = 1 remainder 1
        </p>

        <p class="text-gray-400 mt-2">
            1 / 2 = 0 remainder 1
        </p>

        <p class="text-gray-400 mt-2">
            Read the remainders from bottom to top: 1101
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Binary to Octal and Hexadecimal
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To convert binary to octal, group the bits in threes from the right. To convert binary to hexadecimal, group the bits in fours from the right. Then replace each group with its equivalent digit.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Binary to Octal
            </h4>

            <p class="text-gray-400 mt-2">
                101110 is grouped as 101 and 110. Since 101 = 5 and 110 = 6, the octal value is 56.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Binary to Hexadecimal
            </h4>

            <p class="text-gray-400 mt-2">
                11010111 is grouped as 1101 and 0111. Since 1101 = D and 0111 = 7, the hexadecimal value is D7.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Decimal to Hexadecimal
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Divide the decimal number by 16 repeatedly and record the remainders, writing 10 to 15 as A to F.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: 255 (decimal) to hexadecimal
        </h4>

        <p class="text-white mt-3">
            255 / 16 = 15 remainder 15 (F)
        </p>

        <p class="text-gray-400 mt-2">
            15 / 16 = 0 remainder 15 (F)
        </p>

        <p class="text-gray-400 mt-2">
            Read from bottom to top: FF
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Binary Addition
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Binary addition follows four simple rules.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                0 + 0
            </h4>

            <p class="text-gray-400 mt-2">
                = 0
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                0 + 1
            </h4>

            <p class="text-gray-400 mt-2">
                = 1
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1 + 1
            </h4>

            <p class="text-gray-400 mt-2">
                = 10 (write 0, carry 1)
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1 + 1 + 1
            </h4>

            <p class="text-gray-400 mt-2">
                = 11 (write 1, carry 1)
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: 1011 + 0110
        </h4>

        <p class="text-white mt-3">
            1011 + 0110 = 10001
        </p>

        <p class="text-gray-400 mt-2">
            In decimal: 11 + 6 = 17, which is 10001 in binary.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Understanding Positional Notation
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In a positional number system, a digit's value depends on both the digit and its position. In the decimal number 345, the 3 stands for three hundreds, the 4 for four tens, and the 5 for five ones. The position values are powers of 10: 100, 10, and 1. Binary works the same way, except the position values are powers of 2: 1, 2, 4, 8, 16, 32, 64, 128, and so on, and each digit can only be 0 or 1.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Place Values of an 8-bit Binary Number
        </h4>

        <p class="text-white mt-3">
            Position values from left to right: 128, 64, 32, 16, 8, 4, 2, 1
        </p>

        <p class="text-gray-400 mt-2">
            Example: 11001010 = 128 + 64 + 8 + 2 = 202
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Quick Method for Decimal to Binary
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Besides repeated division, you can subtract place values. Start from the largest place value that fits and mark a 1, then subtract it and continue with the remainder. Mark 0 for place values that do not fit.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: 45 to binary
        </h4>

        <p class="text-white mt-3">
            Place values: 32, 16, 8, 4, 2, 1
        </p>

        <p class="text-gray-400 mt-2">
            45 - 32 = 13, so 32 gets a 1
        </p>

        <p class="text-gray-400 mt-2">
            16 does not fit, so 0
        </p>

        <p class="text-gray-400 mt-2">
            13 - 8 = 5, so 8 gets a 1
        </p>

        <p class="text-gray-400 mt-2">
            5 - 4 = 1, so 4 gets a 1
        </p>

        <p class="text-gray-400 mt-2">
            2 does not fit, so 0
        </p>

        <p class="text-gray-400 mt-2">
            1 fits, so 1 gets a 1
        </p>

        <p class="text-gray-400 mt-2">
            Result: 101101
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Why Octal and Hexadecimal Exist
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Long binary numbers are hard for people to read and easy to mistype. Because 8 is 2 to the power of 3 and 16 is 2 to the power of 4, every octal digit equals exactly three bits and every hexadecimal digit equals exactly four bits. That makes conversion simple and lets us write a long binary value in a short form. A full byte, for example, is always exactly two hexadecimal digits.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Decimal 10
            </h4>

            <p class="text-gray-400 mt-2">
                Binary 1010, Octal 12, Hex A
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Decimal 15
            </h4>

            <p class="text-gray-400 mt-2">
                Binary 1111, Octal 17, Hex F
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Decimal 255
            </h4>

            <p class="text-gray-400 mt-2">
                Binary 11111111, Octal 377, Hex FF
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Where You Will See These in Real Life
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Web Colors
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                CSS colors use hexadecimal. In #FF0000, FF is the red amount (255), 00 is green, and 00 is blue, so the color is pure red.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                IP Addresses
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The address 192.168.1.1 is four bytes. For example, 192 is 11000000 in binary.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Memory Addresses and MAC Addresses
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                These are usually written in hexadecimal because it is short and easy to map to binary.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Mistakes to Avoid
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Reading the remainders from top to bottom instead of from bottom to top when converting decimal to binary
        </li>

        <li>
            Forgetting that hexadecimal letters stand for numbers: A is 10, B is 11, C is 12, D is 13, E is 14, and F is 15
        </li>

        <li>
            Grouping bits from the left instead of the right when converting to octal or hexadecimal, and forgetting to pad the leftmost group with zeros
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Convert 110 (binary) to decimal.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 4 + 2 + 0 = 6.
        </p>

        <p class="text-white mt-4">
            Convert 25 (decimal) to binary.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 11001, because 16 + 8 + 1 = 25.
        </p>

        <p class="text-white mt-4">
            Convert 10101111 (binary) to hexadecimal.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> AF, because 1010 is A and 1111 is F.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Computers work in binary. Octal and hexadecimal are shorthand forms of binary, and any number can be converted between systems using positional values, division, or bit grouping.
        </p>

    </div>

</div>

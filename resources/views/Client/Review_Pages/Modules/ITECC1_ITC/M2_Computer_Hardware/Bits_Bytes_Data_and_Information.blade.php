{{-- TOPIC 2.3: BITS, BYTES, DATA, AND INFORMATION --}}
<div class="mt-10" id="topic-bits-bytes-data-and-information">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        2.3 Bits, Bytes, Data, and Information
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A computer can only understand two states: on and off. These two states are written as 1 and 0. Everything a computer stores or shows, such as text, pictures, sound, and video, is built from long patterns of these two digits.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Everything you see on a computer, whether it is text, a picture, a song, or a video, is stored as numbers, and those numbers are stored as patterns of bits. This topic explains how those patterns are measured and how raw data becomes useful information.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Bit and Byte
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A bit (binary digit) is the smallest unit of data in a computer and can only be 0 or 1. A byte is a group of 8 bits and is the basic unit used to measure storage. One byte can represent 256 different values (2 to the power of 8).
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Bit
            </h4>

            <p class="text-gray-400 mt-2">
                A single 0 or 1. The smallest unit of data.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Nibble
            </h4>

            <p class="text-gray-400 mt-2">
                A group of 4 bits. It is half of a byte and equals one hexadecimal digit.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Byte
            </h4>

            <p class="text-gray-400 mt-2">
                A group of 8 bits. Usually stores one character such as a letter or digit.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Units of Storage
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Storage capacity is measured in multiples of the byte. In computing, each unit is commonly counted as 1,024 times the previous one.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Kilobyte (KB)
            </h4>

            <p class="text-gray-400 mt-2">
                1,024 bytes. About a short text file.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Megabyte (MB)
            </h4>

            <p class="text-gray-400 mt-2">
                1,024 KB. About a photo or a few minutes of music.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Gigabyte (GB)
            </h4>

            <p class="text-gray-400 mt-2">
                1,024 MB. About a movie or many apps.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Terabyte (TB)
            </h4>

            <p class="text-gray-400 mt-2">
                1,024 GB. Used by large hard drives and servers.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Data and Information
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Data are raw facts and figures that have no meaning by themselves. Information is data that has been processed, organized, or interpreted so it becomes meaningful and useful for making decisions.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Data to Information
        </h4>

        <p class="text-white mt-3">
            Data: 85, 90, 78
        </p>

        <p class="text-gray-400 mt-2">
            Processing: add the scores and divide by 3.
        </p>

        <p class="text-gray-400 mt-2">
            Information: The student's average grade is 84.33.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Representing Characters
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Computers store characters as numbers. ASCII (American Standard Code for Information Interchange) assigns a number to each basic character using 7 bits, while Unicode supports characters from almost every language in the world, including emojis.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: ASCII
        </h4>

        <p class="text-white mt-3">
            The letter A has the ASCII code 65.
        </p>

        <p class="text-gray-400 mt-2">
            In binary, 65 is written as 01000001 (one byte).
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Why Computers Use Only Two Digits
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Computers are made from electronic switches. A switch has two clear states, on and off, and these are easy to build, very fast, and very reliable. Using just two states also makes it easy for the computer to tell the difference between them even when there is some electrical noise. Trying to build reliable hardware with ten distinct states, like decimal digits, would be far more difficult and error-prone. So we write on as 1 and off as 0 and combine many of them to represent more complex data.
    </p>

    <h3 class="text-xl font-bold mt-6">
        How Many Values Can Bits Represent?
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Each additional bit doubles the number of values that can be represented. One bit has 2 values, two bits have 4, three bits have 8, and eight bits, which make one byte, have 256 values (from 0 to 255). This is why one byte is enough for a character such as a letter, and why a color on screen is often described with three bytes, one each for red, green, and blue.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Counting Values
        </h4>

        <p class="text-white mt-3">
            1 bit: 2 values (0, 1)
        </p>

        <p class="text-gray-400 mt-2">
            2 bits: 4 values (00, 01, 10, 11)
        </p>

        <p class="text-gray-400 mt-2">
            3 bits: 8 values
        </p>

        <p class="text-gray-400 mt-2">
            8 bits (1 byte): 256 values
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        A Note on Storage Units
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        In computing, a kilobyte is traditionally counted as 1,024 bytes because 1,024 is a power of 2 (2 to the power of 10). Storage manufacturers, however, often use 1,000 to label drives. This is why a drive sold as 500 GB shows slightly less capacity in the operating system. Neither is wrong, they simply use different counting systems.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Data Versus Information
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Data by itself is just facts without context, for example the numbers 85, 90, and 78. Information gives those facts meaning. When the numbers are identified as a student's test scores and the average is computed, we get information that can help decide whether the student passed. The same data can produce different information depending on how it is processed and what question we are asking. Good decisions depend on accurate data and on correct processing.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Data
            </h4>

            <p class="text-gray-400 mt-2">
                Raw, unprocessed facts such as numbers, words, or measurements.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Information
            </h4>

            <p class="text-gray-400 mt-2">
                Data that has been processed and organized so it has meaning and use.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Character Codes: ASCII and Unicode
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        To store text, each character is given a number, and that number is stored in binary. ASCII uses 7 bits to represent 128 characters including English letters, digits, and common symbols. For example, capital A is 65 and lowercase a is 97. Because ASCII cannot cover other languages, Unicode was created. It can represent over a hundred thousand characters from many writing systems, as well as emojis, and the common encoding UTF-8 is used by most web pages.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            How many bits are in a byte, and how many values can it represent?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 8 bits, and 256 different values.
        </p>

        <p class="text-white mt-4">
            Give an example of data and the information produced from it.
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The scores 85, 90, and 78 are data. Their average, 84.33, is information about the student's performance.
        </p>

        <p class="text-white mt-4">
            Why was Unicode created?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Because ASCII supports only 128 characters, and Unicode covers the characters of many languages and symbols.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Bits are grouped into bytes, bytes measure storage, and data becomes information once it is processed into something meaningful.
        </p>

    </div>

</div>

{{-- TOPIC 3.1: SYSTEM SOFTWARE AND OPERATING SYSTEMS --}}
<div class="mt-10" id="topic-system-software-and-operating-systems">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        3.1 System Software and Operating Systems
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Software is the set of programs and instructions that tells the hardware what to do. Software is divided into two main groups: system software, which manages the computer itself, and application software, which helps users do specific tasks.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When you press the power button, a chain of events begins before you can open any program. System software is what makes that possible. It prepares the hardware, manages its resources, and lets application software run without needing to know the details of the hardware underneath.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                System Software
            </h4>

            <p class="text-gray-400 mt-2">
                Controls and manages the hardware and provides a platform for other programs. Examples: operating systems, device drivers, and utility programs.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Application Software
            </h4>

            <p class="text-gray-400 mt-2">
                Helps users perform specific tasks such as writing documents, browsing the web, or editing photos.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Operating System
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The operating system (OS) is the most important system software. It acts as the middleman between the user, the applications, and the hardware. Without an operating system, a computer cannot run programs in a useful way.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Process Management
            </h4>

            <p class="text-gray-400 mt-2">
                Decides which programs run and for how long.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Memory Management
            </h4>

            <p class="text-gray-400 mt-2">
                Allocates RAM to programs and frees it when they close.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                File Management
            </h4>

            <p class="text-gray-400 mt-2">
                Organizes, stores, and retrieves files and folders.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Device Management
            </h4>

            <p class="text-gray-400 mt-2">
                Controls input, output, and storage devices through drivers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Security
            </h4>

            <p class="text-gray-400 mt-2">
                Protects data using accounts, passwords, and permissions.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                User Interface
            </h4>

            <p class="text-gray-400 mt-2">
                Lets the user interact with the computer through a command line or a graphical interface.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        History of Operating Systems
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1940s to 1950s: No Operating System
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Early computers were operated directly by programmers using switches and punched cards. Later, batch systems ran one job after another with little user interaction.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1960s to 1970s: Multiprogramming and Time-Sharing
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Several programs could share the computer at the same time. UNIX was developed in 1969 and became the basis of many later systems.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1980s: Personal Computers and GUI
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                MS-DOS ran on early personal computers using typed commands. The Apple Macintosh (1984) and Microsoft Windows made the graphical user interface popular.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1990s to Today: Open Source and Mobile
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Linux was released in 1991 as a free and open-source OS. Smartphones brought iOS (2007) and Android (2008).
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Types of Operating Systems
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Single-User, Single-Task
            </h4>

            <p class="text-gray-400 mt-2">
                Lets one user run one program at a time. Example: early MS-DOS.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Single-User, Multitasking
            </h4>

            <p class="text-gray-400 mt-2">
                Lets one user run many programs at once. Example: Windows on a home PC.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Multi-User
            </h4>

            <p class="text-gray-400 mt-2">
                Allows many users to use the system at the same time. Example: UNIX and Linux servers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Real-Time (RTOS)
            </h4>

            <p class="text-gray-400 mt-2">
                Responds to input within a guaranteed time. Used in medical devices and industrial control.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Network OS
            </h4>

            <p class="text-gray-400 mt-2">
                Manages network resources and allows file and printer sharing. Example: Windows Server.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Mobile OS
            </h4>

            <p class="text-gray-400 mt-2">
                Designed for touch devices and battery efficiency. Examples: Android and iOS.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Examples of Operating Systems
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Windows
            </h4>

            <p class="text-gray-400 mt-2">
                Made by Microsoft. The most common OS on desktop and laptop computers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                macOS
            </h4>

            <p class="text-gray-400 mt-2">
                Made by Apple for Mac computers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Linux
            </h4>

            <p class="text-gray-400 mt-2">
                Free and open source. Widely used on servers and by developers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Android and iOS
            </h4>

            <p class="text-gray-400 mt-2">
                The two main operating systems for smartphones and tablets.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Four Categories of Operating Systems
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Operating systems can also be grouped by the kind of device they run on.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Desktop
            </h4>

            <p class="text-gray-400 mt-2">
                For personal computers and laptops.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Server
            </h4>

            <p class="text-gray-400 mt-2">
                For managing networks, websites, and databases.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Mobile
            </h4>

            <p class="text-gray-400 mt-2">
                For smartphones and tablets.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Embedded
            </h4>

            <p class="text-gray-400 mt-2">
                Built into devices such as smart TVs, ATMs, and appliances.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        The Operating System as a Manager
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The operating system works like the manager of a busy office. Many programs want to use the processor, memory, storage, and devices at the same time, and the OS decides who gets what and when. It also hides complexity: a word processor does not need to know what brand of printer is attached, because the OS and the printer's driver handle that.
    </p>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Process Management
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Each running program is a process. The OS schedules them so that many appear to run at the same time, switching between them very quickly. This is what makes multitasking possible.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Memory Management
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The OS gives each program its own area of RAM, keeps programs from interfering with each other, and can use part of the drive as virtual memory when RAM is full.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                File Management
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The OS organizes data into files and folders, tracks where each file is stored, and controls who can open, change, or delete it.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Device Management
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Through device drivers, the OS communicates with the keyboard, display, printer, and other hardware.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Security and Access
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The OS uses user accounts, passwords, and permissions to protect data and the system.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                User Interface
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A command-line interface accepts typed commands, while a graphical user interface uses windows, icons, menus, and pointers.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Other Kinds of System Software
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The operating system is not the only system software. Device drivers are small programs that let the OS communicate with specific hardware. Firmware, such as the BIOS or UEFI on the motherboard, runs first when the computer starts and loads the operating system. Utility programs, covered in the next topic, help maintain the system.
    </p>

    <h3 class="text-xl font-bold mt-6">
        What Happens When You Turn On the Computer?
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Power reaches the motherboard and the firmware starts.
        </li>

        <li>
            The firmware tests the hardware, an activity called POST (Power-On Self-Test).
        </li>

        <li>
            The firmware finds the operating system on the drive and loads it into RAM. This step is called booting.
        </li>

        <li>
            The OS starts services, loads drivers, and shows the login screen or desktop.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Choosing an Operating System
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The right operating system depends on the work and the hardware. Windows has the widest range of software and games on desktop PCs and is common in offices and schools. macOS runs on Apple computers and is popular for design and development. Linux is free and open source, runs most of the world's servers, and is favored by developers. Android and iOS dominate smartphones. Web developers often use any of them, and tools such as Git, Node.js, and code editors run on all three desktop systems.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the main role of the operating system?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> To manage the computer's hardware and software resources and provide an interface between the user, applications, and hardware.
        </p>

        <p class="text-white mt-4">
            What is booting?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The process of starting the computer and loading the operating system into memory.
        </p>

        <p class="text-white mt-4">
            Why do computers need device drivers?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Drivers let the operating system communicate with specific hardware devices such as printers and graphics cards.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            The operating system manages hardware and software resources and gives users a way to use the computer. Different devices need different types of operating systems.
        </p>

    </div>

</div>

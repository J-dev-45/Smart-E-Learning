{{-- TOPIC 4.2: NETWORK TOPOLOGIES AND COMMUNICATION SYSTEMS --}}
<div class="mt-10" id="topic-network-topologies-and-communication-systems">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        4.2 Network Topologies and Communication Systems
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Network Topologies
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A network topology is the layout or arrangement of devices and connections in a network.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Two ideas explain how a network works: the shape in which devices are connected, called the topology, and the way messages are sent between them, called the communication system.
    </p>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Bus
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                All devices share a single main cable. It is cheap and easy to set up, but a break in the main cable can bring the whole network down.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Star
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                All devices connect to a central switch or hub. It is the most common today. A failed cable affects only one device, but the central device is a single point of failure.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Ring
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Each device connects to two others, forming a circle, and data travels in one direction. A failure in one device can disrupt the network.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Mesh
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Devices connect to many other devices. It is very reliable but expensive because it needs many connections.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Tree
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Star networks connected to a main bus or backbone. It is scalable but depends on the backbone.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Hybrid
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                A combination of two or more topologies.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Communication Systems
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Every communication system has five basic parts.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Sender
            </h4>

            <p class="text-gray-400 mt-2">
                The device that creates and sends the message.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Message
            </h4>

            <p class="text-gray-400 mt-2">
                The data being sent, such as text, audio, or video.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Medium
            </h4>

            <p class="text-gray-400 mt-2">
                The path the message travels through, such as a cable or radio waves.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Receiver
            </h4>

            <p class="text-gray-400 mt-2">
                The device that receives the message.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Protocol
            </h4>

            <p class="text-gray-400 mt-2">
                The set of rules both sides follow to communicate correctly.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Types of Signals
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Analog Signal
            </h4>

            <p class="text-gray-400 mt-2">
                A continuous wave whose value changes smoothly. Example: traditional radio and telephone signals.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Digital Signal
            </h4>

            <p class="text-gray-400 mt-2">
                Uses discrete values, usually 0 and 1. It is less affected by noise and is used by computers.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Transmission Systems
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Data can flow in three directions, and it can travel through wired or wireless media.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Simplex
            </h4>

            <p class="text-gray-400 mt-2">
                One direction only. Example: a TV broadcast.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Half-Duplex
            </h4>

            <p class="text-gray-400 mt-2">
                Both directions, but only one at a time. Example: a walkie-talkie.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Full-Duplex
            </h4>

            <p class="text-gray-400 mt-2">
                Both directions at the same time. Example: a phone call.
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Wired Media
            </h4>

            <p class="text-gray-400 mt-2">
                Twisted pair (common Ethernet cables), coaxial cable, and fiber optic cable, which is the fastest and carries data as light.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Wireless Media
            </h4>

            <p class="text-gray-400 mt-2">
                Radio waves, microwaves, infrared, and satellite.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Physical and Logical Topology
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The physical topology is the actual layout of cables and devices, while the logical topology is how data flows through the network. A network may look like a star physically but behave differently in how data is passed. When people say topology, they usually mean the physical layout.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Comparing Topologies
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Bus: Advantages and Disadvantages
            </h4>

            <p class="text-gray-400 mt-2">
                Cheap and uses little cable, but a break in the main cable stops the whole network, and performance drops as more devices are added.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Star: Advantages and Disadvantages
            </h4>

            <p class="text-gray-400 mt-2">
                Easy to add devices and to find problems, and one failed cable only affects one computer. The disadvantage is that if the central switch fails, the whole network goes down.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Ring: Advantages and Disadvantages
            </h4>

            <p class="text-gray-400 mt-2">
                Orderly access and predictable performance, but one broken connection can disrupt the whole ring unless it is a dual ring.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Mesh: Advantages and Disadvantages
            </h4>

            <p class="text-gray-400 mt-2">
                Very reliable because there are many paths, but expensive and complex because of the number of connections.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Most modern LANs use a star topology, with a switch in the center and cables going to each device, because it is flexible and easy to manage. Large networks often combine topologies into a hybrid, such as several star networks connected by a backbone.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Parts of a Communication System
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Communication needs a sender that creates the message, a medium that carries it, and a receiver that gets it. A protocol is the agreed set of rules, such as the format of the message and the order of steps, that lets the two sides understand each other. Noise, such as interference, can corrupt the message, which is why networks use error checking.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Bandwidth, Speed, and Latency
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Bandwidth is the maximum amount of data a connection can carry in a given time, usually in megabits per second (Mbps). Latency is the delay before data starts to arrive, measured in milliseconds. A connection can have high bandwidth but high latency, such as a satellite link, which is fine for downloads but poor for online games.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Choosing Transmission Media
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Twisted Pair
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                The common Ethernet cable (Cat5e, Cat6). Cheap and flexible, good for distances up to about 100 meters.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Coaxial Cable
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Has a central conductor with shielding. Used for cable television and older networks.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Fiber Optic
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Sends data as light through thin glass. Very fast, travels long distances, and is not affected by electrical interference, but costs more.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Wireless
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Radio waves (Wi-Fi, Bluetooth, cellular), microwave links, infrared, and satellite. Convenient, but more exposed to interference and security risks.
            </p>
        </div>

    </div>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            Which topology uses a central switch?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The star topology.
        </p>

        <p class="text-white mt-4">
            What is the difference between simplex and full-duplex?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Simplex sends data in only one direction, while full-duplex sends in both directions at the same time.
        </p>

        <p class="text-white mt-4">
            Why is fiber optic used for long distances?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It carries data as light with very high speed and low signal loss, and it is not affected by electrical interference.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            The topology describes how devices are arranged. A communication system needs a sender, message, medium, receiver, and protocol to work.
        </p>

    </div>

</div>

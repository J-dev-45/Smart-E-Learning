{{-- TOPIC 5.2: INTERNET PROTOCOLS, ADDRESSES, AND SERVICES --}}
<div class="mt-10" id="topic-internet-protocols-addresses-and-services">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        5.2 Internet Protocols, Addresses, and Services
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Internetworking Protocols
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A protocol is a set of rules that devices follow to communicate. The internet depends on a collection of protocols working together.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        For millions of different devices to exchange data, they all have to follow the same rules. These rules are called protocols, and every action you take online, from loading a page to sending an email, depends on several of them working together.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                IP (Internet Protocol)
            </h4>

            <p class="text-gray-400 mt-2">
                Addresses and routes data packets to their destination.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                TCP
            </h4>

            <p class="text-gray-400 mt-2">
                Splits data into packets, delivers them reliably, and reassembles them in order.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                UDP
            </h4>

            <p class="text-gray-400 mt-2">
                A faster protocol with no delivery guarantee. Used for streaming and online games.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                HTTP and HTTPS
            </h4>

            <p class="text-gray-400 mt-2">
                Used to transfer web pages. HTTPS adds encryption for security.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                FTP
            </h4>

            <p class="text-gray-400 mt-2">
                Used to transfer files between computers.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                SMTP, POP3, and IMAP
            </h4>

            <p class="text-gray-400 mt-2">
                Used to send (SMTP) and receive (POP3 and IMAP) email.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                DNS
            </h4>

            <p class="text-gray-400 mt-2">
                Translates domain names such as example.com into IP addresses.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                DHCP
            </h4>

            <p class="text-gray-400 mt-2">
                Automatically assigns IP addresses to devices on a network.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Internet Addresses
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Every device on the internet needs an address so data can find it.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                IPv4
            </h4>

            <p class="text-gray-400 mt-2">
                A 32-bit address written as four numbers from 0 to 255. Example: 192.168.1.1. There are about 4.3 billion possible addresses, which are running out.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                IPv6
            </h4>

            <p class="text-gray-400 mt-2">
                A 128-bit address written in hexadecimal. It provides a nearly unlimited number of addresses.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A domain name is the easy-to-remember name of a website. DNS works like a phone book that looks up the IP address that belongs to a domain name.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Internet Services
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                World Wide Web
            </h4>

            <p class="text-gray-400 mt-2">
                Websites and web pages.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Electronic Mail
            </h4>

            <p class="text-gray-400 mt-2">
                Sending and receiving messages and files.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                File Transfer
            </h4>

            <p class="text-gray-400 mt-2">
                Uploading and downloading files.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                VoIP and Video Calls
            </h4>

            <p class="text-gray-400 mt-2">
                Voice and video communication over the internet.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Streaming
            </h4>

            <p class="text-gray-400 mt-2">
                Watching or listening to media without downloading all of it first.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Cloud Services
            </h4>

            <p class="text-gray-400 mt-2">
                Online storage and applications.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        How Data Travels: Packets
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When you request a web page, the data is split into small packets. Each packet carries the sender's address, the destination address, and a sequence number. The packets may travel along different routes through routers and are put back in order at the destination. If a packet is lost, TCP asks for it again. This design makes the internet flexible and able to route around problems.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Protocols in More Detail
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                IP (Internet Protocol)
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Gives every device an address and moves packets from the source to the destination, hop by hop.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                TCP and UDP
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                TCP is reliable and ordered, so it is used for web pages, email, and file transfers. UDP is faster and does not check delivery, so it suits live video, voice calls, and games.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                HTTP and HTTPS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                HTTP is how browsers request and receive web pages. HTTPS adds encryption using TLS, which protects passwords and personal data from being read on the way. Always look for HTTPS on pages that ask for sensitive information.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                DNS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Converts a domain name such as example.com into an IP address, much like a phone book. Without it, we would have to remember numbers for every site.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                DHCP
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Automatically gives a device an IP address and network settings when it joins a network.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                SMTP, POP3, and IMAP
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                SMTP sends email between servers. POP3 downloads email to one device, while IMAP keeps email on the server so it can be read from many devices.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                FTP
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Transfers files between a computer and a server, often used for uploading website files.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Understanding IP Addresses
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An IPv4 address has 32 bits written as four numbers separated by dots, each from 0 to 255. Because the world has far more devices than the roughly 4.3 billion IPv4 addresses, IPv6 was created. It uses 128 bits, written in hexadecimal with colons, which gives an almost unlimited number of addresses. Some addresses, such as those starting with 192.168, are private and used only inside local networks, and a router uses NAT to let many private devices share one public address.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Reading an IPv4 Address
        </h4>

        <p class="text-white mt-3">
            192.168.1.10 has four parts, each one byte.
        </p>

        <p class="text-gray-400 mt-2">
            192 in binary is 11000000.
        </p>

        <p class="text-gray-400 mt-2">
            The router in a home network is often 192.168.1.1.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Domain Names
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A domain name has levels read from right to left. In www.school.edu.ph, ph is the country-code top-level domain, edu is a second-level domain, school is the name of the organization, and www is a subdomain. Domain names are registered through registrars, and the DNS system maps them to the IP address of the server that hosts the website.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Internet Services
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        The internet is the infrastructure, and many services run on top of it. The World Wide Web gives access to web pages. Email sends messages and attachments. File transfer and cloud storage move and keep files. VoIP and video conferencing carry voice and video, and streaming delivers audio and video continuously. Each service uses its own protocols but all rely on the same underlying network.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What does DNS do?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> It translates domain names into IP addresses.
        </p>

        <p class="text-white mt-4">
            Why use HTTPS instead of HTTP?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> HTTPS encrypts the data, protecting passwords and personal information from being read by others.
        </p>

        <p class="text-white mt-4">
            How many bits are in an IPv6 address?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> 128 bits.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            Protocols such as IP, TCP, HTTP, and DNS work together so data can travel across the world, and IP addresses and domain names tell data where to go.
        </p>

    </div>

</div>

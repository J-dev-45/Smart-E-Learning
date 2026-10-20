{{-- TOPIC 8.1: HTML BASICS --}}
<div class="mt-10" id="topic-html-basics">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.1 HTML Basics
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        HTML (HyperText Markup Language) is the standard language used to create the structure and content of web pages. It is a markup language, not a programming language, because it describes content instead of performing logic.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Every website you visit, from a simple school page to a large social network, is built on HTML. As a web developer, it is the first language you learn, because it creates the foundation that CSS and JavaScript build on.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The History of HTML
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1991
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Tim Berners-Lee created the first version of HTML with a small set of tags.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                1995 to 1999
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                HTML 2.0, 3.2, and 4.01 were released and added tables, forms, and styling support.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                2000
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                XHTML combined HTML with stricter XML rules.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                2014
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                HTML5 became an official recommendation, adding audio, video, and semantic elements without needing plugins.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Tags and Attributes
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        HTML uses tags to mark up content. Most tags come in pairs: an opening tag and a closing tag. Attributes give extra information about an element and are written inside the opening tag.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>&lt;a href="https://example.com"&gt;Visit our site&lt;/a&gt;</code></pre>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Tag
            </h4>

            <p class="text-gray-400 mt-2">
                Example: &lt;p&gt; and &lt;/p&gt;. It marks the start and end of an element.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Attribute
            </h4>

            <p class="text-gray-400 mt-2">
                Example: href. It adds extra information to the element.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Element
            </h4>

            <p class="text-gray-400 mt-2">
                The opening tag, content, and closing tag together.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Common Tags
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;h1&gt; to &lt;h6&gt;
            </h4>

            <p class="text-gray-400 mt-2">
                Headings, from largest to smallest.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;p&gt;
            </h4>

            <p class="text-gray-400 mt-2">
                A paragraph of text.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;a&gt;
            </h4>

            <p class="text-gray-400 mt-2">
                A link to another page.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;img&gt;
            </h4>

            <p class="text-gray-400 mt-2">
                An image. Uses the src and alt attributes.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;
            </h4>

            <p class="text-gray-400 mt-2">
                Unordered list, ordered list, and list item.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                &lt;table&gt;, &lt;tr&gt;, &lt;td&gt;
            </h4>

            <p class="text-gray-400 mt-2">
                Table, row, and cell.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        HTML Editor
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        An HTML file is plain text, so it can be written in any text editor. Code editors such as Visual Studio Code, Sublime Text, and Notepad++ add helpful features like color highlighting and auto-complete. The finished file is saved with the .html extension and opened in a browser.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Creating the First HTML Web Page
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
  &lt;title&gt;My First Page&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
  &lt;h1&gt;Hello, World!&lt;/h1&gt;
  &lt;p&gt;This is my first web page.&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            &lt;!DOCTYPE html&gt; tells the browser this is an HTML5 document
        </li>

        <li>
            &lt;html&gt; wraps the whole page
        </li>

        <li>
            &lt;head&gt; holds information about the page, such as the title
        </li>

        <li>
            &lt;body&gt; holds everything the visitor sees
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        HTML Describes Meaning and Structure
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        HTML tells the browser what each piece of content is: a heading, a paragraph, a link, an image, a list, or a table. It does not decide how the content looks. That job belongs to CSS. Separating structure from style keeps pages organized and lets one design be applied to many pages. HTML5 also added semantic elements such as header, nav, main, section, article, and footer, which describe the purpose of each area and help search engines and screen readers understand the page.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The History of HTML in More Detail
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Tim Berners-Lee created HTML in 1991 as a way to link documents on the Web. HTML 2.0 was published in 1995 as the first standard. HTML 3.2 in 1997 and HTML 4.01 in 1999 added tables, forms, scripting, and style sheets. XHTML in 2000 required stricter, XML-style writing. HTML5 became a W3C Recommendation in 2014 and added native audio, video, canvas drawing, local storage, and many new elements, so plugins such as Flash were no longer needed. Today, HTML is maintained as a living standard.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Anatomy of an HTML Element
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>&lt;p class="intro"&gt;Welcome to my page.&lt;/p&gt;</code></pre>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Opening Tag
            </h4>

            <p class="text-gray-400 mt-2">
                &lt;p class="intro"&gt; starts the element and can contain attributes.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Content
            </h4>

            <p class="text-gray-400 mt-2">
                The text or other elements inside, such as Welcome to my page.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Closing Tag
            </h4>

            <p class="text-gray-400 mt-2">
                &lt;/p&gt; ends the element. It has a slash.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Attribute
            </h4>

            <p class="text-gray-400 mt-2">
                class="intro" gives extra information. It has a name and a value in quotes.
            </p>
        </div>

    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Some elements are empty or void elements, which do not have content or a closing tag, such as the image tag and the line break tag. Elements can also be nested inside each other, as long as they are closed in the correct order.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Frequently Used Tags
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Headings: h1 to h6
            </h4>

            <p class="text-gray-400 mt-2">
                h1 is the main title and should normally appear once per page. Lower levels create subsections.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Paragraph and line break: p and br
            </h4>

            <p class="text-gray-400 mt-2">
                p creates a block of text, br adds a line break inside it.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Links: a
            </h4>

            <p class="text-gray-400 mt-2">
                Uses the href attribute to point to another page, file, or section.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Images: img
            </h4>

            <p class="text-gray-400 mt-2">
                Uses src for the file and alt for a text description that helps accessibility and shows if the image fails to load.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Lists: ul, ol, li
            </h4>

            <p class="text-gray-400 mt-2">
                ul makes bullet lists, ol makes numbered lists, and li marks each item.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Tables: table, tr, th, td
            </h4>

            <p class="text-gray-400 mt-2">
                Show data in rows and columns.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Forms: form, input, button, label
            </h4>

            <p class="text-gray-400 mt-2">
                Collect information from users.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Containers: div and span
            </h4>

            <p class="text-gray-400 mt-2">
                Group content so that it can be styled or scripted.
            </p>
        </div>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Structure of an HTML Document
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;My First Page&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
  &lt;h1&gt;Hello, World!&lt;/h1&gt;
  &lt;p&gt;This is my first web page.&lt;/p&gt;
  &lt;a href="https://example.com"&gt;Visit a website&lt;/a&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            DOCTYPE tells the browser to use modern HTML5 rules.
        </li>

        <li>
            The lang attribute states the page language for browsers and screen readers.
        </li>

        <li>
            meta charset UTF-8 lets the page show characters from many languages correctly.
        </li>

        <li>
            The viewport meta tag makes the page display properly on mobile devices.
        </li>

        <li>
            title appears on the browser tab and in search results.
        </li>

        <li>
            Only the content inside body is displayed in the page.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Steps to Create and View Your First Page
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Open a code editor such as Visual Studio Code.
        </li>

        <li>
            Create a new file and save it as index.html.
        </li>

        <li>
            Type the structure above and change the text.
        </li>

        <li>
            Save the file and open it in a browser by double-clicking it, or use a tool like Live Server.
        </li>

        <li>
            Edit, save, and refresh to see changes.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Good Habits for Beginners
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Close every tag and nest tags in the correct order
        </li>

        <li>
            Indent nested elements so the structure is easy to read
        </li>

        <li>
            Use lowercase tag and attribute names
        </li>

        <li>
            Always add alt text to images
        </li>

        <li>
            Use headings in order and use semantic elements where they fit
        </li>

        <li>
            Validate your code using the W3C validator when something looks wrong
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between a tag and an element?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A tag is the marking in angle brackets, while an element includes the opening tag, the content, and the closing tag.
        </p>

        <p class="text-white mt-4">
            Which attribute gives a text description for an image?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The alt attribute.
        </p>

        <p class="text-white mt-4">
            Which part of an HTML document is shown in the browser window?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> The content inside the body element.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            HTML structures a web page using tags and attributes. Every page needs the basic html, head, and body parts.
        </p>

    </div>

</div>

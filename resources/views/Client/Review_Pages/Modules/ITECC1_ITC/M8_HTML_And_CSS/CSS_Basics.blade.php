{{-- TOPIC 8.2: CSS BASICS --}}
<div class="mt-10" id="topic-css-basics">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        8.2 CSS Basics
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        CSS (Cascading Style Sheets) controls how HTML elements look, including colors, fonts, spacing, and layout. HTML provides the structure, and CSS provides the design.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        If HTML builds the skeleton of a web page, CSS gives it its look. Colors, fonts, spacing, layout, and even animation are controlled by CSS, and a few simple rules can change the whole feel of a site.
    </p>

    <h3 class="text-xl font-bold mt-6">
        CSS Rule Structure
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A CSS rule has a selector, which chooses the elements to style, and a declaration block, which contains properties and values.
    </p>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>p &#123;
  color: blue;
  font-size: 18px;
}</code></pre>

    <h3 class="text-xl font-bold mt-6">
        CSS Element Selectors
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Element Selector
            </h4>

            <p class="text-gray-400 mt-2">
                Targets all elements of a tag. Example: p styles every paragraph.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Class Selector
            </h4>

            <p class="text-gray-400 mt-2">
                Targets elements with a class, written with a dot. Example: .note
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                ID Selector
            </h4>

            <p class="text-gray-400 mt-2">
                Targets one unique element, written with a hash. Example: #header
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>h1 &#123; color: darkred; }
.note &#123; background-color: yellow; }
#header &#123; text-align: center; }</code></pre>

    <h3 class="text-xl font-bold mt-6">
        How to Add CSS
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Inline CSS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written in the style attribute of a single element. Example: &lt;p style="color:red;"&gt;. Good for quick changes but hard to maintain.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Internal CSS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written inside a &lt;style&gt; tag in the head of the page. It applies to that page only.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                External CSS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written in a separate .css file and linked with a &lt;link&gt; tag. It is the best practice because one file can style many pages.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>&lt;link rel="stylesheet" href="style.css"&gt;</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Why Separate CSS from HTML?
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            One style sheet can control hundreds of pages, so a change is made in one place.
        </li>

        <li>
            HTML stays clean and focused on meaning.
        </li>

        <li>
            Pages load faster because browsers store the CSS file and reuse it.
        </li>

        <li>
            Different styles can be shown for phones, tablets, and desktops.
        </li>

    </ul>

    <h3 class="text-xl font-bold mt-6">
        Anatomy of a CSS Rule
    </h3>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>h1 &#123;
  color: darkblue;
  font-size: 32px;
  text-align: center;
}</code></pre>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        h1 is the selector and says which elements to style. The part in curly braces is the declaration block. Each declaration has a property, such as color, and a value, such as darkblue, separated by a colon and ended with a semicolon.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Selectors in More Detail
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Element Selector
            </h4>

            <p class="text-gray-400 mt-2">
                Targets every element of that tag, such as p or h1.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Class Selector
            </h4>

            <p class="text-gray-400 mt-2">
                Starts with a dot, for example .card. Many elements can share a class, and an element can have several classes.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                ID Selector
            </h4>

            <p class="text-gray-400 mt-2">
                Starts with a hash, for example #header. An ID must be unique on the page.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Grouping and Descendant
            </h4>

            <p class="text-gray-400 mt-2">
                h1, h2 styles both. nav a styles only the links inside a nav element.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>p &#123; color: #333333; }
.highlight &#123; background-color: yellow; }
#main-title &#123; font-size: 40px; }
nav a &#123; text-decoration: none; }</code></pre>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        When two rules conflict, the more specific selector wins: an ID is stronger than a class, and a class is stronger than an element selector. If they are equally specific, the rule written later wins. This is the "cascading" in Cascading Style Sheets.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Three Ways to Add CSS
    </h3>

    <div class="space-y-4 mt-4">

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Inline CSS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written in the style attribute of one element, such as style="color:red". It overrides most other styles and is hard to maintain, so use it rarely.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                Internal CSS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written in a style element inside the head. It applies to that single page and is useful for quick experiments.
            </p>
        </div>

        <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5">
            <h4 class="font-bold text-lg">
                External CSS
            </h4>

            <p class="text-gray-400 mt-2 leading-relaxed">
                Written in a separate .css file and linked in the head with a link element. It is the recommended method for real websites.
            </p>
        </div>

    </div>

    <pre class="bg-[#12081F] border border-[#3A2560] rounded-xl p-4 mt-4 text-sm text-gray-200 overflow-x-auto"><code>&lt;link rel="stylesheet" href="style.css"&gt;</code></pre>

    <h3 class="text-xl font-bold mt-6">
        Colors, Fonts, and Text
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Colors can be written as names (red), hexadecimal codes (#FF0000), RGB values (rgb(255, 0, 0)), or HSL. Common text properties include font-family to choose the typeface, font-size to set the size, font-weight for bold, line-height for spacing between lines, and text-align for alignment. Always give a fallback font, for example font-family: Arial, sans-serif.
    </p>

    <h3 class="text-xl font-bold mt-6">
        The Box Model
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Every HTML element is treated as a rectangular box made of four layers. The content is the actual text or image. Padding is the space between the content and the border. The border surrounds the padding. Margin is the empty space outside the border that separates the element from its neighbors. Understanding these layers is the key to controlling spacing and layout.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Box Model
        </h4>

        <p class="text-white mt-3">
            width: 200px; padding: 10px; border: 2px solid black; margin: 20px;
        </p>

        <p class="text-gray-400 mt-2">
            Content and padding and border add up to the total space the box occupies, and the margin adds space around it.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Layout and Responsive Design
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Modern layouts use Flexbox for arranging items in a row or a column and CSS Grid for two-dimensional layouts with rows and columns. Responsive design makes a page adapt to the screen size using flexible widths, relative units like percentages, rem, and vw, and media queries that apply different rules to different screen widths. Since most people browse on phones, designing for small screens first is a common practice.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Tips for Beginners
    </h3>

    <ul class="text-gray-400 mt-3 px-3 space-y-2 list-disc list-inside">

        <li>
            Use meaningful class names such as .card or .nav-link
        </li>

        <li>
            Reuse classes instead of repeating the same properties
        </li>

        <li>
            Use browser developer tools (F12) to test changes live
        </li>

        <li>
            Keep your CSS organized and add comments for large sections
        </li>

        <li>
            Start simple, then add layout and effects one step at a time
        </li>

    </ul>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-6">

        <h4 class="font-bold text-lg">
            Check Your Understanding
        </h4>

        <p class="text-white mt-4">
            What is the difference between a class selector and an ID selector?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> A class starts with a dot and can be used on many elements, while an ID starts with a hash and must be unique on a page.
        </p>

        <p class="text-white mt-4">
            Which method of adding CSS is best for a real website?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> External CSS, because one file can style many pages and is easy to maintain.
        </p>

        <p class="text-white mt-4">
            What are the four parts of the box model?
        </p>

        <p class="text-gray-400 mt-1 leading-relaxed">
            <span class="text-[#CECBF6] font-semibold">Answer:</span> Content, padding, border, and margin.
        </p>

    </div>

    <div class="bg-[#24123B] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Key Idea
        </h4>

        <p class="text-gray-300 mt-2 leading-relaxed">
            CSS styles HTML using selectors and declarations. External CSS is the preferred way to add styles because it keeps design separate from content and can be reused.
        </p>

    </div>

</div>

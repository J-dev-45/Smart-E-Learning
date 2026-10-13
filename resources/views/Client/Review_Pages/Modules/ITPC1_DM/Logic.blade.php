<div class="mt-10" id="topic-logic">

    {{-- TOPIC --}}
    <h2 class="text-2xl font-bold">
        1. Logic
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        Logic is the study of correct reasoning. In Discrete Mathematics,
        logic is used to determine whether statements are true or false,
        construct valid arguments, analyze relationships between statements,
        and solve problems systematically.
    </p>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Logical reasoning is important in Information Technology because it
        provides a foundation for problem-solving, programming, algorithms,
        database queries, and decision-making. By using logical rules,
        complex problems can be broken down into smaller and more manageable
        statements.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Proposition
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A proposition is a declarative statement that is either true or
        false, but cannot be both. Propositions are commonly represented
        using letters such as <span class="text-white">P</span>,
        <span class="text-white">Q</span>, and <span class="text-white">R</span>.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Examples
        </h4>

        <p class="text-gray-400 mt-3">
            <span class="text-white">P:</span>
            5 is greater than 3.
            <span class="text-white">→ True</span>
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">Q:</span>
            10 is less than 2.
            <span class="text-white">→ False</span>
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">R:</span>
            Manila is the capital of the Philippines.
            <span class="text-white">→ True</span>
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Logical Connectives
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Logical connectives are used to combine or modify propositions to
        create compound propositions. The truth value of a compound
        proposition depends on the truth values of its components and the
        connective used.
    </p>

    <div class="overflow-x-auto mt-4">

        <table class="w-full border-collapse">

            <thead>
                <tr class="bg-[#24123B]">
                    <th class="border border-[#3A2560] p-3 text-left">
                        Operator
                    </th>

                    <th class="border border-[#3A2560] p-3 text-left">
                        Symbol
                    </th>

                    <th class="border border-[#3A2560] p-3 text-left">
                        Meaning
                    </th>
                </tr>
            </thead>

            <tbody class="text-gray-400">

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        AND
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        ∧
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        True when both propositions are true.
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        OR
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        ∨
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        True when at least one proposition is true.
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        NOT
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        ¬
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        Reverses the truth value of a proposition.
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        Implication
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        →
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        Represents "if...then". It is false only when the
                        first proposition is true and the second is false.
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        Biconditional
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        ↔
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        Represents "if and only if". It is true when both
                        propositions have the same truth value.
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Compound Propositions
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A compound proposition is formed by combining two or more
        propositions using logical connectives. For example, if
        <span class="text-white">P</span> means "It is raining" and
        <span class="text-white">Q</span> means "I bring an umbrella",
        then <span class="text-white">P ∧ Q</span> means "It is raining
        and I bring an umbrella."
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example
        </h4>

        <p class="text-gray-400 mt-3">
            <span class="text-white">P:</span> The computer is connected
            to the Internet.
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">Q:</span> The user can access the
            website.
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">P → Q:</span>
            If the computer is connected to the Internet, then the user
            can access the website.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Truth Tables
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A truth table is a systematic way of showing all possible truth
        values of propositions and the resulting truth value of a compound
        proposition. Truth tables are useful for analyzing logical
        expressions and determining whether a compound proposition is true
        or false under different conditions.
    </p>

    <div class="overflow-x-auto mt-4">

        <table class="w-full border-collapse">

            <thead>
                <tr class="bg-[#24123B]">
                    <th class="border border-[#3A2560] p-3">
                        P
                    </th>

                    <th class="border border-[#3A2560] p-3">
                        Q
                    </th>

                    <th class="border border-[#3A2560] p-3">
                        P ∧ Q
                    </th>
                </tr>
            </thead>

            <tbody class="text-gray-400 text-center">

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        T
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        T
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        T
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        T
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        F
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        F
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        F
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        T
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        F
                    </td>
                </tr>

                <tr>
                    <td class="border border-[#3A2560] p-3">
                        F
                    </td>

                    <td class="border border-[#3A2560] p-3">
                        F
                    </td>

                    <td class="border border-[#3A2560] p-3 text-white">
                        F
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Tautology and Contradiction
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        A <span class="text-white">tautology</span> is a compound
        proposition that is true for every possible combination of truth
        values. In contrast, a <span class="text-white">contradiction</span>
        is a compound proposition that is false for every possible
        combination of truth values.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Examples
        </h4>

        <p class="text-gray-400 mt-3">
            <span class="text-white">Tautology:</span>
            P ∨ ¬P
        </p>

        <p class="text-gray-400 mt-2">
            This is always true because either P is true or P is not true.
        </p>

        <p class="text-gray-400 mt-4">
            <span class="text-white">Contradiction:</span>
            P ∧ ¬P
        </p>

        <p class="text-gray-400 mt-2">
            This is always false because a proposition cannot be both true
            and false at the same time.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Propositional Equivalence
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Two propositions are logically equivalent when they have the same
        truth value for every possible combination of their component
        propositions. Logical equivalence can be verified using truth
        tables.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example
        </h4>

        <p class="text-gray-400 mt-3">
            The propositions
            <span class="text-white">¬(P ∧ Q)</span>
            and
            <span class="text-white">¬P ∨ ¬Q</span>
            are logically equivalent.
        </p>

        <p class="text-gray-400 mt-2">
            This relationship is known as one of De Morgan's Laws.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Rules of Inference
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Rules of inference are logical patterns used to derive a valid
        conclusion from known statements or premises. They help determine
        whether an argument follows logically from its assumptions.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Example: Modus Ponens
        </h4>

        <p class="text-gray-400 mt-3">
            <span class="text-white">Premise 1:</span>
            If it rains, then the ground becomes wet.
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">Premise 2:</span>
            It is raining.
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">Conclusion:</span>
            Therefore, the ground becomes wet.
        </p>

    </div>

    <h3 class="text-xl font-bold mt-6">
        Logic in Information Technology
    </h3>

    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">
        Logic is widely used in Information Technology. Programmers use
        logical conditions to control the behavior of programs, while
        databases use logical expressions to filter and retrieve data.
        Logic is also important in algorithms, computer circuits,
        artificial intelligence, and automated decision-making.
    </p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">

        <h4 class="font-bold text-lg">
            Real-World Example
        </h4>

        <p class="text-gray-400 mt-3">
            Suppose a system allows a user to log in only when the username
            and password are both correct.
        </p>

        <p class="text-gray-400 mt-3">
            <span class="text-white">Username Correct = P</span>
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">Password Correct = Q</span>
        </p>

        <p class="text-gray-400 mt-2">
            <span class="text-white">Login Allowed = P ∧ Q</span>
        </p>

        <p class="text-gray-400 mt-3">
            The system grants access only when both conditions are true.
            This demonstrates how logical operators can be applied to
            real-world computing systems.
        </p>

    </div>

    {{-- <topic-pretest 
        :questions='@json($questions)'
        :topic-progress='@json($topic_progress)'
    ></topic-pretest> --}}

</div>

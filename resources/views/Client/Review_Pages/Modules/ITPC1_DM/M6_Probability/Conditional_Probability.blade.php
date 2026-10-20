<div class="mt-10" id="topic-conditional-probability">

    <h2 class="text-2xl font-bold">
        2. Conditional Probability
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="bg-gray-600 w-full h-[1px]"></div>
    </div>

    <p class="text-md text-gray-400 px-3 mt-4 leading-relaxed">
        Conditional probability is the probability that an event occurs when another event is already known to have occurred. The additional information can change the set of outcomes being considered, so the probability may differ from the original probability.
    </p>

    <h3 class="text-xl font-bold mt-6">Formula for Conditional Probability</h3>
    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">
        <p class="text-white font-semibold">For events A and B, where P(B) is greater than 0:</p>
        <p class="text-white text-lg mt-3">P(A | B) = P(A ∩ B) / P(B)</p>
        <p class="text-gray-400 mt-3">P(A | B) means the probability of A given that B has occurred. P(A ∩ B) is the probability that both A and B occur.</p>
    </div>

    <h3 class="text-xl font-bold mt-6">Worked Example</h3>
    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">A class has 30 students. Twelve students are members of the programming club, and 8 students are both club members and honor students. If a randomly selected student is known to be a programming club member, what is the probability that the student is an honor student?</p>
    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4 space-y-3">
        <p class="text-white">A = selected student is an honor student.</p>
        <p class="text-white">B = selected student is a programming club member.</p>
        <p class="text-white">P(A | B) = 8/12 = 2/3.</p>
        <p class="text-gray-400">Among the 12 club members, 8 are honor students, so the conditional probability is 2/3.</p>
    </div>

    <h3 class="text-xl font-bold mt-6">Independent Events</h3>
    <p class="text-md text-gray-400 px-3 mt-3 leading-relaxed">Events A and B are independent when knowing that B occurred does not change the probability of A. For independent events, P(A | B) = P(A), provided P(B) is greater than 0. Equivalently, P(A ∩ B) = P(A)P(B).</p>

    <div class="bg-[#1B0D2D] border border-[#3A2560] rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">Remember</h4>
        <p class="text-gray-400 mt-2">Always identify the condition first. The event after the vertical bar determines the reduced group of outcomes used as the denominator.</p>
    </div>
</div>

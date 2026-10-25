<template>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mt-10 mb-10">

        <!-- LEFT: assessments (Quiz first, then Coding) -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <template v-if="module.has_question_type">
                <!-- QUIZ: PASSED -->
                <span v-if="moduleQuiz.has_passed"
                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-emerald-300 border-[1.5px] border-emerald-400/40 bg-emerald-400/10 rounded-full py-2.5 px-6 whitespace-nowrap cursor-default select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 text-emerald-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Quiz Passed
                </span>

                <!-- QUIZ: OPEN -->
                <a v-else-if="moduleProgress.has_passed"
                    :href="`/assessment/quiz/question_type/${url(subject.subject_name)}/${subject.id}/${url(module.module_name)}/${module.id}`"
                    class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-[#CECBF6] border-[1.5px] border-[#CECBF6]/30 bg-[#CECBF6]/5 rounded-full py-2.5 px-6 transition-all duration-300 hover:border-[#CECBF6]/60 hover:bg-[#CECBF6]/10 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
                    Take Quiz
                </a>

                <!-- QUIZ: LOCKED -->
                <span v-else
                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-gray-600 border-[1.5px] border-gray-700 bg-white/[0.02] rounded-full py-2.5 px-6 whitespace-nowrap cursor-not-allowed select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    Quiz Locked
                </span>
            </template>

            <template v-if="module.has_coding">
                <!-- CODING: PASSED -->
                <span v-if="moduleQuiz.coding_passed"
                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-emerald-300 border-[1.5px] border-emerald-400/40 bg-emerald-400/10 rounded-full py-2.5 px-6 whitespace-nowrap cursor-default select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 text-emerald-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Coding Passed
                </span>

                <!-- CODING: OPEN -->
                <a v-else-if="moduleQuiz.questions_type_passed"
                    href=""
                    class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-[#CECBF6] border-[1.5px] border-[#CECBF6]/30 bg-[#CECBF6]/5 rounded-full py-2.5 px-6 transition-all duration-300 hover:border-[#CECBF6]/60 hover:bg-[#CECBF6]/10 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m17.25 6.75 5.25 5.25-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                    </svg>
                    Take Coding
                </a>

                <!-- CODING: LOCKED -->
                <span v-else
                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-gray-600 border-[1.5px] border-gray-700 bg-white/[0.02] rounded-full py-2.5 px-6 whitespace-nowrap cursor-not-allowed select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    Coding Locked
                </span>
            </template>
        </div>

        <!-- RIGHT: Next -->
        <!-- NEXT: OPEN -->
        <a v-if="moduleQuiz.has_passed" href=""
            class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-[#090014] bg-[#CECBF6] rounded-full py-2.5 px-6 transition-colors hover:bg-[#CECBF6]/85 whitespace-nowrap">
            Next
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-300 group-hover:translate-x-0.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>

        <!-- NEXT: LOCKED -->
        <span v-else
            class="inline-flex w-full sm:w-auto items-center justify-center gap-2 text-sm font-bold text-gray-600 border-[1.5px] border-gray-700 bg-white/[0.02] rounded-full py-2.5 px-6 whitespace-nowrap cursor-not-allowed select-none">
            Next
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </span>
    </div>
</template>

<script setup>

const props = defineProps({
    subject: { type: Object, required: true},
    module: { type: Object, required: true},
    moduleProgress: {type: Object, required:true},
    moduleQuiz: {type: Object, required: true}
})

console.log(props.module)
function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}
</script>
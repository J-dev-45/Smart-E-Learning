<template>
    <!-- Result (Passed / Failed) -->
    <div
        v-if="hasPassed || failed"
        class="flex flex-col mt-5 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-clip"
    >
        <div
            class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r to-white"
            :class="hasPassed ? 'from-emerald-50/70' : 'from-rose-50/70'"
        >
            <span
                class="shrink-0 flex items-center justify-center w-9 h-9 rounded-lg"
                :class="hasPassed ? 'bg-emerald-500/10 text-emerald-600' : 'bg-rose-500/10 text-rose-600'"
            >
                <svg v-if="hasPassed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </span>
            <div class="flex flex-col">
                <span class="text-base font-semibold text-gray-900 leading-tight">Activity</span>
                <span class="text-xs text-gray-500">
                    {{ hasPassed ? 'You passed. Review your answers below.' : "You didn't pass this time. Review your answers below." }}
                </span>
            </div>

            <span
                v-if="results.length"
                class="ml-auto inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold ring-1"
                :class="hasPassed ? 'bg-emerald-50 text-emerald-700 ring-emerald-200' : 'bg-rose-50 text-rose-700 ring-rose-200'"
            >
                Score: {{ score }} / {{ results.length }}
            </span>
        </div>

        <div class="flex flex-col gap-4 px-6 py-5">
            <div
                v-for="(item, index) in results"
                :key="item.question_id"
                class="flex flex-col gap-3 p-4 rounded-xl border-2"
                :class="isCorrect(item) ? 'border-emerald-200 bg-emerald-50/40' : 'border-rose-300 bg-rose-50 shadow-sm shadow-rose-500/10'"
            >
                <div class="flex items-start gap-3 text-sm font-medium text-gray-800 leading-relaxed">
                    <span
                        class="shrink-0 flex items-center justify-center w-6 h-6 rounded-full text-xs font-bold text-white"
                        :class="isCorrect(item) ? 'bg-emerald-500' : 'bg-rose-500'"
                    >
                        {{ index + 1 }}
                    </span>
                    <span class="pt-0.5 flex-1">{{ questionText(item.question_id) }}</span>
                    <span
                        class="shrink-0 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wide"
                        :class="isCorrect(item) ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-500 text-white'"
                    >
                        <svg v-if="isCorrect(item)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        {{ isCorrect(item) ? 'Correct' : 'Wrong' }}
                    </span>
                </div>

                <div class="flex flex-col gap-1 w-full sm:ml-9 sm:max-w-[calc(100%-2.25rem)]">
                    <span
                        class="text-xs font-semibold uppercase tracking-wider"
                        :class="isCorrect(item) ? 'text-emerald-700' : 'text-rose-700'"
                    >
                        Your answer
                    </span>
                    <input
                        type="text"
                        readonly
                        tabindex="-1"
                        :value="item.user_answer"
                        class="w-full border-2 rounded-lg px-3.5 py-2.5 text-sm font-semibold outline-none cursor-default"
                        :class="isCorrect(item) ? 'border-emerald-300 bg-white text-emerald-800' : 'border-rose-400 bg-white text-rose-700'"
                    >
                </div>

                <div class="flex flex-col gap-2 w-full sm:ml-9 sm:max-w-[calc(100%-2.25rem)]">
                    <div class="flex flex-col gap-0.5 rounded-lg border border-emerald-300 bg-emerald-50 px-3.5 py-2.5">
                        <span class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Correct answer</span>
                        <span class="text-sm font-semibold text-emerald-900">{{ item.correct_answer }}</span>
                    </div>

                    <div
                        v-if="item.explanation"
                        class="flex flex-col gap-0.5 rounded-lg border border-gray-200 bg-white px-3.5 py-2.5"
                    >
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Explanation</span>
                        <span class="text-sm text-gray-600 leading-relaxed">{{ item.explanation }}</span>
                    </div>
                </div>
            </div>

            <div
                v-if="!results.length"
                class="flex flex-col items-center justify-center gap-2 py-10 rounded-xl border border-dashed border-gray-300 bg-gray-50/50"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>
                <span class="text-sm text-gray-400">No answers to review.</span>
            </div>
        </div>

        <!-- Sticky footer: score + status/retake -->
        <form
            @submit.prevent="retakeActivity"
            class="sticky bottom-0 z-10 flex items-center justify-between gap-3 px-6 py-3.5 border-t border-gray-200 bg-white/90 backdrop-blur-md shadow-[0_-6px_16px_-8px_rgba(0,0,0,0.12)]"
        >
            <div v-if="results.length" class="flex items-center gap-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Score</span>
                <span
                    class="text-xl font-bold leading-none"
                    :class="hasPassed ? 'text-emerald-600' : 'text-rose-600'"
                >
                    {{ score }}<span class="text-sm font-semibold text-gray-400"> / {{ results.length }}</span>
                </span>
            </div>
            <span v-else></span>

            <span
                v-if="hasPassed"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-emerald-700 bg-emerald-50 ring-1 ring-emerald-200 select-none cursor-default"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                Passed
            </span>

            <button
                v-else
                type="submit"
                class="group inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-rose-500 shadow-sm shadow-rose-500/30 hover:bg-rose-600 active:bg-rose-700 active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-rose-500/25 transition-all duration-200 cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-200 group-hover:-rotate-90">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                Retake
            </button>
        </form>
    </div>

    <!-- Activity form -->
    <form
        v-else
        @submit.prevent="submitAnswers"
        class="flex flex-col mt-5 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden"
    >
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-violet-50/70 to-white">
            <span class="shrink-0 flex items-center justify-center w-9 h-9 rounded-lg bg-[#8B5CF6]/10 text-[#8B5CF6]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </span>
            <div class="flex flex-col">
                <span class="text-base font-semibold text-gray-900 leading-tight">Activity</span>
                <span class="text-xs text-gray-500">Answer the questions below, then submit.</span>
            </div>
        </div>

        <div class="flex flex-col gap-4 px-6 py-5">
            <div
                v-for="(quest, index) in questions"
                :key="quest.id"
                class="group flex flex-col gap-3 p-4 rounded-xl border border-gray-200 bg-gray-50/50 transition-all duration-200 hover:border-gray-300 focus-within:border-[#8B5CF6]/50 focus-within:bg-white focus-within:shadow-sm"
            >
                <label
                    :for="`question-${quest.id}`"
                    class="flex items-start gap-3 text-sm font-medium text-gray-800 leading-relaxed cursor-pointer"
                >
                    <span class="shrink-0 flex items-center justify-center w-6 h-6 rounded-full bg-[#8B5CF6]/10 text-[#8B5CF6] text-xs font-bold transition-colors duration-200 group-focus-within:bg-[#8B5CF6] group-focus-within:text-white">
                        {{ index + 1 }}
                    </span>
                    <span class="pt-0.5">{{ quest.question }}</span>
                </label>

                <input
                    :id="`question-${quest.id}`"
                    type="text"
                    v-model="answers[quest.id]"
                    placeholder="Type your answer"
                    class="w-full sm:ml-9 sm:max-w-[calc(100%-2.25rem)] border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-gray-800 bg-white outline-none placeholder:text-gray-400 hover:border-gray-400 focus:border-[#8B5CF6] focus:ring-4 focus:ring-[#8B5CF6]/15 transition-all duration-200"
                >
            </div>

            <div
                v-if="!questions.length"
                class="flex flex-col items-center justify-center gap-2 py-10 rounded-xl border border-dashed border-gray-300 bg-gray-50/50"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>
                <span class="text-sm text-gray-400">No questions to answer yet.</span>
            </div>
        </div>

        <div class="flex items-center justify-end px-6 py-4 border-t border-gray-100 bg-gray-50/60">
            <button
                type="submit"
                :disabled="isSubmitting || !questions.length"
                class="group inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-[#8B5CF6] shadow-sm shadow-[#8B5CF6]/30 hover:bg-[#7C3AED] active:bg-[#6D28D9] active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-[#8B5CF6]/25 transition-all duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            >
                {{ isSubmitting ? 'Submitting...' : 'Submit' }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-200 group-hover:translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </button>
        </div>
    </form>
</template>

<script setup>
import { reactive, ref, watch } from 'vue'

const props = defineProps({
    questions: { type: Array, required: true },
    module: { type: Object, default: null },
    moduleProgress: { type: Object, default: null },
    failed: { type: Boolean, default: false },
    answeredModuleQuestions: { type: Array, required: true },
    answeredQuestions: { type: Array, default: () => []},
    score: { type: Number, default: 0 }
})

const hasPassed = ref(props.moduleProgress?.has_passed ?? false)
const failed = ref(props.failed)
const isSubmitting = ref(false)

const results = ref(props.answeredModuleQuestions)
const score = ref(props.score)

const answers = reactive({})
console.log(answers)

watch(
    () => props.questions,
    (questions) => {
        const questionIds = new Set(questions.map(quest => String(quest.id)))

        Object.keys(answers).forEach(key => {
            if (!questionIds.has(key)) {
                delete answers[key]
            }
        })

        questions.forEach(quest => {
            if (!(String(quest.id) in answers)) {
                answers[quest.id] = ''
            }
        })
    },
    { immediate: true, deep: true }
)

watch(
    () => props.answeredModuleQuestions,
    (value) => { results.value = value }
)

watch(
    () => props.score,
    (value) => { score.value = value }
)

function questionText(questionId) {
    return props.answeredQuestions.find(
        quest => String(quest.id) === String(questionId)
    )?.question ?? props.questions.find(
        quest => String(quest.id) === String(questionId)
    )?.question ?? 'Question'
}

function isCorrect(item) {
    return String(item.user_answer ?? '').trim().toLowerCase() === String(item.correct_answer ?? '').trim().toLowerCase()
}

function clearAnswers() {
    Object.keys(answers).forEach(key => {
        answers[key] = ''
    })
}

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

async function submitAnswers() {
    if (isSubmitting.value) return

    isSubmitting.value = true

    try {
        const response = await fetch('/submit-module-activity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                module_id: props.module?.id,
                subject_id: props.moduleProgress?.subject_id,
                answers: Object.entries(answers).map(([questionId, answer]) => ({
                    question_id: String(questionId),
                    answer: answer
                }))
            })
        })

        const data = await response.json()

        if (!response.ok) {
            console.error('Submission failed:', data)
            return
        }

        if (data.success) {
            results.value = data.answers ?? []
            score.value = data.score ?? 0
        }

        if (data.failed) {
            clearAnswers()
            failed.value = true
        } else {
            failed.value = false
            hasPassed.value = true

            window.dispatchEvent(new CustomEvent('module-progress-updated', {
                detail: {
                    module_id: props.module?.id,
                    subject_id: props.moduleProgress?.subject_id,
                    progress: 100,
                    has_passed: true
                }
            }))
        }
    } catch (error) {
        console.error('Failed to submit answers:', error)
    } finally {
        isSubmitting.value = false
    }
}

async function retakeActivity() {
    if (isSubmitting.value) return

    isSubmitting.value = true

    try {
        const response = await fetch('/retake-activity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                module_id: props.module?.id
            })
        })

        const data = await response.json()

        if (!response.ok || !data.success) {
            console.error('Failed to retake activity:', data)
            return
        }

        results.value = []
        score.value = 0
        hasPassed.value = false
        failed.value = false

        clearAnswers()
    } catch (error) {
        console.error('Failed to retake activity:', error)
    } finally {
        isSubmitting.value = false
    }
}
</script>
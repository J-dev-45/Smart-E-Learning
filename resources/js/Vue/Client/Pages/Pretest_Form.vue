<template>
    <form @submit.prevent="submitAnswer(question.id)" class="w-full max-w-2xl mb-[50px] bg-white rounded-2xl shadow-xl shadow-[#4C1D95]/5 border border-gray-100 flex flex-col gap-5 p-6">
        <div v-if="question" class="w-full flex flex-col gap-5">
            <div class="w-full flex flex-col gap-2 pb-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold text-gray-900">
                        Question <span class="text-[#4C1D95]">{{ question_number + answered_count }}</span>
                        <span class="text-gray-400 font-normal">/ {{ questionsData.length + answered_count }}</span>
                    </span>
                    <span class="text-xs font-medium text-[#4C1D95] bg-[#CECBF6]/25 px-2.5 py-1 rounded-full">
                        {{ Math.round(((answered_count + question_number - 1) / (questionsData.length + answered_count)) * 100) }}% complete
                    </span>
                </div>

                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-[#4C1D95] to-[#8B5CF6] rounded-full transition-all duration-300"
                        :style="{ width: `${Math.min(((answered_count + question_number - 1) / (questionsData.length + answered_count)) * 100, 100)}%` }">
                    </div>
                </div>
            </div>

            <div class="flex">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold tracking-wide"
                    :class="question.question_type === 'multipleChoice' ? 'text-[#4C1D95] bg-[#4C1D95]/8 border border-[#4C1D95]/15' : 'text-[#8B5CF6] bg-[#8B5CF6]/8 border border-[#8B5CF6]/15'">
                    {{ question.question_type === 'multipleChoice' ? 'Multiple Choice' : question.question_type === 'TorF' ? 'True or False' : question.question_type === 'identification' ? 'Identification' : '' }}
                </span>
            </div>

            <div class="bg-[#4C1D95]/[0.04] border border-[#CECBF6]/40 p-4 rounded-xl">
                <span class="text-gray-800 leading-relaxed">{{ question.question }}</span>
            </div>

            <div v-if="question.question_type === 'multipleChoice'" class="flex flex-col gap-2.5">
                <label v-for="choice in choices" :key="choice"
                    :class="[
                        'flex items-center justify-between gap-3 p-3 rounded-xl border-[1.5px] transition-colors',
                        !showExplanation
                            ? 'border-gray-200 cursor-pointer hover:border-[#8B5CF6]/50 hover:bg-[#CECBF6]/10 has-[:checked]:border-[#4C1D95] has-[:checked]:bg-[#4C1D95]/5'
                            : choiceState(choice) === 'selected-correct' || choiceState(choice) === 'correct-unselected'
                                ? 'border-emerald-400 bg-gradient-to-r from-emerald-50 to-green-50 shadow-sm shadow-emerald-500/10'
                                : choiceState(choice) === 'selected-wrong'
                                    ? 'border-red-500 bg-red-50'
                                    : 'border-gray-200 opacity-60'
                    ]">
                    <div class="flex items-center gap-3">
                        <input v-model="selected_answer" :value="choice" type="radio" name="answer"
                            :disabled="showExplanation" class="w-4 h-4 accent-[#4C1D95]">
                        <span class="text-sm"
                            :class="showExplanation && (choiceState(choice) === 'selected-correct' || choiceState(choice) === 'correct-unselected') ? 'text-emerald-700 font-medium' : showExplanation && choiceState(choice) === 'selected-wrong' ? 'text-red-700 font-medium' : 'text-gray-700'">
                            {{ choice }}
                        </span>
                    </div>

                    <svg v-if="showExplanation && choiceState(choice) !== 'unselected'"
                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                        :class="choiceState(choice) === 'selected-wrong' ? 'text-red-600' : 'text-emerald-500'">
                        <path v-if="choiceState(choice) !== 'selected-wrong'" stroke-linecap="round"
                            stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </label>
            </div>

            <div v-if="question.question_type === 'identification'" class="flex flex-col gap-2">
                <div class="relative">
                    <input v-model="selected_answer" type="text" id="identification-answer"
                        name="identification-answer" placeholder="Enter your answer here" autocomplete="off"
                        :disabled="showExplanation"
                        :class="[
                            'w-full px-4 py-3 rounded-xl text-sm text-gray-800 placeholder-gray-400 border-[1.5px] outline-none transition-colors duration-150',
                            showExplanation
                                ? isCorrect
                                    ? 'border-emerald-400 bg-gradient-to-r from-emerald-50 to-green-50 text-emerald-800 font-medium shadow-sm shadow-emerald-500/10'
                                    : 'border-red-500 bg-red-50 text-red-800 font-medium'
                                : 'border-gray-200 focus:border-[#4C1D95] focus:ring-4 focus:ring-[#4C1D95]/10 hover:border-[#8B5CF6]/50'
                        ]">

                    <svg v-if="showExplanation" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 absolute right-3 top-1/2 -translate-y-1/2" fill="none"
                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                        :class="isCorrect ? 'text-emerald-500' : 'text-red-600'">
                        <path v-if="isCorrect" stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12.75l6 6 9-13.5" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>

            <div v-if="question.question_type === 'TorF'" class="flex flex-col gap-2.5">
                <label v-for="opt in torfOptions" :key="opt.value"
                    :class="[
                        'flex items-center justify-between gap-3 p-3 rounded-xl border-[1.5px] transition-colors',
                        !showExplanation
                            ? 'border-gray-200 cursor-pointer hover:border-[#8B5CF6]/50 hover:bg-[#CECBF6]/10 has-[:checked]:border-[#4C1D95] has-[:checked]:bg-[#4C1D95]/5'
                            : choiceState(opt.value) === 'selected-correct' || choiceState(opt.value) === 'correct-unselected'
                                ? 'border-emerald-400 bg-gradient-to-r from-emerald-50 to-green-50 shadow-sm shadow-emerald-500/10'
                                : choiceState(opt.value) === 'selected-wrong'
                                    ? 'border-red-500 bg-red-50'
                                    : 'border-gray-200 opacity-60'
                    ]">
                    <div class="flex items-center gap-3">
                        <input type="radio" v-model="selected_answer" name="answer" :value="opt.value"
                            :disabled="showExplanation" class="w-4 h-4 accent-[#4C1D95]">
                        <span class="text-sm"
                            :class="showExplanation && (choiceState(opt.value) === 'selected-correct' || choiceState(opt.value) === 'correct-unselected') ? 'text-emerald-700 font-medium' : showExplanation && choiceState(opt.value) === 'selected-wrong' ? 'text-red-700 font-medium' : 'text-gray-700'">
                            {{ opt.label }}
                        </span>
                    </div>

                    <svg v-if="showExplanation && choiceState(opt.value) !== 'unselected'"
                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                        :class="choiceState(opt.value) === 'selected-wrong' ? 'text-red-600' : 'text-emerald-500'">
                        <path v-if="choiceState(opt.value) !== 'selected-wrong'" stroke-linecap="round"
                            stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </label>
            </div>

            <transition enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0">
                <div v-if="showExplanation" class="flex gap-3 p-4 rounded-xl border-[1.5px]"
                    :class="isCorrect ? 'border-emerald-200 bg-gradient-to-br from-emerald-50 to-green-50 shadow-sm shadow-emerald-500/10' : 'border-red-200 bg-red-50'">

                    <div class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center mt-0.5"
                        :class="isCorrect ? 'bg-gradient-to-br from-emerald-400 to-green-500' : 'bg-red-500/15'">

                        <svg v-if="isCorrect" xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12.75l6 6 9-13.5" />
                        </svg>

                        <svg v-else xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-semibold"
                            :class="isCorrect ? 'text-emerald-700' : 'text-red-700'">
                            {{ isCorrect ? 'Correct!' : 'Incorrect' }}
                        </span>

                        <span v-if="!isCorrect && question.question_type === 'identification' && correctAnswer"
                            class="text-md font-semibold text-gray-800">
                            Answer: <span class="text-green-700">{{ question.answer }}</span>
                        </span>

                        <span class="text-sm text-gray-600 leading-relaxed">
                            {{ question.explanation }}
                        </span>
                    </div>
                </div>
            </transition>

            <div v-if="!showExplanation"
                class="flex items-center justify-end pt-4 border-t border-gray-200 mt-1">
                <button type="submit" :disabled="!selected_answer || isSubmitting"
                    class="flex items-center justify-center gap-2 min-w-[140px] px-5 py-2 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-[#4C1D95] to-[#8B5CF6] hover:opacity-90 disabled:opacity-60 disabled:cursor-not-allowed transition-opacity shadow-sm shadow-[#4C1D95]/30 cursor-pointer">
                    <svg v-if="isSubmitting" class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    {{ isSubmitting ? 'Checking Answer...' : 'Submit Answer' }}
                </button>
            </div>

            <div v-else class="flex items-center justify-end pt-4 border-t border-gray-200 mt-1">
                <button v-if="available_questions.length != 0" type="button" @click="nextQuestion"
                    class="px-5 py-2 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-[#4C1D95] to-[#8B5CF6] hover:opacity-90 transition-opacity shadow-sm shadow-[#4C1D95]/30">
                    Next Question
                </button>

                <a v-else :href="`/result/question_type/${url(subjectName)}/${subjectId}/${url(moduleName)}/${moduleId}`"
                    class="px-5 py-2 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-[#4C1D95] to-[#8B5CF6] hover:opacity-90 transition-opacity shadow-sm shadow-[#4C1D95]/30">
                    Finish
                </a>
            </div>
        </div>

        <div v-else class="text-center py-8 text-gray-600">
            You have completed all available questions for this quiz!
        </div>
    </form>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    questionsData: { type: Array, required: true },
    choicesData: { type: Array, required: true },
    subjectId: { type: String, required: true },
    moduleId: { type: String, required: true },
    answeredCount: { type: Number, default: 0 },
    answeredQuestions: { type: Array, required: true },
    subjectName: { type: String, required: true },
    moduleName: { type: String, required: true },
    score: { type: Number, default: 0 }
})

function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}

const showExplanation = ref(false)
const question_number = ref(1)
const selected_answer = ref('')
const score = ref(props.score)
const isSubmitting = ref(false)
const answered_questions = ref(
    props.answeredQuestions.map(q => typeof q === 'object' ? q.question_id : q)
)
const question = ref(null)
const correct = ref('yes')
const answered_count = ref(props.answeredCount)
const correctAnswer = computed(() => question.value?.answer)
const total_questions = props.questionsData.length + answered_count.value
const passing_score = 75

const percentage = computed(() => {
    if (total_questions <= 0) {
        return 0
    }

    return (score.value / total_questions) * 100
})

const pretest_status = computed(() => {
    return percentage.value >= passing_score ? 'Passed' : 'Failed'
})

const torfOptions = [
    { value: 'true', label: 'True' },
    { value: 'false', label: 'False' }
]

const isCorrect = computed(() => correct.value === 'yes')

function choiceState(value) {
    if (!showExplanation.value) {
        return 'unselected'
    }

    if (value === selected_answer.value) {
        return isCorrect.value ? 'selected-correct' : 'selected-wrong'
    }

    if (!isCorrect.value && correctAnswer.value && value === correctAnswer.value) {
        return 'correct-unselected'
    }

    return 'unselected'
}

const available_questions = computed(() =>
    props.questionsData.filter(q => !answered_questions.value.includes(q.id))
)

function getRandomQuestion() {
    if (available_questions.value.length === 0) {
        return null
    }

    const randomIndex = Math.floor(Math.random() * available_questions.value.length)
    return available_questions.value[randomIndex]
}

question.value = getRandomQuestion()

const choiceData = computed(() => {
    if (!question.value) {
        return null
    }

    return props.choicesData.find(ch => ch.question_id === question.value.id)
})

const choices = computed(() => [
    choiceData.value?.choice_A,
    choiceData.value?.choice_B,
    choiceData.value?.choice_C,
    choiceData.value?.choice_D
].filter(Boolean))

async function submitAnswer(id) {
    if (!selected_answer.value || isSubmitting.value) {
        return
    }

    isSubmitting.value = true

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        const response = await fetch('/submitAnswer', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                question_id: id,
                student_answer: selected_answer.value.toLowerCase().trim(),
                subject_id: props.subjectId,
                module_id: props.moduleId
            })
        })

        const data = await response.json()

        if (data.success) {
            score.value = data.score
            showExplanation.value = true
            correct.value = data.correct

            if (!answered_questions.value.includes(id)) {
                answered_questions.value.push(id)
            }

            if (Array.isArray(data.answered_questions)) {
                answered_questions.value = data.answered_questions.map(
                    q => typeof q === 'object' ? q.question_id : q
                )
            }
        } else {
            console.error(data.message)
        }
    } catch (err) {
        console.error(err)
    } finally {
        isSubmitting.value = false
    }
}

function nextQuestion() {
    selected_answer.value = ''
    showExplanation.value = false

    const next = getRandomQuestion()

    if (!next) {
        question.value = null
        return
    }

    question_number.value++
    question.value = next
}
</script>
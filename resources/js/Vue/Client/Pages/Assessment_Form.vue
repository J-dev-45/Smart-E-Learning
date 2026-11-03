<template>
    <!-- Time is up: submits unanswered questions via controller, then redirects to result -->
    <form v-if="timeLeft === 0" method="POST" action="/submit-unanswered" class="w-full max-w-2xl mb-[50px] sharedLightBG rounded-2xl shadow-xl sharedShadow border sharedLightBorder flex flex-col gap-5 p-6">
        <input type="hidden" name="_token" :value="csrfToken">
        <input type="hidden" name="subject_id" :value="subjectId">
        <input type="hidden" name="module_id" :value="moduleId ?? '0'">
        <input type="hidden" name="type_of_assessment" :value="assessmentType">
        <input v-for="q in available_questions" :key="q.id" type="hidden" name="question_ids[]" :value="q.id">

        <div class="w-full flex flex-col items-center text-center gap-5 py-6">
            <div class="w-16 h-16 rounded-full sharedStateLightFailed sharedStateTint border-[1.5px] sharedStateBorderSoft flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 sharedStateText" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <div class="flex flex-col gap-1.5">
                <span class="text-xl font-semibold sharedTXTOnLight">Time is up!</span>
                <span class="text-sm sharedTXTLightMuted leading-relaxed">Your time for this {{ assessmentType }} has ended. You can now view your result.</span>
            </div>

            <button type="submit"
                class="flex items-center justify-center min-w-[160px] px-5 py-2 rounded-lg text-sm font-semibold sharedBtn transition-all shadow-sm cursor-pointer">
                Go to Result
            </button>
        </div>
    </form>

    <form v-else @submit.prevent="submitAnswer(question?.id)" class="w-full max-w-2xl mb-[50px] sharedLightBG rounded-2xl shadow-xl sharedShadow border sharedLightBorder flex flex-col gap-5 p-6">
        <div v-if="question" class="w-full flex flex-col gap-5">
            <div class="w-full flex flex-col gap-2 pb-4 border-b sharedLightBorder">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold sharedTXTOnLight">
                        Question <span class="sharedTXTBrand">{{ question_number + answered_count }}</span>
                        <span class="sharedTXTLightFaint font-normal">/ {{ questionsData.length + answered_count }}</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium sharedTXTBrand sharedBrandTint px-2.5 py-1 rounded-full tabular-nums">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ formattedTime }} left
                    </span>
                </div>

                <div class="w-full h-1.5 sharedLightLineBG rounded-full overflow-hidden">
                    <div class="h-full sharedBGSolid rounded-full transition-all duration-1000 ease-linear"
                        :style="{ width: `${Math.min((timeLeft / TOTAL_SECONDS) * 100, 100)}%` }">
                    </div>
                </div>
            </div>

            <div class="flex">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold tracking-wide border sharedStateText sharedStateTint sharedStateBorderSoft"
                    :class="question.question_type === 'multipleChoice' ? 'sharedStateLightBrand' : 'sharedStateLightAccent'">
                    {{ question.question_type === 'multipleChoice' ? 'Multiple Choice' : question.question_type === 'TorF' ? 'True or False' : question.question_type === 'identification' ? 'Identification' : '' }}
                </span>
            </div>

            <!-- @copy.prevent
                    @cut.prevent
                    @contextmenu.prevent -->

            <div class="sharedLightFieldBG border sharedLightBorder p-4 rounded-xl">
                <span
                    
                    class="sharedTXTOnLight leading-relaxed">{{ question.question }}</span>
            </div>

            <div v-if="question.question_type === 'multipleChoice'" class="flex flex-col gap-2.5">
                <label v-for="choice in choices" :key="choice"
                    :class="[
                        'flex items-center justify-between gap-3 p-3 rounded-xl border-[1.5px] transition-colors',
                        !showExplanation
                            ? 'sharedChoice cursor-pointer'
                            : choiceState(choice) === 'selected-correct' || choiceState(choice) === 'correct-unselected'
                                ? 'sharedStateLightPassed sharedStateBorder sharedStateTint shadow-sm'
                                : choiceState(choice) === 'selected-wrong'
                                    ? 'sharedStateLightFailed sharedStateBorder sharedStateTint'
                                    : 'sharedLightBorder opacity-60'
                    ]">
                    <div class="flex items-center gap-3">
                        <input v-model="selected_answer" :value="choice" type="radio" name="answer"
                            :disabled="showExplanation" class="w-4 h-4 sharedCheckAccent">
                        <span class="text-sm"
                            :class="showExplanation && (choiceState(choice) === 'selected-correct' || choiceState(choice) === 'correct-unselected') ? 'sharedTXTLightSuccess font-medium' : showExplanation && choiceState(choice) === 'selected-wrong' ? 'sharedTXTDanger font-medium' : 'sharedTXTOnLight'">
                            {{ choice }}
                        </span>
                    </div>

                    <svg v-if="showExplanation && choiceState(choice) !== 'unselected'"
                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                        :class="choiceState(choice) === 'selected-wrong' ? 'sharedTXTDanger' : 'sharedTXTLightSuccess'">
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
                            'w-full px-4 py-3 rounded-xl text-sm border-[1.5px] outline-none transition-colors duration-150',
                            showExplanation
                                ? isCorrect
                                    ? 'sharedStateLightPassed sharedStateBorder sharedStateTint sharedStateText font-medium shadow-sm'
                                    : 'sharedStateLightFailed sharedStateBorder sharedStateTint sharedStateText font-medium'
                                : 'sharedInput sharedInputHover focus:ring-4'
                        ]">

                    <svg v-if="showExplanation" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 absolute right-3 top-1/2 -translate-y-1/2" fill="none"
                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                        :class="isCorrect ? 'sharedTXTLightSuccess' : 'sharedTXTDanger'">
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
                            ? 'sharedChoice cursor-pointer'
                            : choiceState(opt.value) === 'selected-correct' || choiceState(opt.value) === 'correct-unselected'
                                ? 'sharedStateLightPassed sharedStateBorder sharedStateTint shadow-sm'
                                : choiceState(opt.value) === 'selected-wrong'
                                    ? 'sharedStateLightFailed sharedStateBorder sharedStateTint'
                                    : 'sharedLightBorder opacity-60'
                    ]">
                    <div class="flex items-center gap-3">
                        <input type="radio" v-model="selected_answer" name="answer" :value="opt.value"
                            :disabled="showExplanation" class="w-4 h-4 sharedCheckAccent">
                        <span class="text-sm"
                            :class="showExplanation && (choiceState(opt.value) === 'selected-correct' || choiceState(opt.value) === 'correct-unselected') ? 'sharedTXTLightSuccess font-medium' : showExplanation && choiceState(opt.value) === 'selected-wrong' ? 'sharedTXTDanger font-medium' : 'sharedTXTOnLight'">
                            {{ opt.label }}
                        </span>
                    </div>

                    <svg v-if="showExplanation && choiceState(opt.value) !== 'unselected'"
                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                        :class="choiceState(opt.value) === 'selected-wrong' ? 'sharedTXTDanger' : 'sharedTXTLightSuccess'">
                        <path v-if="choiceState(opt.value) !== 'selected-wrong'" stroke-linecap="round"
                            stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </label>
            </div>

            <transition enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0">
                <div v-if="showExplanation" class="flex gap-3 p-4 rounded-xl border-[1.5px] sharedStateBorderSoft sharedStateTint"
                    :class="isCorrect ? 'sharedStateLightPassed shadow-sm' : 'sharedStateLightFailed'">

                    <div class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center mt-0.5"
                        :class="isCorrect ? 'sharedStateSolid' : 'sharedStateTint'">

                        <svg v-if="isCorrect" xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 sharedTXT" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12.75l6 6 9-13.5" />
                        </svg>

                        <svg v-else xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 sharedStateText" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-semibold sharedStateText">
                            {{ isCorrect ? 'Correct!' : 'Incorrect' }}
                        </span>

                        <span v-if="!isCorrect && question.question_type === 'identification' && correctAnswer"
                            class="text-md font-semibold sharedTXTOnLight">
                            Answer: <span class="sharedTXTLightSuccess">{{ question.answer }}</span>
                        </span>

                        <span class="text-sm sharedTXTLightMuted leading-relaxed">
                            {{ question.explanation }}
                        </span>
                    </div>
                </div>
            </transition>

            <div v-if="!showExplanation"
                class="flex items-center justify-end pt-4 border-t sharedLightBorder mt-1">
                <button type="submit" :disabled="!selected_answer || isSubmitting"
                    class="flex items-center justify-center gap-2 min-w-[140px] px-5 py-2 rounded-lg text-sm font-semibold sharedBtn disabled:opacity-60 disabled:cursor-not-allowed transition-all shadow-sm cursor-pointer">
                    <svg v-if="isSubmitting" class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    {{ isSubmitting ? 'Checking Answer...' : 'Submit Answer' }}
                </button>
            </div>

            <div v-else class="flex items-center justify-end pt-4 border-t sharedLightBorder mt-1">
                <button v-if="available_questions.length != 0" type="button" @click="nextQuestion"
                    class="px-5 py-2 rounded-lg text-sm font-semibold sharedBtn transition-all shadow-sm">
                    Next Question
                </button>

                <a v-else :href="`/result/${assessmentType}/question_type/${url(subjectName)}/${subjectId}/${url(moduleName)}/${moduleId}`"
                    class="px-5 py-2 rounded-lg text-sm font-semibold sharedBtn transition-all shadow-sm">
                    Finish
                </a>
            </div>
        </div>

        <div v-else class="text-center py-8 sharedTXTLightMuted">
            You have completed all available questions for this quiz!
        </div>
    </form>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    questionsData: { type: Array, required: true },
    choicesData: { type: Array, required: true },
    subjectId: { type: String, required: true },
    moduleId: { type: String, required: true },
    answeredCount: { type: Number, default: 0 },
    answeredQuestions: { type: Array, required: true },
    subjectName: { type: String, required: true },
    moduleName: { type: String, required: true },
    score: { type: Number, default: 0 },
    remainingSeconds: { type: Number, required: true },
    totalSeconds: { type: Number, default: 60 * 60 },
    assessmentType: { type: String, required:true}
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
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')

// ===== Timer =====
const TOTAL_SECONDS = props.totalSeconds
const timeLeft = ref(Math.max(0, Math.floor(props.remainingSeconds)))
const deadline = Date.now() + timeLeft.value * 1000
let timerId = null

const formattedTime = computed(() => {
    const m = Math.floor(timeLeft.value / 60)
    const s = timeLeft.value % 60
    return `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`
})

onMounted(() => {
    timerId = setInterval(() => {
        timeLeft.value = Math.max(0, Math.ceil((deadline - Date.now()) / 1000))

        if (timeLeft.value === 0) {
            clearInterval(timerId)
        }
    }, 1000)
})

onUnmounted(() => clearInterval(timerId))
// ===== End Timer =====

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
                module_id: props.moduleId,
                type_of_assessment : props.assessmentType
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
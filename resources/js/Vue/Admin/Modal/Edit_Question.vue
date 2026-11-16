<template>
    <Transition name="modal-fade">
        <div
            v-if="showEditQuestion"
            id="editQuestion"
            class="fixed inset-0 w-screen h-screen sharedOverlay backdrop-blur-sm z-[99] flex items-center justify-center p-4"
        >
            <Transition name="modal-scale" appear>
                <form
                    @submit.prevent="editQuestionForm(subjectName, moduleName)"
                    id="whiteBG"
                    class="relative w-[30%] min-w-[380px] max-w-lg sharedLightBG rounded-xl shadow-2xl sharedShadow flex flex-col max-h-[90vh]"
                >
                    <!-- CLOSE BUTTON -->
                    <button
                        type="button"
                        @click="closeModal"
                        aria-label="Close"
                        class="absolute right-4 top-4 p-1.5 rounded-md sharedTXTLightFaint sharedLightIconBtn transition-colors cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                    <!-- HEADER  -->
                    <div class="w-full flex flex-col gap-1 px-6 pt-6 pb-4 pr-12 border-b sharedLightBorder">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 w-10 h-10 rounded-full sharedStateLightAccent sharedStateTint flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5 sharedStateText"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"
                                    />
                                </svg>
                            </div>

                            <span class="text-lg font-semibold sharedTXTOnLight">
                                Update Question
                            </span>
                        </div>

                        <span class="text-sm sharedTXTLightMuted pl-[52px] -mt-1">
                            Update the question for your students.
                        </span>
                    </div>

                    <!-- SCROLLABLE BODY -->
                    <div class="w-full flex flex-col px-6 pb-6 pt-4 gap-5 overflow-y-auto scrollbar-thin">

                        <!-- QUESTION DETAILS BADGES -->
                        <div class="w-full flex flex-col gap-2 border-b sharedLightBorder pb-2">
                            <span class="font-semibold text-sm sharedTXTOnLight">
                                Question Details
                            </span>

                            <div class="w-full flex items-center flex-wrap shrink-0 gap-2">
                                <span class="py-1 px-2.5 text-xs font-semibold shrink-0 rounded-md border sharedStateLightBrand sharedStatePill">
                                    {{ subjectName }}
                                </span>

                                <span class="py-1 px-2.5 text-xs font-semibold shrink-0 rounded-md border sharedStateLightAccent sharedStatePill">
                                    {{ moduleName }}
                                </span>

                                <span class="py-1 px-2.5 text-xs font-semibold shrink-0 rounded-md border sharedLightBorder sharedLightLineBG sharedTXTLightMuted">
                                    {{ questionTypeLabel }}
                                </span>
                            </div>
                        </div>

                        <!-- QUESTION -->
                        <div class="w-full flex flex-col gap-2">
                            <label
                                for="question"
                                class="text-sm font-medium sharedTXTOnLight"
                            >
                                Question
                            </label>

                            <input
                                v-model="questionData.question"
                                type="text"
                                id="question"
                                placeholder="Enter Question"
                                class="sharedInput sharedInputHover w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors"
                            />
                        </div>

                        <!-- MULTIPLE CHOICE -->
                        <div
                            v-if="questionData.question_type === 'multipleChoice'"
                            class="flex flex-col gap-3 rounded-lg border sharedLightBorder sharedLightFieldBG p-4"
                        >
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium sharedTXTOnLight">
                                    Multiple Choice
                                </label>

                                <span class="text-xs sharedTXTLightFaint">
                                    Select the correct answer
                                </span>
                            </div>

                            <!-- A -->
                            <div class="w-full flex flex-col gap-1">
                                <div class="w-full flex items-center gap-2">
                                    <label
                                        for="correct_a"
                                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md border text-xs font-semibold cursor-pointer select-none transition-colors"
                                        :class="
                                            correct_choice === 'A'
                                                ? 'sharedStateLightAccent sharedStateSolid sharedStateBorder'
                                                : choicesData?.choice_A === questionData.answer
                                                    ? 'sharedStateLightPassed sharedStateSolid sharedStateBorder'
                                                    : 'sharedLightBG sharedBtnGhostLight'
                                        "
                                    >
                                        <input
                                            v-model="correct_choice"
                                            type="radio"
                                            name="correct_choice"
                                            id="correct_a"
                                            value="A"
                                            class="sr-only"
                                        />

                                        A
                                    </label>

                                    <input
                                        v-model="choicesData.choice_A"
                                        type="text"
                                        placeholder="Enter Choice A"
                                        @input="emptyChoices.A = false"
                                        :class="[
                                            'sharedInput w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors',
                                            emptyChoices.A
                                                ? 'sharedStateLightFailed sharedStateBox'
                                                : 'sharedInputHover'
                                        ]"
                                    />
                                </div>

                                <span
                                    v-if="emptyChoices.A"
                                    class="pl-11 text-xs sharedTXTDanger"
                                >
                                    This choice can't be empty
                                </span>
                            </div>

                            <!-- B -->
                            <div class="w-full flex flex-col gap-1">
                                <div class="w-full flex items-center gap-2">
                                    <label
                                        for="correct_b"
                                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md border text-xs font-semibold cursor-pointer select-none transition-colors"
                                        :class="
                                            correct_choice === 'B'
                                                ? 'sharedStateLightAccent sharedStateSolid sharedStateBorder'
                                                : choicesData?.choice_B === questionData.answer
                                                    ? 'sharedStateLightPassed sharedStateSolid sharedStateBorder'
                                                    : 'sharedLightBG sharedBtnGhostLight'
                                        "
                                    >
                                        <input
                                            v-model="correct_choice"
                                            type="radio"
                                            name="correct_choice"
                                            id="correct_b"
                                            value="B"
                                            class="sr-only"
                                        />

                                        B
                                    </label>

                                    <input
                                        v-model="choicesData.choice_B"
                                        type="text"
                                        placeholder="Enter Choice B"
                                        @input="emptyChoices.B = false"
                                        :class="[
                                            'sharedInput w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors',
                                            emptyChoices.B
                                                ? 'sharedStateLightFailed sharedStateBox'
                                                : 'sharedInputHover'
                                        ]"
                                    />
                                </div>

                                <span
                                    v-if="emptyChoices.B"
                                    class="pl-11 text-xs sharedTXTDanger"
                                >
                                    This choice can't be empty
                                </span>
                            </div>

                            <!-- C -->
                            <div class="w-full flex flex-col gap-1">
                                <div class="w-full flex items-center gap-2">
                                    <label
                                        for="correct_c"
                                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md border text-xs font-semibold cursor-pointer select-none transition-colors"
                                        :class="
                                            correct_choice === 'C'
                                                ? 'sharedStateLightAccent sharedStateSolid sharedStateBorder'
                                                : choicesData?.choice_C === questionData.answer
                                                    ? 'sharedStateLightPassed sharedStateSolid sharedStateBorder'
                                                    : 'sharedLightBG sharedBtnGhostLight'
                                        "
                                    >
                                        <input
                                            v-model="correct_choice"
                                            type="radio"
                                            name="correct_choice"
                                            id="correct_c"
                                            value="C"
                                            class="sr-only"
                                        />

                                        C
                                    </label>

                                    <input
                                        v-model="choicesData.choice_C"
                                        type="text"
                                        placeholder="Enter Choice C"
                                        @input="emptyChoices.C = false"
                                        :class="[
                                            'sharedInput w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors',
                                            emptyChoices.C
                                                ? 'sharedStateLightFailed sharedStateBox'
                                                : 'sharedInputHover'
                                        ]"
                                    />
                                </div>

                                <span
                                    v-if="emptyChoices.C"
                                    class="pl-11 text-xs sharedTXTDanger"
                                >
                                    This choice can't be empty
                                </span>
                            </div>

                            <!-- D -->
                            <div class="w-full flex flex-col gap-1">
                                <div class="w-full flex items-center gap-2">
                                    <label
                                        for="correct_d"
                                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md border text-xs font-semibold cursor-pointer select-none transition-colors"
                                        :class="
                                            correct_choice === 'D'
                                                ? 'sharedStateLightAccent sharedStateSolid sharedStateBorder'
                                                : choicesData?.choice_D === questionData.answer
                                                    ? 'sharedStateLightPassed sharedStateSolid sharedStateBorder'
                                                    : 'sharedLightBG sharedBtnGhostLight'
                                        "
                                    >
                                        <input
                                            v-model="correct_choice"
                                            type="radio"
                                            name="correct_choice"
                                            id="correct_d"
                                            value="D"
                                            class="sr-only"
                                        />

                                        D
                                    </label>

                                    <input
                                        v-model="choicesData.choice_D"
                                        type="text"
                                        placeholder="Enter Choice D"
                                        @input="emptyChoices.D = false"
                                        :class="[
                                            'sharedInput w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors',
                                            emptyChoices.D
                                                ? 'sharedStateLightFailed sharedStateBox'
                                                : 'sharedInputHover'
                                        ]"
                                    />
                                </div>

                                <span
                                    v-if="emptyChoices.D"
                                    class="pl-11 text-xs sharedTXTDanger"
                                >
                                    This choice can't be empty
                                </span>
                            </div>
                        </div>

                        <!-- TRUE OR FALSE -->
                        <div
                            v-else-if="questionData.question_type === 'TorF'"
                            class="w-full flex flex-col gap-2"
                        >
                            <span class="text-sm font-medium sharedTXTOnLight">
                                True or False
                            </span>

                            <div class="grid grid-cols-2 gap-3">
                                <!-- TRUE -->
                                <label
                                    for="answer-true"
                                    class="relative flex items-center justify-center h-12 rounded-lg border cursor-pointer select-none transition-colors text-sm font-medium"
                                    :class="
                                        question_answer === 'True'
                                            ? 'sharedStateLightAccent sharedStateBorder sharedStateTint sharedStateText'
                                            : questionData.answer === 'True'
                                                ? 'sharedStateLightPassed sharedStateBox sharedStateText'
                                                : 'sharedLightBG sharedChoice sharedTXTOnLight'
                                    "
                                >
                                    <input
                                        v-model="question_answer"
                                        id="answer-true"
                                        type="radio"
                                        name="correct-answer"
                                        value="True"
                                        class="sr-only"
                                    />

                                    True
                                </label>

                                <!-- FALSE -->
                                <label
                                    for="answer-false"
                                    class="relative flex items-center justify-center h-12 rounded-lg border cursor-pointer select-none transition-colors text-sm font-medium"
                                    :class="
                                        question_answer === 'False'
                                            ? 'sharedStateLightAccent sharedStateBorder sharedStateTint sharedStateText'
                                            : questionData.answer === 'False'
                                                ? 'sharedStateLightPassed sharedStateBox sharedStateText'
                                                : 'sharedLightBG sharedChoice sharedTXTOnLight'
                                    "
                                >
                                    <input
                                        v-model="question_answer"
                                        id="answer-false"
                                        type="radio"
                                        name="correct-answer"
                                        value="False"
                                        class="sr-only"
                                    />

                                    False
                                </label>
                            </div>
                        </div>

                        <!-- IDENTIFICATION -->
                        <div
                            v-else-if="questionData.question_type === 'identification'"
                            class="w-full flex flex-col gap-2"
                        >
                            <label
                                for="identification"
                                class="text-sm font-medium sharedTXTOnLight"
                            >
                                Identification
                            </label>

                            <input
                                v-model="questionData.answer"
                                type="text"
                                id="identification"
                                placeholder="Enter Identification Answer"
                                class="sharedInput sharedInputHover w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors"
                            />
                        </div>

                        <!-- EXPLANATION -->
                        <div
                            v-if="questionData.question_type != 'coding'"
                            class="w-full flex flex-col gap-2"
                        >
                            <label
                                for="explanation"
                                class="text-sm font-medium sharedTXTOnLight"
                            >
                                Explanation
                            </label>

                            <textarea
                                v-model="questionData.explanation"
                                id="explanation"
                                rows="3"
                                placeholder="Explain why this is the correct answer"
                                class="sharedInput sharedInputHover w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors resize-none"
                            ></textarea>
                        </div>

                        <!-- EXPECTED OUTPUT -->
                        <div
                            v-else-if="questionData.question_type === 'coding'"
                            class="w-full flex flex-col gap-2"
                        >
                            <label
                                for="expected_output"
                                class="text-sm font-medium sharedTXTOnLight"
                            >
                                Expected Output
                            </label>

                            <textarea
                                v-model="questionData.answer"
                                id="expected_output"
                                rows="3"
                                placeholder="Enter Expected Output"
                                class="sharedInput sharedStateLightPassed sharedStateBox sharedTXTLightSuccess w-full border rounded-lg p-2.5 outline-none text-sm font-mono placeholder:font-sans focus:ring-2 transition-colors resize-y min-h-[80px]"
                            ></textarea>
                        </div>

                        <!-- BUTTONS -->
                        <div class="w-full flex gap-3 mt-0.5">
                            <button
                                type="button"
                                @click="closeModal"
                                class="w-1/3 py-2.5 rounded-md text-sm font-medium border sharedBtnGhostLight transition-colors cursor-pointer"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="w-2/3 py-2.5 rounded-md text-sm font-medium sharedBtn transition-all cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                            >
                                <svg
                                    v-if="isSubmitting"
                                    class="animate-spin size-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    />

                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"
                                    />
                                </svg>

                                {{ isSubmitting ? 'Updating...' : 'Save Changes' }}
                            </button>
                        </div>

                    </div>
                </form>
            </Transition>
        </div>
    </Transition>

    <Toast
        :show="showToast"
        :message="message"
        @close="showToast = false"
    />
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import Toast from '../components/Toast.vue'

const props = defineProps({
    showEditQuestion: {
        type: Boolean,
        default: false
    },

    choicesData: {
        type: Object,
        default: () => ({
            choice_A: '',
            choice_B: '',
            choice_C: '',
            choice_D: ''
        })
    },

    questionData: {
        type: Object,
        default: () => ({})
    },
    subjectName: {type: String, default: 'Undefined'},
    moduleName: {type: String, default: 'Undefined'}
});

const emit = defineEmits([
    'close-edit',
    'question-updated'
]);

const question_answer = ref('');
const correct_choice = ref('');

const showToast = ref(false);
const message = ref('');
const isSubmitting = ref(false);

const emptyChoices = ref({
    A: false,
    B: false,
    C: false,
    D: false
});

const questionTypeLabel = computed(() => {
    switch (props.questionData.question_type) {
        case 'multipleChoice':
            return 'Multiple Choice';
        case 'TorF':
            return 'True or False';
        case 'identification':
            return 'Identification';
        case 'coding':
            return 'Coding';
        default:
            return 'Unknown';
    }
});


watch(
    () => [
        props.questionData,
        props.choicesData,
    ],
    ([newQuestion, newChoices]) => {
        if (!newQuestion || !newQuestion.id) {
            return;
        }

        question_answer.value = '';
        correct_choice.value = '';

        emptyChoices.value = {
            A: false,
            B: false,
            C: false,
            D: false
        };

        if (newQuestion.question_type === 'TorF') {
            question_answer.value = newQuestion.answer || '';
        }

        if (newQuestion.question_type === 'multipleChoice') {
            if (newChoices?.choice_A === newQuestion.answer) {
                correct_choice.value = 'A';
            } else if (newChoices?.choice_B === newQuestion.answer) {
                correct_choice.value = 'B';
            } else if (newChoices?.choice_C === newQuestion.answer) {
                correct_choice.value = 'C';
            } else if (newChoices?.choice_D === newQuestion.answer) {
                correct_choice.value = 'D';
            }
        }
    },
    {
        immediate: true,
        deep: true
    }
);

function closeModal() {
    emit('close-edit');
}

async function editQuestionForm(Sname, Mname) {
    if (isSubmitting.value) {
        return;
    }

    isSubmitting.value = true;

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')

    let answer = props.questionData.answer || '';

    if (props.questionData.question_type === 'TorF') {
        answer = question_answer.value;
    }

    if (props.questionData.question_type === 'multipleChoice') {
        if (correct_choice.value === 'A') {
            answer = props.choicesData?.choice_A || '';
        } else if (correct_choice.value === 'B') {
            answer = props.choicesData?.choice_B || '';
        } else if (correct_choice.value === 'C') {
            answer = props.choicesData?.choice_C || '';
        } else if (correct_choice.value === 'D') {
            answer = props.choicesData?.choice_D || '';
        }
    }

    const payload = {
        question_id: props.questionData.id,
        question: props.questionData.question,
        question_type: props.questionData.question_type,
        answer: answer,
        explanation: props.questionData.explanation || null,
        choice_A: props.choicesData?.choice_A ?? null,
        choice_B: props.choicesData?.choice_B ?? null,
        choice_C: props.choicesData?.choice_C ?? null,
        choice_D: props.choicesData?.choice_D ?? null,
        correct_choice: correct_choice.value || null,

        subject_name: Sname,
        module_name: Mname
    };

    try {
        const response = await fetch('/editQuestion', {
            method: 'PUT',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },

            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (!response.ok) {
            console.error('Edit Question Error:', data);

            if (data.errors) {
                console.error('Validation Errors:', data.errors);
            }

            return;
        }

        if (data.success) {
            const updated = {
                id: props.questionData.id,
                question: props.questionData.question,
                answer: answer,
                explanation: props.questionData.explanation
            };

            if (props.questionData.question_type === 'multipleChoice') {
                updated.choices = {
                    choice_A: props.choicesData?.choice_A ?? '',
                    choice_B: props.choicesData?.choice_B ?? '',
                    choice_C: props.choicesData?.choice_C ?? '',
                    choice_D: props.choicesData?.choice_D ?? ''
                };
            }

            emit('question-updated', updated);

            showToast.value = true;
            message.value = data.message;

            emit('close-edit');
        }
    } catch (error) {
        console.error('Failed to update question:', error);
    } finally {
        isSubmitting.value = false;
    }
}
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.15s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}

.modal-scale-enter-active {
    transition: opacity 0.15s ease, transform 0.15s ease;
}

.modal-scale-enter-from {
    opacity: 0;
    transform: scale(0.96) translateY(4px);
}
</style>
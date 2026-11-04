<template>
    <Transition name="modal-fade">
        <div
            id="viewQuestion"
            v-if="viewQuestion"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            @click.self="closeView"
        >
            <Transition name="modal-scale" appear>
                <div
                    class="relative w-[30%] min-w-[380px] max-w-lg bg-white rounded-xl shadow-2xl shadow-black/30 flex flex-col max-h-[85vh]"
                >
                    <!-- Close Button -->
                    <button
                        type="button"
                        @click="closeView"
                        aria-label="Close"
                        class="absolute right-4 top-4 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
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

                    <!-- HEADER -->
                    <div
                        class="w-full flex flex-col gap-1 px-6 pt-6 pb-4 pr-12 border-b border-gray-100"
                    >
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2563EB" class="size-4.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>

                            <span class="text-xl font-semibold text-gray-900">
                                Question Details
                            </span>
                        </div>

                        <div class="w-full flex items-center flex-wrap gap-2 pt-2">
                            <!-- SUBJECT -->
                            <span
                                class="py-1 px-2.5 text-xs font-semibold shrink-0 text-blue-600 rounded-md border border-blue-200 bg-blue-50"
                            >
                                {{ questionData?.subject || 'N/A' }}
                            </span>

                            <!-- MODULE -->
                            <span
                                class="py-1 px-2.5 text-xs font-semibold shrink-0 text-yellow-600 rounded-md border border-yellow-200 bg-yellow-50"
                            >
                                {{ questionData?.module || 'N/A' }}
                            </span>

                            <!-- QUESTION TYPE -->
                            <span
                                class="py-1 px-2.5 text-xs font-semibold shrink-0 text-purple-600 rounded-md border border-purple-200 bg-purple-50"
                            >
                                {{ getQuestionTypeLabel(questionData?.question_type) }}
                            </span>
                        </div>
                    </div>

                    <!-- QUESTION DETAILS -->
                    <div
                        v-if="questionData"
                        id="whiteBG"
                        class="w-full flex flex-col px-6 pb-6 pt-4 gap-4 overflow-y-auto"
                    >
                        <!-- QUESTION -->
                        <div class="w-full flex flex-col gap-1.5">
                            <span class="text-sm font-medium text-gray-700">
                                Question
                            </span>

                            <span
                                class="text-sm text-gray-600 leading-relaxed bg-gray-50 border border-gray-100 rounded-lg px-3 py-2.5"
                            >
                                {{ questionData.question || 'N/A' }}
                            </span>
                        </div>

                        <!-- MULTIPLE CHOICE -->
                        <div
                            v-if="questionData.question_type === 'multipleChoice'"
                            class="w-full flex flex-col gap-1.5"
                        >
                            <span class="text-sm font-medium text-gray-700">
                                Choices
                            </span>

                            <div class="flex flex-col w-full gap-1.5 text-sm">
                                <div
                                    v-for="(choice, key) in questionData.choices"
                                    :key="key"
                                    class="flex items-center gap-2.5 border px-3 py-2 rounded-md transition-colors"
                                    :class="isCorrectChoice(choice)
                                        ? 'border-green-400 bg-green-50 text-green-600 font-semibold'
                                        : 'border-gray-200 text-gray-600 hover:bg-gray-50'"
                                >
                                    <span
                                        class="flex items-center justify-center size-5 rounded-full text-[10px] font-bold shrink-0"
                                        :class="isCorrectChoice(choice)
                                            ? 'bg-green-500 text-white'
                                            : 'bg-gray-100 text-gray-500'"
                                    >
                                        {{ letterFor(key) }}
                                    </span>

                                    <span class="flex-1">
                                        {{ choice || 'N/A' }}
                                    </span>

                                    <svg
                                        v-if="isCorrectChoice(choice)"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="size-4 text-green-500 shrink-0"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m4.5 12.75 6 6 9-13.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- TRUE OR FALSE -->
                        <div
                            v-else-if="questionData.question_type === 'TorF'"
                            class="w-full flex flex-col gap-1.5"
                        >
                            <span class="text-sm font-medium text-gray-700">
                                Answer
                            </span>

                            <span
                                class="text-sm font-semibold text-green-600 border border-green-400 bg-green-50 rounded-md px-3 py-2"
                            >
                                {{ questionData.answer || 'N/A' }}
                            </span>
                        </div>

                        <!-- IDENTIFICATION -->
                        <div
                            v-else-if="questionData.question_type === 'identification'"
                            class="w-full flex flex-col gap-1.5"
                        >
                            <span class="text-sm font-medium text-gray-700">
                                Answer
                            </span>

                            <span
                                class="text-sm font-semibold text-green-600 border border-green-400 bg-green-50 rounded-md px-3 py-2"
                            >
                                {{ questionData.answer || 'N/A' }}
                            </span>
                        </div>

                        <!-- EXPECTED OUTPUT -->
                        <div
                            v-else-if="questionData.question_type === 'coding'"
                            class="w-full flex flex-col gap-1.5"
                        >
                            <span class="text-sm font-medium text-gray-700">
                                Expected Output
                            </span>

                            <pre
                                class="text-sm font-mono text-green-700 leading-relaxed bg-green-50 border border-green-200 rounded-lg px-3 py-2.5 whitespace-pre-wrap break-words overflow-x-auto"
                            >{{ questionData.answer || 'N/A' }}</pre>
                        </div>

                        <!-- UNKNOWN QUESTION TYPE -->
                        <div
                            v-else
                            class="w-full flex flex-col gap-1.5"
                        >
                            <span class="text-sm font-medium text-gray-700">
                                Answer
                            </span>

                            <span
                                class="text-sm font-semibold text-green-600 border border-green-400 bg-green-50 rounded-md px-3 py-2"
                            >
                                {{ questionData.answer || 'N/A' }}
                            </span>
                        </div>

                        <!-- EXPLANATION -->
                        <div
                            v-if="questionData.question_type != 'coding'"
                            class="w-full flex flex-col gap-1.5"
                        >
                            <span class="text-sm font-medium text-gray-700">
                                Explanation
                            </span>

                            <span
                                class="text-sm text-gray-600 leading-relaxed bg-gray-50 border border-gray-100 rounded-lg px-3 py-2.5 whitespace-pre-line"
                            >
                                {{ questionData.explanation || 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    </Transition>
</template>

<script setup>
const props = defineProps({
    viewQuestion: {
        type: Boolean,
        default: false
    },

    questionData: {
        type: Object,
        default: () => ({})
    }
});

const emit = defineEmits(['closeView']);

function closeView() {
    emit('closeView');
}

function letterFor(key) {
    return key.replace('choice_', '').toUpperCase();
}

function getQuestionTypeLabel(type) {
    if (type === 'multipleChoice') {
        return 'Multiple Choice';
    }

    if (type === 'TorF') {
        return 'True or False';
    }

    if (type === 'identification') {
        return 'Identification';
    }

    if (type === 'coding') {
        return 'Coding';
    }

    return 'N/A';
}

function normalizeAnswer(value) {
    if (value === null || value === undefined) {
        return '';
    }

    return String(value).trim().toLowerCase();
}

function isCorrectChoice(choice) {
    const answer = normalizeAnswer(props.questionData?.answer);
    const currentChoice = normalizeAnswer(choice);

    if (!answer || !currentChoice) {
        return false;
    }

    return currentChoice === answer;
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
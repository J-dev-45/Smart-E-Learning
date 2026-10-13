<template>
    <main
        class="h-full main-bg md:w-[calc(100%-280px)] w-full flex flex-col md:ml-[280px] ml-0 overflow-x-hidden overflow-y-auto scrollbar-thin"
    >
        <!-- HEADER -->
        <header
            class="sticky top-0 shrink-0 z-10 w-full h-[60px] flex items-center justify-between text-white px-6 border-b border-[#CECBF6]/15 bg-[#CECBF6]/6 backdrop-blur-sm"
        >
            <a
                href="/subjects"
                class="cursor-pointer group text-gray-400 hover:text-white flex items-center gap-1.5 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 transition-transform group-hover:-translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>

                <span class="text-sm font-medium">Go Back</span>
            </a>

            <div class="text-xs text-gray-400">
                {{ filteredQuestions.length }}
                question{{ filteredQuestions.length === 1 ? '' : 's' }}
            </div>
        </header>

        <!-- TITLE & TOPIC -->
        <div class="text-white px-7 pt-6 pb-2 flex flex-col gap-3">
            <div class="w-full flex items-center justify-between gap-3 flex-wrap">
                <!-- SUBJECT NAME -->
                <span class="text-2xl font-bold tracking-tight">
                    {{ subjectName }}
                </span>

                <!-- ADD QUESTION BUTTON -->
                <button
                    type="button"
                    @click="openAddQuestionModal"
                    class="flex items-center justify-center gap-1.5 bg-white text-black rounded-md font-bold text-xs whitespace-nowrap cursor-pointer
                    h-8 w-8 sm:h-9 sm:w-auto sm:px-4
                    transition-all duration-200
                    hover:bg-[#CECBF6] hover:text-[#1A0B2E]
                    active:scale-95
                    focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#CECBF6]/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[#090014]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-3.5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    <span class="hidden sm:inline">Add Question</span>
                </button>
            </div>

            <!-- MODULE (left) & TOPIC (right) -->
            <div class="w-full flex items-center gap-3 flex-wrap text-sm">
                <div class="flex items-center gap-2">
                    <span class="font-semibold">Module</span>
                    <span class="px-2.5 py-0.5 rounded-full border border-white/20 text-xs">
                        {{ props.moduleName }}
                    </span>
                </div>

                <!-- SEPARATOR -->
                <div class="w-px h-4 bg-white/20 shrink-0"></div>

                <div class="flex items-center gap-2">
                    <span class="font-semibold">Topic</span>
                    <span class="px-2.5 py-0.5 rounded-full border border-white/20 text-xs">
                        {{ props.topicName }}
                    </span>
                </div>
            </div>

            <!-- SEARCH -->
            <div class="relative w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-gray-500 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search by question..."
                    class="w-full pl-11 pr-10 py-3 rounded-lg border border-white/10 bg-[#150022]/60 text-sm text-white placeholder:text-gray-500 focus:outline-none focus:border-[#CECBF6]/40 transition-colors"
                />

                <button
                    v-if="searchQuery"
                    type="button"
                    @click="searchQuery = ''"
                    title="Clear search"
                    class="absolute right-4 top-1/2 -translate-y-1/2 flex items-center justify-center text-gray-500 hover:text-white transition-colors cursor-pointer"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- QUESTIONS TABLE -->
        <div class="p-5 flex-1 min-h-0 flex flex-col">
            <div
                class="w-full border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 backdrop-blur-sm rounded-md overflow-hidden flex-1 min-h-0 flex flex-col"
            >
                <!-- Table Header -->
                <div
                    class="grid md:grid-cols-[80px_1fr_0.5fr_120px_150px] grid-cols-[60px_1fr_100px] px-4 py-2.5 border-b border-[#CECBF6]/15 text-xs font-semibold text-gray-400"
                >
                    <span>ID</span>
                    <span>Question</span>
                    <span class="md:flex hidden">Answer</span>
                    <span class="md:flex hidden">Question Type</span>
                    <span>Actions</span>
                </div>

                <!-- Table Rows -->
                <ul class="flex-1 min-h-0 overflow-y-auto scrollbar-thin">
                    <li
                        v-for="(question, index) in filteredQuestions"
                        :key="question.id"
                        class="grid md:grid-cols-[80px_1fr_0.5fr_120px_150px] grid-cols-[60px_1fr_100px] items-center px-4 py-3 border-b border-[#CECBF6]/10 hover:bg-[#CECBF6]/5 transition-colors"
                    >
                        <span class="text-xs text-gray-400 font-mono">
                            #{{ String(index + 1).padStart(3, '0') }}
                        </span>

                        <span
                            class="text-xs text-gray-300 truncate pr-2"
                            :title="question.question"
                        >
                            {{ question.question }}
                        </span>

                        <div
                            class="md:flex hidden items-center gap-3 min-w-0 pr-2"
                        >
                            <span class="text-sm truncate text-emerald-500">
                                {{ question.answer }}
                            </span>
                        </div>

                        <span class="md:flex hidden">
                            <span
                                class="inline-flex px-2 py-1 rounded-md text-[11px] font-medium text-gray-400"
                            >
                                {{ questionTypeLabel(question.question_type) }}
                            </span>
                        </span>

                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <!-- VIEW -->
                            <button
                                type="button"
                                @click="openViewModal(question)"
                                title="View"
                                class="flex items-center gap-1.5 px-2 sm:px-2.5 py-1.5 rounded-md text-xs font-medium bg-[#8B5CF6]/10 border-[1.5px] border-[#8B5CF6]/25 text-[#CECBF6] hover:bg-[#8B5CF6]/20 hover:border-[#8B5CF6]/40 active:scale-95 transition-all cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 shrink-0" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span class="hidden md:inline">View</span>
                            </button>

                            <!-- EDIT -->
                            <button
                                type="button"
                                @click="editQuestionOpen(question.id)"
                                title="Edit"
                                class="flex items-center justify-center px-2 sm:px-2.5 py-1.5 rounded-md border-[1.5px] border-[#CECBF6]/15 text-gray-300 hover:bg-[#CECBF6]/10 hover:border-[#CECBF6]/30 hover:text-white active:scale-95 transition-all cursor-pointer shrink-0"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-3.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"
                                    />
                                </svg>
                            </button>

                            <!-- DELETE -->
                            <button
                                type="button"
                                @click="deleteQuestionOpen(question.id)"
                                title="Delete"
                                class="flex items-center justify-center px-2 sm:px-2.5 py-1.5 rounded-md text-xs font-medium bg-red-500/10 border-[1.5px] border-red-500/25 text-red-300 hover:bg-red-500 hover:border-red-500 hover:text-white active:scale-95 transition-all cursor-pointer shrink-0"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-3.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.682-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>
                            </button>
                        </div>
                    </li>

                    <li
                        v-if="filteredQuestions.length === 0"
                        class="px-4 py-8 text-center text-sm text-gray-500"
                    >
                        No Questions found.
                    </li>
                </ul>
            </div>
        </div>
    </main>

    <!-- VIEW QUESTION MODAL -->
    <View_Question
        :view-question="view_question"
        :question-data="selectedQuestion"
        @close-view="closeViewModal"
    />

    <!-- ADD QUESTION MODAL -->
    <Add_Question
        :show-add-question="showAddQuestion"
        :module-name="module_name"
        :module-id="props.moduleId"
        :topic-name="props.topicName"
        :topic-id="props.topicId"
        :modules="props.modules"
        :topics="props.topics"
        :subject-name="subjectName"
        :subject-id="subject_id"
        @close-add="closeAddQuestionModal"
        @questions-added="questionsAdded"
        
    />

    <!-- EDIT QUESTION MODAL -->
    <Edit_Question
        :show-edit-question="showEditQuestion"
        :question-data="question"
        :choices-data="q_choices"
        :module-name="module_name"
        :subject-name="subjectName"
        @close-edit="closeEditQuestionModal"
        @question-updated="updateQuestionInTable"
    />

    <!-- DELETE QUESTION MODAL -->
    <Delete_Question
        :show-delete-question="showDeleteQuestion"
        :subject-name="subjectName"
        :topic-name="module_name"
        :question-data="delete_question"
        @close-delete="closeDeleteQuestionModal"
        @question-deleted="questionsDeleted"
    />
</template>

<script setup>
import View_Question from '../../Modal/View_Question.vue';
import Edit_Question from '../../Modal/Edit_Question.vue';
import Delete_Question from '../../Modal/Delete_Question.vue';
import Add_Question from '../../Modal/Add_Question.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    moduleId: { type: [String, Number], default: '0' },
    topicId: { type: [String, Number], default: '0' },
    subjectName: { type: String, default: '' },
    moduleName: { type: String, default: 'All' },
    topicName: { type: String, default: 'All' },
    subjects: { type: Array, required: true },
    modules: { type: Array, required: true },
    topics: { type: Array, required: true },
    questions: { type: Array, required: true },
    choices: { type: Array, required: true }
});

const emit = defineEmits(['goBack']);

const view_question = ref(false);
const showAddQuestion = ref(false);
const showEditQuestion = ref(false);
const showDeleteQuestion = ref(false);

const selectedQuestion = ref(null);
const question = ref(null);
const delete_question = ref(null);

const localQuestions = ref([...props.questions]);

const searchQuery = ref('');

const QUESTION_TYPE_LABELS = {
    multipleChoice: 'Multiple Choice',
    TorF: 'True or False',
    identification: 'Identification',
    coding: 'Coding'
};

function questionTypeLabel(type) {
    return QUESTION_TYPE_LABELS[type] || '';
}

/*
|--------------------------------------------------------------------------
| ADD QUESTIONS
|--------------------------------------------------------------------------
*/
function questionsAdded(newQuestions) {
    if (!Array.isArray(newQuestions)) {
        return;
    }

    const existingIds = new Set(
        localQuestions.value.map(q => String(q.id))
    );

    const questionsToAdd = newQuestions.filter(q => {
        if (!q?.id) {
            return false;
        }

        if (existingIds.has(String(q.id))) {
            return false;
        }

        return belongsToCurrentFilter(q);
    });

    localQuestions.value.push(...questionsToAdd);
}

/*
|--------------------------------------------------------------------------
| CHECK IF QUESTION BELONGS TO CURRENT MODULE/TOPIC
|--------------------------------------------------------------------------
*/
function belongsToCurrentFilter(q) {
    const moduleMatches =
        String(props.moduleId) === '0' ||
        String(q.module_id) === String(props.moduleId);

    const topicMatches =
        String(props.topicId) === '0' ||
        String(q.topic_id) === String(props.topicId);

    return moduleMatches && topicMatches;
}

/*
|--------------------------------------------------------------------------
| DELETE QUESTION
|--------------------------------------------------------------------------
| IMPORTANT:
| Do NOT replace localQuestions with data.questions.
| The backend may return ALL questions.
| Remove only the question that was deleted.
|--------------------------------------------------------------------------
*/
function questionsDeleted(deletedQuestion) {
    if (!deletedQuestion) {
        return;
    }

    let deletedId = null;

    if (typeof deletedQuestion === 'string' || typeof deletedQuestion === 'number') {
        deletedId = String(deletedQuestion);
    } else if (deletedQuestion.id) {
        deletedId = String(deletedQuestion.id);
    } else if (delete_question.value?.id) {
        deletedId = String(delete_question.value.id);
    }

    if (!deletedId) {
        return;
    }

    localQuestions.value = localQuestions.value.filter(
        q => String(q.id) !== deletedId
    );

    delete_question.value = null;
}

/*
|--------------------------------------------------------------------------
| CHOICES
|--------------------------------------------------------------------------
*/
const q_choices = ref({
    choice_A: '',
    choice_B: '',
    choice_C: '',
    choice_D: ''
});

/*
|--------------------------------------------------------------------------
| MODULE NAME
|--------------------------------------------------------------------------
*/
const module_name = computed(() => {
    if (String(props.moduleId) === '0') {
        return 'All';
    }

    return props.modules.find(
        m => String(m.id) === String(props.moduleId)
    )?.module_name || 'N/A';
});

/*
|--------------------------------------------------------------------------
| SUBJECT ID
|--------------------------------------------------------------------------
*/
const subject_id = computed(() => {
    return props.subjects.find(
        s => s.subject_name === props.subjectName
    )?.id || 0;
});

/*
|--------------------------------------------------------------------------
| FILTER QUESTIONS
|--------------------------------------------------------------------------
| Filters using BOTH module_id and topic_id, plus the search query
| against the question text.
|--------------------------------------------------------------------------
*/
const filteredQuestions = computed(() => {
    const query = searchQuery.value.trim().toLowerCase();

    return localQuestions.value.filter(q => {
        const moduleMatches =
            String(props.moduleId) === '0' ||
            String(q.module_id) === String(props.moduleId);

        const topicMatches =
            String(props.topicId) === '0' ||
            String(q.topic_id) === String(props.topicId);

        const searchMatches =
            !query || (q.question || '').toLowerCase().includes(query);

        return moduleMatches && topicMatches && searchMatches;
    });
});

/*
|--------------------------------------------------------------------------
| VIEW
|--------------------------------------------------------------------------
*/
function openViewModal(question) {
    const choice = props.choices.find(
        ch => String(ch.question_id) === String(question.id)
    );

    selectedQuestion.value = {
        ...question,
        choices: {
            choice_A: choice?.choice_A,
            choice_B: choice?.choice_B,
            choice_C: choice?.choice_C,
            choice_D: choice?.choice_D
        },
        subject: props.subjectName,
        module: module_name.value
    };

    view_question.value = true;
}

function closeViewModal() {
    view_question.value = false;
    selectedQuestion.value = null;
}

/*
|--------------------------------------------------------------------------
| ADD
|--------------------------------------------------------------------------
*/
function openAddQuestionModal() {
    showAddQuestion.value = true;
}

function closeAddQuestionModal() {
    showAddQuestion.value = false;
    selectedQuestion.value = null;
}

/*
|--------------------------------------------------------------------------
| EDIT
|--------------------------------------------------------------------------
*/
function editQuestionOpen(id) {
    question.value = localQuestions.value.find(
        q => String(q.id) === String(id)
    );

    if (!question.value) {
        return;
    }

    if (question.value.question_type === 'multipleChoice') {
        q_choices.value = props.choices.find(
            c => String(c.question_id) === String(id)
        ) || {
            choice_A: '',
            choice_B: '',
            choice_C: '',
            choice_D: ''
        };
    } else {
        q_choices.value = {
            choice_A: '',
            choice_B: '',
            choice_C: '',
            choice_D: ''
        };
    }

    showEditQuestion.value = true;
}

function updateQuestionInTable(updatedQuestion) {
    if (!updatedQuestion?.id) {
        return;
    }

    const index = localQuestions.value.findIndex(
        q => String(q.id) === String(updatedQuestion.id)
    );

    if (index === -1) {
        return;
    }

    localQuestions.value[index] = {
        ...localQuestions.value[index],
        ...updatedQuestion
    };
}

function closeEditQuestionModal() {
    showEditQuestion.value = false;

    question.value = null;

    q_choices.value = {
        choice_A: '',
        choice_B: '',
        choice_C: '',
        choice_D: ''
    };
}

/*
|--------------------------------------------------------------------------
| DELETE
|--------------------------------------------------------------------------
*/
function deleteQuestionOpen(id) {
    const foundQuestion = localQuestions.value.find(
        q => String(q.id) === String(id)
    );

    if (!foundQuestion) {
        return;
    }

    delete_question.value = foundQuestion;
    showDeleteQuestion.value = true;
}

function closeDeleteQuestionModal() {
    showDeleteQuestion.value = false;
    delete_question.value = null;
}
</script>
<template>
    <main
        class="h-full md:w-[calc(100%-280px)] w-full flex flex-col md:ml-[280px] ml-0 overflow-x-hidden overflow-y-auto scrollbar-thin"
    >
        <!-- HEADER -->
        <header
            class="sticky top-0 shrink-0 z-10 w-full h-[60px] flex items-center justify-between gap-3 px-3 sm:px-5 sharedSurfaceBG border-b-[1.5px] sharedBorder shadow-md sharedShadow sharedTXT"
        >
            <a
                :href="`/subject/${url(props.subjectName)}/${props.subjectId}`"
                class="cursor-pointer group flex items-center gap-1.5 sharedTXTMuted sharedHoverTXT transition-colors duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 transition-transform group-hover:-translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>

                <span class="text-sm font-medium">Back To Modules</span>
            </a>

            <div class="text-xs font-medium sharedTXTMuted tabular-nums">
                {{ filteredQuestions.length }}
                question{{ filteredQuestions.length === 1 ? '' : 's' }}
            </div>
        </header>

        <!-- TITLE & TOPIC -->
        <div class="sharedTXT px-7 pt-6 pb-2 flex flex-col gap-3">
            <div class="w-full flex items-center justify-between gap-3 flex-wrap">
                <!-- SUBJECT NAME -->
                <span class="text-2xl font-bold tracking-tight sharedTXT">
                    {{ subjectName }}
                </span>

                <!-- ADD QUESTION BUTTON -->
                <button
                    type="button"
                    @click="openAddQuestionModal"
                    class="flex items-center justify-center gap-1.5 sharedBtn rounded-xl font-bold text-xs whitespace-nowrap cursor-pointer h-8 w-8 sm:h-9 sm:w-auto sm:px-4 transition-all duration-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-3.5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    <span class="hidden sm:inline">Add Question</span>
                </button>
            </div>

            <!-- MODULE -->
            <div class="w-full flex items-center gap-3 flex-wrap text-sm">
                <div class="flex items-center gap-2">
                    <span class="font-medium sharedTXTMuted">Module</span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium sharedStateOpen sharedStateChip ring-1">
                        {{ props.moduleName }}
                    </span>
                </div>

            </div>

            <!-- SEARCH -->
            <div class="relative w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 size-5 sharedTXTMuted pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search by question..."
                    class="w-full pl-11 pr-10 py-3 rounded-xl border sharedInputDark text-sm outline-none focus:ring-1 transition-all duration-200"
                />

                <button
                    v-if="searchQuery"
                    type="button"
                    @click="searchQuery = ''"
                    title="Clear search"
                    class="absolute right-4 top-1/2 -translate-y-1/2 flex items-center justify-center sharedTXTMuted sharedHoverTXT transition-colors duration-200 cursor-pointer"
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
                class="w-full rounded-2xl sharedSurface shadow-lg sharedShadow overflow-hidden flex-1 min-h-0 flex flex-col"
            >
                <!-- Table Header -->
                <div
                    class="grid md:grid-cols-[80px_1fr_0.5fr_120px_150px] grid-cols-[60px_1fr_100px] px-4 py-2.5 border-b sharedBorder text-xs font-medium sharedTXTMuted"
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
                        class="grid md:grid-cols-[80px_1fr_0.5fr_120px_150px] grid-cols-[60px_1fr_100px] items-center px-4 py-3 border-b last:border-b-0 sharedBorder sharedRowHover transition-colors duration-200"
                    >
                        <span class="text-xs sharedTXTMuted font-mono tabular-nums">
                            #{{ String(index + 1).padStart(3, '0') }}
                        </span>

                        <span
                            class="text-xs sharedTXTBody truncate pr-2"
                            :title="question.question"
                        >
                            {{ question.question }}
                        </span>

                        <div
                            class="md:flex hidden items-center gap-3 min-w-0 pr-2"
                        >
                            <span class="text-sm truncate sharedTXTSuccess">
                                {{ question.answer }}
                            </span>
                        </div>

                        <span class="md:flex hidden">
                            <span
                                class="inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-medium sharedStateExam sharedStateChip ring-1"
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
                                class="flex items-center gap-1.5 px-2 sm:px-2.5 py-1.5 rounded-xl text-xs font-medium sharedStateOpen sharedStateChip sharedStateChipLink ring-1 active:scale-95 transition-all duration-200 cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 shrink-0" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span class="hidden md:inline">View</span>
                            </button>

                            <!-- EDIT (neutral, amber on hover) -->
                            <button
                                type="button"
                                @click="editQuestionOpen(question.id)"
                                title="Edit"
                                class="flex items-center justify-center px-2 sm:px-2.5 py-1.5 rounded-xl sharedTXTMuted sharedTile ring-1 sharedRingSoft sharedStateWarning sharedHoverState active:scale-95 transition-all duration-200 cursor-pointer shrink-0"
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

                            <!-- DELETE (danger) -->
                            <button
                                type="button"
                                @click="deleteQuestionOpen(question.id)"
                                title="Delete"
                                class="flex items-center justify-center px-2 sm:px-2.5 py-1.5 rounded-xl text-xs font-medium sharedStateDanger sharedStateChip sharedDangerSolidHover ring-1 active:scale-95 transition-all duration-200 cursor-pointer shrink-0"
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
                        class="px-4 py-8 text-center text-sm sharedTXTMuted"
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
        :modules="props.modules"
        :subject-name="subjectName"
        :subject-id="props.subjectId"
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
    subjectId: { type: [String, Number], default: '0' },
    subjectName: { type: String, default: '' },
    moduleName: { type: String, default: 'All' },
    modules: { type: Array, required: true },
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

    return moduleMatches;
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

        const searchMatches =
            !query || (q.question || '').toLowerCase().includes(query);

        return moduleMatches && searchMatches;
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





function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}
</script>
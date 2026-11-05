<template>
    <div class="w-full h-full flex flex-col gap-4 min-h-0">
        <div class="w-full flex flex-col sm:flex-row sm:items-center gap-3">
            <div
                class="flex items-center gap-1 p-1 rounded-xl border sharedBorder sharedSurfaceBG w-fit max-w-full overflow-x-auto"
            >
                <button
                    v-for="tab in statusTabs"
                    :key="tab"
                    @click="activeTab = tab"
                    class="px-3 py-1.5 rounded-lg text-xs font-medium whitespace-nowrap transition-all duration-200 cursor-pointer"
                    :class="activeTab === tab
                        ? 'sharedBtn'
                        : 'sharedTXTMuted sharedRowHover sharedHoverTXT'"
                >
                    {{ tab }}
                </button>
            </div>

            <div class="relative w-full sm:w-[320px] shrink-0">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4 absolute left-3.5 top-1/2 -translate-y-1/2 z-10 sharedTXTMuted pointer-events-none"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                    />
                </svg>

                <input
                    v-model="search"
                    type="search"
                    placeholder="Search by Name or Date..."
                    class="w-full h-10 sm:h-[36px] pl-10 pr-3 rounded-xl text-base sm:text-sm appearance-none [color-scheme:dark] sharedInputDark border outline-none focus:ring-1 transition-all duration-200"
                />
            </div>
        </div>

        <div
            class="w-full flex-1 min-h-0 flex flex-col rounded-2xl border sharedBorder sharedSurfaceBG shadow-lg sharedShadow overflow-hidden"
        >
            <div
                class="hidden lg:grid shrink-0 grid-cols-[90px_1fr_1fr_110px_100px_170px] px-4 py-3 border-b sharedBorder text-xs font-medium sharedTXTMuted"
            >
                <span>ID</span>
                <span>Name</span>
                <span>Replied By</span>
                <span>Status</span>
                <span>Date</span>
                <span>Actions</span>
            </div>

            <ul
                class="flex-1 min-h-0 max-h-[60dvh] lg:max-h-none overflow-y-auto lg:overflow-y-scroll scrollbar-thin max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden"
            >
                <li
                    v-for="feedback in filteredFeedbacks"
                    :key="feedback.id"
                    class="flex flex-col gap-3 px-4 py-3.5 lg:grid lg:grid-cols-[90px_1fr_1fr_110px_100px_170px] lg:items-center lg:gap-0 border-b sharedBorder last:border-b-0 sharedRowHover transition-colors duration-200"
                >
                    <span
                        class="hidden lg:block text-xs sharedTXTMuted font-mono tabular-nums"
                    >
                        #{{ String(feedback.id).padStart(3, '0') }}
                    </span>

                    <div class="flex items-center gap-3 min-w-0 lg:pr-2">
                        <!-- User photo -->
                        <img
                            v-if="getProfileImage(feedback.user_id)"
                            :src="getProfileImage(feedback.user_id)"
                            :alt="feedback.student_name"
                            class=" w-8 h-8 rounded-full object-cover shrink-0"
                        />

                        <!-- INITIAL -->
                        <div v-else :class="[
                            'shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold',
                            profileColor(feedback.user_id)
                        ]">
                            {{ initials(feedback.student_name) }}
                        </div>

                        <div class="flex flex-col min-w-0 flex-1">
                            <span class="text-sm font-medium sharedTXT truncate">
                                {{ feedback.student_name }}
                            </span>

                            <span
                                class="lg:hidden text-[11px] sharedTXTMuted font-mono truncate tabular-nums"
                            >
                                #{{ String(feedback.id).padStart(3, '0') }}
                                · {{ formatDate(feedback.created_at) }}
                            </span>

                            <span
                                class="lg:hidden empty:hidden before:content-['Replied_by:_'] text-[11px] sharedTXTMuted truncate"
                            >
                                {{ feedback.replied_by }}
                            </span>
                        </div>

                        <span
                            class="lg:hidden shrink-0 inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-medium"
                            :class="statusStyle(feedback.status)"
                        >
                            {{ feedback.status }}
                        </span>
                    </div>

                    <span class="hidden lg:block text-xs sharedTXTMuted truncate pr-2">
                        {{ feedback.replied_by }}
                    </span>

                    <span class="hidden lg:block">
                        <span
                            class="inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-medium"
                            :class="statusStyle(feedback.status)"
                        >
                            {{ feedback.status }}
                        </span>
                    </span>

                    <span class="hidden lg:block text-xs sharedTXTMuted tabular-nums">
                        {{ formatDate(feedback.created_at) }}
                    </span>

                    <div class="flex items-center gap-2">
                        <button
                            v-if="feedback.status === 'Done'"
                            type="button"
                            @click="openViewReplied(feedback)"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium sharedStateOpen sharedStateChip sharedStateChipLink ring-1 active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="size-3.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>
                            View
                        </button>

                        <button
                            v-else
                            type="button"
                            @click="openReplyToFeedback(feedback)"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-bold sharedBtn active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="size-3.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>
                            Reply
                        </button>

                        <button
                            type="button"
                            @click="openDeleteFeedback(feedback)"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium sharedStateDanger sharedStateChip sharedDangerSolidHover ring-1 active:scale-95 transition-all duration-200 cursor-pointer"
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
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                            Delete
                        </button>
                    </div>
                </li>

                <li
                    v-if="filteredFeedbacks.length === 0"
                    class="px-4 py-8 text-center text-sm sharedTXTMuted"
                >
                    No feedbacks found.
                </li>
            </ul>
        </div>
    </div>

    <Reply_To_Feedback
        :show-reply="show_reply"
        :feedback-id="feedback_id"
        :sender-name="sender_name"
        :feedback-message="feedback_message"
        :question-id="question_id"
        :question-label="question_label"
        :student-id="student_id"
        @close="closeReplyToFeedback"
        @new_reply="handleNewReply"
    />

    <View_Replied_Feedback
        :show-reply="show_replied"
        :sender-name="replied_sender_name"
        :feedback-message="replied_feedback_message"
        :question-id="replied_question_id"
        :question-label="replied_question_label"
        :reply-message="replied_reply_message"
        :replied-by="replied_replied_by"
        :replied-at="replied_replied_at"
        @close="closeViewReplied"
    />

    <Delete_Feedback
        :show-delete="show_delete"
        :feedback-id="feedback_id"
        :sender-name="sender_name"
        :feedback-message="feedback_message"
        :date-sent="date_sent"
        @close="closeDeleteFeedback"
        @deleted="handleDeletedFeedback"
    />
</template>

<script setup>
import { ref, computed, watch } from 'vue'

import Reply_To_Feedback from '../components/Reply_To_Feedback.vue'
import View_Replied_Feedback from '../components/View_Replied_Feedback.vue'
import Delete_Feedback from '../Modal/Delete_Feedback.vue'

const props = defineProps({
    feedbacks: {
        type: Array,
        required: true
    },
    questions: {
        type: Array,
        required: true
    },
    userId: {
        type: Number,
        required: true
    },
    users: {
        type: Array,
        default: () => []
    },
})

function profileColor(user_id){
    return props.users.find(uid => uid.id === user_id)?.profile_color;
}

const getProfileImage = (userId) => {
    const user = props.users.find(u => u.id === userId);

    return user?.profile_picture || user?.profile_avatar || '';
};

const search = ref('')
const statusTabs = ['All', 'New', 'Unread', 'Done']
const activeTab = ref('All')

function formatDate(date) {
    if (!date) return ''

    const d = new Date(date)

    if (Number.isNaN(d.getTime())) return ''

    const month = d.getMonth() + 1
    const day = d.getDate()
    const year = String(d.getFullYear()).slice(-2)

    return `${month}-${day}-${year}`
}

const feedbackList = ref(
    [...props.feedbacks].sort(
        (a, b) =>
            new Date(b.created_at).getTime() -
            new Date(a.created_at).getTime()
    )
)

watch(
    () => props.feedbacks,
    (newFeedbacks) => {
        feedbackList.value = [...newFeedbacks].sort(
            (a, b) =>
                new Date(b.created_at).getTime() -
                new Date(a.created_at).getTime()
        )
    },
    { deep: true }
)

const filteredFeedbacks = computed(() => {
    const q = search.value.trim().toLowerCase()

    return feedbackList.value.filter(feedback => {
        const matchesTab =
            activeTab.value === 'All' ||
            feedback.status === activeTab.value

        const formattedDate = formatDate(feedback.created_at).toLowerCase()

        const matchesSearch =
            !q ||
            (feedback.student_name || '').toLowerCase().includes(q) ||
            String(feedback.id).includes(q) ||
            formattedDate.includes(q)

        return matchesTab && matchesSearch
    })
})

function initials(name) {
    return (name || '')
        .split(' ')
        .filter(Boolean)
        .map(n => n[0])
        .slice(0, 2)
        .join('')
        .toUpperCase()
}

function statusStyle(status) {
    switch (status) {
        case 'Done':
            return 'sharedStatePassed sharedStateChip ring-1'
        case 'New':
            return 'sharedStateExam sharedStateChip ring-1'
        case 'Unread':
            return 'sharedStateDanger sharedStateChip ring-1'
        default:
            return 'sharedTile sharedTXTMuted ring-1 sharedRingSoft'
    }
}

const feedback_id = ref(0)
const sender_name = ref('')
const feedback_message = ref('')
const question_id = ref('')
const question_label = ref('')
const student_id = ref(0)

const show_reply = ref(false)

function openReplyToFeedback(feedback) {
    feedback_id.value = feedback.id
    sender_name.value = feedback.student_name
    feedback_message.value = feedback.feedback_message
    question_id.value = feedback.question_id ?? ''

    question_label.value =
        props.questions.find(q => q.id === feedback.question_id)?.question ?? ''

    student_id.value = feedback.user_id
    show_reply.value = true
}

function closeReplyToFeedback() {
    show_reply.value = false
}

const handleNewReply = (reply) => {
    const index = feedbackList.value.findIndex(
        feedback => feedback.id === reply.feedback_id
    );

    if (index !== -1) {
        feedbackList.value[index] = {
            ...feedbackList.value[index],
            replied_by: reply.replied_by,
            reply_message: reply.reply_message,
            status: reply.status,
            updated_at: reply.updated_at
        };
    }
};

const show_replied = ref(false)

const replied_sender_name = ref('')
const replied_feedback_message = ref('')
const replied_question_id = ref('')
const replied_question_label = ref('')
const replied_reply_message = ref('')
const replied_replied_by = ref('')
const replied_replied_at = ref('')

function openViewReplied(feedback) {
    replied_sender_name.value = feedback.student_name
    replied_feedback_message.value = feedback.feedback_message
    replied_question_id.value = feedback.question_id ?? ''

    replied_question_label.value =
        props.questions.find(q => q.id === feedback.question_id)?.question ?? ''

    replied_reply_message.value = feedback.reply_message ?? ''
    replied_replied_by.value = feedback.replied_by ?? 'Admin'
    replied_replied_at.value = feedback.updated_at ?? ''

    show_replied.value = true
}

function closeViewReplied() {
    show_replied.value = false
}

const show_delete = ref(false)
const date_sent = ref(null)

function openDeleteFeedback(feedback) {
    feedback_id.value = feedback.id
    sender_name.value = feedback.student_name
    feedback_message.value = feedback.feedback_message
    date_sent.value = feedback.created_at

    show_delete.value = true
}

function closeDeleteFeedback() {
    show_delete.value = false
}

function handleDeletedFeedback(deletedId) {
    feedbackList.value = feedbackList.value.filter(
        feedback => String(feedback.id) !== String(deletedId)
    )

    show_delete.value = false
    feedback_id.value = 0
    sender_name.value = ''
    feedback_message.value = ''
    date_sent.value = null
}
</script>
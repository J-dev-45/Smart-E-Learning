<template>
    <div class="w-full h-full flex flex-col gap-4 min-h-0">

        <div class="w-full flex flex-col sm:flex-row sm:items-center gap-3">

            <!-- STATUS TABS -->
            <div class="flex items-center gap-1 p-1 rounded-xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm w-fit max-w-full overflow-x-auto">
                <button
                    v-for="tab in statusTabs"
                    :key="tab"
                    @click="activeTab = tab"
                    class="px-3 py-1.5 rounded-lg text-xs font-medium whitespace-nowrap transition-all duration-200 cursor-pointer"
                    :class="activeTab === tab
                        ? 'bg-[#8B5CF6] text-white'
                        : 'text-white/45 hover:text-white hover:bg-white/[0.05]'"
                >
                    {{ tab }}
                </button>
            </div>

            <!-- SEARCH -->
            <div class="relative w-full sm:w-[320px] shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4 absolute left-3.5 top-1/2 -translate-y-1/2 z-10 text-white/50 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

                <input
                    v-model="search"
                    type="search"
                    placeholder="Search by Name or Date..."
                    class="w-full h-10 sm:h-[36px] pl-10 pr-3 rounded-xl text-base sm:text-sm text-white placeholder:text-white/40
                           appearance-none [color-scheme:dark]
                           bg-white/[0.03] border border-[#CECBF6]/15 outline-none
                           focus:border-[#8B5CF6]/50 focus:bg-white/[0.05] focus:ring-1 focus:ring-[#8B5CF6]/30 transition-all duration-200"
                >
            </div>

        </div>

        <div class="w-full flex-1 min-h-0 flex flex-col rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 overflow-hidden">

            <div class="hidden lg:grid shrink-0 grid-cols-[90px_1fr_1fr_110px_100px_170px] px-4 py-3 border-b border-[#CECBF6]/10
                        text-xs font-medium text-white/45">
                <span>ID</span>
                <span>Name</span>
                <span>Replied By</span>
                <span>Status</span>
                <span>Date</span>
                <span>Actions</span>
            </div>

            <ul class="flex-1 min-h-0 max-h-[60dvh] lg:max-h-none overflow-y-auto lg:overflow-y-scroll scrollbar-thin max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">

                <li
                    v-for="feedback in filteredFeedbacks"
                    :key="feedback.id"
                    class="flex flex-col gap-3 px-4 py-3.5
                           lg:grid lg:grid-cols-[90px_1fr_1fr_110px_100px_170px] lg:items-center lg:gap-0
                           border-b border-[#CECBF6]/10 last:border-b-0
                           hover:bg-white/[0.05] transition-colors duration-200"
                >

                    <span class="hidden lg:block text-xs text-white/45 font-mono tabular-nums">
                        #{{ String(feedback.id).padStart(3, '0') }}
                    </span>

                    <div class="flex items-center gap-3 min-w-0 lg:pr-2">

                        <!-- Initials tile (violet) -->
                        <div class="w-8 h-8 shrink-0 rounded-xl flex items-center justify-center text-[11px] font-semibold
                                    bg-[#8B5CF6]/15 ring-1 ring-[#8B5CF6]/20 text-[#B9A6F0]">
                            {{ initials(feedback.student_name) }}
                        </div>

                        <div class="flex flex-col min-w-0 flex-1">
                            <span class="text-sm font-medium text-white truncate">
                                {{ feedback.student_name }}
                            </span>

                            <span class="lg:hidden text-[11px] text-white/45 font-mono truncate tabular-nums">
                                #{{ String(feedback.id).padStart(3, '0') }} · {{ formatDate(feedback.created_at) }}
                            </span>

                            <span class="lg:hidden empty:hidden before:content-['Replied_by:_'] text-[11px] text-white/45 truncate">
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

                    <span class="hidden lg:block text-xs text-white/60 truncate pr-2">
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

                    <span class="hidden lg:block text-xs text-white/45 tabular-nums">
                        {{ formatDate(feedback.created_at) }}
                    </span>

                    <div class="flex items-center gap-2">

                        <!-- VIEW (tinted violet) -->
                        <button
                            v-if="feedback.status === 'Done'"
                            @click="openViewReplied(feedback)"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium
                                text-[#B9A6F0] bg-[#8B5CF6]/15 ring-1 ring-[#8B5CF6]/20
                                hover:bg-[#8B5CF6]/25
                                active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            View
                        </button>

                        <!-- REPLY (solid violet, the main action) -->
                        <button
                            v-else
                            @click="openReplyToFeedback(feedback)"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-bold
                                text-white bg-[#8B5CF6]
                                hover:bg-[#8B5CF6]/85
                                active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Reply
                        </button>

                        <!-- DELETE (red) -->
                        <button
                            @click="deleteFeedbackModalOpen()"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium
                                text-red-300 bg-red-500/15 ring-1 ring-red-500/20
                                hover:bg-red-500 hover:ring-red-500 hover:text-white
                                active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>

                    </div>

                </li>

                <li v-if="filteredFeedbacks.length === 0" class="px-4 py-8 text-center text-sm text-white/45">
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

</template>

<script setup>
import { ref, computed } from 'vue'
import Reply_To_Feedback from '../components/Reply_To_Feedback.vue';
import View_Replied_Feedback from '../components/View_Replied_Feedback.vue';

const props = defineProps({
    feedbacks: { type: Array, required: true },
    questions: { type: Array, required: true },
    userId: { type: Number, required: true}
})

const deleteFeedbackModal = document.getElementById('deleteFeedbackModal');
const deleteFeedbackModalClose = document.querySelectorAll('.deleteFeedbackModalClose');

function deleteFeedbackModalOpen() {
    localStorage.setItem('deleteFeedbackModal', 'true');

    if (deleteFeedbackModal) {
        deleteFeedbackModal.style.display = 'flex';
    }
}

deleteFeedbackModalClose.forEach(closeModal => {
    closeModal.addEventListener('click', () => {
        if (deleteFeedbackModal) {
            deleteFeedbackModal.style.display = 'none';
        }

        localStorage.setItem('deleteFeedbackModal', 'false');
    });
});

if (localStorage.getItem('deleteFeedbackModal') === 'true' && deleteFeedbackModal) {
    deleteFeedbackModal.style.display = 'flex';
}

const search = ref('');

const statusTabs = ['All', 'New', 'Unread', 'Done'];
const activeTab = ref('All');

function formatDate(date) {
    const d = new Date(date);

    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    const year = String(d.getFullYear()).slice(-2);

    return `${month}-${day}-${year}`;
}

const feedbackList = ref(
    [...props.feedbacks].sort(
        (a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime()
    )
);

const filteredFeedbacks = computed(() => {
    const q = search.value.trim().toLowerCase();

    return feedbackList.value.filter(f => {
        const matchesTab = activeTab.value === 'All' || f.status === activeTab.value;

        const matchesSearch = !q ||
            (f.student_name || '').toLowerCase().includes(q) ||
            String(f.id).includes(q);

        return matchesTab && matchesSearch;
    });
});

function initials(name) {
    return (name || '').split(' ').map(n => n[0]).slice(0, 2).join('');
}

function statusStyle(status) {
    switch (status) {
        case 'Done':
            return 'bg-emerald-400/15 ring-1 ring-emerald-400/20 text-emerald-300';

        case 'New':
            return 'bg-[#6366F1]/15 ring-1 ring-[#6366F1]/20 text-[#A5A9F5]';

        case 'Unread':
            return 'bg-rose-400/15 ring-1 ring-rose-400/20 text-rose-300';

        default:
            return 'bg-white/[0.04] ring-1 ring-[#CECBF6]/15 text-white/60';
    }
}

const show_reply = ref(false);
const feedback_id = ref(0);
const sender_name = ref('');
const feedback_message = ref('');
const question_id = ref('');
const question_label = ref('');
const student_id = ref(0);

function openReplyToFeedback(feedback) {
    feedback_id.value = feedback.id;
    sender_name.value = feedback.student_name;
    feedback_message.value = feedback.feedback_message;
    question_id.value = feedback.question_id ?? '';
    question_label.value = props.questions.find(q => q.id === feedback.question_id)?.question ?? '';
    student_id.value = feedback.user_id;
    show_reply.value = true;
}

function closeReplyToFeedback() {
    show_reply.value = false;
}

function handleNewReply(reply) {
    const feedback = feedbackList.value.find(
        f => f.id === feedback_id.value
    );

    if (!feedback) return;

    feedback.status = 'Done';

    if (reply?.replied_by) {
        feedback.replied_by = reply.replied_by;
    } else if (reply?.user?.name) {
        feedback.replied_by = reply.user.name;
    }

    if (reply?.reply_message) {
        feedback.reply_message = reply.reply_message;
    }

    feedback.updated_at = reply?.updated_at ?? new Date().toISOString();
}

const show_replied = ref(false);
const replied_sender_name = ref('');
const replied_feedback_message = ref('');
const replied_question_id = ref('');
const replied_question_label = ref('');
const replied_reply_message = ref('');
const replied_replied_by = ref('');
const replied_replied_at = ref('');

function openViewReplied(feedback) {
    replied_sender_name.value = feedback.student_name;
    replied_feedback_message.value = feedback.feedback_message;
    replied_question_id.value = feedback.question_id ?? '';
    replied_question_label.value = props.questions.find(q => q.id === feedback.question_id)?.question ?? '';
    replied_reply_message.value = feedback.reply_message ?? '';
    replied_replied_by.value = feedback.replied_by ?? 'Admin';
    replied_replied_at.value = feedback.updated_at ?? '';
    show_replied.value = true;
}

function closeViewReplied() {
    show_replied.value = false;
}
</script>
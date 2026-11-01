<template>
    <Teleport to="body">
        <Transition name="modal-fade">
            <div
                v-if="showReply"
                id="feedback_replied"
                class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[999] flex items-center justify-center p-4"
            >
                <Transition name="modal-pop" appear>
                    <div
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="feedback_replied_title"
                        class="relative w-full sm:w-[30%] sm:min-w-[380px] max-w-[440px] max-h-[90vh] overflow-hidden bg-white rounded-2xl shadow-2xl shadow-black/30 ring-1 ring-black/5 flex flex-col"
                    >
                        <button
                            type="button"
                            @click="closeModal"
                            aria-label="Close"
                            class="absolute right-4 top-4 z-10 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer
                                outline-none focus-visible:ring-4 focus-visible:ring-[#8B5CF6]/20"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="w-full flex flex-col flex-1 min-h-0">

                            <!-- HEADER -->
                            <div class="shrink-0 w-full flex items-center gap-3 pl-6 pr-14 pt-6 pb-4 bg-white border-b border-gray-100">
                                <div class="shrink-0 w-10 h-10 rounded-lg bg-green-50 ring-1 ring-green-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-green-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </div>

                                <div class="flex flex-col gap-0.5 min-w-0">
                                    <span id="feedback_replied_title" class="text-lg font-semibold text-gray-900 leading-tight">
                                        Replied Feedback
                                    </span>

                                    <span class="text-sm text-gray-500 leading-snug">
                                        This feedback has been answered.
                                    </span>
                                </div>
                            </div>

                            <!-- BODY -->
                            <div class="reply-scroll flex-1 min-h-0 overflow-y-auto px-6 py-5 flex flex-col gap-5">

                                <div class="w-full flex items-center gap-2 min-w-0">
                                    <span class="shrink-0 text-sm font-medium text-gray-700">
                                        Sent by
                                    </span>

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-[#8B5CF6]/10 text-[#6D28D9] truncate max-w-[280px]">
                                        {{ senderName }}
                                    </span>
                                </div>

                                <div v-if="questionId" class="w-full flex flex-col gap-1.5">
                                    <span class="text-sm font-medium text-gray-700">
                                        Question
                                    </span>

                                    <div class="w-full px-3 py-2.5 text-sm leading-relaxed text-black/70 bg-gray-50 border border-gray-200 rounded-lg whitespace-pre-line break-words">
                                        {{ questionLabel || 'This question' }}
                                    </div>
                                </div>

                                <div class="w-full flex flex-col gap-1.5">
                                    <span class="text-sm font-medium text-gray-700">
                                        Feedback Message
                                    </span>

                                    <div class="w-full px-3 py-2.5 text-sm leading-relaxed text-black/70 bg-gray-50 border border-gray-200 border-l-4 border-l-gray-300 rounded-lg whitespace-pre-line break-words">
                                        {{ feedbackMessage }}
                                    </div>
                                </div>

                                <div class="w-full flex flex-col gap-1.5">
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="shrink-0 text-sm font-medium text-gray-700">
                                            Reply
                                        </span>

                                        <span class="inline-flex items-center gap-1.5 text-xs text-gray-400 min-w-0">
                                            <span class="shrink-0">Replied by</span>
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full font-medium bg-green-50 ring-1 ring-green-100 text-green-700 min-w-0 max-w-[200px]">
                                                <span class="shrink-0 font-semibold">Admin - </span>
                                                <span class="truncate">{{ repliedBy }}</span>
                                            </span>
                                        </span>
                                    </div>

                                    <div class="w-full px-3 py-2.5 text-sm leading-relaxed text-gray-800 bg-[#8B5CF6]/5 border border-[#8B5CF6]/20 border-l-4 border-l-[#8B5CF6] rounded-lg whitespace-pre-line break-words">
                                        {{ replyMessage }}
                                    </div>

                                    <span class="text-xs text-gray-400 tabular-nums empty:hidden">
                                        {{ formattedRepliedAt }}
                                    </span>
                                </div>

                            </div>

                            <!-- FOOTER -->
                            <div class="shrink-0 w-full flex px-6 py-4 bg-white border-t border-gray-100">
                                <button
                                    type="button"
                                    @click="closeModal"
                                    class="w-full py-2.5 rounded-lg text-sm font-medium text-white bg-[#8B5CF6]
                                        shadow-sm shadow-[#8B5CF6]/30
                                        hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer
                                        outline-none focus-visible:ring-4 focus-visible:ring-[#8B5CF6]/30"
                                >
                                    Close
                                </button>
                            </div>

                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { computed, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    showReply: { type: Boolean, default: false },
    senderName: { type: String, required: true },
    feedbackMessage: { type: String, required: true },
    questionId: { type: [String, Number], default: null },
    questionLabel: { type: String, default: '' },
    replyMessage: { type: String, default: '' },
    repliedBy: { type: String, default: 'Admin' },
    repliedAt: { type: String, default: '' }
})

const emit = defineEmits(['close'])

const formattedRepliedAt = computed(() => {
    if (!props.repliedAt) return ''

    const date = new Date(props.repliedAt)

    if (isNaN(date.getTime())) return ''

    return date.toLocaleString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: 'numeric',
        minute: '2-digit'
    })
})

function closeModal() {
    emit('close')
}

function onKeydown(e) {
    if (e.key === 'Escape' && props.showReply) {
        closeModal()
    }
}

onMounted(() => window.addEventListener('keydown', onKeydown))
onUnmounted(() => window.removeEventListener('keydown', onKeydown))
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

.modal-pop-enter-active {
    transition: opacity 0.15s ease, transform 0.15s ease;
}

.modal-pop-enter-from {
    opacity: 0;
    transform: scale(0.96) translateY(4px);
}

.reply-scroll {
    scrollbar-width: thin;
    scrollbar-color: #d1d5db transparent;
}

.reply-scroll::-webkit-scrollbar {
    width: 6px;
}

.reply-scroll::-webkit-scrollbar-thumb {
    background-color: #d1d5db;
    border-radius: 9999px;
}
</style>
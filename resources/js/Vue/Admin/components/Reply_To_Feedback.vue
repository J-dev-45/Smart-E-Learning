<template>
    <Teleport to="body">
        <Transition name="modal-fade">
            <div
                v-if="showReply"
                id="feedback_reply"
                class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[999] flex items-center justify-center p-4"
            >
                <Transition name="modal-pop" appear>
                    <div
                        class="relative w-[30%] min-w-[380px] max-w-[440px] max-h-[90vh] overflow-hidden bg-white rounded-2xl shadow-2xl shadow-black/30 ring-1 ring-black/5 flex flex-col"
                    >
                        <button
                            type="button"
                            @click="closeModal"
                            aria-label="Close"
                            class="absolute right-4 top-4 z-10 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div
                            v-if="submitted"
                            class="w-full flex flex-col items-center gap-5 p-6 pt-9"
                            role="status"
                        >
                            <div class="w-16 h-16 rounded-full bg-green-50 ring-8 ring-green-50/60 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>

                            <div class="flex flex-col items-center gap-1.5 text-center">
                                <span class="text-lg font-semibold text-gray-900 leading-tight">
                                    {{ emailSent ? 'Reply Sent' : 'Reply Saved' }}
                                </span>

                                <span class="text-sm text-gray-500 max-w-[300px]">
                                    <template v-if="emailSent">
                                        Your reply to {{ senderFirstName }} has been emailed successfully.
                                    </template>
                                    <template v-else>
                                        Your reply to {{ senderFirstName }} was saved, but the email could not be sent.
                                    </template>
                                </span>
                            </div>

                            <button
                                type="button"
                                @click="closeModal"
                                class="w-full py-2.5 rounded-lg text-sm font-medium text-white bg-[#8B5CF6]
                                    shadow-sm shadow-[#8B5CF6]/30
                                    hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer"
                            >
                                Done
                            </button>
                        </div>

                        <form
                            v-else
                            @submit.prevent="sendReply"
                            class="w-full flex flex-col flex-1 min-h-0"
                        >
                            <div class="shrink-0 w-full flex items-start gap-3 pl-6 pr-14 pt-6 pb-4 bg-white border-b border-gray-100">
                                <div class="shrink-0 w-10 h-10 rounded-lg bg-[#8B5CF6]/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                    </svg>
                                </div>

                                <div class="flex flex-col gap-0.5">
                                    <span class="text-lg font-semibold text-gray-900 leading-tight">
                                        Reply to Feedback
                                    </span>

                                    <span class="text-sm text-gray-500">
                                        Your reply will be emailed to the sender.
                                    </span>
                                </div>
                            </div>

                            <div class="reply-scroll flex-1 min-h-0 overflow-y-auto px-6 py-5 flex flex-col gap-5" id="whiteBG">
                                <div class="w-full flex items-center gap-2 min-w-0">
                                    <span class="text-sm font-medium text-gray-700">
                                        Sent by
                                    </span>

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#8B5CF6]/10 text-[#6D28D9] truncate max-w-[280px]">
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

                                    <div class="w-full px-3 py-2.5 text-sm leading-relaxed text-black/70 bg-gray-50 border border-gray-200 rounded-lg whitespace-pre-line break-words">
                                        {{ feedbackMessage }}
                                    </div>
                                </div>

                                <div class="w-full flex flex-col gap-1.5">
                                    <div class="flex items-center justify-between">
                                        <label
                                            for="reply_message"
                                            class="text-sm font-medium text-gray-700"
                                        >
                                            Your Reply
                                        </label>

                                        <span
                                            class="text-xs tabular-nums"
                                            :class="reply_message.length > MAX ? 'text-red-500' : 'text-gray-400'"
                                        >
                                            {{ reply_message.length }}/{{ MAX }}
                                        </span>
                                    </div>

                                    <textarea
                                        id="reply_message"
                                        ref="textareaRef"
                                        rows="5"
                                        placeholder="Write your reply here..."
                                        v-model="reply_message"
                                        :disabled="isSubmitting"
                                        class="w-full px-3 py-2.5 text-black/70 text-sm outline-none resize-none border bg-gray-50 rounded-lg
                                        placeholder:text-gray-400 transition-all duration-150
                                        focus:bg-white focus:ring-4
                                        disabled:opacity-60 disabled:cursor-not-allowed"
                                        :class="errorMsg
                                            ? 'border-red-300 focus:border-red-400 focus:ring-red-100'
                                            : 'border-gray-300 hover:border-gray-400 focus:border-[#8B5CF6] focus:ring-[#8B5CF6]/15'"
                                    ></textarea>

                                    <span
                                        v-if="errorMsg"
                                        role="alert"
                                        class="text-xs text-red-500"
                                    >
                                        {{ errorMsg }}
                                    </span>
                                </div>
                            </div>

                            <div class="shrink-0 w-full flex gap-3 px-6 py-4 bg-white border-t border-gray-100">
                                <button
                                    type="button"
                                    @click="closeModal"
                                    :disabled="isSubmitting"
                                    class="w-1/3 py-2.5 rounded-lg text-sm font-medium text-gray-600 border border-gray-300
                                    hover:bg-gray-100 hover:border-gray-400 active:bg-gray-200 transition-colors cursor-pointer
                                    disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    Cancel
                                </button>

                                <button
                                    type="submit"
                                    :disabled="!canSubmit || isSubmitting"
                                    class="w-2/3 py-2.5 rounded-lg text-sm font-medium text-white bg-[#8B5CF6]
                                        shadow-sm shadow-[#8B5CF6]/30
                                        hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer
                                        disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#8B5CF6]
                                        flex items-center justify-center gap-1.5"
                                >
                                    <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
                                    </svg>

                                    {{ isSubmitting ? 'Sending...' : 'Send Reply' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { ref, computed, watch, nextTick, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    showReply: { type: Boolean, default: false },
    feedbackId: { type: Number, required: true },
    userId: { type: Number, required: true },
    senderName: { type: String, required: true },
    feedbackMessage: { type: String, required: true },
    questionId: { type: [String, Number], default: null },
    questionLabel: { type: String, default: '' }
})

const emit = defineEmits([
    'close',
    'new_reply'
])

const MIN = 10
const MAX = 1000

const reply_message = ref('')
const errorMsg = ref('')

const submitted = ref(false)
const emailSent = ref(false)
const isSubmitting = ref(false)
const textareaRef = ref(null)

const senderFirstName = computed(() => props.senderName.trim().split(' ')[0])

const canSubmit = computed(() => {
    const len = reply_message.value.trim().length
    return len >= MIN && len <= MAX
})

watch(
    () => props.showReply,
    async (open) => {
        if (!open) {
            submitted.value = false
            emailSent.value = false
            errorMsg.value = ''
            reply_message.value = ''
            return
        }

        submitted.value = false
        emailSent.value = false
        errorMsg.value = ''
        reply_message.value = ''

        await nextTick()
        textareaRef.value?.focus()
    }
)

function onKeydown(e) {
    if (e.key === 'Escape' && props.showReply && !isSubmitting.value) {
        closeModal()
    }
}

onMounted(() => window.addEventListener('keydown', onKeydown))
onUnmounted(() => window.removeEventListener('keydown', onKeydown))

function closeModal() {
    if (isSubmitting.value) return

    emit('close')
}

async function sendReply() {
    errorMsg.value = ''

    if (!canSubmit.value || isSubmitting.value) {
        return
    }

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')

    if (!csrfToken) {
        errorMsg.value = 'Security token not found. Please refresh the page and try again.'
        return
    }

    isSubmitting.value = true

    try {
        const response = await fetch('/sendReply', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                feedback_id: props.feedbackId,
                reply_message: reply_message.value.trim(),
                user_id: props.userId,
                question_label: props.questionLabel
            })
        })

        const data = await response.json()

        if (response.status === 422) {
            errorMsg.value =
                data?.errors?.reply_message?.[0] ||
                data?.message ||
                'Please check your reply and try again.'

            return
        }

        if (!response.ok) {
            errorMsg.value = data?.message || 'Something went wrong. Please try again.'
            return
        }

        if (data.success) {
            reply_message.value = ''
            emailSent.value = data.email_sent === true
            submitted.value = true

            emit('new_reply', data.reply)
        } else {
            errorMsg.value = data.message || 'Something went wrong. Please try again.'
        }

    } catch (error) {
        console.error(error)
        errorMsg.value = 'Something went wrong. Please try again.'

    } finally {
        isSubmitting.value = false
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
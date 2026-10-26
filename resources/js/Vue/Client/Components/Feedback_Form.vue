<template>
    <Teleport to="body">
        <Transition name="modal-fade">
            <div
                v-if="showFeedback"
                id="feedback"
                class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[999] flex items-center justify-center p-4"
            >
                <Transition name="modal-pop" appear>
                    <div
                        class="relative w-[30%] min-w-[380px] max-w-[440px] bg-white rounded-2xl shadow-2xl shadow-black/30 ring-1 ring-black/5 flex flex-col p-6"
                    >
                        <!-- CLOSE BUTTON -->
                        <button
                            type="button"
                            @click="closeModal"
                            aria-label="Close"
                            class="absolute right-4 top-4 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <!-- SUCCESS STATE -->
                        <div
                            v-if="submitted"
                            class="w-full flex flex-col items-center gap-5 pt-3"
                            role="status"
                        >
                            <div class="w-16 h-16 rounded-full bg-green-50 ring-8 ring-green-50/60 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>

                            <div class="flex flex-col items-center gap-1.5 text-center">
                                <span class="text-lg font-semibold text-gray-900 leading-tight">
                                    Feedback Sent
                                </span>

                                <span class="text-sm text-gray-500 max-w-[300px]">
                                    Thank you, {{ firstName }}. Your feedback has been received and our team will review it.
                                </span>
                            </div>

                            <div class="w-full flex items-start gap-3 px-3.5 py-3 rounded-xl bg-[#8B5CF6]/8">
                                <div class="shrink-0 w-8 h-8 rounded-lg bg-[#8B5CF6]/15 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6D28D9" class="size-[18px]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>

                                <div class="flex flex-col gap-0.5">
                                    <span class="text-sm font-medium text-[#4C1D95]">
                                        Expect a reply in 1 to 3 days
                                    </span>

                                    <span class="text-[13px] leading-snug text-[#6D28D9]">
                                        We'll send our reply to
                                        <span v-if="userEmail" class="font-medium break-all">{{ userEmail }}</span>
                                        <span v-else>your email</span>,
                                        so keep an eye on your inbox.
                                    </span>
                                </div>
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

                        <!-- FORM STATE -->
                        <form
                            v-else
                            @submit.prevent="sendFeedback"
                            class="w-full flex flex-col gap-5"
                        >
                            <!-- HEADER -->
                            <div class="w-full flex items-start gap-3 pr-6">
                                <div class="shrink-0 w-10 h-10 rounded-lg bg-[#8B5CF6]/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                    </svg>
                                </div>

                                <div class="flex flex-col gap-0.5">
                                    <span class="text-lg font-semibold text-gray-900 leading-tight">
                                        Send Feedback
                                    </span>

                                    <span class="text-sm text-gray-500">
                                        Help us improve Smart E-Learning.
                                    </span>
                                </div>
                            </div>

                            <!-- STUDENT / QUESTION -->
                            <div class="w-full flex flex-wrap items-center gap-x-4 gap-y-2">
                                <div class="flex items-center gap-2 min-w-0">
                                    <span class="text-sm font-medium text-gray-700">
                                        From
                                    </span>

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#8B5CF6]/10 text-[#6D28D9] truncate max-w-[200px]">
                                        {{ userName }}
                                    </span>
                                </div>

                                <div v-if="questionId" class="flex items-center gap-2 min-w-0">
                                    <span class="text-sm font-medium text-gray-700">
                                        About
                                    </span>

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#8B5CF6]/10 text-[#6D28D9] truncate max-w-[200px]">
                                        {{ questionLabel || 'This question' }}
                                    </span>
                                </div>
                            </div>

                            <!-- MESSAGE -->
                            <div class="w-full flex flex-col gap-1.5">
                                <div class="flex items-center justify-between">
                                    <label
                                        for="feedback_message"
                                        class="text-sm font-medium text-gray-700"
                                    >
                                        Your Feedback
                                    </label>

                                    <span
                                        class="text-xs tabular-nums"
                                        :class="feedback_message.length > MAX ? 'text-red-500' : 'text-gray-400'"
                                    >
                                        {{ feedback_message.length }}/{{ MAX }}
                                    </span>
                                </div>

                                <textarea
                                    id="feedback_message"
                                    ref="textareaRef"
                                    rows="5"
                                    placeholder="Tell us what's working, what's confusing, or what could be better..."
                                    v-model="feedback_message"
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

                            <!-- BUTTONS -->
                            <div class="w-full flex gap-3 mt-1">
                                <button
                                    type="button"
                                    @click="closeModal"
                                    class="w-1/3 py-2.5 rounded-lg text-sm font-medium text-gray-600 border border-gray-300
                                    hover:bg-gray-100 hover:border-gray-400 active:bg-gray-200 transition-colors cursor-pointer"
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

                                    {{ isSubmitting ? 'Sending...' : 'Send Feedback' }}
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
    showFeedback: {
        type: Boolean,
        default: false
    },

    userId: {
        type: String,
        default: ''
    },

    userName: {
        type: String,
        required: true
    },

    userEmail: {
        type: String,
        default: ''
    },

    questionId: {
        type: String,
        default: null
    },

    questionLabel: {
        type: String,
        default: ''
    }
})

const emit = defineEmits([
    'close',
    'new_feedback'
])

const MIN = 10
const MAX = 1000

const feedback_message = ref('')
const errorMsg = ref('')

const submitted = ref(false)
const isSubmitting = ref(false)
const textareaRef = ref(null)

const firstName = computed(() => props.userName.trim().split(' ')[0])

const canSubmit = computed(() => {
    const len = feedback_message.value.trim().length
    return len >= MIN && len <= MAX
})

// Reset to a fresh form every time the modal opens
watch(
    () => props.showFeedback,
    async (open) => {
        if (!open) return
        submitted.value = false
        errorMsg.value = ''
        feedback_message.value = ''
        await nextTick()
        textareaRef.value?.focus()
    }
)

function onKeydown(e) {
    if (e.key === 'Escape' && props.showFeedback && !isSubmitting.value) {
        closeModal()
    }
}

onMounted(() => window.addEventListener('keydown', onKeydown))
onUnmounted(() => window.removeEventListener('keydown', onKeydown))

function closeModal() {
    if (isSubmitting.value) return
    emit('close')
}

async function sendFeedback() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content')

    errorMsg.value = ''

    if (!canSubmit.value) {
        return
    }

    if (isSubmitting.value) {
        return
    }

    isSubmitting.value = true

    try {
        const response = await fetch('/sendFeedback', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                feedback_message: feedback_message.value.trim(),
                question_id: props.questionId
            })
        })

        if (response.status === 422) {
            const errors = await response.json()
            errorMsg.value =
                errors?.errors?.feedback_message?.[0] ||
                errors?.message ||
                'Please check your feedback and try again.'
            return
        }

        const data = await response.json()

        if (data.success) {
            feedback_message.value = ''
            submitted.value = true
            emit('new_feedback', data.feedback)
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
</style>
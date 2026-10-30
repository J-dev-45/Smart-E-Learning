
<template>
    <Transition name="modal-fade">
        <div
            v-if="showDeleteSubject"
            class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[99] flex items-center justify-center p-4"
        >
            <Transition name="modal-scale" appear>
                <form
                    @submit.prevent="deleteSubjectForm"
                    class="relative w-[30%] min-w-[380px] max-w-lg bg-white rounded-xl shadow-2xl shadow-black/30 flex flex-col p-6 gap-5"
                >
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

                    <div class="w-full flex items-start gap-3 pr-6">
                        <div class="shrink-0 w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#E04A4A" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>

                        <div class="flex flex-col gap-0.5 pt-1">
                            <span class="text-lg font-semibold text-gray-900">
                                Delete Subject?
                            </span>

                            <span class="text-sm text-gray-500">
                                This action cannot be undone.
                            </span>
                        </div>
                    </div>

                    <div class="w-full flex flex-col gap-2 rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <div class="w-full flex items-center gap-2">
                            <span class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Subject Name
                            </span>

                            <span class="text-xs font-semibold text-gray-700">
                                {{ subjectName }}
                            </span>
                        </div>
                    </div>

                    <div class="w-full flex gap-3 mt-1">
                        <button
                            type="button"
                            @click="closeModal"
                            class="deleteQuestionCancel w-1/3 py-2.5 rounded-md text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-100 transition-colors cursor-pointer"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="w-2/3 py-2.5 rounded-md text-sm font-medium text-white bg-red-500 hover:bg-red-600 active:bg-red-700 transition-colors cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        >
                            <svg
                                v-if="isSubmitting"
                                class="animate-spin size-4"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z" />
                            </svg>

                            {{ isSubmitting ? 'Deleting...' : 'Yes, Delete' }}
                        </button>
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
import { ref } from 'vue'
import Toast from '../components/Toast.vue'

const props = defineProps({
    showDeleteSubject: {
        type: Boolean,
        default: false
    },
    subjectName: {
        type: String,
        default: 'Undefined'
    },
    subjectId: {
        type: [Number, String],
        default: null
    }
})

const emit = defineEmits([
    'close',
    'subject_deleted'
])

const showToast = ref(false)
const message = ref('')
const isSubmitting = ref(false)

async function deleteSubjectForm() {
    if (isSubmitting.value) return

    if (!props.subjectId) {
        message.value = 'Subject ID is missing.'
        showToast.value = true
        return
    }

    isSubmitting.value = true

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')

    try {
        const response = await fetch('/deleteSubject', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                subject_id: props.subjectId,
                subject_name: props.subjectName
            })
        })

        const data = await response.json()

        if (response.ok && data.success) {
            message.value = data.message || 'Subject deleted successfully.'
            showToast.value = true

            emit(
                'subject_deleted',
                data.deleted_subject_id ?? props.subjectId
            )

            emit('close')
        } else {
            message.value = data.message || 'Failed to delete subject.'
            showToast.value = true
        }
    } catch (err) {
        console.error(err)
        message.value = 'Something went wrong while deleting the subject.'
        showToast.value = true
    } finally {
        isSubmitting.value = false
    }
}

function closeModal() {
    emit('close')
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


<template>
    <Transition name="modal-fade">
        <div
            v-if="showEditSubject"
            id="editSubject"
            class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[99] flex items-center justify-center p-4"
        >
            <Transition name="modal-scale" appear>
                <form
                    @submit.prevent="editSubjectForm(subjectData.id)"
                    class="relative w-[30%] min-w-[380px] max-w-lg bg-white rounded-xl shadow-2xl shadow-black/30 flex flex-col p-6 gap-5 max-h-[90vh] overflow-y-auto"
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
                        <div class="shrink-0 w-10 h-10 rounded-full bg-violet-50 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                            </svg>
                        </div>

                        <div class="flex flex-col gap-0.5 pt-1">
                            <span class="text-lg font-semibold text-gray-900">
                                Update Subject
                            </span>
                            <span class="text-sm text-gray-500">
                                Update subject name and code.
                            </span>
                        </div>
                    </div>

                    <div class="w-full flex flex-col gap-2">
                        <label for="subject_name" class="text-sm font-medium text-gray-700">
                            Subject Name
                        </label>

                        <input
                            id="subject_name"
                            type="text"
                            v-model="subjectData.subject_name"
                            placeholder="Enter new subject name"
                            required
                            class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-transparent placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors"
                        />
                    </div>

                    <div class="w-full flex flex-col gap-2">
                        <label for="subject_code" class="text-sm font-medium text-gray-700">
                            Subject Code
                        </label>

                        <input
                            id="subject_code"
                            type="text"
                            v-model="subjectData.subject_code"
                            placeholder="Enter new subject code"
                            required
                            class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-transparent placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors"
                        />
                    </div>

                    <div class="w-full flex gap-3 mt-0.5">
                        <button
                            type="button"
                            @click="closeModal"
                            class="w-1/3 py-2.5 rounded-md text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-100 transition-colors cursor-pointer"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="w-2/3 py-2.5 rounded-md text-sm font-medium text-white bg-[#8B5CF6] hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
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

                            {{ isSubmitting ? 'Updating...' : 'Save Changes' }}
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
    showEditSubject: {
        type: Boolean,
        default: false
    },
    subjectData: {
        type: Object,
        default: () => ({})
    }
})

const emit = defineEmits([
    'close',
    'subject-updated'
])

const showToast = ref(false)
const message = ref('')
const isSubmitting = ref(false)

function closeModal() {
    emit('close')
}

async function editSubjectForm(id) {
    if (isSubmitting.value) return

    if (!id) {
        message.value = 'Subject ID is missing.'
        showToast.value = true
        return
    }

    const subjectName = props.subjectData.subject_name?.trim()
    const subjectCode = props.subjectData.subject_code?.trim()

    if (!subjectName || !subjectCode) {
        message.value = 'Please fill in all subject fields.'
        showToast.value = true
        return
    }

    isSubmitting.value = true

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')

    try {
        const response = await fetch('/editSubject', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                subject_id: id,
                new_subject_name: subjectName,
                new_subject_code: subjectCode
            })
        })

        const data = await response.json()

        if (response.ok && data.success) {
            message.value = data.message || 'Subject updated successfully.'
            showToast.value = true

            emit('subject-updated', {
                id: id,
                subject_name: subjectName,
                subject_code: subjectCode
            })

            emit('close')
        } else {
            message.value = data.message || 'Failed to update subject.'
            showToast.value = true
        }
    } catch (err) {
        console.error(err)
        message.value = 'Something went wrong while updating the subject.'
        showToast.value = true
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

.modal-scale-enter-active {
    transition: opacity 0.15s ease, transform 0.15s ease;
}

.modal-scale-enter-from {
    opacity: 0;
    transform: scale(0.96) translateY(4px);
}
</style>

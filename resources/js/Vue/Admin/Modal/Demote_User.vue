
<template>
    <Transition name="modal-fade">
        <div
            v-if="showDemoteUser"
            id="addQuestion"
            class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[99] flex items-center justify-center p-4"
        >
            <Transition name="modal-scale" appear>
                <form
                    @submit.prevent="demoteUser(userData.id)"
                    class="relative w-[30%] min-w-[380px] bg-white rounded-xl shadow-2xl shadow-black/30 flex flex-col p-6 gap-5"
                >
                    <button
                        type="button"
                        @click="closeDemote"
                        aria-label="Close"
                        class="absolute right-4 top-4 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="w-full flex flex-col gap-1 pr-6">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#EF4444" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                            </div>

                            <div class="flex flex-col gap-0.5">
                                <span class="text-lg font-semibold text-gray-900">
                                    Demote User?
                                </span>

                                <span class="text-sm text-gray-500">
                                    Are you sure you want to demote
                                    <span class="text-gray-700 font-semibold">{{ userData.name }}</span>
                                    to Student?
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex gap-3 mt-0.5">
                        <button
                            type="button"
                            @click="closeDemote"
                            class="w-1/3 py-2.5 rounded-md text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-100 transition-colors cursor-pointer"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="w-2/3 py-2.5 rounded-md text-sm font-medium text-white bg-red-500 hover:bg-red-600 active:bg-red-700 transition-colors cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        >
                            <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
                            </svg>

                            {{ isSubmitting ? 'Demoting...' : 'Yes, Demote' }}
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
import { ref } from 'vue';
import Toast from '../components/Toast.vue';

const props = defineProps({
    showDemoteUser: {
        type: Boolean,
        default: false
    },
    userData: {
        type: Object,
        default: () => ({})
    }
});

const emit = defineEmits(['close-demote', 'user-demoted']);

function closeDemote() {
    emit('close-demote');
}

const showToast = ref(false);
const message = ref('');
const isSubmitting = ref(false);

async function demoteUser(id) {
    if (isSubmitting.value) return;

    isSubmitting.value = true;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    try {
        const response = await fetch('/demoteUser', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                user_id: id,
                new_role: 'Student'
            })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showToast.value = true;
            message.value = data.message;

            emit('user-demoted', id);
            emit('close-demote');
        } else {
            message.value = data.message || 'Failed to demote user.';
            showToast.value = true;
        }
    } catch (error) {
        console.error('Error demoting user:', error);

        message.value = 'Something went wrong while demoting the user.';
        showToast.value = true;
    } finally {
        isSubmitting.value = false;
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

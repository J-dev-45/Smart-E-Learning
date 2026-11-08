<template>
    <Transition name="modal-fade">
        <div
            v-if="showEditModule"
            id="editQuestion"
            class="fixed inset-0 w-screen h-screen sharedOverlay backdrop-blur-sm z-[99] flex items-center justify-center p-4"
        >
            <Transition name="modal-scale" appear>
                <form
                    @submit.prevent="editModuleForm(moduleData.id)"
                    class="relative w-[30%] min-w-[380px] max-w-lg sharedLightBG rounded-xl shadow-2xl sharedShadow flex flex-col p-6 gap-5 max-h-[90vh] overflow-y-auto"
                >
                    <!-- CLOSE BUTTON -->
                    <button
                        type="button"
                        @click="closeModal"
                        aria-label="Close"
                        class="absolute right-4 top-4 p-1.5 rounded-md sharedTXTLightFaint sharedLightIconBtn transition-colors cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                    <!-- ICON + HEADER -->
                    <div class="w-full flex items-start gap-3 pr-6">
                        <div
                            class="shrink-0 w-10 h-10 rounded-full sharedStateLightAccent sharedStateTint flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 sharedStateText"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"
                                />
                            </svg>
                        </div>

                        <div class="flex flex-col gap-0.5 pt-1">
                            <span class="text-lg font-semibold sharedTXTOnLight">
                                Update Module
                            </span>

                            <span class="text-sm sharedTXTLightMuted">
                                Update module name and description.
                            </span>
                        </div>
                    </div>

                    <!-- QUESTION -->
                    <div class="w-full flex flex-col gap-2">
                        <label
                            for="question"
                            class="text-sm font-medium sharedTXTOnLight"
                        >
                            Module Name
                        </label>

                        <input
                            type="text"
                            v-model="moduleData.module_name"
                            id="question"
                            placeholder="Enter new module name"
                            class="sharedInput sharedInputHover w-full border rounded-md p-2 outline-none text-sm focus:ring-2 transition-colors"
                        />
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="w-full flex flex-col gap-2" id="whiteBG">
                        <div class="flex items-center justify-between">
                            <label
                                for="module_description"
                                class="text-sm font-medium sharedTXTOnLight"
                            >
                                Description
                            </label>

                            <span class="text-xs tabular-nums sharedTXTLightFaint">
                                {{ (moduleData.description || '').length }}/{{ descriptionLimit }}
                            </span>
                        </div>

                        <textarea
                            id="module_description"
                            rows="3"
                            :maxlength="descriptionLimit"
                            v-model="moduleData.description"
                            placeholder="Briefly describe what this module covers"
                            class="sharedInput sharedInputHover w-full border rounded-md p-2 outline-none text-sm resize-none focus:ring-2 transition-colors"
                        ></textarea>
                    </div>


                    <!-- BUTTONS -->
                    <div class="w-full flex gap-3 mt-0.5">
                        <button
                            type="button"
                            @click="closeModal"
                            class="w-1/3 py-2.5 rounded-md text-sm font-medium border sharedBtnGhostLight transition-colors cursor-pointer"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="w-2/3 py-2.5 rounded-md text-sm font-medium sharedBtn transition-all cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        >
                            <svg
                                v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
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
        :type="toastType"
        @close="showToast = false"
    />
</template>

<script setup>
import { ref } from 'vue';
import Toast from '../components/Toast.vue'

const props = defineProps({
    showEditModule: {
        type: Boolean,
        default: true
    },
    moduleData: { type: Object, default: ()=>({})},

});

const emit = defineEmits(['close']);

const descriptionLimit = 1000;

const showToast = ref(false);
const message = ref('');
const toastType = ref('')
const isSubmitting = ref(false);

function closeModal() {
    emit('close');
}

async function editModuleForm(id) {
    if (isSubmitting.value) {
        return;
    }

    isSubmitting.value = true;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch('/editModule', {
            method: 'PUT',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                module_id : id,
                new_module_name : props.moduleData.module_name,
                new_description : (props.moduleData.description || '').trim()
            })
        });

        const data = await response.json();

        if (data.success) {

            showToast.value = true;
            message.value = data.message;
            toastType.value = 'success'

            emit('close');
        }else{
            showToast.value = true;
            message.value = data.message;
            toastType.value = 'error'
        }
    }
    finally {
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
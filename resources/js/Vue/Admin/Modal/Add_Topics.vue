<template>

    <Transition name="modal-fade">
        <div
            v-if="showAddTopic"
            id="addTopic"
            class="fixed inset-0 w-screen h-screen sharedOverlay backdrop-blur-sm z-[99] flex items-center justify-center p-4"
        >

            <Transition name="modal-pop" appear>
                <form
                    @submit.prevent="addTopic"
                    class="relative w-[30%] min-w-[380px] max-w-[440px] sharedLightBG rounded-2xl shadow-2xl sharedShadow ring-1 sharedNavRing flex flex-col p-6 gap-5"
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


                    <!-- HEADER -->
                    <div class="w-full flex items-start gap-3 pr-6">

                        <div class="shrink-0 w-10 h-10 rounded-lg sharedStateLightAccent sharedStateTint flex items-center justify-center">

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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                        </div>

                        <div class="flex flex-col gap-0.5">

                            <span class="text-lg font-semibold sharedTXTOnLight leading-tight">
                                Add New Topic
                            </span>

                            <span class="text-sm sharedTXTLightMuted">
                                Create a new topic for this module.
                            </span>

                        </div>

                    </div>


                    <!-- MODULE -->
                    <div class="w-full flex items-center gap-2">

                        <span class="text-sm font-medium sharedTXTOnLight">
                            Module
                        </span>

                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium sharedStateLightAccent sharedStateTint sharedStateText">
                            {{ moduleName }}
                        </span>

                    </div>


                    <!-- TOPIC -->
                    <div class="w-full flex flex-col gap-1.5">

                        <label
                            for="topic"
                            class="text-sm font-medium sharedTXTOnLight"
                        >
                            Topic Name
                        </label>

                        <input
                            id="topic"
                            type="text"
                            placeholder="e.g. Set Operations"
                            v-model="topic_name"
                            autocomplete="off"
                            class="sharedInput sharedInputHover w-full px-3 py-2.5 text-sm outline-none border rounded-lg
                            transition-all duration-150 focus:ring-4"
                        >

                        <input
                            type="hidden"
                            v-model="module_id"
                        >

                    </div>


                    <!-- BUTTONS -->
                    <div class="w-full flex gap-3 mt-1">

                        <button
                            type="button"
                            @click="closeModal"
                            class="w-1/3 py-2.5 rounded-lg text-sm font-medium border sharedBtnGhostLight
                            transition-colors cursor-pointer"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            :disabled="!topic_name.trim() || isSubmitting"
                            class="w-2/3 py-2.5 rounded-lg text-sm font-medium sharedBtn
                                shadow-sm sharedShadow transition-all cursor-pointer
                                disabled:opacity-50 disabled:cursor-not-allowed
                                flex items-center justify-center gap-1.5"
                        >

                            <svg
                                v-if="isSubmitting"
                                class="animate-spin size-4"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"
                                ></path>
                            </svg>

                            {{ isSubmitting ? 'Adding...' : 'Add Topic' }}

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

import { ref, watch } from 'vue'
import Toast from '../components/Toast.vue'

const props = defineProps({

    showAddTopic: {
        type: Boolean,
        default: false
    },

    moduleId: {
        type: [Number, String],
        default: null
    },

    moduleName: {
        type: String,
        default: ''
    }

})

const emit = defineEmits([
    'close',
    'new_topics'
])


const topic_name = ref('')
const module_id = ref(null)

const showToast = ref(false)
const message = ref('')
const isSubmitting = ref(false)


watch(
    () => props.moduleId,
    (newValue) => {
        module_id.value = newValue
    },
    { immediate: true }
)

function closeModal() {
    topic_name.value = ''
    emit('close')
}

async function addTopic() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content')

    if (!topic_name.value.trim()) {
        return
    }

    if (isSubmitting.value) {
        return
    }
    isSubmitting.value = true

    try {
        const response = await fetch('/addTopic', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({

                module_id: module_id.value,
                topic_name: topic_name.value

            })
        })

        const data = await response.json()

        if (data.success) {
            topic_name.value = ''
            showToast.value = true
            message.value = data.message
            emit('close')
            emit('new_topics', data.new_topics)
        }
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
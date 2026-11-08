<template>
    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 translate-x-4"
        enter-to-class="opacity-100 translate-x-0"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100 translate-x-0"
        leave-to-class="opacity-0 translate-x-4"
    >
        <div
            v-if="show"
            role="status"
            :aria-live="isError ? 'assertive' : 'polite'"
            class="fixed top-5 right-5 z-[1000] w-[320px] rounded-xl overflow-hidden
                bg-white border border-black/5 shadow-lg shadow-black/20"
        >
            <div class="flex items-start gap-3 px-4 py-3.5">
                <div
                    class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center mt-0.5"
                    :class="isError ? 'bg-red-100' : 'bg-green-100'"
                >
                    <!-- Failed icon -->
                    <svg
                        v-if="isError"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2.5"
                        stroke="#DC2626"
                        class="size-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>

                    <!-- Success icon -->
                    <svg
                        v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#16A34A" class="size-4" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-900">
                        {{ title || (isError ? 'Failed' : 'Success') }}
                    </p>

                    <p class="text-xs text-gray-500 mt-0.5 break-words">
                        {{ message }}
                    </p>
                </div>

                <button
                    type="button"
                    @click="close"
                    aria-label="Close"
                    class="shrink-0 text-gray-400 hover:text-gray-700 transition-colors mt-0.5"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div
                class="h-[3px] w-full"
                :class="isError ? 'bg-red-100' : 'bg-green-100'"
            >
                <div
                    class="h-full"
                    :class="[
                        isError ? 'bg-red-500' : 'bg-green-500',
                        { 'transition-none': !cooldownActive }
                    ]"
                    :style="{
                        width: cooldownActive ? '0%' : '100%',
                        transitionProperty: cooldownActive ? 'width' : 'none',
                        transitionDuration: cooldownActive ? '3000ms' : '0ms',
                        transitionTimingFunction: 'linear'
                    }"
                />
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { watch, ref, computed, nextTick, onBeforeUnmount } from 'vue'

const props = defineProps({
    show: Boolean,
    message: String,

    type: {
        type: String,
        default: 'success'
    },

    title: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['close'])

const cooldownActive = ref(false)

const isError = computed(() => props.type === 'error')

let closeTimer = null

function clearCloseTimer() {
    if (closeTimer) {
        clearTimeout(closeTimer)
        closeTimer = null
    }
}

function close() {
    clearCloseTimer()
    emit('close')
}

watch(
    () => props.show,
    async (value) => {
        clearCloseTimer()

        if (value) {
            cooldownActive.value = false
            await nextTick()
            requestAnimationFrame(() => {
                cooldownActive.value = true
            })

            closeTimer = setTimeout(() => {
                emit('close')
            }, 3000)
        } else {
            cooldownActive.value = false
        }
    }
)

onBeforeUnmount(clearCloseTimer)
</script>
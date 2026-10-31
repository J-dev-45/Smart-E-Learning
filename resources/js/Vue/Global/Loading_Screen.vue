<template>
    <div class="w-screen h-screen fixed inset-0 z-200 flex items-center justify-center overflow-hidden bg-[#3b0764]"
         >

        <div class="flex flex-col items-center gap-6">

            <!-- Ring mark -->
            <div class="relative" style="width: clamp(96px, 16dvh, 130px); height: clamp(96px, 16dvh, 130px);">
                <svg viewBox="0 0 130 130" class="w-full h-full -rotate-90">
                    <circle cx="65" cy="65" r="56" fill="none" stroke="#CECBF6" stroke-opacity="0.15" stroke-width="3" />
                    <circle cx="65" cy="65" r="56" fill="none" stroke="#CECBF6" stroke-width="3"
                            stroke-linecap="round" class="ring-sweep" />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <img :src="appData.logo" alt="Logo"
                         class="object-contain drop-shadow-lg"
                         style="width:clamp(80px,10dvh,100px); height:clamp(80px,10dvh,100px)">
                </div>
            </div>

            <!-- Wordmark + status message -->
            <div class="flex flex-col items-center gap-2">
                <p class="text-[22px] font-bold tracking-tight text-[#F5F3FF] text-center m-0">
                    Smart <span class="text-[#CECBF6]">E-Learning</span>
                </p>

                <div class="h-5 flex items-center justify-center" aria-live="polite">
                    <Transition name="msg-fade" mode="out-in">
                        <p v-if="cleanMessage" :key="cleanMessage"
                           class="text-sm font-medium text-[#CECBF6]/70 text-center m-0">
                            {{ cleanMessage }}<span v-if="animateDots" class="dots" aria-hidden="true"><span>.</span><span>.</span><span>.</span></span>
                        </p>
                    </Transition>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import { computed, inject } from 'vue'

const props = defineProps({
    message: { type: String, default: '' },
    animateDots: { type: Boolean, default: true }
})

const cleanMessage = computed(() =>
    props.animateDots
        ? props.message.replace(/[.…\s]+$/, '')
        : props.message
)

const appData = inject('appData');

</script>

<style scoped>
.ring-sweep {
    stroke-dasharray: 352;
    stroke-dashoffset: 352;
    animation: ring-sweep 1.6s cubic-bezier(.65, 0, .35, 1) infinite;
}

@keyframes ring-sweep {
    0%   { stroke-dashoffset: 352; }
    50%  { stroke-dashoffset: 55; }
    100% { stroke-dashoffset: -300; }
}

/* Animated dots */
.dots span {
    display: inline-block;
    animation: dot-pulse 1.4s ease-in-out infinite;
}
.dots span:nth-child(2) { animation-delay: .2s; }
.dots span:nth-child(3) { animation-delay: .4s; }

@keyframes dot-pulse {
    0%, 60%, 100% { opacity: .2; transform: translateY(0); }
    30%           { opacity: 1;  transform: translateY(-2px); }
}

/* Message swap transition */
.msg-fade-enter-active,
.msg-fade-leave-active {
    transition: opacity .25s ease, transform .25s ease;
}
.msg-fade-enter-from {
    opacity: 0;
    transform: translateY(4px);
}
.msg-fade-leave-to {
    opacity: 0;
    transform: translateY(-4px);
}

@media (prefers-reduced-motion: reduce) {
    .ring-sweep {
        animation: none;
        stroke-dashoffset: 60;
    }
    .dots span {
        animation: none;
        opacity: 1;
    }
    .msg-fade-enter-active,
    .msg-fade-leave-active {
        transition: none;
    }
}
</style>

<template>
    <div class="w-full flex justify-center">
        <a
            :href="activityUrl"
            class="relative overflow-hidden inline-flex items-center justify-center gap-2 text-sm font-bold sharedBtn rounded-xl py-3 transition-all duration-300"
            :class="hasPassed ? 'pl-8 pr-14' : 'px-8'"
        >
            <span
                v-if="hasPassed"
                class="pointer-events-none absolute right-0 top-0 h-14 w-14 overflow-hidden"
            >
                <span class="absolute right-[-24px] top-[10px] w-[84px] rotate-45 bg-emerald-400 py-[3px] text-center text-[9px] font-extrabold uppercase tracking-[0.15em] text-emerald-950 shadow-md">
                    Passed
                </span>
            </span>

            {{ hasPassed ? 'Module Activity' : 'Take Module Activity' }}

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    activityUrl: {
        type: String,
        required: true
    },
    moduleProgress: {
        type: Object,
        default: null
    },
    failed: {
        type: Boolean,
        default: false
    }
})

const hasPassed = computed(() => props.moduleProgress?.has_passed ?? false)
</script>

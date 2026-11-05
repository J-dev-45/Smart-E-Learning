<template>
    <header class="sticky top-0 shrink-0 z-10 w-full h-14 flex items-center justify-between sharedTXT px-3 sm:px-5 border-b sharedBorder sharedSurfaceBG backdrop-blur-md">
        <div class="flex items-center">
            <a v-if="assessmentType === 'quiz'"
                :href="`/learning/${url(subjectName)}/${subjectId}/${url(moduleName)}/${moduleId}/`"
                class="group inline-flex items-center gap-2 rounded-full border-[1.5px] sharedStateOpen sharedStatePill sharedStatePillLink py-1.5 pl-2.5 pr-4 text-sm font-semibold transition-all duration-300 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-300 group-hover:-translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span class="hidden sm:inline">Back to Learn</span>
                <span class="sm:hidden">Back</span>
            </a>

            <a v-if="assessmentType === 'exam'"
                :href="`/learn/${url(subjectName)}/${subjectId}`"
                class="group inline-flex items-center gap-2 rounded-full border-[1.5px] sharedStateOpen sharedStatePill sharedStatePillLink py-1.5 pl-2.5 pr-4 text-sm font-semibold transition-all duration-300 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-300 group-hover:-translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span class="hidden sm:inline">Back to Modules</span>
                <span class="sm:hidden">Back</span>
            </a>

            
        </div>

        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center min-w-0 px-2 max-w-[50vw] sm:max-w-[40vw]">
            <span class="sharedTXT font-semibold text-sm leading-tight truncate w-full text-center">
                {{ subjectName }}
            </span>
            <span class="sharedTXTMuted text-[11px] leading-tight mt-0.5 tracking-wide truncate w-full text-center">
                {{ assessmentType === 'exam' ? 'Summative Exam' : moduleName }}
            </span>
        </div>

        <!-- Sound toggle -->
        <button
            type="button"
            :aria-label="muted ? 'Unmute sound' : 'Mute sound'"
            @click="muted = !muted"
            class="group relative z-10 flex items-center justify-center size-9 rounded-full sharedTXT sharedIconBtn transition-colors duration-150 cursor-pointer"
        >
            <svg v-if="!muted" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM18.584 5.106a.75.75 0 0 1 1.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 0 1-1.06-1.06 8.25 8.25 0 0 0 0-11.668.75.75 0 0 1 0-1.06Z" />
                <path d="M15.932 7.757a.75.75 0 0 1 1.061 0 6 6 0 0 1 0 8.486.75.75 0 0 1-1.06-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 0-1.06Z" />
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06L6.44 7.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06Z" />
                <path fill-rule="evenodd" d="M17.78 9.22a.75.75 0 1 0-1.06 1.06L18.44 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L19.5 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L20.56 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L19.5 10.94l-1.72-1.72Z" clip-rule="evenodd" />
            </svg>
        </button>
    </header>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
    subjectName: { type:String, required: true},
    subjectId: { type: String, required: true},
    moduleId: { type: String, required: true},
    moduleName: { type:String, required: true},
    assessmentType: { type: String, required: true}
})

const muted = ref(false)
function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}


</script>
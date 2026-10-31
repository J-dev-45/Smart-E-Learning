<template>
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl p-10 flex flex-col items-center text-center">

        <div class="w-full mb-6">
            <h2 class="text-gray-900 font-bold text-lg">{{ subjectName }}</h2>
            <p class="text-gray-500 font-semibold text-sm">{{ assessmentType === 'exam' ? 'Summative Exam' : moduleName }}</p>
        </div>

        <span :class="['inline-block px-3 py-1 rounded-full text-xs font-semibold mb-8', badgeBg, badgeText]">
            {{ assessmentType === 'exam' ? 'Summative Exam Result' : 'Quiz Result' }}
        </span>

        <div class="relative w-44 h-44 flex items-center justify-center">
            <svg class="w-full h-full -rotate-90" viewBox="0 0 160 160">
                <circle cx="80" cy="80" r="70" fill="none" stroke="#F3F0FF" stroke-width="12" />
                <circle
                    cx="80" cy="80" r="70" fill="none"
                    :stroke="ringColor"
                    stroke-width="12"
                    stroke-linecap="round"
                    :stroke-dasharray="circumference"
                    :stroke-dashoffset="offset"
                />
            </svg>
            <div class="absolute flex flex-col items-center">
                <span :class="['font-bold text-sm tracking-wide uppercase mb-1', textColor]">{{ status }}</span>
                <span class="text-gray-900 text-3xl font-bold">{{ displayScore }}%</span>
            </div>
        </div>

        <div class="w-full bg-[#F5F3FF] rounded-xl px-6 py-4 mt-8">
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ message }}
            </p>
        </div>

        <p v-if="errorMessage" class="w-full text-red-600 text-sm mt-4">{{ errorMessage }}</p>

        <div class="w-full flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
            <a
                :href="homeUrl"
                class="inline-flex items-center gap-1.5 text-gray-600 font-semibold text-sm px-5 py-2.5 rounded-lg border border-gray-200 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                </svg>

                Home
            </a>

            <button
                v-if="status === 'Failed'"
                type="button"
                @click="retakeAssessment"
                :disabled="submitting"
                class="inline-flex items-center gap-1.5 bg-[#4C1D95] text-white font-semibold text-sm px-8 py-3 rounded-lg shadow-sm hover:bg-[#3b1575] hover:shadow-md active:scale-[0.98] transition-all disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                {{ submitting ? 'Please wait...' : 'Retake' }}
            </button>

            <a
                v-else
                :href="`/learning/${url(subjectName)}/${subjectId}/${url(moduleName)}/${moduleId}`"
                class="inline-flex items-center gap-1.5 bg-[#4C1D95] text-white font-semibold text-sm px-8 py-3 rounded-lg shadow-sm hover:bg-[#3b1575] hover:shadow-md active:scale-[0.98] transition-all"
            >
                Done
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>

    </div>
</template>

<script setup>
import { computed, ref } from 'vue';

function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}

const props = defineProps({
    subjectName: { type: String, required: true },
    moduleName: { type: String, required: true },
    subjectId: { type: String, required: true },
    moduleId: { type: String, required: true },
    scorePercent: { type: Number, required: true },
    message: { type: String, required: true },
    status: { type: String, required: true },
    assessmentType: { type: String, required: true },
    toTake: { type: String, default: 'question_type' },
    homeUrl: { type: String, default: '/home' },
    sectionScore: { type: Number, required: true }
});

const submitting = ref(false);
const errorMessage = ref('');

const isPassed = computed(() => props.status.toLowerCase() === 'passed');

const ringColor = computed(() => (isPassed.value ? '#16A34A' : '#DC2626'));
const textColor = computed(() => (isPassed.value ? 'text-green-600' : 'text-red-600'));
const badgeBg   = computed(() => (isPassed.value ? 'bg-green-50' : 'bg-red-50'));
const badgeText = computed(() => (isPassed.value ? 'text-green-600' : 'text-red-600'));

const circumference = 439.8;
const offset = computed(() => circumference - (circumference * props.scorePercent / 100));

const displayScore = computed(() => Math.round(props.scorePercent));

async function retakeAssessment() {
    if (submitting.value) return;

    submitting.value = true;
    errorMessage.value = '';

    try {
        const response = await fetch('/retake-assessment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                type_of_assessment: props.assessmentType,
                type: props.toTake,
                subject_id: props.subjectId,
                module_id: props.assessmentType === 'quiz' ? props.moduleId : null
            })
        });

        const data = await response.json();

        if (!response.ok || !data.success) {
            throw new Error(data.message ?? 'Unable to start the retake. Please try again.');
        }

        window.location.href = data.redirect;
    } catch (error) {
        errorMessage.value = error.message;
        submitting.value = false;
    }
}
</script>
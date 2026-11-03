<template>
    <div class="w-full max-w-sm m-auto sharedLightBG rounded-2xl shadow-xl p-4 sm:p-6 flex flex-col items-center text-center" :class="stateClass">

        <div class="w-full mb-3 sm:mb-4">
            <h2 class="sharedTXTOnLight font-bold text-base sm:text-lg leading-tight break-words">{{ subjectName }}</h2>
            <p class="sharedTXTLightMuted font-semibold text-xs sm:text-sm break-words">{{ assessmentType === 'exam' ? 'Summative Exam' : moduleName }}</p>
        </div>

        <span :class="['inline-block px-2.5 py-0.5 rounded-full text-[11px] sm:text-xs font-semibold mb-4 sm:mb-5', badgeBg, badgeText]">
            {{ assessmentType === 'exam' ? 'Summative Exam Result' : 'Quiz Result' }}
        </span>

        <div class="relative w-28 h-28 sm:w-32 sm:h-32 flex items-center justify-center">
            <svg class="w-full h-full -rotate-90" viewBox="0 0 160 160">
                <circle cx="80" cy="80" r="70" fill="none" class="sharedStrokeLight" stroke-width="12" />
                <circle
                    cx="80" cy="80" r="70" fill="none"
                    class="sharedStateText"
                    stroke="currentColor"
                    stroke-width="12"
                    stroke-linecap="round"
                    :stroke-dasharray="circumference"
                    :stroke-dashoffset="offset"
                />
            </svg>
            <div class="absolute flex flex-col items-center">
                <span :class="['font-bold text-[10px] sm:text-xs tracking-wide uppercase mb-0.5', textColor]">{{ status }}</span>
                <span class="sharedTXTOnLight text-xl sm:text-2xl font-bold">{{ displayScore }}%</span>
            </div>
        </div>

        <!-- Points breakdown -->
        <div class="w-full mt-4 sm:mt-5 rounded-xl border sharedLightBorder overflow-hidden text-left">
            <div class="flex items-center justify-between gap-2 px-4 py-2">
                <span class="sharedTXTLightMuted text-xs sm:text-sm">
                    {{ assessmentType === 'exam' ? 'Exam Points' : 'Quiz Points' }}
                </span>
                <span :class="['sharedTXTOnLight text-xs sm:text-sm font-semibold', !isPassed && 'line-through opacity-50']">{{ assessmentPoints }}</span>
            </div>

            <div class="flex items-center justify-between gap-2 px-4 py-2 border-t sharedLightBorder">
                <span class="sharedTXTLightMuted text-xs sm:text-sm">
                    Bonus Points
                    <span class="text-[10px] sm:text-xs">(1st take passed)</span>
                </span>
                <span :class="['sharedTXTOnLight text-xs sm:text-sm font-semibold', !isPassed && 'line-through opacity-50']">{{ bonusPoints }}</span>
            </div>

            <div class="flex items-center justify-between gap-2 px-4 py-2.5 border-t sharedLightBorder sharedLightFieldBG">
                <span class="sharedTXTOnLight text-xs sm:text-sm font-bold">Total Points</span>
                <span :class="['text-base sm:text-lg font-bold', textColor, !isPassed && 'line-through']">{{ totalPointsDisplay }}</span>
            </div>
        </div>

        <!-- Failed notice -->
        <div v-if="!isPassed" class="w-full flex items-start gap-1.5 text-left sharedTXTDanger text-[11px] sm:text-xs font-semibold mt-2">
            <svg class="w-3.5 h-3.5 shrink-0 mt-px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>You failed, so no points were added. Pass the {{ assessmentType === 'exam' ? 'exam' : 'quiz' }} to earn your points.</span>
        </div>

        <div class="w-full sharedLightFieldBG rounded-lg px-4 py-2.5 mt-3">
            <p class="sharedTXTLightMuted text-xs sm:text-sm leading-relaxed">
                {{ message }}
            </p>
        </div>

        <p v-if="errorMessage" class="w-full sharedTXTDanger text-xs sm:text-sm mt-3">{{ errorMessage }}</p>

        <div class="w-full flex items-center justify-between gap-2 mt-4 sm:mt-5 pt-4 border-t sharedLightBorder">
            <a
                :href="homeUrl"
                class="inline-flex items-center gap-1 sharedBtnGhostLight font-semibold text-xs sm:text-sm px-3 sm:px-4 py-2 rounded-lg border transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3.5 sm:size-4">
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
                class="inline-flex items-center gap-1 sharedBtn font-semibold text-xs sm:text-sm px-4 sm:px-6 py-2 rounded-lg shadow-sm hover:shadow-md active:scale-[0.98] transition-all disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                {{ submitting ? 'Please wait...' : 'Retake' }}
            </button>

            <a
                v-else
                :href="`/learning/${url(subjectName)}/${subjectId}/${url(moduleName)}/${moduleId}`"
                class="inline-flex items-center gap-1 sharedBtn font-semibold text-xs sm:text-sm px-4 sm:px-6 py-2 rounded-lg shadow-sm hover:shadow-md active:scale-[0.98] transition-all"
            >
                Done
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
    sectionScore: { type: Number, required: true },
    assessmentPoints: { type: Number, default: 0 },
    bonusPoints: { type: Number, default: 0 },
    totalPoints: { type: Number, default: null }
});

const submitting = ref(false);
const errorMessage = ref('');

const isPassed = computed(() => props.status.toLowerCase() === 'passed');

// Colors come from the shared state classes (set once on the card, read by the badge, ring and status text)
const stateClass = computed(() => (isPassed.value ? 'sharedStateLightPassed' : 'sharedStateLightFailed'));
const textColor  = 'sharedStateText';
const badgeBg    = 'sharedStateTint';
const badgeText  = 'sharedStateText';

const circumference = 439.8;
const offset = computed(() => circumference - (circumference * props.scorePercent / 100));

const displayScore = computed(() => Math.round(props.scorePercent));

// Always shows the total (crossed out in the template when failed). Uses the backend total if provided, otherwise sums assessment + bonus.
const totalPointsDisplay = computed(() =>
    props.totalPoints ?? (props.assessmentPoints + props.bonusPoints)
);

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
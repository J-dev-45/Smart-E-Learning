
<template>
    <div ref="headerEl" class="relative shrink-0 bg-[#12081F] w-full h-[60px] border-b-[#2A1B4A] border-b-[1px] flex items-center justify-between text-white px-5">
        <div class="flex items-center">
            <button type="button" @click="goBack"
                class="group inline-flex items-center gap-2 rounded-full border-[1.5px] border-[#CECBF6]/20 bg-[#CECBF6]/5 py-1.5 pl-2.5 pr-4 text-sm font-semibold text-[#CECBF6] transition-all duration-300 hover:border-[#CECBF6]/50 hover:bg-[#CECBF6]/10 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-300 group-hover:-translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span class="hidden sm:inline">Back to Modules</span>
                <span class="sm:hidden">Back</span>
            </button>
        </div>

        <div class="flex flex-col items-center justify-center min-w-0 px-2 text-center">
            <span class="text-sm sm:text-lg font-bold leading-tight text-white truncate max-w-[40vw] sm:max-w-md">
                {{ subjectName }}
            </span>
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-[#CECBF6]/60 truncate max-w-[40vw] sm:max-w-none">
                {{ module.module_name }}
            </span>
        </div>

        <button v-if="userMenu" type="button" class="py-2">
            <span
                class="rounded-full w-8 h-8 cursor-pointer flex items-center justify-center font-semibold text-md"
                :class="profileColor"
            >
                {{ initials(userName) }}
            </span>
        </button>

        <button v-else type="button" class="py-2">
            <span
                class="rounded-full w-8 h-8 cursor-pointer flex items-center justify-center font-semibold text-md"
                :class="profileColor"
            >
                {{ initials(userName) }}
            </span>
        </button>

        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-[#CECBF6]/10 pointer-events-none">
            <div
                class="h-full rounded-r-full bg-[#CECBF6] transition-[width] duration-150"
                :style="{ width: progress + '%' }"
            ></div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue';

const props = defineProps({
    profileColor: { type: String, required: true },
    module: { type: Object, required: true },
    topicCount: { type: Number, default: 0 },
    answeredCount: { type: Number, default: 0 },
    initialProgress: { type: Number, default: 0 },
    subjectId: { type: String, required: true },
    subjectName: { type:String, required: true}
});

const userMenu = ref(false);
const userName = ref("Jimwell Raza");
const headerEl = ref(null);

function initials(name) {
    return name
        .split(' ')
        .filter(Boolean)
        .map(word => word[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/dashboard';
    }
};

const normalizeProgress = value =>
    Math.min(100, Math.max(0, Number(value) || 0));

const databaseProgress = ref(normalizeProgress(props.initialProgress));
const scrollProgress = ref(Math.min(85, databaseProgress.value));

let scroller = null;
let lastSavedProgress = Math.floor(databaseProgress.value / 5) * 5;
let saving = false;
let pendingMilestone = null;

const progress = computed(() =>
    Math.max(databaseProgress.value, scrollProgress.value)
);

watch(
    () => props.initialProgress,
    value => {
        const savedProgress = normalizeProgress(value);

        databaseProgress.value = Math.max(
            databaseProgress.value,
            savedProgress
        );

        scrollProgress.value = Math.max(
            scrollProgress.value,
            Math.min(85, savedProgress)
        );

        lastSavedProgress = Math.max(
            lastSavedProgress,
            Math.floor(savedProgress / 5) * 5
        );
    }
);

function syncDatabaseProgress(value) {
    const savedProgress = normalizeProgress(value);

    databaseProgress.value = Math.max(
        databaseProgress.value,
        savedProgress
    );

    scrollProgress.value = Math.max(
        scrollProgress.value,
        Math.min(85, savedProgress)
    );

    lastSavedProgress = Math.max(
        lastSavedProgress,
        Math.floor(savedProgress / 5) * 5
    );
}

function handleProgressUpdated(event) {
    const detail = event.detail ?? {};

    if (
        String(detail.module_id) !== String(props.module.id) ||
        String(detail.subject_id) !== String(props.subjectId)
    ) {
        return;
    }

    if (detail.progress !== undefined) {
        syncDatabaseProgress(detail.progress);
    }
}

function updateScroll() {
    if (!scroller) return;

    const max = scroller.scrollHeight - scroller.clientHeight;

    const percent = max > 0
        ? Math.min(85, Math.max(0, (scroller.scrollTop / max) * 85))
        : 85;

    scrollProgress.value = Math.max(
        scrollProgress.value,
        percent
    );

    const milestone = Math.floor(percent / 5) * 5;

    if (milestone <= lastSavedProgress) return;

    pendingMilestone = Math.max(
        pendingMilestone ?? 0,
        milestone
    );

    if (!saving) {
        scrollModuleProgress();
    }
}

async function scrollModuleProgress() {
    if (saving || pendingMilestone === null) return;

    saving = true;

    try {
        while (pendingMilestone !== null) {
            const milestone = pendingMilestone;
            pendingMilestone = null;

            if (milestone <= lastSavedProgress) continue;

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');

            const response = await fetch('/module-progress', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    subject_id: props.subjectId,
                    module_id: props.module.id,
                    module_percent: milestone
                })
            });

            let data;

            try {
                data = await response.json();
            } catch {
                data = {};
            }

            if (!response.ok || !data.success) {
                console.error(
                    'Failed to save module progress:',
                    data.message || response.statusText
                );

                break;
            }

            const savedProgress = normalizeProgress(
                data.module_progress?.progress ?? milestone
            );

            syncDatabaseProgress(savedProgress);

            lastSavedProgress = Math.max(
                lastSavedProgress,
                milestone,
                Math.floor(savedProgress / 5) * 5
            );
        }
    } catch (error) {
        console.error('Failed to save module progress:', error);
    } finally {
        saving = false;

        if (
            pendingMilestone !== null &&
            pendingMilestone > lastSavedProgress
        ) {
            scrollModuleProgress();
        }
    }
}

onMounted(() => {
    scroller = headerEl.value?.closest('main');

    window.addEventListener(
        'module-progress-updated',
        handleProgressUpdated
    );

    if (!scroller) return;

    updateScroll();

    scroller.addEventListener('scroll', updateScroll, {
        passive: true
    });

    window.addEventListener('resize', updateScroll);
});

onBeforeUnmount(() => {
    scroller?.removeEventListener('scroll', updateScroll);
    window.removeEventListener('resize', updateScroll);

    window.removeEventListener(
        'module-progress-updated',
        handleProgressUpdated
    );
});
</script>


<template>
    <div
        v-for="subject in subjectsData"
        :key="subject.order"
        class="group relative overflow-hidden flex flex-col justify-between p-4 md:p-5 gap-4 rounded-2xl sharedSurface shadow-lg sharedShadow transition-all duration-200"
        :class="{ 'opacity-70': isLocked(subject) }"
    >
        <!-- PASSED RIBBON -->
        <div
            v-if="isPassed(subject.id)"
            class="absolute top-4 -right-9 w-32 rotate-45 bg-green-600 text-white text-[10px] font-bold uppercase tracking-wider text-center py-1 shadow-md pointer-events-none select-none"
            aria-label="Passed"
        >
            Passed
        </div>

        <div class="flex items-start justify-between">
            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl sharedTile transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedTXTAccent" >
                    <path stroke-linecap="round" stroke-linejoin="round" :d="icons.find(ic => ic.subject === subject.subject_name)?.d" />
                </svg>
            </div>

            <!-- LOCKED ICON -->
            <div
                v-if="isLocked(subject)"
                class="flex items-center justify-center size-11 shrink-0 rounded-full sharedTile"
                title="Locked"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedTXTMuted" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
            </div>

            <!-- PROGRESS RING -->
            <div
                v-else-if="!isPassed(subject.id)"
                class="relative size-11 shrink-0"
            >
                <svg class="size-11 -rotate-90 sharedTXTAccent" viewBox="0 0 40 40">
                    <circle cx="20" cy="20" r="16" fill="none" stroke="currentColor" stroke-opacity="0.15" stroke-width="4" />
                    <circle cx="20" cy="20" r="16" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-dasharray="100.5" :stroke-dashoffset="100.5 - (percentage(getSubjectsProgress(subject.id)) / 100) * 100.5" />
                </svg>

                <span class="absolute inset-0 flex items-center justify-center text-[10px] font-bold tabular-nums sharedTXTAccent">
                    {{ percentage(getSubjectsProgress(subject.id)) }}%
                </span>
            </div>
        </div>

        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold tracking-widest sharedTXTMuted">
                {{ subject.subject_code }}
            </span>

            <h3 class="text-base font-bold leading-snug">
                {{ subject.subject_name }}
            </h3>

            <p class="text-xs font-medium sharedTXTMuted">
                {{ getAvailableModulesCount(subject.id) }} Learning Modules
            </p>
        </div>

        <div
            v-if="isLocked(subject)"
            class="flex items-start gap-2 p-3 rounded-xl bg-amber-500/10 border border-amber-500/20"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="size-4 shrink-0 text-amber-500 mt-0.5" >
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>

            <div class="flex flex-col gap-0.5 min-w-0">
                <span class="text-[10px] font-bold text-amber-500 uppercase tracking-wider">
                    Unlock Requirement
                </span>

                <p class="text-xs sharedTXTMuted leading-relaxed">
                    Pass
                    <span class="font-bold text-amber-500">
                        {{ getPrerequisiteName(subject) }}
                    </span>
                    to unlock this subject.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 pt-1">

            <a
                v-if="isPassed(subject.id)"
                :href="`/learn/${url(subject.subject_name)}/${subject.id}`"
                class="flex-1 text-center text-xs font-bold rounded-xl py-2.5 transition-colors duration-200 bg-green-600 text-white hover:bg-green-700"
            >
                Review
            </a>

            <button
                v-else-if="isLocked(subject)"
                type="button"
                disabled
                title="Complete the previous subject to unlock this one"
                class="flex-1 flex items-center justify-center gap-1.5 text-xs font-bold rounded-xl py-2.5 sharedBtnSoft cursor-not-allowed"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>

                Locked
            </button>

            <a
                v-else
                :href="`/learn/${url(subject.subject_name)}/${subject.id}`"
                class="flex-1 text-center text-xs font-bold rounded-xl py-2.5 transition-colors duration-200"
                :class="getSubjectStarted(subject.id)
                    ? 'sharedBtnSoft'
                    : 'sharedBtn'"
            >
                {{ getSubjectStarted(subject.id) ? 'Continue Learning' : 'Learn' }}
            </a>

        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    subjectsData: { type: Array, required: true },
    modulesData: { type: Array, required: true },
    pretestData: { type: Array, required: true },
    subjectsProgress: { type: Array, required: true }
});

const icons = [
    {
        subject: 'Discrete Mathematics',
        d: 'M12 5 5 17M12 5l7 12M5 17h14M12 5v7M5 17l7-5M19 17l-7-5M10.7 5a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M3.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M17.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M10.7 12a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0'
    },
    {
        subject: 'Introduction to Computing',
        d: 'M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25'
    },
    {
        subject: 'Data Structures and Algorithms',
        d: 'M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125'
    },
    {
        subject: 'Computer Programming 1',
        d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z'
    },
    {
        subject: 'Computer Programming 2',
        d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z'
    }
];

function getAvailableModulesCount(Sid) {
    return props.modulesData.filter(
        Mdata => Mdata.subject_id === Sid && Mdata.status !== 'current'
    ).length;
}

function getSubjectStarted(Sid) {
    return props.subjectsProgress.find(
        SS => SS.subject_id === Sid
    );
}

function getSubjectsProgress(Sid) {
    return props.subjectsProgress.find(
        SS => SS.subject_id === Sid
    )?.progress ?? 0;
}

function percentage(progress) {
    return Math.min(
        100,
        Math.max(0, Math.round(Number(progress) || 0))
    );
}

function isPassed(Sid) {
    const progress = props.subjectsProgress.find(
        sp => String(sp.subject_id) === String(Sid)
    );

    return progress?.has_passed === true || progress?.has_passed === 1;
}

function isLocked(subject) {
    if (
        subject.pre_requisite === null ||
        subject.pre_requisite === undefined ||
        subject.pre_requisite === ''
    ) {
        return false;
    }
    return !isPassed(subject.pre_requisite);
}

function getPrerequisiteName(subject) {
    const prerequisite = props.subjectsData.find(
        s => String(s.id) === String(subject.pre_requisite)
    );
    return prerequisite?.subject_name ?? 'the required previous subject';
}

function url(url_name) {
    return url_name.replace(/\s+/g, '_');
}
</script>

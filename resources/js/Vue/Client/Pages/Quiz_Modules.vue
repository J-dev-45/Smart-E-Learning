<template>
    <section class="w-full pt-8 sm:pt-10 flex flex-col items-center justify-center">
        <div class="flex flex-col items-center gap-1 pb-6 sm:pb-8 text-center">
            <span class="font-bold text-2xl sm:text-4xl">MODULES</span>
            <p class="text-xs font-medium text-white/45">Complete them in order to unlock the next</p>
        </div>

        <!-- EMPTY STATE -->
        <div v-if="sorteduserModules.length === 0" class="w-full max-w-3xl flex flex-col items-center gap-4 p-6 sm:p-10 rounded-2xl border border-dashed border-[#CECBF6]/20 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 text-center">
            <div class="size-14 flex items-center justify-center rounded-xl bg-[#8B5CF6]/15 ring-1 ring-[#8B5CF6]/20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-[#B9A6F0]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-white/80 leading-snug">No modules yet</h3>
                <p class="text-sm text-white/45 mt-1">Modules for this subject haven't been added yet. Check back soon.</p>
            </div>
        </div>

        <ul v-else class="relative w-full max-w-3xl flex flex-col gap-4 sm:gap-5">
            <div class="absolute left-5 sm:left-7 top-5 sm:top-7 bottom-5 sm:bottom-7 w-px bg-[#CECBF6]/15 pointer-events-none"></div>

            <li v-for="(userModule, index) in sorteduserModules" :key="userModule.id" class="relative flex items-start md:items-center gap-3 sm:gap-4 z-10">

                <!-- PASSED -->
                <div v-if="userModule.has_passed" class="relative size-10 sm:size-14 shrink-0 flex items-center justify-center rounded-full bg-[#090014] border-2 border-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 sm:size-6 text-emerald-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>

                <div v-if="userModule.has_passed && !userModule.is_open" class="group relative overflow-hidden flex-1 min-w-0 flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl border border-emerald-400/25 bg-emerald-400/[0.05] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-emerald-400/45 hover:bg-emerald-400/[0.08]">

                    <!-- RIBBON -->
                    <div class="absolute top-0 right-0 size-20 overflow-hidden pointer-events-none">
                        <span class="absolute top-3.5 -right-7 w-28 rotate-45 bg-emerald-400 py-0.5 text-center text-[9px] font-bold uppercase tracking-widest text-[#090014] shadow-md">Passed</span>
                    </div>

                    <div class="min-w-0 pr-8 md:pr-0">
                        <h3 class="text-sm sm:text-base font-bold leading-snug break-words line-clamp-2">{{ moduleName(userModule.module_id) }}</h3>

                        <div class="mt-2 flex flex-col gap-1.5">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-400/60">Topics</span>
                            <ol class="flex flex-wrap gap-1.5">
                                <li v-for="topic in moduleTopics(userModule.module_id)" :key="topic.id" class="max-w-full truncate text-[10px] sm:text-xs font-medium text-emerald-300/80 bg-emerald-400/10 ring-1 ring-emerald-400/20 rounded-full py-0.5 px-2.5">
                                    {{ topic.topic_name }}
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 md:justify-end md:shrink-0">
                        <a :href="`/learning/${url(subjectName)}/${subjectId}/${url(moduleName(userModule.module_id))}/${userModule.module_id}/`"
                            class="w-full md:w-auto text-center text-xs sm:text-sm font-bold text-[#090014] bg-emerald-400 rounded-xl py-2.5 px-4 sm:px-6 transition-colors duration-200 hover:bg-emerald-400/85 whitespace-nowrap">
                            Review
                        </a>
                    </div>
                </div>

                <!-- OPEN -->
                <div v-if="userModule.is_open" class="relative size-10 sm:size-14 shrink-0 flex items-center justify-center rounded-full bg-[#8B5CF6]/20 ring-2 ring-[#8B5CF6]/60">
                    <span class="text-sm sm:text-[15px] font-bold text-[#B9A6F0]">{{ index + 1 }}</span>
                </div>

                <div v-if="userModule.is_open && !userModule.has_passed" class="group flex-1 min-w-0 flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl border border-[#8B5CF6]/30 bg-[#8B5CF6]/[0.08] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#8B5CF6]/50 hover:bg-[#8B5CF6]/[0.12]">
                    <div class="min-w-0">
                        <h3 class="text-sm sm:text-base font-bold leading-snug break-words line-clamp-2">{{ moduleName(userModule.module_id) }}</h3>

                        <div class="mt-2 flex flex-col gap-1.5">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-[#B9A6F0]/70">Topics</span>
                            <ol class="flex flex-wrap gap-1.5">
                                <li v-for="topic in moduleTopics(userModule.module_id)" :key="topic.id" class="max-w-full truncate text-[10px] sm:text-xs font-medium text-[#B9A6F0] bg-[#8B5CF6]/15 ring-1 ring-[#8B5CF6]/20 rounded-full py-0.5 px-2.5">
                                    {{ topic.topic_name }}
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 md:justify-end md:shrink-0">
                        <a :href="`/learning/${url(subjectName)}/${subjectId}/${url(moduleName(userModule.module_id))}/${userModule.module_id}/`"
                            class="w-full md:w-auto text-center text-xs sm:text-sm font-bold text-white bg-[#8B5CF6] rounded-xl py-2.5 px-4 sm:px-6 transition-colors duration-200 hover:bg-[#8B5CF6]/85 whitespace-nowrap">
                            {{ moduleStarted(userModule.module_id) ? 'Continue' : 'Start' }}
                        </a>
                    </div>
                </div>

                <!-- LOCKED -->
                <div v-if="!userModule.has_passed && !userModule.is_open" class="relative size-10 sm:size-14 shrink-0 flex items-center justify-center rounded-full bg-[#090014] border border-[#CECBF6]/15">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-white/40">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>

                <div v-if="!userModule.has_passed && !userModule.is_open" class="flex-1 min-w-0 flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl border border-[#CECBF6]/10 bg-white/[0.02] backdrop-blur-sm">
                    <div class="min-w-0">
                        <h3 class="text-sm sm:text-base font-bold leading-snug text-white/45 break-words line-clamp-2">{{ moduleName(userModule.module_id) }}</h3>
                        <div class="mt-2 flex flex-col gap-1.5">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-white/30">Topics</span>
                            <ol class="flex flex-wrap gap-1.5">
                                <li v-for="topic in moduleTopics(userModule.module_id)" :key="topic.id" class="max-w-full truncate text-[10px] sm:text-xs font-medium text-white/45 bg-white/[0.04] ring-1 ring-white/10 rounded-full py-0.5 px-2.5">
                                    {{ topic.topic_name }}
                                </li>
                            </ol>
                        </div>
                    </div>

                    <span class="w-full md:w-auto md:shrink-0 text-center text-xs sm:text-sm font-bold text-white/30 ring-1 ring-white/10 rounded-xl py-2.5 px-4 sm:px-6 whitespace-nowrap cursor-not-allowed">Locked</span>
                </div>
            </li>

            <!-- COMPREHENSIVE EXAM: OPEN -->
            <li v-if="examOpen && !examPassed" class="relative flex items-start md:items-center gap-3 sm:gap-4 z-10">
                <div class="relative size-10 sm:size-14 shrink-0 flex items-center justify-center rounded-full bg-[#090014] border-2 border-dashed border-[#22D3EE]/60">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-6 text-[#7EE3F5]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                </div>

                <div class="group flex-1 min-w-0 flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl border border-dashed border-[#22D3EE]/30 bg-[#22D3EE]/[0.06] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#22D3EE]/50 hover:bg-[#22D3EE]/[0.09]">
                    <div class="min-w-0">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#7EE3F5]/70">Final Assessment</span>
                        <h3 class="text-sm sm:text-base font-bold leading-snug break-words">Comprehensive Exam</h3>
                        <p class="text-xs sm:text-sm font-medium text-white/45 mt-0.5">Covers all modules in this subject.</p>
                    </div>

                    <div class="flex flex-wrap gap-2 md:justify-end md:shrink-0">
                        <a :href="`/assessment/exam/question_type/${url(subjectName)}/${subjectId}/none/0`"
                            class="w-full md:w-auto text-center text-xs sm:text-sm font-bold text-[#090014] bg-[#22D3EE] rounded-xl py-2.5 px-4 sm:px-6 transition-colors duration-200 hover:bg-[#22D3EE]/85 whitespace-nowrap">
                            {{ props.examStarted ? 'Continue Exam' : 'Take Exam' }}
                        </a>
                    </div>
                </div>
            </li>

            <!-- COMPREHENSIVE EXAM: PASSED -->
            <li v-else-if="examOpen && examPassed" class="relative flex items-start md:items-center gap-3 sm:gap-4 z-10">
                <div class="relative size-10 sm:size-14 shrink-0 flex items-center justify-center rounded-full bg-[#090014] border-2 border-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 sm:size-6 text-emerald-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>

                <div class="group relative overflow-hidden flex-1 min-w-0 flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl border border-emerald-400/25 bg-emerald-400/[0.05] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-emerald-400/45 hover:bg-emerald-400/[0.08]">

                    <!-- RIBBON -->
                    <div class="absolute top-0 right-0 size-20 overflow-hidden pointer-events-none">
                        <span class="absolute top-3.5 -right-7 w-28 rotate-45 bg-emerald-400 py-0.5 text-center text-[9px] font-bold uppercase tracking-widest text-[#090014] shadow-md">Passed</span>
                    </div>

                    <div class="min-w-0 pr-8 md:pr-0">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-400/60">Final Assessment</span>
                        <h3 class="text-sm sm:text-base font-bold leading-snug break-words">Comprehensive Exam</h3>
                        <p class="text-xs sm:text-sm font-medium text-white/45 mt-0.5">You passed the final assessment for this subject.</p>
                    </div>

                    <div class="flex flex-wrap gap-2 md:justify-end md:shrink-0">
                        <a href="#"
                            class="w-full md:w-auto text-center text-xs sm:text-sm font-bold text-[#090014] bg-emerald-400 rounded-xl py-2.5 px-4 sm:px-6 transition-colors duration-200 hover:bg-emerald-400/85 whitespace-nowrap">
                            Review
                        </a>
                    </div>
                </div>
            </li>

            <!-- COMPREHENSIVE EXAM: LOCKED -->
            <li v-else class="relative flex items-start md:items-center gap-3 sm:gap-4 z-10">
                <div class="relative size-10 sm:size-14 shrink-0 flex items-center justify-center rounded-full bg-[#090014] border border-dashed border-[#CECBF6]/15">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-white/40">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>

                <div class="flex-1 min-w-0 flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl border border-dashed border-[#CECBF6]/10 bg-white/[0.02] backdrop-blur-sm">
                    <div class="min-w-0">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-white/30">Final Assessment</span>
                        <h3 class="text-sm sm:text-base font-bold leading-snug text-white/45 break-words">Comprehensive Exam</h3>
                        <p class="text-xs sm:text-sm font-medium text-white/30 mt-0.5">Pass every module to unlock the exam.</p>
                    </div>

                    <span class="w-full md:w-auto md:shrink-0 text-center text-xs sm:text-sm font-bold text-white/30 ring-1 ring-white/10 rounded-xl py-2.5 px-4 sm:px-6 whitespace-nowrap cursor-not-allowed">Locked</span>
                </div>
            </li>
        </ul>
    </section>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    userModules: { type: Array, required: true },
    modules: { type: Array, required: true },
    topics: { type: Array, required: true },
    questions: { type: Object, required: true },
    subjectId: { type: String, required: true },
    subjectName: { type: String, required: true },
    examOpen: { type: Boolean, default: false},
    modulesStarted: { type: Array, default: () => []},
    examStarted: { type: Boolean, default: false},
    examPassed: { type: Boolean, default: false},
});


const sorteduserModules = computed(() => {
    return [...props.userModules].sort((a, b) => {
        const indexA = props.modules.findIndex(t => t.id === a.module_id);
        const indexB = props.modules.findIndex(t => t.id === b.module_id);
        return indexA - indexB;
    });
});

function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}

function moduleName(module_id) {
    return props.modules.find(Mname => Mname.id === module_id)?.module_name ?? '';
}



function moduleTopics(M_id){
    return props.topics.filter(
        Tid => Tid.module_id === M_id
    )
}

function moduleStarted(M_id){
    return props.modulesStarted.find(
        id => id.module_id === M_id
    )
}

function cl(d) {
    console.log(d);
}
</script>
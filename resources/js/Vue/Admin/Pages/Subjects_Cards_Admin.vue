<template>

    <div class="col-span-full flex items-center justify-end">
        <button
            type="button"
            @click="addSubjectOpen()"
            class="flex items-center justify-center gap-1.5 bg-white text-black rounded-md font-bold text-xs whitespace-nowrap cursor-pointer
                h-8 w-8 sm:h-9 sm:w-auto sm:px-4
                transition-all duration-200
                hover:bg-[#CECBF6] hover:text-[#1A0B2E]
                active:scale-95
                focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#CECBF6]/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[#090014]"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2.5"
                stroke="currentColor"
                class="size-3.5 shrink-0"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15"
                />
            </svg>

            <span class="hidden sm:inline">Add Subject</span>
        </button>
    </div>

    <div
        v-for="subject in subjectsData"
        :key="subject.order"
        class="group relative flex flex-col justify-between gap-5 overflow-hidden rounded-2xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 p-4 transition-all duration-300 hover:-translate-y-1 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10 hover:shadow-lg hover:shadow-[#CECBF6]/5 md:p-6">

        <!-- Top accent line -->
        <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-[#CECBF6]/40 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

        <!-- Icon -->
        <div class="flex items-start justify-between">
            <div class="rounded-xl border border-[#CECBF6]/15 bg-[#CECBF6]/10 p-3 transition-colors duration-300 group-hover:bg-[#CECBF6]/20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-[#CECBF6]">
                    <path stroke-linecap="round" stroke-linejoin="round" :d="icons.find(ic=>ic.subject === subject.subject_name)?.d" />
                </svg>
            </div>
        </div>

        <!-- Info -->
        <div class="flex flex-col gap-1.5">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#CECBF6]/50">
                Subject Code
            </span>
            <h3 class="text-base font-bold leading-snug text-white md:text-lg">{{ subject.subject_name }}</h3>
            <p class="flex items-center gap-2 text-xs font-semibold text-[#CECBF6]/60">
                <span class="size-1.5 rounded-full bg-[#CECBF6]/60"></span>
                {{ getAvailableModulesCount(subject.id) }} Modules
            </p>
        </div>

        <!-- Action -->
        <div class="flex items-center gap-2 border-t border-[#CECBF6]/10 pt-4">
            <a :href="`/subject/${url(subject.subject_name)}/${subject.id}`"
                class="flex flex-1 items-center justify-center gap-2 rounded-lg bg-[#CECBF6]/85 py-2.5 text-center text-xs font-bold text-[#090014] transition-all duration-300 hover:bg-[#CECBF6] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#CECBF6]/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[#090014]">
                View
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 transition-transform duration-300 group-hover:translate-x-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>

    <Add_Subject
        :show-add-subject="addSubject"
        @close-add="closeAdd"
        @new-subject="handleNewSubjects"
    />
</template>


<script setup>

import { ref } from 'vue';

import Add_Subject from '../Modal/Add_Subject.vue'

const props = defineProps({
    subjectsData: { type: Array, required: true },
    modulesData: { type: Array, required: true },
})
const icons = [
    {subject: 'Discrete Mathematics', d: 'M12 5 5 17M12 5l7 12M5 17h14M12 5v7M5 17l7-5M19 17l-7-5M10.7 5a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M3.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M17.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M10.7 12a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0'},
    {subject: 'Introduction to Computing', d: 'M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25'},
    {subject: 'Data Structures and Algorithms', d: 'M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125'},
    {subject: 'Computer Programming 1', d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z'},
    {subject: 'Computer Programming 2', d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z'},

]

const addSubject = ref(false);

function addSubjectOpen() {
    addSubject.value = true
}

function closeAdd() {
    addSubject.value = false
}


function getAvailableModulesCount(Sid) {
    return props.modulesData.filter(
        Mdata => Mdata.subject_id === Sid && Mdata.status != 'current'
    ).length;
}



function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}

</script>
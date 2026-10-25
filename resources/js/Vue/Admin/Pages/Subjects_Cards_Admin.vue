
<template>
    <div class="col-span-full flex items-center justify-end">
        <button
            type="button"
            @click="addSubjectOpen()"
            class="flex items-center justify-center gap-1.5 bg-white text-black rounded-md font-bold text-xs whitespace-nowrap cursor-pointer h-8 w-8 sm:h-9 sm:w-auto sm:px-4 transition-all duration-200 hover:bg-[#CECBF6] hover:text-[#1A0B2E] active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#CECBF6]/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[#090014]"
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
        v-for="subject in localSubjects"
        :key="subject.id"
        class="group relative flex min-w-0 flex-col justify-between gap-6 overflow-clip rounded-2xl border border-[#CECBF6]/15 bg-gradient-to-b from-[#CECBF6]/10 to-[#CECBF6]/[0.03] p-5 shadow-sm shadow-black/20 transition-colors duration-300 hover:border-[#CECBF6]/45 hover:from-[#CECBF6]/[0.16] hover:to-[#CECBF6]/[0.08] md:p-6"
    >
        <div class="flex items-start justify-between gap-3">
            <div class="shrink-0 rounded-xl border border-[#CECBF6]/20 bg-[#CECBF6]/10 p-3 shadow-inner shadow-[#CECBF6]/5">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6 text-[#CECBF6]"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        :d="icons.find(ic => ic.subject === subject.subject_name)?.d"
                    />
                </svg>
            </div>

            <span class="inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap rounded-full border border-[#CECBF6]/20 bg-[#CECBF6]/10 px-2.5 py-1 text-[11px] font-semibold text-[#CECBF6]/80">
                <span class="size-1.5 rounded-full bg-[#CECBF6]"></span>
                {{ getAvailableModulesCount(subject.id) }} Modules
            </span>
        </div>

        <div class="flex min-w-0 flex-col gap-2">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#CECBF6]/50">
                {{ subject.subject_code }}
            </span>

            <h3 class="line-clamp-2 break-words text-base font-bold leading-snug text-white sm:min-h-[2.75rem] md:text-lg">
                {{ subject.subject_name }}
            </h3>
        </div>

        <div class="border-t border-[#CECBF6]/10 pt-4">
            <div class="flex items-center gap-2">
                <a
                    :href="`/subject/${url(subject.subject_name)}/${subject.id}`"
                    class="flex min-w-0 flex-1 items-center justify-center gap-2 rounded-lg bg-[#CECBF6]/85 py-2.5 text-center text-xs font-bold text-[#090014] transition-all duration-300 hover:bg-[#CECBF6] active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#CECBF6]/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[#090014]"
                >
                    View
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 transition-transform duration-300 group-hover:translate-x-1" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>

                <!-- Edit -->
                <button
                    type="button"
                    aria-label="Edit subject"
                    title="Edit"
                    class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-lg border border-[#CECBF6]/20 bg-[#CECBF6]/10 text-[#CECBF6] transition-all duration-300 hover:border-[#CECBF6]/50 hover:bg-[#CECBF6]/20 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#CECBF6]/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[#090014]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-4" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </button>

                <!-- Delete -->
                <button
                    type="button"
                    aria-label="Delete subject"
                    title="Delete"
                    class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-lg border border-red-400/20 bg-red-500/10 text-red-300 transition-all duration-300 hover:border-red-400/50 hover:bg-red-500/20 hover:text-red-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-400/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[#090014]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-4" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <Add_Subject
        :show-add-subject="addSubject"
        @close-add="closeAdd"
        @new-subject="handleNewSubject"
    />
</template>

<script setup>
import { ref, watch } from 'vue'
import Add_Subject from '../Modal/Add_Subject.vue'

const props = defineProps({
    subjectsData: { type: Array, required: true },
    modulesData: { type: Array, required: true },
})

const localSubjects = ref([...props.subjectsData])

watch(
    () => props.subjectsData,
    (newSubjects) => {
        localSubjects.value = [...newSubjects]
    },
    { deep: true }
)

function handleNewSubject(subject) {
    if (localSubjects.value.some(item => item.id === subject.id)) return

    localSubjects.value.push(subject)
}

const icons = [
    { subject: 'Discrete Mathematics', d: 'M12 5 5 17M12 5l7 12M5 17h14M12 5v7M5 17l7-5M19 17l-7-5M10.7 5a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M3.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M17.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M10.7 12a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0' },
    { subject: 'Introduction to Computing', d: 'M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25' },
    { subject: 'Data Structures and Algorithms', d: 'M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125' },
    { subject: 'Computer Programming 1', d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z' },
    { subject: 'Computer Programming 2', d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z' },
]

const addSubject = ref(false)

function addSubjectOpen() {
    addSubject.value = true
}

function closeAdd() {
    addSubject.value = false
}

function getAvailableModulesCount(Sid) {
    return props.modulesData.filter(
        Mdata => Mdata.subject_id === Sid && Mdata.status != 'current'
    ).length
}

function url(url_name) {
    return url_name.replace(/\s+/g, '_')
}
</script>

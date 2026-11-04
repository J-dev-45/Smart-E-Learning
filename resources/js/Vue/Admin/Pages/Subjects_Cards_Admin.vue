
<template>
    <div class="col-span-full flex items-center justify-end">
        <button
            type="button"
            @click="addSubjectOpen()"
            class="flex items-center justify-center gap-1.5 sharedBtn rounded-xl font-bold text-xs whitespace-nowrap cursor-pointer h-8 w-8 sm:h-9 sm:w-auto sm:px-4 transition-all duration-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-3.5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="hidden sm:inline">Add Subject</span>
        </button>
    </div>

    <!-- SUBJECT CARDS -->
    <div
        v-for="subject in localSubjects"
        :key="subject.id"
        class="group relative flex min-w-0 flex-col justify-between gap-6 overflow-clip rounded-2xl sharedSurface p-5 shadow-lg sharedShadow transition-all duration-200 md:p-6"
    >
        <div class="flex items-start justify-between gap-3">
            <!-- Icon tile -->
            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl sharedTile">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedTXTAccent">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        :d="icons.find(ic => ic.subject === subject.subject_name)?.d"
                    />
                </svg>
            </div>

            <!-- Modules badge -->
            <span class="inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap rounded-full sharedStateExam sharedStateChip ring-1 px-2.5 py-1 text-[11px] font-semibold tabular-nums">
                <span class="size-1.5 rounded-full sharedStateBG"></span>
                {{ getAvailableModulesCount(subject.id) }} Modules
            </span>
        </div>

        <div class="flex min-w-0 flex-col gap-2">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] sharedTXTMuted">
                {{ subject.subject_code }}
            </span>

            <h3 class="line-clamp-2 break-words text-base font-bold leading-snug sharedTXT sm:min-h-[2.75rem] md:text-lg">
                {{ subject.subject_name }}
            </h3>
        </div>

        <div class="border-t sharedBorder pt-4">
            <div class="flex items-center gap-2">
                <!-- View -->
                <a
                    :href="`/subject/${url(subject.subject_name)}/${subject.id}`"
                    class="flex min-w-0 flex-1 items-center justify-center gap-2 rounded-xl sharedBtn py-2.5 text-center text-xs font-bold transition-all duration-200 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                >
                    View

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 transition-transform duration-300 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>

                <!-- Edit -->
                <button
                    type="button"
                    @click="openEditSubject(subject)"
                    aria-label="Edit subject"
                    title="Edit"
                    class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-xl sharedTXTMuted sharedTile ring-1 sharedRingSoft sharedStateWarning sharedHoverState transition-all duration-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </button>

                <!-- Delete -->
                <button
                    type="button"
                    @click="openDeleteSubject(subject)"
                    aria-label="Delete subject"
                    title="Delete"
                    class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-xl sharedStateDanger sharedStateChip sharedDangerSolidHover ring-1 transition-all duration-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- ADD SUBJECT -->
    <Add_Subject
        :show-add-subject="addSubject"
        :subjects="localSubjects"
        @close-add="closeAdd"
        @new-subject="handleNewSubject"
    />

    <!-- EDIT SUBJECT -->
    <Edit_Subject
        :show-edit-subject="showEditSubject"
        :subject-data="selectedEditSubject"
        :subjects="localSubjects"
        @close="closeEditSubject"
        @subject-updated="handleSubjectUpdated"
    />

    <!-- DELETE SUBJECT -->
    <Delete_Subject
        :show-delete-subject="showDeleteSubject"
        :subject-id="selectedDeleteSubject_id"
        :subject-name="selectedDeleteSubject_name"
        @close="closeDeleteSubject"
        @subject_deleted="handleSubjectDeleted"
    />
</template>

<script setup>
import { ref, watch } from 'vue'

import Add_Subject from '../Modal/Add_Subject.vue'
import Edit_Subject from '../Modal/Edit_Subject.vue'
import Delete_Subject from '../Modal/Delete_Subject.vue'

const props = defineProps({
    subjectsData: {
        type: Array,
        required: true
    },

    modulesData: {
        type: Array,
        required: true
    }
})

// Shared reactive subject list
const localSubjects = ref([...props.subjectsData])

// Sync when parent provides updated subjects
watch(
    () => props.subjectsData,
    (newSubjects) => {
        localSubjects.value = [...newSubjects]
    },
    { deep: true }
)

// ADD SUBJECT STATE
const addSubject = ref(false)

// EDIT SUBJECT STATE
const showEditSubject = ref(false)
const selectedEditSubject = ref(null)

// DELETE SUBJECT STATE
const showDeleteSubject = ref(false)
const selectedDeleteSubject_id = ref(null)
const selectedDeleteSubject_name = ref('')

function addSubjectOpen() {
    addSubject.value = true
}

function closeAdd() {
    addSubject.value = false
}

function handleNewSubject(subject) {
    const exists = localSubjects.value.some(
        item => String(item.id) === String(subject.id)
    )

    if (exists) return

    localSubjects.value.push(subject)
}

function openEditSubject(subject) {
    selectedEditSubject.value = { ...subject }
    showEditSubject.value = true
}

function closeEditSubject() {
    showEditSubject.value = false
    selectedEditSubject.value = null
}

function handleSubjectUpdated(updatedSubject) {
    const index = localSubjects.value.findIndex(
        subject => String(subject.id) === String(updatedSubject.id)
    )

    if (index !== -1) {
        localSubjects.value[index] = {
            ...localSubjects.value[index],
            ...updatedSubject
        }
    }
}

function openDeleteSubject(subject) {
    selectedDeleteSubject_id.value = subject.id
    selectedDeleteSubject_name.value = subject.subject_name
    showDeleteSubject.value = true
}

function closeDeleteSubject() {
    showDeleteSubject.value = false
    selectedDeleteSubject_id.value = null
    selectedDeleteSubject_name.value = ''
}

function handleSubjectDeleted(deletedSubjectId) {
    localSubjects.value = localSubjects.value.filter(
        subject => String(subject.id) !== String(deletedSubjectId)
    )

    closeDeleteSubject()
}

function getAvailableModulesCount(Sid) {
    return props.modulesData.filter(
        Mdata => Mdata.subject_id === Sid && Mdata.status != 'current'
    ).length
}

function url(url_name) {
    return url_name.replace(/\s+/g, '_')
}

// SUBJECT ICONS
const icons = [
    {
        subject: 'Discrete Mathematics',
        d: 'M12 5 5 17M12 5l7 12M5 17h14M12 5v7M5 17l7-5M19 17l-7-5M10.7 5a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 0 0-2.6 0M3.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 0 0-2.6 0M17.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 0 0-2.6 0M10.7 12a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 0 0-2.6 0'
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
]
</script>

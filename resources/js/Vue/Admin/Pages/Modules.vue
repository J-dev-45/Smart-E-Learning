<template>

    <!-- HEADER -->
    <header
        class="relative z-10 shrink-0 w-full h-[60px] flex items-center justify-between gap-3 px-3 sm:px-5 sharedSurfaceBG border-b-[1.5px] sharedBorder shadow-md sharedShadow sharedTXT"
    >
        <a
            href="/subjects"
            class="cursor-pointer group flex items-center gap-1.5 sharedTXTMuted sharedHoverTXT transition-colors duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 transition-transform group-hover:-translate-x-0.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>

            <span class="text-sm font-medium">Back To Subjects</span>
        </a>

        <!-- PROFILE -->
        <button
            type="button"
            @click.stop="toggleUserMenu"
            aria-label="Open admin menu"
            aria-haspopup="menu"
            :aria-expanded="showUserMenu"
            :class="[
                'shrink-0 w-9 h-9 rounded-full sharedTXT flex items-center justify-center text-xs font-semibold cursor-pointer focus:outline-none focus:ring-1 focus:ring-gray-300',
                profileColor
            ]"
        >
            {{ initials(userName) }}
        </button>
    </header>

    <section
        class="w-full flex-1 min-h-0 overflow-y-auto scrollbar-thin scroll-smooth p-5 sharedTXT max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden"
    >

        <div class="flex items-center justify-between gap-4 flex-wrap">
            <h1 class="font-bold text-3xl sharedTXT">
                {{ props.subjectName }}
            </h1>

            <div class="flex items-center gap-3">

                <!-- VIEW ALL QUESTIONS -->
                <a
                    :href="`/questions/view-subject-questions/${props.subjectName}/${props.subjectId}/none/0`"
                    title="View all questions"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold sharedStateOpen sharedStateChip sharedStateChipLink ring-1 active:scale-95 transition-all duration-200 cursor-pointer whitespace-nowrap"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <span>View All Questions</span>
                </a>

                <!-- ADD MODULE -->
                <button
                    type="button"
                    @click="openAddModule"
                    class="flex items-center justify-center gap-1.5 sharedBtn rounded-xl font-bold text-xs whitespace-nowrap cursor-pointer h-8 w-auto px-2 sm:h-9 sm:px-4 transition-all duration-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
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

                    <span class="text-[10px] sm:text-sm">Add Module</span>
                </button>

            </div>
        </div>

        <!-- SEPARATOR -->
        <div class="w-full h-px sharedLine mt-4"></div>

        <div class="w-full py-2 ps-2 flex gap-3 text-sm sharedTXTMuted font-medium">

            <div class="flex items-center gap-1.5">
                <span>Modules</span>
                <span>•</span>
                <span class="tabular-nums sharedTXTBody font-semibold">{{ localModules.filter(t => t.subject_id === props.subjectId).length }}</span>
            </div>

            <span class="sharedTXTMuted opacity-40">|</span>

            <div class="flex items-center gap-1.5">
                <span>Questions</span>
                <span>•</span>
                <span class="tabular-nums sharedTXTBody font-semibold">{{ questions.filter(q => localModules.some(m => m.id === q.module_id && m.subject_id === props.subjectId)).length }}</span>
            </div>

        </div>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-y-4 gap-x-5 py-5">

            <!-- MODULES -->
            <template
                v-for="(module) in localModules.filter(module => module.subject_id === props.subjectId)"
                :key="module.id"
            >

                <div
                    class="group flex flex-col gap-3 p-4 sm:p-5 rounded-2xl sharedSurface shadow-lg sharedShadow transition-all duration-200"
                >

                    <div class="flex items-center justify-between gap-3">

                        <div class="flex flex-col gap-1.5 min-w-0">

                            <span class="sharedTXT text-base font-bold leading-snug truncate">
                                {{ module.order }}. {{ module.module_name }}
                            </span>

                            <template v-if="props.questions.filter(m => m.module_id === module.id).length === 0">
                                <div class="flex items-center gap-2 text-[11px] sharedTXTMuted font-medium">
                                    <span>No Question Available.</span>
                                </div>
                            </template>

                            <template v-else-if="props.questions.filter(m => m.module_id === module.id).length === 1">
                                <div class="flex items-center gap-2 text-[11px] sharedTXTMuted font-medium">
                                    <span>{{ questions.filter(m => m.module_id === module.id).length }} Question</span>
                                </div>
                            </template>

                            <template v-else-if="questions.filter(m => m.module_id === module.id).length >= 2">
                                <div class="flex items-center gap-2 text-[11px] sharedTXTMuted font-medium">
                                    <span>{{ questions.filter(m => m.module_id === module.id).length }} Questions</span>
                                </div>
                            </template>

                        </div>

                        

                    </div>

                    <!-- TOPICS CONTAINER -->

                    <div class="flex flex-col gap-1 sharedSurfaceDeeper rounded-xl p-2">

                        <div class="flex items-center justify-end px-1 pb-1.5 ">

                            <!-- ADD TOPIC -->
                            <button
                                type="button"
                                @click="openAddTopic(module)"
                                class="shrink-0 flex items-center gap-1 px-2.5 py-1 rounded-lg sharedBtn text-xs font-semibold active:scale-95 transition-all duration-200 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Add Topic
                            </button>

                        </div>

                        <div class="flex items-center justify-between px-1.5 py-1 pb-1.5 mb-1 border-b sharedBorder">
                            <span class="text-[10px] font-bold uppercase tracking-widest sharedTXTAccent">Topics</span>
                            <span class="text-[10px] font-medium sharedTXTMuted tabular-nums">
                                {{ localTopics.filter(topic => topic.module_id === module.id).length }} Topics
                            </span>
                        </div>

                        

                        <div class="flex flex-col">

                            <div
                                v-for="topic in localTopics.filter(Tid => Tid.module_id === module.id)"
                                :key="topic.id"
                                class="flex items-center justify-between px-1.5 py-1.5 border-t first:border-t-0 sharedBorder rounded-lg sharedRowHover transition-colors duration-200"
                            >

                                <span class="text-xs sharedTXTBody truncate">
                                    {{ topic.topic_name }}
                                </span>

                                <div class="flex items-center gap-1 shrink-0">

                                    <a
                                        :href="`/lesson-management/${url(props.subjectName)}/${props.subjectId}/${topic.topic_name}/${topic.id}`"
                                        aria-label="Manage lessons"
                                        title="Manage Lessons"
                                        class="shrink-0 w-6 h-6 flex items-center justify-center rounded-lg sharedTXTMuted sharedTile sharedStateOpen sharedHoverState active:scale-95 transition-all duration-200 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </a>

                                    

                                    <!-- Delete topic  -->
                                    <button
                                        type="button"
                                        @click="openDeleteTopic(topic.topic_name, topic.id)"
                                        aria-label="Delete topic"
                                        title="Delete"
                                        class="shrink-0 w-6 h-6 flex items-center justify-center rounded-lg sharedStateDanger sharedStateText sharedHoverState active:scale-95 transition-all duration-200 cursor-pointer"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="w-full h-px sharedLine"></div>

                    <div class="flex items-center gap-2">

                        <!-- View Questions -->
                        <a
                            :href="`/questions/view-module-questions/${props.subjectName.toLowerCase().replace(/\s+/g, '-')}/${props.subjectId}/${module.module_name.toLowerCase().replace(/\s+/g, '-')}/${module.id}`"
                            class="flex-1 flex items-center justify-center gap-1.5 text-xs font-bold px-2.5 py-2.5 rounded-xl sharedBtn active:scale-95 transition-all duration-200 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                            View Questions
                        </a>

                        <!-- Edit module -->
                        <button
                            type="button"
                            @click="openEditModule(module)"
                            aria-label="Edit module"
                            title="Edit"
                            class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-xl sharedTXTMuted sharedTile ring-1 sharedRingSoft sharedStateWarning sharedHoverState transition-all duration-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                            </svg>
                        </button>

                        <!-- Delete module -->
                        <button
                            type="button"
                            @click="openDeleteModule(module.module_name, module.id, props.subjectName)"
                            aria-label="Delete module"
                            title="Delete"
                            class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-xl sharedStateDanger sharedStateChip sharedDangerSolidHover ring-1 transition-all duration-200 active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 sharedFocusRing"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12-.562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>

                    </div>

                </div>

            </template>

        </div>

    </section>


    <Admin_Menu
        :show-admin-menu="showUserMenu"
        :user-name="userName"
        :user-email="userEmail"
        :user-role="userRole"
        :profile-color="profileColor"
        :profile-picture="profilePicture"
        :profile-avatar="profileAvatar"
        @close-admin-menu="showUserMenu = false"
    />

    <Add_Modules
        :show-add-module="showAddModule"
        :subject-id="selectedSubjectId"
        :subject-name="selectedSubjectName"
        @close="closeAddModule"
        @new_modules="handelNewModule"
    />

    <Edit_Module
        :show-edit-module="showEditModule"
        :module-data="selectedEditModule"
        @close="closeEditModule"
    />

    <Delete_Module
        :show-delete-module="showDeleteModule"
        :module-name="module_name"
        :total-questions="total_module_question"
        :module-id="selectedDeleteModule_id"
        :subject-name="props.subjectName"
        @close="closeDeleteModule"
        @module_deleted="handleModuleDeleted"
    />

    <Add_Topics
        :show-add-topic="showAddTopic"
        :module-id="selectedModuleId"
        :module-name="selectedModuleName"
        @close="closeAddTopic"
        @new_topics="handelNewTopic"
    />


    <Delete_Topic
        :show-delete-topic="showDeleteTopic"
        :topic-name="topic_name"
        :topic-id="selectedDeleteTopic_id"
        :subject-name="props.subjectName"
        @close="closeDeleteTopic"
        @topic_deleted="handleTopicDeleted"
    />

</template>


<script setup>

import { ref, watch } from 'vue'

import Admin_Menu from '../Pages/Admin_Menu.vue'

import Add_Modules from '../Modal/Add_Modules.vue'
import Edit_Module from '../Modal/Edit_Module.vue'
import Delete_Module from '../Modal/Delete_Module.vue'

import Add_Topics from '../Modal/Add_Topics.vue'
import Delete_Topic from '../Modal/Delete_Topic.vue'


const props = defineProps({
    subjectId: { type: String, required: true },
    subjectName: { type: String, required: true },

    modules: {
        type: Array,
        required: true
    },

    questions: {
        type: Array,
        required: true
    },

    topics: {
        type: Array,
        required: true
    },

    userName: { type: String, default: '' },
    userEmail: { type: String, default: '' },
    userRole: { type: String, default: 'Admin' },
    profileColor: { type: String, default: '' },
    profilePicture: { type: String, default: '' },
    profileAvatar: { type: String, default: '' },
})


function url(url_name) {
    return url_name.replace(/\s+/g, '_')
}

// --------------------------------------------------------------------------------------------------------------->>>>>> PROFILE MENU


const showUserMenu = ref(false)

function toggleUserMenu() {
    showUserMenu.value = !showUserMenu.value
}

function initials(name) {
    return String(name ?? '')
        .split(' ')
        .filter(Boolean)
        .map(part => part[0])
        .join('')
        .slice(0, 2)
        .toUpperCase()
}


const localModules = ref([...props.modules])


watch(() => props.modules, (newVal) => {
    localModules.value = [...newVal]
}, { deep: true })


function handelNewModule(newModule) {
    localModules.value.push(newModule)

    localModules.value.sort((a, b) => {
        if (a.subject_id !== b.subject_id) {
            return String(a.subject_id).localeCompare(String(b.subject_id))
        }

        return a.order - b.order
    })
}


function handleModuleDeleted(deletedModuleId) {
    localModules.value = localModules.value.filter(
        module => String(module.id) !== String(deletedModuleId)
    )
}


const showAddModule = ref(false)
const selectedSubjectId = ref(null)
const selectedSubjectName = ref('')

const total_module_question = ref(0)
const module_name = ref('')
const subjectName = ref('')
const showEditModule = ref(false)
const selectedEditModule = ref(null)


function openAddModule() {
    selectedSubjectId.value = props.subjectId
    selectedSubjectName.value = props.subjectName
    showAddModule.value = true
}


function closeAddModule() {
    showAddModule.value = false
    selectedSubjectId.value = null
    selectedSubjectName.value = ''
}


function openEditModule(module) {
    selectedEditModule.value = module
    showEditModule.value = true
}


function closeEditModule() {
    showEditModule.value = false
    selectedEditModule.value = null
}


const showDeleteModule = ref(false)
const selectedDeleteModule_id = ref(null)


function openDeleteModule(moduleName, moduleId) {
    selectedDeleteModule_id.value = moduleId
    module_name.value = moduleName
    subjectName.value = props.subjectName

    total_module_question.value = props.questions.filter(
        q => q.module_id === moduleId
    ).length

    showDeleteModule.value = true
}


function closeDeleteModule() {
    showDeleteModule.value = false
    selectedDeleteModule_id.value = null
    module_name.value = ''
    total_module_question.value = 0
}


// --------------------------------------------------------------------------------------------------------------->>>>>> TOPIC ACTIONS


const showAddTopic = ref(false)
const selectedModuleId = ref(null)
const selectedModuleName = ref('')

const localTopics = ref([...props.topics])


function openAddTopic(module) {
    selectedModuleId.value = module.id
    selectedModuleName.value = module.module_name
    showAddTopic.value = true
}


function closeAddTopic() {
    showAddTopic.value = false
    selectedModuleId.value = null
    selectedModuleName.value = ''
}


watch(() => props.topics, (newVal) => {
    localTopics.value = [...newVal]
}, { deep: true })


function handelNewTopic(newTopic) {
    localTopics.value.push(newTopic)

    localTopics.value.sort((a, b) => {
        if (a.module_id !== b.module_id) {
            return String(a.module_id).localeCompare(String(b.module_id))
        }

        return a.order - b.order
    })
}



const showDeleteTopic = ref(false)
const selectedDeleteTopic_id = ref(null)

const topic_name = ref('')


function openDeleteTopic(topicName, topicId) {

    selectedDeleteTopic_id.value = topicId
    topic_name.value = topicName
    subjectName.value = props.subjectName

    showDeleteTopic.value = true

}


function closeDeleteTopic() {

    showDeleteTopic.value = false
    selectedDeleteTopic_id.value = null
    topic_name.value = ''

}


function handleTopicDeleted(deletedTopicId) {

    localTopics.value = localTopics.value.filter(
        topic => String(topic.id) !== String(deletedTopicId)
    )

}

</script>
<template>

    <template v-for="subject in subjects" :key="subject.order">

        <section
            :id="subject.slug"
            class="w-full h-auto min-h-[calc(100dvh-100px)] rounded-xl shrink-0 p-3 text-white my-5"
        >

            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h1 class="font-bold text-3xl">
                    {{ subject.subject_name }}
                </h1>

                <div class="flex items-center gap-3">

                    <!-- ACTION GROUP: edit + delete -->
                    <div class="flex items-center gap-2">
                        <!-- EDIT SUBJECT -->
                        <button
                            type="button"
                            title="Edit subject"
                            class="shrink-0 w-9 h-9 flex items-center justify-center rounded-md border-[1.5px] border-[#CECBF6]/15 text-gray-300
                            hover:bg-[#CECBF6]/10 hover:border-[#CECBF6]/30 hover:text-white
                            active:scale-95 transition-all cursor-pointer"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"
                                />
                            </svg>
                        </button>

                        <!-- DELETE SUBJECT -->
                        <button
                            type="button"
                            title="Delete subject"
                            class="shrink-0 w-9 h-9 flex items-center justify-center rounded-md border-[1.5px] border-red-500/20 text-red-400
                            hover:bg-red-500/10 hover:border-red-500/35 hover:text-red-300
                            active:scale-95 transition-all cursor-pointer"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12-.562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </button>
                    </div>

                    <!-- SEPARATOR -->
                    <div class="w-px h-6 bg-[#CECBF6]/15"></div>

                    <!-- VIEW ALL QUESTIONS -->
                    <a
                        :href="`/questions/view-subject-questions/${subject.subject_name.toLowerCase().replace(/\s+/g, '-')}/${subject.id}/none/0/none`"
                        title="View all questions"
                        class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-md text-xs font-medium bg-[#8B5CF6]/10 border-[1.5px] border-[#8B5CF6]/25 text-[#CECBF6] hover:bg-[#8B5CF6]/20 hover:border-[#8B5CF6]/40 active:scale-95 transition-all cursor-pointer whitespace-nowrap"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="size-3.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                        </svg>

                        <span>View All Questions</span>
                    </a>
                </div>
            </div>

            <!-- SEPARATOR -->
            <div class="w-full h-[1px] bg-[#CECBF6]/10 mt-4"></div>

            <div class="w-full py-2 ps-2 flex gap-3 text-gray-400 font-semibold">

                <div class="flex items-center gap-1.5">
                    <span>Modules</span>
                    <span>•</span>
                    <span>{{ localModules.filter(t => t.subject_id === subject.id).length }}</span>
                </div>

                <span class="text-white font-bold">|</span>

                <div class="flex items-center gap-1.5">
                    <span>Questions</span>
                    <span>•</span>
                    <span>{{ questions.filter(q =>localModules.some(m => m.id === q.module_id && m.subject_id === subject.id)).length }}</span>
                </div>

            </div>

            <div class="grid md:grid-cols-2 grid-cols-1 gap-y-3 gap-x-6 py-5">

                <!-- ADD NEW MODULE -->
                <button
                    type="button"
                    @click="openAddModule(subject)"
                    :class="[
                        'group flex flex-col items-center justify-center gap-2 text-[#CECBF6] border-dashed border-2 border-[#8B5CF6]/40 bg-[#8B5CF6]/8 rounded-md cursor-pointer p-4 transition-all hover:bg-[#8B5CF6]/15 hover:border-[#8B5CF6]/70 hover:text-white',

                        localModules.filter(module => module.subject_id === subject.id).length === 0
                            ? 'col-span-3 min-h-[300px] text-2xl'
                            : ''
                    ]"
                >

                    <div
                        class="border-dashed p-1.5 border-2 border-[#8B5CF6]/50 rounded-lg transition-colors group-hover:border-[#8B5CF6]"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5" >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                    </div>

                    <span class="text-xs font-bold tracking-wide">
                        Add New Module
                    </span>

                </button>

                <!-- MODULES -->
                <template
                    v-for="(module, index) in localModules.filter(module => module.subject_id === subject.id)"
                    :key="module.id"
                >
                    <div
                        class="group flex flex-col gap-3 border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 backdrop-blur-sm p-4 rounded-md transition-all hover:border-[#CECBF6]/30 hover:bg-[#CECBF6]/10"
                    >
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex flex-col gap-2 min-w-0">
                                <span class="text-white text-base font-bold leading-snug truncate">
                                    {{ module.order }}. {{ module.module_name }}
                                </span>

                                <template v-if="props.questions.filter(m => m.module_id === module.id).length === 0 ">
                                    <div class="flex items-center gap-2 text-[11px] text-gray-400 font-semibold">
                                        <span>No Question Available. </span>
                                    </div>
                                </template>
                                <template v-else-if="props.questions.filter(m => m.module_id === module.id).length === 1">
                                    <div class="flex items-center gap-2 text-[11px] text-gray-400 font-semibold">
                                        <span> {{ questions.filter(m => m.module_id === module.id).length }} Question</span>
                                    </div>
                                </template>

                                <template v-else-if="questions.filter(m => m.module_id === module.id).length >= 2 ">
                                    <div class="flex items-center gap-2 text-[11px] text-gray-400 font-semibold">
                                        <span> {{ questions.filter(m => m.module_id === module.id).length }} Questions</span>
                                    </div>
                                </template>

                            </div>

                            <div
                                class="shrink-0 w-8 h-8 bg-[#8B5CF6]/15 border border-[#CECBF6]/15 text-[#CECBF6] flex items-center justify-center rounded-md"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>

                            </div>

                        </div>

                        <!-- TOPICS CONTAINER -->

                        <div class="flex flex-col gap-1 bg-black/20 border-[1.5px] border-[#CECBF6]/10 rounded-md p-2">

                            <div class="flex items-center justify-between px-1.5 py-1">
                                <span class="text-[10px] font-bold uppercase tracking-wide text-gray-500">Topics</span>
                                <span class="text-[10px] text-gray-500">3 Topics</span>
                            </div>

                            <div class="flex items-center gap-1.5 px-1 pb-1.5 mb-1 border-b border-[#CECBF6]/10">
                                <input
                                    type="text"
                                    placeholder="Topic name"
                                    class="flex-1 min-w-0 bg-transparent text-xs text-white placeholder-gray-500 focus:outline-none px-1.5 py-1"
                                >
                                <button
                                    type="button"
                                    @click="openAddTopic(module)"
                                    class="shrink-0 flex items-center gap-1 px-2.5 py-1 rounded-md
                                    bg-white text-gray-900 text-xs font-semibold
                                    hover:bg-gray-100
                                    active:scale-95 transition-all cursor-pointer"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add Topic
                                </button>
                            </div>

                            <div class="flex flex-col divide-y divide-[#CECBF6]/10">

                                <div v-for="topic in localTopics.filter(Tid => Tid.module_id === module.id)" :ker="topic.order" class="flex items-center justify-between px-1.5 py-1.5 rounded-sm hover:bg-[#CECBF6]/5">
                                    <span class="text-xs text-gray-300 truncate">{{ topic.topic_name }}</span>
                                    <div class="flex items-center gap-1 shrink-0">

                                        <a :href="`/questions/view-topic-questions/${subject.subject_name.toLowerCase().replace(/\s+/g, '-')}/${subject.id}/${module.module_name.toLowerCase().replace(/\s+/g, '-')}/${module.id}/${topic.id}`" 
                                            class="shrink-0 w-6 h-6 flex items-center justify-center rounded-md text-gray-400 hover:bg-[#CECBF6]/10 hover:text-white active:scale-95 transition-all cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                        
                                        <button type="button" class="shrink-0 w-6 h-6 flex items-center justify-center rounded-md text-gray-400 hover:bg-[#CECBF6]/10 hover:text-white active:scale-95 transition-all cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                            </svg>
                                        </button>
                                        <button type="button" class="shrink-0 w-6 h-6 flex items-center justify-center rounded-md text-red-400/70 hover:bg-red-500/10 hover:text-red-300 active:scale-95 transition-all cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="w-full h-[1px] bg-[#CECBF6]/10"></div>

                        <div class="flex items-center gap-2">


                            <a    :href="`/questions/view-module-questions/${subject.subject_name.toLowerCase().replace(/\s+/g, '-')}/${subject.id}/${module.module_name.toLowerCase().replace(/\s+/g, '-')}/${module.id}/none`"
                                class="flex-1 flex items-center justify-center gap-1.5 text-xs font-semibold px-2.5 py-2 rounded-md
                                bg-[#8B5CF6]/15 border border-[#8B5CF6]/30 text-[#CECBF6]
                                hover:bg-[#8B5CF6]/25 hover:border-[#8B5CF6]/45
                                active:scale-95 transition-all cursor-pointer"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                View Questions

                            </a>

                            <button
                                type="button"
                                @click="openEditModule(module)"
                                class="shrink-0 w-9 h-9 flex items-center justify-center rounded-md border-[1.5px] border-[#CECBF6]/15 text-gray-300
                                hover:bg-[#CECBF6]/10 hover:border-[#CECBF6]/30 hover:text-white
                                active:scale-95 transition-all cursor-pointer"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                </svg>

                            </button>

                            <button
                                type="button"
                                @click="openDeleteModule(module.module_name, module.id, module.subject_name)"
                                class="shrink-0 w-9 h-9 flex items-center justify-center rounded-md border-[1.5px] border-red-500/20 text-red-400
                                hover:bg-red-500/10 hover:border-red-500/35 hover:text-red-300
                                active:scale-95 transition-all cursor-pointer"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                            </button>

                        </div>

                    </div>

                </template>

            </div>

        </section>


        <!-- SEPARATOR -->

        <div class="w-full flex items-center justify-center pt-[30px] mt-5 mb-5">

            <div class="bg-gray-600 w-[80%] h-[1px]"></div>

        </div>

    </template>


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
        :subject-name="subject_name"
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

</template>

<!-- ================================================================================== -->
<script setup>
import { ref, watch } from 'vue'

import Add_Modules from '../../Modal/Add_Modules.vue'
import Edit_Module from '../../Modal/Edit_Module.vue'
import Delete_Module from '../../Modal/Delete_Module.vue'

import Add_Topics from '../../Modal/Add_Topics.vue'

const props = defineProps({
    subjects: {
        type: Array,
        required: true
    },
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
    }
})

const localModules = ref([...props.modules])

watch(() => props.modules, (newVal) => {
    localModules.value = [...newVal]
}, { deep: true })

function handelNewModule(newModule) {
    localModules.value.push(newModule);

    localModules.value.sort((a, b) => {
        if (a.subject_id !== b.subject_id) {
            return a.subject_id.localeCompare(b.subject_id);
        }

        return a.order - b.order;
    });
}

function handleModuleDeleted(deletedModuleId) {
    localModules.value = localModules.value.filter(module => module.id !== deletedModuleId)
}

const showAddModule = ref(false)
const selectedSubjectId = ref(null)
const selectedSubjectName = ref('')

const total_module_question = ref(0)
const module_name = ref('')
const subject_name = ref('')
const showEditModule = ref(false)
const selectedEditModule = ref(null)

function openAddModule(subject) {
    selectedSubjectId.value = subject.id
    selectedSubjectName.value = subject.subject_name
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

function openDeleteModule(moduleName, moduleId, subjectName) {
    selectedDeleteModule_id.value = moduleId
    module_name.value = moduleName
    subject_name.value = subjectName

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
    localTopics.value.push(newTopic);

    localTopics.value.sort((a, b) => {
        if (a.subject_id !== b.module_id) {
            return a.module_id.localeCompare(b.module_id);
        }

        return a.order - b.order;
    });
}

</script>
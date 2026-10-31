<template>
    <div class="w-full h-full flex flex-col gap-4 min-h-0">

        <div class="w-full flex flex-col sm:flex-row sm:items-center gap-3">

            <!-- STATUS FILTER TABS -->
            <div class="flex items-center gap-1 p-1 rounded-md border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 w-fit max-w-full overflow-x-auto">
                <button
                    v-for="tab in statusTabs"
                    :key="tab"
                    @click="activeTab = tab"
                    class="px-3 py-1.5 rounded-md text-xs font-medium whitespace-nowrap transition-all cursor-pointer"
                    :class="activeTab === tab
                        ? 'bg-[#8B5CF6] text-white'
                        : 'text-gray-400 hover:text-white hover:bg-[#CECBF6]/10'"
                >
                    {{ tab }}
                </button>
            </div>

            <!-- SEARCH -->
            <div class="relative w-full sm:w-[320px] shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input
                    v-model="search"
                    type="search"
                    placeholder="Search by Name or Date..."
                    class="w-full h-10 sm:h-[36px] pl-10 pr-3 rounded-md text-base sm:text-sm text-white placeholder:text-gray-500
                           bg-[#CECBF6]/6 border-[1.5px] border-[#CECBF6]/15 outline-none
                           focus:border-[#CECBF6]/30 focus:bg-[#CECBF6]/10 transition-all"
                >
            </div>

            
        </div>

        <!-- LIST / TABLE -->
        <div class="w-full flex-1 min-h-0 flex flex-col border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 backdrop-blur-sm rounded-md overflow-hidden">

            <!-- header (table layout, large screens only) -->
            <div class="hidden lg:grid shrink-0 grid-cols-[90px_1fr_1fr_110px_100px_170px] px-4 py-3 border-b border-[#CECBF6]/15
                        text-xs font-semibold text-gray-400">
                <span>ID</span>
                <span>Name</span>
                <span>Replied By</span>
                <span>Status</span>
                <span>Date</span>
                <span>Actions</span>
            </div>

            <!-- rows -->
            <ul class="flex-1 min-h-0 max-h-[60dvh] lg:max-h-none overflow-y-auto lg:overflow-y-scroll scrollbar-thin max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">
                <li v-for="feedback in filteredFeedbacks" :key="feedback.id"
                    class="flex flex-col gap-3 px-4 py-3.5
                           lg:grid lg:grid-cols-[90px_1fr_1fr_110px_100px_170px] lg:items-center lg:gap-0
                           border-b border-[#CECBF6]/10 last:border-b-0
                           hover:bg-[#CECBF6]/5 transition-colors">

                    <!-- ID (table only) -->
                    <span class="hidden lg:block text-xs text-gray-400 font-mono">#{{ String(feedback.id).padStart(3, '0') }}</span>

                    <!-- NAME (+ status and meta on cards) -->
                    <div class="flex items-center gap-3 min-w-0 lg:pr-2">
                        <div class="w-8 h-8 shrink-0 rounded-md flex items-center justify-center text-[11px] font-semibold
                                    bg-[#8B5CF6]/15 border border-[#CECBF6]/15 text-[#CECBF6]">
                            {{ initials(feedback.student_name) }}
                        </div>

                        <div class="flex flex-col min-w-0 flex-1">
                            <span class="text-sm text-white truncate">{{ feedback.student_name }}</span>
                            <span class="lg:hidden text-[11px] text-gray-400 font-mono truncate">#{{ String(feedback.id).padStart(3, '0') }} · {{ formatDate(feedback.created_at) }}</span>
                            <span class="lg:hidden empty:hidden before:content-['Replied_by:_'] text-[11px] text-gray-400 truncate">{{ feedback.replied_by }}</span>
                        </div>

                        <span class="lg:hidden shrink-0 inline-flex px-2 py-1 rounded-md text-[11px] font-medium border"
                              :class="statusStyle(feedback.status)">
                            {{ feedback.status }}
                        </span>
                    </div>

                    <!-- REPLIED BY (table only) -->
                    <span class="hidden lg:block text-xs text-gray-300 truncate pr-2">{{ feedback.replied_by }}</span>

                    <!-- STATUS (table only) -->
                    <span class="hidden lg:block">
                        <span class="inline-flex px-2 py-1 rounded-md text-[11px] font-medium border"
                              :class="statusStyle(feedback.status)">
                            {{ feedback.status }}
                        </span>
                    </span>

                    <!-- DATE (table only) -->
                    <span class="hidden lg:block text-xs text-gray-400">{{ formatDate(feedback.created_at) }}</span>

                    <div class="flex items-center gap-2">
                        <!-- VIEW / REPLY -->
                        <button
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-md text-xs font-medium
                                bg-[#8B5CF6]/10 border-[1.5px] border-[#8B5CF6]/25 text-[#CECBF6]
                                hover:bg-[#8B5CF6]/20 hover:border-[#8B5CF6]/40
                                active:scale-95 transition-all cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            {{ feedback.status === 'Done' ? 'View' : 'Reply' }}
                        </button>

                        <!-- DELETE -->
                        <button
                            @click="deleteFeedbackModalOpen()"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-md text-xs font-medium
                                bg-red-500/10 border-[1.5px] border-red-500/25 text-red-300
                                hover:bg-red-500 hover:border-red-500 hover:text-white
                                active:scale-95 transition-all cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </li>

                <li v-if="filteredFeedbacks.length === 0" class="px-4 py-8 text-center text-sm text-gray-500">
                    No feedbacks found.
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    feedbacks: { type: Array, required: true},
})

const deleteFeedbackModal = document.getElementById('deleteFeedbackModal');
const deleteFeedbackModalClose = document.querySelectorAll('.deleteFeedbackModalClose');

function deleteFeedbackModalOpen(){
    localStorage.setItem('deleteFeedbackModal', 'true');
    deleteFeedbackModal.style.display = 'flex';
}

deleteFeedbackModalClose.forEach(closeModal => {
    closeModal.addEventListener('click', () =>{
        deleteFeedbackModal.style.display = 'none';
        localStorage.setItem('deleteFeedbackModal', 'false');
        console.log('clicked');
    });
});

window.addEventListener('DOMContentLoaded', () =>{
    if(localStorage.getItem('deleteFeedbackModal') === 'true'){
        deleteFeedbackModal.style.display = 'flex';
    }
})

const search = ref('')

const statusTabs = ['All', 'New', 'Unread', 'Done']
const activeTab = ref('All')

function formatDate(date) {
    const d = new Date(date)

    const month = String(d.getMonth() + 1).padStart(2, '0')
    const day = String(d.getDate()).padStart(2, '0')
    const year = String(d.getFullYear()).slice(-2)

    return `${month}-${day}-${year}`
}

props.feedbacks.sort((a,b)=> new Date(b.created_at).getTime() - new Date(a.created_at).getTime());

const filteredFeedbacks = computed(() => {
    const q = search.value.trim().toLowerCase()

    return props.feedbacks.filter(f => {
        const matchesTab = activeTab.value === 'All' || f.status === activeTab.value
        const matchesSearch = !q ||
            f.student_name.toLowerCase().includes(q) ||
            String(f.id).includes(q)

        return matchesTab && matchesSearch
    })
})

function initials(name) {
    return name.split(' ').map(n => n[0]).slice(0, 2).join('')
}

function statusStyle(status) {
    switch (status) {
        case 'Done':
            return 'bg-emerald-500/10 border-emerald-500/25 text-emerald-300'
        case 'New':
            return 'bg-[#6366F1]/10 border-[#6366F1]/25 text-[#A5B4FC]'
        case 'Unread':
            return 'bg-rose-500/10 border-rose-500/25 text-rose-300'
        default:
            return 'bg-white/5 border-white/10 text-gray-300'
    }
}
</script>
<template>
    <div class="w-full shrink-0 grid md:grid-cols-4 grid-cols-2 md:gap-5 gap-2 text-white md:mb-5">

        <!-- TOTAL USERS (violet) -->
        <div class="group flex items-center gap-3 sm:gap-4 p-4 sm:p-5 rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#CECBF6]/30 hover:bg-white/[0.05]">
            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl bg-[#8B5CF6]/15 ring-1 ring-[#8B5CF6]/20 transition-colors duration-200 group-hover:bg-[#8B5CF6]/25">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-[#B9A6F0]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-2xl font-bold leading-tight tabular-nums">{{ totalUser }}</span>
                <p class="text-xs font-medium text-white/45">Total users</p>
            </div>
        </div>

        <!-- TOTAL ADMINS (red) -->
        <div class="group flex items-center gap-3 sm:gap-4 p-4 sm:p-5 rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#CECBF6]/30 hover:bg-white/[0.05]">
            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl bg-[#E04A4A]/15 ring-1 ring-[#E04A4A]/20 transition-colors duration-200 group-hover:bg-[#E04A4A]/25">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-[#F09595]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-2xl font-bold leading-tight tabular-nums">{{ totalAdmins }}</span>
                <p class="text-xs font-medium text-white/45">Total admins</p>
            </div>
        </div>

        <!-- TOTAL SUBJECTS (cyan) -->
        <div class="group flex items-center gap-3 sm:gap-4 p-4 sm:p-5 rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#CECBF6]/30 hover:bg-white/[0.05]">
            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl bg-[#22D3EE]/15 ring-1 ring-[#22D3EE]/20 transition-colors duration-200 group-hover:bg-[#22D3EE]/25">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-[#7EE3F5]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-2xl font-bold leading-tight tabular-nums">{{ totalSubjects }}</span>
                <p class="text-xs font-medium text-white/45">Total subjects</p>
            </div>
        </div>

        <!-- TOTAL FEEDBACKS (indigo) -->
        <div class="group flex items-center gap-3 sm:gap-4 p-4 sm:p-5 rounded-2xl border border-[#CECBF6]/15 bg-white/[0.03] backdrop-blur-sm shadow-lg shadow-black/20 transition-all duration-200 hover:border-[#CECBF6]/30 hover:bg-white/[0.05]">
            <div class="flex items-center justify-center shrink-0 w-11 h-11 rounded-xl bg-[#6366F1]/15 ring-1 ring-[#6366F1]/20 transition-colors duration-200 group-hover:bg-[#6366F1]/25">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-[#A5A9F5]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                </svg>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-2xl font-bold leading-tight tabular-nums">{{ totalFeedbacks }}</span>
                <p class="text-xs font-medium text-white/45">Total feedbacks</p>
            </div>
        </div>

    </div>
</template>

<script setup>

const props = defineProps({
    totalUser: { type: Number, default: 0},
    totalSubjects:{ type:Number, default: 0},
    totalAdmins: { type:Number, default: 0},
    totalFeedbacks: { type: Number, default: 0}
})

</script>
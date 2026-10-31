<template>

    <header class="fixed top-0 shrink-0 z-100 w-full h-[60px] flex items-center justify-between text-white px-5 bg-[#44136D] border-b-[1.5px] border-b-[#CECBF6]/15 shadow-md shadow-black/20">
        <div class="flex items-center">
            <button
                type="button"
                @click="goBack"
                class="group inline-flex items-center gap-2 rounded-full border-[1.5px] border-[#CECBF6]/20 bg-[#CECBF6]/5 py-1.5 pl-2.5 pr-4 text-sm font-semibold text-[#CECBF6] transition-all duration-300 hover:border-[#CECBF6]/50 hover:bg-[#CECBF6]/10 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4 shrink-0 transition-transform duration-300 group-hover:-translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span class="hidden sm:inline">Back to Home</span>
                <span class="sm:hidden">Back</span>
            </button>
        </div>

        <div class="flex flex-col items-center justify-center min-w-0 px-2">
            <span class="font-bold text-base sm:text-xl leading-tight truncate max-w-[40vw] sm:max-w-none">
                {{ subjectName }}
            </span>
            <span class="hidden md:block text-[#CECBF6]/60 text-xs tracking-wide truncate">
                Work through each module in order. Pass a quiz to unlock the next one on the list.
            </span>
        </div>

        <button class="py-2 flex items-center justify-center">
            <span :class="[
                'rounded-full w-8 h-8 cursor-pointer flex items-center justify-center font-semibold text-md',
                profileColor
            ] ">
                {{ initials(userName) }}
            </span>
        </button>
    </header>

</template>

<script setup>

const props = defineProps({
  subjectName: { type: String, default: ''},
  userName: { type: String, required: true},
  profileColor: { type: String, required: true}
})

function goBack(){
    window.location.href = '/home';
}

function initials(name) {
    return name
        .split(' ')
        .filter(Boolean)
        .map(word => word[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}


</script>
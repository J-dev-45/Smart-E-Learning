<template>
    <div class="col-span-full w-full shrink-0 h-[60px]">

        <header class="fixed top-0 left-0 md:left-[280px] right-0 h-[60px] z-40 flex items-center justify-between gap-3 px-3 sm:px-5 sharedSurfaceBG border-b-[1.5px] sharedBorder shadow-md sharedShadow">

            <span class="text-base sm:text-lg font-extrabold tracking-wide leading-tight sharedTXT truncate min-w-0 block md:hidden">
                Smart E-Learning
            </span>

            <!-- AVATAR -->
            <div :class="[
                'ml-auto shrink-0 w-9 h-9 rounded-full sharedTXT flex items-center justify-center text-xs font-semibold',
                profileColor
            ]">
                {{ initials(userName) }}
            </div>

        </header>

    </div>
</template>

<script setup>

defineProps({
    userName: { type: String, default: '' },
    userEmail: { type: String, default: '' },
    profileColor: { type: String, default: '' },
})

function initials(name) {
    return String(name ?? '')
        .split(' ')
        .filter(Boolean)
        .map(part => part[0])
        .join('')
        .slice(0, 2)
        .toUpperCase()
}

</script>
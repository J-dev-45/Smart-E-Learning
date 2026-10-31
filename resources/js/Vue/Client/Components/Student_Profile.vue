<template>
    <div :class="[
        'w-40 h-40 rounded-full flex items-center justify-center ring-4 ring-white/10 shadow-xl shadow-black/30',
        profileColor
    ]">
        <span class="text-5xl font-semibold text-white tracking-wide">
            {{ initials(userName) }}
        </span>
    </div>
</template>

<script setup>

const props = defineProps({
    profileColor: { type: String, required: true},
    userName: { type: String, default: 'Student Name'},
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
<template>

    <nav class="bg-white w-full max-w-2xl h-[50px] fixed md:top-[15px] left-1/2 -translate-x-1/2 z-50 flex items-center justify-between md:px-4 px-6 md:rounded-full shadow-xs shadow-gray-200">
       

            <div class="font-bold text-[15px] tracking-tight">
                Smart <span class="text-blue-600">E-Learning</span>
            </div>

            <ul class="hidden md:flex items-center justify-center gap-4 text-[13px] font-semibold text-gray-600">

                <li>
                    <a
                        href="#hero"
                        class="relative transition-colors"
                        :class="activeSection === 'hero' ? 'text-blue-600' : 'hover:text-blue-600'"
                    >
                        Home
                    </a>
                </li>

                <li>
                    <a
                        href="#subjects"
                        class="relative transition-colors"
                        :class="activeSection === 'subjects' ? 'text-blue-600' : 'hover:text-blue-600'"
                    >
                        Subjects
                    </a>
                </li>

                <li>
                    <a
                        href="#code-playground"
                        class="relative transition-colors"
                        :class="activeSection === 'code-playground' ? 'text-blue-600' : 'hover:text-blue-600'"
                    >
                        Code
                    </a>
                </li>

                <li>
                    <a
                        href="#leaderboard"
                        class="relative transition-colors"
                        :class="activeSection === 'leaderboard' ? 'text-blue-600' : 'hover:text-blue-600'"
                    >
                        Leaderboard
                    </a>
                </li>

            </ul>

            <div class="relative">

                <button v-if="userMenu"
                    type="button"
                    @click="openUserMenu"
                    class="py-2"
                >
                    <span
                        class="rounded-full w-8 h-8 cursor-pointer flex items-center justify-center font-semibold text-md"
                        :class="profileColor"
                    >
                        {{ initials(userName) }}
                    </span>
                </button>

                <button
                    v-else
                    type="button"
                    @click="closeUserMenu"
                    class="py-2"
                >
                    <span
                        class="rounded-full w-8 h-8 cursor-pointer flex items-center justify-center font-semibold text-md"
                        :class="profileColor"
                    >
                        {{ initials(userName) }}
                    </span>
                </button>

                <User_Menu
                    :show-user-menu="showUserMenu"
                    :user-id="userId"
                    :user-name="userName"
                    :user-email="userEmail"
                    @close-user-menu="closeUserMenu"
                    :profile-color="profileColor"
                />

            </div>


    </nav>

    

</template>

<script setup>

import { ref, onMounted, onUnmounted } from 'vue'
import User_Menu from './User_Menu.vue'

const props = defineProps({
    userId: {
        type: Number,
        required: true
    },

    userName: {
        type: String,
        required: true
    },

    userEmail: {
        type: String,
        required: true
    },
    profileColor: { type: String, default: 'bg-purple-800 text-white'},
})


const showUserMenu = ref(false);
const userMenu = ref(true);
const activeSection = ref('hero');
let sectionObserver = null;

function initials(name) {
    return name
        .split(' ')
        .filter(Boolean)
        .map(word => word[0])
        .join('')
        .slice(0, 2)
        .toUpperCase()
}

function openUserMenu() {
    userMenu.value = false
    showUserMenu.value = true
}

function closeUserMenu() {
    userMenu.value = true
    showUserMenu.value = false
}

onMounted(() => {
    const sections = document.querySelectorAll('main section[id]')

    sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    activeSection.value = entry.target.id
                }
            })
        },
        { rootMargin: '-45% 0px -45% 0px', threshold: 0 }
    )

    sections.forEach((section) => sectionObserver.observe(section))
})

onUnmounted(() => {
    if (sectionObserver) sectionObserver.disconnect()
})

</script>
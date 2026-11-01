
<template>
    <nav
        class="bg-white w-full max-w-2xl h-[50px] fixed md:top-[15px] left-1/2 -translate-x-1/2 z-50 flex items-center justify-between md:px-4 px-6 md:rounded-full shadow-xs shadow-gray-200"
    >
        <div class="font-bold text-[15px] tracking-tight">
            Smart <span class="text-[#5b21b6]">E-Learning</span>
        </div>

        <ul class="hidden md:flex items-center justify-center gap-4 text-[13px] font-semibold text-gray-600">
            <li>
                <a
                    href="#hero"
                    class="relative transition-colors"
                    :class="activeSection === 'hero' ? 'text-[#5b21b6]' : 'hover:text-[#5b21b6]'"
                >
                    Home
                </a>
            </li>

            <li>
                <a
                    href="#subjects"
                    class="relative transition-colors"
                    :class="activeSection === 'subjects' ? 'text-[#5b21b6]' : 'hover:text-[#5b21b6]'"
                >
                    Subjects
                </a>
            </li>

            <li>
                <a
                    href="#code-playground"
                    class="relative transition-colors"
                    :class="activeSection === 'code-playground' ? 'text-[#5b21b6]' : 'hover:text-[#5b21b6]'"
                >
                    Code
                </a>
            </li>

            <li>
                <a
                    href="#leaderboard"
                    class="relative transition-colors"
                    :class="activeSection === 'leaderboard' ? 'text-[#5b21b6]' : 'hover:text-[#5b21b6]'"
                >
                    Leaderboard
                </a>
            </li>
        </ul>

        <div class="relative">
            <button
                v-if="userMenu"
                type="button"
                @click="openUserMenu"
                class="py-2"
            >
                <img
                    v-if="currentProfileImage"
                    :src="currentProfileImage"
                    alt="Profile picture"
                    class="rounded-full w-8 h-8 cursor-pointer object-cover ring-1 ring-gray-200"
                >

                <span
                    v-else
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
                <img
                    v-if="currentProfileImage"
                    :src="currentProfileImage"
                    alt="Profile picture"
                    class="rounded-full w-8 h-8 cursor-pointer object-cover ring-1 ring-gray-200"
                >

                <span
                    v-else
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
                :profile-color="profileColor"
                :profile-picture="profilePicture"
                :profile-avatar="profileAvatar"
                @close-user-menu="closeUserMenu"
            />
        </div>
    </nav>
</template>

<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue';
import User_Menu from './User_Menu.vue';

const props = defineProps({
    userId: { type: Number, required: true },
    userName: { type: String, required: true },
    userEmail: { type: String, required: true },
    profileColor: { type: String, default: 'bg-purple-800 text-white'},
    profilePicture: { type: String, default: '' },
    profileAvatar: { type: String, default: '' }
});

const showUserMenu = ref(false);
const userMenu = ref(true);
const activeSection = ref('hero');

const currentProfileImage = ref(
    props.profilePicture || props.profileAvatar || ''
);

let sectionObserver = null;

watch(
    () => [props.profilePicture, props.profileAvatar],
    ([picture, avatar]) => {
        currentProfileImage.value = picture || avatar || '';
    }
);

function initials(name) {
    return String(name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .map(word => word[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}

function openUserMenu() {
    userMenu.value = false;
    showUserMenu.value = true;
}

function closeUserMenu() {
    userMenu.value = true;
    showUserMenu.value = false;
}

function handleProfileUpdate(event) {
    const { type, imageUrl } = event.detail || {};

    if (!imageUrl) return;

    if (type === 'upload' || type === 'preset') {
        currentProfileImage.value = imageUrl;
    }
}

onMounted(() => {
    window.addEventListener('profile-updated', handleProfileUpdate);

    const sections = document.querySelectorAll('main section[id]');

    sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    activeSection.value = entry.target.id;
                }
            });
        },
        {
            rootMargin: '-45% 0px -45% 0px',
            threshold: 0
        }
    );

    sections.forEach((section) => {
        sectionObserver.observe(section);
    });
});

onUnmounted(() => {
    window.removeEventListener('profile-updated', handleProfileUpdate);

    if (sectionObserver) {
        sectionObserver.disconnect();
    }
});
</script>

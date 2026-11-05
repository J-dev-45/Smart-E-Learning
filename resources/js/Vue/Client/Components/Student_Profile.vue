<template>
    <div class="relative w-40 h-40">

        <img
            v-if="currentProfileImage"
            :src="currentProfileImage"
            alt="Profile picture"
            class="w-40 h-40 rounded-full object-cover ring-4 sharedRingSoft shadow-xl sharedShadow"
        >

        <div
            v-else
            :class="[
                'w-40 h-40 rounded-full flex items-center justify-center ring-4 sharedRingSoft shadow-xl sharedShadow',
                profileColor
            ]"
        >
            <span class="text-5xl font-semibold sharedTXT tracking-wide">
                {{ initials(userName) }}
            </span>
        </div>

        <button
            type="button"
            aria-label="Change profile picture"
            @click="showUpdateProfile"
            class="absolute bottom-2 right-2 flex items-center justify-center w-7 h-7 rounded-full sharedBtn hover:scale-105 ring-2 sharedRingBG shadow-lg sharedShadow cursor-pointer transition duration-200 outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 sharedFocus"
        >
            <svg
                class="w-3.5 h-3.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                />
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"
                />
            </svg>
        </button>

    </div>

    <Update_Profile
        :show-update-profile="showModal"
        :current-image="currentProfileImage"
        :profile-color="profileColor"
        :user-name="userName"
        :avatar1="avatar1"
        :avatar2="avatar2"
        :avatar3="avatar3"
        :avatar4="avatar4"
        :avatar5="avatar5"
        :avatar6="avatar6"
        :avatar7="avatar7"
        :avatar8="avatar8"
        :avatar9="avatar9"
        :avatar10="avatar10"
        @close="showModal = false"
        @save="onSave"
    />
</template>

<script setup>
import { ref } from 'vue';
import Update_Profile from '../Modals/Update_Profile.vue';


const props = defineProps({
    profileColor: {
        type: String,
        default: null
    },
    profilePicture: {
        type: String,
        default: ''
    },
    profileAvatar: {
        type: String,
        default: ''
    },
    userName: {
        type: String,
        default: 'Student Name'
    },
    avatar1: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_1.jpg'
    },
    avatar2: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_2.jpg'
    },
    avatar3: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_3.jpg'
    },
    avatar4: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_4.jpg'
    },
    avatar5: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_5.jpg'
    },
    avatar6: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_6.jpg'
    },
    avatar7: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_7.jpg'
    },
    avatar8: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_8.jpg'
    },
    avatar9: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_9.jpg'
    },
    avatar10: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_10.jpg'
    }
});

const showModal = ref(false);

const currentProfileImage = ref(
    props.profilePicture || props.profileAvatar || ''
);

function showUpdateProfile() {
    showModal.value = true;
}

function onSave(data) {
    const imageUrl = data?.url || data?.avatar || '';

    if (imageUrl) {
        currentProfileImage.value = imageUrl;

        window.dispatchEvent(
            new CustomEvent('profile-updated', {
                detail: {
                    type: data.type,
                    imageUrl: imageUrl
                }
            })
        );
    }

    showModal.value = false;
}

function initials(name) {
    return String(name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .map(part => part[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}
</script>
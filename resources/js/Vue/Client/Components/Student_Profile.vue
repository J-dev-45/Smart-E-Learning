<template>
    <div class="relative w-40 h-40" :aria-busy="showSkeleton">

        <div
            v-if="showSkeleton"
            class="absolute inset-0 rounded-full ring-4 sharedRingSoft skeleton-shimmer"
            aria-hidden="true"
        ></div>

        <template v-if="currentProfileImage">
            <img
                ref="imgEl"
                :src="currentProfileImage"
                alt="Profile picture"
                decoding="async"
                :class="[
                    'w-40 h-40 rounded-full object-cover ring-4 sharedRingSoft shadow-xl sharedShadow transition-opacity duration-300',
                    showSkeleton ? 'opacity-0' : 'opacity-100'
                ]"
                @load="imageLoading = false"
                @error="onImageError"
            >
        </template>

        <div
            v-else-if="!showSkeleton"
            role="img"
            :aria-label="`${userName} profile picture`"
            :class="[
                'w-40 h-40 rounded-full flex items-center justify-center ring-4 sharedRingSoft shadow-xl sharedShadow',
                profileColor
            ]"
        >
            <span class="text-5xl font-semibold sharedTXT tracking-wide" aria-hidden="true">
                {{ userInitials }}
            </span>
        </div>

        <button
            type="button"
            aria-label="Change profile picture"
            @click="showModal = true"
            class="absolute bottom-2 right-2 flex items-center justify-center w-8 h-8 rounded-full sharedBtn hover:scale-105 ring-2 sharedRingBG shadow-lg sharedShadow cursor-pointer transition duration-200 outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 sharedFocus"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true" >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
            </svg>
        </button>

    </div>

    <Update_Profile
        :show-update-profile="showModal"
        :current-image="currentProfileImage"
        :profile-color="profileColor"
        :user-name="userName"
        v-bind="avatarProps"
        @close="showModal = false"
        @save="onSave"
    />
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
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
    loading: {
        type: Boolean,
        default: false
    },
    avatars: {
        type: Array,
        default: () => Array.from(
            { length: 10 },
            (_, i) => `/images/Profile_Avatars/Avatar_${i + 1}.jpg`
        )
    }
});

const showModal = ref(false);
const imgEl = ref(null);

const currentProfileImage = ref(
    props.profilePicture || props.profileAvatar || ''
);
const imageLoading = ref(!!currentProfileImage.value);

const pageReady = ref(typeof document === 'undefined' || document.readyState === 'complete');

const showSkeleton = computed(() =>
    props.loading ||
    !pageReady.value ||
    (!!currentProfileImage.value && imageLoading.value)
);

const avatarProps = computed(() =>
    Object.fromEntries(
        props.avatars.map((src, i) => [`avatar${i + 1}`, src])
    )
);

const userInitials = computed(() =>
    String(props.userName ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .map(part => part[0])
        .join('')
        .slice(0, 2)
        .toUpperCase()
);

watch(
    () => [props.profilePicture, props.profileAvatar],
    ([picture, avatar]) => {
        currentProfileImage.value = picture || avatar || '';
    }
);

watch(currentProfileImage, (val) => {
    imageLoading.value = !!val;
});

onMounted(() => {
    if (!pageReady.value) {
        window.addEventListener('load', () => { pageReady.value = true; }, { once: true });
    }

    if (imgEl.value?.complete && imgEl.value.naturalWidth > 0) {
        imageLoading.value = false;
    }
});

function onImageError() {
    imageLoading.value = false;
    currentProfileImage.value = '';
}

function onSave(data) {
    const imageUrl = data?.url || data?.avatar || '';

    if (imageUrl) {
        currentProfileImage.value = imageUrl;

        window.dispatchEvent(
            new CustomEvent('profile-updated', {
                detail: {
                    type: data.type,
                    imageUrl
                }
            })
        );
    }

    showModal.value = false;
}
</script>

<style scoped>
.skeleton-shimmer {
    position: absolute;
    overflow: hidden;
    background-color: rgba(148, 163, 184, 0.25);
}

.skeleton-shimmer::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: linear-gradient(
        100deg,
        transparent 20%,
        rgba(255, 255, 255, 0.45) 50%,
        transparent 80%
    );
    transform: translateX(-100%);
    animation: shimmer 1.4s ease-in-out infinite;
}

@keyframes shimmer {
    to { transform: translateX(100%); }
}

@media (prefers-reduced-motion: reduce) {
    .skeleton-shimmer::after {
        animation: none;
    }
}
</style>
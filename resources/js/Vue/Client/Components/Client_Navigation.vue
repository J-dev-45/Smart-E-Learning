<template>
    <nav
        class="sharedNavBG w-full h-[56px] fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6 md:px-10 shadow-xs sharedNavShadow"
    >
        <div class="font-bold text-[15px] tracking-tight sharedTXTBrand">
            Smart E-Learning
        </div>

        <ul class="hidden md:flex items-center justify-center gap-6 text-[13px] font-semibold sharedNavText md:absolute md:left-1/2 md:-translate-x-1/2">
            <li>
                <a
                    href="#hero"
                    class="relative transition-colors"
                    :class="activeSection === 'hero' ? 'sharedTXTBrand sharedNavActive' : 'sharedHoverBrand'"
                >
                    Home
                </a>
            </li>

            <li>
                <a
                    href="#subjects"
                    class="relative transition-colors"
                    :class="activeSection === 'subjects' ? 'sharedTXTBrand sharedNavActive' : 'sharedHoverBrand'"
                >
                    Subjects
                </a>
            </li>

            <li>
                <a
                    href="#code-playground"
                    class="relative transition-colors"
                    :class="activeSection === 'code-playground' ? 'sharedTXTBrand sharedNavActive' : 'sharedHoverBrand'"
                >
                    Code
                </a>
            </li>

            <li>
                <a
                    href="#leaderboard"
                    class="relative transition-colors"
                    :class="activeSection === 'leaderboard' ? 'sharedTXTBrand sharedNavActive' : 'sharedHoverBrand'"
                >
                    Leaderboard
                </a>
            </li>
        </ul>

        <div class="relative">
            <button
                type="button"
                @click.stop="toggleUserMenu"
                class="py-2"
                aria-label="Toggle user menu"
                :aria-expanded="showUserMenu"
                :aria-busy="showSkeleton"
            >
                <span
                    v-if="showSkeleton"
                    class="block rounded-full w-8 h-8 skeleton-shimmer"
                    aria-hidden="true"
                ></span>

                <img
                    v-if="currentProfileImage"
                    v-show="!showSkeleton"
                    ref="imgEl"
                    :src="currentProfileImage"
                    alt="Profile picture"
                    class="rounded-full w-8 h-8 cursor-pointer object-cover ring-1 sharedNavRing"
                    @load="imageLoading = false"
                    @error="onImageError"
                >

                <span
                    v-else-if="!showSkeleton"
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
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import User_Menu from './User_Menu.vue'

const props = defineProps({
    userId: { type: Number, required: true },
    userName: { type: String, required: true },
    userEmail: { type: String, required: true },
    profileColor: { type: String, default: 'sharedBtn' },
    profilePicture: { type: String, default: '' },
    profileAvatar: { type: String, default: '' }
})

const showUserMenu = ref(false)
const activeSection = ref('hero')
const imgEl = ref(null)

const currentProfileImage = ref(
    props.profilePicture || props.profileAvatar || ''
)
const imageLoading = ref(!!currentProfileImage.value)

const pageReady = ref(false)


const MIN_SKELETON_MS = 700

const showSkeleton = computed(() =>
    !pageReady.value ||
    (!!currentProfileImage.value && imageLoading.value)
)

let sectionObserver = null
let readyTimer = null

function markReady() {
    const remaining = Math.max(0, MIN_SKELETON_MS - performance.now())
    readyTimer = setTimeout(() => { pageReady.value = true }, remaining)
}

watch(
    () => [props.profilePicture, props.profileAvatar],
    ([picture, avatar]) => {
        currentProfileImage.value = picture || avatar || ''
    }
)

watch(currentProfileImage, (val) => {
    imageLoading.value = !!val
})

function onImageError() {
    imageLoading.value = false
    currentProfileImage.value = ''
}

function initials(name) {
    return String(name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .map(word => word[0])
        .join('')
        .slice(0, 2)
        .toUpperCase()
}

function toggleUserMenu() {
    showUserMenu.value = !showUserMenu.value
}

function closeUserMenu() {
    showUserMenu.value = false
}

function handleProfileUpdate(event) {
    const { type, imageUrl } = event.detail || {}

    if (!imageUrl) return

    if (type === 'upload' || type === 'preset') {
        currentProfileImage.value = imageUrl
    }
}

onMounted(() => {
    window.addEventListener('profile-updated', handleProfileUpdate)

    if (document.readyState === 'complete') {
        markReady()
    } else {
        window.addEventListener('load', markReady, { once: true })
    }

    if (imgEl.value?.complete && imgEl.value.naturalWidth > 0) {
        imageLoading.value = false
    }

    const sections = document.querySelectorAll('main section[id]')

    sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    activeSection.value = entry.target.id
                }
            })
        },
        {
            rootMargin: '-45% 0px -45% 0px',
            threshold: 0
        }
    )

    sections.forEach((section) => {
        sectionObserver.observe(section)
    })
})

onUnmounted(() => {
    window.removeEventListener('profile-updated', handleProfileUpdate)
    window.removeEventListener('load', markReady)
    clearTimeout(readyTimer)

    if (sectionObserver) {
        sectionObserver.disconnect()
    }
})
</script>

<style scoped>
.skeleton-shimmer {
    position: relative;
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
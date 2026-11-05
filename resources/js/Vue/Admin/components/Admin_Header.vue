<template>
    <div class="col-span-full w-full shrink-0 h-[60px]">

        <header class="fixed top-0 left-0 md:left-[280px] right-0 h-[60px] z-40 flex items-center justify-between gap-3 px-3 sm:px-5 sharedSurfaceBG border-b-[1.5px] sharedBorder shadow-md sharedShadow">

            <span class="text-base sm:text-lg font-extrabold tracking-wide leading-tight sharedTXT truncate min-w-0 block md:hidden">
                Smart E-Learning
            </span>

            <div class="ml-auto flex items-center gap-3 shrink-0">

                <!-- PROFILE (mobile + desktop, the only clickable element) -->
                <button
                    type="button"
                    @click.stop="toggleUserMenu"
                    aria-label="Open admin menu"
                    aria-haspopup="menu"
                    :aria-expanded="showUserMenu"
                    :class="[
                        'shrink-0 w-9 h-9 rounded-full sharedTXT flex items-center justify-center text-xs font-semibold cursor-pointer focus:outline-none focus:ring-1 focus:ring-gray-300',
                        profileColor
                    ]"
                >
                    {{ initials(userName) }}
                </button>

            </div>

        </header>

        <Admin_Menu
            :show-admin-menu="showUserMenu"
            :user-name="userName"
            :user-email="userEmail"
            :profile-color="profileColor"
            :profile-picture="profilePicture"
            :profile-avatar="profileAvatar"
            @close-admin-menu="showUserMenu = false"
        />

    </div>
</template>

<script setup>
import { ref } from 'vue'
import Admin_Menu from '../Pages/Admin_Menu.vue'

defineProps({
    userName: { type: String, default: '' },
    userEmail: { type: String, default: '' },
    profileColor: { type: String, default: '' },
    profilePicture: { type: String, default: '' },
    profileAvatar: { type: String, default: '' },
})

const showUserMenu = ref(false)

function toggleUserMenu() {
    showUserMenu.value = !showUserMenu.value
}

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
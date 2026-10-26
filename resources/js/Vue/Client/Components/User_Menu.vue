
<template>
    <Transition
        enter-active-class="transition ease-out duration-150"
        enter-from-class="opacity-0 scale-95 -translate-y-1"
        enter-to-class="opacity-100 scale-100 translate-y-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
    >
        <div
            v-if="showUserMenu"
            class="w-[290px] fixed md:top-3 top-[55px] right-0 z-[100] p-3 flex flex-col bg-white rounded-xl shadow-lg ring-1 ring-black/5 gap-3"
        >
            <div class="w-full flex items-center gap-3 px-1">
                <div
                    class="w-11 h-11 shrink-0 rounded-full flex items-center justify-center font-semibold text-sm"
                    :class="profileColor"
                >
                    {{ initials }}
                </div>

                <div class="flex flex-col leading-tight justify-center min-w-0 flex-1">
                    <span class="font-semibold text-sm text-gray-900 truncate">
                        {{ userName }}
                    </span>
                    <span class="text-xs text-gray-400 truncate">
                        {{ userEmail }}
                    </span>
                </div>

                <button
                    type="button"
                    @click="closeMenu"
                    :disabled="isLoggingOut"
                    aria-label="Close menu"
                    class="w-7 h-7 shrink-0 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <div class="h-px bg-gray-100" />

            <div class="flex flex-col gap-1">
                <button
                    type="button"
                    class="px-3 py-2 text-sm text-gray-700 rounded-lg flex items-center gap-2.5 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors cursor-pointer"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4.5 text-gray-500 shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"
                        />
                    </svg>
                    <span>Change Password</span>
                </button>

                <button
                    type="button"
                    @click="openFeedback"
                    class="px-3 py-2 text-sm text-gray-700 rounded-lg flex items-center gap-2.5 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors cursor-pointer"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4.5 text-gray-500 shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"
                        />
                    </svg>
                    <span>Feedback</span>
                </button>
            </div>

            <div class="h-px bg-gray-100" />

            <div class="flex flex-col gap-1">
                <button
                    type="button"
                    @click="logout"
                    :disabled="isLoggingOut"
                    :aria-busy="isLoggingOut"
                    class="px-3 py-2 text-sm text-red-500 rounded-lg flex items-center gap-2.5 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-100 transition-colors cursor-pointer disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:bg-transparent"
                >
                    <svg
                        v-if="isLoggingOut"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="size-4.5 shrink-0 animate-spin motion-reduce:animate-none"
                        aria-hidden="true"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke="currentColor"
                            stroke-width="2.5"
                            class="opacity-25"
                        />
                        <path
                            d="M21 12a9 9 0 0 0-9-9"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                        />
                    </svg>

                    <svg
                        v-else
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4.5 shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"
                        />
                    </svg>

                    <span>{{ isLoggingOut ? 'Logging out...' : 'Log out' }}</span>
                </button>
            </div>
        </div>
    </Transition>

    <Feedback_Form
        :show-feedback="showFeedback"
        :user-id="props.userId"
        :user-name="props.userName"
        @close="showFeedback = false"
    />
</template>

<script setup>
import { ref, computed } from 'vue'
import Feedback_Form from './Feedback_Form.vue'

const props = defineProps({
    showUserMenu: { type: Boolean, default: true },
    userId: { type: Number, required: true },
    userName: { type: String, required: true },
    userEmail: { type: String, required: true },
    profileColor: { type: String, default: 'bg-purple-800 text-white' }
})

const isLoggingOut = ref(false)
const showFeedback = ref(false)

const initials = computed(() =>
    props.userName
        .split(' ')
        .filter(Boolean)
        .map(n => n[0])
        .join('')
        .slice(0, 2)
        .toUpperCase()
)

const emit = defineEmits(['close-user-menu'])

function closeMenu() {
    emit('close-user-menu')
}

function openFeedback() {
    showFeedback.value = true
    closeMenu()
}

async function logoutForm() {
    isLoggingOut.value = true

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')

    if (!csrfToken) {
        isLoggingOut.value = false
        throw new Error('CSRF token not found')
    }

    try {
        const response = await fetch('/logout_student', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })

        if (!response.ok) {
            throw new Error(`Logout failed: ${response.status}`)
        }

        window.location.href = '/'

    } catch (error) {
        isLoggingOut.value = false
        throw error
    }
}

async function logout() {
    try {
        await logoutForm()
    } catch (error) {
        console.error(error)
    }
}
</script>

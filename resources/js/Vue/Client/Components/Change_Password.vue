<template>
    <Teleport to="body">
        <Transition name="modal-fade">
            <div
                v-if="showChangePassword"
                id="change-password"
                class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[999] flex items-center justify-center p-4"
            >
                <Transition name="modal-pop" appear>
                    <div
                        class="relative w-[30%] min-w-[380px] max-w-[440px] bg-white rounded-2xl shadow-2xl shadow-black/30 ring-1 ring-black/5 flex flex-col p-6"
                    >
                        <!-- CLOSE BUTTON -->
                        <button
                            type="button"
                            @click="closeModal"
                            aria-label="Close"
                            class="absolute right-4 top-4 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <form @submit.prevent class="w-full flex flex-col gap-5">
                            <!-- HEADER -->
                            <div class="w-full flex items-start gap-3 pr-6">
                                <div class="shrink-0 w-10 h-10 rounded-lg bg-[#8B5CF6]/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                    </svg>
                                </div>

                                <div class="flex flex-col gap-0.5">
                                    <span class="text-lg font-semibold text-gray-900 leading-tight">
                                        Change Password
                                    </span>

                                    <span class="text-sm text-gray-500">
                                        Keep your account secure.
                                    </span>
                                </div>
                            </div>

                            <!-- OLD PASSWORD -->
                            <div class="w-full flex flex-col gap-1.5">
                                <label for="old_password" class="text-sm font-medium text-gray-700">
                                    Old Password
                                </label>

                                <div class="relative w-full">
                                    <input
                                        id="old_password"
                                        :type="showOldPassword ? 'text' : 'password'"
                                        v-model="old_password"
                                        placeholder="Enter your old password"
                                        autocomplete="current-password"
                                        class="w-full pl-3 pr-10 py-2.5 text-black/70 text-sm outline-none border border-gray-300 bg-gray-50 rounded-lg
                                        placeholder:text-gray-400 transition-all duration-150
                                        hover:border-gray-400 focus:bg-white focus:border-[#8B5CF6] focus:ring-4 focus:ring-[#8B5CF6]/15"
                                    />

                                    <button
                                        type="button"
                                        @click="showOldPassword = !showOldPassword"
                                        :aria-label="showOldPassword ? 'Hide password' : 'Show password'"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer"
                                    >
                                        <svg v-if="!showOldPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                        </svg>

                                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                            <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                            <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- NEW PASSWORD -->
                            <div class="w-full flex flex-col gap-1.5">
                                <label for="new_password" class="text-sm font-medium text-gray-700">
                                    New Password
                                </label>

                                <div class="relative w-full">
                                    <input
                                        id="new_password"
                                        :type="showNewPassword ? 'text' : 'password'"
                                        v-model="new_password"
                                        placeholder="Enter your new password"
                                        autocomplete="new-password"
                                        class="w-full pl-3 pr-10 py-2.5 text-black/70 text-sm outline-none border border-gray-300 bg-gray-50 rounded-lg
                                        placeholder:text-gray-400 transition-all duration-150
                                        hover:border-gray-400 focus:bg-white focus:border-[#8B5CF6] focus:ring-4 focus:ring-[#8B5CF6]/15"
                                    />

                                    <button
                                        type="button"
                                        @click="showNewPassword = !showNewPassword"
                                        :aria-label="showNewPassword ? 'Hide password' : 'Show password'"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer"
                                    >
                                        <svg v-if="!showNewPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                        </svg>

                                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                            <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                            <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Password length hint -->
                                <p
                                    class="flex items-center gap-1.5 text-xs m-0 transition-all duration-200"
                                    :class="new_password.length === 0 ? 'text-gray-500' : (new_password.length < 8 ? 'text-red-500' : 'text-green-600')"
                                >
                                    <svg v-if="new_password.length >= 8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.169 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                    {{ new_password.length >= 8 ? 'Good password length' : `Password must be at least 8 characters (${new_password.length}/8)` }}
                                </p>
                            </div>

                            <!-- CONFIRM PASSWORD -->
                            <div class="w-full flex flex-col gap-1.5">
                                <label for="confirm_password" class="text-sm font-medium text-gray-700">
                                    Confirm Password
                                </label>

                                <div class="relative w-full">
                                    <input
                                        id="confirm_password"
                                        :type="showConfirmPassword ? 'text' : 'password'"
                                        v-model="confirm_password"
                                        placeholder="Re-enter your new password"
                                        autocomplete="new-password"
                                        class="w-full pl-3 pr-10 py-2.5 text-black/70 text-sm outline-none border border-gray-300 bg-gray-50 rounded-lg
                                        placeholder:text-gray-400 transition-all duration-150
                                        hover:border-gray-400 focus:bg-white focus:border-[#8B5CF6] focus:ring-4 focus:ring-[#8B5CF6]/15"
                                    />

                                    <button
                                        type="button"
                                        @click="showConfirmPassword = !showConfirmPassword"
                                        :aria-label="showConfirmPassword ? 'Hide password' : 'Show password'"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer"
                                    >
                                        <svg v-if="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                        </svg>

                                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                            <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                            <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Confirm password match hint -->
                                <p
                                    v-if="confirm_password.length > 0"
                                    class="flex items-center gap-1.5 text-xs m-0 transition-all duration-200"
                                    :class="new_password === confirm_password ? 'text-green-600' : 'text-red-500'"
                                >
                                    <svg v-if="new_password === confirm_password" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.169 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                    {{ new_password === confirm_password ? 'Passwords match' : "Passwords don't match" }}
                                </p>
                            </div>

                            <!-- BUTTONS -->
                            <div class="w-full flex gap-3 mt-1">
                                <button
                                    type="button"
                                    @click="closeModal"
                                    class="w-1/3 py-2.5 rounded-lg text-sm font-medium text-gray-600 border border-gray-300
                                    hover:bg-gray-100 hover:border-gray-400 active:bg-gray-200 transition-colors cursor-pointer"
                                >
                                    Cancel
                                </button>

                                <button
                                    type="submit"
                                    :disabled="!canSubmit"
                                    class="w-2/3 py-2.5 rounded-lg text-sm font-medium text-white bg-[#8B5CF6]
                                    shadow-sm shadow-[#8B5CF6]/30
                                    hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer
                                    disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#8B5CF6]
                                    flex items-center justify-center gap-1.5"
                                >
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
    showChangePassword: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['close'])

const old_password = ref('')
const new_password = ref('')
const confirm_password = ref('')

const showOldPassword = ref(false)
const showNewPassword = ref(false)
const showConfirmPassword = ref(false)

const canSubmit = computed(() =>
    old_password.value.length > 0 &&
    new_password.value.length >= 8 &&
    new_password.value === confirm_password.value
)

// Reset to a fresh form every time the modal opens
watch(
    () => props.showChangePassword,
    (open) => {
        if (!open) return
        old_password.value = ''
        new_password.value = ''
        confirm_password.value = ''
        showOldPassword.value = false
        showNewPassword.value = false
        showConfirmPassword.value = false
    }
)

function closeModal() {
    emit('close')
}
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.15s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}

.modal-pop-enter-active {
    transition: opacity 0.15s ease, transform 0.15s ease;
}

.modal-pop-enter-from {
    opacity: 0;
    transform: scale(0.96) translateY(4px);
}
</style>
<template>
    <div class="w-full min-h-screen md:h-screen md:min-h-0 flex flex-col md:flex-row sharedBG">

        <!-- DESKTOP BRANDING PANEL -->
        <div class="hidden md:flex w-1/2 h-full flex-col items-center justify-center sharedTXT px-8 gap-3">
            <img :src="logo" alt="Smart E-Learning Logo"
                class="object-contain drop-shadow-2xl"
                style="width:clamp(100px,13vw,190px); height:clamp(90px,11vw,170px)">

            <div class="text-center">
                <h1 class="font-bold m-0 leading-none tracking-wide"
                    style="font-size:clamp(1.5rem,4vw,3rem)">
                    Smart E-Learning
                </h1>
            </div>

            <div class="sharedBGAccent rounded-full"
                style="width:clamp(60px,7vw,110px); height:4px"></div>

            <div class="text-center">
                <h5 class="font-semibold m-0 leading-none sharedTXTMuted"
                    style="font-size:clamp(0.8rem,1.4vw,1.15rem)">
                    Review Smarter, Quiz Better.
                </h5>
                <h6 class="font-medium m-0 mt-2 leading-none sharedTXTMuted"
                    style="font-size:clamp(0.65rem,0.9vw,0.8rem)">
                    Information Technology & Computer Related Course
                </h6>
            </div>
        </div>

        <!-- REGISTRATION PANEL -->
        <div class="custom-scroll w-full md:w-1/2 md:h-full flex items-center justify-center md:justify-start px-5 md:px-8 lg:px-16 py-6 md:py-8 overflow-y-auto">

            <form @submit.prevent="registerForm"
                class="w-full max-w-[460px] sharedLightBG border-[1.5px] sharedBorderLight rounded-3xl shadow-2xl flex flex-col px-[clamp(1.25rem,3vw,2.5rem)] py-[clamp(1.25rem,3.5vh,2.25rem)] my-auto">

                <!-- MOBILE BRAND ROW -->
                <div class="md:hidden flex items-center gap-3 mb-[clamp(1rem,3dvh,1.6rem)]">
                    <img :src="logo" alt="Smart E-Learning Logo" class="size-11 shrink-0 object-contain">
                    <span class="font-extrabold sharedTXTBrand tracking-wide leading-tight"
                        style="font-size:clamp(1.05rem,2.6dvh,1.35rem)">
                        Smart E-Learning
                    </span>
                </div>

                <!-- HEADING -->
                <h4 class="font-bold m-0 sharedTXTOnLight tracking-wide"
                    style="font-size:clamp(1.2rem,2.2vw,1.75rem)">
                    <span class="md:hidden">CREATE ACCOUNT</span>
                    <span class="hidden md:inline">Create Account</span>
                </h4>

                <p class="sharedTXTLightMuted mt-1.5 mb-[clamp(0.8rem,2.5vh,1.75rem)] text-sm">
                    <span class="md:hidden">
                        Create your account now to review and ace your entrance exam.
                    </span>
                    <span class="hidden md:inline">
                        Create your account now to review and enhance your knowledge.
                    </span>
                </p>

                <!-- ERRORS -->
                <div v-if="registerErrors.length" class="mb-2">
                    <p v-for="(error, index) in registerErrors" :key="index"
                        class="sharedTXTDanger text-sm w-full flex items-center justify-center text-center py-1">
                        {{ error }}
                    </p>
                </div>

                <div class="flex flex-col gap-[clamp(0.5rem,1.8vh,0.9rem)]">

                    <!-- STUDENT ID NUMBER -->
                    <div class="flex flex-col gap-1.5">
                        <label for="register-id-number" class="ps-2 font-semibold sharedTXTOnLight text-sm">
                            Student ID Number
                        </label>
                        <input id="register-id-number" type="text" name="id_number"
                            placeholder="e.g. 2023-00001"
                            v-model="id_number"
                            autocomplete="off"
                            required
                            class="sharedInput border-[1.5px] rounded-full px-5 outline-none text-base md:text-sm w-full transition-all duration-200"
                            style="height:clamp(44px,5.5vh,56px)">
                    </div>

                    <!-- FULL NAME -->
                    <div class="flex flex-col gap-1.5">
                        <label for="register-name" class="ps-2 font-semibold sharedTXTOnLight text-sm">
                            First Name and Last Name
                        </label>
                        <input id="register-name" type="text" name="name"
                            placeholder="First Name and Last Name"
                            v-model="name"
                            autocomplete="name"
                            required
                            class="sharedInput border-[1.5px] rounded-full px-5 outline-none text-base md:text-sm w-full transition-all duration-200"
                            style="height:clamp(44px,5.5vh,56px)">
                    </div>

                    <!-- EMAIL -->
                    <div class="flex flex-col gap-1.5">
                        <label for="register-email" class="ps-2 font-semibold sharedTXTOnLight text-sm">
                            Email
                        </label>
                        <input id="register-email" type="email" name="email"
                            placeholder="example@gmail.com"
                            v-model="email"
                            autocomplete="email"
                            autocapitalize="none"
                            autocorrect="off"
                            spellcheck="false"
                            inputmode="email"
                            required
                            class="sharedInput border-[1.5px] rounded-full px-5 outline-none text-base md:text-sm w-full transition-all duration-200"
                            style="height:clamp(44px,5.5vh,56px)">
                    </div>

                    <!-- PASSWORD -->
                    <div class="flex flex-col gap-1.5">
                        <label for="register-password" class="ps-2 font-semibold sharedTXTOnLight text-sm">
                            Password
                        </label>

                        <div class="relative">
                            <input id="register-password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                placeholder="••••••••"
                                v-model="password"
                                autocomplete="new-password"
                                autocapitalize="none"
                                autocorrect="off"
                                spellcheck="false"
                                required
                                class="h-12 text-base select-text [&::-ms-reveal]:hidden [&::-ms-clear]:hidden [&::-webkit-credentials-auto-fill-button]:hidden sharedInput border-[1.5px] rounded-full ps-5 pe-12 outline-none w-full transition-all duration-200"
                                style="height:clamp(44px,5.5vh,56px)">

                            <button type="button" @mousedown.prevent
                                @click="showPassword = !showPassword"
                                :aria-label="showPassword ? 'Hide password' : 'Show password'"
                                :aria-pressed="showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 sharedTXTLightFaint z-10 cursor-pointer touch-manipulation">
                                <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd"/>
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z"/>
                                    <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z"/>
                                    <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- PASSWORD STRENGTH -->
                    <div class="min-h-[1.25rem] ps-2 -mt-1">
                        <p class="flex items-center gap-1.5 text-xs m-0 transition-all duration-200"
                            :class="password.length === 0 ? 'sharedTXTLightFaint' : (password.length < 8 ? 'sharedTXTDanger' : 'sharedTXTLightSuccess')">
                            <svg v-if="password.length >= 8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.169 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
                            </svg>
                            {{ password.length >= 8 ? 'Good password length' : `Password must be at least 8 characters (${password.length}/8)` }}
                        </p>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="flex flex-col gap-1.5">
                        <label for="register-password-confirmation" class="ps-2 font-semibold sharedTXTOnLight text-sm">
                            Confirm Password
                        </label>

                        <div class="relative">
                            <input id="register-password-confirmation"
                                :type="showConfirmPassword ? 'text' : 'password'"
                                name="password_confirmation"
                                placeholder="••••••••"
                                v-model="password_confirmation"
                                autocomplete="new-password"
                                autocapitalize="none"
                                autocorrect="off"
                                spellcheck="false"
                                required
                                class="h-12 text-base select-text [&::-ms-reveal]:hidden [&::-ms-clear]:hidden [&::-webkit-credentials-auto-fill-button]:hidden sharedInput border-[1.5px] rounded-full ps-5 pe-12 outline-none w-full transition-all duration-200"
                                style="height:clamp(44px,5.5vh,56px)">

                            <button type="button" @mousedown.prevent
                                @click="showConfirmPassword = !showConfirmPassword"
                                :aria-label="showConfirmPassword ? 'Hide password' : 'Show password'"
                                :aria-pressed="showConfirmPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 sharedTXTLightFaint z-10 cursor-pointer touch-manipulation">
                                <svg v-if="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd"/>
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z"/>
                                    <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z"/>
                                    <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- PASSWORD MATCH -->
                    <div class="min-h-[1.25rem] ps-2 -mt-1">
                        <p v-if="password_confirmation.length > 0"
                            class="flex items-center gap-1.5 text-xs m-0 transition-all duration-200"
                            :class="password === password_confirmation ? 'sharedTXTLightSuccess' : 'sharedTXTDanger'">
                            <svg v-if="password === password_confirmation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.169 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
                            </svg>
                            {{ password === password_confirmation ? 'Passwords match' : "Passwords don't match" }}
                        </p>
                    </div>
                </div>

                <!-- SUBMIT -->
                <button type="submit"
                    :disabled="isSubmitting || password.length < 8 || password !== password_confirmation"
                    class="w-full sharedBtn disabled:opacity-50 disabled:cursor-not-allowed font-bold rounded-full cursor-pointer shadow-md hover:shadow-xl tracking-wide transition-all duration-200 mt-6 flex items-center justify-center gap-2 touch-manipulation"
                    style="height:clamp(46px,5.5vh,58px); font-size:clamp(0.95rem,1.5vw,1.15rem)">
                    <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                    </svg>
                    <span>{{ isSubmitting ? 'Creating Account...' : 'Create Account' }}</span>
                </button>

                <!-- LOGIN LINK -->
                <div class="flex justify-center items-center gap-2 text-sm mt-[clamp(0.75rem,2vh,1.25rem)]">
                    <span class="sharedTXTLightMuted">Already have an account?</span>
                    <a :href="logIn" class="sharedTXTBrand font-semibold hover:underline">Log in</a>
                </div>
            </form>
        </div>

        <!-- LOADING SCREEN -->
        <Loading_Screen v-if="showLoadingScreen" :message="'Sending you an OTP ...'"/>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Loading_Screen from '../Global/Loading_Screen.vue';

defineProps({
    logIn: { type: String, required: true },
    logo: { type: String, default: '/images/Components/Logo.png' }
});

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const id_number = ref('');

const isSubmitting = ref(false);
const showLoadingScreen = ref(false);
const showPassword = ref(false);
const showConfirmPassword = ref(false);
const registerErrors = ref([]);

async function registerForm(event) {
    if (isSubmitting.value) return;

    registerErrors.value = [];

    const form = event?.target;
    const formData = new FormData(form);

    const formName = String(formData.get('name') || name.value).trim();
    const formEmail = String(formData.get('email') || email.value).trim();
    const formPassword = String(formData.get('password') || password.value);
    const formConfirmation = String(formData.get('password_confirmation') || password_confirmation.value);
    const formIdNumber = String(formData.get('id_number') || id_number.value).trim();

    if (!formIdNumber || !formName || !formEmail || !formPassword || !formConfirmation) {
        registerErrors.value = ['Please complete all fields.'];        return;
    }

    if (formPassword.length < 8) {
        registerErrors.value = ['Password must be at least 8 characters.'];
        return;
    }

    if (formPassword !== formConfirmation) {
        registerErrors.value = ["Passwords don't match."];
        return;
    }

    isSubmitting.value = true;

    try {
        const response = await fetch('/register', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                id_number: formIdNumber,
                name: formName,
                email: formEmail,
                password: formPassword,
                password_confirmation: formConfirmation
            })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showLoadingScreen.value = true;
            window.location.href = data.url;
            return;
        }

        if (data.errors) {
            registerErrors.value = Object.values(data.errors).flat();
        } else {
            registerErrors.value = [data.message || 'Unable to create your account. Please try again.'];
        }
    } catch (error) {
        registerErrors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}
</script>

<style scoped>
.custom-scroll {
    scrollbar-width: thin;
    scrollbar-color: var(--scrollbar-thumb) transparent;
}

.custom-scroll::-webkit-scrollbar {
    width: 6px;
}

.custom-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scroll::-webkit-scrollbar-thumb {
    background-color: var(--scrollbar-thumb);
    border-radius: 999px;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
    background-color: var(--scrollbar-thumb-hover);
}
</style>

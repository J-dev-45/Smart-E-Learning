<template>
    <div class="w-full min-h-[100dvh] md:flex md:h-screen md:min-h-0">

        <!-- DESKTOP BRANDING -->
        <div class="hidden md:flex w-1/2 h-full flex-col items-center justify-center gap-3 px-8 sharedTXT">
            <img
                :src="logo"
                alt="Smart E-Learning logo"
                class="object-contain drop-shadow-2xl"
                style="width:clamp(100px,13vw,190px); height:clamp(90px,11vw,170px)"
            >

            <h1 class="font-bold m-0 leading-none tracking-wide text-center"
                style="font-size:clamp(1.5rem,4vw,3rem)">
                Smart E-Learning
            </h1>

            <div class="sharedBGAccent rounded-full"
                style="width:clamp(60px,7vw,110px); height:4px">
            </div>

            <div class="text-center">
                <h5 class="font-semibold m-0 leading-none sharedTXTMuted"
                    style="font-size:clamp(0.8rem,1.4vw,1.15rem)">
                    Review Smarter, Quiz Better.
                </h5>

                <h6 class="font-medium m-0 mt-2 leading-none sharedTXTMuted"
                    style="font-size:clamp(0.65rem,0.9vw,0.8rem)">
                    Information Technology &amp; Computer Related Course
                </h6>
            </div>
        </div>

        <!-- RESPONSIVE LOGIN AREA -->
        <div class="flex w-full min-h-[100vh] min-h-[100dvh] items-center justify-center p-5 overflow-y-auto md:h-full md:min-h-0 md:w-1/2 md:justify-start md:px-8 md:py-6 lg:px-16">

            <!-- MOBILE CARD WRAPPER -->
            <div class="w-full max-w-[400px] flex flex-col rounded-3xl overflow-hidden shadow-2xl border-[1.5px] sharedBorderLight shrink-0 md:contents">

                <!-- SINGLE LOGIN FORM -->
                <form
                    @submit.prevent="login"
                    class="sharedLightBG flex flex-col justify-center w-full px-[clamp(1.25rem,5vw,2rem)] py-[clamp(1rem,3dvh,1.75rem)] md:max-w-[460px] md:border-[1.5px] sharedBorderLight md:rounded-3xl md:shadow-2xl md:px-[clamp(1.5rem,3vw,2.5rem)] md:py-[clamp(1.25rem,4vh,2.5rem)]"
                >

                    <!-- MOBILE BRAND ROW -->
                    <div class="flex items-center gap-3 mb-[clamp(1rem,3dvh,1.6rem)] md:hidden">
                        <img
                            :src="logo"
                            alt="Smart E-Learning logo"
                            class="size-11 shrink-0 object-contain"
                        >

                        <span class="font-extrabold sharedTXTBrand tracking-wide leading-tight"
                            style="font-size:clamp(1.05rem,2.6dvh,1.35rem)">
                            Smart E-Learning
                        </span>
                    </div>

                    <!-- HEADING -->
                    <h4 class="font-bold m-0 sharedTXTOnLight tracking-wide"
                        style="font-size:clamp(1rem,2.5dvh,1.3rem)">
                        <span class="md:hidden">WELCOME!</span>
                        <span class="hidden md:inline"
                            style="font-size:clamp(1.2rem,2.2vw,1.75rem)">
                            Welcome!
                        </span>
                    </h4>

                    <p class="sharedTXTLightMuted mt-1 mb-[clamp(0.8rem,2.5dvh,1.4rem)] md:mt-1.5 md:mb-[clamp(1rem,3vh,2rem)]"
                        style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                        Log in to continue learning, practice your skills, and track your progress.
                    </p>

                    <!-- ERRORS -->
                    <div v-if="loginErrors.length" class="mb-2" role="alert">
                        <p
                            v-for="(error, index) in loginErrors"
                            :key="index"
                            class="sharedTXTDanger text-sm w-full flex items-center justify-center py-2 text-center"
                        >
                            {{ error }}
                        </p>
                    </div>

                    <!-- EMAIL -->
                    <div class="flex flex-col gap-1 mb-[clamp(0.6rem,1.8dvh,1rem)] md:gap-1.5 md:mb-[clamp(0.6rem,2vh,1.1rem)]">
                        <label for="login-email" class="ps-1 font-semibold sharedTXTOnLight md:ps-2"
                            style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">
                            Email
                        </label>

                        <input
                            id="login-email"
                            type="email"
                            placeholder="example@gmail.com"
                            name="email"
                            v-model="email"
                            autocomplete="username"
                            autocapitalize="none"
                            autocorrect="off"
                            spellcheck="false"
                            inputmode="email"
                            required
                            class="auth-input sharedInput border-[1.5px] rounded-full ps-5 pe-5 outline-none w-full transition-all duration-200"
                        >
                    </div>

                    <!-- PASSWORD -->
                    <div class="flex flex-col gap-1 mb-[clamp(0.6rem,1.8dvh,1rem)] md:gap-1.5 md:mb-[clamp(0.6rem,2vh,1.1rem)]">
                        <label for="login-password" class="ps-1 font-semibold sharedTXTOnLight md:ps-2"
                            style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">
                            Password
                        </label>

                        <div class="relative">
                            <input
                                id="login-password"
                                :type="showPassword ? 'text' : 'password'"
                                placeholder="••••••••••••"
                                name="password"
                                v-model="password"
                                autocomplete="current-password"
                                autocapitalize="none"
                                autocorrect="off"
                                spellcheck="false"
                                required
                                class="auth-input sharedInput select-text border-[1.5px] rounded-full ps-5 pe-12 outline-none w-full transition-all duration-200"
                            >

                            <!-- PASSWORD VISIBILITY TOGGLE -->
                            <button
                                type="button"
                                @mousedown.prevent
                                @click="showPassword = !showPassword"
                                :aria-label="showPassword ? 'Hide password' : 'Show password'"
                                :aria-pressed="showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 sharedTXTLightFaint z-10 cursor-pointer touch-manipulation"
                            >
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

                    <!-- REMEMBER / FORGOT PASSWORD -->
                    <div class="flex justify-between items-center px-1 mb-[clamp(0.5rem,2vh,1rem)] gap-2">
                        <label class="flex items-center gap-2 cursor-pointer sharedTXTLightMuted"
                            style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                            <input
                                type="checkbox"
                                name="remember"
                                v-model="remember"
                                class="w-3.5 h-3.5 sharedCheckAccent"
                            >
                            <span class="md:hidden">Remember me!</span>
                            <span class="hidden md:inline">Remember me</span>
                        </label>

                        <a href="/forgot-password"
                            class="sharedTXTBrand font-semibold hover:underline whitespace-nowrap"
                            style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        :disabled="isSubmitting"
                        class="w-full sharedBtn disabled:opacity-60 disabled:cursor-not-allowed font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg transition-all duration-200 tracking-wide touch-manipulation mt-[clamp(0.2rem,1dvh,0.6rem)] flex items-center justify-center gap-2"
                        style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)"
                    >
                        <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                        </svg>

                        <span>
                            {{ isSubmitting ? 'Logging in...' : 'Log in' }}
                        </span>
                    </button>

                    <!-- REGISTER LINK -->
                    <div class="flex justify-center items-center gap-1.5 pt-[clamp(0.1rem,0.8dvh,0.4rem)] mt-[clamp(0.75rem,2vh,1.25rem)]"
                        style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                        <span class="sharedTXTLightMuted">Don't have an account?</span>
                        <a :href="signUp" class="sharedTXTBrand font-semibold hover:underline">
                            Sign up
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- DESKTOP LOADING SCREEN -->
        <Loading_Screen v-if="showLoadingScreen" :message="'Logging you in...'"/>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Loading_Screen from '../Global/Loading_Screen.vue';

const props = defineProps({
    signUp: { type: String, required: true },
    logo: { type: String, default: '/images/Components/Logo.png' }
});

const email = ref('');
const password = ref('');
const remember = ref(false);
const showPassword = ref(false);
const isSubmitting = ref(false);
const showLoadingScreen = ref(false);
const loginErrors = ref([]);

async function login(event) {
    if (isSubmitting.value) return;

    // Read the actual form values to support iOS autofill.
    const form = event.target;
    const emailValue = (form.elements['email']?.value || email.value || '').trim();
    const passwordValue = form.elements['password']?.value || password.value || '';

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    if (!emailValue || !passwordValue) {
        loginErrors.value = ['Please enter your email and password.'];
        return;
    }

    isSubmitting.value = true;
    loginErrors.value = [];

    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                email: emailValue,
                password: passwordValue,
                remember: remember.value
            })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            // Keep the original behavior: show the loading screen on desktop,
            // while mobile redirects immediately as in the original component.
            if (window.matchMedia('(min-width: 768px)').matches) {
                showLoadingScreen.value = true;
            }

            window.location.href = data.url;
            return;
        }

        loginErrors.value = [data.message || 'Invalid Credentials'];
    } catch (error) {
        console.error('Login error:', error);
        loginErrors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}
</script>

<style scoped>
.auth-input {
    width: 100%;
    height: clamp(40px, 6dvh, 52px);
    border-width: 1.5px;
    border-style: solid;
    border-radius: 9999px;
    padding-left: 1.25rem;
    padding-right: 1.25rem;
    outline: none;
    font-size: 16px;
    transition: border-color 0.2s ease, background-color 0.2s ease;
}

.auth-input::-ms-reveal,
.auth-input::-ms-clear {
    display: none;
}

.auth-input::-webkit-credentials-auto-fill-button {
    visibility: hidden;
    display: none !important;
    pointer-events: none;
}

@media (min-width: 768px) {
    .auth-input {
        height: clamp(44px, 5.5vh, 56px);
    }
}
</style>
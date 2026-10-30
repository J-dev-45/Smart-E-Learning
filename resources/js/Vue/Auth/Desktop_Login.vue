
<template>
    <form
        @submit.prevent="desktopLoginForm"
        class="w-full max-w-[460px] bg-white border-[1.5px] border-white/40 rounded-3xl shadow-2xl
        flex flex-col px-[clamp(1.5rem,3vw,2.5rem)] py-[clamp(1.25rem,4vh,2.5rem)]">

        <h4 class="font-bold m-0 text-[#090014] tracking-wide"
            style="font-size:clamp(1.2rem,2.2vw,1.75rem)">Welcome!</h4>

        <p class="text-gray-500 mt-1.5 mb-[clamp(1rem,3vh,2rem)] text-sm">
            Log in to continue learning, practice your skills, and track your progress.
        </p>

        <!-- ERROR -->
        <div v-if="loginErrors.length">
            <p v-for="(error, index) in loginErrors" :key="index"
                class="text-red-500 text-md w-full flex items-center justify-center py-2">
                {{ error }}
            </p>
        </div>

        <div class="flex flex-col gap-1.5 mb-[clamp(0.6rem,2vh,1.1rem)]">
            <label class="ps-2 font-semibold text-gray-700 text-sm">Email</label>

            <input type="email" placeholder="example@gmail.com" name="email" v-model="email"
                class="border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 text-sm text-[#090014]
                placeholder:text-gray-400 w-full focus:border-[#4C1D95]/50 focus:bg-white transition-all duration-200"
                style="height:clamp(44px,5.5vh,56px)">
        </div>

        <div class="flex flex-col gap-1.5 mb-[clamp(0.6rem,2vh,1.1rem)] relative">
            <label class="ps-2 font-semibold text-gray-700 text-sm">Password</label>

            <input :type="showPassword ? 'text' : 'password'" v-model="password"
                placeholder="••••••••" name="password"
                class="[&::-ms-reveal]:hidden [&::-ms-clear]:hidden
                [&::-webkit-credentials-auto-fill-button]:hidden
                border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 w-full text-[#090014]
                placeholder:text-xl placeholder:text-gray-400 focus:border-[#4C1D95]/50 focus:bg-white transition-all duration-200"
                style="height:clamp(44px,5.5vh,56px)">

            <svg v-if="!showPassword" @click="showPassword = true" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" fill="currentColor"
                class="flex z-[100] size-6 absolute right-4 bottom-2.5 cursor-pointer text-gray-400">
                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
            </svg>

            <svg v-else
                @click="showPassword = false"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="z-[100] size-6 absolute right-4 bottom-2.5 cursor-pointer text-gray-400">
                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
            </svg>
        </div>

        <div class="flex justify-between items-center px-2 mb-[clamp(0.5rem,2vh,1rem)]">
            <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                <input
                    type="checkbox"
                    v-model="remember"
                    class="w-4 h-4 accent-[#4C1D95]">
                Remember me
            </label>

            <a href="#" class="text-sm text-[#3b0764] font-semibold hover:underline">Forgot Password?</a>
        </div>

        <button type="submit" :disabled="isSubmitting"
            class="w-full bg-[#3b0764] hover:bg-[#3b0764]/85 disabled:opacity-60 disabled:cursor-not-allowed
                    text-white font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg
                    transition-all duration-200 tracking-wide mt-[clamp(0.2rem,1dvh,0.6rem)]
                    flex items-center justify-center gap-2"
            style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)">

            <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
            </svg>

            <span>{{ isSubmitting ? 'Checking Credentials...' : 'Log in' }}</span>
        </button>

        <div class="flex justify-center items-center gap-2 text-sm mt-[clamp(0.75rem,2vh,1.25rem)]">
            <span class="text-gray-500">Don't have an Account?</span>
            <a :href="url" class="text-[#3b0764] font-semibold hover:underline">Sign Up</a>
        </div>

    </form>

    <Loading_Screen
        v-if="showLoadingScreen"
        :message="'Logging you in...'"
    />
</template>

<script setup>
import { ref } from 'vue';
import Loading_Screen from '../Global/Loading_Screen.vue';

defineProps({
    errors: { type: Array, default: () => [] },
    url: { type: String, required: true }
});

const email = ref('');
const password = ref('');
const remember = ref(false);
const showPassword = ref(false);
const isSubmitting = ref(false);
const showLoadingScreen = ref(false);
const loginErrors = ref([]);

async function desktopLoginForm() {
    if (isSubmitting.value) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

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
                email: email.value,
                password: password.value,
                remember: remember.value
            })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showLoadingScreen.value = true;
            window.location.href = data.url;
            return;
        }

        loginErrors.value = [data.message || 'Invalid Credentials'];

    } catch (error) {
        console.error(error);
        loginErrors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}
</script>

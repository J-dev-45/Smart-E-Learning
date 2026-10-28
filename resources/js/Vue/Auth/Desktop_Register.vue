<template>
    <form @submit.prevent="registerForm"
        class="w-full max-w-[460px] bg-white border-[1.5px] border-white/40 rounded-3xl shadow-2xl
        flex flex-col px-[clamp(1.5rem,3vw,2.5rem)] py-[clamp(1.25rem,3.5vh,2.25rem)] my-auto">
        <h4 class="font-bold m-0 text-[#090014] tracking-wide"
            style="font-size:clamp(1.2rem,2.2vw,1.75rem)">Create Account!</h4>
        <p class="text-gray-500 mt-1.5 mb-[clamp(1rem,2.5vh,1.75rem)] text-sm">
            Create your account now to review and enhance your knowledge.
        </p>

        <!-- ERROR -->
        <div v-if="registerErrors.length">
            <p v-for="(error, index) in registerErrors" :key="index"
                class="text-red-500 text-md w-full flex items-center justify-center py-2">
                {{ error }}
            </p>
        </div>

        <div class="flex flex-col gap-[clamp(0.5rem,1.8vh,0.9rem)]">
            <div class="flex flex-col gap-1.5">
                <label class="ps-2 font-semibold text-gray-700 text-sm">First Name and Last Name</label>
                <input type="text" placeholder="First Name and Last Name" v-model="name"
                        class="border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 text-sm text-[#090014]
                        placeholder:text-gray-400 w-full focus:border-[#4C1D95]/50 focus:bg-white transition-all duration-200"
                        style="height:clamp(44px,5.5vh,56px)">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="ps-2 font-semibold text-gray-700 text-sm">Email</label>
                <input type="email" placeholder="example@gmail.com" v-model="email"
                        class="border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 text-sm text-[#090014]
                        placeholder:text-gray-400 w-full focus:border-[#4C1D95]/50 focus:bg-white transition-all duration-200"
                        style="height:clamp(44px,5.5vh,56px)">
            </div>

            <div class="flex flex-col gap-1.5 relative">
                <label class="ps-2 font-semibold text-gray-700 text-sm">Password</label>
                <input :type="showPassword ? 'text' : 'password'" placeholder="••••••••" v-model="password"
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

                <svg v-else @click="showPassword = false"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="z-[100] size-6 absolute right-4 bottom-2.5 cursor-pointer text-gray-400">
                    <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                    <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                    <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                </svg>
            </div>

            <!-- Password strength hint -->
            <div class="min-h-[1.25rem] ps-2">
                <p class="flex items-center gap-1.5 text-xs m-0 transition-all duration-200"
                    :class="password.length === 0 ? 'text-gray-400' : (password.length < 8 ? 'text-red-500' : 'text-green-600')"
                >
                    <svg v-if="password.length >= 8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.169 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                    </svg>
                    {{ password.length >= 8 ? 'Good password length' : `Password must be at least 8 characters (${password.length}/8)` }}
                </p>
            </div>

            <div class="flex flex-col gap-1.5 relative">
                <label class="ps-2 font-semibold text-gray-700 text-sm">Confirm Password</label>
                <input :type="showConfirmPassword ? 'text' : 'password'" placeholder="••••••••" v-model="password_confirmation"
                        class="[&::-ms-reveal]:hidden [&::-ms-clear]:hidden
                        [&::-webkit-credentials-auto-fill-button]:hidden
                        border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 w-full text-[#090014]
                        placeholder:text-xl placeholder:text-gray-400 focus:border-[#4C1D95]/50 focus:bg-white transition-all duration-200"
                        style="height:clamp(44px,5.5vh,56px)">

                <svg v-if="!showConfirmPassword" @click="showConfirmPassword = true" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="currentColor"
                    class="flex z-[100] size-6 absolute right-4 bottom-2.5 cursor-pointer text-gray-400">
                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                </svg>

                <svg v-else @click="showConfirmPassword = false"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="z-[100] size-6 absolute right-4 bottom-2.5 cursor-pointer text-gray-400">
                    <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                    <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                    <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                </svg>
            </div>

            <!-- Confirm password match hint -->
            <div class="min-h-[1.25rem] ps-2">
                <p v-if="password_confirmation.length > 0"
                    class="flex items-center gap-1.5 text-xs m-0 transition-all duration-200"
                    :class="password === password_confirmation ? 'text-green-600' : 'text-red-500'"
                >
                    <svg v-if="password === password_confirmation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5 shrink-0">
                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.169 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                    </svg>
                    {{ password === password_confirmation ? 'Passwords match' : "Passwords don't match" }}
                </p>
            </div>
        </div>

        <button type="submit"
                :disabled="isSubmitting || password.length < 8 || password !== password_confirmation"
                class="w-full bg-[#4C1D95] hover:bg-[#4C1D95]/85 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#4C1D95] text-white font-bold
                        rounded-full cursor-pointer shadow-md hover:shadow-xl
                        tracking-wide transition-all duration-200 mt-6 flex items-center justify-center gap-2"
                style="height:clamp(46px,5.5vh,58px); font-size:clamp(0.95rem,1.5vw,1.15rem)">
            <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
            </svg>
            <span>{{ isSubmitting ? 'Creating Account...' : 'Create Account' }}</span>
        </button>

        <div class="flex justify-center items-center gap-2 text-sm
                    mt-[clamp(0.75rem,2vh,1.25rem)]">
            <span class="text-gray-500">Already have an Account?</span>
            <a :href="logIn" class="text-[#4C1D95] font-semibold hover:underline">Log in</a>
        </div>

    </form>

    <Loading_Screen
    v-if="showLoadingScreen"
    :message="'Sending you an OTP ... '"
    />

</template>

<script setup>
import { ref } from 'vue';
import Loading_Screen from '../Global/Loading_Screen.vue';

const props = defineProps({
    logIn: {type: String, required: true}
})

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');

const isSubmitting = ref(false);
const showLoadingScreen = ref(false);

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const registerErrors = ref([]);


async function registerForm(){

        if(isSubmitting.value) return;
        isSubmitting.value = true;

        try{
            const response = await fetch('/register',{
            method: "POST",
            headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'Accept' : 'application/json'
            },
            body: JSON.stringify({
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: password_confirmation.value
            })
        })

        const data = await response.json();

        if(data.success){
            name.value = '';
            email.value = '';
            password.value = '';
            password_confirmation.value = '';
            showLoadingScreen.value = true;
            window.location.href = data.url;
        } else if (data.errors) {
            registerErrors.value = Object.values(data.errors).flat();
        }

    } catch (e) {
        registerErrors.value = ['Something went wrong. Please try again.'];
    } finally{
        isSubmitting.value = false
    }

}


</script>
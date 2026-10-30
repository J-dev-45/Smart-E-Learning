<template>

    <form
        @submit.prevent="desktopVerifyForm"
        class="w-full max-w-[460px] bg-white border-[1.5px] border-white/40 rounded-3xl shadow-2xl
               flex flex-col px-[clamp(1.5rem,3vw,2.5rem)] py-[clamp(1.25rem,4vh,2.5rem)] my-auto">

        <h4 class="font-bold m-0 text-[#090014] tracking-wide text-center"
            style="font-size:clamp(1.2rem,2.2vw,1.50rem)">ACCOUNT VERIFICATION</h4>
        <p class="text-gray-500 mt-1.5 mb-[clamp(1rem,3vh,2rem)] text-sm text-center px-4 leading-relaxed">
            Your OTP code has been sent to <b class="text-gray-700">{{ email }}</b>.
            Enter the OTP code to verify your account.
        </p>

        <!-- ERROR -->
        <div v-if="verifyErrors.length">
            <p v-for="(error, index) in verifyErrors" :key="index"
                class="text-red-500 text-md w-full flex items-center justify-center py-2 text-center">
                {{ error }}
            </p>
        </div>

        <!-- OTP -->
        <div class="otp-grid container-type-inline my-6">
            <input v-for="n in 6" :key="n"
                   type="text" maxlength="1" :name="'otp' + n"
                   class="otp-input" inputmode="numeric" pattern="[0-9]*"
                   autocomplete="off">
        </div>

        <button type="submit" :disabled="isSubmitting"
            class="w-full bg-[#3b0764] hover:bg-[#3b0764]/85 disabled:opacity-60 disabled:cursor-not-allowed
                   text-white font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg
                   transition-all duration-200 tracking-wide
                   flex items-center justify-center gap-2"
            style="height:clamp(46px,5.5vh,58px); font-size:clamp(0.95rem,1.5vw,1.15rem)">
            <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
            </svg>
            <span>{{ isSubmitting ? 'Checking Code...' : 'Verify Account' }}</span>
        </button>

        <div class="flex justify-center items-center gap-2 text-sm
                    mt-[clamp(0.75rem,2vh,1.25rem)]">
            <span class="text-gray-500">Didn't receive a code?</span>
            <span id="resend_otp" class="text-[#3b0764] font-semibold hover:underline cursor-pointer">Resend Code</span>
        </div>

    </form>

    <Loading_Screen
        v-if="showLoadingScreen"
        :message="'Verifying your account...'"
    />

</template>

<script setup>
import { ref } from 'vue';
import Loading_Screen from '../Global/Loading_Screen.vue';

defineProps({
    email: { type: String, required: true }
});

const isSubmitting = ref(false);
const showLoadingScreen = ref(false);
const verifyErrors = ref([]);

async function desktopVerifyForm(event) {
    if (isSubmitting.value) return;

    const form = event.target;
    const body = {};
    for (let n = 1; n <= 6; n++) {
        body['otp' + n] = (form.elements['otp' + n]?.value || '').trim();
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    isSubmitting.value = true;
    verifyErrors.value = [];

    try {
        const response = await fetch('/verify_otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(body)
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showLoadingScreen.value = true;
            window.location.href = data.url;
            return;
        }

        verifyErrors.value = [data.message || 'Invalid OTP'];

    } catch (error) {
        console.error(error);
        verifyErrors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}
</script>
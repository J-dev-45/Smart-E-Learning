<template>
    <div class="bg-white flex flex-col justify-center
                px-[clamp(1.25rem,5vw,2rem)] py-[clamp(1rem,3dvh,1.75rem)]">

        <!-- BRAND ROW -->
        <div class="flex items-center gap-3 mb-[clamp(1rem,3dvh,1.6rem)]">
            <img :src="logo" alt="Smart E-Learning logo" class="size-11 shrink-0 object-contain">
            <span class="font-extrabold text-[#5b21b6] tracking-wide leading-tight"
                  style="font-size:clamp(1.05rem,2.6dvh,1.35rem)">Smart E-Learning</span>
        </div>

        <h4 class="font-bold m-0 text-[#090014] tracking-wide"
            style="font-size:clamp(1rem,2.5dvh,1.3rem)">ACCOUNT VERIFICATION</h4>

        <p class="text-gray-500 mt-1 mb-[clamp(0.8rem,2.5dvh,1.4rem)]"
           style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
            Your OTP code has been sent to <b class="text-gray-700">{{ email }}</b>.
            Enter the OTP code to verify your account.
        </p>

        <!-- ERROR -->
        <div v-if="verifyErrors.length">
            <p
                v-for="(error, index) in verifyErrors"
                :key="index"
                class="text-red-500 text-md w-full flex items-center justify-center py-2 text-center">
                {{ error }}
            </p>
        </div>

        <form @submit.prevent="mobileVerifyForm" class="flex flex-col gap-[clamp(0.6rem,1.8dvh,1rem)]">

            <!-- OTP inputs -->
            <div class="otp-grid container-type-inline my-2">
                <input v-for="n in 6" :key="n"
                       type="text" maxlength="1" :name="'otp' + n"
                       class="otp-input" inputmode="numeric" pattern="[0-9]*"
                       autocomplete="off">
            </div>

            <button type="submit"
                    :disabled="isSubmitting"
                    class="w-full bg-[#3b0764] hover:bg-[#3b0764]/85 disabled:opacity-60 disabled:cursor-not-allowed
                           text-white font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg
                           transition-all duration-200 tracking-wide touch-manipulation
                           mt-[clamp(0.2rem,1dvh,0.6rem)]
                           flex items-center justify-center gap-2"
                    style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)">

                <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
                </svg>

                <span>{{ isSubmitting ? 'Verifying...' : 'Verify Account' }}</span>
            </button>

            <div class="flex justify-center items-center gap-1.5
                        pt-[clamp(0.1rem,0.8dvh,0.4rem)]"
                 style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                <span class="text-gray-500">Didn't receive a code?</span>
                <a href="#" class="text-[#3b0764] font-semibold hover:underline">Resend Code</a>
            </div>

        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    email: { type: String, required: true },
    logo: { type: String, default: '/images/Components/Logo.png' }
});

const isSubmitting = ref(false);
const verifyErrors = ref([]);

async function mobileVerifyForm(event) {
    if (isSubmitting.value) return;

    const form = event.target;
    const body = {};
    for (let n = 1; n <= 6; n++) {
        body['otp' + n] = (form.elements['otp' + n]?.value || '').trim();
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

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
            credentials: 'same-origin',
            body: JSON.stringify(body)
        });

        const data = await response.json();

        if (response.ok && data.success) {
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
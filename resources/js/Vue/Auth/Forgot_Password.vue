<template>
    <div class="w-full max-w-[460px] bg-white border border-white/40 rounded-3xl shadow-2xl flex flex-col px-[clamp(1.25rem,3vw,2.5rem)] py-[clamp(1.25rem,4vh,2.5rem)]">

        <!-- MOBILE BRAND ROW -->
        <div class="flex items-center gap-3 mb-[clamp(1rem,3dvh,1.6rem)] md:hidden">
            <img :src="logo" alt="Smart E-Learning logo" class="size-11 shrink-0 object-contain">
            <span class="font-extrabold text-[#5b21b6] tracking-wide leading-tight" style="font-size:clamp(1.05rem,2.6dvh,1.35rem)">
                Smart E-Learning
            </span>
        </div>

        <!-- EMAIL STEP -->
        <template v-if="step === 'email'">
            <div class="mb-6">
                <h4 class="text-2xl font-bold tracking-wide text-[#090014]">Forgot Password</h4>
                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    Enter your registered email address and we'll send you a verification code to reset your password.
                </p>
            </div>

            <div v-if="errors.length" class="mb-4 rounded-xl border border-red-100 bg-red-50 px-4 py-3" role="alert">
                <p v-for="(error, index) in errors" :key="index" class="text-sm text-red-600">{{ error }}</p>
            </div>

            <div v-if="successMessage" class="mb-4 rounded-xl border border-green-100 bg-green-50 px-4 py-3" role="status">
                <p class="text-sm text-green-700">{{ successMessage }}</p>
            </div>

            <div class="mb-5 flex flex-col gap-2">
                <label for="forgot-email" class="pl-2 text-sm font-semibold text-gray-700">Email Address</label>
                <input id="forgot-email" v-model.trim="email" type="email" autocomplete="email" placeholder="example@gmail.com" class="auth-input" @keyup.enter="sendOtp">
            </div>

            <button type="button" :disabled="isSubmitting" class="auth-button" @click="sendOtp">
                <svg v-if="isSubmitting" class="size-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z" />
                </svg>
                <span>{{ isSubmitting ? 'Sending OTP...' : 'Send OTP' }}</span>
            </button>

            <div class="mt-6 flex flex-wrap items-center justify-center gap-1.5 text-sm">
                <span class="text-gray-500">Remember your password?</span>
                <a href="/" class="font-semibold text-[#3b0764] hover:underline" @click="clearFpSession">Log in</a>
            </div>
        </template>

        <!-- OTP STEP -->
        <template v-else-if="step === 'otp'">
            <div class="mb-5 text-center">
                <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-full bg-purple-50 text-[#3b0764]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="size-7">
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path d="m3 7 9 6 9-6" />
                    </svg>
                </div>

                <h4 class="text-2xl font-bold tracking-wide text-[#090014]">Verify OTP</h4>
                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    Enter the six-digit verification code sent to
                    <span class="break-words font-semibold text-gray-700">{{ email }}</span>
                </p>
                <button type="button" class="mt-2 text-xs font-semibold text-[#3b0764] hover:underline" @click="changeEmail">
                    Wrong email? Change
                </button>
            </div>

            <div v-if="errors.length" class="mb-3 rounded-xl border border-red-100 bg-red-50 px-4 py-3" role="alert">
                <p v-for="(error, index) in errors" :key="index" class="text-center text-sm text-red-600">{{ error }}</p>
            </div>

            <div class="otp-grid container-type-inline my-4">
                <input
                    v-for="(_, i) in 6"
                    :key="i"
                    :ref="el => otpRefs[i] = el"
                    v-model="otpDigits[i]"
                    type="text"
                    maxlength="1"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    autocomplete="one-time-code"
                    :aria-label="`OTP digit ${i + 1}`"
                    class="otp-input"
                    @input="onOtpInput(i)"
                    @keydown="onOtpKeydown($event, i)"
                    @paste="onOtpPaste($event, i)"
                >
            </div>

            <button type="button" :disabled="isSubmitting" class="auth-button mt-3" @click="verifyOtp">
                <svg v-if="isSubmitting" class="size-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z" />
                </svg>
                <span>{{ isSubmitting ? 'Verifying...' : 'Verify OTP' }}</span>
            </button>

            <div class="mt-6 flex flex-wrap items-center justify-center gap-1.5 text-sm">
                <span class="text-gray-500">Didn't receive a code?</span>
                <button
                    type="button"
                    :disabled="resendCooldown > 0 || isSubmitting"
                    class="font-semibold transition-colors"
                    :class="resendCooldown > 0 || isSubmitting ? 'cursor-not-allowed text-gray-400' : 'cursor-pointer text-[#3b0764] hover:underline'"
                    @click="resendOtp"
                >
                    {{ resendCooldown > 0 ? `Resend in ${resendCooldown}s` : 'Resend Code' }}
                </button>
            </div>
        </template>

        <!-- RESET PASSWORD STEP -->
        <template v-else-if="step === 'reset'">
            <div class="mb-6">
                <h4 class="text-2xl font-bold tracking-wide text-[#090014]">Reset Password</h4>
                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    Create a new password for your account. Make sure your password meets the requirements below.
                </p>
            </div>

            <div v-if="errors.length" class="mb-4 rounded-xl border border-red-100 bg-red-50 px-4 py-3" role="alert">
                <p v-for="(error, index) in errors" :key="index" class="text-sm text-red-600">{{ error }}</p>
            </div>

            <div class="mb-5 flex flex-col gap-2">
                <label for="new-password" class="pl-2 text-sm font-semibold text-gray-700">New Password</label>

                <div class="relative">
                    <input id="new-password" v-model="newPassword" :type="showPassword ? 'text' : 'password'" autocomplete="new-password" placeholder="Enter your new password" class="auth-input pr-14" @keyup.enter="resetPassword">

                    <button type="button" :aria-label="showPassword ? 'Hide password' : 'Show password'" class="password-toggle" @click="showPassword = !showPassword">
                        <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.5-6.75 9.75-6.75S21.75 12 21.75 12 18.25 18.75 12 18.75 2.25 12 2.25 12Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.9 5.4A10.7 10.7 0 0 1 12 5.25c6.25 0 9.75 6.75 9.75 6.75a16.5 16.5 0 0 1-3.15 3.9M6.2 6.2C3.65 8.05 2.25 12 2.25 12s3.5 6.75 9.75 6.75c1.3 0 2.45-.3 3.5-.8" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-1 pl-2 pt-1">
                    <p class="flex items-center gap-2 text-xs" :class="passwordMeetsLength ? 'text-green-600' : 'text-gray-500'">
                        <svg v-if="passwordMeetsLength" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.2 7.25a1 1 0 0 1-1.42.006l-3.8-3.75a1 1 0 0 1 1.406-1.422l3.09 3.05 6.505-6.548a1 1 0 0 1 1.413 0Z" clip-rule="evenodd" />
                        </svg>
                        <span v-else class="inline-block size-4 text-center">•</span>
                        At least 8 characters
                    </p>
                </div>
            </div>

            <div class="mb-5 flex flex-col gap-2">
                <label for="confirm-password" class="pl-2 text-sm font-semibold text-gray-700">Confirm Password</label>

                <div class="relative">
                    <input id="confirm-password" v-model="confirmPassword" :type="showConfirmPassword ? 'text' : 'password'" autocomplete="new-password" placeholder="Confirm your new password" class="auth-input pr-14" @keyup.enter="resetPassword">

                    <button type="button" :aria-label="showConfirmPassword ? 'Hide confirmation password' : 'Show confirmation password'" class="password-toggle" @click="showConfirmPassword = !showConfirmPassword">
                        <svg v-if="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.5-6.75 9.75-6.75S21.75 12 21.75 12 18.25 18.75 12 18.75 2.25 12 2.25 12Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.9 5.4A10.7 10.7 0 0 1 12 5.25c6.25 0 9.75 6.75 9.75 6.75a16.5 16.5 0 0 1-3.15 3.9M6.2 6.2C3.65 8.05 2.25 12 2.25 12s3.5 6.75 9.75 6.75c1.3 0 2.45-.3 3.5-.8" />
                        </svg>
                    </button>
                </div>

                <p v-if="confirmPassword.length > 0" class="pl-2 text-xs" :class="passwordsMatch ? 'text-green-600' : 'text-red-500'" aria-live="polite">
                    {{ passwordsMatch ? 'Passwords match.' : 'Passwords do not match.' }}
                </p>
            </div>

            <button type="button" :disabled="isSubmitting" class="auth-button" @click="resetPassword">
                <svg v-if="isSubmitting" class="size-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z" />
                </svg>
                <span>{{ isSubmitting ? 'Resetting...' : 'Reset Password' }}</span>
            </button>
        </template>

        <!-- SUCCESS STEP -->
        <template v-else-if="step === 'success'">
            <div class="flex flex-col items-center justify-center gap-4 py-6">
                <div class="flex size-16 items-center justify-center rounded-full bg-green-50 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12.5 4.5 4.5L19 7" />
                    </svg>
                </div>

                <h4 class="text-center text-2xl font-bold tracking-wide text-[#090014]">Password Reset!</h4>
                <p class="text-center text-sm leading-relaxed text-gray-500">
                    Your password has been reset successfully. You can now log in using your new password.
                </p>

                <a href="/" class="auth-button no-underline" @click="clearFpSession">Go to Login</a>
            </div>
        </template>
    </div>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
    logo: { type: String, default: '/images/Components/Logo.png' }
});

const savedStep = typeof window !== 'undefined' ? sessionStorage.getItem('fp_step') : null;
const savedEmail = typeof window !== 'undefined' ? sessionStorage.getItem('fp_email') : null;

const step = ref(savedStep && ['email', 'otp', 'reset'].includes(savedStep) ? savedStep : 'email');
const email = ref(savedEmail || '');
const errors = ref([]);
const successMessage = ref('');
const isSubmitting = ref(false);

const otpDigits = ref(['', '', '', '', '', '']);
const otpRefs = ref([]);
const resendCooldown = ref(0);

const newPassword = ref('');
const confirmPassword = ref('');
const showPassword = ref(false);
const showConfirmPassword = ref(false);

const passwordMeetsLength = computed(() => newPassword.value.length >= 8);
const passwordsMatch = computed(() => confirmPassword.value.length > 0 && newPassword.value === confirmPassword.value);

let resendInterval = null;

function getCsrf() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
}

function clearResendInterval() {
    if (resendInterval) {
        clearInterval(resendInterval);
        resendInterval = null;
    }
}

function startResendCooldown(seconds = 60) {
    clearResendInterval();

    const expiresAt = Date.now() + seconds * 1000;
    sessionStorage.setItem('fp_resend_until', String(expiresAt));

    function updateCooldown() {
        resendCooldown.value = Math.max(0, Math.ceil((expiresAt - Date.now()) / 1000));

        if (resendCooldown.value <= 0) {
            clearResendInterval();
            sessionStorage.removeItem('fp_resend_until');
        }
    }

    updateCooldown();

    if (resendCooldown.value > 0) {
        resendInterval = setInterval(updateCooldown, 1000);
    }
}

function restoreResendCooldown() {
    const expiresAt = Number(sessionStorage.getItem('fp_resend_until') || 0);
    const remaining = Math.ceil((expiresAt - Date.now()) / 1000);

    if (remaining > 0) {
        startResendCooldown(remaining);
    } else {
        sessionStorage.removeItem('fp_resend_until');
        resendCooldown.value = 0;
    }
}

function changeEmail() {
    step.value = 'email';
    errors.value = [];
    otpDigits.value = ['', '', '', '', '', ''];
    sessionStorage.removeItem('fp_step');
}

function clearFpSession() {
    clearResendInterval();
    sessionStorage.removeItem('fp_step');
    sessionStorage.removeItem('fp_email');
    sessionStorage.removeItem('fp_resend_until');
}

async function sendOtp() {
    if (isSubmitting.value) return;

    if (!email.value) {
        errors.value = ['Please enter your email address.'];
        return;
    }

    isSubmitting.value = true;
    errors.value = [];
    successMessage.value = '';

    try {
        const response = await fetch('/forgot-password/send-otp', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrf(), Accept: 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify({ email: email.value })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            step.value = 'otp';
            otpDigits.value = ['', '', '', '', '', ''];
            sessionStorage.setItem('fp_step', 'otp');
            sessionStorage.setItem('fp_email', email.value);
            startResendCooldown(60);
            return;
        }

        errors.value = [data.message || 'Unable to send the verification code.'];
    } catch (error) {
        console.error('Send OTP error:', error);
        errors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}

function onOtpInput(index) {
    otpDigits.value[index] = otpDigits.value[index].replace(/\D/g, '').slice(0, 1);

    if (otpDigits.value[index] && index < 5) {
        otpRefs.value[index + 1]?.focus();
    }
}

function onOtpKeydown(event, index) {
    if (event.key === 'Backspace' && !otpDigits.value[index] && index > 0) {
        otpRefs.value[index - 1]?.focus();
    }

    if (event.key === 'ArrowLeft' && index > 0) {
        otpRefs.value[index - 1]?.focus();
    }

    if (event.key === 'ArrowRight' && index < 5) {
        otpRefs.value[index + 1]?.focus();
    }
}

function onOtpPaste(event, index) {
    event.preventDefault();

    const digits = event.clipboardData.getData('text').match(/\d/g) || [];

    digits.slice(0, 6 - index).forEach((digit, offset) => {
        otpDigits.value[index + offset] = digit;
    });

    const nextIndex = Math.min(index + digits.length, 5);
    otpRefs.value[nextIndex]?.focus();
}

async function verifyOtp() {
    if (isSubmitting.value) return;

    const otp = otpDigits.value.join('');

    if (otp.length !== 6) {
        errors.value = ['Please enter the complete 6-digit OTP code.'];
        return;
    }

    isSubmitting.value = true;
    errors.value = [];

    try {
        const response = await fetch('/forgot-password/verify-otp', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrf(), Accept: 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify({ otp })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            step.value = 'reset';
            sessionStorage.setItem('fp_step', 'reset');
            return;
        }

        errors.value = [data.message || 'Invalid OTP code.'];
    } catch (error) {
        console.error('Verify OTP error:', error);
        errors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}

async function resendOtp() {
    if (resendCooldown.value > 0 || isSubmitting.value) return;
    await sendOtp();
}

async function resetPassword() {
    if (isSubmitting.value) return;

    if (!newPassword.value || !confirmPassword.value) {
        errors.value = ['Please fill in both password fields.'];
        return;
    }

    if (!passwordMeetsLength.value) {
        errors.value = ['Password must be at least 8 characters.'];
        return;
    }

    if (!passwordsMatch.value) {
        errors.value = ['Passwords do not match.'];
        return;
    }

    isSubmitting.value = true;
    errors.value = [];

    try {
        const response = await fetch('/forgot-password/reset', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrf(), Accept: 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify({
                password: newPassword.value,
                password_confirmation: confirmPassword.value
            })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            step.value = 'success';
            sessionStorage.removeItem('fp_step');
            sessionStorage.removeItem('fp_email');
            sessionStorage.removeItem('fp_resend_until');
            clearResendInterval();
            return;
        }

        errors.value = [data.message || 'Unable to reset your password.'];
    } catch (error) {
        console.error('Reset password error:', error);
        errors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}

onMounted(() => {
    if (step.value === 'otp') restoreResendCooldown();
});

onUnmounted(() => {
    clearResendInterval();
});
</script>

<style scoped>
.auth-input {
    width: 100%;
    height: clamp(44px, 5.5vh, 56px);
    border: 1.5px solid #e5e7eb;
    border-radius: 9999px;
    padding: 0 1.25rem;
    outline: none;
    background: #f9fafb;
    color: #090014;
    font-size: 0.875rem;
    transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
}

.auth-input::placeholder { color: #9ca3af; }

.auth-input:focus {
    border-color: rgb(59 7 100 / 50%);
    background: #ffffff;
    box-shadow: 0 0 0 3px rgb(59 7 100 / 7%);
}

.auth-button {
    display: flex;
    width: 100%;
    min-height: 44px;
    height: clamp(42px, 6.5dvh, 54px);
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border-radius: 9999px;
    background: #3b0764;
    padding: 0.75rem 1rem;
    color: #ffffff;
    font-size: clamp(0.85rem, 2dvh, 1rem);
    font-weight: 700;
    letter-spacing: 0.025em;
    cursor: pointer;
    box-shadow: 0 4px 8px rgb(0 0 0 / 8%);
    transition: background-color 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
}

.auth-button:hover:not(:disabled) {
    background: rgb(59 7 100 / 88%);
    box-shadow: 0 6px 12px rgb(0 0 0 / 12%);
}

.auth-button:disabled { cursor: not-allowed; opacity: 0.6; }

.password-toggle {
    position: absolute;
    top: 50%;
    right: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: translateY(-50%);
    color: #9ca3af;
    cursor: pointer;
    transition: color 0.2s ease;
}

.password-toggle:hover { color: #3b0764; }

.otp-grid {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: clamp(0.3rem, 2%, 0.75rem);
    width: 100%;
}

.otp-input {
    width: 100%;
    min-width: 0;
    aspect-ratio: 4 / 5;
    border: 1.5px solid #e5e7eb;
    border-radius: 0.75rem;
    background: #f9fafb;
    text-align: center;
    font-size: clamp(1rem, 4cqi, 1.6rem);
    font-weight: 700;
    color: #090014;
    outline: none;
    transition: border-color 0.15s ease, background-color 0.15s ease, box-shadow 0.15s ease;
}

.otp-input:focus {
    border-color: rgb(59 7 100 / 55%);
    background: #ffffff;
    box-shadow: 0 0 0 3px rgb(59 7 100 / 7%);
}

.container-type-inline { container-type: inline-size; }

input[type='password']::-ms-reveal,
input[type='password']::-ms-clear { display: none; }

input[type='password']::-webkit-credentials-auto-fill-button {
    visibility: hidden;
    display: none !important;
    pointer-events: none;
}

@supports not (font-size: 1cqi) {
    .otp-input { font-size: clamp(1rem, 5vw, 1.6rem); }
}
</style>
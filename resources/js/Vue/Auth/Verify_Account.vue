<!-- Verify.vue -->
<template>
    <div
        class="sharedLightBG flex flex-col justify-center
                rounded-2xl
                px-[clamp(1.25rem,5vw,2rem)]
                py-[clamp(1rem,3dvh,1.75rem)]
                md:w-full md:max-w-[460px]
                md:border-[1.5px] sharedBorderLight
                md:rounded-3xl md:shadow-2xl
                md:px-[clamp(1.5rem,3vw,2.5rem)]
                md:py-[clamp(1.25rem,4vh,2.5rem)]
                md:my-auto"
    >
        <!-- MOBILE BRAND -->
        <div class="flex items-center gap-3 mb-[clamp(1rem,3dvh,1.6rem)] md:hidden">
            <img
                :src="logo"
                alt="Smart E-Learning logo"
                class="size-11 shrink-0 object-contain"
            >
            <span
                class="font-extrabold sharedTXTBrand tracking-wide leading-tight"
                style="font-size:clamp(1.05rem,2.6dvh,1.35rem)"
            >
                Smart E-Learning
            </span>
        </div>

        <!-- HEADING -->
        <h4
            class="font-bold m-0 sharedTXTOnLight tracking-wide text-center"
            style="font-size:clamp(1rem,2.5dvh,1.3rem)"
        >
            ACCOUNT VERIFICATION
        </h4>

        <!-- DESCRIPTION -->
        <p
            class="sharedTXTLightMuted mt-1.5 mb-[clamp(0.8rem,2.5dvh,1.4rem)]
                   text-center leading-relaxed
                   md:mt-1.5 md:mb-[clamp(1rem,3vh,2rem)]
                   md:text-sm md:px-4"
            style="font-size:clamp(0.75rem,1.5dvh,0.875rem)"
        >
            Your OTP code has been sent to
            <b class="sharedTXTOnLight break-words">{{ email }}</b>.
            Enter the OTP code to verify your account.
        </p>

        <!-- ERRORS -->
        <div v-if="verifyErrors.length" class="mb-3" role="alert" aria-live="polite">
            <p
                v-for="(error, index) in verifyErrors"
                :key="index"
                class="sharedTXTDanger text-sm w-full text-center py-1.5 break-words"
            >
                {{ error }}
            </p>
        </div>

        <!-- VERIFICATION FORM -->
        <form
            ref="formEl"
            @submit.prevent="verifyForm"
            class="flex flex-col gap-[clamp(0.6rem,1.8dvh,1rem)]"
        >
            <!-- SIX OTP INPUTS -->
            <div class="otp-grid container-type-inline my-2 md:my-6">
                <input
                    v-for="n in 6"
                    :key="n"
                    :ref="(el) => setOtpInputRef(el, n - 1)"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    maxlength="1"
                    :name="'otp' + n"
                    :aria-label="`OTP digit ${n}`"
                    :autocomplete="n === 1 ? 'one-time-code' : 'off'"
                    class="otp-input sharedInput"
                    @input="handleOtpInput($event, n - 1)"
                    @keydown.backspace="handleBackspace($event, n - 1)"
                    @paste="handleOtpPaste"
                >
            </div>

            <!-- VERIFY BUTTON -->
            <button
                type="submit"
                :disabled="isSubmitting"
                class="w-full sharedBtn
                       disabled:opacity-60 disabled:cursor-not-allowed
                       font-bold rounded-full cursor-pointer
                       shadow-md hover:shadow-lg transition-all duration-200
                       tracking-wide touch-manipulation
                       mt-[clamp(0.2rem,1dvh,0.6rem)]
                       flex items-center justify-center gap-2"
                style="height:clamp(42px,6.5dvh,54px);font-size:clamp(0.85rem,2dvh,1rem)"
            >
                <svg
                    v-if="isSubmitting"
                    class="animate-spin size-4 shrink-0"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    />
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"
                    />
                </svg>

                <span>
                    {{ isSubmitting ? 'Verifying...' : 'Verify Account' }}
                </span>
            </button>

            <!-- RESEND OTP -->
            <div
                class="flex flex-wrap justify-center items-center gap-x-1.5 gap-y-1
                       pt-[clamp(0.1rem,0.8dvh,0.4rem)]
                       md:gap-2 md:pt-0 md:mt-[clamp(0.75rem,2vh,1.25rem)]"
                style="font-size:clamp(0.65rem,1.5dvh,0.875rem)"
            >
                <span class="sharedTXTLightMuted">Didn't receive a code?</span>

                <button
                    type="button"
                    @click="resendOTP"
                    :disabled="remainingSeconds > 0 || isResending"
                    class="font-semibold transition-colors touch-manipulation"
                    :class="
                        remainingSeconds > 0 || isResending
                            ? 'sharedTXTLightFaint cursor-not-allowed'
                            : 'sharedTXTBrand hover:underline cursor-pointer'
                    "
                >
                    <span v-if="isResending">Sending...</span>

                    <span v-else-if="remainingSeconds > 0">
                        Resend Code ({{ remainingSeconds }}s)
                    </span>

                    <span v-else>Resend Code</span>
                </button>
            </div>
        </form>

        <!-- LOADING SCREEN -->
        <Loading_Screen
            v-if="showLoadingScreen"
            :message="'Verifying your account...'"
        />
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Loading_Screen from '../Global/Loading_Screen.vue';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    logo: {
        type: String,
        default: '/images/Components/Logo.png',
    },
});

const formEl = ref(null);
const otpInputRefs = ref([]);

const isSubmitting = ref(false);
const isResending = ref(false);
const showLoadingScreen = ref(false);
const verifyErrors = ref([]);
const remainingSeconds = ref(0);

let countdownInterval = null;

function setOtpInputRef(element, index) {
    if (element) {
        otpInputRefs.value[index] = element;
    }
}

function getCsrfToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content') || '';
}

/*
|--------------------------------------------------------------------------
| OTP INPUT HANDLING
|--------------------------------------------------------------------------
*/

function handleOtpInput(event, index) {
    const input = event.target;
    const digits = input.value.replace(/\D/g, '');

    input.value = digits.slice(-1);

    if (input.value && index < 5) {
        otpInputRefs.value[index + 1]?.focus();
    }
}

function handleBackspace(event, index) {
    const input = event.target;

    if (!input.value && index > 0) {
        otpInputRefs.value[index - 1]?.focus();
    }
}

function handleOtpPaste(event) {
    event.preventDefault();

    const pastedText = event.clipboardData
        ?.getData('text')
        .replace(/\D/g, '')
        .slice(0, 6);

    if (!pastedText) {
        return;
    }

    pastedText.split('').forEach((digit, index) => {
        const input = otpInputRefs.value[index];

        if (input) {
            input.value = digit;
        }
    });

    const nextIndex = Math.min(pastedText.length, 5);
    otpInputRefs.value[nextIndex]?.focus();
}

/*
|--------------------------------------------------------------------------
| VERIFY OTP
|--------------------------------------------------------------------------
*/

async function verifyForm() {
    if (isSubmitting.value) {
        return;
    }

    const body = {};

    for (let n = 1; n <= 6; n++) {
        const input = formEl.value?.elements[`otp${n}`];
        body[`otp${n}`] = (input?.value || '').trim();
    }

    if (Object.values(body).some((digit) => !/^\d$/.test(digit))) {
        verifyErrors.value = ['Please enter all six digits of your OTP code.'];
        return;
    }

    isSubmitting.value = true;
    verifyErrors.value = [];

    try {
        const response = await fetch('/verify_otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
            body: JSON.stringify(body),
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showLoadingScreen.value = true;

            if (data.url) {
                window.location.href = data.url;
            } else {
                showLoadingScreen.value = false;
                verifyErrors.value = [
                    'Your account was verified, but the redirect address was not provided.',
                ];
            }

            return;
        }

        verifyErrors.value = [data.message || 'Invalid OTP'];
    } catch (error) {
        console.error('OTP verification error:', error);

        verifyErrors.value = [
            'Something went wrong. Please try again.',
        ];
    } finally {
        isSubmitting.value = false;
    }
}

/*
|--------------------------------------------------------------------------
| RESEND COUNTDOWN
|--------------------------------------------------------------------------
*/

function startCountdown(seconds) {
    if (countdownInterval) {
        clearInterval(countdownInterval);
        countdownInterval = null;
    }

    remainingSeconds.value = Math.max(0, Number(seconds) || 0);

    if (remainingSeconds.value <= 0) {
        return;
    }

    countdownInterval = setInterval(() => {
        if (remainingSeconds.value > 0) {
            remainingSeconds.value--;
        }

        if (remainingSeconds.value <= 0) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }
    }, 1000);
}

async function loadResendStatus() {
    try {
        const response = await fetch('/otp/resend-status', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
        });

        const data = await response.json();

        if (response.ok && data.success) {
            startCountdown(data.remaining);
        }
    } catch (error) {
        console.error('Unable to load OTP resend status:', error);
    }
}

/*
|--------------------------------------------------------------------------
| RESEND OTP
|--------------------------------------------------------------------------
*/

async function resendOTP() {
    if (remainingSeconds.value > 0 || isResending.value) {
        return;
    }

    isResending.value = true;
    verifyErrors.value = [];

    try {
        const response = await fetch('/resend_otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
            body: JSON.stringify({}),
        });

        const data = await response.json();

        if (response.ok && data.success) {
            startCountdown(data.remaining ?? 60);

            otpInputRefs.value.forEach((input) => {
                if (input) {
                    input.value = '';
                }
            });

            otpInputRefs.value[0]?.focus();
        } else {
            if (typeof data.remaining === 'number') {
                startCountdown(data.remaining);
            }

            verifyErrors.value = [
                data.message || 'Unable to resend the verification code.',
            ];
        }
    } catch (error) {
        console.error('Resend OTP error:', error);

        verifyErrors.value = [
            'Something went wrong while sending your code. Please try again.',
        ];
    } finally {
        isResending.value = false;
    }
}

onMounted(() => {
    loadResendStatus();
});

onUnmounted(() => {
    if (countdownInterval) {
        clearInterval(countdownInterval);
        countdownInterval = null;
    }
});
</script>

<style scoped>
.otp-grid {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: clamp(0.3rem, 2%, 0.75rem);
    width: 100%;
}

.container-type-inline {
    container-type: inline-size;
}

.otp-input {
    width: 100%;
    min-width: 0;
    aspect-ratio: 4 / 5;
    border-width: 1.5px;
    border-style: solid;
    border-radius: 0.75rem;
    text-align: center;
    font-weight: 700;
    outline: none;
    font-size: clamp(1rem, 4cqi, 1.6rem);
    transition: border-color 0.15s, background 0.15s;
    -webkit-appearance: none;
    appearance: none;
}

.otp-input:focus-visible {
    outline: 2px solid color-mix(in srgb, var(--primary-color) 25%, transparent);
    outline-offset: 2px;
}

@supports not (font-size: 1cqi) {
    .otp-input {
        font-size: clamp(1rem, 5vw, 1.6rem);
    }
}
</style>
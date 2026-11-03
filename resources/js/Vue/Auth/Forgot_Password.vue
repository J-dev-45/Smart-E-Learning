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

        <!-- RESPONSIVE FORM AREA -->
        <div class="flex w-full min-h-[100vh] min-h-[100dvh] items-center justify-center p-5 overflow-y-auto md:h-full md:min-h-0 md:w-1/2 md:justify-start md:px-8 md:py-6 lg:px-16">

            <!-- MOBILE CARD WRAPPER -->
            <div class="w-full max-w-[400px] flex flex-col rounded-3xl overflow-hidden shadow-2xl border-[1.5px] sharedBorderLight shrink-0 md:contents">

                <div
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

                    <!-- EMAIL STEP -->
                    <template v-if="step === 'email'">
                        <h4 class="font-bold m-0 sharedTXTOnLight tracking-wide"
                            style="font-size:clamp(1.15rem,2.6dvh,1.6rem)">
                            Forgot Password
                        </h4>

                        <p class="sharedTXTLightMuted leading-relaxed mt-1 mb-[clamp(0.8rem,2.5dvh,1.4rem)] md:mt-1.5 md:mb-[clamp(1rem,3vh,2rem)]"
                            style="font-size:clamp(0.7rem,1.6dvh,0.85rem)">
                            Enter your registered email address and we'll send you a verification code to reset your password.
                        </p>

                        <!-- ERRORS -->
                        <div v-if="errors.length" class="mb-2" role="alert">
                            <p
                                v-for="(error, index) in errors"
                                :key="index"
                                class="sharedTXTDanger text-sm w-full flex items-center justify-center py-2 text-center"
                            >
                                {{ error }}
                            </p>
                        </div>

                        <!-- SUCCESS -->
                        <div v-if="successMessage" class="mb-2" role="status">
                            <p class="sharedTXTLightSuccess text-sm w-full flex items-center justify-center py-2 text-center">
                                {{ successMessage }}
                            </p>
                        </div>

                        <!-- EMAIL -->
                        <div class="flex flex-col gap-1 mb-[clamp(0.6rem,1.8dvh,1rem)] md:gap-1.5 md:mb-[clamp(0.6rem,2vh,1.1rem)]">
                            <label for="forgot-email" class="ps-1 font-semibold sharedTXTOnLight md:ps-2"
                                style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">
                                Email Address
                            </label>

                            <input
                                id="forgot-email"
                                type="email"
                                placeholder="example@gmail.com"
                                v-model.trim="email"
                                autocomplete="email"
                                autocapitalize="none"
                                autocorrect="off"
                                spellcheck="false"
                                inputmode="email"
                                class="auth-input sharedInput border-[1.5px] rounded-full ps-5 pe-5 outline-none w-full transition-all duration-200"
                                @keyup.enter="sendOtp"
                            >
                        </div>

                        <button
                            type="button"
                            :disabled="isSubmitting"
                            class="w-full sharedBtn disabled:opacity-60 disabled:cursor-not-allowed font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg transition-all duration-200 tracking-wide touch-manipulation mt-[clamp(0.2rem,1dvh,0.6rem)] flex items-center justify-center gap-2"
                            style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)"
                            @click="sendOtp"
                        >
                            <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                            </svg>

                            <span>{{ isSubmitting ? 'Sending OTP...' : 'Send OTP' }}</span>
                        </button>

                        <div class="flex justify-center items-center gap-1.5 pt-[clamp(0.1rem,0.8dvh,0.4rem)] mt-[clamp(0.75rem,2vh,1.25rem)]"
                            style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                            <span class="sharedTXTLightMuted">Remember your password?</span>
                            <a href="/" class="sharedTXTBrand font-semibold hover:underline" @click="clearFpSession">
                                Log in
                            </a>
                        </div>
                    </template>

                    <!-- OTP STEP -->
                    <template v-else-if="step === 'otp'">
                        <div class="text-center mb-[clamp(0.8rem,2.5dvh,1.4rem)]">
                            <div class="mx-auto mb-3 flex size-14 items-center justify-center rounded-full sharedBrandTint sharedTXTBrand">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="size-7">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path d="m3 7 9 6 9-6" />
                                </svg>
                            </div>

                            <h4 class="font-bold m-0 sharedTXTOnLight tracking-wide"
                                style="font-size:clamp(1.15rem,2.6dvh,1.6rem)">
                                Verify OTP
                            </h4>

                            <p class="sharedTXTLightMuted leading-relaxed mt-1.5"
                                style="font-size:clamp(0.7rem,1.6dvh,0.85rem)">
                                Enter the six-digit verification code sent to
                                <span class="break-words font-semibold sharedTXTOnLight">{{ email }}</span>
                            </p>

                            <button
                                type="button"
                                class="mt-2 font-semibold sharedTXTBrand hover:underline cursor-pointer"
                                style="font-size:clamp(0.65rem,1.5dvh,0.78rem)"
                                @click="changeEmail"
                            >
                                Wrong email? Change
                            </button>
                        </div>

                        <!-- ERRORS -->
                        <div v-if="errors.length" class="mb-2" role="alert">
                            <p
                                v-for="(error, index) in errors"
                                :key="index"
                                class="sharedTXTDanger text-sm w-full flex items-center justify-center py-2 text-center"
                            >
                                {{ error }}
                            </p>
                        </div>

                        <div class="otp-grid container-type-inline mb-[clamp(0.6rem,1.8dvh,1rem)]">
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
                                class="otp-input sharedInput border-[1.5px]"
                                @input="onOtpInput(i)"
                                @keydown="onOtpKeydown($event, i)"
                                @paste="onOtpPaste($event, i)"
                            >
                        </div>

                        <button
                            type="button"
                            :disabled="isSubmitting"
                            class="w-full sharedBtn disabled:opacity-60 disabled:cursor-not-allowed font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg transition-all duration-200 tracking-wide touch-manipulation mt-[clamp(0.2rem,1dvh,0.6rem)] flex items-center justify-center gap-2"
                            style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)"
                            @click="verifyOtp"
                        >
                            <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                            </svg>

                            <span>{{ isSubmitting ? 'Verifying...' : 'Verify OTP' }}</span>
                        </button>

                        <div class="flex justify-center items-center gap-1.5 pt-[clamp(0.1rem,0.8dvh,0.4rem)] mt-[clamp(0.75rem,2vh,1.25rem)]"
                            style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                            <span class="sharedTXTLightMuted">Didn't receive a code?</span>
                            <button
                                type="button"
                                :disabled="resendCooldown > 0 || isSubmitting"
                                class="font-semibold transition-colors"
                                :class="resendCooldown > 0 || isSubmitting ? 'cursor-not-allowed sharedTXTLightFaint' : 'cursor-pointer sharedTXTBrand hover:underline'"
                                @click="resendOtp"
                            >
                                {{ resendCooldown > 0 ? `Resend in ${resendCooldown}s` : 'Resend Code' }}
                            </button>
                        </div>
                    </template>

                    <!-- RESET PASSWORD STEP -->
                    <template v-else-if="step === 'reset'">
                        <h4 class="font-bold m-0 sharedTXTOnLight tracking-wide"
                            style="font-size:clamp(1.15rem,2.6dvh,1.6rem)">
                            Reset Password
                        </h4>

                        <p class="sharedTXTLightMuted leading-relaxed mt-1 mb-[clamp(0.8rem,2.5dvh,1.4rem)] md:mt-1.5 md:mb-[clamp(1rem,3vh,2rem)]"
                            style="font-size:clamp(0.7rem,1.6dvh,0.85rem)">
                            Create a new password for your account. Make sure your password meets the requirements below.
                        </p>

                        <!-- ERRORS -->
                        <div v-if="errors.length" class="mb-2" role="alert">
                            <p
                                v-for="(error, index) in errors"
                                :key="index"
                                class="sharedTXTDanger text-sm w-full flex items-center justify-center py-2 text-center"
                            >
                                {{ error }}
                            </p>
                        </div>

                        <!-- NEW PASSWORD -->
                        <div class="flex flex-col gap-1 mb-[clamp(0.6rem,1.8dvh,1rem)] md:gap-1.5 md:mb-[clamp(0.6rem,2vh,1.1rem)]">
                            <label for="new-password" class="ps-1 font-semibold sharedTXTOnLight md:ps-2"
                                style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">
                                New Password
                            </label>

                            <div class="relative">
                                <input
                                    id="new-password"
                                    :type="showPassword ? 'text' : 'password'"
                                    placeholder="Enter your new password"
                                    v-model="newPassword"
                                    autocomplete="new-password"
                                    autocapitalize="none"
                                    autocorrect="off"
                                    spellcheck="false"
                                    class="auth-input sharedInput select-text border-[1.5px] rounded-full ps-5 pe-12 outline-none w-full transition-all duration-200"
                                    @keyup.enter="resetPassword"
                                >

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

                            <p class="flex items-center gap-2 ps-1 md:ps-2"
                                :class="passwordMeetsLength ? 'sharedTXTLightSuccess' : 'sharedTXTLightMuted'"
                                style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                                <svg v-if="passwordMeetsLength" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.2 7.25a1 1 0 0 1-1.42.006l-3.8-3.75a1 1 0 0 1 1.406-1.422l3.09 3.05 6.505-6.548a1 1 0 0 1 1.413 0Z" clip-rule="evenodd" />
                                </svg>
                                <span v-else class="inline-block size-4 text-center">•</span>
                                At least 8 characters
                            </p>
                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div class="flex flex-col gap-1 mb-[clamp(0.6rem,1.8dvh,1rem)] md:gap-1.5 md:mb-[clamp(0.6rem,2vh,1.1rem)]">
                            <label for="confirm-password" class="ps-1 font-semibold sharedTXTOnLight md:ps-2"
                                style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">
                                Confirm Password
                            </label>

                            <div class="relative">
                                <input
                                    id="confirm-password"
                                    :type="showConfirmPassword ? 'text' : 'password'"
                                    placeholder="Confirm your new password"
                                    v-model="confirmPassword"
                                    autocomplete="new-password"
                                    autocapitalize="none"
                                    autocorrect="off"
                                    spellcheck="false"
                                    class="auth-input sharedInput select-text border-[1.5px] rounded-full ps-5 pe-12 outline-none w-full transition-all duration-200"
                                    @keyup.enter="resetPassword"
                                >

                                <button
                                    type="button"
                                    @mousedown.prevent
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    :aria-label="showConfirmPassword ? 'Hide confirmation password' : 'Show confirmation password'"
                                    :aria-pressed="showConfirmPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 p-1 sharedTXTLightFaint z-10 cursor-pointer touch-manipulation"
                                >
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

                            <p
                                v-if="confirmPassword.length > 0"
                                class="ps-1 md:ps-2"
                                :class="passwordsMatch ? 'sharedTXTLightSuccess' : 'sharedTXTDanger'"
                                style="font-size:clamp(0.65rem,1.5dvh,0.78rem)"
                                aria-live="polite"
                            >
                                {{ passwordsMatch ? 'Passwords match.' : 'Passwords do not match.' }}
                            </p>
                        </div>

                        <button
                            type="button"
                            :disabled="isSubmitting"
                            class="w-full sharedBtn disabled:opacity-60 disabled:cursor-not-allowed font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg transition-all duration-200 tracking-wide touch-manipulation mt-[clamp(0.2rem,1dvh,0.6rem)] flex items-center justify-center gap-2"
                            style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)"
                            @click="resetPassword"
                        >
                            <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                            </svg>

                            <span>{{ isSubmitting ? 'Resetting...' : 'Reset Password' }}</span>
                        </button>
                    </template>

                    <!-- SUCCESS STEP -->
                    <template v-else-if="step === 'success'">
                        <div class="flex flex-col items-center justify-center gap-3 text-center">
                            <div class="flex size-16 items-center justify-center rounded-full sharedStateLightPassed sharedStateTint sharedStateText">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="size-9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12.5 4.5 4.5L19 7" />
                                </svg>
                            </div>

                            <h4 class="font-bold m-0 sharedTXTOnLight tracking-wide"
                                style="font-size:clamp(1.15rem,2.6dvh,1.6rem)">
                                Password Reset!
                            </h4>

                            <p class="sharedTXTLightMuted leading-relaxed mb-[clamp(0.4rem,1.5dvh,1rem)]"
                                style="font-size:clamp(0.7rem,1.6dvh,0.85rem)">
                                Your password has been reset successfully. You can now log in using your new password.
                            </p>

                            <a
                                href="/"
                                class="w-full sharedBtn font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg transition-all duration-200 tracking-wide touch-manipulation no-underline flex items-center justify-center gap-2"
                                style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)"
                                @click="clearFpSession"
                            >
                                Go to Login
                            </a>
                        </div>
                    </template>

                </div>
            </div>
        </div>
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

<!-- Layout-only styles. All colors come from the shared classes in app.css. -->
<style scoped>
.auth-input {
    width: 100%;
    height: clamp(40px, 6dvh, 52px);
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
    border-radius: 0.75rem;
    text-align: center;
    font-size: clamp(1rem, 4cqi, 1.6rem);
    font-weight: 700;
    outline: none;
    transition: border-color 0.15s ease, background-color 0.15s ease;
}

.container-type-inline { container-type: inline-size; }

@supports not (font-size: 1cqi) {
    .otp-input { font-size: clamp(1rem, 5vw, 1.6rem); }
}
</style>
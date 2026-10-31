    <template>

    <div
        class="w-full max-w-[460px] bg-white border-[1.5px] border-white/40 rounded-3xl shadow-2xl
        flex flex-col px-[clamp(1.5rem,3vw,2.5rem)] py-[clamp(1.25rem,4vh,2.5rem)]">

        <!-- ═══════════════════════════════════════ -->
        <!-- STEP 1: Enter Email                     -->
        <!-- ═══════════════════════════════════════ -->
        <template v-if="step === 'email'">
            <h4 class="font-bold m-0 text-[#090014] tracking-wide"
                style="font-size:clamp(1.2rem,2.2vw,1.75rem)">Forgot Password</h4>
            <p class="text-gray-500 mt-1.5 mb-[clamp(1rem,3vh,2rem)] text-sm">
                Enter your email address and we'll send you an OTP code to reset your password.
            </p>

            <!-- ERROR -->
            <div v-if="errors.length">
                <p v-for="(error, index) in errors" :key="index"
                    class="text-red-500 text-md w-full flex items-center justify-center py-2">
                    {{ error }}
                </p>
            </div>

            <!-- SUCCESS -->
            <div v-if="successMessage">
                <p class="text-green-500 text-md w-full flex items-center justify-center py-2">
                    {{ successMessage }}
                </p>
            </div>

            <div class="flex flex-col gap-1.5 mb-[clamp(0.6rem,2vh,1.1rem)]">
                <label class="ps-2 font-semibold text-gray-700 text-sm">Email</label>
                <input type="email" placeholder="example@gmail.com" v-model="email"
                    class="border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 text-sm text-[#090014]
                    placeholder:text-gray-400 w-full focus:border-[#4C1D95]/50 focus:bg-white transition-all duration-200"
                    style="height:clamp(44px,5.5vh,56px)"
                    @keyup.enter="sendOtp">
            </div>

            <button @click="sendOtp" :disabled="isSubmitting"
                class="w-full bg-[#4C1D95] hover:bg-[#4C1D95]/85 disabled:opacity-60 disabled:cursor-not-allowed
                        text-white font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg
                        transition-all duration-200 tracking-wide mt-[clamp(0.2rem,1dvh,0.6rem)]
                        flex items-center justify-center gap-2"
                style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)">
                <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
                </svg>
                <span>{{ isSubmitting ? 'Sending OTP...' : 'Send OTP' }}</span>
            </button>

            <div class="flex justify-center items-center gap-2 text-sm mt-[clamp(0.75rem,2vh,1.25rem)]">
                <span class="text-gray-500">Remember your password?</span>
                <a href="/" @click="clearFpSession" class="text-[#4C1D95] font-semibold hover:underline">Log in</a>
            </div>
        </template>


        <!-- ═══════════════════════════════════════ -->
        <!-- STEP 2: Enter OTP                       -->
        <!-- ═══════════════════════════════════════ -->
        <template v-else-if="step === 'otp'">
            <h4 class="font-bold m-0 text-[#090014] tracking-wide text-center"
                style="font-size:clamp(1.2rem,2.2vw,1.50rem)">Verify OTP</h4>
            <p class="text-gray-500 mt-1.5 mb-[clamp(1rem,3vh,2rem)] text-sm text-center px-4 leading-relaxed">
                Enter the 6-digit OTP code sent to <b class="text-gray-700">{{ email }}</b>
                <span @click="changeEmail" class="block text-xs text-[#4C1D95] font-semibold hover:underline cursor-pointer mt-1.5">Wrong email? Change</span>
            </p>

            <!-- ERROR -->
            <div v-if="errors.length">
                <p v-for="(error, index) in errors" :key="index"
                    class="text-red-500 text-sm w-full flex items-center justify-center py-1">
                    {{ error }}
                </p>
            </div>

            <div class="otp-grid container-type-inline my-4">
                <input v-for="(_, i) in 6" :key="i"
                    type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*"
                    class="otp-input"
                    :ref="el => { otpRefs[i] = el }"
                    v-model="otpDigits[i]"
                    @input="onOtpInput(i)"
                    @keydown="onOtpKeydown($event, i)"
                    @paste="onOtpPaste($event, i)">
            </div>

            <button @click="verifyOtp" :disabled="isSubmitting"
                class="w-full bg-[#4C1D95] hover:bg-[#4C1D95]/85 disabled:opacity-60 disabled:cursor-not-allowed
                        text-white font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg
                        transition-all duration-200 tracking-wide mt-[clamp(0.2rem,1dvh,0.6rem)]
                        flex items-center justify-center gap-2"
                style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)">
                <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
                </svg>
                <span>{{ isSubmitting ? 'Verifying...' : 'Verify OTP' }}</span>
            </button>

            <div class="flex justify-center items-center gap-2 text-sm mt-[clamp(0.75rem,2vh,1.25rem)]">
                <span class="text-gray-500">Didn't receive a code?</span>
                <span @click="resendOtp" class="text-[#4C1D95] font-semibold hover:underline cursor-pointer">
                    {{ resendCooldown > 0 ? `Resend in ${resendCooldown}s` : 'Resend Code' }}
                </span>
            </div>
        </template>


        <!-- ═══════════════════════════════════════ -->
        <!-- STEP 3: New Password                    -->
        <!-- ═══════════════════════════════════════ -->
        <template v-else-if="step === 'reset'">
            <h4 class="font-bold m-0 text-[#090014] tracking-wide"
                style="font-size:clamp(1.2rem,2.2vw,1.75rem)">Reset Password</h4>
            <p class="text-gray-500 mt-1.5 mb-[clamp(1rem,3vh,2rem)] text-sm">
                Create a new password for your account.
            </p>

            <!-- ERROR -->
            <div v-if="errors.length">
                <p v-for="(error, index) in errors" :key="index"
                    class="text-red-500 text-md w-full flex items-center justify-center py-2">
                    {{ error }}
                </p>
            </div>

            <div class="flex flex-col gap-1.5 mb-[clamp(0.6rem,2vh,1.1rem)] relative">
                <label class="ps-2 font-semibold text-gray-700 text-sm">New Password</label>
                <input :type="showPassword ? 'text' : 'password'" v-model="newPassword"
                    placeholder="••••••••"
                    class="border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 w-full text-[#090014]
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

            <div class="flex flex-col gap-1.5 mb-[clamp(0.6rem,2vh,1.1rem)] relative">
                <label class="ps-2 font-semibold text-gray-700 text-sm">Confirm Password</label>
                <input :type="showConfirmPassword ? 'text' : 'password'" v-model="confirmPassword"
                    placeholder="••••••••"
                    class="border-[1.5px] border-gray-200 rounded-full px-5 outline-none bg-gray-50 w-full text-[#090014]
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

            <button @click="resetPassword" :disabled="isSubmitting"
                class="w-full bg-[#4C1D95] hover:bg-[#4C1D95]/85 disabled:opacity-60 disabled:cursor-not-allowed
                        text-white font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg
                        transition-all duration-200 tracking-wide mt-[clamp(0.2rem,1dvh,0.6rem)]
                        flex items-center justify-center gap-2"
                style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)">
                <svg v-if="isSubmitting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
                </svg>
                <span>{{ isSubmitting ? 'Resetting...' : 'Reset Password' }}</span>
            </button>
        </template>


        <!-- ═══════════════════════════════════════ -->
        <!-- STEP 4: Success                         -->
        <!-- ═══════════════════════════════════════ -->
        <template v-else-if="step === 'success'">
            <div class="flex flex-col items-center justify-center gap-4 py-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="size-16 text-green-500">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>

                <h4 class="font-bold m-0 text-[#090014] tracking-wide text-center"
                    style="font-size:clamp(1.2rem,2.2vw,1.75rem)">Password Reset!</h4>
                <p class="text-gray-500 text-sm text-center">
                    Your password has been reset successfully. You can now log in with your new password.
                </p>

                <a href="/" @click="clearFpSession"
                    class="w-full bg-[#4C1D95] hover:bg-[#4C1D95]/85
                            text-white font-bold rounded-full cursor-pointer shadow-md hover:shadow-lg
                            transition-all duration-200 tracking-wide
                            flex items-center justify-center gap-2 no-underline"
                    style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)">
                    Go to Login
                </a>
            </div>
        </template>

    </div>

</template>

<script setup>
import { ref } from 'vue';

const savedStep = typeof window !== 'undefined' ? sessionStorage.getItem('fp_step') : null;
const savedEmail = typeof window !== 'undefined' ? sessionStorage.getItem('fp_email') : null;

const step = ref((savedStep && ['email', 'otp', 'reset'].includes(savedStep)) ? savedStep : 'email');
const email = ref(savedEmail || '');
const errors = ref([]);
const successMessage = ref('');
const isSubmitting = ref(false);

function changeEmail() {
    step.value = 'email';
    sessionStorage.removeItem('fp_step');
    errors.value = [];
}

function clearFpSession() {
    sessionStorage.removeItem('fp_step');
    sessionStorage.removeItem('fp_email');
}

// OTP
const otpDigits = ref(['', '', '', '', '', '']);
const otpRefs = ref([]);
const resendCooldown = ref(0);

// Reset
const newPassword = ref('');
const confirmPassword = ref('');
const showPassword = ref(false);
const showConfirmPassword = ref(false);

function getCsrf() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
}

// ═══════════════ STEP 1: Send OTP ═══════════════
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
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrf(),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email: email.value })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            step.value = 'otp';
            sessionStorage.setItem('fp_step', 'otp');
            sessionStorage.setItem('fp_email', email.value);
            startResendCooldown();
            return;
        }

        errors.value = [data.message || 'Something went wrong.'];
    } catch (error) {
        console.error(error);
        errors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}

// ═══════════════ STEP 2: Verify OTP ═══════════════
function onOtpInput(i) {
    otpDigits.value[i] = otpDigits.value[i].replace(/\D/g, '').slice(0, 1);
    if (otpDigits.value[i] && i < 5) {
        otpRefs.value[i + 1]?.focus();
    }
}

function onOtpKeydown(e, i) {
    if (e.key === 'Backspace' && !otpDigits.value[i] && i > 0) {
        otpRefs.value[i - 1]?.focus();
    }
}

function onOtpPaste(e, i) {
    e.preventDefault();
    const digits = (e.clipboardData.getData('text').match(/\d/g) || []);
    digits.forEach((d, idx) => {
        if (i + idx < 6) otpDigits.value[i + idx] = d;
    });
    const next = Math.min(i + digits.length, 5);
    otpRefs.value[next]?.focus();
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
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrf(),
                'Accept': 'application/json'
            },
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
        console.error(error);
        errors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}

// ═══════════════ STEP 3: Reset Password ═══════════════
async function resetPassword() {
    if (isSubmitting.value) return;

    if (!newPassword.value || !confirmPassword.value) {
        errors.value = ['Please fill in both password fields.'];
        return;
    }

    if (newPassword.value.length < 8) {
        errors.value = ['Password must be at least 8 characters.'];
        return;
    }

    if (newPassword.value !== confirmPassword.value) {
        errors.value = ['Passwords do not match.'];
        return;
    }

    isSubmitting.value = true;
    errors.value = [];

    try {
        const response = await fetch('/forgot-password/reset', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrf(),
                'Accept': 'application/json'
            },
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
            return;
        }

        errors.value = [data.message || 'Something went wrong.'];
    } catch (error) {
        console.error(error);
        errors.value = ['Something went wrong. Please try again.'];
    } finally {
        isSubmitting.value = false;
    }
}

// ═══════════════ Resend OTP ═══════════════
function startResendCooldown() {
    resendCooldown.value = 60;
    const interval = setInterval(() => {
        resendCooldown.value--;
        if (resendCooldown.value <= 0) clearInterval(interval);
    }, 1000);
}

async function resendOtp() {
    if (resendCooldown.value > 0 || isSubmitting.value) return;
    await sendOtp();
}
</script>

<style scoped>
.otp-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: clamp(0.3rem, 2%, 0.75rem);
    width: 100%;
}
.otp-input {
    aspect-ratio: 4/5;
    width: 100%;
    min-width: 0;
    border: 1.5px solid #e5e7eb;
    border-radius: 0.75rem;
    background: #f9fafb;
    text-align: center;
    font-weight: 700;
    color: #090014;
    outline: none;
    font-size: clamp(1rem, 4cqi, 1.6rem);
    transition: border-color .15s, background .15s;
}
.otp-input:focus {
    border-color: rgba(76, 29, 149, 0.5);
    background: #ffffff;
}
.container-type-inline {
    container-type: inline-size;
}
@supports not (font-size: 1cqi) {
    .otp-input {
        font-size: clamp(1rem, 5vw, 1.6rem);
    }
}
</style>


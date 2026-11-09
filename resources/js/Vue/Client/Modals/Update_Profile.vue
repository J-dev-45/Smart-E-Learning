<template>
    <div
        v-if="showUpdateProfile"
        class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[999] flex items-center justify-center p-4"
    >
        <div
            role="dialog"
            aria-modal="true"
            aria-labelledby="change_avatar_title"
            class="relative w-full sm:w-[30%] sm:min-w-[380px] max-w-[440px] max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-2xl shadow-black/30 flex flex-col items-center gap-6 px-6 pt-8 pb-6"
        >
            <span id="change_avatar_title" class="sr-only">
                Change profile picture
            </span>

            <!-- CLOSE -->
            <button
                type="button"
                aria-label="Close"
                @click="closeModal"
                class="absolute right-4 top-4 z-10 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer outline-none"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- PREVIEW -->
            <img
                v-if="preview"
                :src="preview"
                alt="Selected profile"
                class="w-36 h-36 rounded-full object-cover shadow-lg shadow-black/10"
            >

            <div
                v-else
                :class="[
                    'w-36 h-36 rounded-full flex items-center justify-center shadow-lg shadow-black/10',
                    profileColor
                ]"
            >
                <span class="text-4xl font-semibold text-white tracking-wide">
                    {{ initials(userName) }}
                </span>
            </div>

            <!-- AVATAR OPTIONS -->
            <div class="w-full flex flex-col gap-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Choose an avatar
                </span>

                <div class="w-full grid grid-cols-5 gap-3 place-items-center">
                    <button
                        v-for="(src, i) in avatars"
                        :key="i"
                        type="button"
                        :aria-label="`Avatar ${i + 1}`"
                        :disabled="avatarState[i] === 'error'"
                        @click="selectAvatar(src)"
                        :class="[
                            'relative w-12 h-12 rounded-full overflow-hidden cursor-pointer outline-none transition duration-200 disabled:cursor-not-allowed',
                            avatarState[i] === 'loaded' ? 'hover:scale-110' : '',
                            selectedAvatar === src
                                ? 'ring-2 ring-offset-2 ring-[#8B5CF6]'
                                : ''
                        ]"
                    >
                        <!-- SKELETON + SHIMMER -->
                        <span
                            v-if="avatarState[i] !== 'loaded'"
                            aria-hidden="true"
                            :class="[
                                'absolute inset-0 rounded-full bg-gray-200',
                                avatarState[i] === 'error' ? '' : 'avatar-skeleton'
                            ]"
                        ></span>

                        <img
                            :ref="el => markIfLoaded(el, i)"
                            :src="src"
                            alt=""
                            @load="avatarState[i] = 'loaded'"
                            @error="avatarState[i] = 'error'"
                            :class="[
                                'w-full h-full object-cover transition-opacity duration-300',
                                avatarState[i] === 'loaded' ? 'opacity-100' : 'opacity-0'
                            ]"
                        >
                    </button>
                </div>
            </div>

            <!-- UPLOAD -->
            <label
                class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer"
            >
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M7.5 7.5L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>

                Upload From this Device

                <input
                    ref="fileInput"
                    type="file"
                    accept="image/jpeg,image/png,image/webp"
                    class="sr-only"
                    @change="onFileChange"
                >
            </label>

            <p
                v-if="errorMessage"
                class="w-full text-sm text-red-600"
                role="alert"
            >
                {{ errorMessage }}
            </p>

            <p
                v-if="successMessage"
                class="w-full text-sm text-green-600"
                role="status"
            >
                {{ successMessage }}
            </p>

            <!-- ACTIONS -->
            <div class="w-full flex items-center gap-3">
                <button
                    type="button"
                    @click="closeModal"
                    :disabled="saving"
                    class="flex-1 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition-colors cursor-pointer outline-none disabled:opacity-50"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    @click="save"
                    :disabled="saving || (!selectedAvatar && !uploadedFile)"
                    class="flex-[1.5] py-2.5 rounded-lg text-sm font-medium text-white bg-[#8B5CF6] hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer outline-none disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ saving ? 'Saving...' : 'Save' }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onBeforeUnmount } from 'vue';

const emit = defineEmits(['close', 'save']);

const props = defineProps({
    showUpdateProfile: {
        type: Boolean,
        default: false
    },
    currentImage: {
        type: String,
        default: null
    },
    profileColor: {
        type: String,
        default: 'bg-[#8B5CF6]'
    },
    userName: {
        type: String,
        default: 'Student Name'
    },
    avatar1: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_1.jpg'
    },
    avatar2: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_2.jpg'
    },
    avatar3: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_3.jpg'
    },
    avatar4: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_4.jpg'
    },
    avatar5: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_5.jpg'
    },
    avatar6: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_6.jpg'
    },
    avatar7: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_7.jpg'
    },
    avatar8: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_8.jpg'
    },
    avatar9: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_9.jpg'
    },
    avatar10: {
        type: String,
        default: '/images/Profile_Avatars/Avatar_10.jpg'
    }
});

const avatars = computed(() => [
    props.avatar1,
    props.avatar2,
    props.avatar3,
    props.avatar4,
    props.avatar5,
    props.avatar6,
    props.avatar7,
    props.avatar8,
    props.avatar9,
    props.avatar10
]);

const avatarState = reactive({});


function markIfLoaded(el, i) {
    if (el && !avatarState[i] && el.complete && el.naturalWidth > 0) {
        avatarState[i] = 'loaded';
    }
}

const fileInput = ref(null);
const selectedAvatar = ref(null);
const uploadedFile = ref(null);
const uploadedUrl = ref(null);

const saving = ref(false);
const errorMessage = ref('');
const successMessage = ref('');

const preview = computed(() =>
    uploadedUrl.value ??
    selectedAvatar.value ??
    props.currentImage
);

function clearUpload() {
    if (uploadedUrl.value) {
        URL.revokeObjectURL(uploadedUrl.value);
    }

    uploadedUrl.value = null;
    uploadedFile.value = null;

    if (fileInput.value) {
        fileInput.value.value = '';
    }
}

function selectAvatar(src) {
    clearUpload();

    selectedAvatar.value = src;
    errorMessage.value = '';
    successMessage.value = '';
}

function onFileChange(event) {
    const file = event.target.files?.[0];

    if (!file) return;

    errorMessage.value = '';
    successMessage.value = '';

    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    if (!allowedTypes.includes(file.type)) {
        errorMessage.value = 'Please select a JPG, PNG, or WEBP image.';
        event.target.value = '';
        return;
    }

    if (file.size > 2 * 1024 * 1024) {
        errorMessage.value = 'The image must not exceed 2 MB.';
        event.target.value = '';
        return;
    }

    clearUpload();

    uploadedFile.value = file;
    uploadedUrl.value = URL.createObjectURL(file);
    selectedAvatar.value = null;
}

async function save() {
    if (saving.value) return;

    if (!uploadedFile.value && !selectedAvatar.value) {
        errorMessage.value = 'Please select an avatar or upload an image.';
        return;
    }

    saving.value = true;
    errorMessage.value = '';
    successMessage.value = '';

    try {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content') ?? '';

        let response;
        let data;

        if (uploadedFile.value) {
            const formData = new FormData();

            formData.append('avatar', uploadedFile.value);

            response = await fetch('/profile/avatar', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: formData
            });

            data = await response.json().catch(() => ({}));

            if (!response.ok) {
                throw new Error(
                    data.message || 'Failed to upload profile picture.'
                );
            }

            if (!data.url) {
                throw new Error(
                    'The server did not return the uploaded image URL.'
                );
            }

            emit('save', {
                type: 'upload',
                avatar: data.profile_picture || null,
                url: data.url
            });

        } else {
            response = await fetch('/profile/avatar/preset', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    avatar: selectedAvatar.value
                })
            });

            data = await response.json().catch(() => ({}));

            if (!response.ok) {
                throw new Error(
                    data.message || 'Failed to save the selected avatar.'
                );
            }

            emit('save', {
                type: 'preset',
                avatar: data.profile_avatar || selectedAvatar.value,
                url: data.url || selectedAvatar.value
            });
        }

        successMessage.value = 'Profile picture saved successfully.';

        clearUpload();
        selectedAvatar.value = null;

        emit('close');

    } catch (error) {
        errorMessage.value =
            error.message || 'Something went wrong while saving.';

    } finally {
        saving.value = false;
    }
}

function closeModal() {
    if (saving.value) return;

    clearUpload();
    selectedAvatar.value = null;
    errorMessage.value = '';
    successMessage.value = '';

    emit('close');
}

function initials(name) {
    return String(name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .map(part => part[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}

onBeforeUnmount(clearUpload);
</script>

<style scoped>
.avatar-skeleton {
    background-image: linear-gradient(
        90deg,
        #e5e7eb 25%,
        #f9fafb 50%,
        #e5e7eb 75%
    );
    background-size: 200% 100%;
    animation: avatar-shimmer 1.4s ease-in-out infinite;
}

@keyframes avatar-shimmer {
    0%   { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

@media (prefers-reduced-motion: reduce) {
    .avatar-skeleton {
        animation: none;
    }
}
</style>
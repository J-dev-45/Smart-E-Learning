<template>
    <div class="w-full min-w-0 shrink-0 md:shrink md:flex-1 md:min-h-[320px] flex flex-col gap-4">
        <div class="w-full shrink-0 flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 min-w-0">
                <!-- ROLE FILTER -->
                <div
                    class="flex items-center gap-1 p-1 rounded-xl border sharedBorder sharedSurfaceBG w-fit max-w-full overflow-x-auto"
                >
                    <button
                        v-for="tab in roleTabs"
                        :key="tab"
                        type="button"
                        @click="activeTab = tab"
                        class="px-3 py-1.5 rounded-lg text-xs font-medium whitespace-nowrap transition-all duration-200 cursor-pointer"
                        :class="activeTab === tab
                            ? 'sharedBtn'
                            : 'sharedTXTMuted sharedRowHover sharedHoverTXT'"
                    >
                        {{ tab }}
                    </button>
                </div>

                <div class="relative w-full sm:w-[320px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4 absolute left-3.5 top-1/2 -translate-y-1/2 z-10 sharedTXTMuted pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        v-model="searchQuery"
                        type="search"
                        placeholder="Search by ID or Name..."
                        aria-label="Search users by ID or name"
                        class="w-full h-10 sm:h-[36px] pl-10 pr-3 rounded-xl text-base sm:text-sm
                            appearance-none [color-scheme:dark]
                            sharedInputDark border outline-none
                            focus:ring-1 transition-all duration-200"
                    >
                </div>
            </div>

            <span class="text-xs font-medium sharedTXTMuted sm:shrink-0" aria-live="polite">
                {{ filteredUsers.length }} {{ filteredUsers.length === 1 ? 'user' : 'users' }}
            </span>
        </div>

        <div
            class="w-full min-w-0 rounded-2xl border sharedBorder sharedSurfaceBG shadow-lg sharedShadow overflow-hidden
                   md:flex-1 md:min-h-0 md:flex md:flex-col"
        >
            <!-- Column header: table layout only from lg (1024px) up -->
            <div
                class="hidden lg:grid shrink-0 gap-3 px-4 py-2.5 border-b sharedBorder text-xs font-medium sharedTXTMuted"
                :class="gridCols"
            >
                <span>ID Number</span>
                <span>Name</span>
                <span>Email</span>
                <span class="hidden xl:block text-center">Role</span>
                <span class="text-right">Account Control</span>
            </div>

            <ul class="overflow-y-auto md:flex-1 md:min-h-0 scrollbar-thin">
                <li
                    v-for="user in filteredUsers"
                    :key="user.id"
                    class="flex flex-col gap-3 px-4 py-3
                           lg:grid lg:items-center lg:gap-3
                           border-b sharedBorder last:border-b-0
                           sharedRowHover transition-colors duration-200"
                    :class="gridCols"
                >
                    <span class="hidden lg:block text-xs sharedTXTMuted font-mono truncate tabular-nums">
                        {{ user.id_number }}
                    </span>

                    <div class="flex items-center gap-3 min-w-0">
                        <!-- User photo -->
                        <img
                            v-if="getProfileImage(user)"
                            :src="getProfileImage(user)"
                            :alt="user.name"
                            class="w-8 h-8 rounded-full object-cover shrink-0"
                        />

                        <!-- INITIAL -->
                        <div
                            v-else
                            :class="[
                                'shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold',
                                user.profile_color || 'sharedTile'
                            ]"
                        >
                            {{ initials(user.name) }}
                        </div>

                        <div class="flex flex-col min-w-0 flex-1">
                            <span class="text-sm font-medium sharedTXT truncate" :title="user.name">
                                {{ user.name }}
                            </span>
                            <span class="lg:hidden text-[11px] sharedTXTMuted font-mono truncate tabular-nums">
                                {{ user.id_number }}
                            </span>
                        </div>

                        <!-- Role badge inside the name cell until the dedicated Role column appears (xl) -->
                        <span
                            class="xl:hidden shrink-0 inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-medium"
                            :class="roleBadge(user.role)"
                        >
                            {{ user.role }}
                        </span>
                    </div>

                    <span
                        class="text-xs sharedTXTMuted font-mono truncate min-w-0"
                        :title="user.email"
                    >
                        {{ user.email }}
                    </span>

                    <span class="hidden xl:flex justify-center">
                        <span
                            class="inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-medium"
                            :class="roleBadge(user.role)"
                        >
                            {{ user.role }}
                        </span>
                    </span>

                    <div class="flex items-center gap-2 lg:gap-1.5 lg:justify-end">
                        <!-- PROMOTE -->
                        <button
                            v-if="user.role === 'Student'"
                            type="button"
                            @click="promoteUser(user.id)"
                            :aria-label="`Promote ${user.name}`"
                            title="Promote"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium
                                sharedStateOpen sharedStateChip sharedStateChipLink ring-1
                                active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-3.5 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                            <span>Role ➞ Admin</span>
                        </button>
                        <!-- DEMOTE -->

                        <button
                            v-else
                            type="button"
                            @click="demoteUser(user.id)"
                            :aria-label="`Demote ${user.name}`"
                            title="Demote"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium
                                sharedTXTMuted sharedTile ring-1 sharedRingSoft
                                sharedStateWarning sharedHoverState
                                active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>

                            <span>Role ➞ Student</span>
                        </button>

                        <!-- DELETE -->
                        <button
                            type="button"
                            @click="deleteUser(user.id)"
                            :aria-label="`Delete ${user.name}`"
                            title="Delete"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium
                                sharedStateDanger sharedStateChip sharedDangerSolidHover ring-1
                                active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-3.5 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.682-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            <span class="lg:hidden xl:inline">Delete</span>
                        </button>
                    </div>
                </li>

                <li
                    v-if="filteredUsers.length === 0"
                    class="px-4 py-8 text-center text-sm sharedTXTMuted"
                >
                    No users found.
                </li>
            </ul>
        </div>
    </div>

    <Promote_User
        :show-promote-user="showPromoteUser"
        :user-data="userData"
        @close-promote="closePromote"
        @user-promoted="handleUserPromoted"
    />

    <Demote_User
        :show-demote-user="showDemoteUser"
        :user-data="userData"
        @close-demote="closeDemote"
        @user-demoted="handleUserDemoted"
    />

    <Delete_User
        :show-delete-user="showDeleteUser"
        :user-data="userData"
        @close-delete="closeDelete"
        @user-deleted="handleUserDeleted"
    />
</template>


<script setup>
import { ref, computed, watch } from 'vue';
import Promote_User from '../Modal/Promote_User.vue';
import Demote_User from '../Modal/Demote_User.vue';
import Delete_User from '../Modal/Delete_User.vue';

const props = defineProps({
    users: {
        type: Array,
        default: () => []
    },
    supabaseUrl: { type: String, default: '' },
    avatarBucket: { type: String, default: 'pictures' },
});

const SUPABASE_URL = props.supabaseUrl;
const AVATAR_BUCKET = props.avatarBucket;

const getProfileImage = (user) => {
    if (!user) return '';

    if (user.profile_picture) {
        const picture = user.profile_picture;

        if (/^https?:\/\//i.test(picture)) {
            return picture;
        }

        if (picture.startsWith('profiles/')) {
            return `${props.supabaseUrl}/storage/v1/object/public/${props.avatarBucket}/${picture}`;
        }

        return picture;
    }

    if (user.profile_avatar) {
        return `/${user.profile_avatar.replace(/^\/+/, '')}`;
    }

    return '';
};

const gridCols =
    'lg:grid-cols-[100px_minmax(0,1.2fr)_minmax(0,1fr)_124px] ' +
    'xl:grid-cols-[110px_minmax(0,1.2fr)_minmax(0,1fr)_100px_264px]';

const searchQuery = ref('');

// Role filter tabs -> the role value stored on each user
const roleTabs = ['All', 'Students', 'Admins'];
const tabRoles = {
    Students: 'Student',
    Admins: 'Admin',
};
const activeTab = ref('All');

const usersList = ref([...props.users]);

watch(
    () => props.users,
    (newUsers) => {
        usersList.value = [...newUsers];
    },
    { deep: true }
);

const showPromoteUser = ref(false);
const showDemoteUser = ref(false);
const showDeleteUser = ref(false);

const userData = ref(null);

const filteredUsers = computed(() => {
    const search = searchQuery.value.trim().toLowerCase();

    return usersList.value.filter(user => {
        const matchesTab =
            activeTab.value === 'All' ||
            user.role === tabRoles[activeTab.value];

        if (!matchesTab) {
            return false;
        }

        if (!search) {
            return true;
        }

        const name = String(user.name ?? '').toLowerCase();
        const idNumber = String(user.id_number ?? '').toLowerCase();

        return name.includes(search) || idNumber.includes(search);
    });
});

function initials(name) {
    return String(name ?? '')
        .split(' ')
        .filter(Boolean)
        .map(n => n[0])
        .slice(0, 2)
        .join('')
        .toUpperCase();
}

function roleBadge(role) {
    return role === 'Admin'
        ? 'sharedStateDanger sharedStateChip ring-1'
        : 'sharedStateOpen sharedStateChip ring-1';
}

function promoteUser(id) {
    userData.value = usersList.value.find(user => user.id === id);

    if (userData.value) {
        showPromoteUser.value = true;
    }
}

function closePromote() {
    showPromoteUser.value = false;
}

function demoteUser(id) {
    userData.value = usersList.value.find(user => user.id === id);

    if (userData.value) {
        showDemoteUser.value = true;
    }
}

function closeDemote() {
    showDemoteUser.value = false;
}

function deleteUser(id) {
    userData.value = usersList.value.find(user => user.id === id);

    if (userData.value) {
        showDeleteUser.value = true;
    }
}

function closeDelete() {
    showDeleteUser.value = false;
}

function handleUserPromoted(id) {
    const user = usersList.value.find(user => user.id === id);

    if (user) {
        user.role = 'Admin';
    }
}

function handleUserDemoted(id) {
    const user = usersList.value.find(user => user.id === id);

    if (user) {
        user.role = 'Student';
    }
}

function handleUserDeleted(id) {
    usersList.value = usersList.value.filter(user => user.id !== id);
}
</script>
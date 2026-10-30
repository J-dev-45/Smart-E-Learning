<template>
    <!-- Root: on md+ it fills the space left under the cards (flex-1) and the list scrolls inside it.
         On mobile it keeps its natural height and the <main> element scrolls instead. -->
    <div class="w-full min-w-0 shrink-0 md:shrink md:flex-1 md:min-h-[320px] flex flex-col gap-4">
        <div class="w-full shrink-0 flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative w-full sm:w-[320px]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input
                    v-model="searchQuery"
                    type="search"
                    placeholder="Search by ID or Name..."
                    aria-label="Search users by ID or name"
                    class="w-full h-10 sm:h-[36px] pl-10 pr-3 rounded-md text-base sm:text-sm text-white placeholder:text-gray-500
                           bg-[#CECBF6]/6 border-[1.5px] border-[#CECBF6]/15 outline-none
                           focus:border-[#CECBF6]/30 focus:bg-[#CECBF6]/10 transition-all"
                >
            </div>
            <span class="text-xs text-gray-400 sm:shrink-0" aria-live="polite">
                {{ filteredUsers.length }} {{ filteredUsers.length === 1 ? 'user' : 'users' }}
            </span>
        </div>

        <div
            class="w-full min-w-0 border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 backdrop-blur-sm rounded-md overflow-hidden
                   md:flex-1 md:min-h-0 md:flex md:flex-col"
        >
            <!-- Column header: table layout only from lg (1024px) up -->
            <div
                class="hidden lg:grid shrink-0 gap-3 px-4 py-2.5 border-b border-[#CECBF6]/15 text-xs font-semibold text-gray-400"
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
                           border-b border-[#CECBF6]/10 last:border-b-0
                           hover:bg-[#CECBF6]/5 transition-colors"
                    :class="gridCols"
                >
                    <span class="hidden lg:block text-xs text-gray-400 font-mono truncate">
                        {{ user.id_number }}
                    </span>

                    <div class="flex items-center gap-3 min-w-0">
                        <div v-if="user.profile_picture === null"
                            class="w-8 h-8 shrink-0 rounded-full flex items-center justify-center text-[11px] font-semibold"
                            :class="user.profile_color"
                        >
                            {{ initials(user.name) }}
                        </div>

                        <div class="flex flex-col min-w-0 flex-1">
                            <span class="text-sm text-white truncate" :title="user.name">
                                {{ user.name }}
                            </span>
                            <span class="lg:hidden text-[11px] text-gray-400 font-mono truncate">
                                {{ user.id_number }}
                            </span>
                        </div>

                        <!-- Role badge inside the name cell until the dedicated Role column appears (xl) -->
                        <span
                            class="xl:hidden shrink-0 inline-flex px-2 py-1 rounded-md text-[11px] font-medium border"
                            :class="roleBadge(user.role)"
                        >
                            {{ user.role }}
                        </span>
                    </div>

                    <span
                        class="text-xs text-gray-400 font-mono truncate min-w-0"
                        :title="user.email"
                    >
                        {{ user.email }}
                    </span>

                    <span class="hidden xl:flex justify-center">
                        <span
                            class="inline-flex px-2 py-1 rounded-md text-[11px] font-medium border"
                            :class="roleBadge(user.role)"
                        >
                            {{ user.role }}
                        </span>
                    </span>

                    <div class="flex items-center gap-2 lg:gap-1.5 lg:justify-end">
                        <button
                            v-if="user.role === 'Student'"
                            type="button"
                            @click="promoteUser(user.id)"
                            :aria-label="`Promote ${user.name}`"
                            title="Promote"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-md text-xs font-medium
                                bg-emerald-500/10 border-[1.5px] border-emerald-500/25 text-emerald-300
                                hover:bg-emerald-500/20 hover:border-emerald-500/40
                                active:scale-95 transition-all cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-3.5 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                            <span class="lg:hidden xl:inline">Promote</span>
                        </button>

                        <button
                            v-else
                            type="button"
                            @click="demoteUser(user.id)"
                            :aria-label="`Demote ${user.name}`"
                            title="Demote"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-md text-xs font-medium
                                bg-[#CECBF6]/5 border-[1.5px] border-[#CECBF6]/15 text-gray-300
                                hover:bg-amber-500/10 hover:border-amber-500/30 hover:text-amber-300
                                active:scale-95 transition-all cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-3.5 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                            <span class="lg:hidden xl:inline">Demote</span>
                        </button>

                        <button
                            type="button"
                            @click="deleteUser(user.id)"
                            :aria-label="`Delete ${user.name}`"
                            title="Delete"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-10 lg:min-h-0 lg:py-1.5 rounded-md text-xs font-medium
                                bg-red-500/10 border-[1.5px] border-red-500/25 text-red-300
                                hover:bg-red-500 hover:border-red-500 hover:text-white
                                active:scale-95 transition-all cursor-pointer"
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
                    class="px-4 py-8 text-center text-sm text-gray-500"
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
    />

    <Demote_User
        :show-demote-user="showDemoteUser"
        :user-data="userData"
        @close-demote="closeDemote"
    />

    <Delete_User
        :show-delete-user="showDeleteUser"
        :user-data="userData"
        @close-delete="closeDelete"
    />
</template>

<script setup>
import { ref, computed } from 'vue';
import Promote_User from '../Modal/Promote_User.vue';
import Demote_User from '../Modal/Demote_User.vue';
import Delete_User from '../Modal/Delete_User.vue';

const props = defineProps({
    users: {
        type: Array,
        default: () => []
    }
});

// Stacked cards below lg. Table from lg (role shown as a badge in the name cell).
// Dedicated Role column + labelled action buttons from xl.
// Action column widths fit 3 icon buttons (~114px) / 3 labelled buttons (~253px).
const gridCols =
    'lg:grid-cols-[100px_minmax(0,1.2fr)_minmax(0,1fr)_124px] ' +
    'xl:grid-cols-[110px_minmax(0,1.2fr)_minmax(0,1fr)_100px_264px]';

const searchQuery = ref('');

const showPromoteUser = ref(false);
const showDemoteUser = ref(false);
const showDeleteUser = ref(false);

const userData = ref(null);

const filteredUsers = computed(() => {
    const search = searchQuery.value.trim().toLowerCase();

    if (!search) {
        return props.users;
    }

    return props.users.filter(user => {
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
        .join('');
}

function roleBadge(role) {
    return role === 'Admin'
        ? 'bg-[#E04A4A]/10 border-[#E04A4A]/20 text-[#F09595]'
        : 'bg-white/5 border-white/10 text-gray-300';
}

function promoteUser(id) {
    userData.value = props.users.find(user => user.id === id);
    showPromoteUser.value = true;
}

function closePromote() {
    showPromoteUser.value = false;
}

function demoteUser(id) {
    userData.value = props.users.find(user => user.id === id);
    showDemoteUser.value = true;
}

function closeDemote() {
    showDemoteUser.value = false;
}

function deleteUser(id) {
    userData.value = props.users.find(user => user.id === id);
    showDeleteUser.value = true;
}

function closeDelete() {
    showDeleteUser.value = false;
}
</script>
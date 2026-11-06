<template>
    <!-- ------------------------------ EMPTY STATE ------------------------------ -->
    <div v-if="!leaderboard.length" class="w-full sm:w-[85%] lg:w-[65%] px-4">
        <div
            class="rounded-2xl border border-dashed sharedBorder sharedSurfaceBG shadow-lg sharedShadow
                    flex flex-col items-center text-center px-6 py-16 gap-4"
        >
            <div
                class="w-16 h-16 rounded-full border sharedRank1 sharedRankBox
                        flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 sharedRankText"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0"
                    />
                </svg>
            </div>

            <div class="flex flex-col gap-1">
                <h3 class="text-lg font-semibold sharedTXTBody">
                    No rankings yet
                </h3>
                <p class="text-sm sharedTXTMuted max-w-xs">
                    Nobody has scored any points. Once someone does, the podium will show up here.
                </p>
            </div>

            <slot name="empty-action" />
        </div>
    </div>

    <!-- ------------------------------ POPULATED ------------------------------ -->
    <template v-else>
        <div class="flex items-end justify-center gap-5 sm:gap-10 md:gap-14 w-full px-4">

            <!-- ----------------------------------------------------- SECOND ----------------------------------------------------------------- -->

            <div class="flex flex-col items-center gap-3 sharedRank2">

                <!-- No 2nd place yet -->
                <div
                    v-if="!leaderboard[1]"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full border border-dashed sharedRankEmpty"
                ></div>

                <!-- Initials avatar -->
                <div
                    v-else-if="!getProfileImage(leaderboard[1].user_id)"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full flex items-center justify-center ring-4 sharedRankRing"
                    :class="getTop(leaderboard[1].user_id)?.profile_color"
                >
                    <span class="text-3xl font-semibold">
                        {{ initials(getTop(leaderboard[1].user_id)?.name) }}
                    </span>
                </div>

                <!-- Photo avatar -->
                <img
                    v-else
                    :src="getProfileImage(leaderboard[1].user_id)"
                    :alt="getTop(leaderboard[1].user_id)?.name"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover ring-4 sharedRankRing"
                />

                <span
                    class="text-sm sm:text-base font-semibold text-center leading-tight"
                    :class="getTop(leaderboard[1]?.user_id)?.id === myId ? 'sharedTXTSuccess' : ''"
                >
                    {{ getTop(leaderboard[1]?.user_id)?.name }}
                    {{ getTop(leaderboard[1]?.user_id)?.id === myId ? ' (You)' : '' }}
                </span>

                <div
                    class="w-24 sm:w-28 h-20 sm:h-24 rounded-t-xl border sharedRankBox flex flex-col items-center justify-center gap-0.5"
                >
                    <span class="text-xl sm:text-2xl font-bold sharedRankText">
                        2nd
                    </span>
                    <span class="text-[10px] sm:text-xs font-medium sharedRankText">
                        {{ leaderboard[1]
                            ? `${leaderboard[1].points} ${leaderboard[1].points === 1 ? 'point' : 'points'}`
                            : 'No 2nd Place yet'
                        }}
                    </span>
                </div>
            </div>

            <!-- ----------------------------------------------------- FIRST ----------------------------------------------------------------- -->

            <div class="flex flex-col items-center gap-3 sharedRank1">

                <!-- Initials avatar -->
                <div
                    v-if="leaderboard[0] && !getProfileImage(leaderboard[0].user_id)"
                    class="w-32 h-32 sm:w-36 sm:h-36 rounded-full flex items-center justify-center ring-4 sharedRankRing"
                    :class="getTop(leaderboard[0].user_id)?.profile_color"
                >
                    <span class="text-5xl font-semibold">
                        {{ initials(getTop(leaderboard[0].user_id)?.name) }}
                    </span>
                </div>

                <!-- Photo avatar -->
                <img
                    v-else-if="leaderboard[0]"
                    :src="getProfileImage(leaderboard[0].user_id)"
                    :alt="getTop(leaderboard[0].user_id)?.name"
                    class="w-32 h-32 sm:w-36 sm:h-36 rounded-full object-cover ring-4 sharedRankRing"
                />

                <span
                    class="text-base sm:text-lg font-bold text-center leading-tight"
                    :class="getTop(leaderboard[0]?.user_id)?.id === myId ? 'sharedTXTSuccess' : ''"
                >
                    {{ getTop(leaderboard[0]?.user_id)?.name }}
                    {{ getTop(leaderboard[0]?.user_id)?.id === myId ? ' (You)' : '' }}
                </span>

                <div
                    class="w-32 sm:w-36 h-28 sm:h-32 rounded-t-xl border sharedRankBox flex flex-col items-center justify-center gap-0.5"
                >
                    <span class="text-2xl sm:text-3xl font-bold sharedRankText">
                        1st
                    </span>
                    <span class="text-xs sm:text-sm font-medium sharedRankText">
                        {{ leaderboard[0]
                            ? `${leaderboard[0].points} ${leaderboard[0].points === 1 ? 'point' : 'points'}`
                            : 'No 1st Place yet'
                        }}
                    </span>
                </div>
            </div>

            <!-- ----------------------------------------------------- THIRD ----------------------------------------------------------------- -->

            <div class="flex flex-col items-center gap-3 sharedRank3">

                <!-- No 3rd place yet -->
                <div
                    v-if="!leaderboard[2]"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full border border-dashed sharedRankEmpty"
                ></div>

                <!-- Initials avatar -->
                <div
                    v-else-if="!getProfileImage(leaderboard[2].user_id)"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full flex items-center justify-center ring-4 sharedRankRing"
                    :class="getTop(leaderboard[2].user_id)?.profile_color"
                >
                    <span class="text-3xl font-semibold">
                        {{ initials(getTop(leaderboard[2].user_id)?.name) }}
                    </span>
                </div>

                <!-- Photo avatar -->
                <img
                    v-else
                    :src="getProfileImage(leaderboard[2].user_id)"
                    :alt="getTop(leaderboard[2].user_id)?.name"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover ring-4 sharedRankRing"
                />

                <span
                    class="text-sm sm:text-base font-semibold text-center leading-tight"
                    :class="getTop(leaderboard[2]?.user_id)?.id === myId ? 'sharedTXTSuccess' : ''"
                >
                    {{ getTop(leaderboard[2]?.user_id)?.name }}
                    {{ getTop(leaderboard[2]?.user_id)?.id === myId ? ' (You)' : '' }}
                </span>

                <div
                    class="w-24 sm:w-28 h-20 sm:h-24 rounded-t-xl border sharedRankBox flex flex-col items-center justify-center gap-0.5"
                >
                    <span class="text-xl sm:text-2xl font-bold sharedRankText">
                        3rd
                    </span>
                    <span class="text-[10px] sm:text-xs font-medium sharedRankText">
                        {{ leaderboard[2]
                            ? `${leaderboard[2].points} ${leaderboard[2].points === 1 ? 'point' : 'points'}`
                            : 'No 3rd Place yet'
                        }}
                    </span>
                </div>
            </div>
        </div>

        <!-- ----------------------------------------------------- TABLE  ----------------------------------------------------------------- -->

        <div
            v-if="leaderboard.length > 3"
            class="w-full sm:w-[85%] lg:w-[65%] pt-10 px-4"
        >
            <div
                class="rounded-2xl sharedSurface shadow-lg sharedShadow overflow-hidden"
            >
                <div class="flex items-center px-5 py-3 text-xs font-medium sharedTXTMuted border-b sharedBorder">
                    <span class="w-12">Rank</span>
                    <span class="flex-1">Name</span>
                    <span>Points</span>
                </div>

                <div
                    v-for="(lb, index) in leaderboard.slice(3)"
                    :key="lb.id"
                    class="flex items-center px-5 py-3.5 border-b sharedBorder last:border-b-0 transition-colors duration-200"
                >
                    <span class="w-12 text-sm font-semibold sharedTXTAccent">
                        {{ ordinal(index + 4) }}
                    </span>

                    <div class="flex-1 flex items-center gap-3 min-w-0">
                        <!-- User photo -->
                        <img
                            v-if="getProfileImage(lb.user_id)"
                            :src="getProfileImage(lb.user_id)"
                            :alt="getName(lb.user_id)"
                            class="w-9 h-9 rounded-full object-cover shrink-0"
                        />

                        <!-- User initials -->
                        <div
                            v-else
                            class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 text-xs font-semibold"
                            :class="getTop(lb.user_id)?.profile_color"
                        >
                            {{ initials(getName(lb.user_id)) }}
                        </div>

                        <span
                            class="text-sm font-medium truncate"
                            :class="getTop(lb.user_id)?.id === myId ? 'sharedTXTSuccess' : ''"
                        >
                            {{ getName(lb.user_id) }}
                            {{ getTop(lb.user_id)?.id === myId ? ' (You)' : '' }}
                        </span>
                    </div>

                    <span class="text-sm font-bold tabular-nums sharedTXTBody">
                        {{ lb.points }} pts
                    </span>
                </div>
            </div>
        </div>
    </template>
</template>


<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    users: {
        type: Object,
        required: true
    },
    leaderboard: {
        type: Array,
        required: true
    },
    myId: {
        type: Number,
        required: true
    }
});

const usersData = ref({ ...props.users });

const getTop = (userId) => {
    return usersData.value[userId];
};

const getName = (userId) => {
    return getTop(userId)?.name || '';
};

const getProfileImage = (userId) => {
    const user = getTop(userId);

    return user?.profile_picture || user?.profile_avatar || '';
};

const initials = (name) => {
    if (!name) return '';

    return name
        .trim()
        .split(/\s+/)
        .filter(Boolean)
        .map(word => word.charAt(0))
        .join('')
        .slice(0, 2)
        .toUpperCase();
};

const ordinal = (number) => {
    if (number % 100 >= 11 && number % 100 <= 13) {
        return `${number}th`;
    }

    switch (number % 10) {
        case 1:
            return `${number}st`;
        case 2:
            return `${number}nd`;
        case 3:
            return `${number}rd`;
        default:
            return `${number}th`;
    }
};

const handleProfileUpdate = (event) => {
    const { type, imageUrl } = event.detail || {};

    if (!imageUrl) return;

    const userId = String(props.myId);
    const currentUser = usersData.value[userId];

    if (!currentUser) return;

    if (type === 'upload') {
        usersData.value[userId] = {
            ...currentUser,
            profile_picture: imageUrl,
            profile_avatar: null
        };
    } else if (type === 'preset') {
        usersData.value[userId] = {
            ...currentUser,
            profile_picture: null,
            profile_avatar: imageUrl
        };
    }
};

onMounted(() => {
    window.addEventListener('profile-updated', handleProfileUpdate);
});

onUnmounted(() => {
    window.removeEventListener('profile-updated', handleProfileUpdate);
});
</script>
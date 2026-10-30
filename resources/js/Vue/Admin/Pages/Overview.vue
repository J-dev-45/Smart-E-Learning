<template>

    <div class="w-full shrink-0 md:shrink md:flex-1 md:min-h-0 grid grid-cols-1 md:grid-cols-[1.3fr_1fr] gap-4 md:gap-6">

        <!-- RECENT ACTIVITY -->
        <div class="border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 backdrop-blur-sm p-3 sm:p-4 rounded-md flex flex-col h-[26rem] md:h-full min-h-0 transition-all hover:border-[#CECBF6]/30 hover:bg-[#CECBF6]/10">
            <div class="flex items-center justify-between mb-3">
                <span class="text-md font-semibold text-white">Recent Activity</span>
                <span class="text-gray-400 text-xs uppercase tracking-wide">Live</span>
            </div>

            <ul class="flex flex-col flex-1 min-h-0 overflow-y-auto scrollbar-thin pr-1 -mr-1">

                <!-- ACTIVITY ITEM -->
                <li
                    v-for="act in recentActivities"
                    :key="act.id"
                    class="flex items-start gap-3 py-3 px-3 border-b border-[#CECBF6]/10 last:border-b-0 transition-colors hover:bg-[#CECBF6]/5 rounded-md px-1 -mx-1"
                >
                    <!-- ICON -->
                    <div
                        class="shrink-0 w-9 h-9 flex items-center justify-center rounded-md border-[1.5px]"
                        :class="svg_style(act.action)"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" :d="activity_svg(act.action)" />
                        </svg>
                    </div>

                    <!-- NAME, MESSAGE, DETAIL PILLS -->
                    <div class="flex flex-col gap-1.5 min-w-0 flex-1">
                        <span class="text-sm leading-snug break-words">
                            <strong class="text-white font-medium">{{ act.name }}</strong>
                            <span class="text-gray-400">{{ ' ' + message(act) }}</span>
                        </span>

                        <!-- Pill row: 2 pills (subject/topic or role change), 1 pill (single detail), or none -->
                        <div v-if="pillLeft(act)" class="flex flex-wrap items-center gap-1.5">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded border text-xs truncate max-w-[140px] sm:max-w-[220px]"
                                :class="pillLeftStyle(act)"
                            >
                                {{ pillLeft(act) }}
                            </span>
                            <template v-if="pillRight(act)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3 text-gray-600 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded border text-xs truncate max-w-[110px] sm:max-w-[160px]"
                                    :class="pillRightStyle(act)"
                                >
                                    {{ pillRight(act) }}
                                </span>
                            </template>
                        </div>

                        <span class="text-xs text-gray-500">{{ formatTimeAgo(act.created_at) }}</span>
                    </div>
                </li>

                <li v-if="recentActivities.length === 0" class="flex flex-col items-center justify-center gap-2 py-10 text-center">
                    <span class="text-gray-500 text-sm">No recent activity yet</span>
                </li>

            </ul>
        </div>

        <!-- LEADERBOARDS -->
        <div class="border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 backdrop-blur-sm p-3 sm:p-4 rounded-md flex flex-col h-[26rem] md:h-full min-h-0 transition-all hover:border-[#CECBF6]/30 hover:bg-[#CECBF6]/10">
            <div class="flex items-center justify-between mb-3">
                <span class="text-md font-semibold text-white">Leaderboards</span>
                <span class="text-gray-400 text-xs uppercase tracking-wide">This Month</span>
            </div>

            <ul class="flex flex-col flex-1 min-h-0 overflow-y-auto scrollbar-thin pr-1 -mr-1">

                <li
                    v-for="(rank, index) in sorted_by_points"
                    :key="rank.id"
                    class="flex items-center gap-3 py-2.5 px-2 rounded-md border-b border-[#CECBF6]/10 last:border-b-0 transition-colors hover:bg-[#CECBF6]/5"
                >
                    <!-- RANK -->
                    <div
                        class="shrink-0 w-8 h-8 flex items-center justify-center rounded-md border-[1.5px]"
                        :class="rankStyle(index).badge"
                    >
                        <span
                            class="font-bold text-sm"
                            :class="rankStyle(index).text"
                        >{{ index + 1 }}</span>
                    </div>

                    <!-- AVATAR -->
                    <div class="shrink-0 w-8 h-8 rounded-full bg-[#4C1D95]/30 border border-[#CECBF6]/15 flex items-center justify-center text-xs font-semibold text-white">
                        {{ initials(rank.name) }}
                    </div>

                    <!-- NAME AND SCORE -->
                    <div class="flex flex-col min-w-0 flex-1">
                        <span class="text-sm text-white font-medium truncate">{{ rank.name }}</span>
                        <span class="text-xs text-gray-500">{{ rank.points.toLocaleString() }} pts</span>
                    </div>
                </li>



                <li
                    v-if="leaderboard.length === 0"
                    class="flex flex-col items-center justify-center gap-2 py-10 text-center">
                    <span class="text-gray-500 text-sm">No rankings yet this month</span>
                </li>

            </ul>
        </div>

    </div>

</template>

<script setup>

const props = defineProps({
    recentActivities: { type: Array, default: ()=>[]},
})

const leaderboard = [

]

const sorted_by_points = leaderboard.sort((a, b) => b.points - a.points);

const RANK_STYLES = [
    { badge: 'border-yellow-400/30 bg-yellow-400/10', text: 'text-yellow-400' },
    { badge: 'border-blue-300/30 bg-blue-300/10', text: 'text-blue-300' },
    { badge: 'border-green-400/30 bg-green-400/10', text: 'text-green-400' },
]
const DEFAULT_RANK_STYLE = { badge: 'border-[#CECBF6]/20 bg-[#CECBF6]/5', text: 'text-gray-300' }

function rankStyle(index) {
    return RANK_STYLES[index] ?? DEFAULT_RANK_STYLE
}

function initials(name) {
    return name
        .split(' ')
        .map(part => part[0])
        .join('')
        .slice(0, 2)
        .toUpperCase()
}



const svg_d = [
    { action: 'deleted_question', d: 'm14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0'},
    { action: 'edited_question', d: 'm16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125'},
    { action: 'added_question', d: 'M12 4.5v15m7.5-7.5h-15'},
    { action: 'promoted_user', d: 'M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.28m5.94 2.28-2.28 5.941'},
    { action: 'demoted_user', d: 'M2.25 6 9 12.75l4.306-4.306a11.95 11.95 0 0 1 5.814 5.518l2.74 1.22m0 0-5.94 2.28m5.94-2.28-2.28-5.941'},
    { action: 'deleted_user', d: 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm5.25 3.375h3'},
    { action: 'added_module', d: 'M12 4.5v15m7.5-7.5h-15' },
    { action: 'edited_module', d: 'm16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125' },
    { action: 'deleted_module', d: 'm14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0' },
    { action: 'added_topic', d: 'M12 4.5v15m7.5-7.5h-15'},
    { action: 'edited_topic', d: 'm16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125'},
    { action: 'deleted_topic', d: 'm14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0'},
    { action: 'added_subject', d: 'M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25'},
    { action: 'edited_subject', d: 'm16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125'},
    { action: 'deleted_subject', d: 'm14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0'},
    { action: 'replied_feedback', d: 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.032 2.76 3.24a49.109 49.109 0 0 0 3.65.325'},
    { action: 'deleted_feedback', d: 'm14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0'},
]


const icon_style = [
    { action: 'deleted_question', badge: 'border-red-500/20 bg-red-500/10 text-red-400'},
    { action: 'edited_question', badge: 'border-amber-400/20 bg-amber-400/10 text-amber-400'},
    { action: 'added_question', badge: 'border-emerald-400/20 bg-emerald-400/10 text-emerald-400'},
    { action: 'promoted_user', badge: 'border-violet-400/20 bg-violet-400/10 text-violet-400'},
    { action: 'demoted_user', badge: 'border-rose-400/20 bg-rose-400/10 text-rose-400'},
    { action: 'deleted_user', badge: 'border-red-500/20 bg-red-500/10 text-red-400'},
    { action: 'added_module', badge: 'border-emerald-400/20 bg-emerald-400/10 text-emerald-400' },
    { action: 'edited_module', badge: 'border-amber-400/20 bg-amber-400/10 text-amber-400' },
    { action: 'deleted_module', badge: 'border-red-500/20 bg-red-500/10 text-red-400' },
    { action: 'added_topic', badge: 'border-sky-400/20 bg-sky-400/10 text-sky-400'},
    { action: 'edited_topic', badge: 'border-amber-400/20 bg-amber-400/10 text-amber-400'},
    { action: 'deleted_topic', badge: 'border-red-500/20 bg-red-500/10 text-red-400'},
    { action: 'added_subject', badge: 'border-cyan-400/20 bg-cyan-400/10 text-cyan-400'},
    { action: 'edited_subject', badge: 'border-amber-400/20 bg-amber-400/10 text-amber-400'},
    { action: 'deleted_subject', badge: 'border-red-500/20 bg-red-500/10 text-red-400'},
    { action: 'replied_feedback', badge: 'border-indigo-400/20 bg-indigo-400/10 text-indigo-400'},
    { action: 'deleted_feedback', badge: 'border-red-500/20 bg-red-500/10 text-red-400'},
]

function activity_svg(action){
    return svg_d.find(s => s.action === action)?.d;
}

function svg_style(action){
    return icon_style.find(i => i.action === action)?.badge;
}


function message(act){
    switch (act.action) {
        case 'deleted_question': return 'deleted a question';
        case 'edited_question': return 'edited a question';
        case 'added_question': return 'added a question';

        case 'promoted_user': return `promoted ${act.target} to`;
        case 'demoted_user': return `demoted ${act.target} to`;
        case 'deleted_user': return `deleted ${act.target}'s account`;

        case 'added_topic': return 'added a new topic';
        case 'edited_topic': return 'edited a topic';
        case 'deleted_topic': return 'deleted a topic';
        
        case 'added_module': return 'added a new module';
        case 'edited_module': return 'edited a module';
        case 'deleted_module': return 'deleted a module';

        case 'added_subject': return 'added a new subject';
        case 'edited_subject': return 'edited a subject';
        case 'deleted_subject': return 'deleted a subject';

        case 'replied_feedback': return `replied to ${act.target}'s feedback`;
        case 'deleted_feedback': return `deleted ${act.target}'s feedback`;
        default: return '';
    }
}


function pillLeft(act){
    switch (act.action) {
        case 'deleted_question':
        case 'edited_question':
        case 'added_question':
            return act.topic;
        case 'added_module':
        case 'edited_module':
        case 'deleted_module':
            return act.subject;
        case 'added_topic':
        case 'edited_topic':
        case 'deleted_topic':
            return act.subject;
        case 'promoted_user':
        case 'demoted_user':
            return act.from_role;
        default:
            return null;
    }
}

function pillRight(act){
    switch (act.action) {
        case 'deleted_question':
        case 'edited_question':
        case 'added_question':
            return act.subject;
        case 'added_module':
        case 'edited_module':
        case 'deleted_module':
            return act.module;
        case 'added_topic':
        case 'edited_topic':
        case 'deleted_topic':
            return act.topic;
        case 'added_subject':
        case 'edited_subject':
        case 'deleted_subject':
            return act.subject;
        case 'promoted_user':
        case 'demoted_user':
            return act.to_role;
        case 'replied_feedback':
        case 'deleted_feedback':
            return act.feedback;
        default:
            return null;
    }
}

function pillLeftStyle(act){
    if (act.action === 'deleted_feedback') {
        return 'border-red-400/20 bg-red-400/5 text-red-300/70 line-through'
    }
    return 'border-[#CECBF6]/20 bg-[#CECBF6]/5 text-gray-300'
}

function pillRightStyle(act){
    if (act.action === 'promoted_user') return 'border-violet-400/20 bg-violet-400/10 text-violet-300'
    if (act.action === 'demoted_user') return 'border-rose-400/20 bg-rose-400/10 text-rose-300'
    return 'border-[#CECBF6]/20 bg-[#CECBF6]/5 text-gray-300'
}

const formatTimeAgo = (date) => {
    const seconds = Math.floor((new Date() - new Date(date)) / 1000);

    if (seconds < 5) {
        return 'Just now';
    }

    if (seconds < 60) {
        return `${seconds} seconds ago`;
    }

    const minutes = Math.floor(seconds / 60);

    if (minutes < 60) {
        if(minutes < 1){
            return `${minutes} minute ago`;
        }
        return `${minutes} minutes ago`;
    }

    const hours = Math.floor(minutes / 60);

    if (hours < 24) {
        if(hours < 1){
            return `${hours} hour ago`;
        }
        return `${hours} hours ago`;
    }

    const days = Math.floor(hours / 24);

    if (days < 30) {
        if(days < 1){
            return `${days} day ago`;
        }
        return `${days} days ago`;
    }

    const months = Math.floor(days / 30);

    if (months < 12) {
        if(months < 1){
            return `${months} month ago`;
        }
        return `${months} months ago`;
    }

    const years = Math.floor(months / 12);

    return `${years} years ago`;
};

</script>
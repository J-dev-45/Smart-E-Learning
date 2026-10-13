<template>
    <nav class="w-[280px] h-screen fixed top-0 left-0 bg-white border-r border-gray-200 flex flex-col overflow-hidden">
        <!-- Brand (fixed) -->
        <div class="w-full flex items-center h-[60px] px-5 border-b border-gray-200 shrink-0 bg-gradient-to-r from-[#1A0B2E] to-[#4C1D95]">
            <div class="font-bold text-[15px] tracking-tight text-white">
                Smart <span class="text-purple-300">E-Learning</span>
            </div>
        </div>

        <!-- Course label (fixed) -->
        <div class="px-5 pt-4 pb-2 shrink-0">
            <div class="text-[10px] font-bold uppercase tracking-wider text-purple-500">Course</div>
            <div class="text-[13px] font-bold text-gray-800 mt-0.5">{{ subjectName }}</div>
        </div>

        

        <div class="w-full h-px bg-gray-200 shrink-0"></div>

        <!-- Chapter list (scrollable only) -->
        <ul class="topics-scroll w-full flex-1 min-h-0 overflow-y-auto flex flex-col text-[13px] py-1">
            <template v-for="module in modules" :key="module.id">

                <!-- LOCKED MODULE -->
                <li v-if="statusChecker(module.id) === 'locked'" class="cursor-not-allowed">
                    <div class="px-5 py-[7px] flex items-center justify-between border-l-[3px] border-transparent text-gray-600">
                        <span class="flex items-center gap-1.5">
                            <svg
                                class="w-3 h-3 shrink-0 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                />
                            </svg>

                            <span>
                                <span class="text-gray-400 font-medium mr-1.5">
                                    {{ module.order }}.
                                </span>

                                {{ module.module_name }}
                            </span>
                        </span>
                    </div>
                </li>

                <!-- ACTIVE / EXPANDED MODULE -->
                <template v-else-if="statusChecker(module.id) === 'open'">
                    <li
                        v-if="module.order === expandedModuleOrder"
                        class="cursor-pointer"
                    >
                        <div
                            @click="toggleModule(module.order)"
                            class="px-5 py-[7px] flex items-center justify-between bg-[#4C1D95]/10 text-[#4C1D95] font-semibold border-l-[3px] border-[#4C1D95]"
                        >
                            <span>
                                <span class="text-purple-400 font-medium mr-1.5">
                                    {{ module.order }}.
                                </span>

                                {{ module.module_name }}
                            </span>

                            <svg
                                class="w-3 h-3 shrink-0 rotate-180"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </div>

                        <ul class="flex flex-col bg-[#FBFAFE] border-l-[3px] border-[#4C1D95]">
                            <template
                                v-for="topic in topics.filter(topic => topic.module_id === module.id)"
                                :key="topic.id"
                            >
                                <input
                                    type="hidden"
                                    :value="module.id"
                                >

                                <input
                                    type="hidden"
                                    :value="topic.id"
                                >

                                <li
                                    :class="[
                                        'pl-9 pr-5 py-[6px] text-[12.5px] transition-colors flex items-center gap-2',
                                        topic.slug === activeTopicSlug
                                            ? 'text-[#4C1D95] font-semibold'
                                            : 'text-gray-500'
                                    ]"
                                >
                                    <!-- Completed -->
                                    <svg
                                        v-if="topicStatusChecker(topic.id) === 'completed'"
                                        class="w-3.5 h-3.5 shrink-0"
                                        viewBox="0 0 16 16"
                                    >
                                        <circle
                                            cx="8"
                                            cy="8"
                                            r="7"
                                            fill="#4C1D95"
                                        />

                                        <path
                                            d="M5 8.2l2 2 4-4.4"
                                            stroke="white"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            fill="none"
                                        />
                                    </svg>

                                    <!-- Reading progress -->
                                    <svg
                                        v-else
                                        class="w-3.5 h-3.5 shrink-0"
                                        viewBox="0 0 16 16"
                                    >
                                        <circle
                                            cx="8"
                                            cy="8"
                                            r="6.25"
                                            fill="none"
                                            stroke="#D1D5DB"
                                            stroke-width="1.5"
                                        />

                                        <circle
                                            cx="8"
                                            cy="8"
                                            r="6.25"
                                            fill="none"
                                            stroke="#4C1D95"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            transform="rotate(-90 8 8)"
                                            :stroke-dasharray="CIRCUMFERENCE"
                                            :stroke-dashoffset="CIRCUMFERENCE * (1 - topicPercent(topic) / 100)"
                                        />
                                    </svg>

                                    {{ topic.topic_name }}
                                </li>
                            </template>
                        </ul>
                    </li>

                    <!-- COLLAPSED MODULE -->
                    <li
                        v-else
                        class="cursor-pointer"
                    >
                        <div
                            @click="toggleModule(module.order)"
                            :class="[
                                'px-5 py-[7px] flex items-center justify-between border-l-[3px]',
                                module.order === activeModuleOrder
                                    ? 'text-[#4C1D95] font-semibold border-transparent bg-[#4C1D95]/5'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-[#4C1D95] border-transparent'
                            ]"
                        >
                            <span>
                                <span
                                    :class="module.order === activeModuleOrder ? 'text-purple-400' : 'text-gray-400'"
                                    class="font-medium mr-1.5"
                                >
                                    {{ module.order }}.
                                </span>

                                {{ module.module_name }}
                            </span>

                            <svg
                                class="w-3 h-3 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </div>
                    </li>
                </template>

                <!-- ANY OTHER STATUS -->
                <li
                    v-else
                    class="cursor-pointer"
                >
                    <div
                        @click="toggleModule(module.order)"
                        :class="[
                            'px-5 py-[7px] flex items-center justify-between border-l-[3px]',
                            module.order === activeModuleOrder
                                ? 'text-[#4C1D95] font-semibold border-transparent bg-[#4C1D95]/5'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-[#4C1D95] border-transparent'
                        ]"
                    >
                        <span>
                            <span
                                :class="module.order === activeModuleOrder ? 'text-purple-400' : 'text-gray-400'"
                                class="font-medium mr-1.5"
                            >
                                {{ module.order }}.
                            </span>

                            {{ module.module_name }}
                        </span>

                        <svg
                            class="w-3 h-3 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </div>
                </li>

            </template>
        </ul>
    </nav>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'

const props = defineProps({
    modules: {
        type: Array,
        required: true
    },
    topics: {
        type: Array,
        required: true
    },
    subjectName: {
        type: String,
        required: true
    },
    subjectId: {
        type: String,
        required: true
    },
    subjectProgresses: {
        type: Array,
        required: true
    },
    moduleProgresses: {
        type: Array,
        required: true
    },
    topicProgresses: {
        type: Array,
        required: true
    }
})

const CIRCUMFERENCE = 2 * Math.PI * 6.25
const READING_CAP = 80

const firstTopic = props.topics[0] ?? null

const firstModule = firstTopic
    ? props.modules.find(
        module => module.id === firstTopic.module_id
    )
    : props.modules[0] ?? null

const activeTopicSlug = ref(
    firstTopic?.slug ?? null
)

const activeModuleOrder = ref(
    firstModule?.order ?? null
)

const expandedModuleOrder = ref(
    firstModule?.order ?? null
)

/*
|--------------------------------------------------------------------------
| Current visual reading progress
|--------------------------------------------------------------------------
*/
const topicPercents = ref(
    Object.fromEntries(
        props.topics.map(topic => {
            const progress = props.topicProgresses.find(
                tp =>
                    tp.topic_id === topic.id ||
                    tp.id === topic.id
            )

            return [
                topic.slug,
                Number(
                    progress?.scroll_progress ??
                    progress?.progress ??
                    0
                )
            ]
        })
    )
)

/*
|--------------------------------------------------------------------------
| Highest progress already saved in DB
|--------------------------------------------------------------------------
*/
const savedTopicPercents = ref(
    Object.fromEntries(
        props.topics.map(topic => {
            const progress = props.topicProgresses.find(
                tp =>
                    tp.topic_id === topic.id ||
                    tp.id === topic.id
            )

            return [
                topic.slug,
                Number(
                    progress?.scroll_progress ??
                    progress?.progress ??
                    0
                )
            ]
        })
    )
)

/*
|--------------------------------------------------------------------------
| Prevent multiple simultaneous requests for the same topic.
|--------------------------------------------------------------------------
*/
const savingProgress = ref({})

let observer = null

function statusChecker(mid) {
    const found = props.moduleProgresses.find(
        mp =>
            mp.id === mid ||
            mp.module_id === mid
    )

    return found?.status
}

function topicStatusChecker(tid) {
    const found = props.topicProgresses.find(
        tp =>
            tp.id === tid ||
            tp.topic_id === tid
    )

    return found?.status
}

function quizPassed(tid) {
    const found = props.topicProgresses.find(
        tp =>
            tp.id === tid ||
            tp.topic_id === tid
    )

    return !!(
        found?.quiz_passed ??
        found?.pretest_passed ??
        found?.quizPassed ??
        false
    )
}

function readingPercent(slug) {
    return Number(
        topicPercents.value[slug] ?? 0
    )
}

function topicPercent(topic) {
    if (quizPassed(topic.id)) {
        return 100
    }

    return readingPercent(topic.slug)
}

const overallProgress = computed(() => {
    const total = props.topics.length

    if (total === 0) {
        return 0
    }

    const completedCount = props.topics.filter(
        topic =>
            topicStatusChecker(topic.id) === 'completed'
    ).length

    return Math.round(
        (completedCount / total) * 100
    )
})

function getScrollRoot() {
    return document.querySelector('main')
}

/*
|--------------------------------------------------------------------------
| Calculate reading progress.
|
| IMPORTANT:
| - Progress never decreases.
| - Previous topics become 80%.
| - When the scroll container reaches its absolute bottom,
|   the active topic becomes 80%.
|--------------------------------------------------------------------------
*/
function updateTopicPercents() {
    const scrollRoot = getScrollRoot()

    if (!scrollRoot) {
        return
    }

    const readLine =
        scrollRoot.getBoundingClientRect().top + 130

    const activeIndex = props.topics.findIndex(
        topic =>
            topic.slug === activeTopicSlug.value
    )

    const next = {
        ...topicPercents.value
    }

    /*
    |--------------------------------------------------------------------------
    | Detect absolute bottom of the actual scroll container.
    |--------------------------------------------------------------------------
    */
    const atBottom =
        scrollRoot.scrollTop +
        scrollRoot.clientHeight >=
        scrollRoot.scrollHeight - 5

    props.topics.forEach((topic, index) => {

        /*
        |--------------------------------------------------------------------------
        | All topics before the active topic are fully read.
        |--------------------------------------------------------------------------
        */
        if (
            activeIndex !== -1 &&
            index < activeIndex
        ) {
            next[topic.slug] = Math.max(
                Number(next[topic.slug] ?? 0),
                READING_CAP
            )

            return
        }

        /*
        |--------------------------------------------------------------------------
        | Topics after the active topic are not changed.
        |--------------------------------------------------------------------------
        */
        if (
            activeIndex !== -1 &&
            index > activeIndex
        ) {
            return
        }

        /*
        |--------------------------------------------------------------------------
        | If the user reached the absolute bottom,
        | mark the active topic as fully read.
        |--------------------------------------------------------------------------
        */
        if (
            atBottom &&
            topic.slug === activeTopicSlug.value
        ) {
            next[topic.slug] = Math.max(
                Number(next[topic.slug] ?? 0),
                READING_CAP
            )

            return
        }

        const el = document.getElementById(
            topic.slug
        )

        if (!el) {
            return
        }

        const rect = el.getBoundingClientRect()

        const read =
            readLine - rect.top

        const raw =
            rect.height <= 0
                ? 0
                : Math.max(
                    0,
                    Math.min(
                        READING_CAP,
                        Math.round(
                            (read / rect.height) *
                            READING_CAP
                        )
                    )
                )

        const previous = Number(
            next[topic.slug] ?? 0
        )

        /*
        |--------------------------------------------------------------------------
        | NEVER decrease progress.
        |--------------------------------------------------------------------------
        */
        next[topic.slug] = Math.max(
            previous,
            raw
        )
    })

    topicPercents.value = next
}

/*
|--------------------------------------------------------------------------
| Get module belonging to topic.
|--------------------------------------------------------------------------
*/
function getModuleFromTopic(topic) {
    if (!topic) {
        return null
    }

    return props.modules.find(
        module =>
            module.id === topic.module_id
    ) ?? null
}

/*
|--------------------------------------------------------------------------
| Toggle module.
|--------------------------------------------------------------------------
*/
function toggleModule(moduleOrder) {
    if (
        expandedModuleOrder.value ===
        moduleOrder
    ) {
        expandedModuleOrder.value = null
        return
    }

    expandedModuleOrder.value =
        moduleOrder
}

/*
|--------------------------------------------------------------------------
| Save topic progress.
|
| Only saves:
| 5, 10, 15, 20, 25...
|
| Never saves a lower value.
|--------------------------------------------------------------------------
*/
async function updateTopicProgress(
    moduleId,
    topicId,
    topicSlug
) {
    if (savingProgress.value[topicId]) {
        return
    }

    const currentPercent = Number(
        readingPercent(topicSlug)
    )

    const savedPercent = Number(
        savedTopicPercents.value[topicSlug] ?? 0
    )

    /*
    |--------------------------------------------------------------------------
    | Scrolled backward.
    | Do nothing.
    |--------------------------------------------------------------------------
    */
    if (currentPercent <= savedPercent) {
        return
    }

    const currentMilestone =
        Math.floor(currentPercent / 5) * 5

    const savedMilestone =
        Math.floor(savedPercent / 5) * 5

    if (
        currentMilestone <=
        savedMilestone
    ) {
        return
    }

    savingProgress.value = {
        ...savingProgress.value,
        [topicId]: true
    }

    try {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')?.getAttribute('content')

        if (!csrfToken) {
            console.error('CSRF token not found.')
            return
        }

        const response = await fetch('/topic-progress',{
                method: 'PUT',
                credentials: 'same-origin',
                headers: {
                    'Content-Type':
                        'application/json',

                    'X-CSRF-TOKEN':
                        csrfToken,

                    'X-Requested-With':
                        'XMLHttpRequest',

                    'Accept':
                        'application/json'
                },
                body: JSON.stringify({
                    subject_id:
                        props.subjectId,

                    module_id:
                        moduleId,

                    topic_id:
                        topicId,

                    topic_percent:
                        currentMilestone
                })
            }
        )

        const data =
            await response.json()

        if (
            !response.ok ||
            !data.success
        ) {
            console.error(
                'Topic progress update failed:',
                data
            )

            return
        }

        const savedProgress =
            Number(
                data.topic_progress
                    ?.scroll_progress ??
                data.topic_progress
                    ?.progress ??
                currentMilestone
            )

        const highestSavedProgress =
            Math.max(
                Number(
                    savedTopicPercents
                        .value[topicSlug] ?? 0
                ),
                savedProgress
            )

        savedTopicPercents.value = {
            ...savedTopicPercents.value,

            [topicSlug]:
                highestSavedProgress
        }

        topicPercents.value = {
            ...topicPercents.value,

            [topicSlug]:
                Math.max(
                    Number(
                        topicPercents
                            .value[topicSlug] ?? 0
                    ),
                    highestSavedProgress
                )
        }

    } catch (error) {
        console.error(
            'Topic progress error:',
            error
        )
    } finally {
        savingProgress.value = {
            ...savingProgress.value,
            [topicId]: false
        }
    }
}

/*
|--------------------------------------------------------------------------
| Check if a new 5% milestone was reached.
|--------------------------------------------------------------------------
*/
async function saveTopicProgressIfNeeded() {
    const currentTopicSlug =
        activeTopicSlug.value

    if (!currentTopicSlug) {
        return
    }

    const topic =
        props.topics.find(
            topic =>
                topic.slug ===
                currentTopicSlug
        )

    if (!topic) {
        return
    }

    const currentPercent =
        Number(
            readingPercent(
                currentTopicSlug
            )
        )

    const savedPercent =
        Number(
            savedTopicPercents
                .value[currentTopicSlug] ?? 0
        )

    /*
    |--------------------------------------------------------------------------
    | User scrolled backward.
    |--------------------------------------------------------------------------
    */
    if (
        currentPercent <=
        savedPercent
    ) {
        return
    }

    const currentMilestone =
        Math.floor(
            currentPercent / 5
        ) * 5

    const savedMilestone =
        Math.floor(
            savedPercent / 5
        ) * 5

    /*
    |--------------------------------------------------------------------------
    | No new milestone.
    |--------------------------------------------------------------------------
    */
    if (
        currentMilestone <=
        savedMilestone
    ) {
        return
    }

    await updateTopicProgress(
        topic.module_id,
        topic.id,
        currentTopicSlug
    )
}

/*
|--------------------------------------------------------------------------
| Handle scroll in ONE place.
|
| This guarantees that progress is calculated first,
| then saved after the calculation.
|--------------------------------------------------------------------------
*/
function handleScroll() {
    updateTopicPercents()

    requestAnimationFrame(() => {
        saveTopicProgressIfNeeded()
    })
}

onMounted(() => {
    const scrollRoot =
        getScrollRoot()

    if (!scrollRoot) {
        return
    }

    /*
    |--------------------------------------------------------------------------
    | One scroll listener only.
    |--------------------------------------------------------------------------
    */
    scrollRoot.addEventListener(
        'scroll',
        handleScroll,
        {
            passive: true
        }
    )

    window.addEventListener(
        'resize',
        updateTopicPercents
    )

    /*
    |--------------------------------------------------------------------------
    | Initial calculation.
    |--------------------------------------------------------------------------
    */
    updateTopicPercents()

    observer =
        new IntersectionObserver(
            entries => {
                const visible =
                    entries
                        .filter(
                            entry =>
                                entry.isIntersecting
                        )
                        .sort(
                            (a, b) =>
                                a.boundingClientRect.top -
                                b.boundingClientRect.top
                        )

                if (
                    visible.length > 0
                ) {
                    const match =
                        props.topics.find(
                            topic =>
                                topic.slug ===
                                visible[0]
                                    .target.id
                        )

                    if (match) {
                        const module =
                            getModuleFromTopic(
                                match
                            )

                        activeTopicSlug.value =
                            match.slug

                        activeModuleOrder.value =
                            module?.order ??
                            null

                        expandedModuleOrder.value =
                            module?.order ??
                            null

                        /*
                        |--------------------------------------------------------------------------
                        | Recalculate after active topic changes.
                        |--------------------------------------------------------------------------
                        */
                        requestAnimationFrame(
                            () => {
                                updateTopicPercents()

                                saveTopicProgressIfNeeded()
                            }
                        )
                    }
                }
            },
            {
                root: scrollRoot,

                rootMargin:
                    '-10% 0px -70% 0px',

                threshold: 0
            }
        )

    props.topics.forEach(
        topic => {
            const el =
                document.getElementById(
                    topic.slug
                )

            if (el) {
                observer.observe(el)
            }
        }
    )
})

onBeforeUnmount(() => {
    const scrollRoot =
        getScrollRoot()

    if (scrollRoot) {
        scrollRoot.removeEventListener(
            'scroll',
            handleScroll
        )
    }

    window.removeEventListener(
        'resize',
        updateTopicPercents
    )

    if (observer) {
        observer.disconnect()
    }
})
</script>
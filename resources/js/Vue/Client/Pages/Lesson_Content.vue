<template>
    <div class="w-full max-w-5xl mx-auto min-w-0">

        <article
            v-for="(topic, topicIndex) in topics"
            :key="topic.id"
            :id="topic.slug"
            class="mt-10 mb-20 scroll-mt-[130px] min-w-0 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow"
        >
            <h2 class="text-2xl font-bold sharedTXT">
                {{ topicIndex + 1 }}. {{ topic.topic_name }}
            </h2>

            <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
                <div class="sharedLine w-full h-[1px]"></div>
            </div>

            <p class="text-md sharedTXTMuted px-3 mt-4 leading-relaxed whitespace-pre-line">
                {{ formattedDescription(topic.id) }}
            </p>

            <section
                v-if="getLesson(topic)?.content"
                class="mt-6 min-w-0"
            >
                <div
                    class="lesson-content"
                    v-html="getLessonHtml(topic)"
                ></div>
            </section>

            <div
                v-if="!getLesson(topic)?.content"
                class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-4 flex items-center gap-3"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 shrink-0 sharedTXTMuted">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>

                <p class="text-md sharedTXTMuted leading-relaxed">
                    No lesson content is available for this topic yet.
                </p>
            </div>
        </article>

        <div
            v-if="!topics.length"
            class="mt-10 sharedSurfaceBG border sharedBorder rounded-xl p-8 text-center sharedTXTMuted"
        >
            No lesson content is available for this module yet.
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    topics: {
        type: Array,
        default: () => []
    }
})

function getLesson(topic) {
    return topic.lesson_content || null
}

// Wraps every table in a scrollable container so wide tables
// (e.g. pasted from Word) scroll inside the card instead of overflowing it.
function getLessonHtml(topic) {
    const html = getLesson(topic)?.content || ''
    return html
        .replace(/<table/gi, '<div class="table-scroll"><table')
        .replace(/<\/table>/gi, '</table></div>')
}

const selectedTopic = (t_id) => {
    return props.topics.find(topic => topic.id === t_id);
};

const formattedDescription = (t_id) => {
    return (selectedTopic(t_id)?.description || '')
        .replace(/\\\r\\\n|\\\n|\\\r/g, '\n');
};
</script>



<style scoped>
:deep(.lesson-content h3:not(:has(p))) {
    color: #FFFFFF !important;
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    line-height: 1.5;
    margin-top: 1.5rem !important;
    margin-bottom: 0 !important;
}

:deep(.lesson-content h3:has(br)) {
    display: none !important;
}

:deep(.lesson-content h3:has(> p)) {
    font-size: 1rem !important;
    font-weight: 400 !important;
    line-height: normal;
    margin-top: 0.75rem !important;
    margin-bottom: 0 !important;
}

:deep(.lesson-content h3 > p),
:deep(.lesson-content > p) {
    color: #B9B9E3 !important;
    font-size: 1rem !important;
    font-weight: 400 !important;
    padding-left: 0.75rem !important;
    padding-right: 0.75rem !important;
    margin-top: 0.75rem !important;
    margin-bottom: 0 !important;
    line-height: 1.625 !important;
}

:deep(.lesson-content p .sharedTXT) {
    color: #FFFFFF !important;
}

/* ---------- Table overflow fix (Word paste) ---------- */

/* Lets the content shrink inside flex/grid parents and never push the card wider */
:deep(.lesson-content) {
    min-width: 0;
    max-width: 100%;
}

/* Scroll wrapper added by getLessonHtml() */
:deep(.table-scroll) {
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin: 1rem 0;
}

/* Override Word's fixed inline widths (width="600", style="width:...") */
:deep(.table-scroll table) {
    width: auto !important;
    min-width: 100%;
    max-width: none !important;
    table-layout: auto !important;
    border-collapse: collapse;
}

:deep(.table-scroll colgroup),
:deep(.table-scroll col) {
    width: auto !important;
}

:deep(.table-scroll th),
:deep(.table-scroll td) {
    width: auto !important;
    min-width: 110px !important;
    white-space: normal !important;
    overflow-wrap: break-word;
    vertical-align: top;
}

/* Word wraps cell text in <p> with its own margins */
:deep(.table-scroll th p),
:deep(.table-scroll td p) {
    margin: 0 !important;
    padding: 0 !important;
}
</style>
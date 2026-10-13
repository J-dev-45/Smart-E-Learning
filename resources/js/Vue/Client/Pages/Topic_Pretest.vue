<template>
    <form @submit.prevent="submitAnswers" class="flex flex-col gap-5 p-5 bg-white rounded-xl border border-gray-200 shadow-sm mt-5">
        <div
            v-for="(quest, index) in questions"
            :key="quest.id"
            class="flex flex-col gap-1.5"
        >
            <label
                :for="`question-${quest.id}`"
                class="flex items-start gap-2 text-sm font-medium text-gray-800"
            >
                <span class="shrink-0 flex items-center justify-center w-5 h-5 rounded-full bg-violet-50 text-[#8B5CF6] text-[11px] font-semibold mt-0.5">
                    {{ index + 1 }}
                </span>
                <span>{{ quest.question }}</span>
            </label>

            <input
                :id="`question-${quest.id}`"
                type="text"
                v-model="answers[quest.id]"
                placeholder="Type your answer"
                class="w-full ml-7 max-w-[calc(100%-1.75rem)] border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-800
                    outline-none placeholder:text-gray-400 bg-transparent
                    focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20
                    hover:border-gray-400 transition-colors"
            >
        </div>

        <button
            type="submit"
            class="self-end px-5 py-2.5 rounded-md text-sm font-medium text-white
                bg-[#8B5CF6] hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer"
        >
            Submit
        </button>

        <div v-if="!questions.length" class="text-sm text-gray-400 text-center py-6">
            No questions to answer yet.
        </div>
    </form>
</template>

<script setup>
import { reactive, ref } from 'vue'

const props = defineProps({
    questions: { type: Array, required: true },
    topicProgress: { type: Object, default: null}
})

const hasPassed = ref(props.topicProgress?.has_passed ?? false)

const failed = ref(false)

const answers = reactive({});
const isSubmitting = ref(false);

function retake(){
    answers = ''
}


async function submitAnswers(){
    console.log('submitted');
    console.log(props.topicProgress?.id)
    console.log(answers);
    const response = await fetch('/submit-topic-pretest', {
        method: "POST",
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
            'Accept' : 'application/json'
        },
        body: JSON.stringify({
            topicProgress_id : props.topicProgress?.id,
            answers : answers
        })
    })

    const data = response.json();
    if(data.success){
        // if(data.failed){
        //     failed.value = true;
        //     answers = '';
        // }else{
        //     failed.value = false
        // }

        console.log(data.answers)
    }
}

console.log(props.topicProgress?.id)


</script>
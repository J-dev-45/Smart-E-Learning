<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  questionId: { type: [Number, String], required: true },
  code: { type: String, required: true },          // the student's code from the editor
  inputs: { type: Array, default: () => [] },      // lines the student typed in the Output box
  ready: { type: Boolean, default: true },         // true once the student has run the code
})

const quiz = ref(null)
const result = ref(null)
const submittedInputs = ref([])                    // what the student typed when they pressed SUBMIT
const checking = ref(false)
const errorMsg = ref('')
const loadError = ref('')

// Null-safe views of the server data, so a bad response can never crash the render
const tests = computed(() => (Array.isArray(quiz.value?.tests) ? quiz.value.tests : []))
const total = computed(() => Number(quiz.value?.total ?? tests.value.length))
const hiddenCount = computed(() => Math.max(0, total.value - tests.value.length))
const results = computed(() => (Array.isArray(result.value?.results) ? result.value.results : []))

// "17\n5\n" -> "17, 5"
function formatInput(value) {
  const parts = String(value ?? '')
    .split(/\r?\n/)
    .map((line) => line.trim())
    .filter((line) => line !== '')
  return parts.length ? parts.join(', ') : '(none)'
}

const clean = (value) => String(value ?? '').trimEnd()

const typedInputs = computed(() => formatInput(submittedInputs.value.join('\n')))
const myOutput = computed(() => clean(result.value?.actual))

function caseLabel(r) {
  return r.hidden
    ? `Test Case ${r.number} (hidden)`
    : `Test Case ${r.number} (input: ${formatInput(r.input)})`
}

const verdict = computed(() => {
  const r = result.value
  if (!r) return ''
  if (r.status === 'CORRECT') return `Correct! Your code passed all ${r.total} test case(s).`
  if (r.status === 'WRONG') return `Failed. Your code passed ${r.passed} of ${r.total} test case(s).`
  return 'Failed. Your code has an error. Fix it, click Run, then submit again.'
})

const verdictClass = computed(() =>
  result.value?.status === 'CORRECT' ? 'text-emerald-600 font-semibold' : 'text-red-600 font-semibold'
)

onMounted(async () => {
  try {
    const { data } = await axios.get(`/code-quiz/${props.questionId}`)

    if (!data || !Array.isArray(data.tests)) {
      console.error('Unexpected /code-quiz response:', data)
      loadError.value = 'Could not load the expected output for this question.'
      return
    }

    quiz.value = data
  } catch (e) {
    console.error('Failed to load /code-quiz:', e.response?.status, e.response?.data ?? e)
    loadError.value = 'Could not load the expected output for this question.'
  }
})

async function submitCode() {
  if (checking.value) return

  errorMsg.value = ''
  result.value = null

  if (!props.ready) {
    errorMsg.value = 'Click Run first, type your inputs in the Output box, then press Submit.'
    return
  }

  submittedInputs.value = [...props.inputs]
  checking.value = true
  try {
    result.value = (await axios.post(`/code-quiz/${props.questionId}/check`, {
      code: props.code,
      inputs: props.inputs,
    })).data
  } catch (e) {
    console.error('Failed to check code:', e.response?.status, e.response?.data ?? e)
    errorMsg.value = e.response?.status === 429
      ? 'Too many attempts. Please wait a minute.'
      : 'Something went wrong. Try again.'
  } finally {
    checking.value = false
  }
}
</script>

<template>
  <div
    class="w-full max-w-6xl mx-auto flex flex-col lg:flex-row lg:h-[360px] rounded-lg overflow-hidden border border-[#cfd9e6] bg-[#fafafa]"
  >
    <!-- ── Left pane: expected output ── -->
    <div class="flex flex-col min-w-0 min-h-[200px] lg:min-h-0 lg:w-1/2">
      <div class="flex items-stretch border-b border-[#d9e1ec] bg-[#fcfcfd]">
        <div class="flex items-center px-4 py-3 text-sm text-[#6b5b95] bg-[#fafafa] border-r border-[#d9e1ec] -mb-px">
          Expected Output
        </div>
      </div>

      <pre
        v-if="loadError"
        class="flex-1 min-h-0 m-0 p-5 overflow-auto whitespace-pre-wrap break-words code-font text-red-600"
      >{{ loadError }}</pre>
      <pre
        v-else-if="quiz"
        class="flex-1 min-h-0 m-0 p-5 overflow-auto whitespace-pre-wrap break-words code-font text-[#1f2430]"
      ><template v-for="(t, i) in tests" :key="t.id">Test Case {{ i + 1 }}
Input: {{ formatInput(t.scanner_input) }}
Expected: {{ clean(t.expected_output) }}

</template><template v-if="hiddenCount > 0">+ {{ hiddenCount }} hidden test case(s)</template></pre>
      <pre
        v-else
        class="flex-1 min-h-0 m-0 p-5 overflow-auto whitespace-pre-wrap break-words code-font text-[#9aa6b8]"
      >Loading…</pre>
    </div>

    <!-- ── Divider ── -->
    <div class="shrink-0 bg-[#cfd9e6] max-lg:h-px max-lg:w-full lg:w-px"></div>

    <!-- ── Right pane: result ── -->
    <div class="flex-1 flex flex-col min-w-0 min-h-[200px] lg:min-h-0 bg-[#f5f5f5]">
      <div class="flex items-center justify-between px-5 py-2 border-b border-[#d9e1ec] bg-[#fcfcfd]">
        <span class="text-sm text-[#6b5b95]">Result</span>

        <button
          type="button"
          :disabled="checking || !!loadError"
          @click="submitCode"
          class="flex items-center gap-1.5 px-5 py-1.5 rounded text-sm font-medium text-white bg-[#4f00f5] hover:bg-[#4300cf] disabled:opacity-60 disabled:cursor-not-allowed transition-colors"
        >
          {{ checking ? 'Checking' : 'Submit' }}
          <svg v-if="checking" class="animate-spin size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-3.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
          </svg>
        </button>
      </div>

      <pre
        v-if="errorMsg"
        class="flex-1 min-h-0 m-0 p-5 overflow-auto whitespace-pre-wrap break-words code-font text-red-600"
      >{{ errorMsg }}</pre>
      <pre
        v-else-if="result"
        class="flex-1 min-h-0 m-0 p-5 overflow-auto whitespace-pre-wrap break-words code-font text-[#1f2430]"
      >Your run
Input: {{ typedInputs }}
Output: {{ myOutput }}

<template v-for="r in results" :key="r.number">{{ caseLabel(r) }}: <span :class="r.status === 'PASS' ? 'text-emerald-600 font-semibold' : 'text-red-600 font-semibold'">{{ r.status }}</span>
<template v-if="r.status !== 'PASS' && r.actual !== null">  Got: {{ clean(r.actual) }}
</template></template>
<span :class="verdictClass">{{ verdict }}</span></pre>
      <pre
        v-else
        class="flex-1 min-h-0 m-0 p-5 overflow-auto whitespace-pre-wrap break-words code-font text-[#9aa6b8]"
      >Click Run, type your inputs in the Output box, then press Submit.</pre>
    </div>
  </div>
</template>

<style scoped>
.code-font {
  font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, 'Liberation Mono', monospace;
  font-size: 13px;
  line-height: 22px;
  tab-size: 4;
}
</style>
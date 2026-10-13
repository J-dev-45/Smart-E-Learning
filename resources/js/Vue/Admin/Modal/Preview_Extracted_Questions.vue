<template>
  <Transition name="modal-fade">
    <div
      v-if="showPreview"
      id="previewQuestions"
      class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[99] flex items-center justify-center p-4"
    >
      <Transition name="modal-scale" appear>
        <div
          class="relative w-[42%] min-w-[460px] max-w-2xl bg-white rounded-xl shadow-2xl shadow-black/30 flex flex-col max-h-[90vh]"
        >
          <!-- CLOSE BUTTON -->
          <button
            type="button"
            @click="closeModal"
            aria-label="Close"
            class="absolute right-4 top-4 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>

          <!-- HEADER -->
          <div class="w-full flex flex-col gap-2 p-6 pb-4 border-b border-gray-100 shrink-0">
            <div class="flex items-center gap-3 pr-6">
              <div class="shrink-0 w-10 h-10 rounded-full bg-violet-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
              </div>
              <div class="flex flex-col gap-0.5">
                <span class="text-lg font-semibold text-gray-900">
                  Preview Extracted Questions
                </span>
                <span class="text-sm text-gray-500">
                  Review and edit before adding them.
                </span>
              </div>
            </div>

            <div class="w-full flex items-center flex-wrap shrink-0 gap-2 mt-1">
              <span class="py-1 px-2.5 text-xs font-semibold shrink-0 text-blue-600 rounded-md border border-blue-200 bg-blue-50">
                {{ subjectName }}
              </span>

              <span class="py-1 px-2.5 text-xs font-semibold shrink-0 text-yellow-600 rounded-md border border-yellow-200 bg-yellow-50">
                {{ moduleName }}
              </span>

              <span class="py-1 px-2.5 text-xs font-semibold shrink-0 text-[#6D28D9] rounded-md border border-violet-200 bg-violet-50 ml-auto">
                {{ editableQuestions.length }} question{{ editableQuestions.length === 1 ? '' : 's' }}
              </span>
            </div>
          </div>

          <!-- EMPTY STATE -->
          <div
            v-if="editableQuestions.length === 0"
            class="w-full flex flex-col items-center justify-center gap-2 py-16 px-6"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-gray-300">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
            <span class="text-sm font-medium text-gray-600">No questions left to add</span>
            <span class="text-xs text-gray-400">You removed every extracted question.</span>
          </div>

          <!-- QUESTIONS LIST -->
          <div v-else class="w-full flex flex-col gap-3 p-6 overflow-y-auto scrollbar-thin">
            <div
              v-for="(q, index) in editableQuestions"
              :key="q._key"
              class="w-full flex flex-col gap-3 rounded-lg border border-gray-200 p-4"
            >
              <!-- CARD HEADER -->
              <div class="w-full flex items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                  <span class="flex items-center justify-center w-6 h-6 shrink-0 rounded-md bg-gray-100 text-xs font-semibold text-gray-500">
                    {{ index + 1 }}
                  </span>

                  <span :class="typeBadgeClass(q.question_type)">
                    {{ typeLabel(q.question_type) }}
                  </span>
                </div>

                <div class="flex items-center gap-1.5">
                  <button
                    type="button"
                    @click="toggleEdit(index)"
                    :aria-label="q._editing ? 'Done editing' : 'Edit question'"
                    class="p-1.5 rounded-md border border-violet-200 text-[#8B5CF6] bg-violet-50 hover:bg-violet-100 hover:border-violet-300 transition-colors cursor-pointer"
                  >
                    <svg v-if="!q._editing" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>

                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                  </button>

                  <button
                    type="button"
                    @click="removeQuestion(index)"
                    aria-label="Remove question"
                    class="p-1.5 rounded-md border border-red-200 text-red-500 bg-red-50 hover:bg-red-100 hover:border-red-300 transition-colors cursor-pointer"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                  </button>
                </div>
              </div>

              <!-- READ MODE -->
              <template v-if="!q._editing">
                <p class="text-sm text-gray-800 font-medium leading-snug">
                  {{ q.question || 'Untitled question' }}
                </p>

                <!-- MULTIPLE CHOICE -->
                <div v-if="q.question_type === 'multipleChoice'" class="w-full flex flex-col gap-1.5">
                  <div
                    v-for="letter in ['A', 'B', 'C', 'D']"
                    :key="letter"
                    :class="[
                      'w-full flex items-center gap-2 rounded-md border px-3 py-1.5 text-xs',
                      q.correct_choice === letter
                        ? 'border-violet-300 bg-violet-50 text-[#6D28D9] font-semibold'
                        : 'border-gray-200 text-gray-600'
                    ]"
                  >
                    <span
                      :class="[
                        'flex items-center justify-center w-5 h-5 shrink-0 rounded text-[10px] font-semibold',
                        q.correct_choice === letter ? 'bg-[#8B5CF6] text-white' : 'bg-gray-100 text-gray-500'
                      ]"
                    >
                      {{ letter }}
                    </span>

                    <span class="truncate">{{ q.choices?.[letter] || '—' }}</span>

                    <svg
                      v-if="q.correct_choice === letter"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="2"
                      stroke="currentColor"
                      class="size-3.5 ml-auto shrink-0"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                  </div>
                </div>

                <!-- TRUE OR FALSE -->
                <div v-else-if="q.question_type === 'TorF'" class="flex items-center gap-2 text-xs">
                  <span class="text-gray-400">Answer:</span>
                  <span class="px-2 py-0.5 rounded bg-violet-50 text-[#6D28D9] font-semibold">
                    {{ q.correct_answer || '—' }}
                  </span>
                </div>

                <!-- IDENTIFICATION -->
                <div v-else-if="q.question_type === 'identification'" class="flex items-center gap-2 text-xs">
                  <span class="text-gray-400">Answer:</span>
                  <span class="px-2 py-0.5 rounded bg-violet-50 text-[#6D28D9] font-semibold">
                    {{ q.correct_answer || '—' }}
                  </span>
                </div>

                <p
                  v-if="q.explanation"
                  class="text-xs text-gray-400 italic border-t border-gray-100 pt-2 mt-1"
                >
                  {{ q.explanation }}
                </p>
              </template>

              <!-- EDIT MODE -->
              <template v-else>
                <div class="w-full flex flex-col gap-2">
                  <label class="text-xs font-medium text-gray-500">Question</label>
                  <input
                    v-model="q.question"
                    type="text"
                    class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors"
                  >
                </div>

                <!-- MULTIPLE CHOICE EDIT -->
                <div v-if="q.question_type === 'multipleChoice'" class="w-full flex flex-col gap-2">
                  <div
                    v-for="letter in ['A', 'B', 'C', 'D']"
                    :key="letter"
                    class="w-full flex items-center gap-2"
                  >
                    <label
                      class="relative flex items-center justify-center w-8 h-8 shrink-0 rounded-md text-xs font-semibold cursor-pointer select-none transition-colors bg-white text-gray-600 border border-gray-300 hover:bg-gray-100 has-[:checked]:bg-[#8B5CF6] has-[:checked]:text-white has-[:checked]:border-[#8B5CF6]"
                    >
                      <input
                        v-model="q.correct_choice"
                        type="radio"
                        :name="`correct_choice_${index}`"
                        :value="letter"
                        class="sr-only"
                      >
                      {{ letter }}
                    </label>

                    <input
                      v-model="q.choices[letter]"
                      type="text"
                      :placeholder="`Enter Choice ${letter}`"
                      class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors"
                    >
                  </div>
                </div>

                <!-- TRUE OR FALSE EDIT -->
                <div v-else-if="q.question_type === 'TorF'" class="grid grid-cols-2 gap-2">
                  <label
                    class="relative flex items-center justify-center h-10 rounded-lg border cursor-pointer select-none transition-colors text-sm font-medium border-gray-300 text-gray-700 hover:border-gray-400 has-[:checked]:border-violet-500 has-[:checked]:bg-violet-50 has-[:checked]:text-violet-700"
                  >
                    <input
                      v-model="q.correct_answer"
                      type="radio"
                      :name="`correct_answer_${index}`"
                      value="True"
                      class="sr-only"
                    >
                    True
                  </label>

                  <label
                    class="relative flex items-center justify-center h-10 rounded-lg border cursor-pointer select-none transition-colors text-sm font-medium border-gray-300 text-gray-700 hover:border-gray-400 has-[:checked]:border-violet-500 has-[:checked]:bg-violet-50 has-[:checked]:text-violet-700"
                  >
                    <input
                      v-model="q.correct_answer"
                      type="radio"
                      :name="`correct_answer_${index}`"
                      value="False"
                      class="sr-only"
                    >
                    False
                  </label>
                </div>

                <!-- IDENTIFICATION EDIT -->
                <div v-else-if="q.question_type === 'identification'" class="w-full flex flex-col gap-2">
                  <label class="text-xs font-medium text-gray-500">Answer</label>
                  <input
                    v-model="q.correct_answer"
                    type="text"
                    placeholder="Enter Identification Answer"
                    class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors"
                  >
                </div>

                <div class="w-full flex flex-col gap-2">
                  <label class="text-xs font-medium text-gray-500">Explanation</label>
                  <input
                    v-model="q.explanation"
                    type="text"
                    placeholder="Enter Explanation"
                    class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors"
                  >
                </div>
              </template>
            </div>
          </div>

          <!-- FOOTER -->
          <div class="w-full flex gap-3 p-6 pt-4 border-t border-gray-100 shrink-0">
            <button
              type="button"
              @click="closeModal"
              class="w-1/3 py-2.5 rounded-md text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-100 transition-colors cursor-pointer"
            >
              Discard
            </button>

            <button
              type="button"
              @click="confirmSave"
              :disabled="isSubmitting || editableQuestions.length === 0"
              class="w-2/3 py-2.5 rounded-md text-sm font-medium text-white bg-[#8B5CF6] hover:bg-[#7C3AED] active:bg-[#6D28D9] transition-colors cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
            >
              <svg
                v-if="isSubmitting"
                class="animate-spin size-4"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"></path>
              </svg>

              {{ isSubmitting ? 'Saving...' : `Save ${editableQuestions.length} Question${editableQuestions.length === 1 ? '' : 's'}` }}
            </button>
          </div>
        </div>
      </Transition>
    </div>
  </Transition>

  <Toast
    :show="showToast"
    :message="message"
    @close="showToast = false"
  />
</template>

<script setup>
import { ref, watch } from 'vue';
import Toast from '../components/Toast.vue';

const props = defineProps({
  showPreview: {
    type: Boolean,
    default: false
  },
  questions: {
    type: Array,
    default: () => []
  },
  moduleName: {
    type: String,
    default: 'N/A'
  },
  moduleId: {
    type: String,
    default: ''
  },
  topicName: {
    type: String,
    default: 'N/A'
  },
  topicId: {
    type: String,
    default: ''
  },
  subjectName: {
    type: String,
    default: 'N/A'
  },
  subjectId: {
    type: String,
    default: ''
  }
});

const showToast = ref(false);
const message = ref('');
const emit = defineEmits(['close-preview', 'saved', 'questions-added']);
const isSubmitting = ref(false);
const editableQuestions = ref([]);
let keyCounter = 0;

watch(
  () => props.questions,
  (list) => {
    editableQuestions.value = (list || []).map((q) => ({
      question: q.question ?? '',
      question_type: q.question_type ?? 'multipleChoice',
      correct_choice: q.question_type === 'multipleChoice' ? (q.answer ?? '') : '',
      correct_answer: q.question_type !== 'multipleChoice' ? (q.answer ?? '') : '',
      choices: {
        A: q.choices?.A ?? q.choice_A ?? '',
        B: q.choices?.B ?? q.choice_B ?? '',
        C: q.choices?.C ?? q.choice_C ?? '',
        D: q.choices?.D ?? q.choice_D ?? ''
      },
      explanation: q.explanation ?? '',
      _editing: false,
      _key: keyCounter++
    }));
  },
  { immediate: true }
);

function typeLabel(type) {
  if (type === 'multipleChoice') return 'Multiple Choice';
  if (type === 'TorF') return 'True or False';
  if (type === 'identification') return 'Identification';
  return 'Unknown';
}

function typeBadgeClass(type) {
  const base = 'py-1 px-2 text-[11px] font-semibold rounded-md border';

  if (type === 'multipleChoice') {
    return `${base} text-blue-600 border-blue-200 bg-blue-50`;
  }

  if (type === 'TorF') {
    return `${base} text-yellow-600 border-yellow-200 bg-yellow-50`;
  }

  if (type === 'identification') {
    return `${base} text-emerald-600 border-emerald-200 bg-emerald-50`;
  }

  return `${base} text-gray-500 border-gray-200 bg-gray-50`;
}

function toggleEdit(index) {
  editableQuestions.value[index]._editing =
    !editableQuestions.value[index]._editing;
}

function removeQuestion(index) {
  editableQuestions.value.splice(index, 1);
}

function closeModal() {
  emit('close-preview');
}

async function confirmSave() {
  if (isSubmitting.value || editableQuestions.value.length === 0) return;

  if (!props.moduleId) {
    message.value = 'Module is required.';
    showToast.value = true;
    return;
  }

  if (!props.topicId) {
    message.value = 'Topic is required.';
    showToast.value = true;
    return;
  }

  const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute('content');

  isSubmitting.value = true;

  const payload = editableQuestions.value.map(({ _editing, _key, ...q }) => q);

  try {
    const response = await fetch('/importQuestions', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        module_id: props.moduleId,
        topic_id: props.topicId,
        subject_name: props.subjectName,
        module_name: props.moduleName,
        topic_name: props.topicName,
        questions: payload
      })
    });

    const data = await response.json();

    if (!response.ok) {
      console.error('Import validation/server errors:', data);

      if (data.errors) {
        const firstError = Object.values(data.errors).flat()[0];
        message.value = firstError || data.message || 'Failed to import questions.';
      } else {
        message.value = data.message || 'Failed to import questions.';
      }

      showToast.value = true;
      return;
    }

    if (data.success) {
      message.value = data.message || 'Questions imported successfully!';
      showToast.value = true;

      emit('saved', data);
      emit('questions-added', data.new_questions || []);
      emit('close-preview');
    }
  } catch (error) {
    console.error('Import error:', error);
    message.value = error.message || 'Failed to import questions.';
    showToast.value = true;
  } finally {
    isSubmitting.value = false;
  }
}
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.15s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}

.modal-scale-enter-active {
  transition: opacity 0.15s ease, transform 0.15s ease;
}

.modal-scale-enter-from {
  opacity: 0;
  transform: scale(0.96) translateY(4px);
}

.scrollbar-thin::-webkit-scrollbar {
  width: 6px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
  background-color: #d1d5db;
  border-radius: 9999px;
}
</style>
<template>
  <Transition name="modal-fade">
    <div
      v-if="showAddQuestion"
      id="addQuestion"
      class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[99] flex items-center justify-center p-4"
    >
      <Transition name="modal-scale" appear>
        <div
          class="relative w-[30%] min-w-[380px] max-w-lg bg-white rounded-xl shadow-2xl shadow-black/30 flex flex-col p-6 gap-5 max-h-[90vh] overflow-hidden"
        >
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

          <input type="hidden" v-model="module_id">

          <div class="w-full flex flex-col gap-1 pr-6 shrink-0">
            <div class="flex items-center gap-3">
              <div class="shrink-0 w-10 h-10 rounded-full bg-violet-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
              </div>

              <div class="flex flex-col gap-0.5">
                <span class="text-lg font-semibold text-gray-900">
                  Add New Question
                </span>
                <span class="text-sm text-gray-500">
                  Create a new question for your Students.
                </span>
              </div>
            </div>

            <div class="w-full flex flex-col gap-2 border-b border-gray-100 pb-2 mt-1">
              <span class="font-semibold text-sm text-gray-700">
                Question Details
              </span>

              <div class="w-full flex items-center flex-wrap shrink-0 gap-2">
                <span class="py-1 px-2.5 text-xs font-semibold shrink-0 text-blue-600 rounded-md border border-blue-200 bg-blue-50">
                  {{ subjectName }}
                </span>

                <span
                  v-if="effectiveModuleName"
                  class="py-1 px-2.5 text-xs font-semibold shrink-0 text-purple-600 rounded-md border border-purple-200 bg-purple-100"
                >
                  {{ effectiveModuleName }}
                </span>

                <button
                  v-if="hasModule && subject_modules.length > 1"
                  type="button"
                  @click="changeModule"
                  class="py-1 px-2.5 text-xs font-semibold shrink-0 text-gray-600 rounded-md border border-gray-200 bg-white hover:bg-gray-50 transition-colors cursor-pointer"
                >
                  Change Module
                </button>
              </div>
            </div>

            <div
              v-if="hasModule"
              class="w-full flex items-center gap-1 mt-3 p-1 rounded-lg bg-gray-100"
            >
              <button
                type="button"
                @click="entryMode = 'manual'"
                :class="[
                  'flex-1 flex items-center justify-center gap-1.5 py-1.5 rounded-md text-xs font-semibold transition-colors cursor-pointer',
                  entryMode === 'manual'
                    ? 'bg-white text-[#8B5CF6] shadow-sm'
                    : 'text-gray-500 hover:text-gray-700'
                ]"
              >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487 18.549 2.8a2.118 2.118 0 0 1 2.995 2.995l-1.688 1.688m-2.994-2.996-10.563 10.563a4.5 4.5 0 0 0-1.242 2.273l-.688 3.435 3.435-.688a4.5 4.5 0 0 0 2.273-1.242l10.563-10.563m-2.994-2.996 2.994 2.996" />
                </svg>
                Manual Entry
              </button>

              <button
                type="button"
                @click="entryMode = 'upload'"
                :class="[
                  'flex-1 flex items-center justify-center gap-1.5 py-1.5 rounded-md text-xs font-semibold transition-colors cursor-pointer',
                  entryMode === 'upload'
                    ? 'bg-white text-[#8B5CF6] shadow-sm'
                    : 'text-gray-500 hover:text-gray-700'
                ]"
              >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Upload File
              </button>
            </div>
          </div>

          <div v-if="!hasModule" class="w-full flex flex-col gap-4">
            <div class="flex flex-col gap-1.5">
              <label for="moduleSelect" class="text-sm font-medium text-gray-700">
                Module
              </label>

              <div class="relative">
                <select
                  id="moduleSelect"
                  v-model="selected_module_id"
                  @change="finishModuleChange"
                  class="w-full appearance-none rounded-md border border-gray-300 bg-white py-2 pl-3 pr-9 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#8B5CF6]/40 focus:border-[#8B5CF6] hover:border-gray-400 transition-colors cursor-pointer"
                >
                  <option value="" disabled>Select a module for your question</option>

                  <option
                    v-for="module in subject_modules"
                    :key="module.id"
                    :value="String(module.id)"
                  >
                    {{ module.module_name }}
                  </option>
                </select>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </div>

              <button
                v-if="changingModule"
                type="button"
                @click="cancelModuleChange"
                class="self-start text-xs font-medium text-gray-500 hover:text-gray-700 cursor-pointer mt-1"
              >
                Cancel module change
              </button>
            </div>
          </div>

          <div
            v-if="hasModule"
            id="whiteBG"
            class="w-full flex-1 min-h-0 overflow-y-auto scrollbar-thin pr-6 -mr-6"
          >
            <form
              v-if="entryMode === 'manual'"
              @submit.prevent="addQuestionForm(effectiveModuleName, subjectName)"
              class="w-full flex flex-col gap-2"
            >
              <div class="w-full flex flex-col gap-2 mt-3">
                <label for="question" class="text-sm font-medium text-gray-700">
                  Question
                </label>

                <textarea
                  v-model="question"
                  id="question"
                  placeholder="Enter Question"
                  rows="2"
                  class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-transparent placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors resize-y min-h-[64px]"
                ></textarea>
              </div>

              <div class="flex flex-col gap-1.5 py-3">
                <label for="quizType" class="text-sm font-medium text-gray-700">
                  Question Type
                </label>

                <div class="relative">
                  <select
                    id="quizType"
                    v-model="selected_questionType"
                    class="w-full appearance-none rounded-md border border-gray-300 bg-white py-2 pl-3 pr-9 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#8B5CF6]/40 focus:border-[#8B5CF6] hover:border-gray-400 transition-colors cursor-pointer"
                  >
                    <option value="">Select Question Type</option>
                    <option value="multipleChoice">Multiple Choice</option>
                    <option value="TorF">True or False</option>
                    <option value="identification">Identification</option>
                    <option value="coding">Coding</option>
                  </select>

                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                  </svg>
                </div>
              </div>

              <Transition name="mc-slide">
                <div
                  v-if="mc"
                  class="w-full flex flex-col gap-2 overflow-hidden rounded-lg border border-gray-200 bg-gray-50 p-4"
                >
                  <div class="flex items-center justify-between">
                    <label class="text-sm font-medium text-gray-700">Multiple Choice</label>
                    <span class="text-xs text-gray-400">Select the correct answer</span>
                  </div>

                  <div class="w-full flex flex-col gap-1">
                    <div class="w-full flex items-center gap-2">
                      <label
                        for="correct_a"
                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md text-xs font-semibold cursor-pointer select-none transition-colors bg-white text-gray-600 border border-gray-300 hover:bg-gray-100 has-[:checked]:bg-[#8B5CF6] has-[:checked]:text-white has-[:checked]:border-[#8B5CF6]"
                      >
                        <input
                          v-model="correct_choice"
                          @input="emptyChoiceAnswer = false"
                          type="radio"
                          name="correct_choice"
                          id="correct_a"
                          value="A"
                          class="sr-only"
                        >
                        A
                      </label>

                      <input
                        v-model="choices.A"
                        type="text"
                        placeholder="Enter Choice A"
                        @input="emptyChoices.A = false"
                        :class="[
                          'w-full border rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:ring-2 transition-colors',
                          emptyChoices.A
                            ? 'border-red-400 bg-red-50/60 focus:border-red-400 focus:ring-red-400/20'
                            : 'border-gray-300 focus:border-[#8B5CF6] focus:ring-[#8B5CF6]/20'
                        ]"
                      >
                    </div>

                    <span v-if="emptyChoices.A" class="pl-11 text-xs text-red-500">
                      This choice can't be empty
                    </span>
                  </div>

                  <div class="w-full flex flex-col gap-1">
                    <div class="w-full flex items-center gap-2">
                      <label
                        for="correct_b"
                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md text-xs font-semibold cursor-pointer select-none transition-colors bg-white text-gray-600 border border-gray-300 hover:bg-gray-100 has-[:checked]:bg-[#8B5CF6] has-[:checked]:text-white has-[:checked]:border-[#8B5CF6]"
                      >
                        <input
                          v-model="correct_choice"
                          @input="emptyChoiceAnswer = false"
                          type="radio"
                          name="correct_choice"
                          id="correct_b"
                          value="B"
                          class="sr-only"
                        >
                        B
                      </label>

                      <input
                        v-model="choices.B"
                        type="text"
                        placeholder="Enter Choice B"
                        @input="emptyChoices.B = false"
                        :class="[
                          'w-full border rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:ring-2 transition-colors',
                          emptyChoices.B
                            ? 'border-red-400 bg-red-50/60 focus:border-red-400 focus:ring-red-400/20'
                            : 'border-gray-300 focus:border-[#8B5CF6] focus:ring-[#8B5CF6]/20'
                        ]"
                      >
                    </div>

                    <span v-if="emptyChoices.B" class="pl-11 text-xs text-red-500">
                      This choice can't be empty
                    </span>
                  </div>

                  <div class="w-full flex flex-col gap-1">
                    <div class="w-full flex items-center gap-2">
                      <label
                        for="correct_c"
                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md text-xs font-semibold cursor-pointer select-none transition-colors bg-white text-gray-600 border border-gray-300 hover:bg-gray-100 has-[:checked]:bg-[#8B5CF6] has-[:checked]:text-white has-[:checked]:border-[#8B5CF6]"
                      >
                        <input
                          v-model="correct_choice"
                          @input="emptyChoiceAnswer = false"
                          type="radio"
                          name="correct_choice"
                          id="correct_c"
                          value="C"
                          class="sr-only"
                        >
                        C
                      </label>

                      <input
                        v-model="choices.C"
                        type="text"
                        placeholder="Enter Choice C"
                        @input="emptyChoices.C = false"
                        :class="[
                          'w-full border rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:ring-2 transition-colors',
                          emptyChoices.C
                            ? 'border-red-400 bg-red-50/60 focus:border-red-400 focus:ring-red-400/20'
                            : 'border-gray-300 focus:border-[#8B5CF6] focus:ring-[#8B5CF6]/20'
                        ]"
                      >
                    </div>

                    <span v-if="emptyChoices.C" class="pl-11 text-xs text-red-500">
                      This choice can't be empty
                    </span>
                  </div>

                  <div class="w-full flex flex-col gap-1">
                    <div class="w-full flex items-center gap-2">
                      <label
                        for="correct_d"
                        class="relative flex items-center justify-center w-9 h-9 shrink-0 rounded-md text-xs font-semibold cursor-pointer select-none transition-colors bg-white text-gray-600 border border-gray-300 hover:bg-gray-100 has-[:checked]:bg-[#8B5CF6] has-[:checked]:text-white has-[:checked]:border-[#8B5CF6]"
                      >
                        <input
                          v-model="correct_choice"
                          @input="emptyChoiceAnswer = false"
                          type="radio"
                          name="correct_choice"
                          id="correct_d"
                          value="D"
                          class="sr-only"
                        >
                        D
                      </label>

                      <input
                        v-model="choices.D"
                        type="text"
                        placeholder="Enter Choice D"
                        @input="emptyChoices.D = false"
                        :class="[
                          'w-full border rounded-md p-2 outline-none text-sm bg-white placeholder:text-gray-400 focus:ring-2 transition-colors',
                          emptyChoices.D
                            ? 'border-red-400 bg-red-50/60 focus:border-red-400 focus:ring-red-400/20'
                            : 'border-gray-300 focus:border-[#8B5CF6] focus:ring-[#8B5CF6]/20'
                        ]"
                      >
                    </div>

                    <span v-if="emptyChoices.D" class="pl-11 text-xs text-red-500">
                      This choice can't be empty
                    </span>
                  </div>

                  <div
                    v-if="emptyChoiceAnswer"
                    class="w-full flex items-start gap-2 rounded-md border border-red-200 bg-red-50 px-3 py-2.5 mt-1"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-red-500 shrink-0 mt-0.5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0Zm-8.99-3.75h.008v.008h-.008V8.25Z" />
                    </svg>

                    <div class="flex flex-col">
                      <span class="text-red-600 font-semibold text-xs">
                        Assign Correct Answer!
                      </span>
                      <span class="text-red-500 text-xs">
                        Please assign the correct answer by choosing A, B, C, or D.
                      </span>
                    </div>
                  </div>
                </div>

                <div
                  v-else-if="torf"
                  class="w-full flex flex-col gap-2"
                >
                  <span class="text-sm font-medium text-gray-700">
                    True or False
                  </span>

                  <div class="grid grid-cols-2 gap-3">
                    <label
                      for="answer-true"
                      class="relative flex items-center justify-center h-12 rounded-lg border cursor-pointer select-none transition-colors text-sm font-medium border-gray-300 text-gray-700 hover:border-gray-400 has-[:checked]:border-violet-500 has-[:checked]:bg-violet-50 has-[:checked]:text-violet-700"
                    >
                      <input
                        v-model="correct_answer"
                        id="answer-true"
                        type="radio"
                        name="correct-answer"
                        value="True"
                        class="sr-only"
                      >
                      True
                    </label>

                    <label
                      for="answer-false"
                      class="relative flex items-center justify-center h-12 rounded-lg border cursor-pointer select-none transition-colors text-sm font-medium border-gray-300 text-gray-700 hover:border-gray-400 has-[:checked]:border-violet-500 has-[:checked]:bg-violet-50 has-[:checked]:text-violet-700"
                    >
                      <input
                        v-model="correct_answer"
                        id="answer-false"
                        type="radio"
                        name="correct-answer"
                        value="False"
                        class="sr-only"
                      >
                      False
                    </label>
                  </div>
                </div>

                <div
                  v-else-if="identification"
                  class="w-full flex flex-col gap-2"
                >
                  <label for="identification" class="text-sm font-medium text-gray-700">
                    Identification
                  </label>

                  <input
                    v-model="correct_answer"
                    type="text"
                    id="identification"
                    placeholder="Enter Identification Answer"
                    class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-transparent placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors"
                  >
                </div>

                <div
                  v-else-if="selected_questionType === 'coding'"
                  class="w-full flex flex-col gap-2 mt-3"
                >
                  <div class="flex items-center justify-between">
                    <label class="text-sm font-medium text-gray-700">
                      Test Cases
                    </label>

                    <button
                      type="button"
                      @click="addTestCase"
                      class="text-xs font-semibold text-[#8B5CF6] hover:text-[#7C3AED] cursor-pointer"
                    >
                      + Add
                    </button>
                  </div>

                  <div
                    v-for="(testCase, index) in testCases"
                    :key="index"
                    class="w-full flex items-start gap-2"
                  >
                    <span class="shrink-0 flex items-center justify-center w-6 h-8 rounded-md bg-gray-100 text-xs font-semibold text-gray-500 mt-0.5">
                      {{ index + 1 }}
                    </span>

                    <div class="w-full flex flex-col gap-1.5">
                      <textarea
                        v-model="testCase.scanner_input"
                        placeholder="Scanner Input"
                        rows="3"
                        class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-transparent placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors resize-y min-h-[72px] font-mono"
                      ></textarea>

                      <textarea
                        v-model="testCase.expected_output"
                        placeholder="Expected Output"
                        rows="3"
                        class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-transparent placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors resize-y min-h-[72px] font-mono scrollbar-thin"
                      ></textarea>
                    </div>

                    <button
                      type="button"
                      @click="removeTestCase(index)"
                      :disabled="testCases.length === 1"
                      aria-label="Remove test case"
                      class="shrink-0 p-1.5 mt-0.5 rounded-md text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </Transition>

              <div
                v-if="
                  selected_questionType === 'multipleChoice' ||
                  selected_questionType === 'TorF' ||
                  selected_questionType === 'identification'
                "
                class="w-full flex flex-col gap-2 mt-3"
              >
                <label for="explanation" class="text-sm font-medium text-gray-700">
                  Explanation
                </label>

                <textarea
                  v-model="explanation"
                  id="explanation"
                  placeholder="Enter Explanation"
                  rows="2"
                  class="w-full border border-gray-300 rounded-md p-2 outline-none text-sm bg-transparent placeholder:text-gray-400 focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 transition-colors resize-y min-h-[64px]"
                ></textarea>
              </div>

              <div class="w-full flex gap-3 mt-4">
                <button
                  type="button"
                  @click="closeModal"
                  class="w-1/3 py-2.5 rounded-md text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-100 transition-colors cursor-pointer"
                >
                  Cancel
                </button>

                <button
                  type="submit"
                  :disabled="isSubmitting"
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

                  {{ isSubmitting ? 'Adding...' : 'Add Question' }}
                </button>
              </div>
            </form>

            <form
              v-else
              @submit.prevent="extractQuestionsForm"
              class="w-full flex flex-col gap-2"
            >
              <div class="w-full flex flex-col gap-2 mt-3">
                <label class="text-sm font-medium text-gray-700">
                  Question File
                </label>

                <span class="text-xs text-gray-400 -mt-1">
                  Accepts .docx, and .pdf files containing your questions.
                </span>

                <div
                  v-if="!selectedFile"
                  @click="triggerFileInput"
                  @dragover.prevent="isDragging = true"
                  @dragleave.prevent="isDragging = false"
                  @drop.prevent="handleDrop"
                  :class="[
                    'w-full flex flex-col items-center justify-center gap-2 rounded-lg border-2 border-dashed p-8 cursor-pointer transition-colors',
                    isDragging
                      ? 'border-[#8B5CF6] bg-violet-50'
                      : 'border-gray-300 bg-gray-50 hover:border-gray-400 hover:bg-gray-100'
                  ]"
                >
                  <div class="shrink-0 w-10 h-10 rounded-full bg-violet-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                  </div>

                  <div class="flex flex-col items-center gap-0.5 text-center">
                    <span class="text-sm font-medium text-gray-700">
                      Drop your file here, or <span class="text-[#8B5CF6]">browse</span>
                    </span>

                    <span class="text-xs text-gray-400">
                      Max file size 10MB
                    </span>
                  </div>

                  <input
                    ref="fileInputRef"
                    type="file"
                    accept=".docx,.pdf"
                    class="hidden"
                    @change="handleFileSelect"
                  >
                </div>

                <div
                  v-else
                  class="w-full flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 p-3"
                >
                  <div class="shrink-0 w-9 h-9 rounded-md bg-violet-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#8B5CF6" class="size-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                  </div>

                  <div class="flex flex-col flex-1 min-w-0">
                    <span class="text-sm font-medium text-gray-700 truncate">
                      {{ selectedFile.name }}
                    </span>

                    <span class="text-xs text-gray-400">
                      {{ formattedFileSize }}
                    </span>
                  </div>

                  <button
                    type="button"
                    @click="removeFile"
                    aria-label="Remove file"
                    class="shrink-0 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>

                <div
                  v-if="emptyFileError"
                  class="w-full flex items-start gap-2 rounded-md border border-red-200 bg-red-50 px-3 py-2.5 mt-1"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-red-500 shrink-0 mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0Zm-8.99-3.75h.008v.008h-.008V8.25Z" />
                  </svg>

                  <div class="flex flex-col">
                    <span class="text-red-600 font-semibold text-xs">
                      Select a file!
                    </span>

                    <span class="text-red-500 text-xs">
                      Please choose or drop a file to extract questions from.
                    </span>
                  </div>
                </div>
              </div>

              <div class="w-full flex gap-3 mt-4">
                <button
                  type="button"
                  @click="closeModal"
                  class="w-1/3 py-2.5 rounded-md text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-100 transition-colors cursor-pointer"
                >
                  Cancel
                </button>

                <button
                  type="submit"
                  :disabled="isSubmitting"
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

                  {{ isSubmitting ? 'Extracting...' : 'Extract Questions' }}
                </button>
              </div>
            </form>
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

  <Preview_Extracted_Questions
    :show-preview="showPreview"
    :questions="extractedQuestions"
    :subject-name="subjectName"
    :module-name="effectiveModuleName"
    :module-id="effectiveModuleId"
    @close-preview="showPreview = false"
    @questions-added="handleQuestionsAdded"
  />
</template>

<script setup>
import { ref, computed } from 'vue';
import Toast from '../components/Toast.vue';
import Preview_Extracted_Questions from './Preview_Extracted_Questions.vue';

const props = defineProps({
  showAddQuestion: { type: Boolean, default: false },
  moduleName: { type: String, default: 'All' },
  moduleId: { type: String, default: '0' },
  subjectName: { type: String, required: true },
  subjectId: { type: String, required: true },
  modules: { type: Array, required: true },
});

const emit = defineEmits(['close-add', 'questions-added']);

const module_id = computed(() => props.moduleId);

const showToast = ref(false);
const message = ref('');
const isSubmitting = ref(false);
const entryMode = ref('manual');

const changingModule = ref(false);
const moduleOverride = ref(false);

const emptyChoiceAnswer = ref(false);

const emptyChoices = ref({
  A: false,
  B: false,
  C: false,
  D: false
});

const selected_module_id = ref(
  String(props.moduleId) !== '0'
    ? String(props.moduleId)
    : ''
);

const subject_modules = computed(() => {
  let modules;

  if (
    String(props.moduleId) !== '0' &&
    !moduleOverride.value
  ) {
    modules = props.modules.filter(
      module => String(module.id) === String(props.moduleId)
    );
  } else {
    modules = props.modules.filter(
      module => String(module.subject_id) === String(props.subjectId)
    );
  }

  return [...modules].sort((a, b) => {
    const orderA = Number(a.order);
    const orderB = Number(b.order);

    if (Number.isNaN(orderA)) return 1;
    if (Number.isNaN(orderB)) return -1;

    return orderA - orderB;
  });
});

const effectiveModuleId = computed(() => {
  if (
    String(props.moduleId) !== '0' &&
    !moduleOverride.value
  ) {
    return String(props.moduleId);
  }

  return selected_module_id.value;
});

const effectiveModuleName = computed(() => {
  if (
    String(props.moduleId) !== '0' &&
    !moduleOverride.value
  ) {
    return props.moduleName !== 'All'
      ? props.moduleName
      : '';
  }

  const found = props.modules.find(
    module => String(module.id) === String(selected_module_id.value)
  );

  return found?.module_name || '';
});

const hasModule = computed(() => {
  return Boolean(effectiveModuleId.value) && !changingModule.value;
});

function changeModule() {
  moduleOverride.value = true;
  changingModule.value = true;
  selected_module_id.value = '';
}

function finishModuleChange() {
  if (selected_module_id.value) {
    changingModule.value = false;
  }
}

function cancelModuleChange() {
  changingModule.value = false;

  if (String(props.moduleId) !== '0') {
    moduleOverride.value = false;
    selected_module_id.value = String(props.moduleId);
  } else {
    moduleOverride.value = false;
    selected_module_id.value = '';
  }
}

function handleQuestionsAdded(newQuestions) {
  emit('questions-added', newQuestions);
}

const question = ref('');
const selected_questionType = ref('');
const explanation = ref('');
const correct_choice = ref('');
const correct_answer = ref('');

const choices = ref({
  A: '',
  B: '',
  C: '',
  D: ''
});

const mc = computed(() => {
  return selected_questionType.value === 'multipleChoice';
});

const torf = computed(() => {
  return selected_questionType.value === 'TorF';
});

const identification = computed(() => {
  return selected_questionType.value === 'identification';
});

const testCases = ref([
  {
    scanner_input: '',
    expected_output: '',
    is_hidden: false
  }
]);

function addTestCase() {
  testCases.value.push({
    scanner_input: '',
    expected_output: '',
    is_hidden: false
  });
}

function removeTestCase(index) {
  if (testCases.value.length === 1) {
    return;
  }

  testCases.value.splice(index, 1);
}

const fileInputRef = ref(null);
const selectedFile = ref(null);
const isDragging = ref(false);
const emptyFileError = ref(false);
const showPreview = ref(false);
const extractedQuestions = ref([]);

const formattedFileSize = computed(() => {
  if (!selectedFile.value) {
    return '';
  }

  const kb = selectedFile.value.size / 1024;

  return kb < 1024
    ? `${kb.toFixed(1)} KB`
    : `${(kb / 1024).toFixed(1)} MB`;
});

function triggerFileInput() {
  fileInputRef.value?.click();
}

function handleFileSelect(event) {
  const file = event.target.files?.[0];

  if (file) {
    selectedFile.value = file;
    emptyFileError.value = false;
  }
}

function handleDrop(event) {
  isDragging.value = false;

  const file = event.dataTransfer.files?.[0];

  if (file) {
    selectedFile.value = file;
    emptyFileError.value = false;
  }
}

function removeFile() {
  selectedFile.value = null;

  if (fileInputRef.value) {
    fileInputRef.value.value = '';
  }
}

function closeModal() {
  emit('close-add');
}

async function addQuestionForm(Mname, Sname) {
  if (!effectiveModuleId.value) {
    message.value = 'Please select a module.';
    showToast.value = true;
    return;
  }

  if (!selected_questionType.value) {
    message.value = 'Please select a question type.';
    showToast.value = true;
    return;
  }

  if (!question.value?.trim()) {
    message.value = 'Please enter a question.';
    showToast.value = true;
    return;
  }

  if (mc.value) {
    const missingChoices = ['A', 'B', 'C', 'D'].filter(
      letter => !choices.value[letter]?.trim()
    );

    if (missingChoices.length) {
      emptyChoices.value = {
        A: missingChoices.includes('A'),
        B: missingChoices.includes('B'),
        C: missingChoices.includes('C'),
        D: missingChoices.includes('D')
      };

      emptyChoiceAnswer.value = false;
      return;
    }

    if (!correct_choice.value) {
      emptyChoiceAnswer.value = true;
      return;
    }
  }

  if (torf.value || identification.value) {
    if (!correct_answer.value?.trim()) {
      message.value = 'Please provide the correct answer.';
      showToast.value = true;
      return;
    }
  }

  if (
    selected_questionType.value === 'coding' &&
    testCases.value.some(testCase => !testCase.expected_output?.trim())
  ) {
    message.value = 'Every coding test case must have an expected output.';
    showToast.value = true;
    return;
  }

  isSubmitting.value = true;

  try {
    const csrfToken = document
      .querySelector('meta[name="csrf-token"]')
      ?.getAttribute('content');

    const response = await fetch('/addQuestion', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        question: question.value.trim(),
        explanation: explanation.value,
        question_type: selected_questionType.value,

        correct_choice: correct_choice.value,
        correct_answer: correct_answer.value,

        choice_A: choices.value.A,
        choice_B: choices.value.B,
        choice_C: choices.value.C,
        choice_D: choices.value.D,

        module_id: effectiveModuleId.value,

        test_cases: selected_questionType.value === 'coding'
          ? testCases.value.map((testCase, index) => ({
              scanner_input: testCase.scanner_input || null,
              expected_output: testCase.expected_output,
              test_case_order: index + 1,
              is_hidden: testCase.is_hidden || false
            }))
          : [],

        subject_name: Sname,
        module_name: Mname
      })
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(
        data.message || 'Failed to add question.'
      );
    }

    message.value = data.message || 'Question added successfully!';
    showToast.value = true;

    if (Array.isArray(data.new_questions)) {
      emit('questions-added', data.new_questions);
    }

    emit('close-add');

  } catch (error) {
    console.error(error);

    message.value =
      error.message || 'Failed to add question.';

    showToast.value = true;

  } finally {
    isSubmitting.value = false;
  }
}

async function extractQuestionsForm() {
  if (!effectiveModuleId.value) {
    message.value = 'Please select a module.';
    showToast.value = true;
    return;
  }

  const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute('content');

  emptyFileError.value = !selectedFile.value;

  if (emptyFileError.value) {
    return;
  }

  if (isSubmitting.value) {
    return;
  }

  isSubmitting.value = true;

  const formData = new FormData();

  formData.append('file', selectedFile.value);
  formData.append('module_id', effectiveModuleId.value);

  try {
    const response = await fetch('/extractQuestions', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: formData
    });

    const data = await response.json();

    if (!response.ok) {
      message.value = data.message || 'Failed to extract questions.';
      showToast.value = true;

      console.log(
        'Server errors:',
        JSON.stringify(data, null, 2)
      );

      return;
    }

    if (data.success) {
      extractedQuestions.value = data.questions || [];
      showPreview.value = true;
      emit('close-add');
    }

  } catch (error) {
    console.error(error);

    message.value =
      error.message || 'Failed to extract questions.';

    showToast.value = true;

  } finally {
    isSubmitting.value = false;
    removeFile();
  }
}
</script>

<style scoped>
.mc-slide-enter-active,
.mc-slide-leave-active {
  transition: opacity 0.2s ease, max-height 0.25s ease, margin-top 0.25s ease;
  max-height: 260px;
}

.mc-slide-enter-from,
.mc-slide-leave-to {
  opacity: 0;
  max-height: 0;
  margin-top: -8px;
}

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
</style>
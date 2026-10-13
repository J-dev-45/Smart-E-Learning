<template>
    <div class="w-[86%] sm:w-[94%] md:w-[88%] lg:w-[70%] mx-auto">
        <div class="rounded-xl sm:rounded-2xl overflow-hidden bg-white shadow-[0_20px_60px_-15px_rgba(139,92,246,0.35)]">

            <!-- Header -->
            <div class="flex items-center justify-between gap-2 px-3 sm:px-4 py-2.5 sm:py-3 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <div class="flex items-center justify-center shrink-0 w-8 h-8 sm:w-9 sm:h-9 rounded-md bg-[#F89820]/15 border border-[#F89820]/30">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 sm:size-5 text-[#B44D12]">
                            <path d="M8.851 18.56s-.917.534.653.714c1.902.218 2.874.187 4.969-.211 0 0 .552.346 1.321.646-4.699 2.013-10.633-.118-6.943-1.149M8.276 15.933s-1.028.762.542.924c2.032.209 3.636.227 6.413-.308 0 0 .384.389.987.602-5.679 1.661-12.007.13-7.942-1.218M13.116 11.475c1.158 1.333-.304 2.533-.304 2.533s2.939-1.518 1.589-3.418c-1.261-1.772-2.228-2.652 3.006-5.688 0 0-8.216 2.051-4.291 6.573M19.33 20.504s.679.559-.747.991c-2.712.822-11.288 1.069-13.669.033-.856-.373.75-.89 1.254-.998.527-.114.828-.093.828-.093-.953-.671-6.156 1.317-2.643 1.887 9.58 1.553 17.462-.7 14.977-1.82M9.292 13.21s-4.362 1.036-1.544 1.412c1.189.159 3.561.123 5.77-.062 1.806-.152 3.618-.477 3.618-.477s-.637.273-1.098.587c-4.429 1.166-12.986.623-10.522-.568 2.082-1.006 3.776-.892 3.776-.892M17.116 17.584c4.503-2.34 2.421-4.589.968-4.285-.355.074-.515.138-.515.138s.132-.207.385-.297c2.875-1.011 5.086 2.981-.928 4.562 0 0 .07-.063.09-.118M14.401 23.802c4.323.276 10.966-.153 11.122-2.2 0 0-.302.775-3.573 1.391-3.688.694-8.238.613-10.933.168 0 0 .552.456 3.384.641"/>
                        </svg>
                    </div>

                    <span class="text-sm font-semibold text-gray-800 truncate">
                        Main.java
                    </span>

                    <!-- Badge: shown only when the code reads input -->
                    <span
                        v-if="usesInput"
                        class="hidden sm:inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-[11px] font-medium"
                        :class="needsInput
                            ? 'bg-amber-100 text-amber-800'
                            : 'bg-emerald-100 text-emerald-700'"
                    >
                        {{ needsInput ? 'Needs input' : 'Input ready' }}
                    </span>
                </div>

                <!-- Run Button -->
                <button
                    @click="runCode"
                    :disabled="isRunning"
                    class="flex items-center shrink-0 gap-1.5 text-xs font-semibold text-white bg-gradient-to-r from-[#8B5CF6] to-[#6D28D9] px-2.5 sm:px-3.5 py-1.5 rounded-md hover:brightness-110 transition disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer min-w-[60px] sm:min-w-[72px] justify-center"
                >
                    <svg
                        v-if="isRunning" class="animate-spin size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <svg
                        v-else xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="size-3.5" >
                        <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                    </svg>
                    {{ isRunning ? 'Running' : 'Run' }}
                </button>
            </div>

            <!-- Editor -->
            <div
                ref="editorContainer"
                class="w-full h-[280px] sm:h-[360px] md:h-[350px] lg:h-[200px]"
            ></div>

            <!-- Input -->
            <div
                ref="inputSection"
                class="border-t px-3 sm:px-4 py-2.5 sm:py-3 transition-colors"
                :class="needsInput || showInputWarning
                    ? 'border-amber-300 bg-amber-50'
                    : 'border-gray-200 bg-gray-50'"
            >
                <div class="flex items-center justify-between pb-1.5">
                    <p class="text-[11px] sm:text-xs uppercase tracking-wider font-semibold"
                       :class="needsInput || showInputWarning ? 'text-amber-800' : 'text-gray-600'">
                        Input
                    </p>
                    <span v-if="usesInput" class="text-[11px] sm:text-xs text-amber-800 font-semibold">
                        {{ needsInput ? 'Required' : '' }}
                    </span>
                </div>

                <!-- Helper message -->
                <div
                    v-if="usesInput"
                    class="mb-2 flex items-start gap-2 rounded-md border px-2.5 py-2 text-[12px] sm:text-[13px] leading-snug"
                    :class="needsInput || showInputWarning
                        ? 'border-amber-300 bg-amber-100/60 text-amber-900'
                        : 'border-emerald-200 bg-emerald-50 text-emerald-800'"
                    role="status"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 shrink-0 mt-0.5">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <template v-if="needsInput || showInputWarning">
                            <p class="font-semibold">Your program reads input.</p>
                            <p>
                                Type the values below <em>before</em> you click Run. Put each value
                                on its own line, in the same order your program asks for them.
                            </p>
                        </template>
                        <template v-else>
                            <p class="font-semibold">Input added.</p>
                            <p>Your program will read {{ inputLineCount }} line{{ inputLineCount === 1 ? '' : 's' }} from this box.</p>
                        </template>
                    </div>
                </div>

                <textarea
                    ref="inputField"
                    v-model="input"
                    :placeholder="usesInput
                        ? 'Example:\nAlice\n25'
                        : 'Enter input for your program (only needed if your code uses Scanner)...'"
                    class="w-full min-h-[80px] resize-y rounded-md border bg-white p-2 text-[13px] sm:text-sm font-mono text-gray-900 placeholder:text-gray-500 outline-none focus:ring-2"
                    :class="needsInput || showInputWarning
                        ? 'border-amber-400 focus:border-amber-500 focus:ring-amber-400/30'
                        : 'border-gray-200 focus:border-[#8B5CF6] focus:ring-[#8B5CF6]/20'"
                    @input="showInputWarning = false"
                ></textarea>
            </div>

            <!-- Output -->
            <div class="border-t border-gray-200 bg-gray-50 px-3 sm:px-4 py-2.5 sm:py-3">
                <p class="text-[11px] sm:text-xs uppercase tracking-wider font-semibold text-gray-600 pb-1.5">
                    Output
                </p>

                <p
                    v-if="output"
                    class="text-[13px] sm:text-sm font-mono text-emerald-700 whitespace-pre-wrap break-words"
                >{{ output }}</p>

                <p
                    v-if="error"
                    class="text-[13px] sm:text-sm font-mono text-red-600 whitespace-pre-wrap break-words"
                >{{ error }}</p>

                <!-- Friendly hint when the program ran out of input -->
                <p
                    v-if="error && ranOutOfInput"
                    class="mt-2 rounded-md border border-amber-300 bg-amber-50 px-2.5 py-2 text-[12px] sm:text-[13px] text-amber-900"
                >
                    Your program asked for more input than you provided. Add the missing values
                    in the Input box (one per line), then run it again.
                </p>

                <p v-if="isRunning" class="text-[13px] sm:text-sm font-mono text-gray-700">
                    Running...
                </p>

                <p
                    v-if="!output && !error && !isRunning"
                    class="text-[13px] sm:text-sm font-mono text-gray-600"
                >
                    Program output will appear here.
                </p>
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import * as monaco from 'monaco-editor'

let editor = null
const editorContainer = ref(null)
const inputField = ref(null)
const inputSection = ref(null)

const code = ref(`public class Main {
    public static void main(String[] args) {
        System.out.println("Hello, learner!");
    }
}`)

const input = ref('')
const output = ref('')
const error = ref('')
const isRunning = ref(false)
const showInputWarning = ref(false)

// Does the code read from the keyboard? Ignore comments so
// "// Scanner example" doesn't trigger the hint.
const usesInput = computed(() => {
    const stripped = code.value
        .replace(/\/\*[\s\S]*?\*\//g, '')
        .replace(/\/\/.*$/gm, '')

    return /\bnew\s+Scanner\s*\(\s*System\.in|System\.in\b|\bBufferedReader\b|\bConsole\b/.test(stripped)
})

const hasInput = computed(() => input.value.trim().length > 0)
const needsInput = computed(() => usesInput.value && !hasInput.value)
const inputLineCount = computed(() => input.value.trim().split(/\r?\n/).length)

const ranOutOfInput = computed(() =>
    /NoSuchElementException|InputMismatchException|NullPointerException/.test(error.value)
)

const runCode = async () => {
    // Stop early and guide the user instead of running a program that will crash
    if (needsInput.value) {
        showInputWarning.value = true
        output.value = ''
        error.value = ''
        inputSection.value?.scrollIntoView({ behavior: 'smooth', block: 'center' })
        inputField.value?.focus({ preventScroll: true })
        return
    }

    isRunning.value = true
    output.value = ''
    error.value = ''

    try {
        const response = await fetch('/practice-compiler/run', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                code: code.value,
                input: input.value
            })
        })

        const data = await response.json()

        if (data.success) {
            output.value = data.output
        } else {
            error.value = data.output
        }
    } catch (err) {
        error.value = 'Unable to connect to the compiler.'
    } finally {
        isRunning.value = false
    }
}

onMounted(() => {
    const isSmallScreen = window.innerWidth < 640

    self.MonacoEnvironment = {
        getWorker() {
            const workerUrl = new URL(
                '../../../monaco.worker.js',
                import.meta.url
            )

            const blob = new Blob(
                [`import(${JSON.stringify(workerUrl.href)})`],
                { type: 'text/javascript' }
            )

            return new Worker(
                URL.createObjectURL(blob),
                { type: 'module' }
            )
        }
    }

    editor = monaco.editor.create(editorContainer.value, {
        value: code.value,
        language: 'java',
        theme: 'vs',
        automaticLayout: true,
        fontSize: isSmallScreen ? 12 : 13,
        lineHeight: isSmallScreen ? 18 : 20,
        minimap: {
            enabled: false
        },
        padding: {
            top: 20,
            bottom: 20
        },
        scrollBeyondLastLine: false,
        wordWrap: 'on',
        tabSize: 4,
        insertSpaces: true
    })

    editor.onDidChangeModelContent(() => {
        code.value = editor.getValue()
    })
})

onBeforeUnmount(() => {
    if (editor) {
        editor.dispose()
    }
})
</script>
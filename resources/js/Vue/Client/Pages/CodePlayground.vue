<template>
    <div
        ref="root"
        class="w-full max-w-6xl mx-auto flex flex-col lg:flex-row h-[680px] lg:h-[520px] rounded-lg overflow-hidden border border-[#cfd9e6] bg-[#fafafa]"
        :class="{ 'select-none': dragging }"
    >
        <!-- ── Left pane: editor ── -->
        <div
            class="flex flex-col min-w-0 min-h-0 max-lg:flex-1"
            :style="isDesktop ? { width: leftWidth + '%' } : null"
        >
            <!-- Tab bar -->
            <div class="flex items-stretch justify-between border-b border-[#d9e1ec] bg-[#fcfcfd]">
                <div class="flex items-center px-4 py-3 text-sm text-[#6b5b95] bg-[#fafafa] border-r border-[#d9e1ec] -mb-px">
                    Main.java
                </div>
                <div class="flex items-center gap-2 pr-3 py-2">
                    <button
                        @click="clearAll"
                        class="px-3 py-1.5 text-sm text-[#6b5b95] hover:text-[#4f00f5] transition-colors"
                    >
                        Reset
                    </button>
                    <button
                        @click="runCode"
                        :disabled="running"
                        class="flex items-center gap-1.5 px-5 py-1.5 rounded text-sm font-medium text-white bg-[#4f00f5] hover:bg-[#4300cf] disabled:opacity-60 disabled:cursor-not-allowed transition-colors"
                    >
                        Run
                        <svg v-if="running" class="animate-spin size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3.5">
                            <path d="M7 4.5v15a1 1 0 0 0 1.5.86l12-7.5a1 1 0 0 0 0-1.72l-12-7.5A1 1 0 0 0 7 4.5Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Code area -->
            <div class="flex-1 min-h-0 overflow-auto">
                <div class="relative grid grid-cols-[auto_1fr] w-max min-w-full min-h-full">
                    <!-- Active line band -->
                    <div
                        class="absolute inset-x-0 h-[22px] bg-[#f0f0f0] pointer-events-none"
                        :style="{ top: 12 + (activeLine - 1) * 22 + 'px' }"
                    ></div>

                    <!-- Line numbers -->
                    <div class="relative select-none pt-3 pb-3 pl-3 pr-4 text-right code-font text-[#8da2bd]">
                        <div v-for="n in lineCount" :key="n" :class="{ 'text-[#5d7491]': n === activeLine }">{{ n }}</div>
                    </div>

                    <!-- Highlighted layer + textarea -->
                    <div class="relative grid">
                        <pre
                            class="col-start-1 row-start-1 m-0 p-3 pl-0 pointer-events-none code-font whitespace-pre text-[#1f2430]"
                            aria-hidden="true"
                            v-html="highlighted + '\n'"
                        ></pre>
                        <textarea
                            ref="editor"
                            v-model="code"
                            wrap="off"
                            spellcheck="false"
                            autocomplete="off"
                            autocorrect="off"
                            autocapitalize="off"
                            class="col-start-1 row-start-1 w-full h-full m-0 p-3 pl-0 code-font whitespace-pre bg-transparent text-transparent caret-[#4f00f5] resize-none outline-none overflow-hidden selection:bg-[#4f00f5]/20"
                            @keydown.tab.prevent="insertTab"
                            @keydown="onKeydown"
                            @keydown.ctrl.enter.prevent="runCode"
                            @keydown.meta.enter.prevent="runCode"
                            @keyup="updateActiveLine"
                            @click="updateActiveLine"
                            @focus="updateActiveLine"
                            @input="updateActiveLine"
                        ></textarea>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── Divider ── -->
        <div class="relative shrink-0 bg-[#cfd9e6] max-lg:h-px max-lg:w-full lg:w-px">
            <div
                class="hidden lg:block absolute inset-y-0 -left-1.5 -right-1.5 cursor-col-resize z-20 touch-none"
                @pointerdown="startDrag"
                @pointermove="onDrag"
                @pointerup="stopDrag"
                @pointercancel="stopDrag"
            >
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-10 rounded-full bg-white border border-[#cfd9e6] flex items-center justify-center">
                    <svg viewBox="0 0 6 10" class="w-1.5 h-2.5 text-[#c5cedb]" fill="currentColor">
                        <circle cx="1" cy="1" r=".8" /><circle cx="5" cy="1" r=".8" />
                        <circle cx="1" cy="5" r=".8" /><circle cx="5" cy="5" r=".8" />
                        <circle cx="1" cy="9" r=".8" /><circle cx="5" cy="9" r=".8" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- ── Right pane: output ── -->
        <div class="flex-1 flex flex-col min-w-0 min-h-0 bg-[#f5f5f5]">
            <div class="flex items-center justify-between px-5 py-3 border-b border-[#d9e1ec] bg-[#fcfcfd]">
                <span class="text-sm text-[#6b5b95]">Output</span>
                
            </div>

            <div
                class="flex-1 m-0 p-5 overflow-auto whitespace-pre-wrap break-words code-font"
                :class="outputTextClass"
                @click="inlineInput?.focus()"
            >
                <span v-if="status === 'idle'">{{ running ? 'Running…' : 'Click Run to see the output here.' }}</span>
                <template v-else>
                    <span>{{ transcript }}</span>
                    <input
                        v-if="status === 'waiting' && !running"
                        ref="inlineInput"
                        v-model="liveInput"
                        @keydown.enter.prevent="submitInput"
                        spellcheck="false"
                        autocomplete="off"
                        class="code-font w-48 max-w-full bg-transparent outline-none text-[#4f00f5] caret-[#4f00f5] border-b border-[#4f00f5]/30"
                    />
                    <div v-if="stderrText" class="mt-4 text-red-600">{{ stderrText }}</div>
                </template>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, nextTick, onMounted, onBeforeUnmount } from 'vue';
import axios from 'axios';

// ── Java only ────────────────────────────────────────────────────────────────
const LANG    = 'openjdk-25';
const STARTER = `import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scn = new Scanner(System.in);

        System.out.print("Enter Name: ");
        String name = scn.nextLine();
        System.out.println("Welcome to Smart E-Learning, " + name + "!");
        scn.close();
        
    }
}`;

// ── State ────────────────────────────────────────────────────────────────────
const code    = ref(STARTER);
const running = ref(false);

// output state: 'idle' | 'waiting' (needs input) | 'success' | 'error'
const status     = ref('idle');
const stdoutText = ref('');
const stderrText = ref('');

const editor     = ref(null);
const activeLine = ref(1);

// ── Syntax highlighting ──────────────────────────────────────────────────────
const KEYWORDS =
    'abstract|assert|boolean|break|byte|case|catch|char|class|const|continue|default|do|double|else|enum|extends|final|finally|float|for|if|implements|import|instanceof|int|interface|long|new|package|private|protected|public|return|short|static|super|switch|this|throw|throws|try|void|while|var|true|false|null';

const TOKEN_RE = new RegExp(
    [
        '(\\/\\/.*|\\/\\*[\\s\\S]*?\\*\\/)',           
        '("(?:\\\\.|[^"\\\\\\n])*")',                  
        `\\b(${KEYWORDS})\\b`,                         
        '(?<=\\bclass\\s+)([A-Z]\\w*)',                
        '\\b([A-Za-z_]\\w*)(?=\\s*\\()',                
        '\\b(\\d+(?:\\.\\d+)?[fFdDlL]?)\\b',           
    ].join('|'),
    'g'
);

const esc = (s) => s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

function highlight(src) {
    let out = '';
    let last = 0;
    for (const m of src.matchAll(TOKEN_RE)) {
        out += esc(src.slice(last, m.index));
        const cls = m[1] ? 'cm' : m[2] ? 'st' : m[3] ? 'kw' : m[4] ? 'cn' : m[5] ? 'fn' : 'nm';
        out += `<span class="tok-${cls}">${esc(m[0])}</span>`;
        last = m.index + m[0].length;
    }
    return out + esc(src.slice(last));
}

const highlighted = computed(() => highlight(code.value));
const lineCount   = computed(() => code.value.split('\n').length);

// ── Editor helpers ───────────────────────────────────────────────────────────
function updateActiveLine() {
    const ta = editor.value;
    if (!ta) return;
    activeLine.value = ta.value.slice(0, ta.selectionStart).split('\n').length;
}

function insertTab() {
    const ta = editor.value;
    if (!ta) return;
    replaceRange(ta.selectionStart, ta.selectionEnd, INDENT);
}

// ── Auto-indent / auto-close ─────────────────────────────────────────────────
const PAIRS   = { '(': ')', '[': ']', '{': '}', '"': '"', "'": "'" };
const CLOSERS = new Set([')', ']', '}', '"', "'"]);
const INDENT  = '    ';

// execCommand keeps the browser's native undo stack; setRangeText is the fallback
function replaceRange(start, end, text, caret = start + text.length) {
    const ta = editor.value;
    ta.focus();
    ta.setSelectionRange(start, end);
    const ok = document.execCommand?.('insertText', false, text);
    if (!ok) {
        ta.setRangeText(text, start, end, 'end');
        code.value = ta.value;
    }
    ta.setSelectionRange(caret, caret);
    updateActiveLine();
}

function onKeydown(e) {
    const ta = editor.value;
    if (!ta || e.isComposing || e.ctrlKey || e.metaKey || e.altKey) return;

    const { value, selectionStart: start, selectionEnd: end } = ta;
    const prev = value[start - 1];
    const next = value[end];
    const key  = e.key;

    // Enter: keep indentation, expand {} / () / [] onto separate lines
    if (key === 'Enter') {
        e.preventDefault();
        const lineStart = value.lastIndexOf('\n', start - 1) + 1;
        const indent    = value.slice(lineStart, start).match(/^[ \t]*/)[0];
        const opensBlock = '{(['.includes(prev ?? '');

        if (opensBlock && PAIRS[prev] === next) {
            const inner = indent + INDENT;
            replaceRange(start, end, '\n' + inner + '\n' + indent, start + 1 + inner.length);
        } else if (opensBlock) {
            replaceRange(start, end, '\n' + indent + INDENT);
        } else {
            replaceRange(start, end, '\n' + indent);
        }
        return;
    }

    // Backspace between an empty pair deletes both characters
    if (key === 'Backspace' && start === end && prev && PAIRS[prev] === next) {
        e.preventDefault();
        replaceRange(start - 1, start + 1, '');
        return;
    }

    // Typing a closer when the same one is next: just move past it
    if (CLOSERS.has(key) && start === end && next === key) {
        e.preventDefault();
        ta.setSelectionRange(start + 1, start + 1);
        updateActiveLine();
        return;
    }

    // Typing "}" on a whitespace-only line: dedent one level
    if (key === '}' && start === end) {
        const lineStart = value.lastIndexOf('\n', start - 1) + 1;
        const before    = value.slice(lineStart, start);
        if (before.length >= INDENT.length && /^[ \t]+$/.test(before)) {
            e.preventDefault();
            replaceRange(start - INDENT.length, start, '}');
            return;
        }
    }

    // Opening bracket / quote: auto-close (or wrap the selection)
    if (key in PAIRS) {
        const isQuote = key === '"' || key === "'";
        const hasSelection = start !== end;

        // don't auto-close quotes after a word character (e.g. don't)
        if (isQuote && !hasSelection && /\w/.test(prev ?? '')) return;
        // don't auto-close in front of a word character
        if (!hasSelection && /\w/.test(next ?? '')) return;

        e.preventDefault();
        if (hasSelection) {
            const selected = value.slice(start, end);
            replaceRange(start, end, key + selected + PAIRS[key], start + 1 + selected.length);
        } else {
            replaceRange(start, end, key + PAIRS[key], start + 1);
        }
    }
}

// ── Resizable divider (desktop only) ─────────────────────────────────────────
const root      = ref(null);
const leftWidth = ref(55);
const dragging  = ref(false);
const isDesktop = ref(true);

let mq;
const onMq = (e) => { isDesktop.value = e.matches; };

onMounted(() => {
    mq = window.matchMedia('(min-width: 1024px)');
    isDesktop.value = mq.matches;
    mq.addEventListener('change', onMq);
});
onBeforeUnmount(() => mq?.removeEventListener('change', onMq));

function startDrag(e) {
    dragging.value = true;
    e.currentTarget.setPointerCapture(e.pointerId);
}
function onDrag(e) {
    if (!dragging.value || !root.value) return;
    const rect = root.value.getBoundingClientRect();
    const pct  = ((e.clientX - rect.left) / rect.width) * 100;
    leftWidth.value = Math.min(75, Math.max(25, pct));
}
function stopDrag(e) {
    dragging.value = false;
    e.currentTarget.releasePointerCapture?.(e.pointerId);
}

// ── Interactive input ────────────────────────────────────────────────────────
// The backend runs a program once and returns. When the program stalls on a
// Scanner read, we show an inline field, then re-run with everything typed so far.
const inputs      = ref([]);   // lines the user has typed
const stalls      = ref([]);   // stdout offsets where each input was requested
const liveInput   = ref('');
const inlineInput = ref(null);

const NEEDS_INPUT_RE = /NoSuchElementException[\s\S]*java\.util\.Scanner/;

// stdout with the typed lines echoed in at the point they were requested
const transcript = computed(() => {
    const text = stdoutText.value;
    let out  = '';
    let prev = 0;
    inputs.value.forEach((line, i) => {
        const at = Math.min(stalls.value[i] ?? text.length, text.length);
        out += text.slice(prev, at) + line + '\n';
        prev = at;
    });
    return out + text.slice(prev);
});

const outputTextClass = computed(() =>
    status.value === 'idle' ? 'text-[#9aa6b8]' : 'text-[#1f2430]'
);

// ── Actions ──────────────────────────────────────────────────────────────────
async function runCode() {
    if (running.value) return;
    inputs.value     = [];
    stalls.value     = [];
    liveInput.value  = '';
    stdoutText.value = '';
    stderrText.value = '';
    status.value     = 'idle';
    await execute();
}

async function submitInput() {
    if (running.value || status.value !== 'waiting') return;
    inputs.value.push(liveInput.value);
    liveInput.value = '';
    await execute();
}

async function execute() {
    running.value = true;
    try {
        const res = await axios.post('/run-code', {
            compiler: LANG,
            code:     code.value,
            input:    inputs.value.length ? inputs.value.map((l) => l + '\n').join('') : null,
        });

        const data   = res.data;
        const stdout = data.output ?? data.stdout ?? '';
        const stderr = data.error  ?? data.stderr  ?? '';

        stdoutText.value = stdout;

        if (NEEDS_INPUT_RE.test(stderr)) {
            stalls.value.push(stdout.length);
            stderrText.value = '';
            status.value     = 'waiting';
        } else {
            stderrText.value = stderr.trim();
            status.value     = stderr && !stdout ? 'error' : 'success';
        }
    } catch (err) {
        inputs.value     = [];
        stalls.value     = [];
        stdoutText.value = '';
        stderrText.value = err.response?.data?.message
            ?? err.response?.data?.error
            ?? err.message
            ?? 'An unexpected error occurred.';
        status.value = 'error';
    } finally {
        running.value = false;
        if (status.value === 'waiting') {
            await nextTick();
            inlineInput.value?.focus();
        }
    }
}

function clearOutput() {
    inputs.value     = [];
    stalls.value     = [];
    liveInput.value  = '';
    stdoutText.value = '';
    stderrText.value = '';
    status.value     = 'idle';
}

function clearAll() {
    code.value       = STARTER;
    activeLine.value = 1;
    clearOutput();
}

async function copyOutput() {
    if (status.value === 'idle') return;
    try {
        await navigator.clipboard.writeText(
            transcript.value + (stderrText.value ? '\n' + stderrText.value : '')
        );
    } catch {
        /* clipboard unavailable */
    }
}
</script>

<style scoped>
.code-font {
    font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, 'Liberation Mono', monospace;
    font-size: 13px;
    line-height: 22px;
    tab-size: 4;
}

/* v-html content isn't scoped, so use :deep */
:deep(.tok-kw) { color: #c000c0; }
:deep(.tok-cn) { color: #f2a33a; }
:deep(.tok-st) { color: #e5384a; }
:deep(.tok-cm) { color: #9aa6b8; }
:deep(.tok-fn) { color: #3f63e0; }
:deep(.tok-nm) { color: #1d7fd6; }
</style>
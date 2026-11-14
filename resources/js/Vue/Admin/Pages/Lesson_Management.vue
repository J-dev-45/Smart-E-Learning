<template>
    <div class="w-full h-full flex flex-col overflow-hidden">

        <!-- HEADER -->
        <header
            class="relative z-10 shrink-0 w-full h-[60px] flex items-center justify-between gap-3 px-3 sm:px-5 sharedSurfaceBG border-b-[1.5px] sharedBorder shadow-md sharedShadow sharedTXT"
        >
            <a
                :href="`/subject/${url(subjectName)}/${subjectId}`"
                class="cursor-pointer group flex items-center gap-1.5 sharedTXTMuted sharedHoverTXT transition-colors duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 transition-transform group-hover:-translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>

                <span class="text-sm font-medium">Back To Modules</span>
            </a>

            <!-- PROFILE -->
            <div class="relative shrink-0">
                <button
                    type="button"
                    @click.stop="toggleUserMenu"
                    aria-label="Open admin menu"
                    aria-haspopup="menu"
                    :aria-expanded="showUserMenu"
                    :class="[
                        'shrink-0 w-9 h-9 rounded-full sharedTXT flex items-center justify-center text-xs font-semibold cursor-pointer focus:outline-none focus:ring-1 focus:ring-gray-300',
                        profileColor
                    ]"
                >
                    {{ initials(userName) }}
                </button>
            </div>
        </header>

        <div class="flex-1 min-h-0 overflow-y-auto scrollbar-thin">
            <div class="w-full max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">

                <!-- Page title -->
                <div class="mb-8">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest sharedTXTAccent mb-2">
                            Lesson Management
                        </p>

                        <h1 class="text-2xl sm:text-3xl font-bold sharedTXT">
                            {{ displayTopicName }}
                        </h1>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">

                    <!-- Topic Details (name + description) -->
                    <div class="sharedSurface rounded-2xl p-5 sm:p-6 shadow-lg sharedShadow">
                        <div class="mb-5">
                            <h2 class="text-lg font-semibold sharedTXT">
                                Topic Details
                            </h2>

                            <p class="text-sm sharedTXTMuted mt-1">
                                Edit the topic name and add a short description of what this topic covers.
                            </p>
                        </div>

                        <div
                            v-if="loadingTopic"
                            class="flex items-center gap-3 py-6"
                        >
                            <svg class="w-5 h-5 animate-spin sharedTXTAccent" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity="0.25" />
                                <path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            <p class="text-sm sharedTXTMuted">
                                Loading topic details...
                            </p>
                        </div>

                        <div v-else class="space-y-5">
                            <div>
                                <label
                                    for="topicTitleInput"
                                    class="block text-sm font-medium sharedTXT mb-2"
                                >
                                    Topic Name
                                </label>

                                <input
                                    id="topicTitleInput"
                                    v-model="topicTitle"
                                    type="text"
                                    maxlength="150"
                                    placeholder="Enter topic name"
                                    :disabled="savingTopic"
                                    class="sharedSurfaceDeepBG sharedBorder sharedTXTBody sharedCaret sharedSelection w-full border rounded-lg px-4 py-2.5 text-sm outline-none disabled:opacity-50"
                                >
                            </div>

                            <div>
                                <label
                                    for="topicDescriptionInput"
                                    class="block text-sm font-medium sharedTXT mb-2"
                                >
                                    Topic Description
                                </label>

                                <textarea
                                    id="topicDescriptionInput"
                                    v-model="topicDescription"
                                    rows="4"
                                    maxlength="1000"
                                    placeholder="Briefly describe what students will learn in this topic..."
                                    :disabled="savingTopic"
                                    class="sharedSurfaceDeepBG sharedBorder sharedTXTBody sharedCaret sharedSelection scrollbar-thin w-full border rounded-lg px-4 py-3 text-sm leading-relaxed outline-none resize-y min-h-[100px] disabled:opacity-50"
                                ></textarea>

                                <p class="text-xs sharedTXTMuted mt-1.5 text-right">
                                    {{ topicDescription.length }}/1000
                                </p>
                            </div>

                            <div class="flex justify-end">
                                <button
                                    type="button"
                                    @click="saveTopicDetails"
                                    :disabled="savingTopic || !topicTitle.trim() || !topicModuleId"
                                    class="sharedBtn sharedFocus inline-flex cursor-pointer items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition focus-visible:outline-2 focus-visible:outline-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <svg
                                        v-if="savingTopic"
                                        class="w-4 h-4 animate-spin"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >
                                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity="0.25" />
                                        <path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                    </svg>

                                    {{ savingTopic ? 'Saving...' : 'Save Details' }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson Editor -->
                    <div>

                        <!-- No Content -->
                        <div
                            v-if="!loading && !lessonId && !isNewLesson"
                            class="sharedSurface rounded-2xl p-10 sm:p-14 text-center shadow-lg sharedShadow"
                        >
                            <div class="sharedBrandTint w-16 h-16 mx-auto mb-5 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 sharedTXTAccent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 5.5A2.5 2.5 0 016.5 3H20v15H6.5A2.5 2.5 0 014 20.5z" />
                                    <path d="M4 20.5A2.5 2.5 0 016.5 18H20v3H6.5A2.5 2.5 0 014 20.5z" />
                                </svg>
                            </div>

                            <h2 class="text-xl font-semibold sharedTXT mb-2">
                                No Topic Content Yet
                            </h2>

                            <p class="text-sm sharedTXTMuted mb-6 max-w-sm mx-auto">
                                Add the complete learning material for this topic.
                            </p>

                            <button
                                type="button"
                                @click="createNewLesson"
                                class="sharedBtn sharedFocus inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition focus-visible:outline-2 focus-visible:outline-offset-2"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                                    <path d="M10 4v12M4 10h12" />
                                </svg>
                                Add Topic Content
                            </button>
                        </div>

                        <div
                            v-else
                            class="space-y-6"
                        >
                            <div class="sharedSurface rounded-2xl p-5 sm:p-6 shadow-lg sharedShadow">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
                                    <div>
                                        <h2 class="text-lg font-semibold sharedTXT">
                                            Topic Content
                                        </h2>

                                        <p class="text-sm sharedTXTMuted mt-1">
                                            Write the complete topic material or upload a PDF/DOCX file.
                                        </p>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2">
                                        <input
                                            ref="documentInput"
                                            type="file"
                                            accept=".pdf,.docx"
                                            class="hidden"
                                            @change="uploadDocument"
                                        >

                                        <button
                                            type="button"
                                            @click="$refs.documentInput.click()"
                                            :disabled="uploading"
                                            class="sharedBtnSoft sharedFocus inline-flex cursor-pointer items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition focus-visible:outline-2 focus-visible:outline-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg
                                                v-if="!uploading" class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" >
                                                <path d="M10 13V4M6.5 7.5L10 4l3.5 3.5M4 13v3h12v-3" />
                                            </svg>

                                            <svg
                                                v-else class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" >
                                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity="0.25" />
                                                <path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                            </svg>

                                            {{ uploading ? 'Extracting...' : 'Upload PDF or DOCX' }}
                                        </button>

                                        <button
                                            v-if="lessonId"
                                            type="button"
                                            @click="deleteLesson"
                                            :disabled="saving || deleting || uploading"
                                            class="sharedStateDanger sharedStatePill sharedStatePillLink inline-flex cursor-pointer items-center gap-1.5 px-4 py-2.5 rounded-lg border text-sm font-medium transition disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 6h12M8 6V4h4v2M6 6l1 10h6l1-10" />
                                            </svg>
                                            {{ deleting ? 'Deleting...' : 'Delete' }}
                                        </button>
                                    </div>
                                </div>

                                <div
                                    v-if="loading"
                                    class="sharedSurfaceDeepBG sharedBorder min-h-[350px] border rounded-xl p-4 flex flex-col items-center justify-center gap-3"
                                >
                                    <svg class="w-6 h-6 animate-spin sharedTXTAccent" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity="0.25" />
                                        <path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                    </svg>
                                    <p class="text-sm sharedTXTMuted">
                                        Loading topic content...
                                    </p>
                                </div>

                                <div
                                    v-else
                                    class="sharedBorder border rounded-xl overflow-hidden"
                                >
                                    <div class="sharedSurfaceDeeper sharedBorder flex flex-wrap items-center gap-1 px-3 py-2 border-b" style="border-radius:0; border-width:0 0 1px 0;">
                                        <button
                                            type="button"
                                            title="Bold"
                                            aria-label="Bold"
                                            @mousedown.prevent="formatText('bold')"
                                            :aria-pressed="activeFormats.bold"
                                            :class="toolbarBtnClass('bold', 'text-sm font-bold')"
                                        >
                                            B
                                        </button>

                                        <button
                                            type="button"
                                            title="Italic"
                                            aria-label="Italic"
                                            @mousedown.prevent="formatText('italic')"
                                            :aria-pressed="activeFormats.italic"
                                            :class="toolbarBtnClass('italic', 'text-sm italic font-serif')"
                                        >
                                            I
                                        </button>

                                        <span class="sharedLine w-px h-5 mx-1"></span>

                                        <button
                                            type="button"
                                            title="Bulleted list"
                                            aria-label="Bulleted list"
                                            @mousedown.prevent="formatText('insertUnorderedList')"
                                            :aria-pressed="activeFormats.insertUnorderedList"
                                            :class="toolbarBtnClass('insertUnorderedList', 'flex items-center justify-center')"
                                        >
                                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                                                <circle cx="4" cy="6" r="1" fill="currentColor" />
                                                <circle cx="4" cy="10" r="1" fill="currentColor" />
                                                <circle cx="4" cy="14" r="1" fill="currentColor" />
                                                <path d="M8 6h9M8 10h9M8 14h9" />
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            title="Numbered list"
                                            aria-label="Numbered list"
                                            @mousedown.prevent="formatText('insertOrderedList')"
                                            :aria-pressed="activeFormats.insertOrderedList"
                                            :class="toolbarBtnClass('insertOrderedList', 'flex items-center justify-center')"
                                        >
                                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                                                <path d="M8 6h9M8 10h9M8 14h9" />
                                                <text x="2" y="7.5" font-size="5.5" fill="currentColor" stroke="none">1</text>
                                                <text x="2" y="11.5" font-size="5.5" fill="currentColor" stroke="none">2</text>
                                                <text x="2" y="15.5" font-size="5.5" fill="currentColor" stroke="none">3</text>
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            @click="saveLesson"
                                            :disabled="saving || loading || uploading || deleting"
                                            class="sharedBtn sharedFocus ml-auto inline-flex cursor-pointer items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition focus-visible:outline-2 focus-visible:outline-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg
                                                v-if="saving"
                                                class="w-4 h-4 animate-spin"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                            >
                                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity="0.25" />
                                                <path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                            </svg>

                                            {{
                                                saving
                                                    ? 'Saving...'
                                                    : isNewLesson
                                                        ? 'Create Content'
                                                        : 'Save Content'
                                            }}
                                        </button>
                                    </div>

                                    <div
                                        ref="lessonEditor"
                                        contenteditable="true"
                                        data-placeholder="Start writing your topic content here..."
                                        class="lesson-editor sharedSurfaceDeepBG sharedTXTBody sharedCaret sharedSelection w-full min-h-[350px] max-h-[60vh] overflow-y-auto scrollbar-thin p-5 outline-none leading-relaxed"
                                        @input="updateLessonContent"
                                        @keyup="saveSelection"
                                        @mouseup="saveSelection"
                                        @focus="saveSelection"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Admin_Menu
            :show-admin-menu="showUserMenu"
            :user-name="userName"
            :user-email="userEmail"
            :profile-color="profileColor"
            :profile-picture="profilePicture"
            :profile-avatar="profileAvatar"
            @close-admin-menu="showUserMenu = false"
        />

        <Toast
            :show="showToast"
            :type="toastType"
            :message="toastMessage"
            @close="showToast = false"
        />
    </div>
</template>

<script>
import Admin_Menu from '../Pages/Admin_Menu.vue';
import Toast from '../components/Toast.vue';

export default {
    components: { Admin_Menu, Toast },

    props: {
        subjectName: { type: String, required: true },
        subjectId: { type: String, required: true },
        topicName: { type: String, required: true },
        topicId: { type: String, required: true },
        userName: { type: String, default: '' },
        userEmail: { type: String, default: '' },
        profileColor: { type: String, default: '' },
        profilePicture: { type: String, default: '' },
        profileAvatar: { type: String, default: '' },
    },

    data() {
        return {
            lessonId: null,
            lessonContent: '',
            loading: false,
            saving: false,
            uploading: false,
            deleting: false,
            isNewLesson: false,
            savedRange: null,
            showUserMenu: false,
            showToast: false,
            toastMessage: '',
            toastType: 'success',
            activeFormats: {
                bold: false,
                italic: false,
                insertUnorderedList: false,
                insertOrderedList: false,
            },

            // Topic details (editable name + description)
            topicTitle: '',
            topicDescription: '',
            savedTopicTitle: '',
            topicModuleId: '',
            loadingTopic: false,
            savingTopic: false,
        };
    },

    computed: {
        formattedTopicName() {
            return this.topicName
                .replace(/[-_]/g, ' ')
                .replace(/\b\w/g, character => character.toUpperCase());
        },

        // Heading shows the saved name, falling back to the URL-based name.
        displayTopicName() {
            return this.savedTopicTitle || this.formattedTopicName;
        },
    },

    mounted() {
        this.topicTitle = this.formattedTopicName;

        this.loadTopic();
        this.loadLesson();
        document.addEventListener('selectionchange', this.updateActiveFormats);
    },

    beforeUnmount() {
        document.removeEventListener('selectionchange', this.updateActiveFormats);
    },

    methods: {
        url(url_name) {
            return url_name.replace(/\s+/g, '_');
        },

        toolbarBtnClass(command, extra = '') {
            const base = 'w-9 h-9 rounded-lg transition ' + extra;

            return this.activeFormats[command]
                ? base + ' sharedBtn ring-1 ring-white/30 shadow-inner'
                : base + ' sharedTXTBody sharedIconBtn sharedHoverTXT';
        },

        updateActiveFormats() {
            const editor = this.$refs.lessonEditor;
            const selection = window.getSelection();

            if (
                !editor ||
                !selection ||
                selection.rangeCount === 0 ||
                !editor.contains(selection.anchorNode)
            ) {
                return;
            }

            Object.keys(this.activeFormats).forEach(command => {
                try {
                    this.activeFormats[command] =
                        document.queryCommandState(command);
                } catch (error) {
                    this.activeFormats[command] = false;
                }
            });
        },

        initials(name) {
            return (name || '')
                .trim()
                .split(/\s+/)
                .filter(Boolean)
                .slice(0, 2)
                .map(part => part[0].toUpperCase())
                .join('');
        },

        toggleUserMenu() {
            this.showUserMenu = !this.showUserMenu;
        },

        async notify(message, type = 'success') {
            this.showToast = false;
            await this.$nextTick();

            this.toastMessage = message;
            this.toastType = type;
            this.showToast = true;
        },

        // ---------- Topic details (name + description) ----------

        // GET /getTopic/{topic_id} -> { topic: { topic_name, description, module_id, ... } }
        async loadTopic() {
            this.loadingTopic = true;

            try {
                const response = await fetch(
                    `/getTopic/${this.topicId}`,
                    {
                        headers: {
                            'Accept': 'application/json',
                        },
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Failed to load topic details.'
                    );
                }

                if (data.topic) {
                    this.topicTitle = data.topic.topic_name || this.formattedTopicName;
                    this.topicDescription = data.topic.description || '';
                    this.savedTopicTitle = data.topic.topic_name || '';
                    this.topicModuleId = data.topic.module_id || '';
                }
            } catch (error) {
                console.error('Failed to load topic details:', error);

                this.notify(
                    error.message || 'Failed to load topic details.',
                    'error'
                );
            } finally {
                this.loadingTopic = false;
            }
        },

        async saveTopicDetails() {
            const name = this.topicTitle.trim();

            if (!name) {
                this.notify('Topic name is required.', 'error');
                return;
            }

            if (!this.topicModuleId) {
                this.notify('Topic details are not loaded yet.', 'error');
                return;
            }

            this.savingTopic = true;

            try {
                const response = await fetch(
                    '/editTopic',
                    {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            topic_id: this.topicId,
                            module_id: this.topicModuleId,
                            new_topic_name: name,
                            new_description: this.topicDescription.trim(),
                            subject_name: this.subjectName,
                        }),
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Failed to save topic details.'
                    );
                }

                const saved = data.updated_topic || {};

                this.topicTitle = saved.topic_name || name;
                this.topicDescription = saved.description ?? this.topicDescription.trim();
                this.savedTopicTitle = this.topicTitle;

                this.notify(data.message || 'Topic details saved successfully!');
            } catch (error) {
                console.error('Failed to save topic details:', error);

                this.notify(
                    error.message || 'Failed to save topic details.',
                    'error'
                );
            } finally {
                this.savingTopic = false;
            }
        },

        // ---------- Lesson content ----------

        async loadLesson() {
            this.loading = true;

            try {
                const response = await fetch(
                    `/lesson-content/topic/${this.topicId}`,
                    {
                        headers: {
                            'Accept': 'application/json',
                        },
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Failed to load topic content.'
                    );
                }

                if (data.lesson) {
                    this.lessonId = data.lesson.id;
                    this.lessonContent = data.lesson.content || '';
                    this.isNewLesson = false;
                } else {
                    this.lessonId = null;
                    this.lessonContent = '';
                    this.isNewLesson = false;
                }

            } catch (error) {
                console.error('Failed to load topic content:', error);

                this.notify(
                    error.message || 'Failed to load topic content.',
                    'error'
                );
            } finally {
                this.loading = false;

                await this.$nextTick();

                if (this.$refs.lessonEditor) {
                    this.$refs.lessonEditor.innerHTML =
                        this.lessonContent;
                    this.ensureTrailingParagraph();
                }
            }
        },

        createNewLesson() {
            this.lessonId = null;
            this.isNewLesson = true;
            this.loading = false;
            this.lessonContent = '';
            this.savedRange = null;

            this.$nextTick(() => {
                if (this.$refs.lessonEditor) {
                    this.$refs.lessonEditor.innerHTML = '';
                    this.$refs.lessonEditor.focus();
                }
            });
        },


        ensureTrailingParagraph() {
            const editor = this.$refs.lessonEditor;

            if (!editor) {
                return;
            }

            const last = editor.lastChild;

            if (!last) {
                return;
            }

            if (last.nodeType === Node.TEXT_NODE && last.textContent.trim() !== '') {
                return;
            }


            const isPlainTextBlock =
                last.nodeType === Node.ELEMENT_NODE &&
                ['P', 'DIV'].includes(last.tagName) &&
                last.attributes.length === 0 &&
                !last.querySelector(
                    'table, ul, ol, pre, blockquote, div, p, h1, h2, h3, h4, h5, h6'
                );

            if (isPlainTextBlock) {
                return;
            }

            const paragraph = document.createElement('p');
            paragraph.appendChild(document.createElement('br'));
            editor.appendChild(paragraph);
        },


        focusEditorEnd(event) {
            const editor = this.$refs.lessonEditor;

            if (!editor || event.target !== editor) {
                return;
            }

            this.ensureTrailingParagraph();

            const target = editor.lastChild;

            if (!target) {
                return;
            }

            const range = document.createRange();
            range.selectNodeContents(target);
            range.collapse(false);

            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);

            this.saveSelection();
        },

        saveSelection() {
            const selection = window.getSelection();

            if (
                selection.rangeCount > 0 &&
                this.$refs.lessonEditor?.contains(selection.anchorNode)
            ) {
                this.savedRange = selection.getRangeAt(0).cloneRange();
            }
        },

        restoreSelection() {
            if (!this.savedRange) {
                return;
            }

            const selection = window.getSelection();

            selection.removeAllRanges();
            selection.addRange(this.savedRange);
        },

        formatText(command) {
            if (!this.$refs.lessonEditor) {
                return;
            }

            this.$refs.lessonEditor.focus();
            this.restoreSelection();

            document.execCommand(command, false, null);

            this.updateLessonContent();
            this.saveSelection();
            this.updateActiveFormats();
        },

        updateLessonContent() {
            if (this.$refs.lessonEditor) {
                this.ensureTrailingParagraph();
                this.lessonContent =
                    this.$refs.lessonEditor.innerHTML;
            }
        },

        async uploadDocument(event) {
            const file = event.target.files[0];

            if (!file) {
                return;
            }

            this.uploading = true;

            try {
                const formData = new FormData();
                formData.append('document', file);

                const response = await fetch(
                    '/lesson-content/extract-document',
                    {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: formData,
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message ||
                        'Failed to extract document content.'
                    );
                }

                if (!data.content || !data.content.trim()) {
                    throw new Error(
                        'No readable text was found in this document.'
                    );
                }

                this.lessonContent = data.content;

                await this.$nextTick();

                if (this.$refs.lessonEditor) {
                    this.$refs.lessonEditor.innerText =
                        this.lessonContent;
                    this.ensureTrailingParagraph();
                }

                this.notify('Document content extracted successfully!');
            } catch (error) {
                console.error('Failed to upload document:', error);

                this.notify(
                    error.message ||
                    'Failed to extract document content.',
                    'error'
                );
            } finally {
                this.uploading = false;

                if (this.$refs.documentInput) {
                    this.$refs.documentInput.value = '';
                }
            }
        },

        async saveLesson() {
            this.updateLessonContent();

            this.saving = true;

            try {
                const isCreating =
                    this.isNewLesson || !this.lessonId;

                const url = isCreating
                    ? '/lesson-content'
                    : `/lesson-content/${this.lessonId}`;

                const response = await fetch(url, {
                    method: isCreating ? 'POST' : 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(
                        isCreating
                            ? {
                                topic_id: this.topicId,
                                content: this.lessonContent,
                            }
                            : {
                                content: this.lessonContent,
                            }
                    ),
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Failed to save topic content.'
                    );
                }

                if (data.lesson) {
                    this.lessonId = data.lesson.id;
                    this.lessonContent = data.lesson.content || '';
                    this.isNewLesson = false;

                    await this.$nextTick();

                    if (this.$refs.lessonEditor) {
                        this.$refs.lessonEditor.innerHTML =
                            this.lessonContent;
                        this.ensureTrailingParagraph();
                    }
                }

                this.notify(
                    isCreating
                        ? 'Topic content created successfully!'
                        : 'Topic content saved successfully!'
                );
            } catch (error) {
                console.error('Failed to save topic content:', error);

                this.notify(
                    error.message || 'Failed to save topic content.',
                    'error'
                );
            } finally {
                this.saving = false;
            }
        },

        async deleteLesson() {
            if (!this.lessonId) {
                return;
            }

            if (!confirm('Are you sure you want to delete this topic content?')) {
                return;
            }

            this.deleting = true;

            try {
                const response = await fetch(
                    `/lesson-content/${this.lessonId}`,
                    {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                        },
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Failed to delete topic content.'
                    );
                }

                this.lessonId = null;
                this.lessonContent = '';
                this.isNewLesson = false;
                this.savedRange = null;

                await this.$nextTick();

                if (this.$refs.lessonEditor) {
                    this.$refs.lessonEditor.innerHTML = '';
                }

                this.notify('Topic content deleted successfully!');
            } catch (error) {
                console.error('Failed to delete topic content:', error);

                this.notify(
                    error.message || 'Failed to delete topic content.',
                    'error'
                );
            } finally {
                this.deleting = false;
            }
        },
    },
};
</script>

<style>
.lesson-editor:empty::before {
    content: attr(data-placeholder);
    color: var(--text-muted);
    opacity: 0.7;
    pointer-events: none;
}

.lesson-editor {
    padding-bottom: 3rem;
}

.lesson-editor p,
.lesson-editor div {
    margin-bottom: 0.5rem;
}

.lesson-editor b,
.lesson-editor strong {
    color: var(--text-main);
    font-weight: 700;
}

.lesson-editor ul {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin: 0.5rem 0;
}

.lesson-editor ol {
    list-style-type: decimal;
    padding-left: 1.5rem;
    margin: 0.5rem 0;
}

.lesson-editor li {
    display: list-item;
    margin-bottom: 0.25rem;
}
</style>
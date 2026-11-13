<template>
    <div class="w-full min-w-0 shrink-0 md:shrink md:flex-1 md:min-h-[320px] flex flex-col gap-4">

        <!-- TOP BAR -->
        <div class="w-full shrink-0 flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex flex-col sm:flex-row sm:items-center gap-3 min-w-0">

                <!-- STATUS FILTER TABS -->
                <div class="flex items-center gap-1 p-1 rounded-xl border sharedBorder sharedSurfaceBG w-fit max-w-full overflow-x-auto">
                    <button
                        v-for="tab in statusTabs"
                        :key="tab"
                        type="button"
                        @click="activeTab = tab"
                        class="px-3 py-1.5 rounded-lg text-xs font-medium whitespace-nowrap transition-all duration-200 cursor-pointer"
                        :class="activeTab === tab
                            ? 'sharedBtn'
                            : 'sharedTXTMuted sharedRowHover sharedHoverTXT'"
                    >
                        {{ tab }}
                    </button>
                </div>

                <!-- SEARCH -->
                <div class="relative w-full sm:w-[280px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4 absolute left-3.5 top-1/2 -translate-y-1/2 z-10 sharedTXTMuted pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        v-model="searchQuery"
                        type="search"
                        placeholder="Search by ID or student..."
                        aria-label="Search student records"
                        class="w-full h-10 sm:h-[36px] pl-10 pr-3 rounded-xl text-base sm:text-sm
                            appearance-none [color-scheme:dark]
                            sharedInputDark border outline-none
                            focus:ring-1 transition-all duration-200"
                    >
                </div>
            </div>

            <div class="flex items-center justify-between sm:justify-end gap-3 shrink-0">
                <!-- COUNT -->
                <span class="text-xs font-medium sharedTXTMuted" aria-live="polite">
                    {{ filteredRecords.length }} {{ filteredRecords.length === 1 ? 'record' : 'records' }}
                </span>

                <!-- ADD BUTTON -->
                <button
                    type="button"
                    @click="showAddModal = true"
                    class="flex items-center justify-center gap-1.5 px-3 py-1.5 sm:px-4 sm:py-2 rounded-xl text-xs sm:text-sm font-medium sharedBtn cursor-pointer active:scale-95 transition-all duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 sm:size-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Add Student ID</span>
                </button>
            </div>
        </div>

        <!-- TABLE -->
        <div class="w-full min-w-0 rounded-2xl border sharedBorder sharedSurfaceBG shadow-lg sharedShadow overflow-hidden md:flex-1 md:min-h-0 md:flex md:flex-col">

            <!-- Column header (table layout from lg up) -->
            <div
                class="hidden lg:grid shrink-0 gap-3 px-4 py-2.5 border-b sharedBorder text-xs font-medium sharedTXTMuted"
                :class="gridCols"
            >
                <span>ID Number</span>
                <span>Registered Account</span>
                <span class="text-center">Status</span>
                <span class="text-right">Actions</span>
            </div>

            <ul class="overflow-y-auto md:flex-1 md:min-h-0 scrollbar-thin">
                <li
                    v-for="record in filteredRecords"
                    :key="record.id"
                    class="flex flex-col gap-3 px-4 py-3 border-b sharedBorder last:border-b-0 sharedRowHover transition-colors duration-200
                           lg:grid lg:items-center lg:gap-3"
                    :class="gridCols"
                >
                    <!-- ID Number & Mobile Badges -->
                    <div class="flex items-center justify-between lg:justify-start gap-2 min-w-0">
                        <span class="text-sm font-mono font-semibold sharedTXT tabular-nums truncate">
                            {{ record.id_number }}
                        </span>

                        <!-- Mobile Status Badge -->
                        <span
                            class="lg:hidden shrink-0 inline-flex px-2 py-0.5 rounded-full text-[11px] font-medium"
                            :class="record.is_disabled ? 'sharedStateDanger sharedStateChip ring-1' : 'sharedStateOpen sharedStateChip ring-1'"
                        >
                            {{ record.is_disabled ? 'Disabled' : 'Active' }}
                        </span>
                    </div>

                    <!-- Registered Account info -->
                    <div class="flex items-center gap-2 min-w-0 text-xs">
                        <template v-if="record.user">
                            <span class="font-medium sharedTXT truncate" :title="record.user.name">
                                {{ record.user.name }}
                            </span>
                            <span class="sharedTXTMuted font-mono truncate hidden sm:inline" :title="record.user.email">
                                ({{ record.user.email }})
                            </span>
                        </template>
                        <template v-else>
                            <span class="sharedTXTMuted italic text-[11px]">
                                Not yet registered
                            </span>
                        </template>
                    </div>

                    <!-- Desktop Status Badge -->
                    <div class="hidden lg:flex justify-center">
                        <span
                            class="inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-medium"
                            :class="record.is_disabled ? 'sharedStateDanger sharedStateChip ring-1' : 'sharedStateOpen sharedStateChip ring-1'"
                        >
                            {{ record.is_disabled ? 'Disabled' : 'Active' }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 lg:gap-1.5 lg:justify-end">

                        <!-- DISABLE / ENABLE BUTTON -->
                        <button
                            type="button"
                            @click="promptToggleDisable(record)"
                            :aria-label="`${record.is_disabled ? 'Enable' : 'Disable'} ${record.id_number}`"
                            :title="record.is_disabled ? 'Enable ID' : 'Disable ID'"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-9 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium ring-1
                                active:scale-95 transition-all duration-200 cursor-pointer"
                            :class="record.is_disabled
                                ? 'sharedStateOpen sharedStateChip sharedStateChipLink'
                                : 'sharedStateWarning sharedTile sharedRingSoft sharedHoverState'"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 shrink-0">
                                <!-- Enable: lock-open -->
                                <path
                                    v-if="record.is_disabled"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                />
                                <!-- Disable: lock-closed / ban -->
                                <path
                                    v-else
                                    stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                />
                            </svg>
                            <span>{{ record.is_disabled ? 'Enable' : 'Disable' }}</span>
                        </button>

                        <!-- REMOVE BUTTON -->
                        <button
                            type="button"
                            @click="confirmDelete(record)"
                            :aria-label="`Remove ${record.id_number}`"
                            title="Remove ID"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-1.5 px-2.5 min-h-9 lg:min-h-0 lg:py-1.5 rounded-xl text-xs font-medium ring-1
                                sharedStateDanger sharedStateChip sharedDangerSolidHover
                                active:scale-95 transition-all duration-200 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            <span>Remove</span>
                        </button>
                    </div>
                </li>

                <li v-if="filteredRecords.length === 0" class="px-4 py-10 text-center text-sm sharedTXTMuted">
                    {{ searchQuery ? 'No records match your search.' : 'No student IDs found for this filter.' }}
                </li>
            </ul>
        </div>

        <!-- ADD MODAL -->
        <Teleport to="body">
            <Transition name="modal-fade">
                <div
                    v-if="showAddModal"
                    class="fixed inset-0 w-screen h-screen sharedOverlay backdrop-blur-sm z-[99] flex items-center justify-center p-4"
                    @click.self="closeAdd"
                >
                    <form
                        @submit.prevent="submitAdd"
                        class="modal-card relative w-full max-w-[480px] sharedLightBG rounded-2xl shadow-2xl sharedShadow ring-1 sharedNavRing flex flex-col p-6 gap-4"
                    >
                        <button type="button" @click="closeAdd" aria-label="Close"
                            class="absolute right-4 top-4 p-1.5 rounded-md sharedTXTLightFaint sharedLightIconBtn transition-colors cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="flex items-start gap-3 pr-6">
                            <div class="shrink-0 w-10 h-10 rounded-lg sharedStateLightAccent sharedStateTint flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedStateText">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-lg font-semibold sharedTXTOnLight leading-tight">Add Student IDs</span>
                                <span class="text-xs sm:text-sm sharedTXTLightMuted">Enter one or multiple student IDs to allow registration.</span>
                            </div>
                        </div>

                        <p v-if="addError" class="sharedTXTDanger text-sm text-center m-0">{{ addError }}</p>

                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center justify-between">
                                <label for="add-id-number" class="text-sm font-medium sharedTXTOnLight">Student ID Numbers</label>
                                <span
                                    v-if="detectedIds.length > 0"
                                    class="text-xs px-2 py-0.5 rounded-full font-medium"
                                    :class="detectedIds.length > 1 ? 'sharedStateOpen sharedStateChip' : 'sharedTXTMuted'"
                                >
                                    {{ detectedIds.length }} {{ detectedIds.length === 1 ? 'ID detected' : 'IDs detected' }}
                                </span>
                            </div>

                            <textarea
                                id="add-id-number"
                                v-model="newIdNumber"
                                rows="5"
                                placeholder="e.g.&#10;2023-00001&#10;2023-00002&#10;2023-00003&#10;&#10;(Or separate IDs by commas)"
                                class="w-full px-3 py-2.5 text-sm font-mono outline-none border sharedInput sharedInputHover rounded-xl transition-all duration-150 focus:ring-4 resize-y"
                            ></textarea>

                            <span class="text-[11px] sm:text-xs sharedTXTLightFaint">
                                Enter one ID per line or separate them with commas. You can also paste directly from Excel or Google Sheets.
                            </span>
                        </div>

                        <div class="flex gap-3 mt-1">
                            <button type="button" @click="closeAdd"
                                class="w-1/3 py-2.5 rounded-lg text-sm font-medium sharedBtnGhostLight border transition-colors cursor-pointer">
                                Cancel
                            </button>
                            <button type="submit"
                                :disabled="isAdding || detectedIds.length === 0"
                                class="w-2/3 py-2.5 rounded-lg text-sm font-medium sharedBtn shadow-sm transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-1.5">
                                <svg v-if="isAdding" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                                </svg>
                                {{ isAdding ? 'Adding...' : (detectedIds.length > 1 ? `Add ${detectedIds.length} Student IDs` : 'Add Student ID') }}
                            </button>
                        </div>
                    </form>
                </div>
            </Transition>
        </Teleport>

        <!-- DISABLE / ENABLE CONFIRMATION MODAL -->
        <Teleport to="body">
            <Transition name="modal-fade">
                <div
                    v-if="showDisableModal"
                    class="fixed inset-0 w-screen h-screen sharedOverlay backdrop-blur-sm z-[99] flex items-center justify-center p-4"
                    @click.self="closeDisable"
                >
                    <div class="modal-card relative w-full max-w-[420px] sharedLightBG rounded-2xl shadow-2xl sharedShadow ring-1 sharedNavRing flex flex-col p-6 gap-5">

                        <button type="button" @click="closeDisable" aria-label="Close"
                            class="absolute right-4 top-4 p-1.5 rounded-md sharedTXTLightFaint sharedLightIconBtn transition-colors cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="flex items-start gap-3 pr-6">
                            <div
                                class="shrink-0 w-10 h-10 rounded-lg flex items-center justify-center"
                                :class="recordToToggle?.is_disabled ? 'sharedStateLightAccent sharedStateTint' : 'sharedStateLightDanger'"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="size-5"
                                    :class="recordToToggle?.is_disabled ? 'sharedStateText' : 'sharedTXTDanger'">
                                    <path
                                        v-if="recordToToggle?.is_disabled"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                    />
                                    <path
                                        v-else
                                        stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                    />
                                </svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-lg font-semibold sharedTXTOnLight leading-tight">
                                    {{ recordToToggle?.is_disabled ? 'Enable Student ID' : 'Disable Student ID' }}
                                </span>
                                <p class="text-sm sharedTXTLightMuted m-0">
                                    <template v-if="recordToToggle?.is_disabled">
                                        Re-enabling <span class="font-mono font-semibold sharedTXTOnLight">{{ recordToToggle?.id_number }}</span> will restore access for the student.
                                    </template>
                                    <template v-else>
                                        Disabling <span class="font-mono font-semibold sharedTXTOnLight">{{ recordToToggle?.id_number }}</span> will prevent this ID from being used to register or log in.
                                        <span v-if="recordToToggle?.user" class="block mt-1 text-amber-600 font-medium">
                                            The student account "{{ recordToToggle.user.name }}" will be disabled.
                                        </span>
                                    </template>
                                </p>
                            </div>
                        </div>

                        <p v-if="disableError" class="sharedTXTDanger text-sm text-center m-0">{{ disableError }}</p>

                        <div class="flex gap-3">
                            <button type="button" @click="closeDisable"
                                class="w-1/3 py-2.5 rounded-lg text-sm font-medium sharedBtnGhostLight border transition-colors cursor-pointer">
                                Cancel
                            </button>
                            <button
                                type="button"
                                @click="submitToggleDisable"
                                :disabled="isToggling"
                                class="w-2/3 py-2.5 rounded-lg text-sm font-medium shadow-sm transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-1.5"
                                :class="recordToToggle?.is_disabled ? 'sharedBtn' : 'sharedStateDanger sharedStateChip ring-1 sharedDangerSolidHover'"
                            >
                                <svg v-if="isToggling" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                                </svg>
                                <span>{{ isToggling ? 'Processing...' : (recordToToggle?.is_disabled ? 'Enable ID' : 'Disable ID') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </Transition>
        </Teleport>

        <!-- DELETE CONFIRM MODAL -->
        <Teleport to="body">
            <Transition name="modal-fade">
                <div
                    v-if="showDeleteModal"
                    class="fixed inset-0 w-screen h-screen sharedOverlay backdrop-blur-sm z-[99] flex items-center justify-center p-4"
                    @click.self="closeDelete"
                >
                    <div class="modal-card relative w-full max-w-[420px] sharedLightBG rounded-2xl shadow-2xl sharedShadow ring-1 sharedNavRing flex flex-col p-6 gap-5">

                        <button type="button" @click="closeDelete" aria-label="Close"
                            class="absolute right-4 top-4 p-1.5 rounded-md sharedTXTLightFaint sharedLightIconBtn transition-colors cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="flex items-start gap-3 pr-6">
                            <div class="shrink-0 w-10 h-10 rounded-lg sharedStateLightDanger flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedTXTDanger">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-lg font-semibold sharedTXTOnLight leading-tight">Remove Student ID</span>
                                <p class="text-sm sharedTXTLightMuted m-0">
                                    Remove <span class="font-mono font-semibold sharedTXTOnLight">{{ recordToDelete?.id_number }}</span>?
                                </p>
                                <p class="text-xs text-red-600 font-semibold mt-1 m-0">
                                    Warning: Any student registered with this ID will be permanently disabled and unable to log in again.
                                </p>
                            </div>
                        </div>

                        <p v-if="deleteError" class="sharedTXTDanger text-sm text-center m-0">{{ deleteError }}</p>

                        <div class="flex gap-3">
                            <button type="button" @click="closeDelete"
                                class="w-1/3 py-2.5 rounded-lg text-sm font-medium sharedBtnGhostLight border transition-colors cursor-pointer">
                                Cancel
                            </button>
                            <button type="button" @click="submitDelete"
                                :disabled="isDeleting"
                                class="w-2/3 py-2.5 rounded-lg text-sm font-medium sharedBtn shadow-sm transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-1.5"
                                style="background: rgb(220 38 38); color: white;">
                                <svg v-if="isDeleting" class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4Z"/>
                                </svg>
                                {{ isDeleting ? 'Removing...' : 'Remove & Block' }}
                            </button>
                        </div>
                    </div>
                </div>
            </Transition>
        </Teleport>

        <!-- TOAST NOTIFICATION -->
        <Toast
            :show="showToast"
            :message="toastMessage"
            :is-error="toastIsError"
            @close="showToast = false"
        />

    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Toast from '../components/Toast.vue';

const props = defineProps({
    records: {
        type: Array,
        default: () => []
    }
});

const gridCols =
    'lg:grid-cols-[160px_minmax(0,1.2fr)_110px_200px] ' +
    'xl:grid-cols-[180px_minmax(0,1.2fr)_120px_220px]';

const statusTabs = ['All', 'Active', 'Disabled'];
const activeTab = ref('All');
const searchQuery = ref('');
const recordsList = ref([...props.records]);

// --- TOAST ---
const showToast    = ref(false);
const toastMessage = ref('');
const toastIsError = ref(false);

function triggerToast(msg, isError = false) {
    toastMessage.value = msg;
    toastIsError.value = isError;
    showToast.value    = true;
}

// --- ADD (Single or Multiple) ---
const showAddModal = ref(false);
const newIdNumber  = ref('');
const addError     = ref('');
const isAdding     = ref(false);

const detectedIds = computed(() => {
    const raw = newIdNumber.value;
    if (!raw) return [];
    return raw
        .split(/[\r\n,;]+/)
        .map(s => s.trim())
        .filter(Boolean);
});

function closeAdd() {
    showAddModal.value = false;
    newIdNumber.value  = '';
    addError.value     = '';
}

async function submitAdd() {
    if (isAdding.value || detectedIds.value.length === 0) return;

    addError.value = '';
    isAdding.value = true;

    try {
        const response = await fetch('/student-records', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ id_numbers: detectedIds.value }),
        });

        const data = await response.json();

        if (response.ok && data.success) {
            if (Array.isArray(data.records) && data.records.length > 0) {
                recordsList.value.unshift(...data.records);
            } else if (data.record) {
                recordsList.value.unshift(data.record);
            }
            triggerToast(data.message || 'Student IDs added successfully.');
            closeAdd();
        } else if (data.errors) {
            addError.value = Object.values(data.errors).flat().join(' ');
        } else {
            addError.value = data.message || 'Failed to add records. Please try again.';
        }
    } catch {
        addError.value = 'Something went wrong. Please try again.';
    } finally {
        isAdding.value = false;
    }
}

// --- TOGGLE DISABLE / ENABLE ---
const showDisableModal = ref(false);
const recordToToggle   = ref(null);
const disableError     = ref('');
const isToggling       = ref(false);

function promptToggleDisable(record) {
    recordToToggle.value = record;
    disableError.value   = '';
    showDisableModal.value = true;
}

function closeDisable() {
    showDisableModal.value = false;
    recordToToggle.value   = null;
    disableError.value     = '';
}

async function submitToggleDisable() {
    if (isToggling.value || !recordToToggle.value) return;

    disableError.value = '';
    isToggling.value   = true;

    try {
        const response = await fetch('/student-records/toggle-disable', {
            method: 'PATCH',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ id: recordToToggle.value.id }),
        });

        const data = await response.json();

        if (response.ok && data.success) {
            const index = recordsList.value.findIndex(r => r.id === recordToToggle.value.id);
            if (index !== -1) {
                recordsList.value[index].is_disabled = data.is_disabled;
                if (recordsList.value[index].user) {
                    recordsList.value[index].user.disabled = data.is_disabled;
                }
            }
            triggerToast(data.message);
            closeDisable();
        } else {
            disableError.value = data.message || 'Failed to update record status.';
        }
    } catch {
        disableError.value = 'Something went wrong. Please try again.';
    } finally {
        isToggling.value = false;
    }
}

// --- DELETE ---
const showDeleteModal = ref(false);
const recordToDelete  = ref(null);
const deleteError     = ref('');
const isDeleting      = ref(false);

function confirmDelete(record) {
    recordToDelete.value = record;
    showDeleteModal.value = true;
    deleteError.value = '';
}

function closeDelete() {
    showDeleteModal.value = false;
    recordToDelete.value  = null;
    deleteError.value     = '';
}

async function submitDelete() {
    if (isDeleting.value || !recordToDelete.value) return;

    deleteError.value = '';
    isDeleting.value  = true;

    try {
        const response = await fetch('/student-records', {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ id: recordToDelete.value.id }),
        });

        const data = await response.json();

        if (response.ok && data.success) {
            recordsList.value = recordsList.value.filter(r => r.id !== recordToDelete.value.id);
            triggerToast(data.message);
            closeDelete();
        } else {
            deleteError.value = data.message || 'Failed to remove record. Please try again.';
        }
    } catch {
        deleteError.value = 'Something went wrong. Please try again.';
    } finally {
        isDeleting.value = false;
    }
}

// --- FILTER ---
const filteredRecords = computed(() => {
    const q = searchQuery.value.trim().toLowerCase();

    return recordsList.value.filter(record => {
        // Tab filter
        const matchesTab =
            activeTab.value === 'All' ||
            (activeTab.value === 'Active' && !record.is_disabled) ||
            (activeTab.value === 'Disabled' && Boolean(record.is_disabled));

        if (!matchesTab) return false;

        // Search query
        if (!q) return true;

        const idNum = String(record.id_number ?? '').toLowerCase();
        const userName = String(record.user?.name ?? '').toLowerCase();
        const userEmail = String(record.user?.email ?? '').toLowerCase();

        return idNum.includes(q) || userName.includes(q) || userEmail.includes(q);
    });
});
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active { transition: opacity 0.15s ease; }
.modal-fade-enter-from,
.modal-fade-leave-to { opacity: 0; }

.modal-card { animation: modal-pop-in 0.15s ease; }

@keyframes modal-pop-in {
    from { opacity: 0; transform: scale(0.96) translateY(4px); }
    to   { opacity: 1; transform: scale(1)    translateY(0);   }
}
</style>

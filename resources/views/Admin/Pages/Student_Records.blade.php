<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Records | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="h-dvh w-screen overflow-hidden">

    <div id="app" class="h-full">

        {{-- COMPUTER --}}
        <left-navigation
            active-page="Student Records"
            :id-number="{{auth()->user()->id_number}}"
            user-name="{{auth()->user()->name}}"
            user-email="{{auth()->user()->email}}"
            profile-color="{{auth()->user()->profile_color}}"
            logo="{{ asset('images/Components/Logo.png') }}"
        ></left-navigation>

        {{-- MOBILE --}}
        <bottom-navigation
            active-page="Student Records"
        ></bottom-navigation>

        <main class="h-full min-w-0 md:w-[calc(100%-280px)] w-full flex flex-col md:ml-[280px] ml-0 p-3 sm:p-5 overflow-y-auto max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">

            {{-- HEADER --}}
            <admin-header
                class="mb-3 sm:mb-5"
                user-name="{{auth()->user()->name}}"
                user-email="{{auth()->user()->email}}"
                profile-color="{{auth()->user()->profile_color}}"
            ></admin-header>

            {{-- STAT CARDS (Responsive 3-column grid) --}}
            <div class="grid grid-cols-3 gap-2 sm:gap-4 lg:gap-6 pb-3 sm:pb-5 shrink-0">

                {{-- TOTAL RECORDS --}}
                <div class="group min-w-0 sharedTXT flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-start sm:gap-4 p-3 sm:p-4 lg:p-5 rounded-2xl sharedSurface shadow-lg sharedShadow transition-all duration-200">
                    <div class="hidden sm:flex items-center justify-center shrink-0 w-11 h-11 rounded-xl sharedTile">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedTXTAccent">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-center min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight tabular-nums">{{ $totalRecords }}</span>
                        <span class="text-[10px] sm:text-xs font-medium sharedTXTMuted leading-tight break-words">Total IDs</span>
                    </div>
                </div>

                {{-- ACTIVE RECORDS --}}
                <div class="group min-w-0 sharedTXT flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-start sm:gap-4 p-3 sm:p-4 lg:p-5 rounded-2xl sharedSurface shadow-lg sharedShadow transition-all duration-200">
                    <div class="hidden sm:flex items-center justify-center shrink-0 w-11 h-11 rounded-xl sharedTile">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedStateText">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-center min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight tabular-nums">{{ $totalActive }}</span>
                        <span class="text-[10px] sm:text-xs font-medium sharedTXTMuted leading-tight break-words">Active IDs</span>
                    </div>
                </div>

                {{-- DISABLED RECORDS --}}
                <div class="group min-w-0 sharedTXT flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-start sm:gap-4 p-3 sm:p-4 lg:p-5 rounded-2xl sharedSurface shadow-lg sharedShadow transition-all duration-200">
                    <div class="hidden sm:flex items-center justify-center shrink-0 w-11 h-11 rounded-xl sharedTile">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 sharedTXTDanger">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-center min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight tabular-nums">{{ $totalDisabled }}</span>
                        <span class="text-[10px] sm:text-xs font-medium sharedTXTMuted leading-tight break-words">Disabled IDs</span>
                    </div>
                </div>

            </div>

            <student-records-page
                :records='@json($records)'
            ></student-records-page>

            <div class="h-[calc(4rem+env(safe-area-inset-bottom))] shrink-0 md:hidden"></div>
        </main>

    </div>

    @vite(['resources/js/app.js'])

</body>
</html>

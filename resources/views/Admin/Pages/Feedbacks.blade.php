<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Feedbacks | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="h-dvh w-full overflow-hidden">

    <div id="app" class="h-full">

        {{-- DELETE FEEDBACK MODAL --}}
        @include('Admin.Components.Modal.Delete_Feedback')

        <left-navigation
            active-page="Feedbacks"
            :id-number="{{ auth()->user()->id_number }}"
            user-name="{{ auth()->user()->name }}"
            user-email="{{ auth()->user()->email }}"
            logo="{{ asset('images/Components/Logo.png') }}"
            profile-color="{{auth()->user()->profile_color}}"
        ></left-navigation>

        {{-- MOBILE --}}
        <bottom-navigation
        active-page="Feedbacks"
        ></bottom-navigation>

        <main class="h-full w-full md:w-[calc(100%-280px)] flex flex-col md:ml-[280px] ml-0 p-3 pt-0 sm:p-5 sm:pt-0 overflow-y-auto md:overflow-hidden max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">

            <admin-header
                user-name="{{ auth()->user()->name }}"
                user-email="{{ auth()->user()->email }}"
                profile-color="{{auth()->user()->profile_color}}"
            ></admin-header>

            <div class="shrink-0 grid grid-cols-3 gap-2 sm:gap-4 lg:gap-6 pt-3 sm:pt-5 pb-3 sm:pb-5">

                {{-- TOTAL FEEDBACKS --}}
                <div class="group relative p-3 sm:p-4 lg:p-5 min-w-0 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-between sm:gap-3 transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-[#8B5CF6]/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight">1000</span>
                        <span class="text-gray-400 text-[10px] sm:text-xs font-semibold tracking-wide leading-tight">TOTAL FEEDBACKS</span>
                    </div>
                    <div class="hidden sm:flex w-9 h-9 shrink-0 bg-[#8B5CF6]/15 border border-[#CECBF6]/15 text-[#CECBF6] items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                    </div>
                </div>

                {{-- NEW --}}
                <div class="group relative p-3 sm:p-4 lg:p-5 min-w-0 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-between sm:gap-3 transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-[#E04A4A]/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight">4</span>
                        <span class="text-gray-400 text-[10px] sm:text-xs font-semibold tracking-wide leading-tight">NEW</span>
                    </div>
                    <div class="hidden sm:flex w-9 h-9 shrink-0 bg-[#E04A4A]/15 border border-[#CECBF6]/15 text-[#F09595] items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                    </div>
                </div>

                {{-- DONE --}}
                <div class="group relative p-3 sm:p-4 lg:p-5 min-w-0 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-between sm:gap-3 transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-emerald-400/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight">996</span>
                        <span class="text-gray-400 text-[10px] sm:text-xs font-semibold tracking-wide leading-tight">DONE</span>
                    </div>
                    <div class="hidden sm:flex w-9 h-9 shrink-0 bg-emerald-400/15 border border-[#CECBF6]/15 text-emerald-300 items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </div>
                </div>

            </div>

            <div class="shrink-0 md:shrink md:flex-1 md:min-h-0">
                <feedbacks-page
                    :feedbacks='@json($feedbacks)'
                ></feedbacks-page>
            </div>

            <div class="h-16 shrink-0 md:hidden"></div>
        </main>

    </div>

    @vite(['resources/js/app.js'])

</body>
</html>
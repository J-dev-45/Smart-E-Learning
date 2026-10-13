<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Feedbacks | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="h-screen w-screen bg-gray-50 overflow-hidden">

    <div id="app" class="h-full">

        {{-- DELETE FEEDBACK MODAL --}}
        @include('Admin.Components.Modal.Delete_Feedback')

        <left-navigation 
            active-page="Feedbacks"
            :id-number="{{auth()->user()->id_number}}"
            user-name="{{auth()->user()->name}}"
            user-email="{{auth()->user()->email}}"
        ></left-navigation>

        <main class="h-full main-bg w-[calc(100%-280px)] h-full flex flex-col ml-[280px] p-5 overflow-hidden">
            {{-- CARDS --}}
            <div class="shrink-0 grid grid-cols-3 gap-6 pb-5">

                {{-- TOTAL USERS --}}
                <div class="group relative p-5 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex items-center justify-between transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-[#8B5CF6]/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative">
                        <span class="text-2xl font-bold">1000</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wide">TOTAL FEEDBACKS</span>
                    </div>
                    <div class="w-9 h-9 shrink-0 bg-[#8B5CF6]/15 border border-[#CECBF6]/15 text-[#CECBF6] flex items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                    </div>
                </div>

                {{-- TOTAL ADMINS --}}
                <div class="group relative p-5 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex items-center justify-between transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-[#E04A4A]/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative">
                        <span class="text-2xl font-bold">4</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wide">NEW</span>
                    </div>
                    <div class="w-9 h-9 shrink-0 bg-[#E04A4A]/15 border border-[#CECBF6]/15 text-[#F09595] flex items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                    </div>
                </div>

                {{-- TOTAL STUDENTS --}}
                <div class="group relative p-5 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex items-center justify-between transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-emerald-400/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative">
                        <span class="text-2xl font-bold">996</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wide">DONE</span>
                    </div>
                    <div class="w-9 h-9 shrink-0 bg-emerald-400/15 border border-[#CECBF6]/15 text-emerald-300 flex items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </div>
                </div>

            </div>

            {{-- FEEDBACKS PAGE now stretches to fill remaining vertical space --}}
            <div class="flex-1 min-h-0">
                <feedbacks-page></feedbacks-page>
            </div>
        </main>

    </div>

    @vite(['resources/js/app.js'])
    
</body>
</html>
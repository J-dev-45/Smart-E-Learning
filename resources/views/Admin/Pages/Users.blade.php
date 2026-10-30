<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Users | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>
<body class="h-dvh w-screen overflow-hidden">

    <div id="app" class="h-full">

        {{-- COMPUTER --}}
        <left-navigation 
            active-page="Users"
            :id-number="{{auth()->user()->id_number}}"
            user-name="{{auth()->user()->name}}"
            user-email="{{auth()->user()->email}}"
            
            logo="{{ asset('images/Components/Logo.png') }}"
        ></left-navigation>

        {{-- MOBILE --}}
        <bottom-navigation
            active-page="Users"
        ></bottom-navigation>

        
        <main class="h-full min-w-0 md:w-[calc(100%-280px)] w-full flex flex-col md:ml-[280px] ml-0 p-3 sm:p-5 overflow-y-auto max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">

            {{-- HEADER --}}
            <admin-header
                class="mb-3 sm:mb-5"
                user-name="{{auth()->user()->name}}"
                user-email="{{auth()->user()->email}}"
                profile-color="{{auth()->user()->profile_color}}"
            ></admin-header>

            <div class="grid grid-cols-3 gap-2 sm:gap-4 lg:gap-6 pb-3 sm:pb-5 shrink-0">

                {{-- TOTAL USERS --}}
                <div class="group relative p-3 sm:p-4 lg:p-5 min-w-0 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-between sm:gap-3 transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-[#8B5CF6]/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight">{{$users->count()}}</span>
                        <span class="text-gray-400 text-[10px] sm:text-xs font-semibold tracking-wide leading-tight break-words">TOTAL USERS</span>
                    </div>
                    <div class="hidden sm:flex w-9 h-9 shrink-0 bg-[#8B5CF6]/15 border border-[#CECBF6]/15 text-[#CECBF6] items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                </div>

                {{-- TOTAL ADMINS --}}
                <div class="group relative p-3 sm:p-4 lg:p-5 min-w-0 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-between sm:gap-3 transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-[#E04A4A]/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight">{{$users->where('role', 'Admin')->count()}}</span>
                        <span class="text-gray-400 text-[10px] sm:text-xs font-semibold tracking-wide leading-tight break-words">TOTAL ADMINS</span>
                    </div>
                    <div class="hidden sm:flex w-9 h-9 shrink-0 bg-[#E04A4A]/15 border border-[#CECBF6]/15 text-[#F09595] items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                </div>

                {{-- TOTAL STUDENTS --}}
                <div class="group relative p-3 sm:p-4 lg:p-5 min-w-0 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 overflow-hidden flex flex-col items-start justify-center gap-1 sm:flex-row sm:items-center sm:justify-between sm:gap-3 transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-emerald-400/10 blur-2xl"></div>

                    <div class="flex flex-col justify-center text-white relative min-w-0">
                        <span class="text-xl sm:text-2xl font-bold leading-tight">{{$users->where('role', 'Student')->count()}}</span>
                        <span class="text-gray-400 text-[10px] sm:text-xs font-semibold tracking-wide leading-tight break-words">TOTAL STUDENTS</span>
                    </div>
                    <div class="hidden sm:flex w-9 h-9 shrink-0 bg-emerald-400/15 border border-[#CECBF6]/15 text-emerald-300 items-center justify-center rounded-md relative transition-transform duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                </div>

            </div>

            <users-page
                :users='@json($users)'
            ></users-page>

            <div class="h-[calc(4rem+env(safe-area-inset-bottom))] shrink-0 md:hidden"></div>
        </main>

    </div>

    @vite([ 'resources/js/app.js'])
    
</body>
</html>
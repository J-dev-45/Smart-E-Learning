<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up | Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
       
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        input[type="password"]::-webkit-credentials-auto-fill-button,
        input[type="password"]::-webkit-textfield-decoration-container {
            display: none !important;
        }

        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(76, 29, 149, 0.35) transparent;
        }
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(76, 29, 149, 0.3);
            border-radius: 999px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background-color: rgba(76, 29, 149, 0.5);
        }
    </style>

</head>
<body class="w-screen h-screen overflow-hidden font-sans">
    @vite(['resources/js/Auth.js', 'resources/js/app.js'])

    @include('Global.Loading_Screen', ['logo' => asset('images/Components/Logo.png') ])
    {{-- ══════════════════════════════════════ --}}
    {{-- MOBILE / TABLET (hidden on md+)       --}}
    {{-- ══════════════════════════════════════ --}}
    <div id="app" class="w-screen h-screen">
        <div class="flex md:hidden w-full h-full items-center justify-center p-5">

            <div class="w-full max-w-[400px] flex flex-col rounded-3xl overflow-hidden shadow-2xl
                        border-[1.5px] border-white/40"
                style="max-height: calc(100dvh - 2.5rem)">

                {{-- Header (glass, matches homepage cards) --}}
                <div class="bg-[#CECBF6]/6 backdrop-blur-sm flex flex-col items-center justify-center text-white
                            py-[clamp(1rem,3.5dvh,2rem)] px-6 shrink-0 gap-1
                            border-b-[1.5px] border-b-[#CECBF6]/15">
                    <img src="{{ asset('images/Components/Logo.png') }}" alt="Logo"
                        class="object-contain mb-1 drop-shadow-lg"
                        style="width:clamp(52px,8dvh,80px); height:clamp(52px,8dvh,80px)">
                    <h1 class="font-bold leading-tight m-0 tracking-wide"
                        style="font-size:clamp(1.2rem,3.5dvh,1.9rem)">Smart E-Learning</h1>

                    <div class="w-20 h-[3px] bg-[#CECBF6] rounded-full my-1"></div>
                    <p class="font-semibold m-0 text-[#CECBF6]/65 tracking-wide"
                    style="font-size:clamp(0.65rem,1.6dvh,0.8rem)">Review Smarter, Quiz Better.</p>
                </div>

                {{-- White form body --}}
                <div class="custom-scroll bg-white flex-1 overflow-y-auto flex flex-col justify-center rounded-b-3xl
                            pl-[clamp(1.25rem,5vw,2rem)] pr-[calc(clamp(1.25rem,5vw,2rem)-4px)]
                            py-[clamp(1rem,2.5dvh,1.5rem)]">

                    <h4 class="font-bold m-0 text-[#090014] tracking-wide"
                        style="font-size:clamp(1rem,2.5dvh,1.3rem)">CREATE ACCOUNT</h4>
                    <p class="text-gray-500 mt-1 mb-[clamp(0.8rem,2.5dvh,1.4rem)]"
                    style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                        Create your account now to review and ace your entrance exam.
                    </p>

                    @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $error)
                                <p class="text-red-500 text-md w-full flex items-center justify-center py-2">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="/register" method="POST" class="flex flex-col gap-[clamp(0.6rem,1.8dvh,1rem)]">
                        @csrf
                        {{-- Full Name --}}
                        <div class="flex flex-col gap-1">
                            <label class="ps-1 font-semibold text-gray-700"
                                style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">First Name and Last Name</label>
                            <input type="text" placeholder="First Name and Last Name" name="name"
                                class="border-[1.5px] border-gray-200 rounded-full ps-5 outline-none bg-gray-50
                                        w-full text-[#090014] placeholder:text-gray-400 focus:border-[#4C1D95]/50 focus:bg-white
                                        transition-all duration-200"
                                style="height:clamp(40px,6dvh,52px); font-size:clamp(0.7rem,1.7dvh,0.85rem)">
                        </div>

                        {{-- Email --}}
                        <div class="flex flex-col gap-1">
                            <label class="ps-1 font-semibold text-gray-700"
                                style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">Email</label>
                            <input type="email" placeholder="example@gmail.com" name="email"
                                class="border-[1.5px] border-gray-200 rounded-full ps-5 outline-none bg-gray-50
                                        w-full text-[#090014] placeholder:text-gray-400 focus:border-[#4C1D95]/50 focus:bg-white
                                        transition-all duration-200"
                                style="height:clamp(40px,6dvh,52px); font-size:clamp(0.7rem,1.7dvh,0.85rem)">
                        </div>

                        {{-- Password --}}
                        <div class="flex flex-col gap-1 relative">
                            <label class="ps-1 font-semibold text-gray-700"
                                style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">Password</label>
                            <input type="password" placeholder="••••••••" name="password" id="passwordInput_mobile"
                                class="border-[1.5px] border-gray-200 rounded-full ps-5 outline-none bg-gray-50
                                        w-full text-[#090014] placeholder:text-gray-400 focus:border-[#4C1D95]/50 focus:bg-white
                                        transition-all duration-200"
                                style="height:clamp(40px,6dvh,52px); font-size:clamp(0.85rem,1.8dvh,1rem)">
                            {{-- OPEN EYE --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="flex z-[100] size-6 absolute right-4 bottom-2 cursor-pointer text-gray-400 flex"
                                id="openedEye_mobile">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                            {{-- CLOSE EYE --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="hidden z-[100] size-6 absolute right-4 bottom-2 cursor-pointer text-gray-400"
                                id="closedEye_mobile">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="flex flex-col gap-1 relative">
                            <label class="ps-1 font-semibold text-gray-700"
                                style="font-size:clamp(0.7rem,1.7dvh,0.85rem)">Confirm Password</label>
                            <input type="password" placeholder="••••••••" name="password_confirmation" id="confirm_passwordInput_mobile"
                                class="border-[1.5px] border-gray-200 rounded-full ps-5 outline-none bg-gray-50
                                        w-full text-[#090014] placeholder:text-gray-400 focus:border-[#4C1D95]/50 focus:bg-white
                                        transition-all duration-200"
                                style="height:clamp(40px,6dvh,52px); font-size:clamp(0.85rem,1.8dvh,1rem)">
                            {{-- OPEN EYE --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="flex z-[100] size-6 absolute right-4 bottom-2 cursor-pointer text-gray-400 flex"
                                id="confirm_openedEye_mobile">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                            {{-- CLOSE EYE --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="hidden z-[100] size-6 absolute right-4 bottom-2 cursor-pointer text-gray-400"
                                id="confirm_closedEye_mobile">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="w-full bg-[#4C1D95] hover:bg-[#4C1D95]/85 text-white font-bold
                                    rounded-full cursor-pointer shadow-md hover:shadow-lg
                                    transition-all duration-200 tracking-wide
                                    mt-[clamp(0.2rem,1dvh,0.6rem)]"
                                style="height:clamp(42px,6.5dvh,54px); font-size:clamp(0.85rem,2dvh,1rem)">
                            Create Account
                        </button>

                        {{-- Log in --}}
                        <div class="flex justify-center items-center gap-1.5
                                    pt-[clamp(0.1rem,0.8dvh,0.4rem)] pb-1"
                            style="font-size:clamp(0.65rem,1.5dvh,0.78rem)">
                            <span class="text-gray-500">Already have an account?</span>
                            <a href="{{ route('login') }}" class="text-[#4C1D95] font-semibold hover:underline">Log in</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        {{-- ══════════════════════════════════════ --}}
        {{-- DESKTOP (hidden below md)             --}}
        {{-- ══════════════════════════════════════ --}}
        <div class="hidden md:flex w-full h-full">

            {{-- Left panel --}}
            <div class="w-1/2 h-full flex flex-col items-center justify-center text-white px-8 gap-3">
                <img src="{{ asset('images/Components/Logo.png') }}" alt="Logo"
                    class="object-contain drop-shadow-2xl"
                    style="width:clamp(100px,13vw,190px); height:clamp(90px,11vw,170px)">

                <div class="text-center">
                    <h1 class="font-bold m-0 leading-none tracking-wide"
                        style="font-size:clamp(1.5rem,4vw,3rem)">Smart E-Learning</h1>
                </div>

                <div class="bg-[#CECBF6] rounded-full"
                    style="width:clamp(60px,7vw,110px); height:4px"></div>

                <div class="text-center">
                    <h5 class="font-semibold m-0 leading-none text-[#CECBF6]/65"
                        style="font-size:clamp(0.8rem,1.4vw,1.15rem)">Review Smarter, Quiz Better.</h5>
                    <h6 class="font-medium m-0 mt-2 leading-none text-gray-400"
                        style="font-size:clamp(0.65rem,0.9vw,0.8rem)">Information Technology & Computer Related Course</h6>
                </div>
            </div>

            {{-- Right panel --}}
            <div class="custom-scroll w-1/2 h-full flex items-center justify-start px-8 lg:px-16 overflow-y-auto py-8">

                <desktop-register
                    log-in="{{route('login')}}"
                >
                </desktop-register>
            </div>
        </div>
    </div>

    
</body>
</html>
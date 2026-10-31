<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart E-Learning</title>
    <link rel="shortcut icon" href="{{ asset('images/Components/Favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
    <style>
        .topics-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .topics-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .topics-scroll::-webkit-scrollbar-thumb {
            background-color: #E5E0F0;
            border-radius: 999px;
        }
        .topics-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #C9BEE8;
        }
        .topics-scroll {
            scrollbar-width: thin;
            scrollbar-color: #E5E0F0 transparent;
        }
    </style>

</head>
    <body class="h-dvh w-screen overflow-hidden">
        <div id="app" class="h-full">

            {{-- COMPUTER --}}
            <left-navigation 
                active-page="Dashboard"
                :id-number="{{auth()->user()->id_number}}"
                user-name="{{auth()->user()->name}}"
                user-email="{{auth()->user()->email}}"
                logo="{{ asset('images/Components/Logo.png') }}"
                profile-color="{{auth()->user()->profile_color}}"
            ></left-navigation>

            {{-- MOBILE --}}
            <bottom-navigation active-page="Dashboard"></bottom-navigation>

            <main class="w-full md:w-[calc(100%-280px)] min-w-0 h-full flex flex-col gap-4 md:gap-0 md:ml-[280px] ml-0 p-3 sm:p-5 overflow-y-auto max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">

                
                <admin-header
                    class="md:mb-5"
                    user-name="{{auth()->user()->name}}"
                    user-email="{{auth()->user()->email}}"
                    profile-color="{{auth()->user()->profile_color}}"
                ></admin-header>

                <dashboard-cards
                    :total-user="{{$total_users}}"
                    :total-subjects="{{$total_subjects}}"
                    :total-admins="{{$total_admins}}"
                ></dashboard-cards>

                <overview
                :recent-activities='@json($recent_activities)'
                :leaderboard='@json($leaderboard)'
                :users-names='@json($users_names)'
                ></overview>

                <div class="h-[calc(4rem+env(safe-area-inset-bottom))] shrink-0 md:hidden"></div>

            </main>
        </div>
        

        @vite(['resources/js/app.js'])
    </body>
</html>
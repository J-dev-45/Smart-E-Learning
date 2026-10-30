<template>
    <nav class="w-[280px] h-screen fixed top-0 left-0 bg-white border-r border-gray-200 md:flex hidden flex-col overflow-hidden">

        <div class="w-full flex items-center gap-3 h-[60px] px-5 border-b border-gray-200 shrink-0 bg-white">

            <img :src="logo" alt="Smart E-Learning logo" class="size-10 shrink-0 object-contain">

            <span class="font-extrabold text-[#5b21b6] tracking-wide leading-tight text-[17px] truncate">Smart E-Learning</span>

        </div>

        <ul class="topics-scroll w-full overflow-y-auto flex flex-col gap-1 text-[13px] py-3 px-2">

            <li v-for="link in links" :key="link.id">

                <a
                    :href="link.routeName"
                    @click="changeLocalStorage(link.linkName)"
                    class="changeLocalStorage flex items-center gap-2.5 mx-1 px-3 py-2 rounded-md border-l-[3px] transition-colors"
                    :class="link.linkName === activePage
                        ? 'bg-[#4C1D95]/10 text-[#4C1D95] font-semibold border-[#4C1D95]'
                        : 'text-gray-600 font-medium border-transparent hover:bg-[#4C1D95]/5 hover:text-[#4C1D95]'"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-[17px] shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            :d="link.icon"
                        />
                    </svg>

                    {{ link.linkName }}

                </a>

            </li>

        </ul>

        <!-- User info + logout (UI only) -->
        <div class="mt-auto w-full border-t border-gray-200 p-3 shrink-0">

            <div class="flex items-center gap-2.5 px-2 py-2">

                <div :class="[
                    'w-10 h-10 rounded-full  flex items-center justify-center shrink-0',
                    profileColor
                ]">
                    <span class="text-[13px] font-semibold">JR</span>
                </div>

                <div class="flex flex-col gap-0.5 min-w-0 leading-tight">
                    <span class="text-[13px] font-semibold text-gray-800 truncate">{{ userName }}</span>
                    <span class="text-[11px] text-gray-400 truncate">{{ userEmail }}</span>
                    <span class="text-[11px] text-gray-400 truncate">ID: {{ idNumber }}</span>
                </div>

            </div>

            <button
                type="button"
                @click="logout"
                class="w-full flex items-center gap-2.5 mt-2 px-3 py-2 rounded-md text-[13px] font-medium text-gray-600 hover:bg-red-50 hover:text-red-600 transition-colors cursor-pointer"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-[17px] shrink-0"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"
                    />
                </svg>

                Logout

            </button>


        </div>

    </nav>

</template>

<script setup>


defineProps({
    activePage: { type: String, default: 'Dashboard' },
    idNumber: { type: Number, default: 0},
    userName: { type: String, default: 'Undefined'},
    userEmail: { type: String, default: 'Undefined'},
    logo: { type: String, required: true},
    profileColor: { type: String, required: true}
});


const changeLocalStorage = (linkName) => {

    if (linkName !== 'Subjects') {
        localStorage.setItem('Main', 'topics');
    } else {
        localStorage.removeItem('Main');
    }

};

const links = [
    {
        id: 1,
        routeName: "/dashboard",
        linkName: "Dashboard",
        icon: "M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"
    },

    {
        id: 2,
        routeName: "/users",
        linkName: "Users",
        icon: "M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
    },

    {
        id: 3,
        routeName: "/subjects",
        linkName: "Subjects",
        icon: "M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
    },

    {
        id: 4,
        routeName: "/feedbacks",
        linkName: "Feedbacks",
        icon: "M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"
    }
];

async function logoutForm(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try{
        const response = await fetch('/logout',{
            method: "POST",
            headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : csrfToken,
                'Accept' : 'application/json'
            }
        });

        const data = await response.json();

        if (response.ok && data.success) { 
            window.location.href = '/'; 
        } 
        else { console.log('Logout failed:', data); }

    }catch(err){
        console.log(err)
    }
}

function logout(){
    logoutForm();
}
</script>
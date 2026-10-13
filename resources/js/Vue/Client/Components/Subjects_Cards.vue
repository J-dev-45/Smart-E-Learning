<template>
    <div
        v-for="subject in subjectsData"
        :key="subject.order"
        class="group relative flex flex-col justify-between md:p-5 p-2 gap-4 rounded-xl border-[1.5px] border-[#CECBF6]/15 bg-[#CECBF6]/6 transition-all duration-300 hover:border-[#CECBF6]/40 hover:bg-[#CECBF6]/10">
        <div class="flex items-start justify-between">
            <div  class="p-2.5 rounded-lg bg-[#CECBF6]/10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-[#CECBF6]">
                    <path stroke-linecap="round" stroke-linejoin="round" :d="icons.find(ic=>ic.subject === subject.subject_name)?.d" />
                </svg>
            </div>


            <div class="relative size-11 shrink-0">
                <svg class="size-11 -rotate-90" viewBox="0 0 40 40">
                    <circle cx="20" cy="20" r="16" fill="none" stroke="#CECBF6" stroke-opacity="0.12" stroke-width="4"/>
                    <circle cx="20" cy="20" r="16" fill="none" stroke="#CECBF6" stroke-width="4" stroke-linecap="round" stroke-dasharray="100.5" :stroke-dashoffset="100.5 - (percentage(subject.id) / 100) * 100.5"/>
                </svg>
                <span class="absolute inset-0 flex items-center justify-center text-[10px] font-bold text-[#CECBF6]">{{ percentage(subject.id) }}%</span>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold tracking-widest text-[#CECBF6]/50">
                <!-- {{ acronym(subject.subject_name) }} -->
                  Subject Code
            </span>
            <h3 class="text-base font-bold leading-snug">{{ subject.subject_name }}</h3>
            <p class="text-xs font-semibold text-gray-500">{{ getAvailableModulesCount(subject.id) }} quizzes available</p>
        </div>
        <div  class="flex items-center gap-2 pt-1">
            

            <a :href="`/learn/${url(subject.subject_name)}/${subject.id}`" 
                class="flex-1 text-center text-xs font-bold text-[#090014]  rounded-lg py-2.5 transition-colors bg-[#CECBF6]/85 border-[1.5px]">
                  Learn
            </a>
        </div>
    </div>


</template>

<script setup>

const props = defineProps({
    subjectsData: { type: Array, required: true },
    modulesData: { type: Array, required: true },
    pretestData: { type: Array, required: true },
    subjectsStarted: {type: Array, required:true}
})
const icons = [
    {subject: 'Discrete Mathematics', d: 'M12 5 5 17M12 5l7 12M5 17h14M12 5v7M5 17l7-5M19 17l-7-5M10.7 5a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M3.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M17.7 17a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0M10.7 12a1.3 1.3 0 1 0 2.6 0 1.3 1.3 0 1 0-2.6 0'},
    {subject: 'Introduction to Computing', d: 'M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25'},
    {subject: 'Data Structures and Algorithms', d: 'M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125'},
    {subject: 'Computer Programming 1', d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z'},
    {subject: 'Computer Programming 2', d: 'm14.25 9.75 3 3-3 3m-4.5 0-3-3 3-3M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z'},

]

// function getModulessCount(Sid){
//     return props.modulesData.filter(Tdata=> Tdata.subject_id === Sid).length
// }  
function getAvailableModulesCount(Sid) {
    return props.modulesData.filter(
        Mdata => Mdata.subject_id === Sid && Mdata.status != 'current'
    ).length;
}

function getSubjectStarted(Sid){
    return props.subjectsStarted.find(
        SS => SS.subject_id === Sid
    )

}


function percentage(Sid) {
    const subjectPretests = props.pretestData.filter(
        Pdata => Pdata.subject_id === Sid
    );

    const passedPretests = subjectPretests.filter(
        Pdata => Pdata.status === 'passed'
    ).length;

    if (subjectPretests.length === 0) {
        return 0;
    }

    return Math.min(
        100,
        Math.round((passedPretests / subjectPretests.length) * 100)
    );
}


function acronym(Sname){
    return Sname
        .split(' ')
        .filter(Boolean)
        .map(word => word[0])
        .join('')
        .toUpperCase();
}

function url(url_name) {
    return url_name.replace(/\s+/g, "_");
}

// function conso(sName, percent){
//     console.log( sName + ":" + percent)
// }

</script>
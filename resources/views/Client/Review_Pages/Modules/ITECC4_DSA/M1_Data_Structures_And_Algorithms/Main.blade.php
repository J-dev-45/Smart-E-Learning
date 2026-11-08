<div class="w-full max-w-5xl mx-auto">
   
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)
                @case('ITECC4-topic-what-are-data-structures-and-algorithms')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M1_Data_Structures_And_Algorithms.What_Are_Data_Structures_and_Algorithms')
                    @break

                @case('ITECC4-topic-java-basics-review')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M1_Data_Structures_And_Algorithms.Java_Basics_Review')
                    @break

                @case('ITECC4-topic-stacks')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M1_Data_Structures_And_Algorithms.Stacks')
                    @break

            @endswitch
        </div>
    @endforeach
    
    
</div>

<div class="w-full max-w-5xl mx-auto">
   
    @foreach($topics as $topic)
        <div class="mt-10 mb-20 rounded-2xl border sharedBorder border-l-4 sharedBorderLAccent sharedDeepBG p-6 shadow-lg sharedShadow [&>div]:mt-0 [&>div]:scroll-mt-[130px]">
            @switch($topic->slug)
                @case('ITECC4-topic-queues')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M2_Queues.Queues')
                    @break

                @case('ITECC4-topic-priority-queues')
                    @include('Client.Review_Pages.Modules.ITECC4_DSA.M2_Queues.Priority_Queues')
                    @break

            @endswitch
        </div>
    @endforeach
  
</div>

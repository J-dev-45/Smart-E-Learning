<div id="splash-loader"
     class="w-screen h-screen fixed inset-0 z-200 flex items-center justify-center overflow-hidden bg-[#3b0764]"
     style="transition: opacity .4s ease;">

    <div class="flex flex-col items-center gap-6">

        <!-- Ring mark -->
        <div class="relative" style="width: clamp(96px, 16dvh, 130px); height: clamp(96px, 16dvh, 130px);">
            <svg viewBox="0 0 130 130" class="w-full h-full -rotate-90">
                <circle cx="65" cy="65" r="56" fill="none" stroke="#CECBF6" stroke-opacity="0.15" stroke-width="3" />
                <circle cx="65" cy="65" r="56" fill="none" stroke="#CECBF6" stroke-width="3"
                        stroke-linecap="round" class="ring-sweep" />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <img src="{{ $logo }}" alt="Logo"
                     class="object-contain drop-shadow-lg"
                     style="width:clamp(80px,10dvh,100px); height:clamp(80px,10dvh,100px)">
            </div>
        </div>

        <p class="text-[22px] font-bold tracking-tight text-[#F5F3FF] text-center m-0">
            Smart <span class="text-[#CECBF6]">E-Learning</span>
        </p>

    </div>
</div>

<style>
.ring-sweep {
    stroke-dasharray: 352;
    stroke-dashoffset: 352;
    animation: ring-sweep 1.6s cubic-bezier(.65, 0, .35, 1) infinite;
}

@keyframes ring-sweep {
    0%   { stroke-dashoffset: 352; }
    50%  { stroke-dashoffset: 55; }
    100% { stroke-dashoffset: -300; }
}

@media (prefers-reduced-motion: reduce) {
    .ring-sweep {
        animation: none;
        stroke-dashoffset: 60;
    }
}
</style>

<script>
    (function () {
        var splash = document.getElementById('splash-loader');
        if (!splash) return;

        function show() {
            splash.style.display = 'flex';
            splash.style.pointerEvents = 'auto';
            void splash.offsetWidth; 
            splash.style.opacity = '1';
        }

        function hide() {
            splash.style.opacity = '0';
            splash.style.pointerEvents = 'none';
            setTimeout(function () {
                if (splash.style.opacity === '0') splash.style.display = 'none';
            }, 400);
        }

        if (document.readyState === 'complete') {
            hide();
        } else {
            window.addEventListener('load', hide);
        }

        window.addEventListener('beforeunload', show);

        window.addEventListener('pageshow', function (e) {
            if (e.persisted) hide();
        });
    })();
</script>
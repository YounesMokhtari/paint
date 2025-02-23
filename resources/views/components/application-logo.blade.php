<svg {{ $attributes }} viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- گرادیان‌های رنگی -->
    <defs>
        <!-- گرادیان پس‌زمینه -->
        <linearGradient id="paint0_linear" x1="0" y1="0" x2="100" y2="100"
            gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#E9D5FF" />
            <stop offset="100%" stop-color="#FAE8FF" />
        </linearGradient>

        <!-- گرادیان قلم‌مو -->
        <linearGradient id="brush_gradient" x1="30" y1="45" x2="70" y2="65"
            gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#86EFAC" />
            <stop offset="100%" stop-color="#34D399" />
        </linearGradient>

        <!-- گرادیان پالت -->
        <linearGradient id="palette_gradient" x1="25" y1="35" x2="75" y2="65"
            gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#F472B6" />
            <stop offset="100%" stop-color="#EC4899" />
        </linearGradient>
    </defs>

    <!-- دایره پس‌زمینه -->
    <circle cx="50" cy="50" r="45" fill="url(#paint0_linear)" class="opacity-90" />

    <!-- قلم‌موی هنری -->
    <path d="M30 65c0 0 20-25 40-20c-5 15-25 40-40 20z" fill="url(#brush_gradient)" stroke="#34D399" stroke-width="2"
        stroke-linejoin="round" />

    <!-- پالت رنگ -->
    <path d="M60 45c-10-15-30-10-35 5c-5 15 5 30 20 25c15-5 25-15 15-30z" fill="url(#palette_gradient)" stroke="#EC4899"
        stroke-width="2" stroke-linejoin="round" />

    <!-- نقاط رنگی روی پالت -->
    <circle cx="45" cy="35" r="3" fill="#FCD34D" />
    <circle cx="55" cy="45" r="3" fill="#60A5FA" />
    <circle cx="40" cy="50" r="3" fill="#F472B6" />

    <!-- خطوط هنری -->
    <path d="M25 75c15-10 35-10 50 0" stroke="#8B5CF6" stroke-width="3" stroke-linecap="round" class="opacity-80">
        <animate attributeName="d" dur="4s" repeatCount="indefinite"
            values="M25 75c15-10 35-10 50 0;
                   M25 72c15-5 35-15 50 3;
                   M25 75c15-10 35-10 50 0" />
    </path>

    <!-- حرف A برای ArtGallery -->
    <path d="M45 20L60 80M45 20L30 80M35 55h20" stroke="#8B5CF6" stroke-width="3" stroke-linecap="round"
        stroke-linejoin="round" class="opacity-90" />
</svg>

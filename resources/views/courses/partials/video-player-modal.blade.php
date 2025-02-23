<div id="videoPlayerModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 w-full max-w-4xl mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 id="videoTitle" class="text-lg font-bold dark:text-white"></h3>
            <button onclick="closeVideoPlayer()"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="relative" style="padding-top: 56.25%">
            <video id="videoPlayer" class="absolute top-0 left-0 w-full h-full rounded-lg" controls
                controlsList="nodownload">
                <source src="" type="video/mp4">
                {{ __('courses.video.not_supported') }}
            </video>
        </div>
    </div>
</div>

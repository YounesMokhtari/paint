<form action="{{ route('comments.store') }}" method="POST" class="mt-4 bg-white p-6 rounded-lg shadow-md">
    @csrf
    <input type="hidden" name="blog_post_id" value="{{ $blog_post_id ?? '' }}">
    <input type="hidden" name="type" value="{{ $type ?? '' }}">
    <div class="mb-4">
        <label class="block text-gray-800 text-sm font-bold mb-2">
            {{ __('comments.your_comment') }}
        </label>
        <textarea name="content" rows="3" placeholder="{{ __('comments.write_comment_placeholder') }}"
            class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-sage-500 focus:border-transparent transition duration-200"
            required dir="rtl">{{ old('content') }}</textarea>
        @error('content')
            <p class="text-red-500 text-xs mt-1 mr-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="bg-sage-500 hover:bg-sage-600 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-sage-500 focus:ring-offset-2 transition duration-200 w-full sm:w-auto">
        {{ __('comments.post_comment') }}
    </button>
</form>

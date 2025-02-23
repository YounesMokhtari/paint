<div class="bg-white p-6 rounded-lg shadow-sm">
    <h3 class="text-lg font-medium mb-4">{{ __('ratings.rate_this') }}</h3>

    <form action="{{ route('courses.reviews.store',$course) }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="rateable_id" value="{{ $rateable->id }}">
        <input type="hidden" name="rateable_type" value="{{ get_class($rateable) }}">

        <!-- Star Rating -->
        <div class="flex items-center gap-2">
            @for($i = 1; $i <= 5; $i++)
                <button type="button"
                        class="rating-star text-2xl {{ $i <= old('rating', 0) ? 'text-yellow-400' : 'text-gray-300' }}"
                        data-rating="{{ $i }}">
                    ★
                </button>
            @endfor
            <input type="hidden" name="rating" value="{{ old('rating', 0) }}" required>
        </div>
        @error('rating')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        <!-- Comment -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('ratings.write_review') }}
            </label>
            <textarea name="comment" rows="3"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                >{{ old('comment') }}</textarea>
            @error('comment')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            {{ __('ratings.submit_rating') }}
        </button>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.querySelector('input[name="rating"]');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = parseInt(star.dataset.rating);
            ratingInput.value = rating;

            stars.forEach(s => {
                const value = parseInt(s.dataset.rating);
                s.classList.toggle('text-yellow-400', value <= rating);
                s.classList.toggle('text-gray-300', value > rating);
            });
        });
    });
});
</script>
@endpush

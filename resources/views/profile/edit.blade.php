<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Username
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Bio
                            </label>
                            <textarea name="bio" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Profile Picture
                            </label>
                            <input type="file" name="profile_photo" accept="image/*"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            @error('profile_photo')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-sage-500 text-white px-4 py-2 rounded-full hover:bg-sage-600 transition">
                                Update Profile
                            </button>
                            <a href="{{ route('landing') }}" class="text-sage-500 hover:text-sage-600">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-layout :title="'Edit Post'">
    @if ($errors->any())
        <div role="alert" class="rounded-sm border-x-4 border-red-500 bg-red-50 p-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-black font-medium">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">UPdate</h2>
            </div>

            <div class="px-6 py-4">
                <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input
                            value="{{ $post->title }}"
                            name="title"
                            type="text"
                            id="title"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                        >
                    </div>
                    
                    <!-- Description Textarea -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                        >{{ $post->description }}</textarea>
                    </div>
                    
                    <!-- Add this after the description field -->
                    <!-- Remove the image upload field and current image display -->
                    <!-- Keep other form fields intact -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Post Image</label>
                        @if($post->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/images/' . $post->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded">
                                <p class="text-sm text-gray-500 mt-1">Current image</p>
                            </div>
                        @endif
                        
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                            accept="image/*"
                        >
                        <p class="mt-1 text-sm text-gray-500">Upload a new image (optional)</p>
                    </div>
                    
                    <!-- Post Creator Select -->
                    <div class="mb-6">
                        <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Post Creator</label>
                        <select
                            name="post_creator" <!-- Make sure this matches what the controller expects -->
                            id="creator"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white"
                        >
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hover:cursor-pointer"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
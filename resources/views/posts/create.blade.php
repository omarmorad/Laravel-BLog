<x-layout :title="'Create Post'">
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
                <h2 class="text-xl font-semibold text-gray-800">Create New Post</h2>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input
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
                        ></textarea>
                    </div>
                    
                    <!-- Image Upload Field -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Post Image</label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                            accept="image/*"
                        >
                        <p class="mt-1 text-sm text-gray-500">Upload a post image (optional)</p>
                    </div>
                    
                    <!-- Post Creator Select -->
                    <div class="mb-6">
                        <label for="post_creator" class="block text-sm font-medium text-gray-700 mb-1">Post Creator</label>
                        <select 
                            name="post_creator" 
                            id="post_creator"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                        >
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Make sure this section is present at the end of your form -->
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
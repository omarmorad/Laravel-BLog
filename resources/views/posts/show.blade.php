<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto space-y-6">
            <!-- Post Info Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $post->title }}</h1>
                </div>
                <div class="px-6 py-4">
                    <p class="text-gray-700">{{ $post->description }}</p>
                </div>
                <div class="px-6 py-3 bg-gray-50 text-sm text-gray-600">
                    <p>Created by: {{ $post->user->name ?? 'Unknown' }} on {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Comments</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    @forelse($post->comments ?? [] as $comment)
                        <div class="border-b pb-4">
                            <p class="text-gray-700">{{ $comment->content }}</p>
                            <p class="text-sm text-gray-500 mt-1">By: {{ $comment->user->name ?? 'Unknown' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No comments yet.</p>
                    @endforelse
                </div>

                <!-- Add Comment Form -->
                <div class="px-6 py-4 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Add a Comment</h3>
                    <form method="POST" action="{{ route('comments.store', $post->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Your comment</label>
                            <textarea name="content" id="content" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                        </div>
                        
                        <!-- Add user_id field since we're not using auth()->id() -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Select User</label>
                            <select name="user_id" id="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add Comment
                        </button>
                    </form>
                </div>
            </div>

            <!-- Back Button -->
            <div class="flex justify-end">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Back to All Posts
                </a>
            </div>
        </div>
    </div>
</x-layout>
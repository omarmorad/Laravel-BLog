<x-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Image Display Section -->
            @if($post->image)
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif
            
            <div class="p-6">
                <!-- Post Title -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
                
                <!-- Post Meta -->
                <div class="flex items-center text-sm text-gray-600 mb-6">
                    <span>By {{ $post->user ? $post->user->name : 'Unknown' }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                </div>
                
                <!-- Post Content -->
                <div class="prose max-w-none">
                    <p>{{ $post->description }}</p>
                </div>
                
                <!-- Comments Section -->
                <div class="mt-8 border-t pt-8">
                    <h2 class="text-xl font-semibold mb-4">Comments</h2>
                    
                    <!-- Comments List -->
                    @if($post->comments && $post->comments->count() > 0)
                        <div class="space-y-4">
                            @foreach($post->comments as $comment)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-800">{{ $comment->content }}</p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        By {{ $comment->user ? $comment->user->name : 'Unknown' }} • 
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No comments yet.</p>
                    @endif
                    
                    <!-- Add Comment Form -->
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Add a comment</label>
                            <textarea
                                name="content"
                                id="content"
                                rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required
                            ></textarea>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Post Comment
                        </button>
                    </form>
                </div>
                
                <!-- Back Button -->
                <div class="mt-8">
                    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800">
                        &larr; Back to Posts
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
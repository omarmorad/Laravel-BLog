<x-layout>
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Create Post
        </a>
    </div>

    <div class="mt-6 rounded-lg border border-gray-200">
        <div class="overflow-x-auto rounded-t-lg">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Id</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Slug</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created At</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($posts as $post)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $post->id }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $post->title }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $post->slug }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $post->user ? $post->user->name : 'Unknown' }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <a href="{{ route('posts.show', $post->slug) }}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700">View</a>
                            <a href="{{ route('posts.edit', $post['id']) }}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block px-4 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>
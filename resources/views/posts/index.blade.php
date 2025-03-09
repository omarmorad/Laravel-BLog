<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITI Blog Post</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        {{-- @dd($posts); --}}
        <div class="border-b pb-2 mb-6">
            <div class="flex items-center">
                <h1 class="text-xl font-semibold text-gray-800">ITI Blog Post</h1>
                <div class="ml-8">
                    <a href="#" class="text-blue-500 border-b-2 border-blue-500 pb-2 text-sm font-medium">All Posts</a>
                </div>
            </div>
        </div>

        <!-- Create Post Button -->
        <div class="text-center mb-4">
            <a href="#" class="px-4 py-2 bg-green-500 text-white font-medium rounded hover:bg-green-600">
                Create Post
            </a>
        </div>

        <!-- Table Component -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <table class="min-w-full">
                <thead class="bg-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Title</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Posted By</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Created At</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($posts as $post)
                        
                  
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $post['id']}}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{$post['title']}}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $post['posted_by']}}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $post['created_at']}}</td>
                        <td class="px-4 py-3 text-sm space-x-1">
                            <a href="#" class="px-3 py-1 text-xs font-medium text-white bg-blue-400 rounded hover:bg-blue-500">View</a>
                            <a href="#" class="px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Edit</a>
                            <a href="#" class="px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="px-4 py-2 bg-white border-t border-gray-200 flex justify-end">
                <div class="flex space-x-1">
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 bg-white">
                        <span class="sr-only">Previous</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 bg-white text-sm">1</a>
                    <span class="w-8 h-8 flex items-center justify-center rounded border border-blue-600 bg-blue-600 text-white text-sm">2</span>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 bg-white text-sm">3</a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 bg-white text-sm">4</a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 bg-white">
                        <span class="sr-only">Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
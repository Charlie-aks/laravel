<x-layout-site>
    <x-slot:title>Bài viết mới nhất</x-slot:title>
    <main class="bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8">Bài viết mới nhất</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($post->thumbnail)
                    <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('site.post.show', $post->slug) }}" class="text-gray-800 hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->description, 150) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $post->created_at->format('d/m/Y') }}</span>
                            <a href="{{ route('site.post.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800">
                                Đọc tiếp
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </main>
</x-layout-site> 
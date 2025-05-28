<x-layout-site>
    <x-slot:title>{{ $post->title }}</x-slot:title>
    <main class="bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                @if($post->thumbnail)
                <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
                @endif
                
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
                    
                    <div class="flex items-center text-gray-600 mb-6">
                        <span class="mr-4">
                            <i class="far fa-calendar-alt mr-2"></i>
                            {{ $post->created_at->format('d/m/Y') }}
                        </span>
                        @if($post->topic)
                        <span>
                            <i class="far fa-folder mr-2"></i>
                            {{ $post->topic->name }}
                        </span>
                        @endif
                    </div>

                    <div class="prose max-w-none">
                        {!! $post->detail !!}
                    </div>

                    @if($post->description)
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Mô tả</h3>
                        <p class="text-gray-600">{{ $post->description }}</p>
                    </div>
                    @endif
                </div>
            </article>

            <div class="max-w-4xl mx-auto mt-8">
                <a href="{{ route('site.post.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Quay lại danh sách bài viết
                </a>
            </div>
        </div>
    </main>
</x-layout-site> 
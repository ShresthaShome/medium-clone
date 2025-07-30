<x-app-layout>

    <div class="py-2">
        <div class="max-w-xl mx-auto sm:px-3 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-3xl mb-4 pl-14">{{ $post->title }}</h1>

                {{-- User Profile --}}
                <div class="flex gap-4 items-center justify-start">
                    <a href="{{ route('profile.show', $post->user->username) }}"
                        class="inline-block p-[1px] bg-white border-2 border-transparent hover:border-emerald-500 rounded-full">
                        <x-user-profile-pic :user="$post->user" />
                    </a>
                    <div class="flex flex-col items-start pt-1">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('profile.show', $post->user->username) }}"
                                class="hover:underline hover:text-green-900">{{ $post->user->name }}</a>
                            &middot;
                            <a href="#" class="text-emerald-500">Follow</a>
                        </div>

                        <div class="flex justify-center gap-2">
                            <span class="text-gray-600 text-sm">
                                {{ $post->readTime() }} min read</span>
                            &middot;
                            <span class="text-gray-600 text-sm">
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Clap Section  --}}
                <x-clap-section :post="$post" />

                {{-- Content Section --}}
                <div class="mt-4">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                        class="w-full aspect-video object-cover">

                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </div>

                <div class="mt-8">
                    <span class="px-4 py-2 bg-gray-300 rounded-2xl">
                        {{ $post->category->name }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

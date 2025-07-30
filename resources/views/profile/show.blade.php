<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    <div class="flex gap-4">
                        <div class="w-[80%]">
                            <h1 class="text-5xl">{{ $user->name }}</h1>

                            <div class="mt-8 text-gray-900 max-w-5xl  mx-auto">
                                @forelse ($posts as $post)
                                    <x-post-item :post="$post"></x-post-item>
                                @empty
                                    <div class="text-center text-gray-500 py-16">
                                        <p>No posts available.</p>
                                    </div>
                                @endforelse
                            </div>

                            {{ $posts->onEachSide(1)->links() }}
                        </div>

                        <div class="flex-1 flex-col w-[20%] min-w-[200px] border-l p-4 px-8 gap-1 items-start">
                            <x-user-profile-pic :user="$user" size="w-24 h-24" />
                            <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                            <p class="text-gray-500 -mt-1">26k followers</p>

                            <p>{{ $user->bio }}</p>

                            @if (Auth::id() !== $user->id)
                                <div class="mt-2">
                                    <a href="@guest{{ route('login') }} @endguest"><button
                                            class="bg-emerald-600 rounded-full px-4 py-2 text-white">Follow</button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

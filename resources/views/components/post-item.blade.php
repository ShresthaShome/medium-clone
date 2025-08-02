<div
    class="flex justify-between bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 max-h-48 mb-5">
    <div class="p-5 flex flex-col flex-1">
        <div>
            <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post]) }}">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white pl-2">
                    {{ $post->title }}
                </h5>
            </a>
            <a href="{{ route('post.show', [$post->user->username, $post->slug]) }}"
                class="mb-3 font-normal text-gray-700 dark:text-gray-400 pl-2 overflow-hidden">
                <span class="hidden lg:block">
                    {{ Str::words($post->content, 20) }}</span>
                <span class="hidden md:block lg:hidden">
                    {{ Str::words($post->content, 5) }}</span>
                <span class="md:hidden">
                    {{ Str::words($post->content, 2) }}</span>
            </a>
        </div>
        <div class="pl-2 mt-auto text-sm flex gap-4 items-center">
            <a href="{{ route('profile.show', $post->user->username) }}" class="flex items-center gap-2">
                <div
                    class="inline-block p-[1px] bg-white border-2 border-transparent hover:border-emerald-500 rounded-full">
                    <x-user-profile-pic :user="$post->user" size="w-7 h-7" />
                </div>
                <span class="hover:underline">{{ $post->user->username }}</span>
            </a>
            <a href="{{ route('post.show', [$post->user->username, $post->slug]) }}" class="flex items-center gap-4">
                <span>{{ $post->created_at->format('M d, Y') }}</span>
                <span class="inline-flex items-center gap-2">
                    <x-clap-svg />
                    {{ $post->claps_count }}
                </span></a>
        </div>
    </div>
    <a href="{{ route('post.show', [$post->user->username, $post->slug]) }}">
        <img class="h-48 w-48 object-cover rounded-lg" src="{{ Storage::url($post->image) }}" alt="" />
    </a>
</div>

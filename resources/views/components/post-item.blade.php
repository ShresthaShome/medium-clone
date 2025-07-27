<div
    class="flex justify-between bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 max-h-48 mb-5">
    <div class="p-5 flex flex-col flex-1">
        <div>
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white pl-2">
                    {{ $post->title }}
                </h5>
            </a>
            <div class="mb-3 font-normal text-gray-700 dark:text-gray-400 pl-2">
                {{ Str::words($post->content, 20) }}
            </div>
        </div>
        <a href="#" class="pl-2 mt-auto">
            <x-primary-button>
                Read more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </x-primary-button>
        </a>
    </div>
    <a href="#">
        <img class="h-48 w-48 object-cover rounded-lg" src="{{ Storage::url($post->image) }}" alt="" />
    </a>
</div>

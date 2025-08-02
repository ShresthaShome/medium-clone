<ul
    class="inline-flex text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
    <li class="me-2">
        <a href="{{ route('dashboard') }}" aria-current="page"
            class="{{ request('category') ? 'inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' : 'inline-block p-2 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500 border-b-2 border-blue-600' }}">All</a>
    </li>
    @forelse ($categories as $category)
        <li class="me-2">
            <a href="{{ route('post.byCategory', $category) }}"
                class="{{ Route::currentRouteNamed('post.byCategory') && request('category')->id == $category->id
                    ? 'inline-block p-2 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500 border-b-2 border-blue-600'
                    : 'inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                {{ $category->name }}
            </a>
        </li>
    @empty
        {{ $slot }}
    @endforelse
</ul>

<x-app-layout>

    <div class="py-2">
        <div class="max-w-8xl mx-auto sm:px-3 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg group">
                <div class="p-2 text-gray-900 flex items-center justify-center">

                    <div class="relative w-full max-w-7xl">

                        <button id="scroll-left"
                            class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full h-9 w-9 z-10 hidden group-hover:block">
                            &lt;
                        </button>

                        <div id="scroll-container"
                            class="overflow-x-auto no-scrollbar whitespace-nowrap scroll-smooth px-10"
                            style="scrollbar-width:none; -ms-overflow-style:none;">
                            <ul
                                class="inline-flex text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                                <li class="me-2">
                                    <a href="#" aria-current="page"
                                        class="inline-block p-2 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500 border-b-2 border-blue-600">All</a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="me-2">
                                        <a href="#"
                                            class="inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <button id="scroll-right"
                            class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full h-9 w-9 text-center z-10 hidden group-hover:block">
                            &gt;
                        </button>

                    </div>

                </div>
            </div>

            <div class="mt-8 text-gray-900 max-w-5xl  mx-auto">
                @forelse ($posts as $post)
                    <div
                        class="flex bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 max-h-64 mb-5">
                        <div class="p-5 flex-1">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $post->title }}
                                </h5>
                            </a>
                            <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ Str::words($post->content, 20) }}
                            </div>
                            <a href="#"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                        <a href="#">
                            <img class="max-w-56 h-full object-cover rounded-lg"
                                src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="" />
                        </a>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-16">
                        <p>No posts available.</p>
                    </div>
                @endforelse
            </div>

            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>

    <script>
        const container = document.getElementById('scroll-container');
        const btnLeft = document.getElementById('scroll-left');
        const btnRight = document.getElementById('scroll-right');

        function updateButtons() {
            btnLeft.disabled = container.scrollLeft <= 0;
            btnRight.disabled = Math.ceil(container.scrollLeft + container.clientWidth) >= container.scrollWidth;

            btnLeft.classList.toggle('opacity-30', btnLeft.disabled);
            btnLeft.classList.toggle('pointer-events-none', btnLeft.disabled);
            btnRight.classList.toggle('opacity-30', btnRight.disabled);
            btnRight.classList.toggle('pointer-events-none', btnRight.disabled);
        }

        // Initial check
        updateButtons();

        // Update buttons on scroll
        container.addEventListener('scroll', updateButtons);


        btnLeft.addEventListener('click', () => {
            container.scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });

        btnRight.addEventListener('click', () => {
            container.scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });
    </script>

</x-app-layout>

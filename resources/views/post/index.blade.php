<x-app-layout>

    <div class="py-2">
        <div class="max-w-8xl mx-auto sm:px-3 lg:px-4">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 text-center py-3 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif
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
                            <x-category-tabs>
                                No categories found
                            </x-category-tabs>
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
                    <x-post-item :post="$post"></x-post-item>
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

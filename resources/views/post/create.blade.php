<x-app-layout>

    <div class="py-2">
        <div class="max-w-xl mx-auto sm:px-3 lg:px-4">
            <h1 class="text-3xl text-center mt-4 mb-6 font-bold">Create New Post</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col gap-2 items-center justify-center">
                    @csrf

                    <!-- Title -->
                    <div class="flex flex-col items-start gap-1 w-full max-w-xl">
                        <x-input-label for="title" :value="__('Title')" class="text-[18px] pt-1" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col items-start gap-1 w-full max-w-xl">
                        <x-input-label for="content" :value="__('Content')" class="text-[18px] pt-1" />
                        <x-textarea-input rows="1" id="content" class="block mt-1 w-full border-2"
                            name="content" required>
                            {{ old('content') }}
                        </x-textarea-input>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="flex flex-col items-start gap-1 w-full max-w-xl">
                        <x-input-label for="image" :value="__('Image')" class="text-[18px] pt-1" />
                        <input
                            class="block w-full text-sm text-gray-900 border-2 border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="image" name="image" type="file" required />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="flex flex-col items-start gap-1 w-full max-w-xl">
                        <x-input-label for="category_id" :value="__('Category')" class="text-[18px] pt-1" />
                        <x-select-input name="category_id" id="category_id" class="w-full" required>
                            <option value="" disabled selected hidden>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Published At -->
                    <div class="flex flex-col items-start gap-1 w-full max-w-xl">
                        <x-input-label for="published_at" :value="__('Publish At')" class="text-[18px] pt-1" />
                        <x-text-input id="published_at" class="block mt-1 w-full" type="datetime-local"
                            name="published_at" :value="old('published_at', now())" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <x-primary-button type="submit" class="max-w-lg w-1/4 flex items-center justify-center">
                        {{ __('Post') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

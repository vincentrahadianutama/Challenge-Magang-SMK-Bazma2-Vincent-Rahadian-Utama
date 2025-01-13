<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="p-8">
                    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Book Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Book Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $book->name) }}" 
                                placeholder="Enter book name" 
                                required 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        </div>

                        <!-- Category -->
                        <div>
    <label for="book_category_ids" class="block text-sm font-medium text-gray-700">Categories</label>
    <div id="book_category_ids" class="mt-1 grid grid-cols-2 gap-4">
        @foreach ($categories as $category)
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    name="book_category_ids[]" 
                    id="category_{{ $category->id }}" 
                    value="{{ $category->id }}" 
                    class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                    {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}
                >
                <label for="category_{{ $category->id }}" class="ml-2 text-sm text-gray-700">
                    {{ $category->name }}
                </label>
            </div>
        @endforeach
    </div>
    <p class="mt-2 text-sm text-gray-500">Select one or more categories by checking the boxes.</p>
</div>


                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea 
                                name="description" 
                                id="description" 
                                rows="4" 
                                placeholder="Write a brief description" 
                                required 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">{{ old('description', $book->description) }}</textarea>
                        </div>

                        <!-- Author -->
                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                            <input 
                                type="text" 
                                name="author" 
                                id="author" 
                                value="{{ old('author', $book->author) }}" 
                                placeholder="Enter author name" 
                                required 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                            <input 
                                type="file" 
                                name="thumbnail" 
                                id="thumbnail" 
                                class="mt-1 block w-full text-gray-600 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            <p class="mt-2 text-sm text-gray-500">Upload a valid image file (JPG, PNG, GIF).</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button 
                                type="submit" 
                                class="px-6 py-2 bg-green-500 text-white text-sm font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Update Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- resources/views/books/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-4">
                <strong class="text-lg">Name:</strong> {{ $book->name }}
            </div>
            <div class="mb-4">
                <strong class="text-lg">Category:</strong> {{ $book->category_names }}
            </div>
            <div class="mb-4">
                <strong class="text-lg">Author:</strong> {{ $book->author }}
            </div>
            <div class="mb-4">
                <strong class="text-lg">Description:</strong>
                <p>{{ $book->description }}</p>
            </div>
            @if($book->thumbnail)
                <div class="mb-4">
                    <strong class="text-lg">Thumbnail:</strong>
                    <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Book Thumbnail" class="w-32 h-32 object-cover">
                </div>
            @endif
            <a href="{{ route('books.index') }}" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition-all">
                Back to List
            </a>
        </div>
    </div>
</x-app-layout>

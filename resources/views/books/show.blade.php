<x-app-layout> 
    <div class="container mx-auto px-4 py-8">
        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📖 Kirje info</h2>
            <a href="{{ route("books.index") }}" class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 transition">
                ← Tagasi raamaturiiulile
            </a>
        </div>

        <!-- Book Details Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
            <!-- Cover Image -->
            <div class="mb-6">
                <img src="{{ asset('storage/' . $book->cover) }}" 
                    alt="Cover Image" class="w-full h-60 object-cover rounded-lg shadow-md">
            </div>

            <!-- Title -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">📌 Pealkiri</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $book->title }}</p>
            </div>

             <!-- Author(s) -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">📌 Autor(id)</h3>
                <ul class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">
                    @foreach ($book->authors as $author)
                        <li>{{ $author->author }}</li>
                    @endforeach
                </ul>
                   
            </div>

            <!-- Description -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">📝 Kirjeldus </h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $book->description }}</p>
            </div>

            <!-- Created At -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">📅 Viimatine tegevus kirjega</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $book->created_at->format("d M, Y") }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('books.edit', $book) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    ✏️ Muuda kirjet
                </a>
                <button type="button" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-red-700 transition">
                    🗑 Kustuta
                </button>
            </div>
        </div>
    </div>
</x-app-layout>    
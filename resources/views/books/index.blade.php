<x-app-layout>  
    <div class="container mx-auto px-4">
        <!-- Create Blog Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📜 Raamatud</h2>
            <a href="{{ route('books.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                ➕ Lisa uus raamat
            </a>
        </div>

        <!-- Blog Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Pealkiri</th>
                        <th class="px-4 py-3 text-left">Kirjeldus</th>
                        <th class="px-4 py-3 text-left">Muutmise kuupäev</th>
                        <th class="px-4 py-3 text-center">Tegevused</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    @foreach ( $books as $book)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-3">{{$book->id}}</td>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{$book->title}}</td>
                            <!--limit the shown char to 50 in table row -->
                            <td class="px-4 py-3 text-gray-700">{{Str::limit($book->description, 50)}}</td>
                            <td class="px-4 py-3 text-gray-600">{{$book->created_at->format("d M, Y")}}</td>
                            <td class="px-4 py-3 flex justify-center space-x-2">
                                <a href="{{ route("books.show", $book) }}" class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded shadow-md hover:bg-blue-600 transition">
                                    👁 Vaata
                                </a>
                                <a href="{{ route("books.edit", $book) }}" class="px-3 py-1 bg-yellow-500 text-white text-xs font-semibold rounded shadow-md hover:bg-yellow-600 transition">
                                    ✏️ Muuda
                                </a>
                                <form method="POST" action="{{ route('books.destroy', $book) }}">
                                    @csrf
                                    @method("delete")
                                    <button onclick="return confirm('Oled kindel, et soovid raamatu kustutada?')" 
                                        class="px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded shadow-md hover:bg-red-600 transition">
                                        🗑 Kustuta
                                    </button>
                                </form>    
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
        {{ $books->links() }}
        </div>
    </div>
</x-app-layout>    
<x-app-layout>  
    <div class="flex flex-col flex-wrap h-100vh m-2 sm:m-6 rounded-md p-4 sm:p-4  bg-white border-solid border-beige-300 border-2">
        <!-- Index Header -->
        <div class="flex flex-wrap justify-between items-center">
            <!-- Title & Search Book -->
            <div class="flex flex-col w-auto gap-6 py-2">
                <div class="flex flex-wrap">
                    <h2 class="flex  text-2xl font-bold text-gray-800">Siit leiad kõik digiriiulisse lisatud raamatud</h2>
                </div>
                <div class="flex align-bottom">
                    <input class="w-full border-beige-300 rounded-md" placeholder="Otsi digiriiulist">
                </div>
            </div>
            <!-- Add Book -->    
            <div class="flex flex-col gap-2">
                <x-href-button :href="route('search')" :active="request()->routeIs('books.index')">
                    {{ __("+  Lisa Google Books'ist") }}
                </x-href-button>
                <x-href-button :href="route('books.create')" :active="request()->routeIs('books.index')">
                    {{ __('+  Lisa raamat käsitsi') }}
                </x-href-button>
                
            </div>
        </div>

        <!-- Books Table -->
        <div class=" shadow-lg rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-le">ID</th>
                        <th class="px-4 py-3 text-left">Pealkiri</th>
                        <th class="px-4 py-3 text-left">Kirjeldus</th>
                        <th class="px-4 py-3 text-left">Muutmise kuupäev</th>
                        <th class="px-4 py-3 text-center">Tegevused</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-beige-300">

                    @foreach ( $books as $book)
                        <tr class="hover:bg-beige-100 transition">
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
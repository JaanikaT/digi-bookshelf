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
        <div class=" shadow-lg rounded-md overflow-hidden">
            <table class="w-full border border-beige-300 ">
                <thead class="uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left bg-beige-300">ID</th>
                        <th class="px-4 py-3 text-left bg-beige-300">Pealkiri</th>
                        <th class="px-4 py-3 text-left bg-beige-300">Autorid</th>
                        <th class="px-4 py-3 text-left bg-beige-300">Kirjeldus</th>
                        <th class="px-4 py-3 text-center bg-beige-300">Vaata | muuda | kustuta</th>
                    </tr>
                </thead>
                <tbody class="divide-y">

                    @foreach ( $books as $book)
                        <tr class=" bg-white hover:bg-beige-100 transition">
                            <td class="px-4 py-3 ">{{$book->id}}</td>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{$book->title}}</td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $book->authors->pluck('author')->join(', ') }}
                                {{-- {{$book->created_at->format("d M, Y")}} --}}
                            </td>
                            <!--limit the shown char to 50 in table row -->
                            <td class="px-4 py-3 text-gray-700">{{Str::limit($book->description, 50)}}</td>
                            <td class="px-4 py-3 flex justify-center space-x-2">
                                <x-href-button :href="route('books.show', $book)" :active="request()->routeIs('books.index')" class="flex">
                                    <span>👁</span>

                                </x-href-button>
                                <x-href-button :href="route('books.edit', $book)" :active="request()->routeIs('books.index')" class="flex">
                                    <span>✏️</span>
                                </x-href-button>
                                
                                
                                <form method="POST" action="{{ route('books.destroy', $book) }}">
                                    @csrf
                                    @method("delete")
                                    <button onclick="return confirm('Oled kindel, et soovid raamatu kustutada?')" 
                                        class="inline-flex flex-wrap px-4 py-2 bg-beige-100 dark:bg-beige-300 border-2 border-solid border-beige-300 rounded-md font-semibold text-s text-gray-700 dark:text-white tracking-wide hover:bg-red-600 dark:hover:bg-red-400 dark:hover:border-solid dark:hover:border-beige-300 dark:hover:border-2 dark:hover:text-beige-300 dark:focus:bg-white dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-beige-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150">
                                        🗑
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
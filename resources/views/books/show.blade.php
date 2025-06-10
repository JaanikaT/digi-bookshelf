@php
    $userPivot = $book->users->first()?->pivot;
    $readingStatus = $userPivot?->reading_status;
    $readingStatusLabel = $readingStatus ? \App\Models\BookUser::readingStatuses()[$readingStatus] : null;
    
@endphp


<x-app-layout> 
    <div class="flex flex-col h-100vh m-2 sm:m-6 rounded-md p-4 sm:p-4">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 max-w-xl mx-auto border-solid border-beige-300 border-2">
            <div class="flex justify-between gap-8">
                <h2 class=" flex text-2xl font-bold text-gray-800 dark:text-beige-100">Raamatu info</h2>
                <x-href-button :href="route('books.index')" :active="request()->routeIs('books.show')" class="flex">
                    {{ __('Tagasi') }}
                </x-href-button>
            </div>

            <div class="flex justify-between mt-8">
                <x-book-card :book="$book"/>
                <div class="flex flex-col">
                    <h3 class="mb-1">Lugemise staatus</h3>
                    @if(!empty( $readingStatusLabel ))
                        <p class="">{{ $readingStatusLabel }}</p>
                    @else
                        <p class="text-gray-500 italic">Staatust pole lisatud</p>
                    @endif    
                </div>                           
            </div>

            <div class="mt-8 mb-2">
                <h2 class="">{{ $book->title }}</h2>    
            </div>

            <div class="mb-6">
                {{-- <h3 class="mb-1">Autor(id)</h3> --}}
                <h3 class=""><ul class="">
                    @foreach ($book->authors as $author)
                        <li>{{ $author->author }}</li>
                    @endforeach
                </ul></h3>
            </div>
            <div class="mb-6">
                <h3 class="mb-1">ISBN</h3>
                @if(!empty( $book->isbn ))
                    <p class="">{{ $book->isbn }}</p>
                @else
                    <p class="text-gray-500 italic">ISBN pole lisatud</p>
                @endif
            </div>   

            <div class="mb-6">
                <h3 class="mb-1">Väljaandmise aasta</h3>
                @if(!empty($book->publication_year))
                    <p class="">{{ $book->publication_year }}</p>
                @else
                    <p class="text-gray-500 italic">Aastat pole lisatud</p>
                @endif    
            </div>
            <div class="mb-6">
                <h3 class="mb-1">Lehekülgi</h3>
                @if(!empty($book->pages))
                    <p class="">{{ $book->pages }}</p>
                @else
                    <p class="text-gray-500 italic">Lehekülgede arvu pole lisatud</p>
                @endif    
            </div>
            <div class="mb-6">
                <h3 class="mb-1">Lühikirjeldus</h3>
                @if(!empty($book->description))
                    <p class="">{{ $book->description }}</p>
                @else
                    <p class="text-gray-500 italic">Lühikirjeldust pole lisatud</p>
                @endif     
            </div>
            <div class="mb-6">
                <h3 class="mb-1">Sildid</h3>
                @if($book->tags->isEmpty())
                    <p class="text-gray-500 italic">Silte pole lisatud</p>
                @else
                    <ul class="flex gap-3">
                        
                        @foreach ($book->tags as $tag)
                            <p class="bg-beige-300 px-2 py-1 rounded-md">{{ $tag->tag }}</p>
                        @endforeach
                    </ul>
                @endif    
            </div>
            <div class="mb-6">
                <h3 class="mb-1">Minu märkmed</h3>
                @if(!empty($userPivot?->notes))    
                    <p class="">
                        {{ $userPivot->notes }}
                    </p>
                @else
                    <p class="text-gray-500 italic">Märkmeid pole lisatud</p>
                @endif
            </div>

            <div class="flex justify-between gap-4 pt-6">
                <div class="flex flex-col">
                    <h3 class="text-sm"> Viimatine tegevus </h3>
                    <p class="text-sm">{{ $book->updated_at->format("d M, Y") }}</p>
                </div>    
                <div class="flex justify-right space-x-2">
                    <x-href-button :href="route('books.edit', $book)" :active="request()->routeIs('books.show')" class="flex">
                        <span>✏️ Muuda kirjet</span>
                    </x-href-button>
                    <form method="POST" action="{{ route('books.destroy', $book) }}">
                        @csrf
                        @method("delete")
                        <button onclick="return confirm('Oled kindel, et soovid raamatu kustutada?')" 
                            class="inline-flex flex-wrap px-4 py-2 bg-beige-100 dark:bg-beige-300 border-2 border-solid border-beige-300 rounded-md font-semibold text-s text-gray-700 dark:text-white tracking-wide hover:bg-red-600 dark:hover:bg-red-400 dark:hover:border-solid dark:hover:border-beige-300 dark:hover:border-2 dark:hover:text-beige-300 dark:focus:bg-white dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-beige-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150">
                            🗑
                        </button>
                    </form>

                </div>    
            </div>
        <div>    
    <div>

</x-app-layout>    
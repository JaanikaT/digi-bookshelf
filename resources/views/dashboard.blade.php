<x-app-layout>
    <div class="flex flex-col flex-wrap h-100vh m-2 sm:m-6 rounded-md p-4 sm:p-4  bg-white dark:bg-gray-800 border-solid border-beige-300 border-2">
        
        <div class="space-y-12 p-6">

            {{-- Recently Added --}}
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-6">Hiljuti lisatud raamatud</h2>
                @if($recentBooks->isEmpty())
                    <p class="text-center text-gray-600 italic">Lisa mõni raamat riiulisse</p>
                @else
                    <div class="flex flex-wrap gap-4">
                        @foreach($recentBooks as $book)
                            <x-book-card :book="$book" />
                        @endforeach
                    </div>
                @endif    
            </div>

            {{-- In Progress --}}
            <div>
                <h2 class="text-2xl font-semibold mb-6">Pooleli</h2>
                <div class="flex space-x-4">
                    @foreach($inProgressBooks as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>
            </div>
            
            {{-- Wishlist --}}
            <div>
                <h2 class="text-2xl font-semibold mb-6">Sooviriiul</h2>
                <div class="flex space-x-4">
                    @foreach($wishlistBooks as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>
            </div>

            {{-- Completed --}}
            <div>
                <h2 class="text-2xl font-semibold mb-6">Hiljuti loetud</h2>
                <div class="flex space-x-4">
                    @foreach($completedBooks as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>


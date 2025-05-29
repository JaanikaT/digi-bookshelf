<x-app-layout>     
    <div class="flex flex-col h-100vh m-2 sm:m-6 rounded-md p-4 sm:p-4">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 max-w-2xl mx-auto border-solid border-beige-300 border-2">
            
            <div class="flex justify-between gap-8">
                <h2 class=" flex text-2xl font-bold text-gray-800 dark:text-beige-100">Otsi raamatu infot Google Books'ist</h2>
                <x-href-button :href="route('books.index')" :active="request()->routeIs('search')" class="flex">
                    {{ __('Tagasi') }}
                </x-href-button>
            </div>
        
            <form id="search" onsubmit="return searchGoogleBooks();">
                <!-- Search via ISBN -->
                <div class="mb-4">
                    <x-input-label for="search-isbn" :value="__('Sisesta ISBN')" />
                    <x-text-input id="search-isbn" type="text" name="search-isbn" :value="old('search-isbn')" required autofocus placeholder="9781394314454">{{ old('search-isbn') }}  </x-text-input>
                    <x-input-error :messages="$errors->get('search-isbn')" class="mt-2" />
                </div>

                <!-- Search Button -->
                <div class="mt-3">
                    <x-primary-button class="items-center justify-center my-3">
                        <span>{{ __('Otsi raamatut') }}</span>
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div id="results" style="display: none;" >
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 m-6 max-w-2xl mx-auto border-solid border-beige-300 border-2">
                <div class="flex justify-between gap-8">
                    <h2 class=" flex text-2xl font-bold text-gray-800 dark:text-beige-300">Otsingu tulemus</h2>
                </div>

            
                <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Title -->
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Pealkiri *')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="">{{ old('title') }}  </x-text-input>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    
                    <!-- Author(s) -->
                    <div class="mt-3">
                        <x-input-label for="author" :value="__('Autor(id) *')" />
                        <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required autocomplete="author" placeholder=""></x-text-input>
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>
                    
                    <!-- ISBN -->
                    <div class="mt-3">
                        <x-input-label for="isbn" :value="__('ISBN number')" />
                        <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" :value="old('isbn')" placeholder="">{{ old('isbn') }}</x-text-input>
                        <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                    </div>

                    <!-- Description Field -->
                    <div class="mt-3">
                        <x-input-label for="description" :value="__('Raamatu lühikirjeldus')" />
                        <x-textarea id="description" name="description" maxlength="500" class="h-1/2" placeholder="">
                            {{ old('description') }}                    
                        </x-textarea>               
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />          
                    </div>

                    <!-- Action Buttons, VT ÜLE ROUTE või tegevus-->
                    <div class="mt-3">
                        <x-primary-button class="items-center justify-center my-3">
                            <span>{{ __('Lisa raamat oma riiulisse') }}</span>
                        </x-primary-button>
                    </div>
                </form>                           
            </div>
        </div>    
    </div>

</x-app-layout>    


{{-- ISBN search from Google Books --}}
<script>
function searchGoogleBooks() {
    const googleBooksApiKey = "{{ $googleBooksApiKey }}"; // Pass the API key to JavaScript
    
    const isbn = document.getElementById('search-isbn').value.trim();
    if (!isbn) return false;

    // Make an Axios request with ISBN via API key
    axios.get(`https://www.googleapis.com/books/v1/volumes?q=isbn:${encodeURIComponent(isbn)}&key=${googleBooksApiKey}`)
        .then(response => {
            // Handle the response data
            console.log(response.data);
            const resultContainer = document.querySelector('#results');

            if (response.data.items && response.data.items.length > 0) {
                
                const book = response.data.items[0].volumeInfo;

                // Update existing input fields
                const titleInput = document.querySelector('#title');
                const authorsInput = document.querySelector('#author');
                const descriptionInput = document.querySelector('#description');
                if (descriptionInput) {
                    descriptionInput.value = book.description || '';
                }
                const isbn13 = book.industryIdentifiers?.find(id => id.type === 'ISBN_13')?.identifier || '';
                //console.log(isbn13);
                const isbnInput = document.querySelector('#isbn');
                if (isbnInput) {
                    isbnInput.value = isbn13;
                }
                


                if (titleInput && authorsInput) {
                    titleInput.value = book.title || 'N/A';
                    authorsInput.value = book.authors ? book.authors.join(', ') : 'N/A';
                }

                // Show the form if hidden
                resultContainer.style.display = 'block';
            } else {
                alert("Sellise ISBN-iga raamatut ei leitud Google Books'ist.");
            }
        })
        .catch(error => {
            // Handle errors
            console.error(error);
            alert('Raamatu info toomisel esines viga.');
        });

    return false; // Prevent form submission
}
</script>

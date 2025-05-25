<x-app-layout> 
    <div class="flex flex-col h-100vh m-2 sm:m-6 rounded-md p-4 sm:p-4">
        <!-- Page Heading -->
        

        <!-- Form Container -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto border-solid border-beige-300 border-2">
            
            <div class="flex justify-between">
                <h2 class=" flex align-text-bottom text-2xl font-bold text-gray-800">Lisa raamat</h2>
                <x-href-button :href="route('books.index')" :active="request()->routeIs('books.create')" class="flex">
                    {{ __('Tagasi') }}
                </x-href-button>
            </div>
            <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Title Field -->
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Pealkiri *')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder=""/>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    {{-- @error("title")
                        <div class="error">{{ $message }}</div>
                    @enderror     --}}
                </div>
                
                <!-- Author(s) Field -->
                <div class="mt-3">
                    <x-input-label for="author" :value="__('Autor(id) *')" />
                    <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required autofocus autocomplete="author" placeholder="(Eralda mitu autorit komaga)"/>
                    <x-input-error :messages="$errors->get('author')" class="mt-2" />
                </div>
                
                
                {{-- <div class="mb-4">
                    
                    <input type="text" id="title" name="author" value="" 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" 
                            >
                    @error("author")
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div> --}}

                 <!-- Release Year and Pages-->
                 <div class="flex w-full justify-between mt-3">
                    <div class="flex flex-col">
                        <x-input-label for="publication_year" :value="__('Väljaandmise aasta')" />
                        <x-text-input id="publication_year" class="flex mt-1 w-2/3" type="number" name="publication_year" :value="old('publication_year')" min="1500" max="2100" autocomplete="publication_year" placeholder=""/>
                        <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                    </div>
                    <div class="flex flex-col w-auto">
                        <x-input-label for="pages" :value="__('Lehekülgede arv')" />
                        <x-text-input id="pages" class="flex mt-1 w-2/3" type="number" name="pages" :value="old('pages')" placeholder=""/>
                        <x-input-error :messages="$errors->get('pages')" class="mt-2" />
                    </div>    
                </div>
                <!-- Description Field -->
                <div class="mt-3">
                    <x-input-label for="description" :value="__('Raamatu lühikirjeldus')" />                    
                    <textarea id="description" name="description" maxlength="500" :value="old('description')" 
                                class="h-1/2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-beige-300 dark:focus:border-beige-300 focus:ring-beige-300 dark:focus:ring-beige-300 rounded-md shadow-sm focus:placeholder-beige-300 placeholder-gray-400" 
                                placeholder="Max 500 tähemärki"></textarea>
                    <x-input-error :messages="$errors->get('author')" class="mt-2" />          
                </div>

                <!-- Cover Image Upload -->
                <div class="mt-3">
                    <x-input-label for="cover" :value="__('Kaanepilt')" />
                    <input type="file" id="cover" name="cover" :value="old('cover')" placeholder=""
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-beige-300">
                    @error("cover")
                        <div class="error">{{ $message }}</div>
                    @enderror        
                </div>

                <!-- Submit Button -->
                <div class="mt-3">
                    <x-primary-button class="items-center justify-center my-3">
                        <span>{{ __('Lisa raamat') }}</span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


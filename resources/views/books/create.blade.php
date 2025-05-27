<x-app-layout> 
    <div class="flex flex-col h-100vh m-2 sm:m-6 rounded-md p-4 sm:p-4">

        <!-- Form Container -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto border-solid border-beige-300 border-2">
            
            <div class="flex justify-between gap-8">
                <h2 class=" flex text-2xl font-bold text-gray-800">Lisa raamat</h2>
                <x-href-button :href="route('books.index')" :active="request()->routeIs('books.create')" class="flex">
                    {{ __('Tagasi') }}
                </x-href-button>
            </div>

            <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Title -->
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Pealkiri *')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="">{{ old('title') }}  </x-text-input>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    {{-- @error("title")
                        <div class="error">{{ $message }}</div>
                    @enderror     --}}
                </div>
                
                <!-- Author(s) -->
                <div class="mt-3">
                    <x-input-label for="author" :value="__('Autor(id) *')" />
                    <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required autocomplete="author" placeholder="(Eralda mitu autorit komaga)"></x-text-input>
                    <x-input-error :messages="$errors->get('author')" class="mt-2" />
                </div>

                <!-- ISBN -->
                <div class="mt-3">
                    <x-input-label for="isbn" :value="__('ISBN number')" />
                    <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" :value="old('isbn')" placeholder="9781394314454">{{ old('isbn') }}</x-text-input>
                    <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                </div>

                <!-- Publication Year and Pages-->
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
                    <x-textarea id="description" name="description" maxlength="500" class="h-1/2" placeholder="Max 500 tähemärki">
                        {{ old('description') }}                    
                    </x-textarea>               
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />          
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
                
                <!-- Reading status -->
                <div class="mt-3">
                    <x-input-label for="reading_status" :value="__('Lugemise staatus')" />
                    <select name="reading_status" class="form-select mt-1 p-2 w-1/2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-beige-300">
                        <option value="">-- Vali staatus --</option>
                        @foreach(\App\Models\BookUser::readingStatuses() as $value => $label)
                            <option value="{{ $value }}" {{ old('reading_status', $book->reading_status ?? '') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                

                <!-- Add user notes, optional-->
                <div x-data="{ showDetails: false }">
                    <button type="button" @click="showDetails = !showDetails" class="mt-4 flex justify-start  bg-beige-100 w-full text-gray-800 rounded-md">
                        &#11167; Soovi korral lisa kohe oma märkmed
                    </button>

                    <div x-show="showDetails" class="flex flex-col mt-4">
                        <!-- User notes -->
                        <div class="mt-3">
                            <x-input-label for="notes" :value="__('Minu märkmed')" />
                            <x-textarea id="notes" name="notes" maxlength="500" class="h-1/2" placeholder="Max 500 tähemärki">
                                {{ old('notes') }}                    
                            </x-textarea>               
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />          
                        </div>
                        
                        <!-- Tags -->
                        <div class="mt-3">
                            <x-input-label for="tag" :value="__('Sildid')" />
                            <x-text-input id="tag" class="block mt-1 w-full" type="text" name="tag" :value="old('tag')" autocomplete="tag" placeholder="(Eralda erinevad sildid komaga)"/>
                            <x-input-error :messages="$errors->get('tag')" class="mt-2" />
                            
                        </div>
                        
                        {{-- <!-- Author(s) -->
                        <div class="mt-3">
                            <x-input-label for="author" :value="__('Autor(id) *')" />
                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required autocomplete="author" placeholder="(Eralda mitu autorit komaga)"/>
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

                        <!-- ISBN -->
                        <div class="mt-3">
                            <x-input-label for="isbn" :value="__('ISBN number')" />
                            <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" :value="old('isbn')" required placeholder="9781394314454">{{ old('isbn') }}</x-text-input>
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

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
                        </div> --}}
                    </div>

                    
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


<x-app-layout>     
    <div class="container mx-auto px-4 py-8">
        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-6">
            <h1>🔎 Otsi raamatut</h1>
            <a href="{{ route("books.index") }}" 
                class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 transition">
                ← Tagasi riiulile
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
            <form id="search" onsubmit="return yourFunction();">
                <!-- ISBN Field -->
                <div class="mb-4">
                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <input type="text" name="isbn" id="isbn" required
                        class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                        placeholder="Enter ISBN">
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                            class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-green-700 transition">
                        🔎 Search
                    </button>
                </div>
            </form>
        </div>

       {{--  <!-- Form Container -->             
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">    
            <form name="search" onsubmit="yourFunction()">
                @csrf
                <!-- ISBN Field -->
                <div class="mb-4">
                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <input type="text" name="isbn" id="isbn" value="" required
                            class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" 
                            placeholder="Muuda pealkirja">
                    @error("search")
                        <div class="error">{{ $message }}</div>
                    @enderror      
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" 
                            class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-green-700 transition">
                        🔎 Search
                    </button>
                </div>
            </form>
        </div>
    </div> --}}

    <div>
        <h2>Otsingutulemus</h2>
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">

            <!-- Title -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">📌 Pealkiri</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm"></p>
            </div>

             <!-- Author(s) -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">📌 Autor(id)</h3>
                <ul class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">
                    {{-- @foreach ()
                        <li>{{}}</li>
                    @endforeach --}}
                </ul>
                   
            </div>

            
            <!-- Action Buttons, VT ÜLE ROUTE või tegevus-->
            <div class="flex justify-end space-x-4 mt-6">
                <a href="" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    ✏️ Salvesta oma riiulile
                </a>
                
            </div>
        </div>
    </div>

</x-app-layout>    

<script>
function yourFunction() {
    const isbn = document.getElementById('isbn').value.trim();
    if (!isbn) return false;
    // window.location.href = "http://openlibrary.org/api/books?bibkeys=ISBN:" + encodeURIComponent(isbn) + "&jscmd=details&format=json";
    window.location.href = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + encodeURIComponent(isbn) + "&key=AIzaSyCaYwHaEy11ly2K-PY2N18EQSfdo_NjnlE";
    return false; // prevent form submission
}
</script>
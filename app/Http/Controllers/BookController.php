<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['authors', 'tags', 'users'])
        ->whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->filter(request()->only('all_book_search'))
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('books.index', [
            "books" => $books,
            
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   //ISBN dash removal
        $isbn = str_replace('-', '', $request->input('isbn'));
        $request->merge([
            'isbn' => $isbn !== '' ? $isbn : null
        ]);

        $validated = $request->validate([
            "title" => "required|string",
            "author" => "required|string",
            'isbn' => [
                'nullable',
                'regex:/^\d{10}$|^\d{13}$/',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $userId = auth()->id();
                        $exists = \App\Models\Book::where('isbn', $value)
                            ->where('user_id', $userId)
                            ->exists();
                        if ($exists) {
                            $fail('Sinu riiulis juba on sellise ISBN-iga raamat');
                        }
                    }
                },
            ],
            "release_year" => "nullable|numeric",
            "pages" => "nullable|numeric",
            "description" => "nullable|string",
            "cover" => "nullable|image",
            "notes" => "nullable|string",
            "tag" => "nullable|string",
            "reading_status" => ['nullable', Rule::in(['read','in progress', 'did not finish', 'wishlist', 'pause', 'to be read'])],

        ]);

        $validated['user_id'] = $request->user()->id;
        
        // echo "<pre>";
        // print_r($request->all()); 

        if ($request->hasFile("cover")) {
            $validated["cover"] = $request->file("cover")->store("books", "public");
        }
        
        // Split author string into array
        $authorNames = array_map('trim', explode(',', $validated['author']));
        
        // Remove author from book fields
        unset($validated['author']);
        
        
        // Create the book first (without author_id because it's many-to-many)
        
        $book = Book::create($validated);
        //dd($request->user()->id);
        
        //Create authors
        $authorIds = [];

        foreach ($authorNames as $authorName) {
        $author = Author::firstOrCreate(['author' => $authorName]);
        $authorIds[] = $author->id;
        }
        
        // Attach authors to the book
        $book->authors()->sync($authorIds);

        // Add user notes and reading status
        $book->users()->attach($request->user()->id, [
            'notes' => $validated['notes'] ?? null,
            'reading_status'=> $validated['reading_status'] ?? null,
        ]);

        // Add tags
        if (!empty($validated['tag'])) {
            //Tag to lowercase, if many tags, split from ,"
            $tagNames = array_filter(array_map(function ($tag) {
                return strtolower(trim($tag));
            }, explode(',', $validated['tag'])));
        
            foreach ($tagNames as $tagName) {
                // Create tag
                $tag = \App\Models\Tag::firstOrCreate(['tag' => $tagName, 'user_id' => $request->user()->id ]);
        
                // Attach tag to book and user
                $book->tags()->syncWithoutDetaching([
                    $tag->id => ['user_id' => $request->user()->id]
                ]);
            }
        }
        //dd($validated);
        return to_route("books.index")->with("success", "Raamat edukalt lisatud");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view("books.show",[
            "book" => $book
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view ("books.edit",[
            "book" => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
         // Normalize ISBN (remove dashes)
        $isbn = str_replace('-', '', $request->input('isbn'));
        $request->merge([
            'isbn' => $isbn !== '' ? $isbn : null
        ]);

        // Validate input
        $validated = $request->validate([
            "title" => "required|string",
            "author" => "required|string", // comma separated authors
            'isbn' => [
                'nullable',
                'regex:/^\d{10}$|^\d{13}$/',
                function ($attribute, $value, $fail) use ($book) {
                    if ($value) {
                        $userId = auth()->id();
                        // Check if another book has this ISBN for this user (exclude current book)
                        $exists = \App\Models\Book::where('isbn', $value)
                            ->where('user_id', $userId)
                            ->where('id', '!=', $book->id)
                            ->exists();
                        if ($exists) {
                            $fail('Sinu riiulis juba on sellise ISBN-iga raamat');
                        }
                    }
                },
            ],
            "publication_year" => "nullable|numeric",
            "pages" => "nullable|numeric",
            "description" => "nullable|string",
            "cover" => "nullable|image",
            "notes" => "nullable|string|max:500",
            "tag" => "nullable|string",
            "reading_status" => ['nullable', Rule::in(['read','in progress', 'did not finish', 'wishlist', 'pause', 'to be read'])],
        ]);

        // Update cover image if uploaded
        if ($request->hasFile("cover")) {
            if ($book->cover) {
                Storage::disk("public")->delete($book->cover);
            }
            $validated["cover"] = $request->file("cover")->store("books", "public");
        }

        
        $book->update([
            "title" => $validated["title"],
            "isbn" => $validated["isbn"] ?? null,
            "publication_year" => $validated["publication_year"] ?? null,
            "pages" => $validated["pages"] ?? null,
            "description" => $validated["description"] ?? null,
            "cover" => $validated["cover"] ?? $book->cover,
        ]);

        // Update authors: parse, create or get ids, sync
        $authorNames = array_map('trim', explode(',', $validated['author']));
        $authorIds = [];
        foreach ($authorNames as $authorName) {
            $author = Author::firstOrCreate(['author' => $authorName]);
            $authorIds[] = $author->id;
        }
        $book->authors()->sync($authorIds);

        // Update pivot table info for user notes and reading status
        $pivotData = [
            'notes' => $validated['notes'] ?? null,
            'reading_status' => $validated['reading_status'] ?? null,
        ];
        $book->users()->syncWithoutDetaching([
            auth()->id() => $pivotData
        ]);

    
      
        $tagInput = $request->input('tag');
        $tagNames = array_filter(array_map('trim', explode(',', strtolower($tagInput))));
        $tagSyncData = [];

        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate([
                'tag' => $tagName,
                'user_id' => $request->user()->id,
            ]);

            // Set user_id in pivot data
            $tagSyncData[$tag->id] = ['user_id' => $request->user()->id];
        }

        // Sync with pivot data
        $book->tags()->sync($tagSyncData);
        
        return to_route("books.show", $book)->with("success", "Raamatu andmed uuendatud");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // $book->authors()->detach();

        if($book->cover){
            Storage::disk("public")->delete($book->cover);
        }

        $book->delete();

        return to_route("books.index")->with("success", "Kirje kustutatud");
    }

    
    public function getBookData(Request $request, Book $book)
    {
        
        $request->validate([
            "isbn" => "required|string",            
        ]);
        
        return view("books.search",[
            "Book" => $book
        ]); 
    }
    public function search()
        {
            $googleBooksApiKey = config('services.google_books.key');
            //dd(compact('googleBooksApiKey'));
            return view('books.search', compact('googleBooksApiKey'));
        }


}

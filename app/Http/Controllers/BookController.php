<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::where("user_id", request()->user()->id)
        ->orderBy("id", "DESC")
        ->paginate(10);

        return view('books.index', [
            "books" => $books 
        ]);
        return "test";
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
    {
        $validated = $request->validate([
            "title" => "required|string",
            "author" => "required|string",
            "description" => "nullable|string",
            "cover" => "nullable|image"
        ]);

        $validated['user_id'] = $request->user()->id;
        
        // echo "<pre>";
        // print_r($request->all()); 

        if ($request->hasFile("cover")) {
            $book_data["cover"] = $request->file("cover")->store("books", "public");
        }
        
        // Split author string into array
        $authorNames = array_map('trim', explode(',', $validated['author']));
        
        // Remove author from book fields
        unset($validated['author']);
        
        
        // Create the book first (without author_id because it's many-to-many)
        $book = Book::create($validated);
        //dd($request->user()->id);
        
        $authorIds = [];

        foreach ($authorNames as $authorName) {
        $author = Author::firstOrCreate(['author' => $authorName]);
        $authorIds[] = $author->id;
        }
        
        // Attach authors to the book
        $book->authors()->sync($authorIds);


        return to_route("books.index")->with("success", "Raamat edukalt lisatud");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

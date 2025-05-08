<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::where("user_id", request()->user()->id)
        ->orderBy("id", "DESC")
        ->paginate(6);

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
            $validated["cover"] = $request->file("cover")->store("books", "public");
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
        $data = $request->validate([
            "title" => "required|string",
            
            "description" => "nullable|string",
            
        ]);

        if($request->hasFile("cover")){
            if($book->cover){
                Storage::disk("public")->delete($book->cover);
            }

            $data["cover"] = $request->file("cover")->store("books", "public");
        }
        
        $book->update($data);

        return to_route("books.show", $book)->with("success", "Kirje uuendatud");
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

    // public function getBookData(Response $response, string $isbn)
    public function getBookData(Request $request, Book $book)
    {
       /*  $response = Http::get('https://www.googleapis.com/books/v1/volumes?q=isbn:', [
            'isbn' => $isbn,
            
            'appid' => config('services.open_weather_map.key'),
            
        ]);

        return $response->json();
         */
        
        $request->validate([
            "isbn" => "required|string",            
        ]);
        
        return view("books.search",[
            "Book" => $book
        ]); 
    }
    


}

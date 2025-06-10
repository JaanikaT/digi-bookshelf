<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    {
        // $recentBooks = Book::orderBy('created_at', 'desc')->take(6)->get();
        //$inProgressBooks = Book::where('reading_status', 'in progress')->get();
        $recentBooks = Book::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('created_at', 'desc')
          ->take(6)
          ->get();

        $inProgressBooks = Book::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id())
                  ->where('book_user.reading_status', 'in progress');
        })->get();

        $completedBooks = Book::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id())
                  ->where('book_user.reading_status', 'read');
        })->get();

        $wishlistBooks = Book::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id())
                  ->where('book_user.reading_status', 'wishlist');
        })->get();

        return view('dashboard', compact('recentBooks', 'inProgressBooks', 'completedBooks', 'wishlistBooks'));
    }

   

    
}

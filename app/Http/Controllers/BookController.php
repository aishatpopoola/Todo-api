<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BookController extends Controller
{
    public function getBooks($book_id = null)
    {
        if ($book_id) {
            $book = Auth::user()->books()->where('book_id', $book_id)->first();
            if (!$book) {
                return response(['error' => 'Not found'], 404);
            }
            return response(
                [ 'book' => $book ],
                200
            );
        } else {
            $books = Auth::user()->books()->get();
            return response(
                [ 'book' => $books ],
                200
            );
        }
    }
}

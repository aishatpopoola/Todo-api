<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Book;
use Illuminate\Validation\Rule;
use Webpatser\Uuid\Uuid;

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

    public function createBook(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:191'],
                'author' => ['required', 'string', 'max:191'],
                'chapters' => ['nullable', 'integer', 'between:1,1000'],
                'genre' => [
                    'required',
                    Rule::in(['romance', 'horror', 'tragedy', 'politics']),
                ],
            ]
        );
        
        $book_id = utf8_encode(Uuid::generate());
        $book = new Book;
        $book->book_id = $book_id;
        $book->user_id = Auth::id();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->chapters = $request->chapters;
        $book->genre = $request->genre;
        $book->save();
        return response(
            [
                'message' => "Book created",
                'token' => $book,
            ],
            201
        );
    }
}

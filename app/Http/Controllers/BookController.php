<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        
        if (isset($request->author_id) && $request->author_id !== 0)
            $books = \App\Models\Book::where('author_id', $request->author_id)->orderBy('title')->get();
        else
            $books = \App\Models\Book::orderBy('title')->get();
        $authors = \App\Models\Author::orderBy('surname')->get();
        return view('books.index', ['books' => $books, 'authors' => $authors]);
    }

    public function create()
    {
        $authors = \App\Models\Author::orderBy('surname')->get();
        return view('books.create', ['authors' => $authors]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'pages' => 'required|max:10',
            'isbn' => 'required|max:10',
            'short_description' => 'required',
            'author_id' => 'required',
        ]);
        $book = new Book();
        $book->fill($request->all());
        $book->save();
        return redirect()->route('book.index');
    }
    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        $authors = \App\Models\Author::orderBy('surname')->get();
        return view('books.edit', ['book' => $book, 'authors' => $authors]);
    }

    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'title' => 'required',
            'pages' => 'required',
            'isbn' => 'required',
            'short_description' => 'required',
            'author_id' => 'required',
        ]);
        $book->fill($request->all());
        $book->save();
        return redirect()->route('book.index');
    }
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index');
    }
}

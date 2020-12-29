<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        // return view('authors.index', ['authors' => Author::orderBy('surname')->get()]);
        if(isset($request->author_id) && $request->author_id !== 0)
            $authors = \App\Models\Author::where('author_id', $request->author_id)->orderBy('surname')->get();
        else
            $authors = \App\Models\Author::orderBy('surname')->get();
        $books = \App\Models\Book::orderBy('title')->get();
        return view('authors.index', ['authors' => $authors, 'books' => $books]);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
        ]);

        $author = new Author();
        $author->fill($request->all());
        return ($author->save() !== 1) ?
            redirect()->route('author.index')->with('status_success', 'Author created!') :
            redirect()->route('author.index')->with('status_error', 'Author was not created!');
    }

    public function show(Author $author)
    {
        //
    }

    public function edit(Author $author)
    {
        return view('authors.edit', ['author' => $author]);
    }


    public function update(Request $request, Author $author)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
        ]);
        $author->fill($request->all());
        // $author->save();
        // return redirect()->route('author.index');

        return ($author->save() !== 1) ?
            redirect()->route('author.index')->with('status_success', 'Author updated!') :
            redirect()->route('author.index')->with('status_error', 'Author was not updated!');
    }
    public function destroy(Author $author)
    {
        if (count($author->books)) {
            return back()->withErrors(['error' => ['Can\'t delete author with books assigned, please unassign books first!']]);
        }
        $author->delete();
        // return redirect()->route('author.index');
        return redirect()->route('author.index')->with('status_success', 'Author deleted!');
    }

    // public function search()
    // {
    //     return view('search.index');
    // }

    // public function autocomplete(Request $request)
    // {
    //     $datas = Author::select("surname")
    //         ->where("surname", "LIKE", "%{$request->terms}%")
    //         ->get();
    //     return response()->json($datas);
    // }
}

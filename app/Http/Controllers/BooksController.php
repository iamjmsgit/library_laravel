<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //
    public function showBooks()
    {
        $books = Books::where('user_id', session('user')->id)->get();

        return view('books', compact('books'));
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'published_year' => 'required',
        ]);

        Books::create([
            'user_id' => session('user')->id,
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'published_year' => $request->published_year


        ]);

        return back()->with('success', 'Book added successfully!');
    }

    public function deleteBook($id)
    {

        $books = Books::where('id', $id)
            ->where('user_id', session('user')->id)
            ->first();

        if (!$books) {
            return back()->with('error', 'Unable to delete record');
        }

        $books->delete();

        return back()->with('success', 'Book deleted sucessfully!');
    }

    public function editBook(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'published_year' => 'required',
        ]);

        $book = Books::where('id', $id)
            ->where('user_id', session('user')->id)
            ->first();

        if (!$book) {
            return back()->with('error', 'Unable to update book');
        }

        $book->fill([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'published_year' => $request->published_year,
        ]);

        if (!$book->isDirty()) {
            return back();
        }

        $book->save();

        return back()->with('success', 'Book updated successfully!');
    }
}

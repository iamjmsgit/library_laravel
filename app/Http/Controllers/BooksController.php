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

        $books = Books::where('id', $id)
            ->where('user_id', session('user')->id)
            ->first();

        if (!$books) {
            return back()->with('error', 'Unable to update book');
        }

        $hasChanges = false;

        if ($request->title != $books->title) {
            $books->title = $request->title;
            $hasChanges = true;
        }

        if ($request->author != $books->author) {
            $books->author = $request->author;
            $hasChanges = true;
        }

        if ($request->category != $books->category) {
            $books->category = $request->category;
            $hasChanges = true;
        }

        if ($request->published_year != $books->published_year) {
            $books->published_year = $request->published_year;
            $hasChanges = true;
        }

        if (!$hasChanges) {
            return back();
        }

        $books->save();

        return back()->with('success', 'Book updated sucessfully!');
    }
}

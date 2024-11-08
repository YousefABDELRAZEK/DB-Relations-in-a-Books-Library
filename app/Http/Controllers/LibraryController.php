<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    public function show() {
        $books = Book::with(['author', 'categories'])->get();
        $authors = Author::all();
        $categories = Category::all();

        return view('index', compact('books', 'authors', 'categories'));
    }


    public function add(Request $request) {

        $validatedData = $request->validate([
            'type' => 'required|in:author,category,book',
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $type = $validatedData['type'];


        if ($type === 'author') {

            Author::create(['name' => $validatedData['name']]);
        } elseif ($type === 'category') {

            Category::create(['name' => $validatedData['name']]);
        } elseif ($type === 'book') {
            
            $book = Book::create([
                'title' => $validatedData['title'],
                'author_id' => $validatedData['author_id'],
                'year' => $validatedData['year'],
            ]);

            // Sync categories if they exist
            $book->categories()->sync($validatedData['categories'] ?? []);
        }

        return redirect()->route('library.show');
    }
}

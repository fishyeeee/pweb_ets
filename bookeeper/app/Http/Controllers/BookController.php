<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    // 🔹 Tampilkan semua buku
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    // 🔹 Form tambah buku
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // 🔹 Simpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|numeric|min:1900|max:' . date('Y'),
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // 🔹 Form edit buku
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // 🔹 Update data buku
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|numeric|min:1900|max:' . date('Y'),
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    // 🔹 Hapus buku
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}

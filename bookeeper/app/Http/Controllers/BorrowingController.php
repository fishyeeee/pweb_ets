<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;

class BorrowingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'expected_return_date' => 'required|date|after:today',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return redirect()->back()->with('error', 'Stok buku tidak tersedia');
        }

        // Kurangi stok
        $book->decrement('stock');

        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now()->toDateString(),
            'expected_return_date' => $request->expected_return_date,
            'status' => 'Dipinjam'
        ]);

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dipinjam');
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status != 'Dipinjam') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan atau terlambat');
        }

        $borrowing->actual_return_date = now()->toDateString();

        if (now()->greaterThan($borrowing->expected_return_date)) {
            $borrowing->status = 'Terlambat';
        } else {
            $borrowing->status = 'Dikembalikan';
        }

        $borrowing->save();

        // Tambah stok buku kembali
        $borrowing->book->increment('stock');

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan');
    }
    
    public function index()
    {
        $borrowings = auth()->user()->borrowings()->with('book')->latest()->get();
        return view('borrowings.index', compact('borrowings'));
    }

}

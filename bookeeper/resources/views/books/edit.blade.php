@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Edit Buku</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label>Penulis</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $book->category_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ $book->stock }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Tambah Buku Baru</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Penulis</label>
            <input type="text" name="author" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text" name="publisher" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="year" class="form-control" placeholder="2020">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" min="0">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

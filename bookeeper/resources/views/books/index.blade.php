<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📚 Daftar Buku
        </h2>
    </x-slot>

    <div class="py-10 px-6">
        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Button Tambah Buku --}}
        <div class="mb-5">
            <a href="{{ route('books.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
               + Tambah Buku
            </a>
        </div>

        {{-- Table --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Judul</th>
                        <th class="py-2 px-4 border-b text-left">Penulis</th>
                        <th class="py-2 px-4 border-b text-center">Stok</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $book->stock }}</td>
                            <td class="py-2 px-4 border-b text-center space-x-2">

                                {{-- Pinjam --}}
                                <form action="{{ route('borrowings.store') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                        Pinjam
                                    </button>
                                </form>

                                {{-- Edit --}}
                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                   Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('books.destroy', $book->id) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Yakin hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Button ke Borrowings --}}
        <div class="mt-6">
            <a href="{{ route('borrowings.index') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded shadow">
               📌 Lihat Buku yang Dipinjam
            </a>
        </div>
    </div>
</x-app-layout>

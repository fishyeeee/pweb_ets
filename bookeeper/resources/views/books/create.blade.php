<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Tambah Buku
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">

            {{-- Error Validation --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg shadow">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Judul Buku</label>
                    <input type="text" name="title"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300"
                           placeholder="Masukkan judul buku" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Penulis</label>
                    <input type="text" name="author"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300"
                           placeholder="Masukkan nama penulis" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Stok</label>
                    <input type="number" name="stock"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300"
                           placeholder="Masukkan jumlah stok" required min="1">
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-between">
                    <a href="{{ route('books.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                       Kembali
                    </a>

                    <button type="submit"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                       Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

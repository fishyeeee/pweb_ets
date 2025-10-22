<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🗂️ Kategori Buku
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-4xl mx-auto">
        
        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Tambah Kategori --}}
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="font-semibold mb-3">Tambah Kategori</h3>
            <form action="{{ route('categories.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="name" placeholder="Nama kategori"
                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300" required>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Nama Kategori</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-2 px-4 border-b">{{ $category->name }}</td>

                            <td class="py-2 px-4 border-b text-center">
                                <form action="{{ route('categories.destroy', $category->id) }}"
                                      method="POST" onsubmit="return confirm('Yakin hapus kategori?')">
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
                            <td colspan="2" class="text-center py-4 text-gray-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Back button --}}
        <div class="mt-6">
            <a href="{{ route('books.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow">
               ← Kembali ke Buku
            </a>
        </div>
    </div>
</x-app-layout>

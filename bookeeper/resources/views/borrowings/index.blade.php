<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📌 Buku yang Kamu Pinjam
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-5xl mx-auto">
        
        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Judul Buku</th>
                        <th class="py-2 px-4 border-b text-center">Pinjam</th>
                        <th class="py-2 px-4 border-b text-center">Max Kembali</th>
                        <th class="py-2 px-4 border-b text-center">Status</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrowings as $borrow)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-2 px-4 border-b">{{ $borrow->book->title }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $borrow->borrow_date }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $borrow->expected_return_date }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $borrow->status }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                @if ($borrow->status == 'Dipinjam')
                                    <form action="{{ route('borrowings.return', $borrow->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin kembalikan buku?')">
                                        @csrf
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                            Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 text-sm">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Belum ada buku yang kamu pinjam.</td>
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

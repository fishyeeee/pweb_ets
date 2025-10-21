<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Judul</th>
                            <th class="py-2 px-4 border-b">Penulis</th>
                            <th class="py-2 px-4 border-b">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                                <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                                <td class="py-2 px-4 border-b">{{ $book->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galeri Before & After') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('galeri.create') }}">
                            <x-primary-button>
                                {{ __('Tambah Galeri') }}
                            </x-primary-button>
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto Sebelum</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto Sesudah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($galeri as $g)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $g->judul }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($g->foto_sebelum)
                                            <img src="{{ asset('storage/' . $g->foto_sebelum) }}" class="h-16 rounded object-cover">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($g->foto_sesudah)
                                            <img src="{{ asset('storage/' . $g->foto_sesudah) }}" class="h-16 rounded object-cover">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                                <a href="{{ route('galeri.edit', $g->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                        <form action="{{ route('galeri.destroy', $g->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus galeri ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

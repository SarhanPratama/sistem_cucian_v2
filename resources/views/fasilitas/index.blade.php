<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Fasilitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-6">
                <a href="{{ route('fasilitas.create') }}">
                    <x-primary-button>
                        {{ __('Tambah Fasilitas') }}
                    </x-primary-button>
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-16">No</th>
                                <th scope="col" class="px-6 py-3 w-20">Ikon</th>
                                <th scope="col" class="px-6 py-3">Judul</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fasilitas as $index => $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div
                                            class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 shadow-sm mx-auto">
                                            <i class="{{ $item->ikon }} text-xl"></i>
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1 break-words w-16 overflow-hidden">
                                            {{ $item->ikon }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $item->judul }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($item->deskripsi, 50) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('fasilitas.edit', $item->id) }}"
                                            class="font-medium text-blue-600 hover:underline mr-3">Edit</a>
                                        <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="font-medium text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data
                                        fasilitas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>

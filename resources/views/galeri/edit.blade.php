<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                            <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Sebelum (Kosongkan jika tidak ingin mengubah)</label>
                            @if($galeri->foto_sebelum)
                                <div class="mb-2">
                                    <p class="text-sm text-gray-600">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $galeri->foto_sebelum) }}" alt="Sebelum" class="w-32 h-32 object-cover rounded mt-1">
                                </div>
                            @endif
                            <input type="file" name="foto_sebelum" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Sesudah (Kosongkan jika tidak ingin mengubah)</label>
                            @if($galeri->foto_sesudah)
                                <div class="mb-2">
                                    <p class="text-sm text-gray-600">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $galeri->foto_sesudah) }}" alt="Sesudah" class="w-32 h-32 object-cover rounded mt-1">
                                </div>
                            @endif
                            <input type="file" name="foto_sesudah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Perbarui
                            </button>
                            <a href="{{ route('galeri.index') }}" class="text-gray-500 hover:text-gray-700">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Fasilitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-6">
                <a href="{{ route('fasilitas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md shadow-sm transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 border-b border-gray-200">
                <form method="POST" action="{{ route('fasilitas.store') }}">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul Fasilitas</label>
                        <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('judul') }}" required>
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ikon -->
                    <div class="mb-4">
                        <label for="ikon" class="block text-sm font-medium text-gray-700">Class Ikon FontAwesome</label>
                        <p class="text-xs text-gray-500 mb-2">Contoh: fas fa-wifi, fas fa-coffee, fas fa-tv. <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="text-blue-500 hover:underline">Cari Ikon</a></p>
                        <div class="flex items-center">
                            <span class="inline-flex items-center justify-center px-3 py-2 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 rounded-l-md w-12 h-[42px]">
                                <i class="fas fa-star" id="icon-preview"></i>
                            </span>
                            <input type="text" name="ikon" id="ikon" class="block w-full rounded-r-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('ikon', 'fas fa-star') }}" required onkeyup="updateIconPreview()">
                        </div>
                        @error('ikon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('fasilitas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md transition">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition">
                            Simpan Fasilitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateIconPreview() {
            const iconInput = document.getElementById('ikon').value;
            document.getElementById('icon-preview').className = iconInput;
        }
        // Set initial preview
        document.addEventListener('DOMContentLoaded', function() {
            updateIconPreview();
        });
    </script>
    @endpush
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="judul">
                                {{ __('Judul Galeri') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi">
                                {{ __('Deskripsi (Opsional)') }}
                            </x-input-label>
                            <textarea id="deskripsi" name="deskripsi" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="foto_sebelum">
                                    {{ __('Foto BEFORE (Sebelum)') }}
                                </x-input-label>
                                <input type="file" name="foto_sebelum" id="foto_sebelum" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm" accept="image/*">
                            </div>
                            <div class="mb-4">
                                <x-input-label for="foto_sesudah">
                                    {{ __('Foto AFTER (Sesudah)') }}
                                </x-input-label>
                                <input type="file" name="foto_sesudah" id="foto_sesudah" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm" accept="image/*">
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('galeri.index') }}" class="mr-4">
                                <x-secondary-button>
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

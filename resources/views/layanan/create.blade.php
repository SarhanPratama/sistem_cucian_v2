<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tambah Layanan') }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Buat paket layanan baru lengkap dengan harga dan kategori yang sesuai.') }}
                </p>
            </div>
            <a href="{{ route('layanan.index') }}">
                <x-secondary-button>
                    {{ __('Kembali ke daftar') }}
                </x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('layanan.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="nama">
                                {{ __('Nama Layanan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="harga">
                                {{ __('Harga') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga')" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="kategori_id">
                                {{ __('Kategori') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <select name="kategori_id" id="kategori_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Layanan Aktif') }}</span>
                            </label>
                            <p class="text-sm text-gray-500 mt-1">{{ __('Layanan nonaktif tidak akan tampil di form booking pelanggan.') }}</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi (Opsional)')" />
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('layanan.index') }}" class="mr-4">
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

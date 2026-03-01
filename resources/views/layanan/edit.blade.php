<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <form action="{{ route('layanan.update', $layanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="nama">
                                {{ __('Nama Layanan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                :value="old('nama', $layanan->nama)" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="harga">
                                {{ __('Harga') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga"
                                :value="old('harga', intval($layanan->harga))" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="kategori_id">
                                {{ __('Kategori') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <select name="kategori_id" id="kategori_id"
                                class="border-gray-300 focus:border-indigo-500 :border-indigo-600 focus:ring-indigo-500 :ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ old('kategori_id', $layanan->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                        <div class="mb-4 block">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', (isset($layanan) ? $layanan->is_active : true)) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Layanan Aktif') }}</span>
                            </label>
                            <p class="text-sm text-gray-500 mt-1">Layanan non-aktif tidak akan muncul di form booking pelanggan.</p>
                        </div>

                            <x-input-label for="deskripsi" :value="__('Deskripsi (Opsional)')" />
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="border-gray-300 focus:border-indigo-500 :border-indigo-600 focus:ring-indigo-500 :ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('layanan.index') }}" class="mr-4">
                                <x-secondary-button>
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

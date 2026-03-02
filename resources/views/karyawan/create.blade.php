<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tambah Karyawan') }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Tambah staf baru yang siap melayani pelanggan di cabang Anda.') }}
                </p>
            </div>
            <a href="{{ route('karyawan.index') }}">
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
                    <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="nama">
                                {{ __('Nama') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="no_hp">
                                {{ __('No HP') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')" required />
                            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="status">
                                {{ __('Status') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="foto">
                                {{ __('Foto Karyawan') }}
                            </x-input-label>
                            <input type="file" name="foto" id="foto" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" accept="image/*">
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('karyawan.index') }}" class="mr-4">
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

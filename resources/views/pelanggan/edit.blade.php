<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Pelanggan') }}
                </h2>

            </div>
            <a href="{{ route('pelanggan.index') }}">
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
                    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="nama">
                                {{ __('Nama Pelanggan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $pelanggan->nama)" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="no_hp">
                                {{ __('No HP') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp', $pelanggan->no_hp)" required />
                            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat (Opsional)')" />
                            <textarea name="alamat" id="alamat" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('pelanggan.index') }}" class="mr-4">
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

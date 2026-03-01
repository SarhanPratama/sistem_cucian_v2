<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi Profil Toko') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('profil_toko.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informasi Dasar -->
                            <div class="border p-4 rounded-md">
                                <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Informasi Dasar</h3>

                                <div class="mb-4">
                                    <x-input-label for="nama_toko" value="Nama Toko" />
                                    <x-text-input id="nama_toko" name="nama_toko" type="text" class="mt-1 block w-full" :value="old('nama_toko', $profil->nama_toko)" required />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="hero_title" value="Judul Utama (Hero)" />
                                    <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1 block w-full" :value="old('hero_title', $profil->hero_title)" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="hero_subtitle" value="Subjudul Utama" />
                                    <textarea id="hero_subtitle" name="hero_subtitle" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="2">{{ old('hero_subtitle', $profil->hero_subtitle) }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="tentang_kami" value="Tentang Kami (Cerita / Visi Misi)" />
                                    <textarea id="tentang_kami" name="tentang_kami" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('tentang_kami', $profil->tentang_kami) }}</textarea>
                                </div>
                            </div>

                            <!-- Kontak & Lokasi -->
                            <div class="border p-4 rounded-md">
                                <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Kontak & Lokasi</h3>

                                <div class="mb-4">
                                    <x-input-label for="no_telepon" value="No. Telepon" />
                                    <x-text-input id="no_telepon" name="no_telepon" type="text" class="mt-1 block w-full" :value="old('no_telepon', $profil->no_telepon)" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="whatsapp" value="WhatsApp (Opsional)" />
                                    <x-text-input id="whatsapp" name="whatsapp" type="text" class="mt-1 block w-full" :value="old('whatsapp', $profil->whatsapp)" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="email" value="Email" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $profil->email)" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="alamat" value="Alamat Lengkap" />
                                    <textarea id="alamat" name="alamat" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="2">{{ old('alamat', $profil->alamat) }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="url_embed" value="URL Embed Google Maps (iframe src)" />
                                    <textarea id="url_embed" name="url_embed" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="2" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('url_embed', $profil->url_embed) }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="url_map" value="Link Google Maps (Share)" />
                                    <textarea id="url_map" name="url_map" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="2" placeholder="https://maps.app.goo.gl/... ">{{ old('url_map', $profil->url_map) }}</textarea>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <x-input-label for="facebook" value="Link Facebook" />
                                        <x-text-input id="facebook" name="facebook" type="url" class="mt-1 block w-full" placeholder="https://facebook.com/..." :value="old('facebook', $profil->facebook)" />
                                    </div>
                                    <div>
                                        <x-input-label for="instagram" value="Link Instagram" />
                                        <x-text-input id="instagram" name="instagram" type="url" class="mt-1 block w-full" placeholder="https://instagram.com/..." :value="old('instagram', $profil->instagram)" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="jam_buka_pekan" value="Jam Buka Hari Kerja" />
                                        <x-text-input id="jam_buka_pekan" name="jam_buka_pekan" type="text" class="mt-1 block w-full" placeholder="ex: 08.00 - 20.00" :value="old('jam_buka_pekan', $profil->jam_buka_pekan)" />
                                    </div>
                                    <div>
                                        <x-input-label for="jam_buka_akhir_pekan" value="Jam Buka Akhir Pekan" />
                                        <x-text-input id="jam_buka_akhir_pekan" name="jam_buka_akhir_pekan" type="text" class="mt-1 block w-full" placeholder="ex: 07.00 - 21.00" :value="old('jam_buka_akhir_pekan', $profil->jam_buka_akhir_pekan)" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="pelanggan_id">
                                {{ __('Pelanggan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <select name="pelanggan_id" id="pelanggan_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }} ({{ $p->no_hp }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('pelanggan_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="kategori_id">
                                {{ __('Kategori Kendaraan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <select name="kategori_id" id="kategori_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="layanan_id">
                                {{ __('Layanan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <select name="layanan_id" id="layanan_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full bg-gray-100" required disabled>
                                <option value="">-- Pilih Kategori Terlebih Dahulu --</option>
                            </select>
                            <x-input-error :messages="$errors->get('layanan_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="plat_nomor">
                                {{ __('Plat Nomor Kendaraan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="plat_nomor" class="block mt-1 w-full uppercase" type="text" name="plat_nomor" :value="old('plat_nomor')" placeholder="Contoh: B 1234 ABC" required />
                            <x-input-error :messages="$errors->get('plat_nomor')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="waktu_pesan">
                                {{ __('Estimasi Tiba') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-text-input id="waktu_pesan" class="block mt-1 w-full" type="datetime-local" name="waktu_pesan" :value="old('waktu_pesan', now()->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('waktu_pesan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="catatan" :value="__('Catatan (Opsional)')" />
                            <textarea name="catatan" id="catatan" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" placeholder="Contoh: Jangan pakai semir ban">{{ old('catatan') }}</textarea>
                            <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('transaksi.index') }}" class="mr-4">
                                <x-secondary-button>
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                                {{ __('Buat Transaksi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('kategori_id').addEventListener('change', function() {
            let kategoriId = this.value;
            let layananSelect = document.getElementById('layanan_id');

            if (kategoriId) {
                layananSelect.disabled = true;
                layananSelect.innerHTML = '<option value="">Loading...</option>';

                fetch(`/get-layanan/${kategoriId}`)
                    .then(response => response.json())
                    .then(data => {
                        layananSelect.innerHTML = '<option value="">-- Pilih Layanan --</option>';
                        data.forEach(layanan => {
                            let harga = new Intl.NumberFormat('id-ID').format(layanan.harga);
                            layananSelect.innerHTML += `<option value="${layanan.id}">${layanan.nama} - Rp ${harga}</option>`;
                        });
                        layananSelect.disabled = false;
                        layananSelect.classList.remove('bg-gray-100');
                        layananSelect.classList.add('bg-white');
                    })
                    .catch(error => {
                        console.error('Error fetching layanan:', error);
                        layananSelect.innerHTML = '<option value="">Gagal memuat layanan</option>';
                    });
            } else {
                layananSelect.innerHTML = '<option value="">-- Pilih Kategori Terlebih Dahulu --</option>';
                layananSelect.disabled = true;
                layananSelect.classList.add('bg-gray-100');
                layananSelect.classList.remove('bg-white');
            }
        });
    </script>
    @endpush
</x-app-layout>

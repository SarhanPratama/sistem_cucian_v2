<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Status Transaksi: ') }} {{ $transaksi->nomor_antrian }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Informasi Transaksi -->
                    <div class="mb-6 bg-gray-50 p-6 rounded-lg border border-gray-200 shadow-sm">
                        <div class="flex justify-between items-center border-b pb-4 mb-4">
                            <h3 class="font-bold text-xl text-gray-800">Detail Transaksi</h3>
                            <span class="bg-indigo-100 text-indigo-800 text-sm font-bold px-3 py-1 rounded-full">
                                {{ $transaksi->nomor_antrian }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Pelanggan</p>
                                    <p class="font-semibold text-gray-800">{{ $transaksi->pelanggan->nama }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Plat Nomor</p>
                                    <p class="font-semibold text-gray-800">{{ $transaksi->plat_nomor }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Waktu Pesan</p>
                                    <p class="font-semibold text-gray-800">{{ $transaksi->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Estimasi Tiba</p>
                                    <p class="font-semibold text-gray-800">{{ $transaksi->estimasi_tiba ? $transaksi->estimasi_tiba->format('d M Y H:i') : '-' }}</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Layanan</p>
                                    <p class="font-semibold text-gray-800">{{ $transaksi->layanan->nama }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kategori Kendaraan</p>
                                    <p class="font-semibold text-gray-800">{{ $transaksi->layanan->kategori->nama ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Harga</p>
                                    <p class="font-bold text-green-600">Rp {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="md:col-span-2 pt-3 border-t border-gray-200 mt-2">
                                <p class="text-sm text-gray-500">Catatan Pelanggan</p>
                                <p class="font-medium text-gray-700 italic">{{ $transaksi->catatan ?: 'Tidak ada catatan' }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="status">
                                {{ __('Status Pengerjaan') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="menunggu" {{ old('status', $transaksi->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ old('status', $transaksi->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ old('status', $transaksi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ old('status', $transaksi->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="karyawan_id" :value="__('Karyawan yang Mengerjakan')" />
                            <select name="karyawan_id" id="karyawan_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">-- Belum Ditentukan --</option>
                                @foreach($karyawan as $k)
                                    <option value="{{ $k->id }}" {{ old('karyawan_id', $transaksi->karyawan_id) == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 mt-1">*Wajib diisi jika status diubah menjadi Diproses atau Selesai.</p>
                            <x-input-error :messages="$errors->get('karyawan_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('transaksi.index') }}" class="mr-4">
                                <x-secondary-button>
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                                {{ __('Update Status') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

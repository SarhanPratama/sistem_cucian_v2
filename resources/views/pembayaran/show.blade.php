<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Informasi Transaksi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nomor Antrian</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->nomor_antrian }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Waktu Pesan</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Pelanggan</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->pelanggan->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Plat Nomor</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->plat_nomor }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Layanan</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->layanan->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kategori Kendaraan</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->layanan->kategori->nama ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Estimasi Tiba</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->estimasi_tiba ? $pembayaran->transaksi->estimasi_tiba->format('d M Y H:i') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Karyawan</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->karyawan ? $pembayaran->transaksi->karyawan->nama : '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500">Catatan</p>
                                <p class="font-semibold">{{ $pembayaran->transaksi->catatan ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Informasi Pembayaran</h3>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Total Bayar</p>
                                    <p class="text-xl font-bold text-green-600">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Metode Pembayaran</p>
                                    <p class="font-semibold capitalize">{{ $pembayaran->metode_pembayaran }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <p class="font-semibold">
                                        @if($pembayaran->status_pembayaran == 'sudah_dibayar')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Lunas
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Belum Dibayar
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Waktu Bayar</p>
                                    <p class="font-semibold">{{ $pembayaran->waktu_bayar ? $pembayaran->waktu_bayar->format('d M Y H:i') : '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('pembayaran.index') }}">
                            <x-secondary-button>
                                {{ __('Kembali') }}
                            </x-secondary-button>
                        </a>
                        {{-- <button onclick="window.print()" class="ml-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cetak Struk') }}
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

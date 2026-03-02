<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi: ') }} {{ $transaksi->nomor_antrian }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 text-gray-900">
                    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nomor Antrian</p>
                                <p class="text-2xl font-bold text-indigo-700">{{ $transaksi->nomor_antrian }}</p>
                                <p class="text-sm text-gray-500 mt-1">Tanggal: {{ $transaksi->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                @php
                                    $color = match($transaksi->status) {
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'dibatalkan' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $color }}">
                                    {{ ucfirst($transaksi->status) }}
                                </span>
                                @if($transaksi->karyawan)
                                    <p class="text-xs text-gray-500 mt-1">Dikerjakan oleh {{ $transaksi->karyawan->nama }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 text-sm text-gray-600">
                            <div class="space-y-2">
                                <p class="font-semibold text-gray-800">Pelanggan</p>
                                <p>{{ $transaksi->pelanggan->nama }} ({{ $transaksi->pelanggan->no_hp }})</p>
                                <p class="text-xs text-gray-400">{{ $transaksi->pelanggan->alamat ?? 'Alamat belum tersedia' }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="font-semibold text-gray-800">Kendaraan</p>
                                <p>{{ $transaksi->plat_nomor }}</p>
                                <p class="text-xs text-gray-400">Diperkirakan tiba {{ $transaksi->estimasi_tiba->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 text-sm text-gray-600">
                            <div class="space-y-2">
                                <p class="font-semibold text-gray-800">Layanan</p>
                                <p>{{ $transaksi->layanan->nama }} ({{ $transaksi->layanan->kategori->nama ?? '-' }})</p>
                                <p class="text-sm text-green-600 font-bold">Rp {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="font-semibold text-gray-800">Catatan</p>
                                <p class="text-gray-700">{{ $transaksi->catatan ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-100 rounded-2xl p-4 bg-gray-50">
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-semibold text-gray-700">Riwayat Status</p>
                            <span class="text-xs text-gray-500">Terakhir diperbarui {{ $transaksi->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Status saat ini</p>
                                <p class="text-base font-semibold text-gray-800">{{ ucfirst($transaksi->status) }}</p>
                            </div>
                            {{-- <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Estimasi tiba</p>
                                <p class="text-base text-gray-800">{{ $transaksi->estimasi_tiba->format('d M Y H:i') }}</p>
                            </div> --}}
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('transaksi.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                            ← Kembali
                        </a>
                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white text-sm font-semibold shadow-sm hover:bg-indigo-500 transition">
                            Update Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

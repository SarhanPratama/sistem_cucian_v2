@extends('layouts.frontend')

@section('title', 'Cek Status Antrean - AutoClean')

@section('content')
    <!-- Status Section -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-purple-600 px-6 py-8 text-center text-white">
                <h2 class="text-3xl font-bold mb-2">Cek Status Antrean</h2>
                <p>Masukkan Nomor Antrean atau Plat Nomor Anda.</p>
            </div>

            <div class="p-4">
                <form action="{{ route('booking.status') }}" method="GET" class="space-y-6 mb-8">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Nomor Antrean / Plat Nomor</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" required
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm border p-3 uppercase"
                                placeholder="Contoh: ANT-001 atau BM 1234 AB">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-purple-500 hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        Cari Antrean
                    </button>
                </form>

                @if(request()->has('search'))
                    <div class="border-t border-gray-200 pt-6">
                        @if($transaksi)
                            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $transaksi->nomor_antrian }}</h3>
                                    @php
                                        $statusColors = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                                            'diproses' => 'bg-blue-100 text-blue-800',
                                            'selesai' => 'bg-green-100 text-green-800',
                                            'dibatalkan' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusColor = $statusColors[$transaksi->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }} uppercase">
                                        {{ $transaksi->status }}
                                    </span>
                                </div>

                                <dl class="space-y-4 text-sm">
                                    <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                        <dt class="text-gray-500 mb-1 sm:mb-0">Nama</dt>
                                        <dd class="font-medium text-gray-900 sm:text-right">{{ $transaksi->pelanggan->nama }}</dd>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                        <dt class="text-gray-500 mb-1 sm:mb-0">Plat Nomor</dt>
                                        <dd class="font-medium text-gray-900 uppercase sm:text-right">{{ $transaksi->plat_nomor }}</dd>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                        <dt class="text-gray-500 mb-1 sm:mb-0">Kategori</dt>
                                        <dd class="font-medium text-gray-900 sm:text-right">{{ $transaksi->layanan->kategori->nama ?? '-' }}</dd>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                        <dt class="text-gray-500 mb-1 sm:mb-0">Layanan</dt>
                                        <dd class="font-medium text-gray-900 sm:text-right">{{ ucfirst($transaksi->layanan->nama) }}</dd>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                        <dt class="text-gray-500 mb-1 sm:mb-0">Waktu Pesan</dt>
                                        <dd class="font-medium text-gray-900 sm:text-right">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</dd>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                        <dt class="text-gray-500 mb-1 sm:mb-0">Estimasi Tiba</dt>
                                        <dd class="font-medium text-gray-900 sm:text-right">{{ \Carbon\Carbon::parse($transaksi->waktu_pesan)->format('d M Y, H:i') }}</dd>
                                    </div>
                                    @if($transaksi->catatan)
                                    <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                        <dt class="text-gray-500 mb-1 sm:mb-0">Catatan</dt>
                                        <dd class="font-medium text-gray-900 sm:text-right">{{ $transaksi->catatan }}</dd>
                                    </div>
                                    @endif
                                    <div class="flex flex-col sm:flex-row sm:justify-between pt-3 border-t border-gray-200">
                                        <dt class="text-gray-500 font-semibold mb-1 sm:mb-0">Total Biaya</dt>
                                        <dd class="font-bold text-emerald-600 text-lg sm:text-right">Rp {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}</dd>
                                    </div>
                                </dl>

                                @if($transaksi->status == 'selesai')
                                    <div class="mt-6 text-center">
                                        <p class="text-sm text-green-600 font-medium mb-2"><i class="fas fa-check-circle mr-1"></i> Kendaraan Anda sudah selesai dicuci!</p>
                                        <p class="text-xs text-gray-500">Silakan menuju kasir untuk melakukan pembayaran.</p>
                                    </div>
                                @elseif($transaksi->status == 'menunggu')
                                    <div class="mt-6 text-center">
                                        <p class="text-sm text-yellow-600 font-medium"><i class="fas fa-clock mr-1"></i> Harap datang sesuai estimasi waktu.</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 text-red-500 mb-4">
                                    <i class="fas fa-search-minus text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-1">Antrean Tidak Ditemukan</h3>
                                <p class="text-sm text-gray-500">Pastikan Nomor Antrean atau Plat Nomor yang Anda masukkan benar.</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </main>


@endsection

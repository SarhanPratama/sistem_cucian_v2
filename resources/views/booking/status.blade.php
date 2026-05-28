@extends('layouts.frontend')

@section('title', 'Antrian Aktif - AutoClean')

@section('content')
    @php
        $menunggu = $antrianAktif->where('status', 'menunggu')->count();
        $diproses = $antrianAktif->where('status', 'diproses')->count();
    @endphp

    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <section class="text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-100 text-purple-700 text-sm font-semibold mb-4">
                    <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                    Antrian yang sedang berjalan
                </div>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-3">Cek Status Antrian</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berikut daftar semua kendaraan yang masih menunggu atau sedang diproses.
                </p>
            </section>

            <section class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                    <p class="text-sm text-gray-500 mb-1">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $menunggu }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                    <p class="text-sm text-gray-500 mb-1">Diproses</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $diproses }}</p>
                </div>
            </section>

            <section class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Antrian Aktif</h2>
                        <p class="text-sm text-gray-500">Urutan dibuat berdasarkan status dan waktu pendaftaran.</p>
                    </div>
                    <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center rounded-full bg-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-purple-700 transition">
                        Booking Baru
                    </a>
                </div>

                <div class="p-6">
                    @forelse($antrianAktif as $index => $transaksi)
                        @php
                            $statusColor = match($transaksi->status) {
                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                'diproses' => 'bg-blue-100 text-blue-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp

                        <div class="mb-4 last:mb-0 rounded-2xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-md transition p-5">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-purple-600 text-white flex items-center justify-center font-bold shadow">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-2">
                                            <h3 class="text-lg font-bold text-gray-900">{{ $transaksi->nomor_antrian }}</h3>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }} uppercase">
                                                {{ $transaksi->status }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-semibold text-gray-800">{{ $transaksi->pelanggan->nama }}</span>
                                            <span class="mx-2 text-gray-300">|</span>
                                            {{ $transaksi->plat_nomor }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $transaksi->layanan->nama }}
                                            @if($transaksi->layanan->kategori)
                                                · {{ $transaksi->layanan->kategori->nama }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm lg:text-right">
                                    <div>
                                        <p class="text-gray-500">Waktu Pesan</p>
                                        <p class="font-semibold text-gray-900">{{ $transaksi->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Estimasi Tiba</p>
                                        <p class="font-semibold text-gray-900">{{ $transaksi->estimasi_tiba ? $transaksi->estimasi_tiba->format('d M Y H:i') : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Harga</p>
                                        <p class="font-semibold text-emerald-600">Rp {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <i class="fas fa-clipboard-list text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada antrian aktif</h3>
                            <p class="text-gray-500 mb-6">Semua transaksi sudah selesai atau belum ada booking yang masuk.</p>
                            <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center rounded-full bg-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-purple-700 transition">
                                Booking Sekarang
                            </a>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
@endsection

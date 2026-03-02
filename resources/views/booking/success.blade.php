@extends('layouts.frontend')

@section('title', 'Booking Berhasil - AutoClean')

@section('content')
    <!-- Success Section -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-purple-600 px-6 py-10 text-center text-white relative">
                <div class="relative z-10">
                    <div
                        class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-white text-emerald-500 mb-4 shadow-lg">
                        <i class="fas fa-check text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">Booking Berhasil!</h2>
                    <p>Terima kasih telah memesan layanan kami.</p>
                </div>
            </div>

            <div class="p-8">
                <div class="text-center mb-8">
                    <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold mb-2">Nomor Antrean Anda</p>
                    <div
                        class="inline-flex items-center bg-gray-100 rounded-xl px-4 sm:px-6 py-3 sm:py-4 border-2 border-dashed border-gray-300 relative group">
                        <span id="nomorAntrian"
                            class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 tracking-widest mr-2 sm:mr-4">{{ $transaksi->nomor_antrian }}</span>
                        <button onclick="copyToClipboard()"
                            class="text-gray-500 hover:text-purple-600 transition focus:outline-none"
                            title="Salin Nomor Antrean">
                            <i class="fas fa-copy text-xl"></i>
                        </button>
                        <span id="copyTooltip"
                            class="absolute -top-8 right-0 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 transition-opacity duration-300 pointer-events-none">Tersalin!</span>
                    </div>
                    <p class="mt-3 text-sm text-gray-500">Harap simpan atau screenshot nomor antrean ini.</p>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pesanan</h3>
                    <dl class="space-y-4 text-sm">
                        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                            <dt class="text-gray-500 mb-1 sm:mb-0">Nama Pelanggan</dt>
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
                            <dd class="font-medium text-gray-900 sm:text-right">{{ $transaksi->layanan->nama }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                            <dt class="text-gray-500 mb-1 sm:mb-0">Waktu Pesan</dt>
                            <dd class="font-medium text-gray-900 sm:text-right">
                                {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                            <dt class="text-gray-500 mb-1 sm:mb-0">Estimasi Kedatangan</dt>
                            <dd class="font-medium text-gray-900 sm:text-right">
                                {{ \Carbon\Carbon::parse($transaksi->estimasi_tiba)->format('d M Y, H:i') }}</dd>
                        </div>
                        @if ($transaksi->catatan)
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                                <dt class="text-gray-500 mb-1 sm:mb-0">Catatan</dt>
                                <dd class="font-medium text-gray-900 sm:text-right">{{ $transaksi->catatan }}</dd>
                            </div>
                        @endif
                        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-2 sm:border-0 sm:pb-0">
                            <dt class="text-gray-500 mb-1 sm:mb-0">Status</dt>
                            <dd class="font-medium text-yellow-600 uppercase sm:text-right">{{ $transaksi->status }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between pt-3 border-t border-gray-200">
                            <dt class="text-gray-500 font-semibold mb-1 sm:mb-0">Total Biaya</dt>
                            <dd class="font-bold text-emerald-600 text-lg sm:text-right">Rp
                                {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400 mt-0.5"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Perhatian:</strong> Harap segera membawa kendaraan Anda ke tempat cucian sesuai dengan waktu estimasi kedatangan. Tunjukkan nomor antrean ini kepada petugas kami.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 space-y-3">
                    <a href="{{ route('booking.status') }}"
                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                        <i class="fas fa-search mr-2"></i> Cek Status Antrean
                    </a>
                    <a href="{{ url('/') }}"
                        class="w-full flex justify-center items-center py-3 px-4 border border-gray-300 rounded-full shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        function copyToClipboard() {
            const nomorAntrian = document.getElementById('nomorAntrian').innerText;
            navigator.clipboard.writeText(nomorAntrian).then(() => {
                const tooltip = document.getElementById('copyTooltip');
                tooltip.classList.remove('opacity-0');
                setTimeout(() => {
                    tooltip.classList.add('opacity-0');
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin teks: ', err);
            });
        }
    </script>
@endpush

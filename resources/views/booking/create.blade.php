@extends('layouts.frontend')

@section('title', 'Booking Antrean - AutoClean')

@section('content')
    <!-- Form Section -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-purple-600 px-6 py-8 text-center text-white">
                <h2 class="text-3xl font-bold mb-2">Booking Antrean</h2>
                <p class="text-purple-100">Isi form di bawah untuk memesan jadwal cuci kendaraan Anda.</p>
            </div>

            <div class="p-8">
                @if (session('error'))
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <ul class="text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-3">
                    @csrf

                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm border p-2.5"
                                placeholder="Masukkan nama Anda">
                        </div>
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fab fa-whatsapp text-gray-400"></i>
                            </div>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm border p-2.5"
                                placeholder="Contoh: 081234567890">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Digunakan untuk melacak riwayat cuci Anda.</p>
                    </div>

                    <div>
                        <label for="plat_nomor" class="block text-sm font-medium text-gray-700 mb-1">Plat Nomor Kendaraan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-car text-gray-400"></i>
                            </div>
                            <input type="text" name="plat_nomor" id="plat_nomor" value="{{ old('plat_nomor') }}" required
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm border p-2.5 uppercase"
                                placeholder="Contoh: BM 1234 AB">
                        </div>
                    </div>

                    <div>
                        <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kategori Kendaraan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <select name="kategori_id" id="kategori_id" required
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm border p-2.5 bg-white">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{  $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="layanan_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Layanan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-concierge-bell text-gray-400"></i>
                            </div>
                            <select name="layanan_id" id="layanan_id" required disabled
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm border p-2.5 bg-gray-100">
                                <option value="">-- Pilih Kategori Terlebih Dahulu --</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="estimasi_tiba" class="block text-sm font-medium text-gray-700 mb-1">Estimasi Waktu Kedatangan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                            <input type="datetime-local" name="estimasi_tiba" id="estimasi_tiba" value="{{ old('estimasi_tiba', now()->format('Y-m-d\TH:i')) }}" required
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm border p-2.5">
                        </div>
                    </div>

                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                <i class="fas fa-comment-alt text-gray-400"></i>
                            </div>
                            <textarea name="catatan" id="catatan" rows="3"
                                class="pl-10 block w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm border p-2.5"
                                placeholder="Contoh: Tolong bersihkan bagian bagasi dengan detail">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
                        Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const kategoriSelect = document.getElementById('kategori_id');
    const layananSelect = document.getElementById('layanan_id');

    // 1. Ambil nilai old() dari Blade dan simpan ke variabel JS
    const oldKategoriId = "{{ old('kategori_id') }}";
    const oldLayananId = "{{ old('layanan_id') }}";

    // 2. Buat fungsi terpisah agar bisa dipanggil saat 'change' maupun saat 'page load'
    function loadLayanan(kategoriId, selectedLayananId = null) {
        if (kategoriId) {
            layananSelect.disabled = true;
            layananSelect.innerHTML = '<option value="">Loading...</option>';

            fetch(`/get-layanan/${kategoriId}`)
                .then(response => response.json())
                .then(data => {
                    layananSelect.innerHTML = '<option value="">-- Pilih Layanan --</option>';
                    data.forEach(layanan => {
                        let harga = new Intl.NumberFormat('id-ID').format(layanan.harga);

                        // Cek apakah ID layanan ini sama dengan old('layanan_id')
                        let isSelected = (selectedLayananId == layanan.id) ? 'selected' : '';

                        layananSelect.innerHTML += `<option value="${layanan.id}" ${isSelected}>${layanan.nama} - Rp ${harga}</option>`;
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
    }

    // 3. Event Listener saat user mengganti kategori secara manual
    kategoriSelect.addEventListener('change', function() {
        loadLayanan(this.value);
    });

    // 4. TRIGGER OTOMATIS SAAT HALAMAN DIMUAT (Jika ada error validasi)
    if (oldKategoriId) {
        // Panggil fungsi dengan mengirimkan ID kategori dan ID layanan yang lama
        loadLayanan(oldKategoriId, oldLayananId);
    }
});
</script>
@endpush

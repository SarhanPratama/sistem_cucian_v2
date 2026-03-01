<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proses Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="transaksi_id" :value="__('Pilih Transaksi (Belum Dibayar)')" />
                            <select name="transaksi_id" id="transaksi_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required onchange="updateTotal()">
                                <option value="">-- Pilih Transaksi --</option>
                                @foreach($transaksi as $t)
                                    <option value="{{ $t->id }}" data-harga="{{ $t->layanan->harga }}" {{ old('transaksi_id', $transaksi_id) == $t->id ? 'selected' : '' }}>
                                        {{ $t->nomor_antrian }} - {{ $t->pelanggan->nama }} ({{ $t->plat_nomor }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('transaksi_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="total_bayar_display" :value="__('Total Tagihan')" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="text" id="total_bayar_display" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full pl-10 bg-gray-100" readonly value="0">
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="metode_pembayaran" :value="__('Metode Pembayaran')" />
                            <select name="metode_pembayaran" id="metode_pembayaran" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                <option value="qris" {{ old('metode_pembayaran') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            </select>
                            <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('pembayaran.index') }}" class="mr-4">
                                <x-secondary-button>
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                                {{ __('Proses Pembayaran') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTotal() {
            const select = document.getElementById('transaksi_id');
            const display = document.getElementById('total_bayar_display');

            if (select.selectedIndex > 0) {
                const option = select.options[select.selectedIndex];
                const harga = option.getAttribute('data-harga');

                // Format number to IDR
                display.value = new Intl.NumberFormat('id-ID').format(harga);
            } else {
                display.value = '0';
            }
        }

        // Run on load in case there's an old value or pre-selected value
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
        });
    </script>
</x-app-layout>

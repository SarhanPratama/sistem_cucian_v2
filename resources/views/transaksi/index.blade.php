<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Data Transaksi & Antrian') }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Pantau antrean kendaraan yang masuk, lihat estimasi tiba, dan kelola status pengerjaan secara real-time.') }}
                </p>
            </div>
            <a href="{{ route('transaksi.create') }}">
                <x-primary-button>
                    {{ __('Tambah Transaksi') }}
                </x-primary-button>
            </a>
        </div>
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

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" data-datatable>
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Antrian</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estimasi Tiba</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Karyawan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($transaksi as $t)
                                <tr class="hover:bg-gray-50 cursor-pointer">
                                    <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $t->nomor_antrian }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $t->pelanggan->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $t->layanan->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $isLate = $t->status === 'menunggu' && $t->estimasi_tiba->diffInMinutes(now(), false) > 30;
                                        @endphp
                                        <span class="{{ $isLate ? 'text-red-600 font-bold' : '' }}">
                                            {{ $t->estimasi_tiba->format('d/m/Y H:i') }}
                                        </span>
                                        @if($isLate)
                                            <br><span class="text-xs text-red-500">Terlambat > 30 mnt</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $color = match($t->status) {
                                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                                'diproses' => 'bg-blue-100 text-blue-800',
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'dibatalkan' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                            {{ ucfirst($t->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $t->karyawan ? $t->karyawan->nama : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('transaksi.show', $t->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                                        <a href="{{ route('transaksi.edit', $t->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Update Status</a>

                                        @if($t->status === 'menunggu')
                                            <form action="{{ route('transaksi.update', $t->id) }}" method="POST" class="inline-block mr-3">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="dibatalkan">
                                                <button type="submit" class="text-yellow-600 hover:text-yellow-900" onclick="return confirm('Batalkan transaksi ini karena pelanggan terlambat?')">Batal</button>
                                            </form>
                                        @endif

                                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

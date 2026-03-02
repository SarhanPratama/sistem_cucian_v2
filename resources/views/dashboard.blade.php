<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="text-sm text-gray-500">
                {{ __('Ringkasan metrik utama untuk memantau operasional toko secara cepat.') }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Pelanggan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">
                                Total Pelanggan
                            </p>
                            <p class="text-2xl font-bold">
                                {{ $totalPelanggan }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Layanan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="w-8 h-8"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M13 5h8" />
                                <path d="M13 9h5" />
                                <path d="M13 15h8" />
                                <path d="M13 19h5" />
                                <path
                                    d="M3 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" />
                                <path
                                    d="M3 15a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">
                                Total Layanan
                            </p>
                            <p class="text-2xl font-bold">
                                {{ $totalLayanan }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Karyawan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M5 20h4l1-4h4l1 4h4" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">
                                Total Karyawan
                            </p>
                            <p class="text-2xl font-bold">
                                {{ $totalKaryawan }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M4 7h16" />
                                <path d="M4 12h10" />
                                <path d="M4 17h7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">
                                Total Kategori
                            </p>
                            <p class="text-2xl font-bold">
                                {{ $totalKategori }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total transaksi hari ini -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">
                                Transaksi Hari Ini
                            </p>
                            <p class="text-2xl font-bold">
                                {{ $transaksiHariIni }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Antrian Menunggu -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">
                                Antrian Menunggu
                            </p>
                            <p class="text-2xl font-bold">
                                {{ $transaksiMenunggu }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

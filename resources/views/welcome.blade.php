@extends('layouts.frontend')

@section('content')
        <!-- Hero Section -->
    <section id="home" class="relative w-full h-[85vh] min-h-[500px] bg-gray-900 overflow-hidden">
        <!-- Include Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <!-- Swiper Container -->
        <div class="swiper myHeroSwiper w-full h-full">
            <div class="swiper-wrapper">

                @forelse($banners as $banner)
                <div class="swiper-slide relative bg-gray-900">
                    <img src="{{ Storage::url($banner->gambar) }}" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay" alt="{{ $banner->judul }}">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center px-4 max-w-4xl z-10" data-swiper-parallax="-300">
                            @if($banner->judul)
                                <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white drop-shadow-xl border-white tracking-wide">
                                    {{ $banner->judul }}
                                </h1>
                            @endif
                            @if($banner->deskripsi)
                                <p class="text-xl md:text-2xl mb-10 text-gray-200 drop-shadow-lg font-light">
                                    {{ $banner->deskripsi }}
                                </p>
                            @endif
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route("booking.create") }}" class="bg-purple-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-purple-700 transition shadow-2xl hover:scale-105 transform">
                                    <i class="fas fa-calendar-check mr-2"></i> Booking Sekarang
                                </a>
                                <a href="{{ route("booking.status") }}" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-purple-700 transition shadow-2xl hover:scale-105 transform">
                                    <i class="fas fa-clock mr-2"></i> Cek Antrian
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Fallback Slide 1 -->
                <div class="swiper-slide relative bg-gray-900">
                    <img src="https://images.unsplash.com/photo-1601362840469-51e4d8d58785?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay" alt="Car Wash 1">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center px-4 max-w-4xl z-10" data-swiper-parallax="-300">
                            <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white drop-shadow-xl border-white tracking-wide">
                                {{ $profil->hero_title ?? "Kilau Sempurna untuk Kendaraan Anda" }}
                            </h1>
                            <p class="text-xl md:text-2xl mb-10 text-gray-200 drop-shadow-lg font-light">
                                {{ $profil->hero_subtitle ?? "Cuci Cepat, Bersih Detail, Harga Bersahabat" }}
                            </p>
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route("booking.create") }}" class="bg-purple-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-purple-700 transition shadow-2xl hover:scale-105 transform">
                                    <i class="fas fa-calendar-check mr-2"></i> Booking Sekarang
                                </a>
                                <a href="{{ route("booking.status") }}" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-purple-700 transition shadow-2xl hover:scale-105 transform">
                                    <i class="fas fa-clock mr-2"></i> Cek Antrian
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse

            </div>

            <!-- Navigation -->
            <div class="swiper-button-next !text-white opacity-70 hover:opacity-100"></div>
            <div class="swiper-button-prev !text-white opacity-70 hover:opacity-100"></div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>

        <!-- Floating Badge -->
        <div class="absolute bottom-8 right-8 bg-yellow-400 bg-opacity-90 backdrop-blur-md rounded-2xl p-4 sm:p-6 shadow-2xl z-20 animate-bounce hidden md:block border-2 border-yellow-300">
            <div class="flex items-center gap-4">
                <div class="bg-white p-3 rounded-full">
                    <i class="fas fa-users text-yellow-500 text-2xl"></i>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-gray-900">
                        {{ $totalPelanggan ?? '1000' }}+
                    </div>
                    <div class="text-sm font-semibold text-gray-800 uppercase tracking-wider">
                        Pelanggan
                    </div>
                </div>
            </div>
        </div>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const swiper = new Swiper('.myHeroSwiper', {
                    loop: true,
                    effect: 'fade',
                    speed: 1000,
                    parallax: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            });
        </script>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang" class="py-20 px-4 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 w-fit mx-auto">
                    Tentang Kami
                    <div class="w-full h-1 bg-purple-600 mx-auto mt-4"></div>
                </h2>
            </div>

            <div class="grid md:grid-cols-1 gap-12 items-center mb-16">
                <div class="fade-in-left">
                    {{-- <h3 class="text-3xl font-bold text-gray-800 mb-6">
                        Cerita Kami
                    </h3> --}}
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed text-center">
                        {!! nl2br(e($profil->tentang_kami ?? 'Cerita kami tentang auto clean.')) !!}
                    </p>
                </div>

                <!-- Layanan Kami -->
                <section id="layanan" class="py-20 px-4 overflow-hidden">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-16 fade-in">
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 w-fit mx-auto">
                                Layanan Kami
                                <div class="w-full h-1 bg-purple-600 mx-auto mt-4"></div>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto justify-items-center">
                            @foreach ($layanan as $index => $l)
                                <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-lg card-hover scale-in border-t-4 border-purple-500 flex flex-col"
                                    style="transition-delay: {{ $index * 0.1 }}s">
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start mb-4">
                                            <h3 class="text-2xl font-bold text-gray-800">{{ $l->nama }}</h3>
                                            @if ($l->kategori)
                                                <span
                                                    class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded whitespace-nowrap">{{ $l->kategori->nama }}</span>
                                            @endif
                                        </div>
                                        <p class="text-gray-600 mb-6">{{ $l->deskripsi }}</p>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                        <span class="text-2xl font-bold text-purple-600">Rp
                                            {{ number_format($l->harga, 0, ',', '.') }}</span>
                                        <a href="{{ route('booking.create') }}"
                                            class="text-sm font-semibold text-white bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-full transition">
                                            Pilih
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- Fasilitas Tunggu -->
                <section id="fasilitas" class="py-20 px-4 bg-white overflow-hidden">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-16 fade-in">
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 w-fit mx-auto">
                                Fasilitas Ruang Tunggu
                                <div class="w-full h-1 bg-purple-600 mx-auto mt-4"></div>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 max-w-5xl mx-auto justify-items-center">
                            @php
                                $colors = [
                                    ['bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
                                    ['bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                                    ['bg' => 'bg-green-100', 'text' => 'text-green-600'],
                                    ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
                                    ['bg' => 'bg-red-100', 'text' => 'text-red-600'],
                                    ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-600'],
                                    ['bg' => 'bg-pink-100', 'text' => 'text-pink-600'],
                                    ['bg' => 'bg-teal-100', 'text' => 'text-teal-600'],
                                ];
                            @endphp

                            @forelse($fasilitas as $index => $item)
                                @php
                                    $color = $colors[$index % count($colors)];
                                @endphp
                                <div class="w-full max-w-sm bg-white rounded-2xl p-8 shadow-lg card-hover text-center scale-in"
                                    style="transition-delay: {{ $index * 0.1 }}s">
                                    <div
                                        class="{{ $color['bg'] }} w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="{{ $item->ikon }} text-4xl {{ $color['text'] }}"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                        {{ $item->judul }}
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ $item->deskripsi }}
                                    </p>
                                </div>
                            @empty
                                <div class="col-span-full text-center text-gray-500 py-10">
                                    Belum ada data fasilitas.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <!-- Galeri Before & After -->
                <section id="galeri" class="py-20 px-4 bg-white overflow-hidden">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-16 fade-in">
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 w-fit mx-auto">
                                Galeri Before & After
                                <div class="w-full h-1 bg-purple-600 mx-auto mt-4"></div>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto justify-items-center">
                            @forelse($galeri as $index => $item)
                                <div class="w-full max-w-2xl bg-gray-50 rounded-2xl overflow-hidden shadow-lg card-hover fade-in"
                                    style="transition-delay: {{ $index * 0.1 }}s">
                                    <div class="grid grid-cols-2">
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $item->foto_sebelum) }}" alt="Before"
                                                class="w-full h-48 sm:h-64 object-cover" />
                                            <div
                                                class="absolute top-2 left-2 sm:top-4 sm:left-4 bg-red-500 text-white px-2 py-1 sm:px-4 sm:py-2 rounded-full text-xs sm:text-base font-bold">
                                                BEFORE
                                            </div>
                                        </div>
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $item->foto_sesudah) }}" alt="After"
                                                class="w-full h-48 sm:h-64 object-cover" />
                                            <div
                                                class="absolute top-2 right-2 sm:top-4 sm:right-4 bg-green-500 text-white px-2 py-1 sm:px-4 sm:py-2 rounded-full text-xs sm:text-base font-bold">
                                                AFTER
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 sm:p-6">
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">
                                            {{ $item->judul }}
                                        </h3>
                                        <p class="text-sm sm:text-base text-gray-600">
                                            {{ $item->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center text-gray-500 py-10">
                                    Belum ada data galeri.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <!-- Tim Kami -->
                <section class="py-20 px-4" id="tim">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-16 fade-in">
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 w-fit mx-auto">
                                Tim Kami
                                <div class="w-full h-1 bg-purple-600 mx-auto mt-4"></div>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto justify-items-center">
                            @foreach ($karyawan as $index => $k)
                                <div class="w-full max-w-xs bg-white rounded-2xl overflow-hidden shadow-lg card-hover scale-in"
                                    style="transition-delay: {{ $index * 0.1 }}s">
                                    @if ($k->foto)
                                        <img src="{{ asset('storage/' . $k->foto) }}" alt="{{ $k->nama }}"
                                            class="w-full h-64 object-cover" />
                                    @else
                                        <div
                                            class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">
                                            <svg class="w-24 h-24" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-6 text-center">
                                        <h3 class="text-xl font-bold text-gray-800 mb-1">
                                            {{ $k->nama }}
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- Lokasi & Jam Operasional -->
                <section id="lokasi" class="py-20 px-4 overflow-hidden">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-16 fade-in">
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 w-fit mx-auto">
                                Lokasi & Jam Operasional
                                <div class="w-full h-1 bg-purple-600 mx-auto mt-4"></div>
                            </h2>
                        </div>

                        <div class="grid lg:grid-cols-2 gap-12 items-stretch">
                            <!-- Map -->
                            <div
                                class="rounded-3xl overflow-hidden shadow-lg fade-in-left h-full min-h-[400px] border-4 border-white">
                                @if ($profil->url_embed)
                                    <iframe src="{{ $profil->url_embed }}" width="100%" height="100%"
                                        style="border: 0; min-height: 400px;" allowfullscreen="" loading="lazy"></iframe>
                                @else
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6668089856755!2d101.44370431475395!3d0.5070693996396634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ab80690ee7b1%3A0x9105esterol!2sPekanbaru%2C%20Riau!5e0!3m2!1sen!2sid!4v1234567890"
                                        width="100%" height="100%" style="border: 0; min-height: 400px;"
                                        allowfullscreen="" loading="lazy"></iframe>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="fade-in-right flex flex-col justify-between">
                                <!-- Status -->
                                <div id="store-status-card"
                                    class="bg-green-600 rounded-3xl p-8 mb-6 text-white shadow-lg card-hover">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="flex items-center mb-2">
                                                <div class="w-4 h-4 bg-white rounded-full mr-3 status-open shadow-sm">
                                                </div>
                                                <span id="store-status-text" class="text-2xl font-bold tracking-wide">
                                                    BUKA SEKARANG
                                                </span>
                                            </div>
                                            <p id="store-status-desc" class="text-green-50 font-medium">
                                                Kami siap melayani Anda. Silakan datang!
                                            </p>
                                        </div>
                                        <div class="bg-white/20 p-4 rounded-full backdrop-blur-sm">
                                            <i class="fas fa-store text-4xl text-white"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-6 mb-6">
                                    <!-- Jam Operasional -->
                                    <div
                                        class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 card-hover scale-in">
                                        <div
                                            class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-clock text-xl text-purple-600"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-4">Jam Operasional</h3>
                                        <div class="space-y-3">
                                            <div class="flex flex-col">
                                                <span class="text-sm text-gray-500">Senin - Jumat</span>
                                                <span
                                                    class="font-bold text-gray-800">{{ $profil->jam_buka_pekan ?? '-' }}</span>
                                            </div>
                                            <div class="w-full h-[1px] bg-gray-100"></div>
                                            <div class="flex flex-col">
                                                <span class="text-sm text-gray-500">Sabtu - Minggu</span>
                                                <span
                                                    class="font-bold text-gray-800">{{ $profil->jam_buka_akhir_pekan ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 card-hover scale-in"
                                        style="transition-delay: 0.1s">
                                        <div
                                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-map-marker-alt text-xl text-blue-600"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-4">Alamat Kami</h3>
                                        <p class="text-gray-600 leading-relaxed">
                                            {!! nl2br(e($profil->alamat ?? '-')) !!}
                                        </p>
                                        <div class="mt-4 flex items-center text-blue-600 font-medium">
                                            <i class="fas fa-phone-alt mr-2"></i>
                                            {{ $profil->no_telepon ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ $profil->url_map ?? 'https://maps.google.com' }}" target="_blank"
                                    class="block w-full bg-purple-600 text-white text-center py-4 rounded-2xl font-bold text-lg hover:bg-gray-800 transition shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                                    <i class="fas fa-location-arrow mr-2"></i>
                                    Dapatkan Petunjuk Arah
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            @endsection

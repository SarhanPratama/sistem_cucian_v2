<!DOCTYPE html>
<html lang="id">
@php
    $profilTokoGlobal = \App\Models\ProfilToko::first();
@endphp

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', ($profilTokoGlobal->nama_toko ?? 'AutoClean') . ' - ' . ($profilTokoGlobal->hero_title ?? 'Kilau Sempurna untuk Kendaraan Anda'))</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .status-open {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }
        }

        /* Animasi Muncul */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition:
                opacity 0.8s ease,
                transform 0.8s ease;
        }

        .fade-in.appear {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition:
                opacity 0.8s ease,
                transform 0.8s ease;
        }

        .fade-in-left.appear {
            opacity: 1;
            transform: translateX(0);
        }

        .fade-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition:
                opacity 0.8s ease,
                transform 0.8s ease;
        }

        .fade-in-right.appear {
            opacity: 1;
            transform: translateX(0);
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.9);
            transition:
                opacity 0.8s ease,
                transform 0.8s ease;
        }

        .scale-in.appear {
            opacity: 1;
            transform: scale(1);
        }

        .slide-up {
            opacity: 0;
            transform: translateY(50px);
            transition:
                opacity 0.6s ease,
                transform 0.6s ease;
        }

        .slide-up.appear {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    @if(isset($profilTokoGlobal) && $profilTokoGlobal->favicon)
        <link rel="icon" href="{{ asset('storage/' . $profilTokoGlobal->favicon) }}" type="image/x-icon">
    @endif
</head>

<body class="bg-gray-50 flex flex-col min-h-screen overflow-x-hidden">
    <!-- Navbar -->
    <header class="border-b border-purple-600 bg-white fixed w-full z-50 top-0 left-0 shadow-sm">
        <div class="mx-auto flex h-16 max-w-7xl justify-between items-center gap-8 px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" title="" class="flex text-xl">
                <span class="font-bold text-gray-700 dark:text-gray-200">
                    {{ $profilTokoGlobal->nama_toko ?? 'AutoClean' }}
                </span>
            </a>

            <div class="flex items-center justify-end md:justify-between">
                <nav aria-label="Global" class="hidden md:block">
                    <ul class="flex items-center gap-8 text-sm">
                        <li>
                            <a class="text-gray-500 transition hover:text-purple-600" href="{{ url('/') }}#home">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 transition hover:text-purple-600"
                                href="{{ url('/') }}#tentang">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 transition hover:text-purple-600"
                                href="{{ url('/') }}#layanan">
                                Layanan
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 transition hover:text-purple-600"
                                href="{{ url('/') }}#fasilitas">
                                Fasilitas
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 transition hover:text-purple-600" href="{{ url('/') }}#galeri">
                                Galeri
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 transition hover:text-purple-600" href="{{ url('/') }}#tim">
                                Tim Kami
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 transition hover:text-purple-600" href="{{ url('/') }}#lokasi">
                                Lokasi
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex sm:gap-4">
                    <a href="{{ route('booking.create') }}"
                        class="rounded-md bg-purple-600 px-5 py-2.5 text-sm font-medium text-white shadow hover:bg-purple-700">
                        Booking
                    </a>
                    <a href="{{ route('booking.status') }}"
                        class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-purple-600 hover:text-purple-700">
                        Cek Antrian
                    </a>
                </div>

                <button id="mobile-menu-button"
                    class="rounded text-gray-600 transition hover:text-gray-600/75 md:hidden">
                    <span class="sr-only">Toggle menu</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="hidden md:hidden bg-white border-b border-gray-200 fixed w-full z-40 top-16 left-0 shadow-lg transition-all duration-300 ease-in-out max-h-[calc(100vh-4rem)] overflow-y-auto">
        <nav aria-label="Global" class="px-4 pt-2 pb-6 space-y-1">
            <a class="mobile-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50"
                href="{{ url('/') }}#home">Beranda</a>
            <a class="mobile-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50"
                href="{{ url('/') }}#tentang">Tentang Kami</a>
            <a class="mobile-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50"
                href="{{ url('/') }}#layanan">Layanan</a>
            <a class="mobile-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50"
                href="{{ url('/') }}#fasilitas">Fasilitas</a>
            <a class="mobile-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50"
                href="{{ url('/') }}#galeri">Galeri</a>
            <a class="mobile-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50"
                href="{{ url('/') }}#lokasi">Lokasi</a>

            <div class="mt-4 pt-4 border-t border-gray-200 flex flex-col gap-3">
                <a href="{{ route('booking.create') }}"
                    class="block w-full text-center rounded-md bg-purple-600 px-5 py-3 text-base font-medium text-white shadow hover:bg-purple-700">
                    Booking
                </a>
                <a href="{{ route('booking.status') }}"
                    class="block w-full text-center rounded-md bg-gray-100 px-5 py-3 text-base font-medium text-purple-600 hover:text-purple-700 hover:bg-gray-200">
                    Cek Status
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="flex-grow pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-purple-600 w-full text-white py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:mb-0 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-car-side text-3xl mr-3"></i>
                        <span class="text-2xl font-bold">{{ $profil->nama_toko ?? 'AutoClean' }}</span>
                    </div>
                    <p class="text-purple-100 mb-4">
                        {{ $profil->hero_subtitle ?? 'Kilau sempurna untuk kendaraan kesayangan Anda sejak 2018.' }}
                    </p>
                    <div class="flex space-x-4">
                        @if (!empty($profil->facebook))
                            <a href="{{ $profil->facebook }}" target="_blank"
                                class="bg-white bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if (!empty($profil->instagram))
                            <a href="{{ $profil->instagram }}" target="_blank"
                                class="bg-white bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if (!empty($profil->whatsapp))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->whatsapp) }}"
                                target="_blank"
                                class="bg-white bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-4">Menu</h4>
                    <ul class="space-y-2 text-purple-100">
                        <li>
                            <a href="#home" class="hover:text-white transition">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#tentang" class="hover:text-white transition">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="#fasilitas" class="hover:text-white transition">
                                Fasilitas
                            </a>
                        </li>
                        <li>
                            <a href="#galeri" class="hover:text-white transition">
                                Galeri
                            </a>
                        </li>
                        <li>
                            <a href="#tim" class="hover:text-white transition">
                                Tim Kami
                            </a>
                        </li>
                        <li>
                            <a href="#lokasi" class="hover:text-white transition">
                                Lokasi
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-4">Jam Buka</h4>
                    <ul class="space-y-2 text-purple-100">
                        <li class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span
                                class="font-semibold">{{ $profilTokoGlobal->jam_buka_pekan ?? '08.00 - 20.00' }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu - Minggu</span>
                            <span
                                class="font-semibold">{{ $profilTokoGlobal->jam_buka_akhir_pekan ?? '07.00 - 21.00' }}</span>
                        </li>
                    </ul>
                    <div class="mt-6 bg-white bg-opacity-20 p-4 rounded-xl">
                        <p class="text-sm mb-2">Hubungi Kami:</p>
                        <p class="font-bold text-lg">{{ $profilTokoGlobal->no_telepon ?? '+62 812 3456 7890' }}</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-purple-500 pt-8 mt-6 text-center text-purple-200 text-sm">
                <p>&copy; {{ date('Y') }} {{ $profilTokoGlobal->nama_toko ?? 'AutoClean' }}. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Status Toko Real-time
        function updateStoreStatus() {
            const now = new Date();
            const day = now.getDay();
            const hour = now.getHours();
            const minute = now.getMinutes();
            const currentTime = hour + minute / 60;

            let isOpen = false;

            // Senin - Jumat (1-5): 08.00 - 20.00
            if (day >= 1 && day <= 5) {
                isOpen = currentTime >= 8 && currentTime < 20;
            }
            // Sabtu - Minggu (0, 6): 07.00 - 21.00
            else if (day === 0 || day === 6) {
                isOpen = currentTime >= 7 && currentTime < 21;
            }

            const statusCard = document.getElementById('store-status-card');
            const statusText = document.getElementById('store-status-text');
            const statusDesc = document.getElementById('store-status-desc');

            if (statusCard && statusText && statusDesc) {
                if (isOpen) {
                    statusCard.className =
                        'bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl p-8 mb-6 text-white shadow-lg card-hover';
                    statusText.textContent = 'BUKA SEKARANG';
                    statusDesc.textContent = 'Kami siap melayani Anda. Silakan datang!';
                    const dot = statusCard.querySelector('.w-4.h-4');
                    if (dot) dot.classList.add('status-open');
                } else {
                    statusCard.className =
                        'bg-gradient-to-r from-red-500 to-rose-600 rounded-3xl p-8 mb-6 text-white shadow-lg card-hover';
                    statusText.textContent = 'TUTUP';
                    statusDesc.textContent = 'Kami akan buka kembali sesuai jadwal';
                    const dot = statusCard.querySelector('.w-4.h-4');
                    if (dot) dot.classList.remove('status-open');
                }
            } else {
                // Fallback for old elements if still present
                const oldStatusElement = document.querySelector('.bg-gradient-to-r.from-green-500') || document
                    .querySelector('.bg-gradient-to-r.from-red-500');
                if (oldStatusElement) {
                    if (isOpen) {
                        oldStatusElement.className =
                            'bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 mb-8 text-white shadow-lg';
                        if (oldStatusElement.querySelector('span.text-2xl')) oldStatusElement.querySelector('span.text-2xl')
                            .textContent = 'BUKA SEKARANG';
                        if (oldStatusElement.querySelector('p')) oldStatusElement.querySelector('p').textContent =
                            'Kami siap melayani Anda';
                    } else {
                        oldStatusElement.className =
                            'bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-8 mb-8 text-white shadow-lg';
                        if (oldStatusElement.querySelector('span.text-2xl')) oldStatusElement.querySelector('span.text-2xl')
                            .textContent = 'TUTUP';
                        if (oldStatusElement.querySelector('p')) oldStatusElement.querySelector('p').textContent =
                            'Kami akan buka kembali sesuai jadwal';
                        oldStatusElement.querySelector('.status-open')?.classList.remove('status-open');
                    }
                }
            }
        }

        // Smooth Scroll (hanya untuk link di halaman yang sama)
        document.querySelectorAll('a[href^="{{ url('/') }}#"]').forEach((anchor) => {
            anchor.addEventListener('click', function(e) {
                // Jika kita berada di halaman utama
                if (window.location.pathname === '/' || window.location.pathname === '') {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').split('#')[1];
                    const target = document.getElementById(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                        });
                    }
                }
            });
        });

        // Update status saat halaman dimuat
        updateStoreStatus();

        // Update status setiap menit
        setInterval(updateStoreStatus, 60000);

        // Intersection Observer untuk animasi scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px',
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('appear');
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan class animasi
        document
            .querySelectorAll(
                '.fade-in, .fade-in-left, .fade-in-right, .scale-in, .slide-up',
            )
            .forEach((el) => {
                observer.observe(el);
            });

        // Animasi langsung untuk hero section
        setTimeout(() => {
            document
                .querySelectorAll(
                    '#home .fade-in-left, #home .fade-in-right',
                )
                .forEach((el) => {
                    el.classList.add('appear');
                });
        }, 100);

        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Tutup menu saat link diklik
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }
    </script>
    @stack('scripts')
</body>

</html>

@php
    $profil = \App\Models\ProfilToko::first();
@endphp
@if($profil && $profil->logo)
    <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" {{ $attributes->merge(['class' => 'object-contain']) }}>
@else
    <div {{ $attributes->merge(['class' => 'font-bold text-xl text-purple-600 flex items-center w-full']) }}>
        <i class="fas fa-car-side mr-2"></i> {{ $profil->nama_toko ?? 'Cucian motor Aziz' }}
    </div>
@endif

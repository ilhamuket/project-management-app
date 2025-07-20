@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-2xs">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Paket Pekerjaan</h2>
        <div class="flex space-x-2">
            <a href="{{ route('projects.edit', $project->id) }}" 
               class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <a href="{{ route('projects.index') }}" 
               class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Status Badge -->
    <div class="mb-6">
        @php
            $statusColors = [
                'Belum dimulai' => 'bg-gray-100 text-gray-800',
                'Progress' => 'bg-yellow-100 text-yellow-800',
                'Selesai' => 'bg-green-100 text-green-800'
            ];
        @endphp
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$project->status] ?? 'bg-gray-100 text-gray-800' }}">
            {{ $project->status }}
        </span>
    </div>

    <!-- Basic Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="space-y-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Paket Pekerjaan</label>
                        <p class="text-gray-900 font-medium">{{ $project->paket_pekerjaan }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Mulai</label>
                            <p class="text-gray-900">{{ $project->tanggal_mulai->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Selesai</label>
                            <p class="text-gray-900">{{ $project->tanggal_selesai->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Konstruksi</label>
                            <p class="text-gray-900">{{ $project->jenis_konstruksi }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tipe Anggaran</label>
                            <p class="text-gray-900">{{ $project->tipe_anggaran }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Teknis</h3>
                <div class="space-y-3">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Panjang (P)</label>
                            <p class="text-gray-900">{{ $project->panjang ? number_format($project->panjang, 2) . ' m' : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Lebar (L)</label>
                            <p class="text-gray-900">{{ $project->lebar ? number_format($project->lebar, 2) . ' m' : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tebal (T)</label>
                            <p class="text-gray-900">{{ $project->tebal ? number_format($project->tebal, 2) . ' cm' : '-' }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nilai Kontrak</label>
                        <p class="text-gray-900 font-semibold text-lg">
                            {{ $project->nilai_kontrak ? 'Rp ' . number_format($project->nilai_kontrak, 0, ',', '.') : '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Location Information -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Lokasi</h3>
        
        @if($project->koordinat)
            @php
                $coordinates = explode(',', $project->koordinat);
                $latitude = isset($coordinates[0]) ? trim($coordinates[0]) : '';
                $longitude = isset($coordinates[1]) ? trim($coordinates[1]) : '';
            @endphp
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Alamat</label>
                        <p class="text-gray-900">{{ $project->alamat ?: 'Alamat tidak tersedia' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Latitude</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $latitude }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Longitude</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $longitude }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Peta Lokasi</label>
                    <div id="map" style="height: 300px; width: 100%; border-radius: 8px; border: 1px solid #e5e7eb;"></div>
                </div>
            </div>
        @else
            <p class="text-gray-500 italic">Koordinat lokasi belum diatur</p>
        @endif
    </div>

    <!-- Photo -->
    @if($project->foto)
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Foto Lokasi</h3>
        <div class="max-w-md">
            <img src="{{ asset('storage/' . $project->foto) }}" 
                 alt="Foto Lokasi {{ $project->paket_pekerjaan }}" 
                 class="w-full h-64 object-cover rounded-lg border border-gray-200">
        </div>
    </div>
    @endif

    <!-- Team Information -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tim</h3>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Kontraktor</label>
                <p class="text-gray-900">{{ $project->nama_kontraktor ?: '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Konsultan Perencana</label>
                <p class="text-gray-900">{{ $project->nama_konsultan_perencana ?: '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Konsultan Pengawas</label>
                <p class="text-gray-900">{{ $project->nama_konsultan_pengawas ?: '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Documents -->
    @if($project->dokumen_kontrak)
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Dokumen Kontrak</h3>
        <div class="space-y-2">
            @foreach (json_decode($project->dokumen_kontrak, true) as $dokumen)
                <div class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ basename($dokumen) }}</p>
                        <p class="text-xs text-gray-500">Dokumen kontrak</p>
                    </div>
                    <a href="{{ asset('storage/' . $dokumen) }}" 
                       target="_blank"
                       class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-md text-blue-600 hover:text-blue-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if($project->koordinat)
        @php
            $coordinates = explode(',', $project->koordinat);
            $latitude = isset($coordinates[0]) ? trim($coordinates[0]) : '';
            $longitude = isset($coordinates[1]) ? trim($coordinates[1]) : '';
        @endphp
        
        const lat = {{ $latitude }};
        const lng = {{ $longitude }};
        
        // Initialize map
        const map = L.map('map').setView([lat, lng], 15);
        
        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);
        
        // Add marker
        const marker = L.marker([lat, lng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                shadowSize: [41, 41]
            })
        }).addTo(map);
        
        // Add popup to marker
        marker.bindPopup(`
            <div class="text-sm">
                <strong>{{ $project->paket_pekerjaan }}</strong><br>
                <small class="text-gray-600">{{ $project->alamat ?: 'Lokasi Paket Pekerjaan' }}</small>
            </div>
        `).openPopup();
        
        // Disable map interaction for read-only view
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();
        if (map.tap) map.tap.disable();
    @endif
});
</script>
@endsection
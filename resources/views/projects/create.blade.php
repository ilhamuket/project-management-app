@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-2xs dark:bg-neutral-800">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-neutral-200">Tambah Paket Pekerjaan</h2>

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="paket_pekerjaan" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Paket Pekerjaan</label>
            <input type="text" id="paket_pekerjaan" name="paket_pekerjaan" value="{{ old('paket_pekerjaan') }}" placeholder="Masukkan nama paket pekerjaan"
                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            @error('paket_pekerjaan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="tanggal_mulai_display" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Tanggal Mulai</label>
                <div class="relative">
                    <input id="tanggal_mulai_display" type="text" 
                           class="datepicker py-3 px-4 pe-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                           placeholder="DD/MM/YYYY" value="{{ old('tanggal_mulai') ? date('d/m/Y', strtotime(old('tanggal_mulai'))) : '' }}" readonly>
                    <input type="hidden" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-4">
                        <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <line x1="16" x2="16" y1="2" y2="6"></line>
                            <line x1="8" x2="8" y1="2" y2="6"></line>
                            <line x1="3" x2="21" y1="10" y2="10"></line>
                        </svg>
                    </div>
                </div>
                @error('tanggal_mulai')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="tanggal_selesai_display" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Tanggal Selesai</label>
                <div class="relative">
                    <input id="tanggal_selesai_display" type="text" 
                           class="datepicker py-3 px-4 pe-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                           placeholder="DD/MM/YYYY" value="{{ old('tanggal_selesai') ? date('d/m/Y', strtotime(old('tanggal_selesai'))) : '' }}" readonly>
                    <input type="hidden" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-4">
                        <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <line x1="16" x2="16" y1="2" y2="6"></line>
                            <line x1="8" x2="8" y1="2" y2="6"></line>
                            <line x1="3" x2="21" y1="10" y2="10"></line>
                        </svg>
                    </div>
                </div>
                @error('tanggal_selesai')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Map Section - Full Width Row -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
            Pilih Lokasi di Peta <span class="text-red-500">*</span>
            </label>
            <div class="border-2 border-gray-200 rounded-lg p-4 dark:border-neutral-700">
            <div class="mb-3">
                <button type="button" id="getCurrentLocation" 
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-300 dark:hover:bg-neutral-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Gunakan Lokasi Saat Ini
                </button>
                <span class="ml-3 text-sm text-gray-500 dark:text-neutral-400">atau klik di peta untuk memilih lokasi</span>
            </div>
            
            <!-- Map Container -->
            <div id="map" style="height: 400px; width: 100%; border-radius: 8px;"></div>
            
            <div class="mt-3 text-sm text-gray-600 dark:text-neutral-400">
                <p><strong>Instruksi:</strong></p>
                <ul class="list-disc list-inside space-y-1 mt-1">
                <li>Klik tombol "Gunakan Lokasi Saat Ini" untuk otomatis mendeteksi lokasi Anda</li>
                <li>Atau klik langsung di peta untuk memilih koordinat</li>
                <li>Drag marker merah untuk menyesuaikan posisi yang tepat</li>
                </ul>
            </div>
            
            <!-- Info lokasi terpilih -->
            <div id="locationInfo" class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg hidden dark:bg-blue-900/20 dark:border-blue-800">
                <h4 class="font-medium text-blue-900 dark:text-blue-300 mb-1">Lokasi Terpilih:</h4>
                <p id="coordinateText" class="text-xs text-blue-600 dark:text-blue-400 mt-1"></p>
            </div>
            </div>

        </div>

        <!-- Coordinates - Row with Two Columns -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
            <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                Latitude <span class="text-red-500">*</span>
            </label>
            <input type="number" id="latitude" name="latitude" step="any" readonly
                value="{{ old('latitude') }}"
                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 border">
            <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">Koordinat lintang (otomatis dari peta)</p>
            </div>

            <div>
            <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                Longitude <span class="text-red-500">*</span>
            </label>
            <input type="number" id="longitude" name="longitude" step="any" readonly
                value="{{ old('longitude') }}"
                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 border">
            <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">Koordinat bujur (otomatis dari peta)</p>
            </div>
        </div>

         <div class="mb-4">
            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Alamat Lokasi</label>
            <div class="flex items-center">
            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lokasi paket pekerjaan" value="{{ old('alamat') }}"
                  class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <span id="addressLoading" class="hidden ml-2">
                <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
            </div>
            <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">Alamat akan otomatis terisi ketika lokasi dipilih pada peta</p>
            @error('alamat')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- Hidden field untuk menggabungkan koordinat jika diperlukan backend -->
        <input type="hidden" id="koordinat" name="koordinat" value="{{ old('koordinat') }}">

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Foto Lokasi</label>
            <label for="foto" class="group p-4 sm:p-7 block cursor-pointer text-center border-2 border-dashed border-gray-200 rounded-lg focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:border-gray-300 dark:border-neutral-700 dark:hover:border-neutral-600">
                <input id="foto" name="foto" type="file" class="sr-only" accept="image/*">
                <svg class="size-10 mx-auto text-gray-400 dark:text-neutral-600" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-800 dark:text-neutral-200">
                    Browse your device or <span class="group-hover:text-blue-700 text-blue-600">drag 'n drop'</span>
                </span>
                <span class="mt-1 block text-xs text-gray-500 dark:text-neutral-500">
                    Maximum file size is 2MB
                </span>
            </label>
            @error('foto')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="jenis_konstruksi" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Jenis Konstruksi</label>
            <select id="jenis_konstruksi" name="jenis_konstruksi" 
                    class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option value="" selected disabled>Pilih jenis konstruksi</option>
                <option value="Cor Beton" {{ old('jenis_konstruksi') == 'Cor Beton' ? 'selected' : '' }}>Cor Beton</option>
                <option value="Drainase" {{ old('jenis_konstruksi') == 'Drainase' ? 'selected' : '' }}>Drainase</option>
                <option value="Pengerasan" {{ old('jenis_konstruksi') == 'Pengerasan' ? 'selected' : '' }}>Pengerasan</option>
                <option value="Lainnya" {{ old('jenis_konstruksi') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            @error('jenis_konstruksi')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label for="panjang" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Panjang (P) - meter</label>
                <input type="number" id="panjang" name="panjang" step="0.01" placeholder="0.00" value="{{ old('panjang') }}"
                       class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('panjang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="lebar" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Lebar (L) - meter</label>
                <input type="number" id="lebar" name="lebar" step="0.01" placeholder="0.00" value="{{ old('lebar') }}"
                       class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('lebar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="tebal" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Tebal (T) - cm</label>
                <input type="number" id="tebal" name="tebal" step="0.01" placeholder="0.00" value="{{ old('tebal') }}"
                       class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('tebal')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="nilai_kontrak" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Nilai Kontrak (Rp)</label>
            <input type="number" id="nilai_kontrak" name="nilai_kontrak" placeholder="0" value="{{ old('nilai_kontrak') }}"
                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            @error('nilai_kontrak')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nama_kontraktor" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Nama Kontraktor</label>
            <input type="text" id="nama_kontraktor" name="nama_kontraktor" placeholder="Masukkan nama kontraktor" value="{{ old('nama_kontraktor') }}"
                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            @error('nama_kontraktor')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nama_konsultan_perencana" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Nama Konsultan Perencana</label>
            <input type="text" id="nama_konsultan_perencana" name="nama_konsultan_perencana" placeholder="Masukkan nama konsultan perencana" value="{{ old('nama_konsultan_perencana') }}"
                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            @error('nama_konsultan_perencana')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nama_konsultan_pengawas" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Nama Konsultan Pengawas</label>
            <input type="text" id="nama_konsultan_pengawas" name="nama_konsultan_pengawas" placeholder="Masukkan nama konsultan pengawas" value="{{ old('nama_konsultan_pengawas') }}"
                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            @error('nama_konsultan_pengawas')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Dokumen Kontrak</label>
            <label for="dokumen_kontrak" class="group p-4 sm:p-7 block cursor-pointer text-center border-2 border-dashed border-gray-200 rounded-lg focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:border-gray-300 dark:border-neutral-700 dark:hover:border-neutral-600">
                <input id="dokumen_kontrak" name="dokumen_kontrak[]" type="file" class="sr-only" multiple accept=".pdf,.doc,.docx">
                <svg class="size-10 mx-auto text-gray-400 dark:text-neutral-600" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M40 12H8a4 4 0 00-4 4v16a4 4 0 004 4h32a4 4 0 004-4V16a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 12v-2a4 4 0 014-4h8a4 4 0 014 4v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 20h24" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-800 dark:text-neutral-200">
                    Browse your device or <span class="group-hover:text-blue-700 text-blue-600">drag 'n drop'</span>
                </span>
                <span class="mt-1 block text-xs text-gray-500 dark:text-neutral-500">
                    Upload Kontrak, SP2D, PHO, FHO, dll. (PDF, DOC, DOCX)
                </span>
            </label>
            @error('dokumen_kontrak.*')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tipe_anggaran" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Tipe Anggaran</label>
            <select id="tipe_anggaran" name="tipe_anggaran" 
                    class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option value="" selected disabled>Pilih tipe anggaran</option>
                <option value="APBD" {{ old('tipe_anggaran') == 'APBD' ? 'selected' : '' }}>APBD</option>
                <option value="APBDP" {{ old('tipe_anggaran') == 'APBDP' ? 'selected' : '' }}>APBDP</option>
            </select>
            @error('tipe_anggaran')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">Status</label>
            <select id="status" name="status" 
                    class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option value="" selected disabled>Pilih status paket pekerjaan</option>
                <option value="Belum dimulai" {{ old('status') == 'Belum dimulai' ? 'selected' : '' }}>Belum dimulai</option>
                <option value="Progress" {{ old('status') == 'Progress' ? 'selected' : '' }}>Progress</option>
                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                Simpan Paket Pekerjaan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('foto');
    const dokumenInput = document.getElementById('dokumen_kontrak');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const koordinatInput = document.getElementById('koordinat');
    const alamatInput = document.getElementById('alamat');
    const addressLoading = document.getElementById('addressLoading');
    
    // Get display and hidden date inputs
    const tanggalMulaiDisplay = document.getElementById('tanggal_mulai_display');
    const tanggalMulaiHidden = document.getElementById('tanggal_mulai');
    const tanggalSelesaiDisplay = document.getElementById('tanggal_selesai_display');
    const tanggalSelesaiHidden = document.getElementById('tanggal_selesai');

    let map;
    let marker;
    let isLocationSelected = false;

    // Default center (Jakarta)
    const defaultLat = 2.0872;
    const defaultLng = 117.3736;

    // Initialize map
    function initializeMap() {
        map = L.map('map').setView([defaultLat, defaultLng], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);

        map.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });

        // Set existing coordinates if available (for edit form)
        const existingLat = document.getElementById('latitude').value;
        const existingLng = document.getElementById('longitude').value;
        if (existingLat && existingLng) {
            setMarker(parseFloat(existingLat), parseFloat(existingLng));
            map.setView([existingLat, existingLng], 15);
        }
    }

    function setMarker(lat, lng) {
        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng], {
            draggable: true,
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                shadowSize: [41, 41]
            })
        }).addTo(map);

        updateCoordinates(lat, lng);
        fetchAddress(lat, lng); // Panggil fungsi untuk mengambil alamat

        marker.on('dragend', function(e) {
            const position = e.target.getLatLng();
            updateCoordinates(position.lat, position.lng);
            fetchAddress(position.lat, position.lng); // Ambil alamat saat marker dipindahkan
        });

        showLocationInfo(lat, lng);
        isLocationSelected = true;
    }

    function updateCoordinates(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
        document.getElementById('koordinat').value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
    }

    function showLocationInfo(lat, lng) {
        const locationInfo = document.getElementById('locationInfo');
        const coordinateText = document.getElementById('coordinateText');
        
        coordinateText.textContent = `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        locationInfo.classList.remove('hidden');
    }

    // Fungsi untuk mengambil alamat dari koordinat menggunakan Nominatim
    async function fetchAddress(lat, lng) {
        addressLoading.classList.remove('hidden'); // Tampilkan loading
        alamatInput.value = ''; // Kosongkan input alamat sementara

        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
            const data = await response.json();

            if (data && data.display_name) {
                alamatInput.value = data.display_name; // Isi input alamat dengan hasil dari API
            } else {
                alamatInput.value = 'Alamat tidak ditemukan';
            }
        } catch (error) {
            console.error('Error fetching address:', error);
            alamatInput.value = 'Gagal mengambil alamat';
        } finally {
            addressLoading.classList.add('hidden'); // Sembunyikan loading
        }
    }

    function getCurrentLocation() {
        if (navigator.geolocation) {
            const button = document.getElementById('getCurrentLocation');
            button.disabled = true;
            button.innerHTML = '<svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle></svg>Mencari lokasi...';

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    map.setView([lat, lng], 15);
                    setMarker(lat, lng);
                    
                    button.disabled = false;
                    button.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>Gunakan Lokasi Saat Ini';
                },
                function(error) {
                    button.disabled = false;
                    button.innerHTML = 'Gunakan Lokasi Saat Ini';
                    alert('Tidak dapat mendeteksi lokasi. Silakan pilih lokasi dengan klik di peta.');
                }
            );
        }
    }

    // Initialize map
    initializeMap();
    
    // Event listeners
    document.getElementById('getCurrentLocation').addEventListener('click', getCurrentLocation);
    
    // Pertahankan event listener yang sudah ada untuk file uploads dll...
    if (fotoInput) {
        fotoInput.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            if (fileName) {
                const label = this.closest('label');
                const textSpan = label.querySelector('span:first-of-type');
                textSpan.innerHTML = `Selected: <strong>${fileName}</strong>`;
            }
        });
    }
    
    // File upload feedback
    fotoInput.addEventListener('change', function() {
        const fileName = this.files[0]?.name;
        if (fileName) {
            const label = this.closest('label');
            const textSpan = label.querySelector('span:first-of-type');
            textSpan.innerHTML = `Selected: <strong>${fileName}</strong>`;
        }
    });
    
    dokumenInput.addEventListener('change', function() {
        const fileCount = this.files.length;
        if (fileCount > 0) {
            const label = this.closest('label');
            const textSpan = label.querySelector('span:first-of-type');
            textSpan.innerHTML = `Selected: <strong>${fileCount} file(s)</strong>`;
        }
    });
    
    // Combine latitude and longitude to koordinat field
    function updateKoordinat() {
        const lat = latitudeInput.value;
        const lng = longitudeInput.value;
        if (lat && lng) {
            koordinatInput.value = `${lat}, ${lng}`;
        }
    }

    latitudeInput.addEventListener('input', updateKoordinat);
    longitudeInput.addEventListener('input', updateKoordinat);
    
    // Function to convert DD/MM/YYYY to YYYY-MM-DD
    function convertToISODate(dateStr) {
        if (!dateStr) return '';
        const parts = dateStr.split('/');
        if (parts.length === 3) {
            const day = parts[0].padStart(2, '0');
            const month = parts[1].padStart(2, '0');
            const year = parts[2];
            return `${year}-${month}-${day}`;
        }
        return dateStr;
    }
    
    // Function to convert YYYY-MM-DD to DD/MM/YYYY
    function convertToDisplayDate(dateStr) {
        if (!dateStr) return '';
        const parts = dateStr.split('-');
        if (parts.length === 3) {
            const year = parts[0];
            const month = parts[1];
            const day = parts[2];
            return `${day}/${month}/${year}`;
        }
        return dateStr;
    }
    
    // Initialize koordinat field if latitude and longitude have values
    updateKoordinat();
    
    // Wait for Flatpickr to be initialized (small delay to ensure it's ready)
    setTimeout(function() {
        // Find flatpickr instances
        const startDatePicker = tanggalMulaiDisplay._flatpickr;
        const endDatePicker = tanggalSelesaiDisplay._flatpickr;
        
        if (startDatePicker) {
            startDatePicker.config.onChange.push(function(selectedDates, dateStr, instance) {
                // Convert DD/MM/YYYY to YYYY-MM-DD and set to hidden field
                tanggalMulaiHidden.value = convertToISODate(dateStr);
                
                // Set minimum date for end date picker
                if (endDatePicker && selectedDates[0]) {
                    endDatePicker.set('minDate', selectedDates[0]);
                }
                
                // Clear end date if it's before start date
                const endDate = tanggalSelesaiHidden.value;
                const startDate = tanggalMulaiHidden.value;
                if (endDate && startDate && endDate < startDate) {
                    endDatePicker.clear();
                    tanggalSelesaiHidden.value = '';
                }
            });
        }
        
        if (endDatePicker) {
            endDatePicker.config.onChange.push(function(selectedDates, dateStr, instance) {
                // Convert DD/MM/YYYY to YYYY-MM-DD and set to hidden field
                tanggalSelesaiHidden.value = convertToISODate(dateStr);
                
                // Validate that end date is not before start date
                const startDate = tanggalMulaiHidden.value;
                const endDate = tanggalSelesaiHidden.value;
                
                if (startDate && endDate && endDate < startDate) {
                    alert('Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
                    instance.clear();
                    tanggalSelesaiHidden.value = '';
                }
            });
        }
    }, 100);
});
</script>
@endsection
<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        $paketPekerjaan = [
            'Pembangunan Jalan Raya Gatot Subroto',
            'Renovasi Gedung Perkantoran Dinas',
            'Konstruksi Jembatan Sungai Musi',
            'Pembangunan Kompleks Perumahan Rakyat',
            'Perbaikan Infrastruktur Jalan Tol',
            'Pembangunan Sekolah Dasar Negeri',
            'Konstruksi Rumah Sakit Umum',
            'Pembangunan Pasar Tradisional',
            'Renovasi Stadion Olahraga',
            'Pembangunan Terminal Bus',
            'Konstruksi Kantor Polsek',
            'Pembangunan Masjid Agung',
            'Perbaikan Sistem Drainase Kota',
            'Pembangunan Taman Kota',
            'Konstruksi Gedung Perpustakaan',
            'Pembangunan Puskesmas Kelurahan',
            'Renovasi Balai Desa',
            'Pembangunan Jalan Lingkar Kota',
            'Konstruksi Gedung Sekolah Menengah',
            'Pembangunan Pos Pemadam Kebakaran'
        ];

        $kontraktor = [
            'PT. Wijaya Karya (Persero) Tbk',
            'PT. Adhi Karya (Persero) Tbk',
            'PT. Waskita Karya (Persero) Tbk',
            'PT. Hutama Karya (Persero)',
            'PT. Pembangunan Perumahan (Persero) Tbk',
            'PT. Nindya Karya (Persero)',
            'PT. Brantas Abipraya (Persero)',
            'PT. Istaka Karya (Persero)',
            'PT. Yodya Karya (Persero)',
            'PT. Virama Karya (Persero)'
        ];

        $konsultanPerencana = [
            'PT. Virama Karya Engineering',
            'PT. Yodya Karya Consultant',
            'PT. Nindya Karya Planning',
            'PT. Hutama Engineering',
            'PT. Adhi Consultant',
            'PT. Wijaya Planning',
            'PT. Waskita Engineering',
            'PT. Brantas Consultant',
            'PT. Istaka Planning',
            'PT. PP Engineering'
        ];

        $konsultanPengawas = [
            'PT. Surveyor Indonesia',
            'PT. Sucofindo (Persero)',
            'PT. SGS Indonesia',
            'PT. Bureau Veritas Indonesia',
            'PT. TUV Rheinland Indonesia',
            'PT. Intertek Indonesia',
            'PT. BPKI Consultant',
            'PT. Virama Karya Supervision',
            'PT. Nindya Supervision',
            'PT. Adhi Supervision'
        ];

        $jenisKonstruksi = [
            'Jalan dan Jembatan',
            'Gedung dan Bangunan',
            'Infrastruktur Air',
            'Transportasi',
            'Kelistrikan',
            'Telekomunikasi',
            'Lingkungan'
        ];

        $tipeAnggaran = ['APBDP', 'APBD'];
        $statusOptions = ['Belum dimulai', 'Progress', 'Selesai'];

        $alamatKota = [
            'Jakarta Pusat', 'Jakarta Utara', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Barat',
            'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Makassar', 'Palembang', 'Yogyakarta',
            'Malang', 'Solo', 'Denpasar', 'Balikpapan', 'Samarinda', 'Pontianak', 'Manado', 'Jayapura'
        ];

        // Create projects for current year and previous year
        for ($year = 2023; $year <= 2025; $year++) {
            for ($month = 1; $month <= 12; $month++) {
                // Create 3-8 projects per month
                $projectsCount = rand(3, 8);
                
                for ($i = 0; $i < $projectsCount; $i++) {
                    $tanggalMulai = Carbon::create($year, $month, rand(1, 28));
                    $durasiHari = rand(30, 365); // 1 month to 1 year duration
                    $tanggalSelesai = $tanggalMulai->copy()->addDays($durasiHari);
                    
                    // Determine status based on dates
                    $now = Carbon::now();
                    if ($tanggalMulai > $now) {
                        $status = 'Belum dimulai';
                    } elseif ($tanggalSelesai < $now) {
                        $status = 'Selesai';
                    } else {
                        $status = 'Progress';
                    }

                    // Generate realistic nilai kontrak based on project type
                    $nilaiKontrak = $this->generateNilaiKontrak($paketPekerjaan[array_rand($paketPekerjaan)]);

                    Project::create([
                        'paket_pekerjaan' => $paketPekerjaan[array_rand($paketPekerjaan)] . ' - ' . $alamatKota[array_rand($alamatKota)],
                        'tanggal_mulai' => $tanggalMulai,
                        'tanggal_selesai' => $tanggalSelesai,
                        'alamat' => 'Jl. ' . $alamatKota[array_rand($alamatKota)] . ' No. ' . rand(1, 100) . ', ' . $alamatKota[array_rand($alamatKota)],
                        'koordinat' => $this->generateKoordinat(),
                        'foto' => null,
                        'jenis_konstruksi' => $jenisKonstruksi[array_rand($jenisKonstruksi)],
                        'panjang' => rand(100, 5000), // meters
                        'lebar' => rand(3, 20), // meters
                        'tebal' => rand(10, 50), // cm
                        'nilai_kontrak' => $nilaiKontrak,
                        'nama_kontraktor' => $kontraktor[array_rand($kontraktor)],
                        'nama_konsultan_perencana' => $konsultanPerencana[array_rand($konsultanPerencana)],
                        'nama_konsultan_pengawas' => $konsultanPengawas[array_rand($konsultanPengawas)],
                        'dokumen_kontrak' => null, // Assuming no documents for seeding
                        'tipe_anggaran' => $tipeAnggaran[array_rand($tipeAnggaran)],
                        'status' => $status,
                        'created_at' => $tanggalMulai,
                        'updated_at' => $status === 'selesai' ? $tanggalSelesai : $now,
                    ]);
                }
            }
        }
    }

    /**
     * Generate realistic nilai kontrak based on project name
     */
    private function generateNilaiKontrak($projectName): int
    {
        // Base amount based on project type
        if (str_contains(strtolower($projectName), 'jalan') || str_contains(strtolower($projectName), 'jembatan')) {
            $base = rand(500000000, 5000000000); // 500M - 5B
        } elseif (str_contains(strtolower($projectName), 'gedung') || str_contains(strtolower($projectName), 'rumah sakit')) {
            $base = rand(1000000000, 10000000000); // 1B - 10B
        } elseif (str_contains(strtolower($projectName), 'sekolah') || str_contains(strtolower($projectName), 'puskesmas')) {
            $base = rand(200000000, 2000000000); // 200M - 2B
        } else {
            $base = rand(100000000, 1000000000); // 100M - 1B
        }

        return $base;
    }

    /**
     * Generate random coordinates for Indonesia
     */
    private function generateKoordinat(): string
    {
        // Indonesia coordinates range
        $lat = rand(-1100, 600) / 100; // -11.00 to 6.00
        $lng = rand(9500, 14100) / 100; // 95.00 to 141.00
        
        return $lat . ',' . $lng;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'paket_pekerjaan',
        'tanggal_mulai',
        'tanggal_selesai',
        'alamat',
        'koordinat',
        'foto',
        'jenis_konstruksi',
        'panjang',
        'lebar',
        'tebal',
        'nilai_kontrak',
        'nama_kontraktor',
        'nama_konsultan_perencana',
        'nama_konsultan_pengawas',
        'dokumen_kontrak',
        'tipe_anggaran',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'dokumen_kontrak' => 'array',
    ];
}
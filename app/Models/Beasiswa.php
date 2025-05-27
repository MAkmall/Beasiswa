<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';

    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'jumlah_dana',
        'kuota_total',
        'kuota_tersedia',
        'persyaratan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'tingkat_pendidikan_target',
        'minimal_ipk'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'jumlah_dana' => 'decimal:2',
        'minimal_ipk' => 'decimal:2'
    ];

    // Relasi dengan pendaftaran beasiswa
    public function pendaftaranBeasiswa()
    {
        return $this->hasMany(PendaftaranBeasiswa::class, 'id_beasiswa');
    }

    // Scope untuk beasiswa aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk beasiswa yang masih bisa didaftar
    public function scopeBisaDaftar($query)
    {
        return $query->where('status', 'aktif')
                    ->where('tanggal_selesai', '>=', now())
                    ->where('kuota_tersedia', '>', 0);
    }

    // Cek apakah beasiswa masih aktif
    public function masihAktif()
    {
        return $this->status === 'aktif' && 
               $this->tanggal_selesai >= now() && 
               $this->kuota_tersedia > 0;
    }

    // Format jumlah dana
    public function getJumlahDanaFormatAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_dana, 0, ',', '.');
    }
}
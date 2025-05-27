<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_beasiswa';

    protected $fillable = [
        'id_pengguna',
        'id_beasiswa',
        'alasan_mendaftar',
        'berkas_transkrip',
        'berkas_cv',
        'berkas_surat_rekomendasi',
        'status_pendaftaran',
        'catatan_admin',
        'tanggal_daftar',
        'tanggal_keputusan'
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'tanggal_keputusan' => 'datetime'
    ];

    // Relasi dengan pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    // Relasi dengan beasiswa
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'id_beasiswa');
    }

    // Scope untuk pendaftaran yang menunggu
    public function scopeMenunggu($query)
    {
        return $query->where('status_pendaftaran', 'menunggu');
    }

    // Scope untuk pendaftaran yang diterima
    public function scopeDiterima($query)
    {
        return $query->where('status_pendaftaran', 'diterima');
    }

    // Scope untuk pendaftaran yang ditolak
    public function scopeDitolak($query)
    {
        return $query->where('status_pendaftaran', 'ditolak');
    }

    // Get status badge color
    public function getStatusBadgeAttribute()
    {
        switch ($this->status_pendaftaran) {
            case 'menunggu':
                return 'warning';
            case 'diterima':
                return 'success';
            case 'ditolak':
                return 'danger';
            default:
                return 'secondary';
        }
    }
}
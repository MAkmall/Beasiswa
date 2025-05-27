<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi_pengumuman',
        'jenis',
        'tampilkan'
    ];

    protected $casts = [
        'tampilkan' => 'boolean'
    ];

    // Scope untuk pengumuman yang ditampilkan
    public function scopeTampilkan($query)
    {
        return $query->where('tampilkan', true);
    }

    // Scope berdasarkan jenis
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }
}
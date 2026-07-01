<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pekerjaans';

    protected $fillable = [
        'pegawai_id',
        'jabatan_lama',
        'jabatan_baru',
        'tanggal_perubahan',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_perubahan' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

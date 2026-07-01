<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
        'foto',
        'status_pegawai',
        'jabatan_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function riwayatPekerjaans()
    {
        return $this->hasMany(RiwayatPekerjaan::class, 'pegawai_id');
    }
}

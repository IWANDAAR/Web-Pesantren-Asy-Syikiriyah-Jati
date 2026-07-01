<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\RiwayatPekerjaan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (Admin & Pimpinan)
        User::create([
            'name' => 'Administrator SIMPEG',
            'email' => 'admin@syakiriyah.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pimpinan Pondok Pesantren',
            'email' => 'pimpinan@syakiriyah.sch.id',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
        ]);

        // 2. Seed Jabatans
        $jabatansData = [
            ['nama_jabatan' => 'Kepala Madrasah', 'deskripsi' => 'Memimpin kegiatan akademik dan manajerial madrasah.'],
            ['nama_jabatan' => 'Guru Agama', 'deskripsi' => 'Mengajar mata pelajaran keagamaan Islam / kepesantrenan.'],
            ['nama_jabatan' => 'Guru Umum', 'deskripsi' => 'Mengajar mata pelajaran umum sesuai kurikulum nasional.'],
            ['nama_jabatan' => 'Kepala Tata Usaha', 'deskripsi' => 'Mengkoordinasi administrasi kepegawaian dan kesiswaan.'],
            ['nama_jabatan' => 'Staff Administrasi', 'deskripsi' => 'Melaksanakan pelayanan administrasi dan keuangan.'],
            ['nama_jabatan' => 'Pustakawan', 'deskripsi' => 'Mengelola perpustakaan pondok pesantren.'],
            ['nama_jabatan' => 'Security', 'deskripsi' => 'Menjaga keamanan dan ketertiban area pesantren.'],
            ['nama_jabatan' => 'Cleaning Service', 'deskripsi' => 'Menjaga kebersihan lingkungan pesantren.'],
        ];

        $jabatans = [];
        foreach ($jabatansData as $jabatan) {
            $jabatans[$jabatan['nama_jabatan']] = Jabatan::create($jabatan);
        }

        // 3. Seed Pegawais
        $pegawaisData = [
            [
                'nip' => '198205122010011001',
                'nama_lengkap' => 'H. Ahmad Syakir, Lc.',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1982-05-12',
                'alamat' => 'Perum Asri Indah No. 12, Bekasi',
                'no_hp' => '081234567890',
                'email' => 'ahmad.syakir@gmail.com',
                'foto' => null,
                'status_pegawai' => 'Guru',
                'jabatan_id' => $jabatans['Kepala Madrasah']->id,
            ],
            [
                'nip' => '198708232014021002',
                'nama_lengkap' => 'Ust. Muhammad Rasyid, S.Ag',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1987-08-23',
                'alamat' => 'Kp. Jati Baru RT 02/RW 04, Sidoarjo',
                'no_hp' => '082345678901',
                'email' => 'rasyid@gmail.com',
                'foto' => null,
                'status_pegawai' => 'Guru',
                'jabatan_id' => $jabatans['Guru Agama']->id,
            ],
            [
                'nip' => '199104052018032003',
                'nama_lengkap' => 'Siti Aminah, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Tangerang',
                'tanggal_lahir' => '1991-04-05',
                'alamat' => 'Perum Cluster Hijau Blok B/5, Tangerang',
                'no_hp' => '083456789012',
                'email' => 'siti.aminah@gmail.com',
                'foto' => null,
                'status_pegawai' => 'Guru',
                'jabatan_id' => $jabatans['Guru Umum']->id,
            ],
            [
                'nip' => '199312152019041004',
                'nama_lengkap' => 'Budi Santoso, S.Kom',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Depok',
                'tanggal_lahir' => '1993-12-15',
                'alamat' => 'Jl. Kenanga Raya No. 45, Depok',
                'no_hp' => '084567890123',
                'email' => 'budi@gmail.com',
                'foto' => null,
                'status_pegawai' => 'Tenaga Administrasi',
                'jabatan_id' => $jabatans['Kepala Tata Usaha']->id,
            ],
            [
                'nip' => '199507112021052005',
                'nama_lengkap' => 'Laila Fitriani, A.Md.',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bekasi',
                'tanggal_lahir' => '1995-07-11',
                'alamat' => 'Kp. Jati RT 01/RW 03, Bekasi',
                'no_hp' => '085678901234',
                'email' => 'laila@gmail.com',
                'foto' => null,
                'status_pegawai' => 'Tenaga Administrasi',
                'jabatan_id' => $jabatans['Pustakawan']->id,
            ],
            [
                'nip' => '199002282017061006',
                'nama_lengkap' => 'Slamet Riyadi',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Sukabumi',
                'tanggal_lahir' => '1990-02-28',
                'alamat' => 'Jl. Jati Mekar Indah RT 05/RW 01, Bekasi',
                'no_hp' => '086789012345',
                'email' => 'slamet@gmail.com',
                'foto' => null,
                'status_pegawai' => 'Staf Pendukung',
                'jabatan_id' => $jabatans['Security']->id,
            ],
            [
                'nip' => '199609102022071007',
                'nama_lengkap' => 'Agus Setiawan',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Karawang',
                'tanggal_lahir' => '1996-09-10',
                'alamat' => 'Kp. Rawa Indah RT 03/RW 02, Bekasi',
                'no_hp' => '087890123456',
                'email' => 'agus@gmail.com',
                'foto' => null,
                'status_pegawai' => 'Staf Pendukung',
                'jabatan_id' => $jabatans['Cleaning Service']->id,
            ],
        ];

        foreach ($pegawaisData as $pegawaiData) {
            $peg = Pegawai::create($pegawaiData);
            
            // If the employee is the Kepala Madrasah, simulate promotion history
            if ($peg->nip == '198205122010011001') {
                // Initial
                RiwayatPekerjaan::create([
                    'pegawai_id' => $peg->id,
                    'jabatan_lama' => null,
                    'jabatan_baru' => 'Guru Agama',
                    'tanggal_perubahan' => Carbon::parse('2010-01-01'),
                    'keterangan' => 'Pengangkatan Pertama Pegawai Baru',
                ]);
                
                // Promotion
                RiwayatPekerjaan::create([
                    'pegawai_id' => $peg->id,
                    'jabatan_lama' => 'Guru Agama',
                    'jabatan_baru' => 'Kepala Madrasah',
                    'tanggal_perubahan' => Carbon::parse('2018-07-01'),
                    'keterangan' => 'Promosi Jabatan sebagai Kepala Madrasah',
                ]);
            } else if ($peg->nip == '199312152019041004') {
                // Budi initial
                RiwayatPekerjaan::create([
                    'pegawai_id' => $peg->id,
                    'jabatan_lama' => null,
                    'jabatan_baru' => 'Staff Administrasi',
                    'tanggal_perubahan' => Carbon::parse('2019-04-01'),
                    'keterangan' => 'Pengangkatan Pertama Pegawai Baru',
                ]);
                
                // Promotion
                RiwayatPekerjaan::create([
                    'pegawai_id' => $peg->id,
                    'jabatan_lama' => 'Staff Administrasi',
                    'jabatan_baru' => 'Kepala Tata Usaha',
                    'tanggal_perubahan' => Carbon::parse('2023-01-10'),
                    'keterangan' => 'Promosi menjadi Kepala Tata Usaha',
                ]);
            } else {
                // Standard initial record
                RiwayatPekerjaan::create([
                    'pegawai_id' => $peg->id,
                    'jabatan_lama' => null,
                    'jabatan_baru' => $peg->jabatan->nama_jabatan,
                    'tanggal_perubahan' => Carbon::now()->subMonths(6),
                    'keterangan' => 'Pengangkatan Pertama Pegawai Baru',
                ]);
            }
        }
    }
}

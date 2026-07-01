<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kepegawaian - Pondok Pesantren Asy Syakiriyah Jati</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat styling */
        .header-container {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .logo-cell {
            width: 10%;
            text-align: center;
            vertical-align: middle;
        }
        .kop-cell {
            width: 90%;
            text-align: center;
            vertical-align: middle;
            padding-right: 10%;
        }
        .title-main {
            font-size: 20px;
            font-weight: bold;
            color: #1E3A8A;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .title-sub {
            font-size: 14px;
            font-weight: 500;
            color: #4B5563;
            margin: 3px 0 0 0;
        }
        .title-address {
            font-size: 10px;
            color: #6B7280;
            margin: 4px 0 0 0;
            font-style: italic;
        }
        .double-line {
            border-top: 2px solid #1E3A8A;
            border-bottom: 0.5px solid #1E3A8A;
            height: 3px;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        /* Document Title */
        .doc-title {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            color: #111827;
            margin-bottom: 15px;
            text-decoration: underline;
        }
        
        .meta-info {
            width: 100%;
            margin-bottom: 12px;
            font-size: 10px;
        }
        .meta-info td {
            padding: 2px 0;
        }

        /* Table styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .data-table th {
            background-color: #2563EB;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
            padding: 7px 5px;
            border: 1px solid #1D4ED8;
            text-align: left;
        }
        .data-table td {
            padding: 6px 5px;
            border: 1px solid #E5E7EB;
            font-size: 9px;
        }
        .data-table tr:nth-child(even) {
            background-color: #F8FAFC;
        }
        
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #1E3A8A;
            margin-top: 15px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        /* Footer / Signature styling */
        .footer-container {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }
        .sig-cell-left {
            width: 70%;
        }
        .sig-cell-right {
            width: 30%;
            text-align: center;
            font-size: 10px;
        }
        .sig-space {
            height: 60px;
        }
        .sig-name {
            font-weight: bold;
            text-decoration: underline;
        }
        .sig-title {
            color: #4B5563;
            margin-top: 2px;
        }
    </style>
</head>
<body>

    <!-- Header Kop Surat -->
    <table class="header-container">
        <tr>
            <td class="logo-cell">
                <!-- SVG Emblem Logo Islamic -->
                <svg width="55" height="55" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="46" fill="none" stroke="#1E3A8A" stroke-width="4"/>
                    <path d="M50 15 L80 45 L70 45 L70 80 L30 80 L30 45 L20 45 Z" fill="#2563EB"/>
                    <path d="M45 45 Q50 35 55 45 Q50 55 45 45" fill="#FFFFFF"/>
                    <polygon points="50,20 53,28 62,28 55,33 57,42 50,37 43,42 45,33 38,28 47,28" fill="#F59E0B"/>
                </svg>
            </td>
            <td class="kop-cell">
                <h1 class="title-main">Pondok Pesantren Asy-Syakiriyah Jati</h1>
                <h2 class="title-sub">Sistem Informasi Kepegawaian (SIMPEG)</h2>
                <p class="title-address">Jl. Asy-Syakiriyah Jati No. 45, Kecamatan Jati, Kota Tangerang. Telp (021) 555-1234</p>
            </td>
        </tr>
    </table>

    <div class="double-line"></div>

    <div class="doc-title">Laporan Data Kepegawaian</div>

    <!-- Metadata Laporan -->
    <table class="meta-info">
        <tr>
            <td style="width: 15%; font-weight: bold;">Status Filter</td>
            <td style="width: 2%;">:</td>
            <td style="width: 33%;">{{ $filterStatus }}</td>
            <td style="width: 15%; font-weight: bold;">Tanggal Cetak</td>
            <td style="width: 2%;">:</td>
            <td style="width: 33%;">{{ $tanggalCetak }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Jabatan Filter</td>
            <td>:</td>
            <td>{{ $filterJabatanName }}</td>
            <td style="font-weight: bold;">Dicetak Oleh</td>
            <td>:</td>
            <td>{{ Auth::user()->name }}</td>
        </tr>
    </table>

    <!-- 1. Tabel Data Pegawai -->
    <div class="section-title">1. Daftar Pegawai</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%; text-align: center;">No</th>
                <th style="width: 13%;">NIP</th>
                <th style="width: 18%;">Nama Lengkap</th>
                <th style="width: 9%;">Jenis Kelamin</th>
                <th style="width: 15%;">Jabatan</th>
                <th style="width: 12%;">Status Pegawai</th>
                <th style="width: 11%;">No HP</th>
                <th style="width: 18%;">Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pegawais as $index => $pegawai)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold;">{{ $pegawai->nip }}</td>
                    <td>{{ $pegawai->nama_lengkap }}</td>
                    <td>{{ $pegawai->jenis_kelamin }}</td>
                    <td>{{ $pegawai->jabatan->nama_jabatan }}</td>
                    <td>{{ $pegawai->status_pegawai }}</td>
                    <td>{{ $pegawai->no_hp }}</td>
                    <td>{{ $pegawai->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #777;">Tidak ada data pegawai yang memenuhi filter.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 2. Tabel Riwayat Mutasi -->
    <div class="section-title" style="page-break-before: auto;">2. Log Riwayat Pekerjaan</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%; text-align: center;">No</th>
                <th style="width: 18%;">Nama Pegawai</th>
                <th style="width: 13%;">NIP</th>
                <th style="width: 18%;">Jabatan Lama</th>
                <th style="width: 18%;">Jabatan Baru</th>
                <th style="width: 11%;">Tanggal Perubahan</th>
                <th style="width: 18%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayats as $index => $riwayat)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold;">{{ $riwayat->pegawai->nama_lengkap }}</td>
                    <td>{{ $riwayat->pegawai->nip }}</td>
                    <td>{{ $riwayat->jabatan_lama ?? '-' }}</td>
                    <td>{{ $riwayat->jabatan_baru }}</td>
                    <td>{{ $riwayat->tanggal_perubahan->locale('id')->translatedFormat('d M Y') }}</td>
                    <td>{{ $riwayat->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #777;">Tidak ada log riwayat mutasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="footer-container">
        <table class="signature-table">
            <tr>
                <td class="sig-cell-left"></td>
                <td class="sig-cell-right">
                    Tangerang, {{ $tanggalCetak }}<br>
                    <strong>Mengetahui,</strong><br>
                    Pimpinan Pondok Pesantren
                    <div class="sig-space"></div>
                    <div class="sig-name">KH. Syakir Asy-Syakiriy, M.A.</div>
                    <div class="sig-title">NIP. 197001012000011001</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>

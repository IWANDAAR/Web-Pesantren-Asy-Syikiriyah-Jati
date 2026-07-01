@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard SIMPEG')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('styles')
    <style>
        /* Modern Cards styling */
        .info-box-modern {
            display: flex;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            padding: 20px;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid #F1F5F9;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .info-box-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }
        .info-box-icon-modern {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
            color: #fff;
        }
        .info-box-content-modern .info-box-text {
            color: #64748B;
            font-weight: 500;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            margin-bottom: 4px;
        }
        .info-box-content-modern .info-box-number {
            color: #1E293B;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        /* Stats specific colors - Pesantren Green & Gold Theme */
        .bg-primary-light { background-color: #047857; }
        .bg-success-light { background-color: #10B981; }
        .bg-warning-light { background-color: #F59E0B; }
        .bg-info-light { background-color: #D97706; }
        .bg-danger-light { background-color: #EF4444; }

        .welcome-card {
            background: linear-gradient(135deg, #064E3B 0%, #047857 100%);
            border-radius: 16px;
            color: #ffffff;
            padding: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(4, 120, 87, 0.25);
            margin-bottom: 30px;
            border-left: 5px solid #FBBF24; /* Gold left border */
        }
        .welcome-card::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }
    </style>
@endsection

@section('content')
    <!-- Welcome Card -->
    <div class="welcome-card border-0">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="font-weight-bold mb-2">Selamat Datang di SIMPEG!</h2>
                <p class="mb-0 text-white-50">Sistem Informasi Kepegawaian Pondok Pesantren Asy-Syakiriyah Jati. Anda login sebagai <strong class="text-white">{{ Auth::user()->name }}</strong> ({{ ucfirst(Auth::user()->role) }}).</p>
            </div>
            <div class="col-md-4 text-right d-none d-md-block">
                <i class="fa-solid fa-mosque fa-4x text-white-50"></i>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="row">
        <!-- Total Pegawai -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="info-box-modern">
                <div class="info-box-icon-modern bg-primary-light">
                    <i class="fas fa-users"></i>
                </div>
                <div class="info-box-content-modern">
                    <div class="info-box-text">Total Pegawai</div>
                    <div class="info-box-number">{{ $totalPegawai }}</div>
                </div>
            </div>
        </div>

        <!-- Total Guru -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="info-box-modern">
                <div class="info-box-icon-modern bg-success-light">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="info-box-content-modern">
                    <div class="info-box-text">Total Guru</div>
                    <div class="info-box-number">{{ $totalGuru }}</div>
                </div>
            </div>
        </div>

        <!-- Total Tenaga Administrasi -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="info-box-modern">
                <div class="info-box-icon-modern bg-warning-light">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="info-box-content-modern">
                    <div class="info-box-text">Administrasi</div>
                    <div class="info-box-number">{{ $totalAdministrasi }}</div>
                </div>
            </div>
        </div>

        <!-- Total Staf Pendukung -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="info-box-modern">
                <div class="info-box-icon-modern bg-info-light">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <div class="info-box-content-modern">
                    <div class="info-box-text">Staf Pendukung</div>
                    <div class="info-box-number">{{ $totalStaf }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <!-- Grafik Pegawai per Jabatan -->
        <div class="col-lg-8 col-md-12">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fa-solid fa-chart-bar mr-2 text-primary"></i>Grafik Pegawai Per Jabatan</h5>
                </div>
                <div class="card-body">
                    <div class="position-relative" style="height: 350px;">
                        <canvas id="chartJabatan" height="350"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Status Pegawai -->
        <div class="col-lg-4 col-md-12">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fa-solid fa-chart-pie mr-2 text-success"></i>Grafik Status Pegawai</h5>
                </div>
                <div class="card-body">
                    <div class="position-relative" style="height: 350px; display: flex; align-items: center; justify-content: center;">
                        <canvas id="chartStatus" height="280"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(function () {
            // Data for Position Chart
            const chartJabatanLabels = @json($chartJabatanLabels);
            const chartJabatanData = @json($chartJabatanData);

            // Data for Status Chart
            const chartStatusLabels = @json($chartStatusLabels);
            const chartStatusData = @json($chartStatusData);

            // Chart Jabatan (Bar Chart)
            const ctxJabatan = document.getElementById('chartJabatan').getContext('2d');
            new Chart(ctxJabatan, {
                type: 'bar',
                data: {
                    labels: chartJabatanLabels,
                    datasets: [{
                        label: 'Jumlah Pegawai',
                        data: chartJabatanData,
                        backgroundColor: '#047857', /* Emerald Green */
                        borderColor: '#047857',
                        borderWidth: 1,
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: '#64748B'
                            },
                            grid: {
                                color: '#F1F5F9'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#64748B'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Chart Status (Doughnut Chart)
            const ctxStatus = document.getElementById('chartStatus').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: chartStatusLabels,
                    datasets: [{
                        data: chartStatusData,
                        backgroundColor: [
                            '#10B981', // Guru (Emerald)
                            '#F59E0B', // Tenaga Administrasi (Amber)
                            '#D97706'  // Staf Pendukung (Gold)
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    family: 'Outfit',
                                    size: 12
                                },
                                color: '#64748B'
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
@endsection

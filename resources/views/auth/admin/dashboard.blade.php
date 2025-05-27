@extends('layouts.app')

@section('title', 'Dashboard Admin - Sistem Beasiswa')

@section('sidebar')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        
        <li class="nav-item {{ request()->routeIs('admin.beasiswa.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                    Kelola Beasiswa
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.beasiswa.index') }}" class="nav-link {{ request()->routeIs('admin.beasiswa.index') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.beasiswa.create') }}" class="nav-link {{ request()->routeIs('admin.beasiswa.create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Beasiswa</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Kelola Pendaftaran</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Kelola Peserta</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Laporan</p>
            </a>
        </li>
    </ul>
@endsection

@section('page-title', 'Dashboard Admin')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
<style>
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 20px;
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .stats-card:hover::before {
        opacity: 1;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .stats-card.success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .stats-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .stats-card.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stats-card.danger {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }
    
    .chart-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .chart-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .activity-item {
        border-left: 4px solid #667eea;
        padding: 15px;
        margin-bottom: 10px;
        background: #f8f9fa;
        border-radius: 0 10px 10px 0;
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }
    
    .quick-action-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 15px;
        color: white;
        padding: 15px 25px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .quick-action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .quick-action-btn:hover::before {
        left: 100%;
    }
    
    .quick-action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        color: white;
        text-decoration: none;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .pending-badge {
        background: #ffc107;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
</style>
@endpush

@section('content')
<!-- Welcome Card -->
<div class="row">
    <div class="col-12">
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2">
                        <i class="fas fa-sun"></i>
                        Selamat Datang, {{ Auth::user()->nama }}!
                    </h2>
                    <p class="mb-0 opacity-75">
                        Kelola sistem beasiswa dengan mudah dan efisien. 
                        Hari ini adalah {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <i class="fas fa-user-shield" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box stats-card">
            <div class="inner">
                <h3>{{ $totalBeasiswa ?? 0 }}</h3>
                <p>Total Beasiswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box stats-card success">
            <div class="inner">
                <h3>{{ $beasiswaAktif ?? 0 }}</h3>
                <p>Beasiswa Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box stats-card warning">
            <div class="inner">
                <h3>{{ $totalPeserta ?? 0 }}</h3>
                <p>Total Peserta</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box stats-card info">
            <div class="inner">
                <h3>
                    {{ $pendaftaranMenunggu ?? 0 }}
                    @if(($pendaftaranMenunggu ?? 0) > 0)
                        <span class="badge pending-badge ms-2">!</span>
                    @endif
                </h3>
                <p>Menunggu Review</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
</div>

<!-- Additional Statistics Row -->
<div class="row mb-4">
    <div class="col-lg-6 col-12">
        <div class="small-box stats-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="inner">
                <h3>{{ $pendaftaranDiterima ?? 0 }}</h3>
                <p>Pendaftaran Diterima</p>
            </div>
            <div class="icon">
                <i class="fas fa-check"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-12">
        <div class="small-box stats-card" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
            <div class="inner">
                <h3>{{ $pendaftaranDitolak ?? 0 }}</h3>
                <p>Pendaftaran Ditolak</p>
            </div>
            <div class="icon">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card chart-container">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-bolt text-primary"></i>
                    Aksi Cepat
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.beasiswa.create') }}" class="quick-action-btn w-100 text-center">
                            <i class="fas fa-plus-circle mb-2 d-block"></i>
                            Tambah Beasiswa Baru
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.pendaftaran.index') }}" class="quick-action-btn w-100 text-center">
                            <i class="fas fa-file-alt mb-2 d-block"></i>
                            Review Pendaftaran
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.beasiswa.index') }}" class="quick-action-btn w-100 text-center">
                            <i class="fas fa-list mb-2 d-block"></i>
                            Kelola Beasiswa
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.laporan.index') }}" class="quick-action-btn w-100 text-center">
                            <i class="fas fa-chart-line mb-2 d-block"></i>
                            Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Recent Activity -->
<div class="row">
    <!-- Chart -->
    <div class="col-md-8">
        <div class="card chart-container">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar text-primary"></i>
                    Statistik Pendaftaran (7 Hari Terakhir)
                </h3>
            </div>
            <div class="card-body">
                <canvas id="pendaftaranChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="col-md-4">
        <div class="card chart-container">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-graduation-cap text-primary"></i>
                    Beasiswa Terbaru
                </h3>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                @forelse($beasiswaTerbaru as $beasiswa)
                    <div class="activity-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>Beasiswa Baru: {{ $beasiswa->nama }}</strong>
                                <p class="mb-1 text-muted small">
                                    Kuota: {{ $beasiswa->kuota }} peserta
                                    @if($beasiswa->batas_pendaftaran)
                                        | Deadline: {{ \Carbon\Carbon::parse($beasiswa->batas_pendaftaran)->format('d M Y') }}
                                    @endif
                                </p>
                            </div>
                            <small class="text-muted">{{ $beasiswa->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>Belum ada beasiswa terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Applications Table -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card chart-container">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-list text-primary"></i>
                    Pendaftaran Terbaru
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-primary btn-sm">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Beasiswa</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaranTerbaru as $pendaftaran)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-user-circle fa-2x text-muted"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $pendaftaran->pengguna->nama }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $pendaftaran->pengguna->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $pendaftaran->beasiswa->nama }}</td>
                                <td>{{ $pendaftaran->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($pendaftaran->status == 'menunggu')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($pendaftaran->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($pendaftaran->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    Belum ada pendaftaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
$(document).ready(function() {
    // Chart for applications
    const ctx = document.getElementById('pendaftaranChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @php
                    $labels = [];
                    for($i = 6; $i >= 0; $i--) {
                        $labels[] = "'" . \Carbon\Carbon::now()->subDays($i)->format('d M') . "'";
                    }
                    echo implode(', ', $labels);
                @endphp
            ],
            datasets: [{
                label: 'Pendaftaran',
                data: [
                    @php
                        $data = [];
                        for($i = 6; $i >= 0; $i--) {
                            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
                            $count = App\Models\PendaftaranBeasiswa::whereDate('created_at', $date)->count();
                            $data[] = $count;
                        }
                        echo implode(', ', $data);
                    @endphp
                ],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            elements: {
                point: {
                    radius: 6,
                    hoverRadius: 8,
                    backgroundColor: '#667eea',
                    borderColor: '#fff',
                    borderWidth: 2
                }
            }
        }
    });

    // Auto refresh data setiap 5 menit
    setInterval(function() {
        // Ajax call to refresh data
        console.log('Refreshing dashboard data...');
    }, 300000);
});
</script>
@endpush
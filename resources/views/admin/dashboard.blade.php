@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <main>
        <div class="container-fluid px-4">
            
            <!-- Header Section -->
            <div class="page-header mt-4 mb-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: var(--accent-yellow); opacity: 0.1; border-radius: 50%;"></div>
                <div class="d-flex justify-content-between align-items-center w-100" style="position: relative; z-index: 1;">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-flex align-items-center mb-0">
                                <h2 class="fw-bold text-dark mb-0 me-3" style="font-size: 1.5rem;">Dashboard Center</h2>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 d-flex align-items-center" style="font-size: 0.6rem; padding: 0.4em 0.8em;">
                                    <span class="spinner-grow spinner-grow-sm me-1" role="status" style="width: 6px; height: 6px;"></span>
                                    LIVE
                                </span>
                            </div>
                            <p class="text-muted small mb-0" style="font-size: 0.75rem;">LKP Qalsum Education Center — Panel Kendali Utama</p>
                            <!-- <p class="text-muted small mb-0" style="font-size: 0.75rem;"><i>Welcome</i> <b>Alamsyah</b> |<b>Admin</b> </p> -->

                        </div>
                    </div>
                    <div class="d-flex align-items-center d-none d-sm-flex">
                        <div class="text-end me-3">
                            <div class="fw-bold text-dark" style="font-size: 0.85rem;">Alamsyah</div>
                            <!-- <div class="text-muted small" style="font-size: 0.5rem;">Admin</div> -->
                            <div class="text-xs text-success small d-flex align-items-center justify-content-end" style="font-size: 0.6rem;">
                                <span class="spinner-off spinner-grow-sm me-1" role="status" style="width: 5px; height: 5px; color: #10b981;"></span>
                                Admin
                            </div>
                        </div>
                        <div class="position-relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=1e293b&color=ffffff" alt="Avatar" class="rounded-circle border border-2 border-white shadow-sm" width="42" height="42">
                            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle" style="width: 10px; height: 10px;"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Left Main Column (col-lg-9) -->
                <div class="col-lg-9">
                    <!-- Horizontal Statistik Cards (Reduced to 4) -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card bg-soft-info shadow-sm">
                                <div class="icon-container text-info">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="card-data">
                                    <div class="text-xs">Total Siswa</div>
                                    <h4 class="fw-bold mb-0">{{ $jumlah_siswa }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card bg-soft-danger shadow-sm">
                                <div class="icon-container text-danger">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="card-data">
                                    <div class="text-xs">Instruktur</div>
                                    <h4 class="fw-bold mb-0">{{ $jumlahPegawai }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card bg-soft-success shadow-sm">
                                <div class="icon-container text-success">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="card-data">
                                    <div class="text-xs">Total Kursus</div>
                                    <h4 class="fw-bold mb-0">{{ $jumlahKelasAktif }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card bg-soft-warning shadow-sm">
                                <div class="icon-container text-warning">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="card-data">
                                    <div class="text-xs">Penghargaan</div>
                                    <h4 class="fw-bold mb-0">12</h4> <!-- Static as requested -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Strategi & Insight Row (Chart & Top Students side-by-side) -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="fw-bold mb-0">Tren Pendaftaran</h5>
                                        <small class="text-muted">6 bulan terakhir</small>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div style="height: 250px;">
                                        <canvas id="chartPendaftaranSiswa"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Siswa Berprestasi -->
                            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); color: white;">
                                <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                                    <div class="mb-3">
                                        <i class="fas fa-trophy text-accent-yellow fs-2"></i>
                                        <h6 class="fw-bold mt-2 mb-0">Siswa Terbaik</h6>
                                    </div>
                                    <div class="d-flex justify-content-around align-items-end mb-0 pt-2">
                                        @foreach($top_siswa as $key => $siswa)
                                            <div class="top-student-card-simple {{ $key == 0 ? 'order-2' : ($key == 1 ? 'order-1' : 'order-3') }}" 
                                                 style="transform: {{ $key == 0 ? 'translateY(-10px) scale(1.1)' : 'none' }};">
                                                <div class="avatar-circle mb-1" style="width: {{ $key == 0 ? '55px' : '40px' }}; height: {{ $key == 0 ? '55px' : '40px' }}; border: 2px solid {{ $key == 0 ? '#eab308' : ($key == 1 ? '#cbd5e1' : '#b45309') }}; border-radius: 50%; padding: 2px; display: inline-block;">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->siswa->nama ?? 'S') }}&background=random" class="rounded-circle img-fluid">
                                                </div>
                                                <div class="fw-bold x-small text-truncate d-block" style="max-width: 60px; font-size: 0.6rem;">{{ $siswa->siswa->nama ?? 'N/A' }}</div>
                                                <div class="badge bg-white bg-opacity-20 rounded-pill" style="font-size: 0.5rem;">{{ $siswa->nilai }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tables Row -->
                    <div class="row mb-4">
                        <!-- Pendaftaran Baru -->
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold mb-0">Pendaftaran Terbaru</h6>
                                    <a href="{{ url('admin/siswa') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3" style="font-size: 0.7rem;">Semua</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="ps-4">Siswa</th>
                                                    <th>Kursus</th>
                                                    <th>Waktu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pendaftaran_baru_list->take(5) as $siswa)
                                                    <tr>
                                                        <td class="ps-4">
                                                            <div class="fw-bold text-dark small">{{ $siswa->nama }}</div>
                                                            <div class="text-xs text-muted">{{ $siswa->nomor_siswa }}</div>
                                                        </td>
                                                        <td><span class="badge bg-primary bg-opacity-10 text-primary" style="font-size: 0.6rem;">{{ $siswa->jadwal->kelas->nama_kelas ?? 'N/A' }}</span></td>
                                                        <td class="text-muted small">{{ $siswa->created_at->diffForHumans() }}</td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada data</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pembayaran Tunda -->
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold mb-0">Tunggakan Bayar</h6>
                                    <a href="{{ url('admin/pembayaran') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3" style="font-size: 0.7rem;">Semua</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="ps-4">Siswa</th>
                                                    <th>Sisa</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pembayaran_tertunda->take(5) as $pembayaran)
                                                    <tr>
                                                        <td class="ps-4">
                                                            <div class="fw-bold text-dark small">{{ $pembayaran->siswa->nama ?? 'N/A' }}</div>
                                                            <div class="text-xs text-muted">{{ $pembayaran->siswa->nomor_siswa ?? '-' }}</div>
                                                        </td>
                                                        <td class="text-danger fw-bold small">Rp {{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}</td>
                                                        <td><a href="{{ url('admin/pembayaran/'.$pembayaran->id.'/edit') }}" class="btn btn-sm btn-icon bg-soft-warning"><i class="fas fa-arrow-right"></i></a></td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="3" class="text-center py-4 text-muted">Semua lunas!</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm p-4">
                                <div class="fw-bold small text-muted text-uppercase mb-4" style="letter-spacing: 0.1em; font-size: 0.6rem;">Akses Cepat Panel Kendali</div>
                                <div class="row text-center">
                                    @php
                                        $actions = [
                                            ['url' => 'admin/pendaftaran', 'icon' => 'fa-plus', 'color' => 'primary', 'label' => 'Daftar'],
                                            ['url' => 'admin/pembayaran', 'icon' => 'fa-money-bill-wave', 'color' => 'success', 'label' => 'Bayar'],
                                            ['url' => 'admin/nilai', 'icon' => 'fa-edit', 'color' => 'info', 'label' => 'Nilai'],
                                            ['url' => 'admin/sertifikat', 'icon' => 'fa-file-contract', 'color' => 'warning', 'label' => 'Cert'],
                                            ['url' => 'admin/staff', 'icon' => 'fa-users-cog', 'color' => 'dark', 'label' => 'Staff'],
                                            ['url' => '/', 'icon' => 'fa-external-link-alt', 'color' => 'danger', 'label' => 'Web'],
                                        ];
                                    @endphp
                                    @foreach($actions as $action)
                                        <div class="col-4 col-md-2 mb-3 mb-md-0">
                                            <a href="{{ url($action['url']) }}" class="text-decoration-none d-block">
                                                <div class="mx-auto mb-2 d-flex align-items-center justify-content-center rounded-circle bg-soft-{{ $action['color'] }}" style="width: 50px; height: 50px;">
                                                    <i class="fas {{ $action['icon'] }} text-{{ $action['color'] }}"></i>
                                                </div>
                                                <div class="text-dark fw-bold small" style="font-size: 0.7rem;">{{ $action['label'] }}</div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Column (col-lg-3) -->
                <div class="col-lg-3">
                    <!-- Modern Weekly Calendar Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <button class="btn btn-sm btn-light rounded-circle p-1" style="width: 24px; height: 24px; font-size: 0.6rem;"><i class="fas fa-chevron-left"></i></button>
                                <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ now()->translatedFormat('F Y') }}</h6>
                                <button class="btn btn-sm btn-light rounded-circle p-1" style="width: 24px; height: 24px; font-size: 0.6rem;"><i class="fas fa-chevron-right"></i></button>
                            </div>
                            
                            <div class="d-flex justify-content-between text-center">
                                @php
                                    $startOfWeek = now()->startOfWeek(\Carbon\Carbon::SUNDAY);
                                @endphp
                                @for($i=0; $i<7; $i++)
                                    @php $day = $startOfWeek->copy()->addDays($i); @endphp
                                    <div class="calendar-day-col {{ $day->isToday() ? 'active' : '' }}">
                                        <div class="text-muted mb-2" style="font-size: 0.6rem; font-weight: 600;">{{ $day->translatedFormat('D') }}</div>
                                        <div class="day-number">{{ $day->format('d') }}</div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Agenda Section (Large Color-Coded Cards - Static) -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center pb-0">
                            <h6 class="fw-bold mb-0">Agenda</h6>
                            <i class="fas fa-ellipsis-h text-muted small"></i>
                        </div>
                        <div class="card-body p-4 pt-3">
                            <!-- Agenda Item 1 -->
                            <div class="agenda-item-premium bg-soft-primary-vibrant mb-3">
                                <div class="time-box border-end pe-3 me-3">
                                    <div class="fw-bold small">08:00</div>
                                    <div class="text-xs opacity-75">am</div>
                                </div>
                                <div class="content-box">
                                    <div class="text-xs fw-bold opacity-75 mb-1">Semua Kelas</div>
                                    <div class="fw-bold small text-dark">Homeroom & Pengumuman</div>
                                </div>
                            </div>
                            <!-- Agenda Item 2 -->
                            <div class="agenda-item-premium bg-soft-warning-vibrant mb-3">
                                <div class="time-box border-end pe-3 me-3">
                                    <div class="fw-bold small">10:00</div>
                                    <div class="text-xs opacity-75">am</div>
                                </div>
                                <div class="content-box">
                                    <div class="text-xs fw-bold opacity-75 mb-1">Grade 3-5</div>
                                    <div class="fw-bold small text-dark">Math Review & Practice</div>
                                </div>
                            </div>
                            <!-- Agenda Item 3 -->
                            <div class="agenda-item-premium bg-soft-info-vibrant mb-3">
                                <div class="time-box border-end pe-3 me-3">
                                    <div class="fw-bold small">10:30</div>
                                    <div class="text-xs opacity-75">am</div>
                                </div>
                                <div class="content-box">
                                    <div class="text-xs fw-bold opacity-75 mb-1">Grade 6-8</div>
                                    <div class="fw-bold small text-dark">Science Experiment</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Section -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0">Messages</h6>
                            <a href="#" class="text-xs text-muted text-decoration-none fw-bold">View All</a>
                        </div>
                        <div class="card-body p-4 pt-2">
                            <div class="d-flex align-items-start mb-4">
                                <img src="https://ui-avatars.com/api/?name=Lila+Ramirez&background=random" class="rounded-circle me-3 shadow-sm" width="40" height="40">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold small mb-0">Dr. Lila Ramirez</h6>
                                        <span class="text-xs text-muted">9:00 AM</span>
                                    </div>
                                    <p class="text-muted x-small mb-0 mt-1 line-clamp-2" style="font-size: 0.65rem;">Please ensure the monthly attendance report is accurate before the April 30th deadline.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-0">
                                <div class="position-relative me-3">
                                    <img src="https://ui-avatars.com/api/?name=Heather+Morris&background=random" class="rounded-circle shadow-sm" width="40" height="40">
                                    <span class="position-absolute bottom-0 end-0 p-1 bg-primary rounded-circle border border-white" style="font-size: 0.4rem; color: white; display: flex; align-items: center; justify-content: center; width: 14px; height: 14px;">4</span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold small mb-0">Ms. Heather Morris</h6>
                                        <span class="text-xs text-muted">10:15 AM</span>
                                    </div>
                                    <p class="text-muted x-small mb-0 mt-1 line-clamp-2" style="font-size: 0.65rem;">Don't forget the staff training on digital tools scheduled for May 5th at 3 PM in the...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            Chart.defaults.font.family = "'Outfit', sans-serif";
            Chart.defaults.color = '#64748b';

            // 1. Chart Tren Pendaftaran Siswa
            const ctxTrend = document.getElementById('chartPendaftaranSiswa').getContext('2d');
            const trendGradient = ctxTrend.createLinearGradient(0, 0, 0, 300);
            trendGradient.addColorStop(0, 'rgba(15, 23, 42, 0.15)');
            trendGradient.addColorStop(1, 'rgba(15, 23, 42, 0)');

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Pendaftaran',
                        data: [45, 52, 48, 70, 65, 85],
                        borderColor: '#1e293b',
                        borderWidth: 3,
                        backgroundColor: trendGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#1e293b',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#f1f5f9', drawBorder: false } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // 2. Chart Populeritas Kursus
            const ctxPopuler = document.getElementById('chartPopuleritasKursus').getContext('2d');
            new Chart(ctxPopuler, {
                type: 'doughnut',
                data: {
                    labels: ['Aplikasi Perkantoran', 'Desain Grafis', 'Lainnya'],
                    datasets: [{
                        data: [45, 30, 25],
                        backgroundColor: ['#1e293b', '#0ea5e9', '#cbd5e1'],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: { legend: { display: false } }
                }
            });
        </script>

        <style>
            .hover-translate-x:hover {
                transform: translateX(5px);
            }
            .bg-soft-primary { background: rgba(30, 41, 59, 0.1); }
            .bg-soft-success { background: rgba(16, 185, 129, 0.1); }
            .bg-soft-info { background: rgba(14, 165, 233, 0.1); }
            .bg-soft-warning { background: rgba(234, 179, 8, 0.1); }
            .bg-soft-danger { background: rgba(159, 18, 57, 0.1); }
            .bg-soft-dark { background: rgba(71, 85, 105, 0.1); }
            .text-accent-yellow { color: #eab308; }
            .btn-icon { width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; }
        </style>

    </main>
@endsection

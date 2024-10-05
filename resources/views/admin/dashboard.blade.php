@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <main>
        <div class="container-fluid px-4">

            <!-- Statistik Cards -->
            <div class="row ">
                <div class="col-md-3 my-4">
                    <div class="card bg-info text-white">
                        <div class="card-body ">
                            <h1>{{ $jumlah_siswa }}</h1>
                            <span class="font-light text-xs">Jumlah Siswa Terdaftar</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h1>{{ $jumlahKelasAktif }}</h1>
                            <span class="font-light text-xs">Kelas Aktif</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h1>{{ $jumlahPembayarantunda }}</h1>
                            <span class="font-light text-xs">Pembayaran Tertunda</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h1>{{ $pendaftaran_baru }}</h1>
                            <span class="font-light text-xs">Pendaftaran Baru</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h1>{{ $siswa_bersertifikat }}</h1>
                            <span class="font-light text-xs">Siswa Bersertifikat</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h1>{{ $jumlahPegawai }}</h1>
                            <span class="font-light text-xs">Jumlah Instruktur</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik (Gunakan chart library seperti Chart.js) -->
            <div class="row my-4">
                <div class="col-md-6">
                    <canvas id="chartKelasAktif"></canvas>
                </div>
                <div class="col-md-3">
                    <canvas id="chartPembayaranTertunda"></canvas>
                </div>
                <div class="col-md-3">
                    <canvas id="chartKelulusanSiswa"></canvas>
                </div>
            </div>

            <div class="row my-2">
                <!-- Tabel Pendaftaran Baru -->
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-header">
                            <h4>Pendaftaran Baru</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Jadwal</th>
                                        <th>Tanggal Pendaftaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendaftaran_baru_list as $pendaftaran)
                                        <tr>
                                            <td>{{ $pendaftaran->nama }}</td>
                                            <td>{{ $pendaftaran->jadwal->kelas->nama_kelas }}</td>
                                            <td>{{ $pendaftaran->jadwal->nama_jadwal }}</td>
                                            <td>{{ $pendaftaran->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-header">
                            <h4>Pembayaran Tertunda</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Biaya Total</th>
                                        <th>Sisa Pembayaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran_tertunda as $pembayaran)
                                        <tr>
                                            <td>{{ $pembayaran->siswa->nama }}</td>
                                            <td>{{ $pembayaran->siswa->jadwal->kelas->nama_kelas }}</td>
                                            <td>{{ $pembayaran->biaya_total }}</td>
                                            <td>{{ $pembayaran->sisa_pembayaran }}</td>
                                            <td>{{ $pembayaran->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Tabel Pembayaran Tertunda -->


            <!-- Tabel Kelas Aktif -->
            <div class="card my-4">
                <div class="card-header">
                    <h4>Kelas Aktif</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Instruktur</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas_aktif as $kelas)
                                @foreach ($kelas->jadwal as $jadwal)
                                    <tr>
                                        <td>{{ $kelas->nama_kelas }}</td>
                                        <td>{{ $jadwal->instruktur->nama }}</td>
                                        <td>{{ $jadwal->hari }}</td>
                                        <td>{{ $jadwal->jam_mulai }}</td>
                                        <td>{{ $jadwal->jam_selesai }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Optional: Tambahkan JavaScript untuk rendering chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctxKelasAktif = document.getElementById('chartKelasAktif').getContext('2d');
            const ctxPembayaranTertunda = document.getElementById('chartPembayaranTertunda').getContext('2d');
            const ctxKelulusanSiswa = document.getElementById('chartKelulusanSiswa').getContext('2d');

            // Data untuk grafik kelas aktif
            // Data untuk grafik jumlah siswa per kelas
            const chartKelasAktif = new Chart(ctxKelasAktif, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($jadwalLabels) !!}, // Label untuk kelas
                    datasets: [{
                        label: 'Jumlah Siswa per Kelas',
                        data: {!! json_encode($jumlahSiswaPerJadwal) !!}, // Data dari database
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }

                }
            });

            // Data untuk grafik status pembayaran
            const chartPembayaranTertunda = new Chart(ctxPembayaranTertunda, {
                type: 'pie',
                data: {
                    labels: ['Belum Lunas', 'Lunas'],
                    datasets: [{
                        label: 'Status Pembayaran',
                        data: [{{ $jumlahPembayaranLunas }},
                            {{ $jumlahPembayarantunda }}
                        ], // Hitung yang sudah lunas
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });

            // Data untuk grafik kelulusan siswa
            const chartKelulusanSiswa = new Chart(ctxKelulusanSiswa, {
                type: 'pie',
                data: {
                    labels: ['Tidak Memenuhi Standar', 'Lulus Bersertifikat'],
                    datasets: [{
                        label: 'Status Kelulusan',
                        data: [{{ $jumlahTidakLulus }}, {{ $jumlahLulus }}], // Data dari database
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        </script>

    </main>
@endsection

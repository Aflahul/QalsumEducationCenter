@extends('layouts.print')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Sertifikat Header -->
                <div class="text-center mb-4">
                    <h1 class="display-4">Sertifikat Kursus</h1>
                    <p class="lead">Diberikan kepada</p>
                    <h2 class="font-weight-bold">{{ $siswa->nama }}</h2>
                    <p>Nomor Induk: {{ $siswa->nomor_siswa }}</p>
                    <p>Kelas: {{ $siswa->jadwal->kelas->nama_kelas }}</p>
                    <p>Nilai Akhir: <strong>{{ $siswa->nilai->avg('nilai_rata_rata') }}</strong></p>
                </div>

                <!-- Garis pembatas -->
                <hr class="my-4">

                <!-- Transkrip Nilai -->
                <h4 class="text-center">Transkrip Nilai</h4>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Materi</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa->penilaianKelas as $penilaian)
                            <tr>
                                <td>{{ $penilaian->materi->nama_materi }}</td>
                                <td>{{ $penilaian->nilai }}</td>
                                <td>
                                    @php
                                        $nilai = $penilaian->nilai;
                                        if ($nilai >= 85) {
                                            $grade = 'A';
                                        } elseif ($nilai >= 75) {
                                            $grade = 'B';
                                        } elseif ($nilai >= 60) {
                                            $grade = 'C';
                                        } else {
                                            $grade = 'D';
                                        }
                                    @endphp
                                    {{ $grade }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tombol Cetak -->
                <div class="text-center">
                    {{-- <button class="btn btn-primary" onclick="window.print()">Cetak Sertifikat</button> --}}
                    {{-- <button id="printCertificate" class="btn btn-success">Cetak Sertifikat</button> --}}
                    <a href="{{ route('admin.sertifikat.p') }}" class="btn btn-secondary">Cetak Sertifikat</a>
                    <a href="{{ route('admin.sertifikat.index') }}" class="btn btn-secondary">Kembali</a>

                </div>
            </div>
        </div>
    </div>

    <!-- Trigger print preview on page load -->
    
@endsection

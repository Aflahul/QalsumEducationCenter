@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Sertifikat Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Sertifikat Siswa</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Sertifikat
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor Induk</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Rerata Nilai</th>
                                <th>Status Kelayakan</th>
                                <th>Status Penerbitan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                @php
                                    $nilaiRataRata = $s->nilai->avg('nilai_rata_rata');
                                    $statusKelayakan = $nilaiRataRata >= 75 ? 'Layak' : 'Belum Layak';
                                    $statusTerbit = $nilaiRataRata >= 75 ? 'Belum Terbit' : 'Tidak Bisa Diterbitkan';
                                @endphp
                                <tr>
                                    <td>{{ $s->nomor_siswa }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->jadwal->kelas->nama_kelas }}</td>
                                    <td>{{ $nilaiRataRata ?? 'Belum Ada Nilai' }}</td>
                                    <td>{{ $statusKelayakan }}</td>
                                    <td>{{ $statusTerbit }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#detailModal-{{ $s->id }}">
                                            Detail
                                        </button> --}}

                                        @if ($nilaiRataRata >= 75)
                                            <a href="{{ route('admin.sertifikat.preview', $s->id) }}"
                                                class="btn btn-primary btn-sm" target="_blank" >Cetak Sertifikat</a>
                                            {{-- <a href="{{ route('admin.sertifikat.print', $s->id) }}"
                                                class="btn btn-primary btn-sm">Cetak Sertifikat</a> --}}
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>Belum Layak</button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal Detail Nilai -->
                                {{-- <div class="modal fade" id="detailModal-{{ $s->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="detailModalLabel-{{ $s->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel-{{ $s->id }}">Detail
                                                    Nilai Siswa: {{ $s->nama }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Kelas: {{ $s->jadwal->kelas->nama_kelas }}</h6>
                                                <h6>Jenis Kelas: {{ $s->jadwal->kelas->jenis_kelas }}</h6>
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <strong>Materi</strong>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <center><strong>Nilai</strong></center>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <center><strong>Grade</strong></center>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Catatan</strong>
                                                    </div>
                                                </div>
                                                @foreach ($s->penilaianKelas as $penilaian)
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            {{ $penilaian->materi->nama_materi }}
                                                        </div>
                                                        <div class="col-md-2">
                                                            <center>{{ $penilaian->nilai }}</center>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <center>
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
                                                            </center>
                                                        </div>
                                                        <div class="col-md-4">
                                                            {{ $penilaian->catatan ?? 'Tidak ada catatan' }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6"><strong>Total Nilai:
                                                        </strong>{{ $nilaiRataRata ?? 'Belum Ada Nilai' }}</div>
                                                    <div class="col-md-6"><strong>Status Kelayakan:
                                                        </strong>{{ $statusKelayakan }}</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

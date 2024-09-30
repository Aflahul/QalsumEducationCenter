@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Penilaian Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Penilaian Siswa</li>
            </ol>
            <a href="{{ route('admin.nilai.create') }}" class="btn btn-primary mb-3">Tambah Penilaian</a>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Siswa
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor Induk</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Rerata</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $s->nomor_siswa }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->jadwal->kelas->nama_kelas }}</td>
                                    <td>
                                        @if ($s->nilai->count() > 0)
                                            {{ $s->nilai->first()->nilai_rata_rata }}
                                        @else
                                            Belum ada nilai
                                        @endif
                                    </td>
                                    <td>
                                        @if ($s->sertifikat)
                                            {{ $s->sertifikat->status }}
                                        @else
                                            Belum ada sertifikat
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#detailNilaiModal-{{ $s->id }}">
                                            Detail
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editNilaiModal-{{ $s->id }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Detail Nilai -->
                                <div class="modal fade" id="detailNilaiModal-{{ $s->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="detailNilaiLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Nilai Siswa: {{ $s->nama }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Kelas: {{ $s->jadwal->kelas->nama_kelas }}</h6>
                                                <h6>Jenis Kelas: {{ $s->jadwal->kelas->jenis_kelas }}</h6>
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-4"><strong>Materi</strong></div>
                                                    <div class="col-md-2"><strong>Nilai</strong></div>
                                                    <div class="col-md-2"><strong>Grade</strong></div>
                                                    <div class="col-md-4"><strong>Catatan</strong></div>
                                                </div>
                                                @foreach ($s->penilaianKelas as $penilaian)
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">{{ $penilaian->materi->nama_materi }}</div>
                                                        <div class="col-md-2">{{ $penilaian->nilai }}</div>
                                                        <div class="col-md-2">
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
                                                        </div>
                                                        <div class="col-md-4">{{ $penilaian->catatan ?? 'Tidak ada catatan' }}</div>
                                                    </div>
                                                @endforeach
                                                <hr>
                                                <div class="row">
                                                    @if ($s->sertifikat)
                                                        <div class="col-md-2"><strong>Nilai Akhir</strong></div>
                                                        <div class="col-md-10">: {{ $s->sertifikat->nilai_akhir }}</div>
                                                        <div class="col-md-2"><strong>Status Sertifikat</strong></div>
                                                        <div class="col-md-10">: {{ $s->sertifikat->status }}</div>
                                                    @else
                                                        <div class="col-md-12 text-danger">Belum ada sertifikat untuk siswa ini.</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit Nilai -->
                                <div class="modal fade" id="editNilaiModal-{{ $s->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editNilaiLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.nilai.update', $s->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Nilai Siswa: {{ $s->nama }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach ($s->penilaianKelas as $penilaian)
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">{{ $penilaian->materi->nama_materi }}</div>
                                                            <div class="col-md-2">
                                                                <input type="number" name="nilai[{{ $penilaian->id }}]"
                                                                    value="{{ $penilaian->nilai }}" class="form-control">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

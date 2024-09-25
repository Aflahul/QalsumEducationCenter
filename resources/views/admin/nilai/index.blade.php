@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Penilaian Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Penilaian Siswa</li>
            </ol>

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
                                        @foreach ($s->nilai as $n)
                                            {{ $n->nilai_rata_rata ?? 'Belum ada nilai' }}
                                    </td>
                            @endforeach
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
                                                <div class="col-md-4">
                                                    <strong>Materi</strong>
                                                </div>
                                                <div class="col-md-1">
                                                    <center><strong>Nilai</strong></center>
                                                </div>
                                                <div class="col-md-2">
                                                    <center><strong>Grade</strong></center>
                                                </div>
                                                <div class="col-md-5">
                                                    <strong>Catatan</strong>
                                                </div>
                                            </div>
                                            @foreach ($s->penilaianKelas as $penilaian)
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        {{ $penilaian->materi->nama_materi }}
                                                    </div>
                                                    <div class="col-md-1">
                                                        <center>{{ $penilaian->nilai }}</center>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <center>
                                                            @php
                                                                // Menghitung grade berdasarkan nilai
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
                                                    <div class="col-md-5">
                                                        {{ $penilaian->catatan ?? 'Tidak ada catatan' }}
                                                    </div>
                                                </div>
                                            @endforeach
                                            <hr>
                                            <div class="row mb-3">
                                                @foreach ($s->nilai as $r)
                                                    <div class="col-md-2 "><strong>Total Nilai </strong></div>
                                                    <div class="col-md-10 ">: {{ $r->nilai_total }}</div>
                                                    <div class="col-md-2 "><strong>Rerata Nilai </strong></div>
                                                    <div class="col-md-10">: {{ $r->nilai_rata_rata }}</div>
                                                    <div class="col-md-2"><strong>Status </strong></div>
                                                    <div class="col-md-10">
                                                        @if ($r->nilai_rata_rata >= 75)
                                                            : Lulus
                                                        @else
                                                            : Tidak Lulus
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>











                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>



                                <!-- Modal Edit Nilai -->
                                {{-- <div class="modal fade" id="editNilaiModal-{{ $s->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editNilaiLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Nilai Siswa: {{ $s->nama }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.nilai.update', $s->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Materi</th>
                                                                <th>Nilai</th>
                                                                <th>Catatan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($s->penilaianKelas as $penilaian)
                                                                <tr>
                                                                    <td>{{ $penilaian->materi->nama_materi }}</td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                            name="nilai[{{ $penilaian->id }}]"
                                                                            value="{{ $penilaian->nilai }}" min="0"
                                                                            max="100">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="catatan[{{ $penilaian->id }}]"
                                                                            value="{{ $penilaian->catatan }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                </form>
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

        <!-- Modal Tambah Nilai Siswa -->
        {{-- <div class="modal fade" id="addNilaiModal" tabindex="-1" role="dialog" aria-labelledby="addNilaiLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNilaiLabel">Tambah Nilai Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.nilai.store') }}" method="POST">
                            @csrf

                            <!-- Pilih Siswa -->
                            <div class="form-group">
                                <label for="siswa">Pilih Siswa</label>
                                <select name="siswa_id" id="siswa" class="form-control" required>
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Materi dan Masukkan Nilai -->
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Materi</th>
                                        <th>Nilai</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materi as $m)
                                        <tr>
                                            <td>{{ $m->nama_materi }}</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    name="nilai[{{ $m->id }}]" min="0" max="100"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="catatan[{{ $m->id }}]" placeholder="Catatan (opsional)">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    </main>
@endsection

@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Jadwal Kelas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Jadwal Kelas</li>
            </ol>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJadwalModal">
                    Tambah Jadwal
                </button>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Jadwal
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Jadwal</th>
                                <th>Kelas</th>
                                <th>Jalur</th>
                                <th>Instruktur</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $j)
                                <tr>
                                    <td>{{ $j->nama_jadwal }}</td>
                                    <td>{{ $j->nama_kelas }}</td>
                                    <td>{{ $j->jalur }}</td>
                                    <td>{{ $j->instruktur }}</td>
                                    <td>{{ $j->hari }}</td>
                                    <td>{{ $j->jam_mulai }}</td>
                                    <td>{{ $j->jam_selesai }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#detailJadwalModal-{{ $j->id }}">
                                            Lihat Detail
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editJadwalModal-{{ $j->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailJadwalModal-{{ $j->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Jadwal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama Jadwal:</strong> {{ $j->nama_jadwal }}</p>
                                                <p><strong>Kelas:</strong> {{ $j->nama_kelas }}</p>
                                                <p><strong>Instruktur:</strong> {{ $j->instruktur }}</p>
                                                <p><strong>Jalur:</strong> {{ $j->jalur }}</p>
                                                <p><strong>Hari:</strong> {{ $j->hari }}</p>
                                                <p><strong>Jam Mulai:</strong> {{ $j->jam_mulai }}</p>
                                                <p><strong>Jam Selesai:</strong> {{ $j->jam_selesai }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editJadwalModal-{{ $j->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Jadwal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.jadwal.update', $j->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama_jadwal">Nama Jadwal</label>
                                                        <input type="text" name="nama_jadwal" class="form-control"
                                                            value="{{ $j->nama_jadwal }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_kelas">Kelas</label>
                                                        <select name="nama_kelas" class="form-control" required>
                                                            @foreach ($kelas as $k)
                                                                <option value="{{ $k->nama_kelas }}"
                                                                    {{ $k->nama_kelas == $j->nama_kelas ? 'selected' : '' }}>
                                                                    {{ $k->nama_kelas }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="instruktur">Instruktur</label>
                                                        <select name="instruktur" class="form-control" required>
                                                            @foreach ($instruktur as $i)
                                                                <option value="{{ $i->nama }}"
                                                                    {{ $i->nama == $j->instruktur ? 'selected' : '' }}>
                                                                    {{ $i->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jalur">Jalur</label>
                                                        <select name="jalur" class="form-control" required>
                                                            <option value="Reguler"
                                                                {{ $j->jalur == 'Reguler' ? 'selected' : '' }}>Reguler
                                                            </option>
                                                            <option value="Privat"
                                                                {{ $j->jalur == 'Privat' ? 'selected' : '' }}>Privat
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hari">Hari</label>
                                                        <input type="text" name="hari" class="form-control"
                                                            value="{{ $j->hari }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jam_mulai">Jam Mulai</label>
                                                        <input type="time" name="jam_mulai" class="form-control"
                                                            value="{{ $j->jam_mulai }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jam_selesai">Jam Selesai</label>
                                                        <input type="time" name="jam_selesai" class="form-control"
                                                            value="{{ $j->jam_selesai }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-warning">Update Jadwal</button>
                                                </form>
                                            </div>
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

    <!-- Modal Tambah Jadwal -->
    <div class="modal fade" id="addJadwalModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.jadwal.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_jadwal">Nama Jadwal</label>
                            <input type="text" name="nama_jadwal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_kelas">Kelas</label>
                            <select name="nama_kelas" class="form-control" required>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="instruktur">Instruktur</label>
                            <select name="instruktur" class="form-control" required>
                                @foreach ($instruktur as $i)
                                    <option value="{{ $i->nama }}">{{ $i->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jalur">Jalur</label>
                            <select name="jalur" class="form-control" required>
                                <option value="Reguler">Reguler</option>
                                <option value="Privat">Privat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <input type="text" name="hari" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Kelas</h1>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKelasModal">
                    Tambah Kelas
                </button>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Kelas
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Deskripsi</th>
                                <th>Jenis Kelas</th>
                                <th>Biaya</th>
                                {{-- <th>Instruktur</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k)
                                <tr>
                                    <td>{{ $k->nama_kelas }}</td>
                                    <td>{{ $k->deskripsi }}</td>
                                    <td>{{ $k->jenis_kelas }}</td>
                                    <td>{{ $k->biaya }}</td>
                                    {{-- <td>{{ $k->instruktur->nama ?? 'Tidak ada' }}</td> --}}
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#jadwalModal{{ $k->id }}">
                                            Lihat Jadwal
                                        </button>

                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editKelasModal-{{ $k->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                <!-- Modal untuk menampilkan jadwal -->
                                <div class="modal fade" id="jadwalModal{{ $k->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="jadwalModalLabel{{ $k->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="jadwalModalLabel{{ $k->id }}">Jadwal
                                                    untuk Kelas {{ $k->nama_kelas }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Daftar jadwal yang berkaitan dengan kelas -->
                                                @if ($k->jadwals->isEmpty())
                                                    <p>Tidak ada jadwal untuk kelas ini.</p>
                                                @else
                                                    <ul>
                                                        @foreach ($k->jadwals as $jadwal)
                                                            <li>
                                                                <strong>Jadwal</strong> {{ $jadwal->nama_jadwal }} <br>
                                                                <strong>Hari:</strong> {{ $jadwal->hari }} <br>
                                                                <strong>Jam:</strong> {{ $jadwal->jam_mulai }} -
                                                                {{ $jadwal->jam_selesai }} <br>
                                                                <strong>Instruktur:</strong>
                                                                {{ $jadwal->instruktur->nama }} <br>
                                                                <strong> Jumlah siswa </strong>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editKelasModal-{{ $k->id }}" tabindex="-1"
                                    aria-labelledby="editKelasModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editKelasModalLabel">Edit Kelas
                                                    {{ $k->nama_kelas }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {{-- edit  --}}
                                            <div class="modal-body">
                                                <form action="{{ route('admin.kelas.update', $k->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama_kelas">Nama Kelas</label>
                                                        <input type="text" name="nama_kelas" class="form-control"
                                                            id="nama_kelas" value="{{ $k->nama_kelas }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" id="deskripsi" required>{{ $k->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jenis_kelas">Jenis Kelas</label>
                                                        <select name="jenis_kelas" id="jenis_kelas" class="form-control"
                                                            required>
                                                            <option value="reguler"
                                                                {{ old('jenis_kelas', $k->jenis_kelas) == 'reguler' ? 'selected' : '' }}>
                                                                Reguler</option>
                                                            <option value="private"
                                                                {{ old('jenis_kelas', $k->jenis_kelas) == 'private' ? 'selected' : '' }}>
                                                                Private</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="biaya">Biaya Kelas</label>
                                                        <input type="number" name="biaya" class="form-control"
                                                            id="biaya" min="800000" step="50000"
                                                            value="{{ old('biaya', $k->biaya) }}" required>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="instruktur_id">Instruktur</label>
                                                        <select name="instruktur_id" class="form-control" id="instruktur_id"
                                                            required>
                                                            @foreach ($instruktur as $i)
                                                                <option value="{{ $i->id }}"
                                                                    {{ $i->id == $k->instruktur_id ? 'selected' : '' }}>
                                                                    {{ $i->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                    <button type="submit" class="btn btn-primary">Update</button>
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

    <!-- Modal Tambah Kelas -->
    <div class="modal fade" id="addKelasModal" tabindex="-1" aria-labelledby="addKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKelasModalLabel">Tambah Kelas Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.kelas.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi" required></textarea>
                        </div>
                        <select name="jenis_kelas" id="jenis_kelas" class="form-control" required>
                            <option value="">Pilih Jenis Kelas</option>
                            <option value="reguler" {{ old('jenis_kelas') == 'reguler' ? 'selected' : '' }}>Reguler
                            </option>
                            <option value="private" {{ old('jenis_kelas') == 'private' ? 'selected' : '' }}>Private
                            </option>
                        </select>
                        <div class="form-group">
                            <label for="biaya">Biaya Kelas</label>
                            <input type="number" name="biaya" class="form-control" id="biaya" min="800000"
                                step="50000" value="{{ old('biaya', 800000) }}" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="instruktur_id">Instruktur</label>
                            <select name="instruktur_id" class="form-control" id="instruktur_id" required>
                                @foreach ($instruktur as $i)
                                    <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

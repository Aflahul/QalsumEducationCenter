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
                                <th>Biaya Private</th>
                                <th>Biaya Reguler</th>
                                {{-- <th>Instruktur</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k)
                                <tr>
                                    <td>{{ $k->nama_kelas }}</td>
                                    <td>{{ $k->deskripsi }}</td>                                    
                                    <td>{{ $k->biaya_private }}</td>
                                    <td>{{ $k->biaya_reguler }}</td>
                                    {{-- <td>{{ $k->instruktur->nama ?? 'Tidak ada' }}</td> --}}
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" href="{{ url('admin/jadwal') }}">
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
                                                        <label for="biaya_private">Biaya Private</label>
                                                        <input type="number" name="biaya_private" class="form-control"
                                                            id="biaya_private" value="{{ $k->biaya_private }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="biaya_reguler">Biaya Reguler</label>
                                                        <input type="number" name="biaya_reguler" class="form-control"
                                                            id="biaya_reguler" value="{{ $k->biaya_reguler }}" required>
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
                        <div class="form-group">
                            <label for="biaya_private">Biaya Private</label>
                            <input type="number" name="biaya_private" class="form-control" id="biaya_private" required>
                        </div>
                        <div class="form-group">
                            <label for="biaya_reguler">Biaya Reguler</label>
                            <input type="number" name="biaya_reguler" class="form-control" id="biaya_reguler" required>
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

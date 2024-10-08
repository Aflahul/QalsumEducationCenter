@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pembayaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pembayaran</li>
            </ol>
            <div class="mb-4">
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputSiswaModal">
                    Tambah Pembayaran Siswa
                </button> --}}
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Pembayaran Siswa
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor Siswa</th>
                                <th>Nama Siswa</th>
                                <th>Total Biaya</th>
                                <th>Angsuran 1</th>
                                <th>Angsuran 2</th>
                                <th>Sisa Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $p)
                                <tr>
                                    <td>{{ $p->siswa->nomor_siswa }}</td>
                                    <td>{{ $p->siswa->nama }}</td>
                                    <td>Rp {{ number_format($p->biaya_total, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($p->angsuran1, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($p->angsuran2, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($p->sisa_pembayaran, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($p->status == 'Belum Ada Pembayaran')
                                            <span class="btn btn-danger btn-sm">Belum Ada Pembayaran</span>
                                        @elseif ($p->status == 'Belum Lunas')
                                            <span class="btn btn-warning btn-sm">Sisa {{ $p->sisa_pembayaran }}</span>
                                        @elseif ($p->status == 'Lunas')
                                            <span class="btn btn-success btn-sm">Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#tambahRincianPembayaranModal-{{ $p->id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.pembayaran.destroy', $p->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Tambah Rincian Pembayaran -->
                                <div class="modal fade" id="tambahRincianPembayaranModal-{{ $p->id }}"
                                    tabindex="-1" aria-labelledby="tambahRincianPembayaranModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tambahRincianPembayaranModalLabel">Edit
                                                    Pembayaran Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.pembayaran.update', $p->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="angsuran1">Angsuran Pertama</label>
                                                        <input type="number" name="angsuran1" class="form-control"
                                                            id="angsuran1" value="{{ $p->angsuran1 }}" required>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="angsuran2">Angsuran Kedua</label>
                                                        <input type="number" name="angsuran2" class="form-control"
                                                            id="angsuran2" value="{{ $p->angsuran2 }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Update Rincian
                                                        Pembayaran</button>
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
@endsection

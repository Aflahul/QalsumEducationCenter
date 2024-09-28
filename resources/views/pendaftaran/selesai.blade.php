
@extends('layouts.guest')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Pendaftaran Selesai</h2>
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            Terima Kasih, {{ $siswa->nama }}!
        </div>
        <div class="card-body">
            <p>Pendaftaran Anda untuk kelas <strong>{{ $siswa->jadwal->kelas->nama_kelas }}</strong> telah diterima.</p>
            <p>Jadwal: <strong>{{ $siswa->jadwal->nama_jadwal }} ({{ $siswa->jadwal->hari }} {{ $siswa->jadwal->jam_mulai }} - {{ $siswa->jadwal->jam_selesai }})</strong></p>
            <p>Status Pembayaran: 
                <strong>
                    @if ($siswa->pembayaran->status == 'Lunas')
                        Lunas
                    @else
                        Belum Lunas
                    @endif
                </strong>
            </p>
        </div>
    </div>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection

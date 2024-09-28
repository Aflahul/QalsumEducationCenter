<!-- resources/views/pembayaran/index.blade.php -->
@extends('layouts.guest')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Pembayaran Pendaftaran</h2>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Informasi Pendaftaran
        </div>
        <div class="card-body">
            <h5>Nama Siswa: {{ $siswa->nama }}</h5>
            <p>Kontak: {{ $siswa->kontak_hp }}</p>
            <p>Kelas: {{ $siswa->jadwal->kelas->nama_kelas }}</p>
            <p>Jadwal: {{ $siswa->jadwal->nama_jadwal }} ({{ $siswa->jadwal->hari }} {{ $siswa->jadwal->jam_mulai }} - {{ $siswa->jadwal->jam_selesai }})</p>
            <p>Total Biaya: Rp {{ number_format($biaya_total, 0, ',', '.') }}</p>
        </div>
    </div>

    <form action="{{ route('pembayaran.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
        <input type="hidden" name="biaya_total" value="{{ $biaya_total }}">
        
        <div class="form-group">
            <label for="pembayaran">Jumlah Pembayaran</label>
            <input type="number" class="form-control" id="pembayaran" name="pembayaran" required min="1">
            <small class="form-text text-muted">Minimal pembayaran adalah angsuran pertama sebesar Rp {{ number_format($biaya_total / 2, 0, ',', '.') }}</small>
        </div>
        
        <div class="form-group">
            <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control-file" id="bukti_pembayaran" name="bukti_pembayaran" required>
        </div>

        <button type="submit" class="btn btn-success mt-4">Kirim Pembayaran</button>
    </form>
</div>
@endsection

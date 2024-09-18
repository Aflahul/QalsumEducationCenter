@extends('layouts.admin')

@section('content')
    <h2>Detail Pembayaran</h2>
    <p><strong>Siswa:</strong> {{ $pembayaran->siswa->nama }}</p>
    <p><strong>Kelas:</strong> {{ $pembayaran->kelas->nama }}</p>
    <p><strong>Tanggal Bayar:</strong> {{ $pembayaran->tanggal_bayar }}</p>
    <p><strong>Jumlah:</strong> {{ $pembayaran->jumlah }}</p>
@endsection

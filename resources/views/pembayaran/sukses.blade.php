@extends('layouts.guest1')
@section('title', 'Pembayaran Berhasil')
@section('content')
<div class="container">
    <h2>Pembayaran Berhasil</h2>

    <p>Terima kasih, {{ $siswa->nama }}. Pembayaran Anda telah berhasil kami terima.</p>
    <p>Silakan simpan bukti pembayaran Anda.</p>

    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
</div>
@endsection

@extends('layouts.guest')

@section('title', 'Konfirmasi Pendaftaran')

@section('content')
<div class="container">
    <h1>Konfirmasi Pendaftaran</h1>
    <p>Terima kasih telah mendaftar. Pendaftaran Anda sedang diproses, dan kami akan menghubungi Anda dalam waktu dekat.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection

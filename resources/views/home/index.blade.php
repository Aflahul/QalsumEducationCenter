@extends('layouts.guest')

@section('title', 'Selamat Datang di Qalsum Education Center')

@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h1>Selamat Datang di Qalsum Education Center</h1>
        <p>Solusi terbaik untuk meningkatkan keterampilan Anda.</p>
        <a href="{{ route('pendaftaran.index') }}" class="btn btn-primary">Daftar Sekarang</a>
    </div>
</div>
@endsection

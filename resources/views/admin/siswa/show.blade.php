@extends('layouts.admin')

@section('content')
    <h2>Detail Siswa</h2>
    <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
    <p><strong>Kelas:</strong> {{ $siswa->kelas->nama }}</p>
@endsection

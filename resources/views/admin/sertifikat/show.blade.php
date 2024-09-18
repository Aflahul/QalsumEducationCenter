@extends('layouts.admin')

@section('content')
    <h2>Detail Sertifikat</h2>
    <p><strong>Siswa:</strong> {{ $sertifikat->siswa->nama }}</p>
    <p><strong>Kelas:</strong> {{ $sertifikat->kelas->nama }}</p>
@endsection

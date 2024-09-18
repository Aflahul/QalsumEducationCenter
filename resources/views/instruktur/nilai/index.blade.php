@extends('layouts.instruktur')

@section('title', 'Kelola Nilai')

@section('content')
<div class="container">
    <h1>Kelola Nilai</h1>
    <p>Anda dapat melihat dan mengelola nilai siswa di kelas yang Anda ajar.</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Nilai siswa akan ditampilkan di sini -->
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Sertifikat</h1>
            <ol class="breadcrumb mb-4">
                {{-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Pembayaran</li> --}}
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">
                    
                    <a target="_blank" href="#">Tambah Instruktur</a>
                    .
                </div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Sertifikat Siswa
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Sertifikat</th>
                                <th>Tanggal</th>                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Sertifikat</th>
                                <th>Tanggal</th>                                
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>Terbit</td>
                                <td>System Architect</td>
                                <td>61</td>
                                
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Pending</td>
                                <td>Accountant</td>
                                <td>63</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
@endsection

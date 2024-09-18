@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    
                    <a target="_blank" href="#">Tambah Siswa</a>
                    .
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Siswa
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>                                
                                <th>Kelas</th>
                                <th>Status Pembayaran</th>
                                <th>Ket</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>                                
                                <th>Kelas</th>
                                <th>Status Pembayaran</th>
                                <th>Ket</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>61</td>
                                <td>61</td>
                                
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>63</td>
                                <td>63</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
@endsection

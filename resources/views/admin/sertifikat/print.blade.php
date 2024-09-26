<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Sertifikat</title>
    <style>
        .page-break { page-break-after: always; }
        body { font-family: 'Arial', sans-serif; }
    </style>
</head>
<body>

    <!-- Lembar 1: Biodata Siswa dan Lembaga -->
    <h1>Sertifikat</h1>
    <p><strong>Nama Siswa:</strong> {{ $siswa->nama }}</p>
    <p><strong>Nomor Induk:</strong> {{ $siswa->nomor_siswa }}</p>
    <p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas }}</p>
    <p><strong>Nilai Akhir:</strong> {{ $siswa->sertifikat->nilai_akhir }}</p>
    <p><strong>Tanggal Terbit:</strong> {{ $siswa->sertifikat->tanggal_terbit }}</p>
    <br><br>
    <p><strong>Informasi Lembaga:</strong></p>
    <p>Lembaga Kursus XYZ</p>
    <p>Alamat: Jalan XYZ No.123</p>
    
    <div class="page-break"></div>

    <!-- Lembar 2: Transkrip Nilai -->
    <h1>Transkrip Nilai</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Materi</th>
                <th>Nilai</th>
                <th>Grade</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa->penilaianKelas as $penilaian)
                <tr>
                    <td>{{ $penilaian->materi->nama_materi }}</td>
                    <td>{{ $penilaian->nilai }}</td>
                    <td>
                        @php
                            $nilai = $penilaian->nilai;
                            $grade = ($nilai >= 85) ? 'A' : (($nilai >= 75) ? 'B' : (($nilai >= 60) ? 'C' : 'D'));
                        @endphp
                        {{ $grade }}
                    </td>
                    <td>{{ $penilaian->catatan ?? 'Tidak ada catatan' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>

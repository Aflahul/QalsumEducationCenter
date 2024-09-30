<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Sertifikat</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .certificate-page {
            position: relative;
            width: 100%;
            height: 793px;
            /* Adjust height for landscape */
            background-size: cover;
            background-position: center;
        }

        .certificate-content {
            position: absolute;
            top: 230px;
            left: 50px;
            width: 90%;
        }

        .signature {
            position: absolute;
            bottom: 100px;
            right: 100px;
        }
        .signature2 {
            position: absolute;
            bottom: 100px;
            right: 50px;
        }

        .logo {
            position: absolute;
            top: 50px;
            /* Atur jarak dari atas sesuai keinginan */
            left: 50%;
            /* Posisikan di tengah secara horizontal */
            transform: translateX(-50%);
            /* Pindahkan elemen ke kiri 50% dari lebarnya agar benar-benar di tengah */
            width: 150px;
            /* Ukuran logo */
        }


        .card-style {
            background-color: rgba(255, 255, 255, 0.8);
            
        }

        .badge-custom {
            font-size: 1.2em;
            padding: 10px;
        }

        .judul {
            position: absolute;
            top: 170px;
            left: 50%;
            /* Posisikan di tengah secara horizontal */
            transform: translateX(-50%);
           
        }
    </style>
</head>

<body>
    <!-- Halaman Pertama - Data Diri Siswa -->
    <div id="page1" class="certificate-page" style="background-image: url('{{ asset('img/sertifikat.jpg') }}');">

        <img src="{{ asset('img/qec.png') }}" alt="Logo" class="logo">
        <p class=" text-center font-weight-bold font-italic h1 judul  font-sans">Sertifikat Pelatihan</p>

        <div class="certificate-content mt-10 card-style ">
            <h5 class="text-center text-muted mb-3 mt-10">Diberikan Kepada</h5>
            <p class="text-center text-uppercase h2 uppercase mb-0">{{ $siswa->nama }}</p>
            <hr style="border-top: 4px solid; width: 500px; margin-top: 2px">

            <p class="text-center text-muted h5">Nomor Induk: {{ $siswa->nomor_siswa }}</p>

            <p class="text-center">Atas partisipasi dan kelulusan dalam pelatihan:
                {{ $siswa->kelas->nama_kelas }}</p>

            <p class="text-center font-weight-bold h3">{{ $siswa->kelas->nama }}</p>
            <div class="text-center mt-4">
                <span class="badge badge-success badge-custom">Nilai Akhir: {{ $siswa->sertifikat->nilai_akhir }}</span>
            </div>

            <p class="text-center text-muted mt-4">Tanggal Terbit: {{ $siswa->sertifikat->updated_at->format('d-m-Y') }}
            </p>
        </div>

        <div class="signature ">
            <p class="text-right bold">Masamba, {{ $siswa->sertifikat->updated_at->format('d-m-Y') }} </p>
            <img src="https://path-to-signature-image.jpg" alt="Tanda Tangan" style="width: 200px;">
            {{-- <p class="text-right">{{ $pemilikLembaga->nama }}</p> --}}
            <p class="text-right">Pemilik Kursus</p>
        </div>
    </div>

    <!-- Halaman Kedua - Transkrip Nilai -->
    <div id="page2" class="certificate-page" style="background-image: url('{{ asset('img/sertifikat.jpg') }}');">
        <h4 class="font-weight-bold mb-4 text-center judul ">Transkrip Nilai</h4>
        <div class="certificate-content card-style ">
            <table class="table table-hover table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Materi</th>
                        <th>Nilai</th>
                        <th>Grade</th>

                        {{-- <th>Rata- Rata</th> --}}
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
                                    $grade = '';
                                    if ($nilai >= 85) {
                                        $grade = 'A';
                                    } elseif ($nilai >= 75) {
                                        $grade = 'B';
                                    } elseif ($nilai >= 60) {
                                        $grade = 'C';
                                    } else {
                                        $grade = 'D';
                                    }
                                @endphp
                                <span class="badge badge-info">{{ $grade }}</span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">

                    <th class="bold">Rata-Rata</th>
                    <th colspan="2">
                        <b>{{ $siswa->sertifikat->nilai_akhir }} </b>
                    </th>


                </tfoot>
            </table>
        </div>
        <div class="signature ">
            <p class="text-right bold">Masamba, {{ $siswa->sertifikat->updated_at->format('d-m-Y') }} </p>
            <img src="https://path-to-signature-image.jpg" alt="Tanda Tangan" style="width: 200px;">
            {{-- <p class="text-right">{{ $pemilikLembaga->nama }}</p> --}}
            <p class="text-right">Pemilik Kursus</p>
        </div>
    </div>

    <!-- Button to Print -->
    <div class="text-center mt-5">
        <button id="printCertificate" class="btn btn-primary btn-lg">Cetak Sertifikat</button>
    </div>

    <script>
        document.getElementById('printCertificate').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'landscape', // Set orientation to landscape
                unit: 'mm',
                format: 'a4'
            });

            // Menyimpan halaman pertama
            html2canvas(document.getElementById('page1')).then(function(canvas1) {
                const imgData1 = canvas1.toDataURL('image/png');
                doc.addImage(imgData1, 'PNG', 0, 0, 297, 210); // Landscape A4 dimensions (297mm x 210mm)

                // Tambah halaman kedua
                doc.addPage();
                html2canvas(document.getElementById('page2')).then(function(canvas2) {
                    const imgData2 = canvas2.toDataURL('image/png');
                    doc.addImage(imgData2, 'PNG', 0, 0, 297, 210); // Landscape A4 dimensions
                    doc.save('Sertifikat_{{ $siswa->nama }}.pdf');
                });
            });
        });
    </script>
</body>

</html>

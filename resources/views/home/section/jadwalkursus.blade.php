<section id="jadwalkursus" class="my-5 pt-0">
    <div class="container">
        <div class="row">
            <div class="row justify-content-center text-center my-sm-5">
                <div class="col-lg-6">
                    <span class="badge bg-primary mb-3">Jadwal Kelas</span>
                    <h2 class="text-dark mb-0">Pilihan Jadwal yang fleksibel</h2>
                    <p class="lead">untuk memudahkan Anda belajar sesuai dengan waktu luang dan kebutuhan
                    pribadi.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container  ">
        <div class="row">
            @foreach ($jadwals as $jadwal)
                <div class="col-md-4 mt-md-0 mt-4">
                    <a href="#">
                        <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                            <!-- Gambar kelas -->
                            <img class="w-100 my-auto" src="https://source.unsplash.com/random/300x200?classroom"
                                alt="kelas-{{ $jadwal->kelas->nama_kelas }}">
                            <!-- Overlay nama kelas -->
                            <div class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 p-2 text-white">
                                {{ $jadwal->kelas->nama_kelas }}
                            </div>
                        </div>
                        <div class="mt-2 ms-2">
                            <p class="text-secondary text-sm">Jumlah Siswa : {{ $jadwal->siswa->count() }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>


</section>

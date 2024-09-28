<!-- Modal Kelas -->

<div class="modal fade" id="lihatkelasModal" tabindex="-1" aria-labelledby="lihatkelasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatkelasModalLabel">Daftar Kelas</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <div class="container mt-1">
                    <div class="row">
                        <div class="col-md-auto">
                            <div class="row ">
                                @foreach ($kelas as $k)
                                    <div class="col-md-4 mt-3 mb-3">
                                        <a href="#">
                                            <div class="card move-on-hover position-relative">
                                                <!-- Gambar galeri -->
                                                <img class="w-100" src="{{ asset('assets/img/portfolio/2.jpg') }}"
                                                    alt="galeri-{{ $k->nama_kelas }}">

                                                <!-- Overlay judul galeri -->
                                                <div
                                                    class="position-absolute top-0 start-0 w-100 bg-dark bg-opacity-20 p-2 text-white">
                                                    {{ $k->nama_kelas }} <i class="text-sm font-light"> {{ $k->jenis_kelas }}</i>
                                                </div>
                                                <div
                                                    class="position-absolute bottom-0 font-light start-0 w-100 bg-dark bg-opacity-20 p-2 text-xs text-white">
                                                    {{ $k->deskripsi }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Agenda -->
@foreach ($agendas as $agenda)
    <div class="modal fade" id="agendaDetailModal{{ $agenda->id }}" tabindex="-1" role="dialog"
        aria-labelledby="agendaDetailModalLabel{{ $agenda->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agendaDetailModalLabel{{ $agenda->id }}">{{ $agenda->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</p>
                    <p><strong>Deskripsi:</strong> {{ $agenda->deskripsi }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@foreach ($beritas as $berita)
    <!-- Modal Detail Berita -->
    <div class="modal fade" id="beritaDetailModal{{ $berita->id }}" tabindex="-1" role="dialog"
        aria-labelledby="beritaDetailModalLabel{{ $berita->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaDetailModalLabel{{ $berita->id }}">{{ $berita->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                            class="img-fluid mb-3">
                    @endif
                    <p><strong>Tanggal Publikasi:</strong>
                        {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d M Y') }}</p>
                    <p>{{ $berita->konten }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Modal Syarat dan Ketentuan -->
<div class="modal fade" id="syaratKetentuanModal" tabindex="-1" aria-labelledby="syaratKetentuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="syaratKetentuanModalLabel">Syarat dan Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>1. Pendaftaran</h6>
                <p>Calon siswa harus mengisi semua informasi yang diminta dengan benar.</p>
                
                <h6>2. Pembayaran</h6>
                <p>Calon siswa harus melakukan pembayaran sesuai dengan ketentuan yang berlaku.</p>

                <h6>3. Kehadiran</h6>
                <p>Siswa diharapkan hadir tepat waktu sesuai dengan jadwal yang telah ditentukan.</p>

                <h6>4. Pembatalan</h6>
                <p>Pendaftaran yang dibatalkan tidak dapat dikembalikan.</p>

                <h6>5. Lain-lain</h6>
                <p>Ketentuan lain dapat berlaku dan akan diinformasikan lebih lanjut.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


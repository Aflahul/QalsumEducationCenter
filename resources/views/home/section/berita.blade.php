<section id="berita" class="pt-5 bg-gradient-white rounded-lg">
   
    <div class="container ">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <h2 class="mb-0 ">Berita Terkini</h2>
                <p class="lead ">Informasi terbaru dari lembaga kursus kami.</p>
            </div>
        </div>
        <div class="row mt-6">
            @foreach($beritas as $berita)
            <div class="col-lg-4 col-md-8 mb-4">
                <div class="card bg-gradient-dark">
                    <div class="card-body text-white">
                        <div class="author">
                            <div class="name">
                                <h6 class="mb-0 font-weight-bolder text-white">{{ $berita->judul }}</h6>
                                <div class="stats">
                                    <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <p class="mt-4">{{ Str::limit($berita->konten, 100) }}</p>
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#beritaDetailModal{{ $berita->id }}">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal Detail Berita -->
            <div class="modal fade" id="beritaDetailModal{{ $berita->id }}" tabindex="-1" role="dialog" aria-labelledby="beritaDetailModalLabel{{ $berita->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="beritaDetailModalLabel{{ $berita->id }}">{{ $berita->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid mb-3">
                            @endif
                            <p><strong>Tanggal Publikasi:</strong> {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d M Y') }}</p>
                            <p>{{ $berita->konten }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

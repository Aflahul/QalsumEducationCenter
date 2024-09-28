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

            
            @endforeach
        </div>
    </div>
</section>

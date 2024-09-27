
<section id="agenda" class="pt-2">
    <div class="container mt-sm-5">
        <div class="page-header py-6 py-md-5 my-sm-3 mb-3 border-radius-xl"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/desktop.jpg');"
            loading="lazy">
            <span class="mask bg-gradient-dark"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 ms-lg-5">
                        <h4 class="text-white">Agenda Lembaga Kursus</h4>
                        <h1 class="text-white">Kegiatan & Acara Mendatang</h1>
                        <p class="lead text-white opacity-8">Di sini Anda dapat melihat jadwal kegiatan atau acara yang akan diselenggarakan oleh lembaga kursus kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            @foreach($agendas as $agenda)
            <div class="col-lg-4 mb-4">
                <div class="info-horizontal bg-gradient-primary border-radius-xl d-block d-md-flex p-4 h-100">
                    <i class="material-icons text-white text-3xl">event</i>
                    <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                        <h5 class="text-white">{{ $agenda->judul }}</h5>
                        <p class="text-white">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</p>
                        <p class="text-white">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                        <a href="#" class="text-white icon-move-right" data-bs-toggle="modal" data-bs-target="#agendaDetailModal{{ $agenda->id }}">
                            Lihat Detail
                            <i class="fas fa-arrow-right text-sm ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            
            @endforeach
        </div>
    </div>
    
</section>


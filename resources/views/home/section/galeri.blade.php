<section id="galeri" class="pt-0 bg-gradient-white">
    <div class="container">
        <div class="row">
            <div class="row text-center mt-3">
                <div class="col-lg-6 mx-auto">
                    <span class="badge bg-primary mb-3">Galeri</span>
                    <p class="text-muted mt-2">
                        Jelajahi momen-momen terbaik dan karya unggulan dari berbagai kegiatan yang telah kami
                        laksanakan di Qalsum Education Center. Galeri ini menampilkan dokumentasi visual yang
                        menggambarkan semangat dan dedikasi kami dalam memberikan pendidikan terbaik.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-auto">
                <div class="row mt-4">
                    @foreach ($galeris as $galeri)
                        <div class="col-md-3 my-md-0 my-5">
                            <a href="#">
                                <div class="card move-on-hover position-relative">
                                    <!-- Gambar galeri -->
                                    <img class="w-100" src="{{ asset('assets/img/portfolio/2.jpg') }}"
                                        alt="galeri-{{ $galeri->judul }}">

                                    <!-- Overlay judul galeri -->
                                    <div
                                        class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 p-2 text-white">
                                        {{ $galeri->judul }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
</section>

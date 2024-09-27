<section id="syaratdanketentuan" class="pb-5 position-relative mx-n3 pt-4">
    <div class="bg-gradient-dark position-relative m-3 border-radius-xl overflow-hidden">
        <img src="{{ asset('img/shapes/waves-white.svg') }}" alt="pattern-lines"
            class="position-absolute start-0 top-md-0 w-100 opacity-2">
        <div class="container py-6">
            <div class="row">
                <div class="col-md-8 text-start mb-5 ">
                    <h3 class="text-white z-index-1 position-relative">Syarat & Ketentuan</h3>
                    <p class="text-white opacity-8 mb-0">Kami mengundang Anda untuk memahami syarat dan ketentuan
                        yang
                        berlaku. Dengan pengetahuan ini, Anda dapat menikmati pengalaman belajar yang lebih baik dan
                        memaksimalkan potensi Anda di Qalsum Education Center.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text text-black">{{ $syarat->konten }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="profillembaga" class="pt-0">
    <div class="container">
        <div class="row">
            <div class="row text-center my-sm-5">
                <div class="col-lg-6 mx-auto">
                    <span class="badge bg-primary mb-3">Profil Lembaga</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="row justify-content-start">
                    <div class="col-md-6">
                        <div class="info">
                            <i class="material-icons text-3xl text-gradient text-info mb-3">public</i>
                            <h5>Nama Lembaga</h5>
                            <p>{{ $profile->nama_lembaga }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info">
                            <i class="material-icons text-3xl text-gradient text-info mb-3">location_on</i>
                            <h5>Alamat</h5>
                            <p>{{ $profile->alamat }}</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start mt-4">
                    <div class="col-md-6">
                        <div class="info">
                            <i class="material-icons text-3xl text-gradient text-info mb-3">phone</i>
                            <h5>Telepon</h5>
                            <p>{{ $profile->telepon }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info">
                            <i class="material-icons text-3xl text-gradient text-info mb-3">email</i>
                            <h5>Email</h5>
                            <p><a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start mt-4">
                    <div class="col-md-6">
                        <div class="info">
                            <i class="material-icons text-3xl text-gradient text-info mb-3">language</i>
                            <h5>Website</h5>
                            <p><a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 ms-auto mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 shadow">
                        <a class="d-block blur-shadow-image">
                            <img src="{{ asset($profile->logo) }}" alt="Logo {{ $profile->nama_lembaga }}"
                                class="img-fluid border-radius-lg p-4">
                        </a>
                    </div>
                    <div class="card-body  text-center">
                        <p class="text-sm">{{ $profile->deskripsi }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

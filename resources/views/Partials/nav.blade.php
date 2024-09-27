<nav style="background-color: #F6FB7A"
    class="navbar navbar-expand-lg border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
    <div class="container-fluid px-0">
        <a class="navbar-brand font-weight-normal ms-sm-3" href="#">
            <img src="{{ asset('img/qec.png') }}" class="w-10" alt=""> Qalsum Education Center
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
            <ul class="navbar-nav navbar-nav-hover ms-auto">
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="#programkursus" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                        Program Kursus
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="#jadwalkursus" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                        Jadwal Kursus
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="#galeri" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                        Galeri
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="#agenda" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                        Agenda
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="#berita" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                        Berita
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuBlocks"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Info Penting
                        <img src="{{ asset('img/down-arrow-dark.svg') }}" alt="down-arrow"
                            class="arrow ms-auto ms-md-2">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive p-3 border-radius-lg mt-0 mt-lg-3"
                        aria-labelledby="dropdownMenuBlocks">
                        <div class="d-none d-lg-block">
                            <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="#profillembaga">
                                    Profil Lembaga
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="#syaratdanketentuan">
                                    Syarat dan Ketentuan
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
                <li class="nav-item my-auto ms-3 ms-lg-0 w-auto">
                    <a href="#pendaftaran" class="btn btn-sm bg-gradient-primary mb-0 me-1 mt-2 mt-md-0">Pendaftaran
                        Online</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

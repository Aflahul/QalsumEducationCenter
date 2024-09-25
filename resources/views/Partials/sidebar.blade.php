<div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                            ADMIN
                        </div>
                    <div class="nav">
                        
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="{{ url('admin/dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Kelas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ url('admin/kelas') }}">Daftar Kelas</a>
                                <a class="nav-link" href="{{ url('admin/jadwal') }}">Jadwal</a>
                                <a class="nav-link" href="{{ url('admin/materi') }}">Materi</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pegawai
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="{{ url('admin/staff') }}">Staff</a>
                                <a class="nav-link" href="{{ url('admin/instruktur') }}">Instruktur</a>
                                
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Siswa
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages2" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="{{ url('admin/siswa') }}">Daftar Siswa</a>
                                <a class="nav-link" href="{{ url('admin/nilai') }}">Nilai</a>
                                                             
                            </nav>
                        </div>
                        <a class="nav-link" href="{{ url('admin/pembayaran') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Pembayaran
                        </a>
                        <a class="nav-link" href="{{ url('admin/sertifikat') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Sertifikat
                        </a>
                    </div>
                    
                </div>

            </nav>
        </div>
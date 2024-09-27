<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                ADMIN
            </div>
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menu Utama</div>
                <!-- Dashboard Link -->
                <a class="nav-link py-2 {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <!-- Kelas Section -->
                <a class="nav-link py-2 collapsed {{ Request::is('admin/kelas') || Request::is('admin/jadwal') || Request::is('admin/materi') ? '' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="{{ Request::is('admin/kelas') || Request::is('admin/jadwal') || Request::is('admin/materi') ? 'true' : 'false' }}"
                    aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Kelas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/kelas') || Request::is('admin/jadwal') || Request::is('admin/materi') ? 'show' : '' }}"
                    id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link py-1 {{ Request::is('admin/kelas') ? 'active' : '' }}" href="{{ url('admin/kelas') }}">Daftar Kelas</a>
                        <a class="nav-link py-1 {{ Request::is('admin/jadwal') ? 'active' : '' }}" href="{{ url('admin/jadwal') }}">Jadwal</a>
                        <a class="nav-link py-1 {{ Request::is('admin/materi') ? 'active' : '' }}" href="{{ url('admin/materi') }}">Materi</a>
                    </nav>
                </div>

                <!-- Pegawai Section -->
                <a class="nav-link py-2 collapsed {{ Request::is('admin/staff') || Request::is('admin/instruktur') ? '' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="{{ Request::is('admin/staff') || Request::is('admin/instruktur') ? 'true' : 'false' }}"
                    aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pegawai
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/staff') || Request::is('admin/instruktur') ? 'show' : '' }}"
                    id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link py-1 {{ Request::is('admin/staff') ? 'active' : '' }}" href="{{ url('admin/staff') }}">Staff</a>
                        <a class="nav-link py-1 {{ Request::is('admin/instruktur') ? 'active' : '' }}" href="{{ url('admin/instruktur') }}">Instruktur</a>
                    </nav>
                </div>

                <!-- Siswa Section -->
                <a class="nav-link py-2 collapsed {{ Request::is('admin/siswa') || Request::is('admin/nilai') ? '' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages2"
                    aria-expanded="{{ Request::is('admin/siswa') || Request::is('admin/nilai') ? 'true' : 'false' }}"
                    aria-controls="collapsePages2">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Siswa
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/siswa') || Request::is('admin/nilai') ? 'show' : '' }}"
                    id="collapsePages2" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link py-1 {{ Request::is('admin/siswa') ? 'active' : '' }}" href="{{ url('admin/siswa') }}">Daftar Siswa</a>
                        <a class="nav-link py-1 {{ Request::is('admin/nilai') ? 'active' : '' }}" href="{{ url('admin/nilai') }}">Nilai</a>
                    </nav>
                </div>

                <!-- Pembayaran Link -->
                <a class="nav-link py-2 {{ Request::is('admin/pembayaran') ? 'active' : '' }}" href="{{ url('admin/pembayaran') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Pembayaran
                </a>

                <!-- Sertifikat Link -->
                <a class="nav-link py-2 {{ Request::is('admin/sertifikat') ? 'active' : '' }}" href="{{ url('admin/sertifikat') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Sertifikat
                </a>
                <div class="sb-sidenav-menu-heading">Pengaturan</div>

                <!-- Manajemen Section -->
                <a class="nav-link py-2 collapsed {{ Request::routeIs('admin.profil.index') || Request::routeIs('admin.agenda.index') || Request::routeIs('admin.berita.index') || Request::routeIs('admin.syarat.index') || Request::routeIs('admin.galeri.index') ? '' : 'collapsed' }}"
    href="#" data-bs-toggle="collapse" data-bs-target="#collapseManagement"
    aria-expanded="{{ Request::routeIs('admin.profil.index') || Request::routeIs('admin.agenda.index') || Request::routeIs('admin.berita.index') || Request::routeIs('admin.syarat.index') || Request::routeIs('admin.galeri.index') ? 'true' : 'false' }}"
    aria-controls="collapseManagement">
    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
    Manajemen
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse {{ Request::routeIs('admin.profil.index') || Request::routeIs('admin.agenda.index') || Request::routeIs('admin.berita.index') || Request::routeIs('admin.syarat.index') || Request::routeIs('admin.galeri.index') ? 'show' : '' }}"
    id="collapseManagement" aria-labelledby="headingManagement" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link py-1 {{ Request::routeIs('admin.profil.index') ? 'active' : '' }}" href="{{ route('admin.profil.index') }}">Profil Lembaga</a>
        <a class="nav-link py-1 {{ Request::routeIs('admin.agenda.index') ? 'active' : '' }}" href="{{ route('admin.agenda.index') }}">Agenda</a>
        <a class="nav-link py-1 {{ Request::routeIs('admin.berita.index') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">Berita</a>
        <a class="nav-link py-1 {{ Request::routeIs('admin.syarat.index') ? 'active' : '' }}" href="{{ route('admin.syarat.index') }}">Syarat dan Ketentuan</a>
        <a class="nav-link py-1 {{ Request::routeIs('admin.galeri.index') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}">Galeri</a>
    </nav>
</div>


            </div>
        </div>
    </nav>
</div>

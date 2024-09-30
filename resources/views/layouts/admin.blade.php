<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title')</title>
    <title>Admin Dashboard - LKP Qalsum</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    @include('Partials.navbar')

    <div id="layoutSidenav">
        @include('Partials.sidebar')
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap and custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <!-- Load jQuery Full version (with AJAX support) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        // Menampilkan modal pemberitahuan
        @if (session('success'))
            $('#notificationMessage').text('{{ session('success') }}');
            $('#notificationModal').modal('show');
        @elseif (session('error'))
            $('#notificationMessage').text('{{ session('error') }}');
            $('#notificationModal').modal('show');
        @endif

        // Menangani tombol hapus
        $('.btn-delete').on('click', function() {
            const form = $(this).data('form');
            $('#deleteForm').attr('action', form);
            $('#confirmDeleteModal').modal('show');
        });

        // Contoh AJAX untuk form pemilihan kelas
        $('#formPilihKelas').on('submit', function(e) {
            e.preventDefault();
            let kelasId = $('#kelas').val();

            // Panggilan AJAX
            $.ajax({
                url: '/get-siswa-by-kelas/' + kelasId,
                method: 'GET',
                success: function(response) {
                    $('#siswa').html(response); // Tampilkan siswa di dropdown
                    $('#modalPilihKelas').modal('hide');
                    $('#modalPilihSiswa').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>

</body>

</html>

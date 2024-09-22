<!-- Modal Pilih Kelas dan Jadwal -->
@foreach ($siswa as $s)
    <div class="modal fade" id="pilihKelasModal-{{ $s->id }}" tabindex="-1" aria-labelledby="pilihKelasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pilihKelasModalLabel">Pilih Kelas dan Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk memilih kelas -->
                    <form id="formPilihKelas-{{ $s->id }}" method="POST"
                        action="{{ route('admin.siswa.pilihKelas', $s->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="kelasSelect-{{ $s->id }}">Pilih Kelas:</label>
                            <select name="kelas_id" id="kelasSelect-{{ $s->id }}" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="simpanKelas-{{ $s->id }}">Simpan
                            Kelas</button>
                    </form>

                    <!-- Section untuk menampilkan jadwal setelah kelas dipilih -->
                    <div id="jadwalSection-{{ $s->id }}" style="display: none;">
                        <hr>
                        <h5>Pilih Jadwal</h5>
                        <form id="formPilihJadwal-{{ $s->id }}" method="POST"
                            action="{{ route('admin.siswa.updateKelas', $s->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="jadwalSelect-{{ $s->id }}">Pilih Jadwal:</label>
                                <select name="jadwal_id" id="jadwalSelect-{{ $s->id }}" class="form-control">
                                    <option value="">Pilih Jadwal</option>
                                    <!-- Jadwal akan dimuat menggunakan AJAX -->
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Jadwal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- <script>
    $(document).ready(function() {
        // Event ketika tombol "Simpan Kelas" diklik
        $(document).on('click', '[id^="simpanKelas-"]', function(e) {
            e.preventDefault();

            var siswaId = $(this).attr('id').split('-')[1];
            var kelasId = $('#kelasSelect-' + siswaId).val();

            if (kelasId) {
                $.ajax({
                    url: "{{ route('admin.siswa.pilihKelas', ':id') }}".replace(':id',
                        siswaId),
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kelas_id: kelasId
                    },
                    success: function(response) {
                        $('#jadwalSection-' + siswaId).show();
                        $('#jadwalSelect-' + siswaId).empty().append(
                            '<option value="">Pilih Jadwal</option>');

                        $.each(response.jadwals, function(key, jadwal) {
                            $('#jadwalSelect-' + siswaId).append('<option value="' +
                                jadwal.id + '">' + jadwal.hari + ' - ' + jadwal
                                .jam_mulai + ' s/d ' + jadwal.jam_selesai +
                                '</option>');
                        });
                    },
                    error: function(xhr) {
                        alert('Gagal menyimpan kelas. Silakan coba lagi.');
                    }
                });
            } else {
                alert('Silakan pilih kelas terlebih dahulu.');
            }
        });
    });
</script> --}}

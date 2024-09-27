<!-- Modal -->
<div class="modal fade" id="lihatkelasModal" tabindex="-1" aria-labelledby="lihatkelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatkelasModalLabel">Your modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Society has put up so many boundaries, so many limitations on what’s right and wrong that it’s almost
                impossible to get a pure thought out.
                <br><br>
                It’s like a little kid, a little boy, looking at colors, and no one told him what colors are good,
                before somebody tells you you shouldn’t like pink because that’s for girls, or you’d instantly become a
                gay two-year-old.
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-primary mb-0">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Detail Agenda -->
@foreach ($agendas as $agenda)
    <div class="modal fade" id="agendaDetailModal{{ $agenda->id }}" tabindex="-1" role="dialog"
        aria-labelledby="agendaDetailModalLabel{{ $agenda->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agendaDetailModalLabel{{ $agenda->id }}">{{ $agenda->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</p>
                    <p><strong>Deskripsi:</strong> {{ $agenda->deskripsi }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@foreach ($beritas as $berita)
    <!-- Modal Detail Berita -->
    <div class="modal fade" id="beritaDetailModal{{ $berita->id }}" tabindex="-1" role="dialog"
        aria-labelledby="beritaDetailModalLabel{{ $berita->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaDetailModalLabel{{ $berita->id }}">{{ $berita->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                            class="img-fluid mb-3">
                    @endif
                    <p><strong>Tanggal Publikasi:</strong>
                        {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d M Y') }}</p>
                    <p>{{ $berita->konten }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

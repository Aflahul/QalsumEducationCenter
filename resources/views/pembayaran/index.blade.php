@extends('layouts.guest1')
@section('title', 'Pembayaran')
@section('content')
    <div class="container">
        <h2>Pembayaran Siswa: {{ $siswa->nama }}</h2>

        <h5>Informasi Kelas</h5>
        <p>Kelas: {{ $siswa->jadwal->kelas->nama_kelas }}</p>
        <p>Jadwal: {{ $siswa->jadwal->nama_jadwal }} ({{ $siswa->jadwal->hari }} {{ $siswa->jadwal->jam_mulai }} -
            {{ $siswa->jadwal->jam_selesai }})</p>
        <div class="row mb-4">
            <div class="col-md-5">
                <h5>Status Pembayaran</h5>
                <div class="card p-2 bg-light min-h-24">
                    <p>Status: {{ $pembayaran->status }}</p>
                    <p>Total Biaya: Rp {{ number_format($pembayaran->biaya_total, 0, ',', '.') }}</p>
                    {{-- <p>Angsuran Pertama: Rp {{ number_format($pembayaran->angsuran1, 0, ',', '.') }}</p> --}}
                    {{-- <p>Angsuran Kedua: Rp {{ number_format($pembayaran->angsuran2, 0, ',', '.') }}</p> --}}
                    <p>Sisa Pembayaran: Rp {{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="col-md-7">
                <h5>Metode Pembayaran</h5>
                <div class="card p-2 bg-light min-h-24">
                     Silahkan lakukan pembayaran ke:
                    <div class="row">
                        <div class="col-auto">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="{{ asset('uploads/logo/mandiri.png') }}" alt="" class="img-fluid"
                                        style="max-width: 100px;">
                                </div>
                                <div class="col">
                                    <p><b>Mandiri</b> <br>
                                        xxxx-xxxx-xxxx <br>
                                        <i>Qalsum Education Center</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="{{ asset('uploads/logo/bri.png') }}" alt="" class="img-fluid"
                                        style="max-width: 100px;">
                                </div>
                                <div class="col">
                                    <p><b>BRI</b> <br>
                                        xxxx-xxxx-xxxx <br>
                                        <i>Qalsum Education Center</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @if ($pembayaran->status == 'Belum Ada Pembayaran')
            <h5>Form Pembayaran</h5>
            <form action="{{ route('pembayaran.submit', ['siswa_id' => $siswa->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="input-group input-group-dynamic my-4">
                    <label class="form-label">Jumlah Pembayaran:</label>
                    <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder=""
                        required>
                </div>

                <div class="input-group input-group-static">
                    <label>Unggah Bukti Pembayaran</label>
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran"
                        accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary my-4">Kirim Pembayaran</button>
            </form>
        @else
            <p>Terima kasih, pembayaran Anda sudah kami terima.</p>
        @endif
    </div>
@endsection

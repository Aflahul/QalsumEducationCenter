<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Pembayaran;
use App\Models\Sertifikat;
use App\Models\PenilaianKelas;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    // Menampilkan halaman pendaftaran
    public function index()
    {
        // Ambil data kelas, jadwal, galeri, agenda, dan berita
        $kelas = Kelas::with(['jadwal', 'materi'])->get();
        $galeris = Galeri::paginate(8);
        $agendas = Agenda::paginate(6);
        $beritas = Berita::paginate(6);

        return view('pendaftaran.index', compact('galeris', 'kelas', 'agendas', 'beritas'));
    }

    // Menyimpan data pendaftaran siswa
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'kontak_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'id_jadwal' => 'required|exists:jadwal,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Ambil jadwal dan biaya dari kelas yang terkait
        $jadwal = Jadwal::findOrFail($validatedData['id_jadwal']);
        $kelasId = $jadwal->id_kelas;
        $kelas = Kelas::findOrFail($kelasId);
        $biayaTotal = $kelas->biaya;

        // Generate nomor siswa
        $lastSiswa = Siswa::orderBy('id', 'desc')->first();
        $nextId = $lastSiswa ? intval(substr($lastSiswa->nomor_siswa, 2)) + 1 : 1;
        $siswaId = 'SW' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Simpan data siswa
        $siswa = new Siswa();
        $siswa->nomor_siswa = $siswaId;
        $siswa->nama = $validatedData['nama'];
        $siswa->id_jadwal = $validatedData['id_jadwal'];
        $siswa->tanggal_lahir = $validatedData['tanggal_lahir'];
        $siswa->alamat = $validatedData['alamat'];
        $siswa->kontak_hp = $validatedData['kontak_hp'];
        $siswa->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];

        // Jika ada foto, simpan lokasi foto
        if ($request->hasFile('foto')) {
            $nama = str_replace(' ', '-', strtolower($siswa->nama));
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = 'foto-' . $nama . '.' . $extension;
            $path = $request->file('foto')->move(public_path('uploads/siswa'), $filename);
            $siswa->foto = 'uploads/siswa/' . $filename;
        }

        $siswa->save();

        // Simpan data pembayaran
        Pembayaran::create([
            'id_siswa' => $siswa->id,
            'biaya_total' => $biayaTotal,
            'angsuran1' => 0,
            'angsuran2' => 0,
            'sisa_pembayaran' => $biayaTotal,
            'status' => 'Belum Ada Pembayaran',
        ]);

        // Simpan data penilaian untuk tiap materi kelas
        $materiKelas = Materi::where('id_kelas', $siswa->jadwal->id_kelas)->get();
        foreach ($materiKelas as $materi) {
            PenilaianKelas::create([
                'id_siswa' => $siswa->id,
                'id_kelas' => $siswa->jadwal->id_kelas,
                'id_materi' => $materi->id,
                'nilai' => 0,
                'catatan' => 'Belum ada penilaian',
            ]);
        }

        // Inisialisasi nilai dan sertifikat
        Nilai::create([
            'id_siswa' => $siswa->id,
            'id_kelas' => $siswa->jadwal->id_kelas,
            'nilai_total' => 0,
            'nilai_rata_rata' => 0,
            'grade' => null,
        ]);

        Sertifikat::create([
            'id_siswa' => $siswa->id,
            'id_kelas' => $siswa->jadwal->id_kelas,
            'nilai_akhir' => 0,
            'status' => 'Belum Layak',
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('pembayaran.index', ['siswa_id' => $siswa->id]);
    }

    // Menampilkan halaman pembayaran
    public function showPembayaran($siswaId)
    {
        $siswa = Siswa::with(['jadwal.kelas', 'pembayaran'])->findOrFail($siswaId);
        $pembayaran = Pembayaran::where('id_siswa', $siswa->id)->firstOrFail();

        return view('pembayaran.index', compact('siswa', 'pembayaran'));
    }

    // Menyimpan data pembayaran
    public function storePembayaran(Request $request, $siswaId)
    {
        $validatedData = $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $siswa = Siswa::findOrFail($siswaId);
        $pembayaran = Pembayaran::where('id_siswa', $siswa->id)->firstOrFail();

        // Simpan bukti pembayaran
        if ($request->hasFile('bukti_pembayaran')) {
            $filename = 'bukti-pembayaran-' . $siswa->nomor_siswa . '.' . $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $path = $request->file('bukti_pembayaran')->move(public_path('uploads/pembayaran'), $filename);
            $pembayaran->bukti = 'uploads/pembayaran/' . $filename;
        }

        // Update pembayaran
        $jumlahBayar = $validatedData['jumlah_bayar'];
        if ($pembayaran->angsuran1 == 0) {
            $pembayaran->angsuran1 = $jumlahBayar;
        } else {
            $pembayaran->angsuran2 = $jumlahBayar;
        }

        $pembayaran->sisa_pembayaran = max(0, $pembayaran->biaya_total - ($pembayaran->angsuran1 + $pembayaran->angsuran2));
        $pembayaran->status = $pembayaran->sisa_pembayaran == 0 ? 'Lunas' : 'Belum Lunas';
        $pembayaran->save();

        return redirect()->route('pembayaran.sukses', ['siswa_id' => $siswa->id]);
    }

    // Halaman sukses pembayaran
    public function pembayaranSukses($siswaId)
    {
        $siswa = Siswa::findOrFail($siswaId);
        return view('pembayaran.sukses', compact('siswa'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman2 = Peminjaman::join('ruangan', 'peminjaman.id_ruangan', 'ruangan.id_ruangan')->select('peminjaman.*', 'ruangan.nama_ruang')->where(function(Builder $query) {
            if(Auth::user()->BEM == 0){
                $query->where('nim', Auth::user()->nim);
            } else {
                $query->where('status_peminjaman', 'belum dilihat')
                      ->orWhere('status_peminjaman', 'diproses')
                      ->orWhere('status_peminjaman', 'revisi');
            }
        })->get();
        return view('afterlogin.riwayat.index', ['peminjaman' => $peminjaman2, 'date' => Carbon::parse(date('Y-m-d'))]);
    }

    public function indexSarpra()
    {
        $peminjaman2 = Peminjaman::join('ruangan', 'peminjaman.id_ruangan', 'ruangan.id_ruangan')->select('peminjaman.*', 'ruangan.nama_ruang')->where(function (Builder $query) {
            $query->where('status_peminjaman', 'diproses')
            ->orWhere('status_peminjaman', 'disetujui');
        })->get();
        return view('afterlogin.sarpra.index', ['peminjaman' => $peminjaman2, 'date' => Carbon::parse(date('Y-m-d'))]);
    }

    public function setSetuju($id)
    {
        $updatePeminjaman = Peminjaman::where('id_peminjaman', $id)->update([
            'status_peminjaman' => 'disetujui',
            'status_revisi' => 0
        ]);

        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        $createPesan = Pesan::create([
            'id_peminjaman' => $id,
            'sender' => Auth::guard('sarpra')->user()->nama . ' - Sarana Prasarana FILKOM UB',
            'content' => "Permintaan Anda telah mendapat persetujuan. Mohon unduh dan cetak dokumen terlampir, kemudian serahkan kepada staf sarana prasarana yang bertanggung jawab pada hari yang telah ditentukan, guna memperoleh akses ke ruangan tersebut.",
            'status_sekarang' => 'disetujui'
        ]);

        return redirect()->route('sarpra.riwayat.index');
    }

    public function setTerima($id){
        $updatePeminjaman = Peminjaman::where('id_peminjaman', $id)->update([
            'status_peminjaman' => 'diproses',
            'status_revisi' => 0
        ]);

        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        $createPesan = Pesan::create([
            'id_peminjaman' => $id,
            'sender' => Auth::user()->nama . ' - Administrasi Keuangan BEM FILKOM UB',
            'content' => "Permintaan Anda dengan ID {$id} telah diterima dan saat ini sedang dalam tahap pengajuan kepada pihak yang berwenang. Mohon tetap memantau pemberitahuan yang diterima untuk mendapatkan petunjuk lebih lanjut.",
            'status_sekarang' => 'diproses'
        ]);

        return redirect()->route('riwayat.index');
    }

    public function setTolak(Request $request, $id)
    {
        $updatePeminjaman = Peminjaman::where('id_peminjaman', $id)->update([
            'status_peminjaman' => 'ditolak',
            'status_revisi' => 0
        ]);

        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        $createPesan = Pesan::create([
            'id_peminjaman' => $id,
            'sender' => Auth::guard('sarpra')->user()->nama . ' - Sarana Prasarana FILKOM UB',
            'content' => $request->alasan,
            'status_sekarang' => 'ditolak'
        ]);

        return redirect()->route('sarpra.riwayat.index');
    }

    public function setRevisi(Request $request, $id){
        $updatePeminjaman = Peminjaman::where('id_peminjaman', $id)->update([
            'status_peminjaman' => 'revisi',
            'status_revisi' => 1
        ]);

        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        $createPesan = Pesan::create([
            'id_peminjaman' => $id,
            'sender' => Auth::user()->nama.' - Administrasi Keuangan BEM FILKOM UB',
            'content' => $request->alasan,
            'status_sekarang' => 'revisi'
        ]);

        return redirect()->route('riwayat.index');
    }
}

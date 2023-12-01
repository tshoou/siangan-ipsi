<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pesan;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class HomeController extends Controller
{
    public function index(){
        $ruangan = Ruangan::all();
        return view('afterlogin.home', ['ruangan' => $ruangan]);
    }

    public function index2($id){
        $peminjaman = Peminjaman::join('ruangan', 'peminjaman.id_ruangan', 'ruangan.id_ruangan')->select('peminjaman.*', 'ruangan.nama_ruang')
                                  ->where('id_peminjaman', $id)->first();
        $splitDate = explode(" ", $peminjaman->tgl_peminjaman);
        $peminjaman->tgl_peminjaman = $splitDate[0];
        return view('afterlogin.home2', ['peminjaman' => $peminjaman, 'date' => $splitDate[0]]);
    }

    public function index3()
    {
        return view('afterlogin.home3');
    }

    public function store(Request $request){
        $createPeminjaman = Peminjaman::create([
            'nim' => Auth::user()->nim,
            'id_ruangan' => $request->ruangan,
            'tgl_peminjaman' => $request->tgl_pinjam,
            'tgl_pengajuan' => date('Y-m-d'),
            'waktu_mulai' => $request->timeStart,
            'waktu_selesai' => $request->timeDone, 
            'status_peminjaman' => 'pending'
        ]);

        return redirect()->route('home2', ['peminjamanId' => $createPeminjaman->id_peminjaman]);
    }

    public function store2(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file.*' => 'required|mimes:pdf'
        ]);
        if($validator->fails()){
            return redirect()->back();
        }
        $createPeminjaman = Peminjaman::where('id_peminjaman', $id)->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jumlah_peserta' => $request->jumlah_partisipan,
            'status_peminjaman' => 'belum dilihat',
            'status_revisi' => 0
        ]);

        $createPesan = Pesan::create([
            'id_peminjaman' => $id,
            'sender' => 'SISTEM - SIANGAN FILKOM UB',
            'content' => 'Pengajuan peminjaman anda telah masuk ke sistem, silakan tunggu untuk konfirmasi dari BEM agar bisa masuk ke tahap selanjutnya',
            'status_sekarang' => 'belum dilihat',
        ]);

        $handleFile = $this->handleFile($request->file, Peminjaman::where('id_peminjaman', $id)->first());

        return redirect()->route('home3');
    }

    public function handleFile($files, Peminjaman $peminjaman){
        $success = true;
        $i = 1;
        if($files == null){
            $success = false;
        } else {
            $deleteKtm = Storage::delete('syarat/' . $peminjaman->ktm_digital);
            $deleteSurat = Storage::delete('syarat/' . $peminjaman->surat_peminjaman);
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $replacedTimestamps = str_replace(':', '-', $peminjaman->tgl_peminjaman);
                $newFileName = str_replace(" ", "", Auth::user()->nim . '_' . $peminjaman->id_peminjaman . '_' . $i . '_' . $replacedTimestamps . '.' . $extension);
                $i == 1 ? $newFileName = "ktm-".$newFileName : $newFileName = "surat-".$newFileName; 
                $store = $file->storeAs('syarat', $newFileName, 'public');
                if (!$store) {
                    $delete = Storage::delete('syarat/' . $newFileName);
                    $success = false;
                }
                if($i == 1){
                    $updatePeminjaman = Peminjaman::where('id_peminjaman', $peminjaman->id_peminjaman)->update([
                        'ktm_digital' => $newFileName
                    ]);
                } else {
                    $updatePeminjaman = Peminjaman::where('id_peminjaman', $peminjaman->id_peminjaman)->update([
                        'surat_peminjaman' => $newFileName
                    ]);
                }
                ++$i;
            }
        }
        return $success;
    }


    //api
    public function getJadwal(Request $request){
        $availableDate = Peminjaman::where('tgl_peminjaman', $request->tgl_peminjaman)->where('id_ruangan', $request->id_ruangan)
                                   ->where('status_peminjaman', "disetujui")->get();
        return response()->json([
            'success' => true,
            'data' => $availableDate
        ]);
    }
}

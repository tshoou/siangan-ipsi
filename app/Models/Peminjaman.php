<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Peminjaman
 * 
 * @property int $id_peminjaman
 * @property string $nim
 * @property int $id_ruangan
 * @property string $nama_kegiatan
 * @property int $jumlah_peserta
 * @property string $tujuan_peminjaman
 * @property Carbon $tgl_pengajuan
 * @property Carbon $tgl_peminjaman
 * @property Carbon $tgl_selesai
 * @property string $ktm_digital
 * @property string $surat_peminjaman
 * @property string $status_revisi
 * @property string $status_peminjaman
 * @property string $surat_terbit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Peminjaman extends Model
{
	protected $table = 'peminjaman';
	protected $primaryKey = 'id_peminjaman';

	protected $casts = [
		'id_ruangan' => 'int',
		'jumlah_peserta' => 'int',
		'tgl_pengajuan' => 'datetime',
		'tgl_peminjaman' => 'datetime',
		'tgl_selesai' => 'datetime'
	];

	protected $fillable = [
		'nim',
		'id_ruangan',
		'nama_kegiatan',
		'jumlah_peserta',
		'tujuan_peminjaman',
		'tgl_pengajuan',
		'tgl_peminjaman',
		'waktu_mulai',
		'waktu_selesai',
		'tgl_selesai',
		'ktm_digital',
		'surat_peminjaman',
		'status_revisi',
		'status_peminjaman',
		'surat_terbit'
	];
}

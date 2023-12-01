<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JadwalTersedium
 * 
 * @property int $id_jadwal
 * @property int $id_ruangan
 * @property int $id_peminjaman
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class JadwalTersedium extends Model
{
	protected $table = 'jadwal_tersedia';
	protected $primaryKey = 'id_jadwal';

	protected $casts = [
		'id_ruangan' => 'int',
		'id_peminjaman' => 'int'
	];

	protected $fillable = [
		'id_ruangan',
		'id_peminjaman'
	];
}

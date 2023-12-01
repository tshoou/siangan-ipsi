<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ruangan
 * 
 * @property int $id_ruangan
 * @property string $nama_ruang
 * @property string $detail_ruang
 * @property int $kapasitas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Ruangan extends Model
{
	protected $table = 'ruangan';
	protected $primaryKey = 'id_ruangan';

	protected $casts = [
		'kapasitas' => 'int'
	];

	protected $fillable = [
		'nama_ruang',
		'detail_ruang',
		'kapasitas'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pesan
 * 
 * @property int $id
 * @property int $id_peminjaman
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Pesan extends Model
{
	protected $table = 'pesan';

	protected $casts = [
		'id_peminjaman' => 'int'
	];

	protected $fillable = [
		'id_peminjaman',
		'sender',
		'status_sekarang',
		'content'
	];
}

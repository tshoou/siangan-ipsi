<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Adkeu
 * 
 * @property string $username
 * @property string $nim
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Adkeu extends Model
{
	protected $table = 'adkeu';
	protected $primaryKey = 'username';
	public $incrementing = false;

	protected $fillable = [
		'nim',
		'username',
	];
}

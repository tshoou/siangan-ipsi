<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Mahasiswa
 * 
 * @property string $nim
 * @property string $nama
 * @property string $password
 * @property string $no_hp
 * @property string $email
 * @property Carbon $tgl_lahir
 * @property string $alamat
 * @property string $jenis_kelamin
 * @property bool $BEM
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Mahasiswa extends Authenticatable
{
	use Notifiable;
	protected $table = 'mahasiswa';
	protected $primaryKey = 'nim';
	public $incrementing = false;

	protected $casts = [
		'tgl_lahir' => 'datetime',
		'BEM' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nim',
		'nama',
		'password',
		'no_hp',
		'email',
		'tgl_lahir',
		'alamat',
		'jenis_kelamin',
		'BEM'
	];

	public function getAuthIdentifierName()
	{
		return 'nim'; // replace 'id' with the actual primary key field name of your Mahasiswa model
	}

	public function getAuthIdentifier()
	{
		return $this->{$this->getAuthIdentifierName()};
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

}

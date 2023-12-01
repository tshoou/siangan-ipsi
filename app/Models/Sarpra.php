<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sarpra
 * 
 * @property string $username
 * @property string $nama
 * @property string $password
 * @property string $phone_number
 * @property string $email
 * @property Carbon $tgl_lahir
 * @property string $alamat
 * @property string $jenis_kelamin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Sarpra extends Authenticatable
{
	protected $table = 'sarpras';
	protected $primaryKey = 'username';
	public $incrementing = false;

	protected $casts = [
		'tgl_lahir' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'nama',
		'password',
		'phone_number',
		'email',
		'tgl_lahir',
		'alamat',
		'jenis_kelamin'
	];

	public function getAuthIdentifierName()
	{
		return 'username'; // replace 'id' with the actual primary key field name of your Mahasiswa model
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

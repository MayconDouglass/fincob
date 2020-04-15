<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 09 Apr 2020 12:50:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Usuario
 * 
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $ativo
 * @property string $remember_token
 * 
 * @property \Illuminate\Database\Eloquent\Collection $contas
 *
 * @package App\Models
 */
class Usuario extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email',
		'password',
		'ativo',
		'remember_token'
	];

	public function contas()
	{
		return $this->belongsToMany(\App\Models\Conta::class, 'usuarios_contas', 'usuario_pfk', 'conta_pfk');
	}
}

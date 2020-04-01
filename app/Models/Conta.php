<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 31 Mar 2020 03:04:06 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Conta
 * 
 * @property int $id
 * @property string $tipo
 * @property string $titulo
 * @property float $valor
 * @property int $efetivado
 * 
 * @property \Illuminate\Database\Eloquent\Collection $usuarios
 *
 * @package App\Models
 */
class Conta extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'valor' => 'float',
		'efetivado' => 'int'
	];

	protected $fillable = [
		'tipo',
		'titulo',
		'valor',
		'efetivado'
	];

	public function usuarios()
	{
		return $this->belongsToMany(\App\Models\Usuario::class, 'usuarios_contas', 'conta_pfk', 'usuario_pfk');
	}
}

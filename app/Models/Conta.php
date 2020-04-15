<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Apr 2020 04:13:18 +0000.
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
 * @property int $parcela
 * @property \Carbon\Carbon $data_conta
 * @property \Carbon\Carbon $data_efetivacao
 * @property \Carbon\Carbon $vencimento
 * @property int $categoria_fk
 * @property int $pasta_fk
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
		'efetivado' => 'int',
		'parcela' => 'int',
		'categoria_fk' => 'int',
		'pasta_fk' => 'int'
	];

	protected $dates = [
		'data_conta',
		'data_efetivacao',
		'vencimento'
	];

	protected $fillable = [
		'tipo',
		'titulo',
		'valor',
		'efetivado',
		'parcela',
		'data_conta',
		'data_efetivacao',
		'vencimento',
		'categoria_fk',
		'pasta_fk'
	];

	public function categorias()
	{
		return $this->belongsToMany(\App\Models\Categoria::class,'categorias' ,'id');
	}
	public function pastas()
	{
		return $this->belongsToMany(\App\Models\Pasta::class, 'pasta_fk');
	}
	public function usuarios()
	{
		return $this->belongsToMany(\App\Models\Usuario::class, 'usuarios_contas', 'conta_pfk', 'usuario_pfk');
	}
}

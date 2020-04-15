<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Apr 2020 03:42:51 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Categoria
 * 
 * @property int $id
 * @property string $nome
 *
 * @package App\Models
 */
class Categoria extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'nome'
	];
}

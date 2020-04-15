<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Apr 2020 03:43:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pasta
 * 
 * @property int $id
 * @property string $nome
 *
 * @package App\Models
 */
class Pasta extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'nome'
	];
}

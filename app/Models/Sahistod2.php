<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sahistod2
 * 
 * @property float $num_histo
 * @property string $cod_anexo
 * @property string $memo
 * @property Carbon $fecha
 * @property string $hora
 * @property string $medico
 * @property string $serie
 * @property string $td
 * @property float $docn
 * @property string|null $trial008
 *
 * @package App\Models
 */
class Sahistod2 extends Model
{
	protected $table = 'sahistod2';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'num_histo' => 'float',
		'fecha' => 'datetime',
		'docn' => 'float'
	];

	protected $fillable = [
		'num_histo',
		'cod_anexo',
		'memo',
		'fecha',
		'hora',
		'medico',
		'serie',
		'td',
		'docn',
		'trial008'
	];
}

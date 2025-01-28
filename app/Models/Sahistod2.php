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
 * @property int $id
 * @property float|null $num_histo
 * @property string|null $cod_anexo
 * @property string|null $memo
 * @property Carbon|null $fecha
 * @property string|null $hora
 * @property string|null $medico
 * @property string|null $serie
 * @property string|null $td
 * @property float|null $docn
 * @property string|null $trial922
 *
 * @package App\Models
 */
class Sahistod2 extends Model
{
	protected $table = 'sahistod2';
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
		'trial922'
	];
}

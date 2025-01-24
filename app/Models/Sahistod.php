<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sahistod
 * 
 * @property float $num_histo
 * @property Carbon $fecha
 * @property string $hora
 * @property string $medico
 * @property string $anamnesis
 * @property string $sintomas
 * @property string $tratam
 * @property string $evoluc
 * @property string|null $trial667
 *
 * @package App\Models
 */
class Sahistod extends Model
{
	protected $table = 'sahistod';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'num_histo' => 'float',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'num_histo',
		'fecha',
		'hora',
		'medico',
		'anamnesis',
		'sintomas',
		'tratam',
		'evoluc',
		'trial667'
	];
}

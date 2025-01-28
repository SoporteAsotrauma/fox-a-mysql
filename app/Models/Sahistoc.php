<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sahistoc
 * 
 * @property float $num_histo
 * @property string $apellido1
 * @property string $apellido2
 * @property string $nombre
 * @property string $sexo
 * @property float $doc_id
 * @property string $direccion
 * @property string $ciudad
 * @property string $telefono
 * @property Carbon $fecha
 * @property Carbon $fech_nacim
 * @property Carbon $prox_cita
 * @property string $nombre2
 * @property string $estad_civ
 * @property float $edad
 * @property string $cod_edad
 * @property string $ocupacion
 * @property string $nomb_acom
 * @property string $tel_acom
 * @property string $nomb_resp
 * @property string $tel_resp
 * @property string $paren_resp
 * @property string $municip
 * @property string $zona_resid
 * @property string $tipo_id
 * @property string $tipo_vincu
 * @property string $marcado
 * @property string $nom
 * @property string $cod_entid
 * @property string $rh
 * @property string $estatus
 * @property float $localiza
 * @property string $medico
 * @property string $estrato
 * @property string $lug_nacim
 * @property string $raza
 * @property string $religion
 * @property string $etnia
 * @property string $contrato
 * @property string $plan
 * @property string $gae
 * @property string $tipo_afil
 * @property string $barrio
 * @property string $cat_eps
 * @property string $carnet
 * @property string $activo
 * @property string $email
 * @property string $ocupacio1
 * @property float $escolarid
 * @property string $eps2
 * @property string|null $trial081
 *
 * @package App\Models
 */
class Sahistoc extends Model
{
	protected $table = 'sahistoc';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'num_histo' => 'float',
		'doc_id' => 'float',
		'fecha' => 'datetime',
		'fech_nacim' => 'datetime',
		'prox_cita' => 'datetime',
		'edad' => 'float',
		'localiza' => 'float',
		'escolarid' => 'float'
	];

	protected $fillable = [
		'num_histo',
		'apellido1',
		'apellido2',
		'nombre',
		'sexo',
		'doc_id',
		'direccion',
		'ciudad',
		'telefono',
		'fecha',
		'fech_nacim',
		'prox_cita',
		'nombre2',
		'estad_civ',
		'edad',
		'cod_edad',
		'ocupacion',
		'nomb_acom',
		'tel_acom',
		'nomb_resp',
		'tel_resp',
		'paren_resp',
		'municip',
		'zona_resid',
		'tipo_id',
		'tipo_vincu',
		'marcado',
		'nom',
		'cod_entid',
		'rh',
		'estatus',
		'localiza',
		'medico',
		'estrato',
		'lug_nacim',
		'raza',
		'religion',
		'etnia',
		'contrato',
		'plan',
		'gae',
		'tipo_afil',
		'barrio',
		'cat_eps',
		'carnet',
		'activo',
		'email',
		'ocupacio1',
		'escolarid',
		'eps2',
		'trial081'
	];
}

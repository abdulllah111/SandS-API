<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Office
 * 
 * @property int $idoffice
 * @property string $office_number
 * 
 * @property Collection|SubTtable[] $sub_ttables
 * @property Collection|Ttable[] $ttables
 *
 * @package App\Models
 */
class Office extends Model
{
	protected $table = 'office';
	protected $primaryKey = 'idoffice';
	public $timestamps = false;

	protected $fillable = [
		'office_number'
	];

	public function sub_ttables()
	{
		return $this->hasMany(SubTtable::class, 'idoffice');
	}

	public function ttables()
	{
		return $this->hasMany(Ttable::class, 'idoffice');
	}
}

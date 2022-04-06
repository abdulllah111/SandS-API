<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Weekday
 * 
 * @property int $idweekday
 * @property string $weekday_name
 * 
 * @property Collection|SubTtable[] $sub_ttables
 * @property Collection|Ttable[] $ttables
 *
 * @package App\Models
 */
class Weekday extends Model
{
	protected $table = 'weekday';
	protected $primaryKey = 'idweekday';
	public $timestamps = false;

	protected $fillable = [
		'weekday_name'
	];

	public function sub_ttables()
	{
		return $this->hasMany(SubTtable::class, 'idweekday');
	}

	public function ttables()
	{
		return $this->hasMany(Ttable::class, 'idweekday');
	}
}

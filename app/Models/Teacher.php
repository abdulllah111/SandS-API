<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Teacher
 * 
 * @property int $idteacher
 * @property string $name
 * 
 * @property Collection|Discipline[] $disciplines
 * @property Collection|Group[] $groups
 *
 * @package App\Models
 */
class Teacher extends Model
{
	protected $table = 'teacher';
	protected $primaryKey = 'idteacher';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function disciplines()
	{
		return $this->belongsToMany(Discipline::class, 'discipline-group-teacher', 'idteacher', 'iddiscipline')
					->withPivot('iddiscipline-group-teacher', 'idgroup');
	}

	public function groups()
	{
		return $this->belongsToMany(Group::class, 'discipline-group-teacher', 'idteacher', 'idgroup')
					->withPivot('iddiscipline-group-teacher', 'iddiscipline');
	}
}

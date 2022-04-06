<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discipline
 * 
 * @property int $iddiscipline
 * @property string $discipline_name
 * 
 * @property Collection|Group[] $groups
 * @property Collection|Teacher[] $teachers
 *
 * @package App\Models
 */
class Discipline extends Model
{
	protected $table = 'discipline';
	protected $primaryKey = 'iddiscipline';
	public $timestamps = false;

	protected $fillable = [
		'discipline_name'
	];

	public function groups()
	{
		return $this->belongsToMany(Group::class, 'discipline-group-teacher', 'iddiscipline', 'idgroup')
					->withPivot('iddiscipline-group-teacher', 'idteacher');
	}

	public function teachers()
	{
		return $this->belongsToMany(Teacher::class, 'discipline-group-teacher', 'iddiscipline', 'idteacher')
					->withPivot('iddiscipline-group-teacher', 'idgroup');
	}
}

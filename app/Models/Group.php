<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * 
 * @property int $idgroup
 * @property string $group_name
 * @property int $iddepartment
 * 
 * @property Department $department
 * @property Collection|Discipline[] $disciplines
 * @property Collection|Teacher[] $teachers
 *
 * @package App\Models
 */
class Group extends Model
{
	protected $table = 'group';
	protected $primaryKey = 'idgroup';
	public $timestamps = false;

	protected $casts = [
		'iddepartment' => 'int'
	];

	protected $fillable = [
		'group_name',
		'iddepartment'
	];

	public function department()
	{
		return $this->belongsTo(Department::class, 'iddepartment');
	}

	public function disciplines()
	{
		return $this->belongsToMany(Discipline::class, 'discipline-group-teacher', 'idgroup', 'iddiscipline')
					->withPivot('iddiscipline-group-teacher', 'idteacher');
	}

	public function teachers()
	{
		return $this->belongsToMany(Teacher::class, 'discipline-group-teacher', 'idgroup', 'idteacher')
					->withPivot('iddiscipline-group-teacher', 'iddiscipline');
	}
}

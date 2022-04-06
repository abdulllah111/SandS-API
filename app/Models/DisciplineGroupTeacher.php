<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DisciplineGroupTeacher
 * 
 * @property int $iddiscipline-group-teacher
 * @property int|null $idteacher
 * @property int $iddiscipline
 * @property int $idgroup
 * 
 * @property Discipline $discipline
 * @property Group $group
 * @property Teacher|null $teacher
 * @property Collection|SubTtable[] $sub_ttables
 * @property Collection|Ttable[] $ttables
 *
 * @package App\Models
 */
class DisciplineGroupTeacher extends Model
{
	protected $table = 'discipline-group-teacher';
	protected $primaryKey = 'iddiscipline-group-teacher';
	public $timestamps = false;

	protected $casts = [
		'idteacher' => 'int',
		'iddiscipline' => 'int',
		'idgroup' => 'int'
	];

	protected $fillable = [
		'idteacher',
		'iddiscipline',
		'idgroup'
	];

	public function discipline()
	{
		return $this->belongsTo(Discipline::class, 'iddiscipline');
	}

	public function group()
	{
		return $this->belongsTo(Group::class, 'idgroup');
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'idteacher');
	}

	public function sub_ttables()
	{
		return $this->hasMany(SubTtable::class, 'iddisciplinegroupteacher');
	}

	public function ttables()
	{
		return $this->hasMany(Ttable::class, 'iddisciplinegroupteacher');
	}
}

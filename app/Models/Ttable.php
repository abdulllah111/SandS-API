<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ttable
 * 
 * @property int $idttable
 * @property int $idweekday
 * @property int $idlesson
 * @property int|null $idoffice
 * @property int $iddisciplinegroupteacher
 * 
 * @property DisciplineGroupTeacher $discipline_group_teacher
 * @property Lesson $lesson
 * @property Office|null $office
 * @property Weekday $weekday
 *
 * @package App\Models
 */
class Ttable extends Model
{
	protected $table = 'ttable';
	protected $primaryKey = 'idttable';
	public $timestamps = false;

	protected $casts = [
		'idweekday' => 'int',
		'idlesson' => 'int',
		'idoffice' => 'int',
		'iddisciplinegroupteacher' => 'int'
	];

	protected $fillable = [
		'idweekday',
		'idlesson',
		'idoffice',
		'iddisciplinegroupteacher'
	];

	public function discipline_group_teacher()
	{
		return $this->belongsTo(DisciplineGroupTeacher::class, 'iddisciplinegroupteacher');
	}
	public function lesson()
	{
		return $this->belongsTo(Lesson::class, 'idlesson');
	}

	public function office()
	{
		return $this->belongsTo(Office::class, 'idoffice');
	}

	public function weekday()
	{
		return $this->belongsTo(Weekday::class, 'idweekday');
	}
}

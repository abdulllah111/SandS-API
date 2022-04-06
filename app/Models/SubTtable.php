<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubTtable
 * 
 * @property int $idsub_ttable
 * @property int $idweekday
 * @property int $idlesson
 * @property int|null $idoffice
 * @property int $iddisciplinegroupteacher
 * @property Carbon $date
 * 
 * @property DisciplineGroupTeacher $discipline_group_teacher
 * @property Lesson $lesson
 * @property Office|null $office
 * @property Weekday $weekday
 *
 * @package App\Models
 */
class SubTtable extends Model
{
	protected $table = 'sub_ttable';
	protected $primaryKey = 'idsub_ttable';
	public $timestamps = false;

	protected $casts = [
		'idweekday' => 'int',
		'idlesson' => 'int',
		'idoffice' => 'int',
		'iddisciplinegroupteacher' => 'int'
	];

	protected $dates = [
		'date' => 'date_format:d.m.y',
	];
	protected $fillable = [
		'idweekday',
		'idlesson',
		'idoffice',
		'iddisciplinegroupteacher',
		'date'
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

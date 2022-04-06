<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 * 
 * @property int $idlesson
 * @property int $lesson_number
 * 
 * @property Collection|SubTtable[] $sub_ttables
 * @property Collection|Ttable[] $ttables
 *
 * @package App\Models
 */
class Lesson extends Model
{
	protected $table = 'lesson';
	protected $primaryKey = 'idlesson';
	public $timestamps = false;

	protected $casts = [
		'lesson_number' => 'string'
	];

	protected $fillable = [
		'lesson_number'
	];

	public function sub_ttables()
	{
		return $this->hasMany(SubTtable::class, 'idlesson');
	}

	public function ttables()
	{
		return $this->hasMany(Ttable::class, 'idlesson');
	}
}

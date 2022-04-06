<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $iddepartment
 * @property string $department_name
 * 
 * @property Collection|Group[] $groups
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'department';
	protected $primaryKey = 'iddepartment';
	public $timestamps = false;

	protected $fillable = [
		'department_name'
	];

	public function groups()
	{
		return $this->hasMany(Group::class, 'iddepartment');
	}
}

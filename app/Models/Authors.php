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
class Authors extends Model
{
	protected $table = 'authors';
	protected $primaryKey = 'idauthors';
	public $timestamps = false;

	protected $fillable = [
		'password',
		'rights'
	];
}

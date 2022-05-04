<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Push
 * 
 * @property int $idpush
 * @property int|null $idteacher
 * @property string $token
 * 
 * @property Teacher|null $teacher
 *
 * @package App\Models
 */
class Push extends Model
{
	protected $table = 'push';
	protected $primaryKey = 'idpush';
	public $timestamps = false;

	protected $casts = [
		'idteacher' => 'int',
	];

	protected $fillable = [
		'idteacher',
		'token',
	];

	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'idteacher');
	}
}

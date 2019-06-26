<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
	public static function colors()
	{
		return (new static)->where('name','like','%Color')->pluck('text_value','name');
	}
}


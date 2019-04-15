<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function display_name()
    {
    	return $this->last_name . ", " . $this->first_name;
    }
}

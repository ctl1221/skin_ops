<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sellable extends Model
{

    public function items()
    {
        return $this->hasMany('App\Service');
    }

    public static function everything()
    {
    	$products = DB::table('products')
    				->select('id as sellable_id')
    				->addSelect('name')
    				->addSelect(DB::raw("'Product' as type"));

    	$services = DB::table('services')
    				->select('id as sellable_id')
    				->addSelect('name')
    				->addSelect(DB::raw("'Service' as type"))
    				->union($products)
    				->get();

    	return $services;
    }
}

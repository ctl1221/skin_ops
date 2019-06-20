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
    				->addSelect(DB::raw("'Product' as sellable_type"))
                    ->orderBy('name', 'asc');

    	$services = DB::table('services')
    				->select('id as sellable_id')
    				->addSelect('name')
    				->addSelect(DB::raw("'Service' as sellable_type"))
                    ->orderBy('name', 'asc')
    				->union($products)
                    ->orderBy('name', 'asc')
    				->get();

    	return $services;
    }
}

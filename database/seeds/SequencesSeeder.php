<?php

use Illuminate\Database\Seeder;
use App\Sequence;

class SequencesSeeder extends Seeder
{
    public function run()
    {
        Sequence::create([
            'name' => 'SO Number',
            'description' => 'Sales Order Number',
            'prefix' => 'SO',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '10001'
        ]);

        Sequence::create([
            'name' => 'DT Number',
            'description' => 'Draft Number',
            'prefix' => 'DT',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '10001'
        ]);

        Sequence::create([
            'name' => 'PY Number',
            'description' => 'Payment Number',
            'prefix' => 'PY',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '10001'
        ]);

        Sequence::create([
            'name' => 'RT Number',
            'description' => 'Report Number',
            'prefix' => 'RT',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '10001'
        ]);

        Sequence::create([
            'name' => 'Date Lock End',
            'description' => 'Date Lock End',
            'prefix' => 'DL',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '2019-06-01'
        ]);
    }
}

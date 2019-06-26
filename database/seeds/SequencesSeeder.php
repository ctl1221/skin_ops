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

        Sequence::create([
            'name' => 'Sales Color',
            'description' => 'Sales Color',
            'prefix' => 'SC',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '#00FF00'
        ]);

        Sequence::create([
            'name' => 'Payment Color',
            'description' => 'Payment Color',
            'prefix' => 'SC',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '#0000FF'
        ]);


        Sequence::create([
            'name' => 'Claim Color',
            'description' => 'Claim Color',
            'prefix' => 'SC',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '#123123'
        ]);


        Sequence::create([
            'name' => 'Gave Color',
            'description' => 'Gave Color',
            'prefix' => 'SC',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '#555555'
        ]);

        Sequence::create([
            'name' => 'Received Color',
            'description' => 'Received Color',
            'prefix' => 'SC',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '#222222'
        ]);
    }
}

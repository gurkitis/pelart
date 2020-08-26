<?php

use App\Price_type;
use Illuminate\Database\Seeder;

class Price_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Price_type();
        $a->name = 'Professional full price';
        $a->save();

        $b = new Price_type();
        $b->name = 'Professional with 20% discount';
        $b->save();

        $c = new Price_type();
        $c->name = 'Client price';
        $c->save();
    }
}

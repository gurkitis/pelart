<?php

use App\Buy_price;
use Illuminate\Database\Seeder;

class Buy_priceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Buy_price();
        $a->product_id = 1;
        $a->active_from = '2020-08-06';
        $a->value = 11.75;
        $a->save();

        $b = new Buy_price();
        $b->product_id = 2;
        $b->active_from = '2020-08-06';
        $b->value = 3.6;
        $b->save();

        $c = new Buy_price();
        $c->product_id = 2;
        $c->active_from = '2020-08-01';
        $c->value = 1;
        $c->save();
    }
}

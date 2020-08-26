<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Product();
        $a->product_nr = 10010;
        $a->name = 'Cleansing gel for oily skin';
        $a->volume = 1000;
        $a->save();

        $b = new Product();
        $b->product_nr = 10011;
        $b->name = 'Cleansing gel for oily skin';
        $b->volume = 250;
        $b->save();
    }
}

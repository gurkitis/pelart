<?php

use App\Sale_price;
use Illuminate\Database\Seeder;

class Sale_priceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Sale_price();
        $a->price_type_id = 1;
        $a->product_id = 1;
        $a->value = 48.35;
        $a->active_from = '2020-08-09';
        $a->save();

        $b = new Sale_price();
        $b->price_type_id = 2;
        $b->product_id = 1;
        $b->value = 38.68;
        $b->active_from = '2020-08-09';
        $b->save();

        $c = new Sale_price();
        $c->price_type_id = 3;
        $c->product_id = 1;
        $c->value = 57.42;
        $c->active_from = '2020-08-09';
        $c->save();

        $d = new Sale_price();
        $d->price_type_id = 1;
        $d->product_id = 2;
        $d->value = 13.32;
        $d->active_from = '2020-08-09';
        $d->save();

        $e = new Sale_price();
        $e->price_type_id = 2;
        $e->product_id = 2;
        $e->value = 10.66;
        $e->active_from = '2020-08-09';
        $e->save();

        $f = new Sale_price();
        $f->price_type_id = 3;
        $f->product_id = 2;
        $f->value = 18.50;
        $f->active_from = '2020-08-09';
        $f->save();
    }
}

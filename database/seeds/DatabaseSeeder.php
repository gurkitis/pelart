<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductSeeder::class,
            Buy_priceSeeder::class,
            Price_typeSeeder::class,
            Sale_priceSeeder::class,
            UserSeeder::class
        ]);
    }
}

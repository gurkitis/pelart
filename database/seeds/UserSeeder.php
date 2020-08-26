<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tosteris = new User();
        $tosteris->name = 'tosteris';
        $tosteris->email = 'tosteris@pelart.com';
        $tosteris->password = bcrypt('tosteris');
        $tosteris->role = 'admin';
        $tosteris->save();
    }
}

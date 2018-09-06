<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'uuid' => \Faker\Provider\Uuid::uuid(),
            'name' => 'Administrator',
            'email' => 'admin@ainiok.com',
            'phone' => '13148885200',
            'password' => '123456'
        ]);
    }
}

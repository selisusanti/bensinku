<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
            "email" => "susantiseli03@gmail.com",
            "password" => Hash::make('admin12345'),
        ]);
    }
}

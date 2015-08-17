<?php

use Illuminate\Database\Seeder;

class PublicUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('public_users')->delete();

        DB::table('public_users')->insert([
            'email' => 'juan@gmail.com',
            'password' => bcrypt('secret'),
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'contact_number' => '09152222222',
        ]);
    }
}

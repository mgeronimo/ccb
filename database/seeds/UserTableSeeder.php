<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();

        //Administrator
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('ccb00!'),
            'first_name' => 'CCB',
            'last_name' => 'Administrator',
            'username' => 'ccb-admin',
            'role' => 0,
            'is_verified' => 1,
            'group_number' => null,
            'remember_token' => str_random(60),

        ]);

        //Supervisor
        DB::table('users')->insert([
            'email' => 'super@gmail.com',
            'password' => bcrypt('super1'),
            'first_name' => 'CCB',
            'last_name' => 'Supervisor',
            'username' => 'super1',
            'role' => 1,
            'is_verified' => 1,
            'group_number' => 1,
            'remember_token' => str_random(60),
        ]);

        //Agents
        DB::table('users')->insert([
            'email' => 'agent1@gmail.com',
            'password' => bcrypt('agent1'),
            'first_name' => 'Nene',
            'last_name' => 'Dela Cruz',
            'username' => 'agent1',
            'role' => 2,
            'is_verified' => 1,
            'group_number' => 1,
            'remember_token' => str_random(60),
        ]);

        DB::table('users')->insert([
            'email' => 'agent2@gmail.com',
            'password' => bcrypt('agent2'),
            'first_name' => 'Pedro',
            'last_name' => 'Dela Cruz',
            'username' => 'agent2',
            'role' => 2,
            'is_verified' => 1,
            'group_number' => 1,
            'remember_token' => str_random(60),
        ]);

        //Public Users
        DB::table('users')->insert([
            'email' => 'juan@gmail.com',
            'password' => bcrypt('secret'),
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'role'  => 3,
            'is_verified' => 1,
            'contact_number' => '09152222222',
        ]);

        //Department Representative
        DB::table('users')->insert([
            'email' => 'deptrep@gmail.com',
            'password' => bcrypt('deptrep'),
            'first_name' => 'Pedro',
            'last_name' => 'Cruz',
            'role'  => 4,
            'is_verified' => 1,
            'contact_number' => '09152222222',
        ]);

        DB::table('users')->insert([
            'email' => 'deptrep2@gmail.com',
            'password' => bcrypt('deptrep2'),
            'first_name' => 'Jose',
            'last_name' => 'Santos',
            'role'  => 4,
            'is_verified' => 1,
            'contact_number' => '09152222222',
        ]);
    }
}

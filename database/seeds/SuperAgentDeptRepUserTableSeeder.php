<?php

use Illuminate\Database\Seeder;

class SuperAgentDeptRepUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('super_agent_deptrep')->delete();

        //Administrator
        DB::table('super_agent_deptrep')->insert([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('ccb00!'),
            'first_name' => 'CCB',
            'last_name' => 'Administrator',
            'username' => 'ccb-admin',
            'role' => 0,
            'group_number' => null,
        ]);

        //Supervisor
        DB::table('super_agent_deptrep')->insert([
            'email' => 'super@gmail.com',
            'password' => bcrypt('super1'),
            'first_name' => 'CCB',
            'last_name' => 'Supervisor',
            'username' => 'super1',
            'role' => 1,
            'group_number' => 1,
        ]);

        //Agents
        DB::table('super_agent_deptrep')->insert([
            'email' => 'agent1@gmail.com',
            'password' => bcrypt('agent1'),
            'first_name' => 'Nene',
            'last_name' => 'Dela Cruz',
            'username' => 'agent1',
            'role' => 2,
            'group_number' => 1,
        ]);

        DB::table('super_agent_deptrep')->insert([
            'email' => 'agent2@gmail.com',
            'password' => bcrypt('agent2'),
            'first_name' => 'Pedro',
            'last_name' => 'Dela Cruz',
            'username' => 'agent2',
            'role' => 2,
            'group_number' => 1,
        ]);
    }
}

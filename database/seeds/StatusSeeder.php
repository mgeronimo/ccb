<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->delete();

        DB::table('statuses')->insert([
            'status' => 'New',
            'class'  => 'success'
        ]);

        DB::table('statuses')->insert([
            'status' => 'In Process',
            'class'  => 'info'
        ]);

        DB::table('statuses')->insert([
            'status' => 'Awaiting for Client',
            'class'  => 'warning'
        ]);

        DB::table('statuses')->insert([
            'status' => 'Cancelled',
            'class'  => 'danger'
        ]);

        DB::table('statuses')->insert([
            'status' => 'Closed',
            'class'  => 'default'
        ]);

        DB::table('statuses')->insert([
            'status' => 'Overdue',
            'class'  => 'danger'
        ]);

        DB::table('statuses')->insert([
            'status' => 'Awaiting for Agency',
            'class'  => 'warning'
        ]);
    }
}

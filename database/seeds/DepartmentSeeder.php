<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();

        DB::table('departments')->insert([
            'dept_name' => 'DAR',
            'is_member' => 1,
            'description' => 'Department of Agrarian Reform',
            'dept_rep' => 6,
        ]);

        DB::table('departments')->insert([
            'dept_name' => 'DA',
            'is_member' => 1,
            'description' => 'Department of Agriculture',
            'dept_rep' => 7,
        ]);
    }
}

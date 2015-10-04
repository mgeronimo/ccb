<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //$this->call(GroupTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(OAuthSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(StatusSeeder::class);
        Model::reguard();
    }
}

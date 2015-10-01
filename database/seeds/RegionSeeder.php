<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('region')->delete();

        DB::table('region')->insert([
        	'regcode' => 01,
        	'regname' => 'REGION I (ILOCOS REGION)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 02,
        	'regname' => 'REGION II (CAGAYAN VALLEY)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 03,
        	'regname' => 'REGION III (CENTRAL LUZON)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 04,
        	'regname' => 'REGION IV-A (CALABAR ZON)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 05,
        	'regname' => 'REGION V (BICOL REGION)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 06,
        	'regname' => 'REGION VI (WESTERN VISAYAS)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 07,
        	'regname' => 'REGION VII (CENTRAL VISAYAS)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 08,
        	'regname' => 'REGION VIII (EASTERN VISAYAS)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 09,
        	'regname' => 'REGION IX (ZAMBOANGA PENINSULA)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 10,
        	'regname' => 'REGION X (NORTHERN MINDANAO)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 11,
        	'regname' => 'REGION XI (DAVAO REGION)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 12,
        	'regname' => 'REGION XII (SOCCSKSA RGEN)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 13,
        	'regname' => 'NATIONAL CAPITAL REGION (NCR)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 14,
        	'regname' => 'CORDILLERA ADMINISTRA TIVE REGION (CAR)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 15,
        	'regname' => 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 16,
        	'regname' => 'REGION XIII (CARAGA)',
        	]);
        DB::table('region')->insert([
        	'regcode' => 17,
        	'regname' => 'REGION IV-B (MIMAROPA)',
        	]);






    }
}

<?php

use Illuminate\Database\Seeder;

class OAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$config = app()->make('config');
    	
        DB::table("oauth_clients")->delete();

        DB::table("oauth_clients")->insert([
            'id' => $config->get('secrets.client_id'),
            'secret' => $config->get('secrets.client_secret'),
            'name' => 'App'
        ]);   
    }
}

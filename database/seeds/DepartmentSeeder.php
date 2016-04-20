<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       
      /* DB::table('departments')->delete();
       // $file = File::get('database/seeds/agencies.csv');
        $file = 'agencies.csv';
       $reader = Reader::createFromPath($file);
    
       $data = array();
       $count_elements = 0;

       foreach($reader as $index => $row)
       {
           $data[$count_elements] = array('regcode'=>$row[0],'dept_name'=>$row[1],
            'location'=>$row[2]);
           $count_elements++;
       }
       
       $cr = new Department;
       $cr::insert($data);*/
    }
}

<?php

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('province')->delete();

        DB::table('province')->insert([
        	'regcode' => 14,
        	'provcode' => 1401,
        	'provname' => 'ABRA',
        	]);

        DB::table('province')->insert([
        	'regcode' => 16,
        	'provcode' => 16,
        	'provname' => 'AGUSAN DEL NORTE',
        	]);

        DB::table('province')->insert([
        	'regcode' => 16,
        	'provcode' => 1603,
        	'provname' => 'AGUSAN DEL SUR',
        	]);

        DB::table('province')->insert([
        	'regcode' => 06,
        	'provcode' => 0604,
        	'provname' => 'AKLAN',
        	]);
        DB::table('province')->insert([
        	'regcode' => 06,
        	'provcode' => 0505,
        	'provname' => 'ALBAY',
        	]);
        DB::table('province')->insert([
        	'regcode' => 06,
        	'provcode' => 0606,
        	'provname' => 'ANTIQUE',
        	]);

        DB::table('province')->insert([
        	'regcode' => 15,
        	'provcode' => 1507,
        	'provname' => 'BASILAN',
        	]);

        DB::table('province')->insert([
        	'regcode' => 03,
        	'provcode' => 0308,
        	'provname' => 'BATAAN',
        	]);
        DB::table('province')->insert([
        	'regcode' => 02,
        	'provcode' => 0209,
        	'provname' => 'BATANES',
        	]);
        DB::table('province')->insert([
        	'regcode' => 04,
        	'provcode' => 0410,
        	'provname' => 'BATANGAS',
        	]);

        DB::table('province')->insert([
        	'regcode' => 14,
        	'provcode' => 1411,
        	'provname' => 'BENGUET',
        	]);

        DB::table('province')->insert([
        	'regcode' => 07,
        	'provcode' => 1013,
        	'provname' => 'BUKIDNON',
        	]);

        DB::table('province')->insert([
        	'regcode' => 03,
        	'provcode' => 0314,
        	'provname' => 'BULACAN',
        	]);

        DB::table('province')->insert([
        	'regcode' => 02,
        	'provcode' => 0215,
        	'provname' => 'CAGAYAN',
        	]);

        DB::table('province')->insert([
        	'regcode' => 05,
        	'provcode' => 0516,
        	'provname' => 'CAMARINES NORTE',
        	]);
        DB::table('province')->insert([
        	'regcode' => 05,
        	'provcode' => 0517,
        	'provname' => 'CAMARINES SUR',
        	]);
        DB::table('province')->insert([
        	'regcode' => 10,
        	'provcode' => 1018,
        	'provname' => 'CAMIGUIN',
        	]);
        DB::table('province')->insert([
        	'regcode' => 06,
        	'provcode' => 0619,
        	'provname' => 'CAPIZ',
        	]);
        DB::table('province')->insert([
        	'regcode' => 05,
        	'provcode' => 0520,
        	'provname' => 'CATANDUANES',
        	]);
        DB::table('province')->insert([
        	'regcode' => 04,
        	'provcode' => 0421,
        	'provname' => 'CEBU',
        	]);
        DB::table('province')->insert([
        	'regcode' => 11,
        	'provcode' => 1123,
        	'provname' => 'DAVAO DEL NORTE',
        	]);

        DB::table('province')->insert([
        	'regcode' => 11,
        	'provcode' => 1124,
        	'provname' => 'DAVAO DEL SUR',
        	]);
        DB::table('province')->insert([
        	'regcode' => 11,
        	'provcode' => 1125,
        	'provname' => 'DAVAO ORIENTAL',
        	]);

        DB::table('province')->insert([
        	'regcode' => '08',
        	'provcode' => '0826',
        	'provname' => 'EASTERN SAMAR',
        	]);

        DB::table('province')->insert([
        	'regcode' => 14,
        	'provcode' => 1427,
        	'provname' => 'IFUGAO',
        	]);

        DB::table('province')->insert([
        	'regcode' => 01,
        	'provcode' => 0129,
        	'provname' => 'ILOCOS SUR',
        	]);
        DB::table('province')->insert([
        	'regcode' => 06,
        	'provcode' => 0630,
        	'provname' => 'ILOILO',
        	]);
        DB::table('province')->insert([
        	'regcode' => 02,
        	'provcode' => 1432,
        	'provname' => 'KALINGA',
        	]);
        DB::table('province')->insert([
        	'regcode' => 01,
        	'provcode' => 0133,
        	'provname' => 'LA UNION',
        	]);
        DB::table('province')->insert([
        	'regcode' => 04,
        	'provcode' => 0434,
        	'provname' => 'LAGUNA',
        	]);
        DB::table('province')->insert([
        	'regcode' => 10,
        	'provcode' => 1035,
        	'provname' => 'LANAO DEL NORTE',
        	]);
        DB::table('province')->insert([
        	'regcode' => 15,
        	'provcode' => 1536,
        	'provname' => 'LANAO DEL SUR',
        	]);
        DB::table('province')->insert([
        	'regcode' => '08',
        	'provcode' => '0837',
        	'provname' => 'LEYTE',
        	]);
        DB::table('province')->insert([
        	'regcode' => 15,
        	'provcode' => 1538,
        	'provname' => 'MAGUINDANAO',
        	]);
        DB::table('province')->insert([
        	'regcode' => 13,
        	'provcode' => 1339,
        	'provname' => 'NCR, CITY OF MANILA, FIRST DISTRICT (Not a Province)',
        	]);
        DB::table('province')->insert([
        	'regcode' => 17,
        	'provcode' => 1740,
        	'provname' => 'MARINDUQUE',
        	]);
         DB::table('province')->insert([
        	'regcode' => 05,
        	'provcode' => 0541,
        	'provname' => 'MASBATE',
        	]);
         DB::table('province')->insert([
        	'regcode' => 10,
        	'provcode' => 1042,
        	'provname' => 'MISAMIS OCCIDENTAL',
        	]);
         DB::table('province')->insert([
        	'regcode' => 10,
        	'provcode' => 1043,
        	'provname' => 'MISAMIS ORIENTAL',
        	]);
         DB::table('province')->insert([
        	'regcode' => 14,
        	'provcode' => 1444,
        	'provname' => 'MOUNTAIN PROVINCE',
        	]);
         DB::table('province')->insert([
        	'regcode' => 06,
        	'provcode' => 0645,
        	'provname' => 'NEGROS OCCIDENTAL',
        	]);
         DB::table('province')->insert([
        	'regcode' => 07,
        	'provcode' => 0746,
        	'provname' => 'NEGROS ORIENTAL',
        	]);
         DB::table('province')->insert([
        	'regcode' => 12,
        	'provcode' => 1247,
        	'provname' => 'COTABATO (NORTH COTABATO)',
        	]);
         DB::table('province')->insert([
        	'regcode' => '08',
        	'provcode' => '0848',
        	'provname' => 'NORTHERN SAMAR',
        	]);
         DB::table('province')->insert([
        	'regcode' => 03,
        	'provcode' => 0349,
        	'provname' => 'NUEVA ECIJA',
        	]);
         DB::table('province')->insert([
        	'regcode' => 02,
        	'provcode' => 0250,
        	'provname' => 'NUEVA VIZCAYA',
        	]);
         DB::table('province')->insert([
        	'regcode' => 17,
        	'provcode' => 1751,
        	'provname' => 'OCCIDENTAL MINDORO',
        	]);
         DB::table('province')->insert([
        	'regcode' => 17,
        	'provcode' => 1752,
        	'provname' => 'ORIENTAL MINDORO',
        	]);
         DB::table('province')->insert([
        	'regcode' => 17,
        	'provcode' => 1753,
        	'provname' => 'PALAWAN',
        	]);
         DB::table('province')->insert([
        	'regcode' => 03,
        	'provcode' => 0354,
        	'provname' => 'PAMPANGA',
        	]);
         DB::table('province')->insert([
        	'regcode' => 01,
        	'provcode' => 0155,
        	'provname' => 'PANGASINAN',
        	]);
         DB::table('province')->insert([
        	'regcode' => 04,
        	'provcode' => 0456,
        	'provname' => 'QUEZON',
        	]);
         DB::table('province')->insert([
        	'regcode' => 02,
        	'provcode' => 0257,
        	'provname' => 'QUIRINO',
        	]);
         DB::table('province')->insert([
        	'regcode' => 04,
        	'provcode' => 0458,
        	'provname' => 'RIZAL',
        	]);
         DB::table('province')->insert([
        	'regcode' => 17,
        	'provcode' => 1759,
        	'provname' => 'ROMBLON',
        	]);
         DB::table('province')->insert([
        	'regcode' => '08',
        	'provcode' => '0860',
        	'provname' => 'SAMAR (WESTERN SAMAR)',
        	]);
         DB::table('province')->insert([
        	'regcode' => 07,
        	'provcode' => 0761,
        	'provname' => 'SIQUIJOR',
        	]);
         DB::table('province')->insert([
        	'regcode' => 05,
        	'provcode' => 0562,
        	'provname' => 'SORSOGON',
        	]);
         DB::table('province')->insert([
        	'regcode' => 12,
        	'provcode' => 1263,
        	'provname' => 'SOUTH COTABATO',
        	]);
         DB::table('province')->insert([
        	'regcode' => '08',
        	'provcode' => '0864',
        	'provname' => 'SOUTHERN LEYTE',
        	]);
         DB::table('province')->insert([
        	'regcode' => 12,
        	'provcode' => 1265,
        	'provname' => 'SULTAN KUDARAT',
        	]);
         DB::table('province')->insert([
        	'regcode' => 15,
        	'provcode' => 1566,
        	'provname' => 'SULU',
        	]);
          DB::table('province')->insert([
        	'regcode' => 16,
        	'provcode' => 1667,
        	'provname' => 'SURIGAO DEL NORTE',
        	]);
          DB::table('province')->insert([
        	'regcode' => 16,
        	'provcode' => 1668,
        	'provname' => 'SURIGAO DEL SUR',
        	]);
           DB::table('province')->insert([
        	'regcode' => 03,
        	'provcode' => 0369,
        	'provname' => 'TARLAC',
        	]);
           DB::table('province')->insert([
        	'regcode' => 15,
        	'provcode' => 1570,
        	'provname' => 'TAWI-TAWI',
        	]);
           DB::table('province')->insert([
        	'regcode' => '09',
        	'provcode' => '0972',
        	'provname' => 'ZAMBOANGA DEL NORTE',
        	]);
           DB::table('province')->insert([
        	'regcode' => '09',
        	'provcode' => '0973',
        	'provname' => 'ZAMBOANGA DEL SUR',
        	]);
           DB::table('province')->insert([
        	'regcode' => 13,
        	'provcode' => 1374,
        	'provname' => 'NCR, SECOND DISTRICT (Not a Province)',
        	]);
            DB::table('province')->insert([
        	'regcode' => 13,
        	'provcode' => 1375,
        	'provname' => 'NCR, THIRD DISTRICT (Not a Province)',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 13,
        	'provcode' => 1376,
        	'provname' => 'NCR, THIRD FOURTH (Not a Province)',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 03,
        	'provcode' => 0377,
        	'provname' => 'AURORA',
        	]);
        	DB::table('province')->insert([
        	'regcode' => '08',
        	'provcode' => '0878',
        	'provname' => 'BILIRAN',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 06,
        	'provcode' => 0679,
        	'provname' => 'GUIMARAS',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 12,
        	'provcode' => 1280,
        	'provname' => 'SARANGANI',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 14,
        	'provcode' => 1481,
        	'provname' => 'APAYAO',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 11,
        	'provcode' => 1182,
        	'provname' => 'COMPOSTELA VALLEY',
        	]);
        	DB::table('province')->insert([
        	'regcode' => '09',
        	'provcode' => '0983',
        	'provname' => 'ZAMBOANGA SIBUGAY',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 15,
        	'provcode' => 1584,
        	'provname' => 'SHARIFF KABUNSUAN',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 16,
        	'provcode' => 1685,
        	'provname' => 'DINAGAT ISLANDS',
        	]);
        	DB::table('province')->insert([
        	'regcode' => '09',
        	'provcode' => '0997',
        	'provname' => 'CITY OF ISABELA (Not a Province)',
        	]);
        	DB::table('province')->insert([
        	'regcode' => 12,
        	'provcode' => 1298,
        	'provname' => 'COTABATO CITY (Not a Province)',
        	]);

    }
}

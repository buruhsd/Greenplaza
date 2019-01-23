<?php

use Illuminate\Database\Seeder;

class ConfGradeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_grade')->delete();
        
        \DB::table('conf_grade')->insert(array (
            0 => 
            array (
                'id' => 1,
                'grade_member_name' => 'Kenari 1',
                'grade_member_range' => '5000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => '2019-01-18 08:43:12',
            ),
            1 => 
            array (
                'id' => 2,
                'grade_member_name' => 'Kenari 2',
                'grade_member_range' => '15000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'grade_member_name' => 'Kenari 3',
                'grade_member_range' => '25000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'grade_member_name' => 'Kenari 4',
                'grade_member_range' => '35000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'grade_member_name' => 'Kenari 5',
                'grade_member_range' => '45000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'grade_member_name' => 'Pleci 1',
                'grade_member_range' => '75000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'grade_member_name' => 'Pleci 2',
                'grade_member_range' => '105000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'grade_member_name' => 'Pleci 3',
                'grade_member_range' => '135000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'grade_member_name' => 'Pleci 4',
                'grade_member_range' => '165000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'grade_member_name' => 'Pleci 5',
                'grade_member_range' => '195000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'grade_member_name' => 'Kacer 1',
                'grade_member_range' => '285000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'grade_member_name' => 'Kacer 2',
                'grade_member_range' => '375000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'grade_member_name' => 'Kacer 3',
                'grade_member_range' => '465000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'grade_member_name' => 'Kacer 4',
                'grade_member_range' => '555000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'grade_member_name' => 'Kacer 5',
                'grade_member_range' => '645000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'grade_member_name' => 'Jalak Suren 1',
                'grade_member_range' => '915000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'grade_member_name' => 'Jalak Suren 2',
                'grade_member_range' => '1185000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'grade_member_name' => 'Jalak Suren 3',
                'grade_member_range' => '1455000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'grade_member_name' => 'Jalak Suren 4',
                'grade_member_range' => '1725000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'grade_member_name' => 'Jalak Suren 5',
                'grade_member_range' => '1995000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'grade_member_name' => 'Love Bird 1',
                'grade_member_range' => '2805000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'grade_member_name' => 'Love Bird 2',
                'grade_member_range' => '3615000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'grade_member_name' => 'Love Bird 3',
                'grade_member_range' => '4425000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'grade_member_name' => 'Love Bird 4',
                'grade_member_range' => '5235000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'grade_member_name' => 'Love Bird 5',
                'grade_member_range' => '6045000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'grade_member_name' => 'Cucak Rowo 1',
                'grade_member_range' => '8475000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'grade_member_name' => 'Cucak Rowo 2',
                'grade_member_range' => '10985000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'grade_member_name' => 'Cucak Rowo 3',
                'grade_member_range' => '13325000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'grade_member_name' => 'Cucak Rowo 4',
                'grade_member_range' => '15755000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'grade_member_name' => 'Cucak Rowo 5',
                'grade_member_range' => '18185000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'grade_member_name' => 'Murai 1',
                'grade_member_range' => '25475000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'grade_member_name' => 'Murai 2',
                'grade_member_range' => '32765000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'grade_member_name' => 'Murai 3',
                'grade_member_range' => '40055000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'grade_member_name' => 'Murai 4',
                'grade_member_range' => '47345000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'grade_member_name' => 'Murai 5',
                'grade_member_range' => '54635000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'grade_member_name' => 'Cendrawasih 1',
                'grade_member_range' => '76505000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'grade_member_name' => 'Cendrawasih 2',
                'grade_member_range' => '98375000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'grade_member_name' => 'Cendrawasih 3',
                'grade_member_range' => '120245000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'grade_member_name' => 'Cendrawasih 4',
                'grade_member_range' => '142115000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'grade_member_name' => 'Cendrawasih 5',
                'grade_member_range' => '163985000000.00',
                'grade_member_status' => 1,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'grade_member_name' => 'Kecubung 1',
                'grade_member_range' => '100000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'grade_member_name' => 'Kecubung 2',
                'grade_member_range' => '250000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'grade_member_name' => 'Kecubung 3',
                'grade_member_range' => '500000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'grade_member_name' => 'Kecubung 4',
                'grade_member_range' => '750000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'grade_member_name' => 'Kecubung 5',
                'grade_member_range' => '1000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'grade_member_name' => 'Red Baron 1',
                'grade_member_range' => '1250000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'grade_member_name' => 'Red Baron 2',
                'grade_member_range' => '1500000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'grade_member_name' => 'Red Baron 3',
                'grade_member_range' => '1750000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'grade_member_name' => 'Red Baron 4',
                'grade_member_range' => '2000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'grade_member_name' => 'Red Baron 5',
                'grade_member_range' => '2250000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'grade_member_name' => 'Topaz 1',
                'grade_member_range' => '2500000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'grade_member_name' => 'Topaz 2',
                'grade_member_range' => '2750000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'grade_member_name' => 'Topaz 3',
                'grade_member_range' => '3000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'grade_member_name' => 'Topaz 4',
                'grade_member_range' => '3250000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'grade_member_name' => 'Topaz 5',
                'grade_member_range' => '3500000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'grade_member_name' => 'Ruby 1',
                'grade_member_range' => '4000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'grade_member_name' => 'Ruby 2',
                'grade_member_range' => '4500000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'grade_member_name' => 'Ruby 3',
                'grade_member_range' => '5000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'grade_member_name' => 'Ruby 4',
                'grade_member_range' => '5500000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'grade_member_name' => 'Ruby 5',
                'grade_member_range' => '6000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'grade_member_name' => 'Zamrud 1',
                'grade_member_range' => '7000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'grade_member_name' => 'Zamrud 2',
                'grade_member_range' => '8000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'grade_member_name' => 'Zamrud 3',
                'grade_member_range' => '9000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'grade_member_name' => 'Zamrud 4',
                'grade_member_range' => '10000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'grade_member_name' => 'Zamrud 5',
                'grade_member_range' => '11000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'grade_member_name' => 'Saphire 1',
                'grade_member_range' => '13000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'grade_member_name' => 'Saphire 2',
                'grade_member_range' => '15000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'grade_member_name' => 'Saphire 3',
                'grade_member_range' => '17000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'grade_member_name' => 'Saphire 4',
                'grade_member_range' => '19000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'grade_member_name' => 'Saphire 5',
                'grade_member_range' => '21000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'grade_member_name' => 'Bacan 1',
                'grade_member_range' => '25000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'grade_member_name' => 'Bacan 2',
                'grade_member_range' => '30000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'grade_member_name' => 'Bacan 3',
                'grade_member_range' => '35000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'grade_member_name' => 'Bacan 4',
                'grade_member_range' => '40000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'grade_member_name' => 'Bacan 5',
                'grade_member_range' => '45000000.00',
                'grade_member_status' => 2,
                'created_at' => '2019-01-18 15:41:34',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
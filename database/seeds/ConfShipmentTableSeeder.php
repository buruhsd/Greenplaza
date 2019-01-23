<?php

use Illuminate\Database\Seeder;

class ConfShipmentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_shipment')->delete();
        
        \DB::table('conf_shipment')->insert(array (
            0 => 
            array (
                'id' => 1,
                'shipment_parent_id' => 0,
                'shipment_name' => 'JNE',
                'shipment_is_usable' => 1,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'shipment_parent_id' => 0,
                'shipment_name' => 'POS',
                'shipment_is_usable' => 1,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'shipment_parent_id' => 0,
                'shipment_name' => 'SAP',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'shipment_parent_id' => 0,
                'shipment_name' => 'CAHAYA',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'shipment_parent_id' => 0,
                'shipment_name' => 'PAHALA',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'shipment_parent_id' => 0,
                'shipment_name' => 'JNT',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'shipment_parent_id' => 0,
                'shipment_name' => 'SICEPAT',
                'shipment_is_usable' => 1,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'shipment_parent_id' => 0,
                'shipment_name' => 'WAHANA',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'shipment_parent_id' => 0,
                'shipment_name' => 'PANDU',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'shipment_parent_id' => 0,
                'shipment_name' => 'PCP',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'shipment_parent_id' => 0,
                'shipment_name' => 'ESL',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'shipment_parent_id' => 0,
                'shipment_name' => 'RPX',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'shipment_parent_id' => 0,
                'shipment_name' => 'TIKI',
                'shipment_is_usable' => 1,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'shipment_parent_id' => 0,
                'shipment_name' => 'JET',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'shipment_parent_id' => 0,
                'shipment_name' => 'INDAH',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'shipment_parent_id' => 0,
                'shipment_name' => 'DSE',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'shipment_parent_id' => 0,
                'shipment_name' => 'SLIS',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'shipment_parent_id' => 0,
                'shipment_name' => 'FIRST',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'shipment_parent_id' => 0,
                'shipment_name' => 'NCS',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'shipment_parent_id' => 0,
                'shipment_name' => 'STAR',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'shipment_parent_id' => 0,
                'shipment_name' => 'NINJA',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'shipment_parent_id' => 0,
                'shipment_name' => 'LION',
                'shipment_is_usable' => 0,
                'shipment_status' => 1,
                'shipment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
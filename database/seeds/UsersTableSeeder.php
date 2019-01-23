<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'superadmin',
                'name' => 'superadmin',
                'user_store' => NULL,
                'user_store_image' => NULL,
                'user_slogan' => NULL,
                'user_slug' => NULL,
                'user_grade' => '0',
                'user_grade_seller' => '0',
                'email' => 'superadmin@greenplaza.me',
                'email_verified_at' => '2019-01-15 10:51:59',
                'active' => 1,
                'token_register' => '7qs9Z7GdaUkCHCPNv4R8AwiRRZbjhj7X8U3LL1gKJtCQ0Vtlz5BWfPFjCd0BcZrv847rSmuhri37QBPkKk9Jzc36Tbb7ioRl20bbOsQ3o6PK9FRiUeeYUi60g9WYU2l4By5eduspIRxxE53viTgQsG6Ul7B2BOCxygyK5stEOKPiNheWiXCYyCxy7BIUJT',
                'password' => '$2y$10$edbyVIZT46zcwr1PoMnYIO8WiUYs.sRTLGz4jFJi2KataSpffbNLq',
                'remember_token' => 'HCl8FWpUJOfR5bvSTyGnNaqb6LVrxxqiPp6j86tIuFvYEi8CYJDOjq2zFCnv',
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-18 08:11:55',
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'admin',
                'name' => 'admin',
                'user_store' => NULL,
                'user_store_image' => NULL,
                'user_slogan' => NULL,
                'user_slug' => NULL,
                'user_grade' => '0',
                'user_grade_seller' => '0',
                'email' => 'admin@greenplaza.me',
                'email_verified_at' => '2019-01-15 10:52:01',
                'active' => 1,
                'token_register' => 'z3FTPbLkLtIho0whwqvQdFsXE03qUbmJq3UNr2UyE7x4ZbygqK0S1njZHxFbaOxQDr912qpLVbcmeg5WeiJtpE25uCYTcnWCNOSEcrKSStmWi0ODZDZsA0JT7K76q81cCmtV3WM4ON7FfJKhWiY61rhclzan4d9bk7xTqb7cJt22oaMpzHhFySTNpMbaId',
                'password' => '$2y$10$JUDvkrma3ky5bl658ua8ZOj0ogvhlzD/eOj5C8V4F4XpNblFmi7iq',
                'remember_token' => '8q75XBwHzTl84g6ApkmuyvEzt6fSsnuTNa1HwpcoVmOoQmR5DHkcXhfAjydV',
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:41:21',
            ),
            2 => 
            array (
                'id' => 3,
                'username' => 'fahmi',
                'name' => 'Fahmi Hidayat',
                'user_store' => 'Gandor',
                'user_store_image' => NULL,
                'user_slogan' => 'Berjualan dengan penuh harapan laku.',
                'user_slug' => 'gandor',
                'user_grade' => '0',
                'user_grade_seller' => '0',
                'email' => 'fahmisodret@gmail.com',
                'email_verified_at' => '2019-01-15 10:52:01',
                'active' => 1,
                'token_register' => 'ekELe3h8uMePHtzYOPvtdiI0tGWJkTeJ09lvb2iP62lN6VR9p6rz3M9aXGgzlDFSzgNZ82HGu0rdR4HTTdTovDrXF8TzjJVbIdUngZ4d1GjTwPu8jpLOUMAJ2VX3HO0U5jNxjgqrRGlIJjl69TqWWj3Vbid8ll5DqwUOW4xaVEnpeBZwCcfmfws3xOKbh0',
                'password' => '$2y$10$cUhtgA9mabvGtXZGpoiJIuu8aPUrbxD30n9rtsX68S/esqiIcL0Z6',
                'remember_token' => '8lrdpFNoCot8lGSGjudmbGwEu7UeU4b5tguMBR21VYX0LvQjAX9mjoSU6TmR',
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 04:10:54',
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'stsrc' => 'A',
            'email' => 'willson001@binus.ac.id',
            'password' => '123456',
            'name'  => 'Willson',
            'age'   => '20',
//            'gender'=>'M',
//            'BOD' => '27-Januari-1998',
            'address'=>'Jalan Jembatan Besi I Komplek ABC no.12K RT 008/ RW 002',
//            'pathKTP'=>'',
            'role_id'=> '1',
        ]);
    }
}

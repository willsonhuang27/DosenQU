<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'member';
        $user->email = 'member@email.com';
        $user->password = Hash::make('123456');
        $user->phone = '123456789';
        $user->address = 'Jalan Sandang D5A';
        $user->profile_picture = 'images/img_5c152da320fe0.jpg';
        $user->birth_date = now();
        $user->role_id = '1';
        $user->gender = 'Male';
        $user->save();

        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@email.com';
        $user->password = Hash::make('123456');
        $user->phone = '123456789';
        $user->address = 'Jalan Sandang D5A';
        $user->profile_picture = 'images/download.jpg';
        $user->birth_date = '1998-01-28';
        $user->role_id = '2';
        $user->gender = 'Male';
        $user->save();
    }
}

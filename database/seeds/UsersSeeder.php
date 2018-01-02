<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Admin;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin role
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        //registrasi role
        $memberRole = new Role();
        $memberRole->name = "registrasi";
        $memberRole->display_name = "Registrasi";
        $memberRole->save();

        //dokter role
        $dokterRole = new Role();
        $dokterRole->name = "dokter";
        $dokterRole->display_name = "Dokter";
        $dokterRole->save();

        //sample user
        $user = new User();
        $user->email = 'hasan@gmail.com';
        $user->password = bcrypt('bismillah');
        $user->save();
        $user->attachRole($adminRole);

    }
}

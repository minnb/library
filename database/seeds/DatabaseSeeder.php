<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
            'name' => 'administrator',
            'description' => 'Administrator account',
            'is_default' => 1,
            'is_admin' => 0
        ]);
        
        DB::table('roles')->insert([
            'name' => 'author',
            'description' => 'Editor account',
            'is_default' => 1,
            'is_admin' => 0
        ]);

        DB::table('roles')->insert([
            'name' => 'guest',
            'description' => 'Guest account',
            'is_default' => 0,
            'is_admin' => 1
        ]);

        $user = new User;
        $user->name = 'admin';
        $user->email = 'minhnb.it@gmail.com';
        $user->password = Hash::make('passw0rd123');
        $user->blocked = 0;
        $user->save();

        App\Models\Role_User::insertRoleUser($user->id, true);

    }
}

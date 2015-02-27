<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'Adrian'
            ,'email' => 'adrian@example.com'
            ,'password' => password_hash('adrian', PASSWORD_BCRYPT)
        ]);

        User::create([
            'name' => 'Alex'
            ,'email' => 'alex@example.com'
            ,'password' => password_hash('alex', PASSWORD_BCRYPT)
        ]);

        User::create([
            'name' => 'Guangbo'
            ,'email' => 'guangbo@example.com'
            ,'password' => password_hash('guangbo', PASSWORD_BCRYPT)
        ]);

        User::create([
            'name' => 'Abraham'
            ,'email' => 'abraham@example.com'
            ,'password' => password_hash('abraham', PASSWORD_BCRYPT)
        ]);
    }

}
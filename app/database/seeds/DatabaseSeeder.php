<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');

        $this->command->info('User table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
        	'name'	=> 'Jean Gérard Bousiquot',
        	'email' => 'jgbneatdesign@gmail.com',
        	'password' => Hash::make('tkp898989'),
        	'admin'	=> 1
        ]);
    }

}

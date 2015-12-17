<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('CategoryTableSeeder');
        $this->command->info('Category table seeded!');

        $this->call('PageTableSeeder');
        $this->command->info('Page table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
        	'name'	    => 'Jean Gérard Bousiquot',
        	'email'     => 'jgbneatdesign@gmail.com',
        	'password'  => Hash::make('tkp898989'),
            'telephone' => '+50936478199',
        	'admin'	    => 1
        ]);
    }

}

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('categories')->delete();

        Category::create([
            'name'  => 'Konpa',
            'slug'  => 'konpa'
        ]);

        Category::create([
            'name'  => 'Rasin',
            'slug'  => 'rasin'
        ]);

        Category::create([
            'name'  => 'Reggae',
            'slug'  => 'reggae'
        ]);

        Category::create([
            'name'  => 'Yanvalou',
            'slug'  => 'yanvalou'
        ]);

        Category::create([
            'name'  => 'RnB',
            'slug'  => 'rnb'
        ]);

        Category::create([
            'name'  => 'Rap-Kreyòl',
            'slug'  => 'rap-kreyol'
        ]);

        Category::create([
            'name'  => 'Dancehall',
            'slug'  => 'dancehall'
        ]);

        Category::create([
            'name'  => 'Lòt Jan',
            'slug'  => 'Lot-jan'
        ]);

        Category::create([
            'name'  => 'Kanaval',
            'slug'  => 'kanaval'
        ]);

        Category::create([
            'name'  => 'Gospèl',
            'slug'  => 'gospel'
        ]);

        Category::create([
            'name'  => 'Levanjil',
            'slug'  => 'levanjil'
        ]);
    }

}

class PageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->delete();

        Page::create([
            'title'     => 'Kontakte Nou',
            'slug'     => 'contact',
            'content'  => 'default page content',
        ]);
    }
}
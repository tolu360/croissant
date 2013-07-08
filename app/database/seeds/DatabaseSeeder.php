<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // Execute the run() method of the UserTableSeeder class
        $this->call('UserTableSeeder');

        // Tell Artisan to display a message
        $this->command->info('User table seeded!');

        // Execute the run() method of the PostTableSeeder class
        $this->call('PostTableSeeder');

        // Tell Artisan to display a message
        $this->command->info('Post table seeded!');
        
        // Execute the run() method of the PostTableSeeder class
        $this->call('PageTableSeeder');

        // Tell Artisan to display a message
        $this->command->info('Page table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        // Delete records from the table, if any
        DB::table('users')->delete();

        // Create the record and save to the table
        User::create(
            array(
                'username' => 'admin',
                'password' => Hash::make('password'),
            )
        );
    }

}

class PostTableSeeder extends Seeder {

    public function run()
    {
        // Delete the records from the table, if any
        DB::table('posts')->delete();

        // Create the record and save to the table
        Post::create(
            array(
                'user_id'        => 1,
                'post_title'     => 'Sample Post',
                'post_url_title' => 'sample-post',
                'post_content'   => 'This is an example of a post. Posts can (should) be created using markdown syntax.',
                'post_published' => 1
            )
        );
    }

}

class PageTableSeeder extends Seeder {

    public function run()
    {
        // Delete the records from the table, if any
        DB::table('pages')->delete();

        // Create the record and save to the table
        Page::create(
            array(
                'page_title'     => 'Sample Page',
                'page_url_title' => 'sample-page',
                'page_content'   => 'This is an example of static page content. Pages can (should) be created using markdown syntax.',
                'page_published' => 1
            )
        );
    }

}
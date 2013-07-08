<?php

use Illuminate\Database\Migrations\Migration;

class Install extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('username', 25);
			$table->string('password', 100);
			$table->date('created_at');
			$table->date('updated_at');
		});

		Schema::create('posts', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('post_title');
			$table->string('post_url_title');
			$table->text('post_content');
            $table->boolean('post_published');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			
			$table->index('user_id');
			$table->index('post_url_title');
			$table->index('created_at');
		});
        
		Schema::create('pages', function($table)
		{
			$table->increments('id');
			$table->string('page_title');
			$table->string('page_url_title');
			$table->text('page_content');
            $table->boolean('page_published');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			
			$table->index('page_url_title');
			$table->index('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('posts');
        Schema::drop('pages');
	}

}
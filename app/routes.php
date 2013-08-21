<?php

/*
 *--------------------------------------------------------------------------
 * Not Routes
 *--------------------------------------------------------------------------
 * 
 * Items such as view composers, route filters, model binding, etc
 * 
 */

// The public view composer
View::composer('themes.' . Config::get('croissant.default_theme') . '.master', function($view)
{
    // Make the site title available to all public views
	$view->with('site_title', Config::get('croissant.site_title'));
});

// Route model binding for editing models
Route::model('post', 'Post');
Route::model('page', 'Page');
Route::model('user', 'User');

// The admin route filter
Route::filter('auth', function()
{
    // Check to see if the user is logged in
    if (!Auth::check())
    {
        // The user is not logged in, so redirect them to the login form
        return Redirect::to('admin/login');
    }
});

/*
 *--------------------------------------------------------------------------
 * Routes
 *--------------------------------------------------------------------------
 * 
 * Define our controller action routes
 * 
 */

// The default public route
Route::get('/', 'PublicPostController@index');

// View an individual post
Route::get('post/{post_url_title}', 'PublicPostController@showPost');

// View a page
Route::get('page/{page_url_title}', 'PublicPageController@showPage');

// Display the admin login form
Route::get('admin/login', 'AdminSessionController@getLogin');

// Attempt to validate the admin login
Route::post('admin/login', 'AdminSessionController@postLogin');

// Group the admin pages for auth filter
Route::group(array('before' => 'auth'), function() {
    
    // A dashboard could be implemented here, but for now let's just redirect
    Route::get('admin', function()
    {
        return Redirect::to('admin/posts');
    });
    
    // Default admin route - show the dashboard
    Route::get('admin/posts', 'AdminPostController@getIndex');

    // Create a post - display the form
    Route::get('admin/post/create', 'AdminPostController@getCreate');

    // Create a post - form submission
    Route::post('admin/post/create', 'AdminPostController@postCreate');

    // Edit a post - display the form
    Route::get('admin/post/edit/{post}', 'AdminPostController@getEdit');

    // Edit a post - form submission
    Route::post('admin/post/edit/{id}', array('uses' => 'AdminPostController@postEdit', 'as' => 'post.edit'));

    // Delete a post
    Route::get('admin/post/delete/{id}', 'AdminPostController@getDelete');
    
    // Lists the pages
    Route::get('admin/pages', 'AdminPageController@getIndex');

    // Create a page - display the form
    Route::get('admin/page/create', 'AdminPageController@getCreate');

    // Create a page - form submission
    Route::post('admin/page/create', 'AdminPageController@postCreate');

    // Edit a page - display the form
    Route::get('admin/page/edit/{page}', 'AdminPageController@getEdit');

    // Edit a page - form submission
    Route::post('admin/page/edit/{id}', array('uses' => 'AdminPageController@postEdit', 'as' => 'page.edit'));

    // Delete a page
    Route::get('admin/page/delete/{id}', 'AdminPageController@getDelete');
    
    // List the users
    Route::get('admin/users', 'AdminUserController@getIndex');
    
    // Create a user - display form
    Route::get('admin/user/create', 'AdminUserController@getCreate');
    
    // Create a user - form submission
    Route::post('admin/user/create', 'AdminUserController@postCreate');

    // Edit a user - display form
    Route::get('admin/user/edit/{user}', 'AdminUserController@getEdit');

    // Edit a user - form submission
    Route::post('admin/user/edit/{id}', array('uses' => 'AdminUserController@postEdit', 'as' => 'user.edit'));

    // Delete a user
    Route::get('admin/user/delete/{id}', 'AdminUserController@getDelete');
    
    // Log out
    Route::get('admin/logout', 'AdminSessionController@getLogout');

});
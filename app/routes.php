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
    
    // The user is logged in - do nothing
});

/*
 *--------------------------------------------------------------------------
 * Routes
 *--------------------------------------------------------------------------
 * 
 * Items such as routes, routes and routes
 * 
 */

// The default public route
Route::get('/', function()
{
	return View::make('themes.' . Config::get('croissant.default_theme') . '.index')->with('posts', Post::published()->orderby('created_at', 'DESC')->paginate(25));
});

// View an individual post
Route::get('post/{post_url_title}', function($post_url_title)
{
    return View::make('themes.' . Config::get('croissant.default_theme') . '.post')->with('post', Post::published()->where('post_url_title', $post_url_title)->first());
});

// View a page
Route::get('page/{page_url_title}', function($page_url_title)
{
    return View::make('themes.' . Config::get('croissant.default_theme') . '.page')->with('page', Page::where('page_url_title', $page_url_title)->first());
});

// Display the admin login form
Route::get('admin/login', function() 
{
    return View::make('admin.login');
});

// Attempt to validate the admin login
Route::post('admin/login', function()
{
    $remember = (Request::get('remember_me') == 1) ? true : false;
    
    if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')), $remember))
    {
        return Redirect::to('admin');
    }
    
    return Redirect::to('admin/login');
});

// Group the admin pages for auth filter
Route::group(array('before' => 'auth'), function() {
    
    // A dashboard could be implemented here, but for now let's just redirect
    Route::get('admin', function()
    {
        return Redirect::to('admin/posts');
    });
    
    // Default admin route - show the dashboard
    Route::get('admin/posts', function()
    {
        return View::make('admin.postindex')->with('posts', Post::paginate(25));
    });

    // Create a post - display the form
    Route::get('admin/post/create', function()
    {
       return View::make('admin.postform')->with('form_open', Form::open(array('url' => 'admin/post/create')));
    });

    // Create a post - form submission
    Route::post('admin/post/create', function()
    {
       $post = new Post(Input::all());
       
       $post['user_id'] = Auth::user()->id;
       
       if ($post->save())
       {
           return Redirect::to('admin/posts');
       }

       return Redirect::to('admin/post/create')->withInput();
    });

    // Edit a post - display the form
    Route::get('admin/post/edit/{post}', function(Post $post)
    {
        $data = array(
            'post' => $post,
            'form_open' => Form::model($post, array('route' => array('post.edit', $post->id)))
        );
        return View::make('admin.postform', $data);
    });

    // Edit a post - form submission
    Route::post('admin/post/edit/{id}', array('as' => 'post.edit', function($id)
    {
        $post = Post::find($id);

        if ($post->update(Input::all()))
        {
            return Redirect::to('admin/posts');
        }

        return Redirect::to('admin/post/edit/' . $id)->withInput();
    }));

    // Delete a post
    Route::get('admin/post/delete/{id}', function($id)
    {
        $post = Post::find($id);
        $post->delete();

        return Redirect::to('admin/posts');
    });
    
    // Default admin route - lists the pages
    Route::get('admin/pages', function()
    {
        return View::make('admin.pageindex')->with('pages', Page::paginate(25));
    });

    // Create a page - display the form
    Route::get('admin/page/create', function()
    {
       return View::make('admin.pageform')->with('form_open', Form::open(array('url' => 'admin/page/create')));
    });

    // Create a page - form submission
    Route::post('admin/page/create', function()
    {
       $page = new Page(Input::all());

       if ($page->save())
       {
           return Redirect::to('admin/pages');
       }

       return Redirect::to('admin/page/create')->withInput();
    });

    // Edit a page - display the form
    Route::get('admin/page/edit/{page}', function(Page $page)
    {
        $data = array(
            'page' => $page,
            'form_open' => Form::model($page, array('route' => array('page.edit', $page->id)))
        );
        return View::make('admin.pageform', $data);
    });

    // Edit a page - form submission
    Route::post('admin/page/edit/{id}', array('as' => 'page.edit', function($id)
    {
        $page = Page::find($id);

        if ($page->update(Input::all()))
        {
            return Redirect::to('admin/pages');
        }

        return Redirect::to('admin/page/edit/' . $id)->withInput();
    }));

    // Delete a page
    Route::get('admin/page/delete/{id}', function($id)
    {
        $page = Page::find($id);
        $page->delete();

        return Redirect::to('admin/pages');
    });
    
    // List the users
    Route::get('admin/users', function()
    {
        return View::make('admin.userindex')->with('users', User::paginate(25));
    });
    
    // Create a user - display form
    Route::get('admin/user/create', function()
    {
        return View::make('admin.userform')->with('form_open', Form::open(array('url' => 'admin/user/create')));
    });
    
    // Create a user - form submission
    Route::post('admin/user/create', function()
    {
       $user = new User(Input::all());

       if ($user->isValid())
       {
            unset($user->password_verification);
            
            $user->password = Hash::make($user->password);

            $user->save();

            return Redirect::to('admin/users');
       }

       return Redirect::to('admin/user/create')->withInput()->withErrors($user->validator);
    });

    // Edit a user - display form
    Route::get('admin/user/edit/{user}', function(User $user)
    {
        $data = array(
            'user' => $user,
            'form_open' => Form::model($user, array('route' => array('user.edit', $user->id)))
        );
        return View::make('admin.userform', $data);
    });

    // Edit a user - form submission
    Route::post('admin/user/edit/{id}', array('as' => 'user.edit', function($id)
    {
        $user = User::find($id);
        
        $user->username = Input::get('username');
        $user->password = Input::get('password');
        $user->password_verification = Input::get('password_verification');

        if ($user->isValid())
        {
            unset($user->password_verification);
            
            $user->update(array('username'=>Input::get('username'), 'password'=>Hash::make(Input::get('password'))));

            return Redirect::to('admin/users');
        }

        return Redirect::to('admin/usr/edit/' . $id)->withInput()->withErrors($user->validator);
    }));

    // Delete a user
    Route::get('admin/user/delete/{id}', function($id)
    {
        $user = User::find($id);
        $user->delete();
        
        return Redirect::to('admin/users');
    });
    
    // Log out
    Route::get('admin/logout', function()
    {
        Auth::logout();
        
        return Redirect::to('admin/login');
    });
    
});
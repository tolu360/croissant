<?php

class AdminSessionController extends BaseController {
	
	public function getLogin()
	{
		return View::make('admin.login');
	}

	public function postLogin()
	{
	    $remember = (Request::get('remember_me') == 1) ? true : false;
	    
	    if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')), $remember))
	    {
	        return Redirect::to('admin');
	    }
	    
	    return Redirect::to('admin/login');
	}

	public function getLogout()
	{
        Auth::logout();
        
        return Redirect::to('admin/login');
	}

}
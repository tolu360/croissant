<?php

class AdminUserController extends BaseController {
	
	public function getIndex()
	{
		return View::make('admin.userindex')->with('users', User::paginate(25));
	}

	public function getCreate()
	{
		return View::make('admin.userform')->with('form_open', Form::open(array('url' => 'admin/user/create')));
	}

	public function postCreate()
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
	}

	public function getEdit(User $user)
	{
		$data = array(
		    'user' => $user,
		    'form_open' => Form::model($user, array('route' => array('user.edit', $user->id)))
		);

		return View::make('admin.userform', $data);
	}

	public function postEdit($id)
	{
        $user = User::find($id);
        $user->username = Input::get('username');
        $user->password = Input::get('password');
        $user->password_verification = Input::get('password_verification');

        if ($user->isValid())
        {
        	unset($user->password_verification);

            if ($user->password)
			{
				$user->password = Hash::make($user->password);
				$user->update();
        	}
        	else
        	{
        		unset($user->password);

        		$user->update();
        	}

            return Redirect::to('admin/users');
        }

        return Redirect::to('admin/user/edit/' . $id)->withInput()->withErrors($user->validator);
	}

	public function getDelete($id)
	{
        $user = User::find($id);
        $user->delete();
        
        return Redirect::to('admin/users');
	}

}
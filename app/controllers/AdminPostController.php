<?php

class AdminPostController extends BaseController {
	
	public function getIndex()
	{
		return View::make('admin.postindex')->with('posts', Post::paginate(25));
	}

	public function getCreate()
	{
		return View::make('admin.postform')->with('form_open', Form::open(array('url' => 'admin/post/create')));
	}

	public function postCreate()
	{
		$post = new Post(Input::all());

		$post['user_id'] = Auth::user()->id;

		if ($post->save())
		{
			return Redirect::to('admin/posts');
		}

		return Redirect::to('admin/post/create')->withInput()->withErrors($post->validator);
	}

	public function getEdit(Post $post)
	{
        $data = array(
            'post' => $post,
            'form_open' => Form::model($post, array('route' => array('post.edit', $post->id)))
        );
        return View::make('admin.postform', $data);
	}

	public function postEdit($id)
	{
        $post = Post::find($id);

        if ($post->update(Input::all()))
        {
            return Redirect::to('admin/posts');
        }

        return Redirect::to('admin/post/edit/' . $id)->withInput()->withErrors($post->validator);
	}

	public function getDelete($id)
	{
        $post = Post::find($id);
        $post->delete();

        return Redirect::to('admin/posts');
	}

}
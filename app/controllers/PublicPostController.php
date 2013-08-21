<?php

class PublicPostController extends BaseController {
	
	public function index()
	{
		return View::make('themes.' . Config::get('croissant.default_theme') . '.index')->with('posts', Post::published()->orderby('created_at', 'DESC')->paginate(25));
	}

	public function showPost($post_url_title)
	{
		return View::make('themes.' . Config::get('croissant.default_theme') . '.post')->with('post', Post::published()->where('post_url_title', $post_url_title)->first());
	}

}
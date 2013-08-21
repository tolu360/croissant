<?php

class PublicPageController extends BaseController {
	
	public function showPage($page_url_title)
	{
		return View::make('themes.' . Config::get('croissant.default_theme') . '.page')->with('page', Page::published()->where('page_url_title', $page_url_title)->first());
	}

}
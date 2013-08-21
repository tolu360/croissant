<?php

class AdminPageController extends BaseController {
	
	public function getIndex()
	{
		return View::make('admin.pageindex')->with('pages', Page::paginate(25));
	}

	public function getCreate()
	{
		return View::make('admin.pageform')->with('form_open', Form::open(array('url' => 'admin/page/create')));
	}

	public function postCreate()
	{
		$page = new Page(Input::all());

		if ($page->save())
		{
			return Redirect::to('admin/pages');
		}

		return Redirect::to('admin/page/create')->withInput()->withErrors($page->validator);
	}

	public function getEdit(Page $page)
	{
        $data = array(
            'page' => $page,
            'form_open' => Form::model($page, array('route' => array('page.edit', $page->id)))
        );
        
        return View::make('admin.pageform', $data);
	}

	public function postEdit($id)
	{
        $page = Page::find($id);

        if ($page->update(Input::all()))
        {
            return Redirect::to('admin/pages');
        }

        return Redirect::to('admin/page/edit/' . $id)->withInput()->withErrors($page->validator);
	}

	public function getDelete($id)
	{
        $page = Page::find($id);
        $page->delete();

        return Redirect::to('admin/pages');
	}

}
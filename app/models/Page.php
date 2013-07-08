<?php

class Page extends BaseModel {

    protected $guarded = array('id');
    
    public static $sluggable = array(
        'build_from' => 'page_title',
        'save_to'    => 'page_url_title'
    );

    public static function boot()
    {
        parent::boot();

        static::saving(function($page)
            {
                if (!$page->isValid())
                    return FALSE;
            });
    }

    public static function rules()
    {
        return array(
            'page_title'   => 'required',
            'page_content' => 'required'
        );
    }

    public function getParsedContentAttribute()
    {
        return md($this->attributes['page_content']);
    }

}
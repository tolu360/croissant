<?php

class Page extends BaseModel {

    protected $guarded = array('id');
    
    public static $sluggable = array(
        'build_from' => 'page_title',
        'save_to'    => 'page_url_title'
    );

    // Use Eloquent's boot function to register our event binding when saving
    public static function boot()
    {
        parent::boot();

        // Register this event to occur any time a record is saved
        static::saving(function($page)
            {
                if (!$page->isValid())
                    return FALSE;
            });
    }

    // The rules which will be validated against on isValid()
    public static function rules()
    {
        return array(
            'page_title'   => 'required',
            'page_content' => 'required'
        );
    }

    // Provide an accessor so our markdown is automatically parsed
    public function getParsedContentAttribute()
    {
        return md($this->attributes['page_content']);
    }
    
    // Provide an accessor so output Yes or No for 1 / 0
    public function getIsPublishedAttribute()
    {
        return ($this->attributes['page_published']) ? 'Yes' : 'No';
    }

    // Defines a scope to use for public views
    public function scopePublished($query)
    {
        return $query->where('page_published', '=', 1);
    }

}
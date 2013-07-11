<?php

class Post extends BaseModel {

    protected $guarded = array('id');
    public static $sluggable = array(
        'build_from' => 'post_title',
        'save_to'    => 'post_url_title'
    );

    // Use Eloquent's boot function to register our event binding when saving
    public static function boot()
    {
        parent::boot();

        // Register this event to occur any time a record is saved
        static::saving(function($post)
            {
                if (!$post->isValid())
                    return FALSE;
            });
    }

    public function user()
    {
        return $this->hasOne('User');
    }

    // The rules which will be validated against on isValid()
    public static function rules()
    {
        return array(
            'post_title'   => 'required',
            'post_content' => 'required'
        );
    }

    // Provide an accessor so our markdown is automatically parsed
    public function getParsedContentAttribute()
    {
        return md($this->attributes['post_content']);
    }
    
    // Provide an accessor so output Yes or No for 1 / 0
    public function getIsPublishedAttribute()
    {
        return ($this->attributes['post_published']) ? 'Yes' : 'No';
    }
    
    // Defines a scope to use for public views
    public function scopePublished($query)
    {
        return $query->where('post_published', '=', 1);
    }
}
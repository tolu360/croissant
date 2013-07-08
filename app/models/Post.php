<?php

class Post extends BaseModel {

    protected $guarded = array('id');
    public static $sluggable = array(
        'build_from' => 'post_title',
        'save_to'    => 'post_url_title'
    );

    public static function boot()
    {
        parent::boot();

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

    public static function rules()
    {
        return array(
            'post_title'   => 'required',
            'post_content' => 'required'
        );
    }

    public function getParsedContentAttribute()
    {
        return md($this->attributes['post_content']);
    }
    
    public function getIsPublishedAttribute()
    {
        return ($this->attributes['post_published']) ? 'Yes' : 'No';
    }
    
    public function scopePublished($query)
    {
        return $query->where('post_published', '=', 1);
    }
}
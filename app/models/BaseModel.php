<?php

class BaseModel extends Eloquent {

    public $validator;
	
	public function isValid()
	{
		$validation = Validator::make($this->attributes, static::rules());

		if ($validation->passes()) return true;
        
        $this->validator = $validation;

		return false;
	}

}
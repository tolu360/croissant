<?php

class BaseModel extends Eloquent {

    // Declare a variable to put an instance of the validator into
    public $validator;
	
    // This function is now accessible to all models extending BaseModel
	public function isValid()
	{
        // Create the validation instance and get the rules from the child model
        // rules function
		$validation = Validator::make($this->attributes, static::rules());

        // Check for validation and return as true if it passes
		if ($validation->passes()) return true;
        
        // Store a copy so we can flash it back to the view
        $this->validator = $validation;
        
		return false;
	}

}
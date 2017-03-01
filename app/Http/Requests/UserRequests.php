<?php

namespace App\Http\Requests;

class UserRequests extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'avatar' => 'image|mimes:jpg,png,jpeg',
            'age'=>'integer|between:18,99',
            'phone'=>'integer',
            'email' => 'required|email|max:255|unique:users,email,'.$this->id,
            
        ];
        return $rules;
    }
    
  
    
    
}
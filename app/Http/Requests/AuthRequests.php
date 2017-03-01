<?php

namespace App\Http\Requests;
use \Auth;

class AuthRequests extends Request
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
            'avatar' => 'image|mimes:jpg,png,jpeg|max:5000',
            'age'=>'integer|between:18,99',
            'phone'=>'integer',
            'email' => 'required|email|max:255|unique:users,email,',
            'password' => 'required|min:6|confirmed',
        ];
        return $rules;
    }
    
    public function inputs(){
        $this->merge(['auth_token' =>md5($this->email)]);
        return $this->all();
        
        
    }
    
    
}
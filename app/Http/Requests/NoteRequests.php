<?php

namespace App\Http\Requests;


class NoteRequests extends Request
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
        
        if($this->has('edit')){
            if(!$this->has('image_name') && !isset($this->image_name)){
                $rules = [
                    'title' => 'required',
                    'text' => 'required|max:50',
                    'cat_id' => 'required',
                    'created_date' => 'required|date'
                ];
                return $rules;
                
            }
            
        }
        $rules = [
            'title' => 'required',
            'text' => 'required|max:50',
            'cat_id' => 'required',
            'image_name' => 'required|image|mimes:jpg,png,jpeg,gif|max:5000',
            'created_date' => 'required|date'
        ];
        return $rules;
    }
    
    
    
    
    
}
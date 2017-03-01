<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
   protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_name', 'title', 'created_date' , 'cat_id' , 'text', 'user_id','published'
    ];
    
    public function category(){
        return $this->belongsTo('App\Category','cat_id');
    }    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}

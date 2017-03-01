<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = 'categories';
   
   public function notes(){
       $this->hasMany('App\Note');
   }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

}

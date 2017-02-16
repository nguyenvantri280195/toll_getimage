<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
     protected $table = 'links';
     protected $fillable = ['link','id_user', 'name'];
     public function user(){
     	return $this->belongTo('App\User');
     }
}

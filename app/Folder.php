<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    protected $table = 'folder';
    public function users(){
     	return $this->belongTo('App\User');
    }
}

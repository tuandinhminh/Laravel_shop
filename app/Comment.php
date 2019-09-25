<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function product(){
    	return $this->belongsTo('App\Product','id_product','id');
    }

    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'id';

    public function Product()
    {
    	return $this->belongsTo('App\Models\Product', 'id_sp', 'id');
    }

    public function User()
    {
    	return $this->belongsTo('App\Models\User', 'id_kh', 'id');
    }

    public function ChildrenComment()
    {
    	return $this->hasMany('App\Models\Comment', 'parent_id', 'id');
    }
    
    public function ParentComment()
    {
    	return $this->belongsTo('App\Models\Comment', 'parent_id', 'id');
    }
}

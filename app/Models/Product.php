<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'sanpham';
    protected $primarykey = 'id';
    protected $guarded = [];
    
    public function Category()
    {
        return $this->belongsTo('App\Models\Category', 'id_dm', 'id');
    }

    public function Brand()
    {
        return $this->belongsTo('App\Models\Brand', 'id_th', 'id');
    }

    public function CTCart()
    {
        return $this->hasMany('App\Models\CTCart', 'id_sp', 'id');
    }

    public function Comment()
    {
    	return $this->hasMany('App\Models\Comment', 'id_sp', 'id');
    }
    public function User()
    {
    	return $this->belongsTo('App\Models\User', 'id_kh', 'id');
    }
}

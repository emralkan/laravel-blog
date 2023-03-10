<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = 'post';

    function getCategory(){
       return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }


}

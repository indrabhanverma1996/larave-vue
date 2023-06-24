<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    Protected $table = 'post';
    Protected $id = 'id';
    protected $fillable = [
        'title', 
        'description',
       
    ];  

    public function PostImages(){

        return $this->hasMany(PostImages::class,'post_id','id');

    }
}

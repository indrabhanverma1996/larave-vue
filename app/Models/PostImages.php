<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class PostImages extends Model
{
    use HasFactory;


    Protected $table = 'postimages';
    Protected $id = 'id';
    protected $fillable = [
        'post_images', 
        'post_id',
       
    ];

    public function post(){

        return $this->hasToMany(Post::class,'id','post_id');

    }
}

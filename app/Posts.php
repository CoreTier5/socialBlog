<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //table names
    protected $table = 'posts';

    //feilds
    protected $fillable = ['title','description','photo','author','likes','dislikes'];

}

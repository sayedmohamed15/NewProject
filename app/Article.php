<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded=[];
//    protected $fillable=['title','excerpt','body'];
 // if use function name "user " you don't need to set foreignkey
    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags(){

        return $this->belongsToMany(Tag::class);
    }
}



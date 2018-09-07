<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answers', 'question_id','id' );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $fillable=[
        'title',
        'body',
        'author_id'
    ];

    public function author() {
        return $this->belongsTo(User::class,'author_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}

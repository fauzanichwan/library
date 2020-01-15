<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

  protected $fillable = [
    'user_id', 'title', 'title', 'publish', 'author', 'stock', 'created_at'
  ];

  protected $dates = ['publish'];

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function Transactions() {
    return $this->hasMany('App\BookTransaction');
  }

}

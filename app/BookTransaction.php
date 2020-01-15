<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookTransaction extends Model {
    protected $fillable = [
        'user_id', 'book_id', 'start_date', 'end_date', 'status', 'created_at'
    ];

    protected $dates = ['start_date', 'end_date'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function book() {
        return $this->belongsTo('App\Book');
    }
}

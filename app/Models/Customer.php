<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $fillable = ['name', 'surname', 'book_id'];

    public function book(){
        return $this->belongsTo('App\Models\Book');
    }
}

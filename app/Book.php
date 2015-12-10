<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //A book can have only one author
    public function author(){
        return $this->belongsTo('\App\Author');
    }
}

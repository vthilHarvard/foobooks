<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //Let this author object know that its connected to many books
    public function book()
    {
        return $this->hasMany('\App\Book');
    }
}

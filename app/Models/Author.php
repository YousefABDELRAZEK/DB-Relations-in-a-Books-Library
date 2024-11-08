<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function Symfony\Component\String\b;

class Author extends Model
{
    protected $fillable = ['name'];
    public function books(){
        return $this->hasMany(Book::class);
    }
}

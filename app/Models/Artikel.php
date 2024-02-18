<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Artikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'articles';

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    public function asset()
    {
        return $this->hasMany(User::class, 'id', 'content_id');
    }
}

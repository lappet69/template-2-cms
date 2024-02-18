<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registrasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'registrations';

    public function program()
    {
        return $this->hasOne(Content::class, 'id', 'program_id');
    }
    public function course()
    {
        return $this->hasOne(Content::class, 'id', 'course_id');
    }

    public function bootcamp()
    {
        return $this->hasMany(Bootcamp::class, 'id', 'bootcamp_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bootcamp extends Model
{
    use HasFactory, SoftDeletes;

    public function program_id()
    {
        return $this->hasOne(Program::class, 'id', 'program_id');
    }
}

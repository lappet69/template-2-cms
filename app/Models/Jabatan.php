<?php

namespace App\Models;

use App\Helpers\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Jabatan extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    protected $table = 'jabatan';

    public function lawyer()
    {
        return $this->hasMany(Content::class, 'subtitle', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\Traits\RecordSignature;

class Banner extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    public function asset()
    {
        return $this->hasMany(Asset::class, 'id', 'content_id');
    }

}
